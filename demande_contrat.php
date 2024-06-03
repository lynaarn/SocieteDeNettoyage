<?php
require_once("identifier.php");
require_once("connexiondb.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date_deb = $_POST['date_deb'];
    $date_fin = $_POST['date_fin'];
    $detailc = $_POST['detailc'];
    $client_id = $_SESSION['user']['id'];

    $services = $_POST['services'];
    $frequence = $_POST['frequence'];
    $detailsSer = $_POST['detailsSer'];

    $montant_total = 0;

    foreach ($services as $service_id) {
        $stmt = $pdo->prepare("SELECT TarifHr FROM Service WHERE CodeS = ?");
        $stmt->execute([$service_id]);
        $service = $stmt->fetch();

        $tarifHr = $service['TarifHr'];
        $frequence_value = $frequence[$service_id];

        $reduction = 0;
        if ($frequence_value === 'tout les jours') $reduction = 0.10;
        else if ($frequence_value === 'une fois par semaine') $reduction = 0.07;
        else if ($frequence_value === 'une fois par mois') $reduction = 0.05;
        else if ($frequence_value === 'une fois chaque 3 mois') $reduction = 0.02;

        $montant_service = $tarifHr - ($tarifHr * $reduction);
        $montant_total += $montant_service;
    }

    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("INSERT INTO contrat (date_deb, date_fin, detailc, montantc, client_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$date_deb, $date_fin, $detailc, $montant_total, $client_id]);
        $contrat_id = $pdo->lastInsertId();

        foreach ($services as $service_id) {
            $frequence_value = $frequence[$service_id];
            $details_value = $detailsSer[$service_id];
            $stmt = $pdo->prepare("INSERT INTO ServiceDansContrat (CodeS, id_c, detailsSer, intervention_id, frequence) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute([$service_id, $contrat_id, $details_value, NULL, $frequence_value]);
        }

        $pdo->commit();
        header('Location: contratsClients.php?success=1');
    } catch (Exception $e) {
        $pdo->rollBack();
        die("Erreur: " . $e->getMessage());
    }
}
?>

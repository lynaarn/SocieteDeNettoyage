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

    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("INSERT INTO contrat (date_deb, date_fin, detailc, client_id) VALUES (?, ?, ?, ?)");
        $stmt->execute([$date_deb, $date_fin, $detailc, $client_id]);
        $contrat_id = $pdo->lastInsertId();

        foreach ($services as $service_id) {
            $frequence_value = $frequence[$service_id];
            $details_value = $detailsSer[$service_id];
            $stmt = $pdo->prepare("INSERT INTO ServiceDansContrat (CodeS, id_c, detailsSer, frequence) VALUES (?, ?, ?, ?)");
            $stmt->execute([$service_id, $contrat_id, $details_value, $frequence_value]);
        }

        $pdo->commit();
        header('Location: contratsClients.php?success=1');
    } catch (Exception $e) {
        $pdo->rollBack();
        die("Erreur: " . $e->getMessage());
    }
}
?>

<?php
require_once("identifier.php");
require_once("connexiondb.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $date_prestation = $_POST['date_prestation'];
    $heure_prestation = $_POST['heure_prestation'];
    $adresse_prestation = $_POST['adresse_prestation'];
    $commentaires = isset($_POST['commentaires']) ? $_POST['commentaires'] : '';
    $client_id = $_SESSION['user']['id'];

    $services = $_POST['services'];
    $nbr_heures = $_POST['nbr_heures'];
    $instructions_speciales = $_POST['instructions_speciales'];

    $montant_total = 0;
    foreach ($services as $service_id) {
        $tarif = $pdo->query("SELECT TarifHr FROM Service WHERE CodeS = $service_id")->fetchColumn();
        $montant_total += $tarif * $nbr_heures[$service_id];
    }

    try {
        $pdo->beginTransaction();

        $stmt = $pdo->prepare("INSERT INTO reservation (date_reservation, date_prestation, heure_prestation, adresse_prestation, montant, client_id) VALUES (CURRENT_DATE(), ?, ?, ?, ?, ?)");
        $stmt->execute([$date_prestation, $heure_prestation, $adresse_prestation, $montant_total, $client_id]);
        $reservation_id = $pdo->lastInsertId();

        foreach ($services as $service_id) {
            $heures = $nbr_heures[$service_id];
            $instructions = $instructions_speciales[$service_id];
            $stmt = $pdo->prepare("INSERT INTO detailResSER (codeR, CodeS, nbr_hr, instructions_speciales) VALUES (?, ?, ?, ?)");
            $stmt->execute([$reservation_id, $service_id, $heures, $instructions]);
        }

        $pdo->commit();
        header('Location: prestationsClient.php?success=1');
    } catch (Exception $e) {
        $pdo->rollBack();
        die("Erreur: " . $e->getMessage());
    }
}
?>

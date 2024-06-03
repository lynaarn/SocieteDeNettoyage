<?php
require_once("identifier.php");
require_once("connexiondb.php");

$mysqli = new mysqli("localhost", "root", "", "GestionSocieteNettoyage");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$codeR = $_GET['codeR'] ?? null;

if (!$codeR) {
    die("CodeR is missing");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $mysqli->begin_transaction();
    try {
        // Créer une nouvelle intervention
        $createInterventionQuery = "INSERT INTO intervention (etat, codeR) VALUES ('pas encore faite', ?)";
        $createInterventionStmt = $mysqli->prepare($createInterventionQuery);
        $createInterventionStmt->bind_param("i", $codeR);
        $createInterventionStmt->execute();
        $intervention_id = $mysqli->insert_id;

        foreach ($_POST['services'] as $service) {
            $CodeS = $service['CodeS'];
            $employe_id = $service['employe_id'] ?? null;
            $materiels = $service['materiels'] ?? [];

            if ($employe_id) {
                // Assigner l'employé à l'intervention
                $assignEmployeQuery = "INSERT INTO employe_intervention (intervention_id, employe_id, CodeS, tache) VALUES (?, ?, ?, (SELECT NomS FROM Service WHERE CodeS = ?))";
                $assignEmployeStmt = $mysqli->prepare($assignEmployeQuery);
                $assignEmployeStmt->bind_param("iiis", $intervention_id, $employe_id, $CodeS, $CodeS);
                $assignEmployeStmt->execute();
            }

            foreach ($materiels as $materiel) {
                if (isset($materiel['codeM']) && isset($materiel['quantite_utilisee'])) {
                    $codeM = $materiel['codeM'];
                    $quantite_utilisee = $materiel['quantite_utilisee'];

                    // Assigner le matériel à l'intervention
                    $assignMaterielQuery = "INSERT INTO materiel_intervention (intervention_id, materiel_id, CodeS, quantite_utilisee) VALUES (?, ?, ?, ?)";
                    $assignMaterielStmt = $mysqli->prepare($assignMaterielQuery);
                    $assignMaterielStmt->bind_param("iiii", $intervention_id, $codeM, $CodeS, $quantite_utilisee);
                    $assignMaterielStmt->execute();
                }
            }
        }

        // Mettre à jour l'état de la réservation
        $updateReservationQuery = "UPDATE reservation SET etat = 'traité' WHERE codeR = ?";
        $updateReservationStmt = $mysqli->prepare($updateReservationQuery);
        $updateReservationStmt->bind_param("i", $codeR);
        $updateReservationStmt->execute();

        $mysqli->commit();

        echo "Intervention préparée avec succès.";
        header('Location: listeReservations.php');
    } catch (Exception $e) {
        $mysqli->rollback();
        echo "Erreur lors de la préparation de l'intervention : " . $e->getMessage();
    }
} else {
    echo "Invalid request method";
}
?>

<?php
// Connexion à la base de données
$mysqli = new mysqli("localhost", "root", "", "GestionSocieteNettoyage");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$codeR = $_GET['codeR'] ?? null;

if (!$codeR) {
    die("CodeR is missing");
}

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST['services'] as $service) {
        if (isset($service['CodeS']) && isset($service['employe_id']) && !empty($service['employe_id'])) {
            $CodeS = $service['CodeS'];
            $employe_id = $service['employe_id'];
            $materiels = $service['materiels'];

            // Insertion dans la table intervention
            $insertInterventionQuery = "
                INSERT INTO intervention (etat, employe_id, codeR) 
                VALUES ('pas encore faite', $employe_id, $codeR)
            ";
            if (!$mysqli->query($insertInterventionQuery)) {
                echo "Erreur: " . $mysqli->error;
            }

            $intervention_id = $mysqli->insert_id;

            // Assigner l'employé et ajouter la tâche
            $assignEmployeQuery = "
                INSERT INTO employe_intervention (intervention_id, employe_id, tache) 
                VALUES ($intervention_id, $employe_id, (SELECT NomS FROM Service WHERE CodeS = $CodeS))
            ";
            if (!$mysqli->query($assignEmployeQuery)) {
                echo "Erreur: " . $mysqli->error;
            }

            // Assigner les matériels
            if (!empty($materiels)) {
                foreach ($materiels as $materiel) {
                    if (isset($materiel['codeM']) && isset($materiel['quantite_utilisee'])) {
                        $codeM = $materiel['codeM'];
                        $quantite_utilisee = $materiel['quantite_utilisee'];
                        $assignMaterielQuery = "
                            INSERT INTO materiel_intervention (intervention_id, materiel_id, quantite_utilisee) 
                            VALUES ($intervention_id, $codeM, $quantite_utilisee)
                        ";
                        if (!$mysqli->query($assignMaterielQuery)) {
                            echo "Erreur: " . $mysqli->error;
                        }
                    }
                }
            }
        }
    }

    echo "Intervention préparée avec succès.";
    // Redirection ou autre traitement après la préparation
    header("Location: listeReservations.php");
    exit();
}

$mysqli->close();
?>

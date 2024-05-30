<?php
session_start();
if(isset($_SESSION['user'])){
        require_once("connexiondb.php");

        $titre = isset($_POST['titre']) ? $_POST['titre'] : "";
        $description = isset($_POST['description']) ? $_POST['description'] : "";
        $type_contrat = isset($_POST['type_contrat']) ? $_POST['type_contrat'] : "";
        $date_debut = isset($_POST['date_debut']) ? $_POST['date_debut'] : "";
        $date_fin = isset($_POST['date_fin']) ? $_POST['date_fin'] : null;
        $competences_requises = isset($_POST['competences_requises']) ? $_POST['competences_requises'] : "";

        // Si le type de contrat est "CDI", on ignore la date de fin
        if ($type_contrat === 'CDI') {
            $date_fin = null;
        }

        $requete = "INSERT INTO offre_demploi (titre, description, type_contrat, date_debut, date_fin, competences_requises) VALUES (?, ?, ?, ?, ?, ?)";
        $params = array($titre, $description, $type_contrat, $date_debut, $date_fin, $competences_requises);

        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);

        header('Location:demandeDemplois.php');
        exit();
    }else {
            header('location:authentification.php');
         }
?>

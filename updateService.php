<?php
session_start();
if(isset($_SESSION['user'])){
        require_once("connexiondb.php");

        $codes = isset($_POST['CodeS']) ? $_POST['CodeS'] : "";
        $noms = isset($_POST['NomS']) ? $_POST['NomS'] : "";
        $types = isset($_POST['TypeS']) ? $_POST['TypeS'] : "";
        $TarifHr = isset($_POST['TarifHr']) ? $_POST['TarifHr'] : "";
        $Duree = isset($_POST['Duree']) ? $_POST['Duree'] : "";
        $Description = isset($_POST['Description']) ? $_POST['Description'] : "";

        $requete = "UPDATE Service SET NomS = ?, TypeS = ?, TarifHr = ?, Duree = ?, Description = ? WHERE CodeS = ?";
        $params = array($noms, $types, $TarifHr, $Duree, $Description, $codes);

        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);

        header('Location: service.php');
    }else {
        header('location:authentification.php');
     }
?>

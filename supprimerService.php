<?php
session_start();
if(isset($_SESSION['user'])){
        require_once("connexiondb.php");

        $codes = isset($_GET['codes']) ? $_GET['codes'] : 0;


            $requete = "DELETE FROM Service WHERE CodeS = ?";
            $params = array($codes);

            $resultat = $pdo->prepare($requete);
            $resultat->execute($params);


        header('Location: service.php');
    }else {
        header('location:authentification.php');
     }

?>

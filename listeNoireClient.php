<?php
session_start();
if(isset($_SESSION['user'])){
        require_once("connexiondb.php");

        $id = isset($_GET['id']) ? $_GET['id'] : 0;

        if ($id > 0) {
            $requete = "UPDATE users SET etat = 0 WHERE id = ?";
            $params = array($id);
            
            $resultat = $pdo->prepare($requete);
            $resultat->execute($params);
        }

        header('location:clients.php');
    }else {
        header('location:authentification.php');
     }
?>

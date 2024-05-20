<?php
require_once("connexiondb.php");

$id = isset($_GET['id']) ? $_GET['id'] : 0;

if ($id > 0) {
    $requete = "UPDATE users SET etat = 1 WHERE id = ?";
    $params = array($id);
    
    $resultat = $pdo->prepare($requete);
    $resultat->execute($params);
}

header('location:clientsnoir.php');
?>

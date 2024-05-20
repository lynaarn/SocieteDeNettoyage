<?php
require_once("connexiondb.php");

$id = isset($_GET['id']) ? $_GET['id'] : 0;

// Requête DELETE pour supprimer l'entrée de la table users et de la table personnel_administratif
$requete = "DELETE users, personnel_administratif
            FROM users
            INNER JOIN personnel_administratif ON users.id = personnel_administratif.id
            WHERE users.id = ?";

$params = array($id);

$resultat = $pdo->prepare($requete);
$resultat->execute($params);

header('Location: personnels.php');
?>

<?php
require_once("connexiondb.php");

// Récupérer le CodeC du commentaire à supprimer à partir de l'URL
$CodeC = isset($_GET['CodeC']) ? $_GET['CodeC'] : 0;

// Requête pour supprimer le commentaire
$requete = "DELETE FROM commentaire WHERE CodeC = ?";
$params = array($CodeC);

// Exécution de la requête
$resultat = $pdo->prepare($requete);
$resultat->execute($params);

// Redirection vers la page des commentaires après suppression
header('Location: commentaires.php');
?>

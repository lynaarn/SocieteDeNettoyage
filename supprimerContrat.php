<?php
require_once("identifier.php");
require_once("connexiondb.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Préparer la requête pour supprimer le contrat
    $requete = $pdo->prepare("DELETE FROM contrat WHERE id_c = ?");
    $requete->execute([$id]);

    // Rediriger vers la page des contrats après la suppression
    header("Location: contrats.php");
    exit();
} else {
    // Rediriger vers la page des contrats si l'ID n'est pas fourni
    header("Location: contrats.php");
    exit();
}
?>

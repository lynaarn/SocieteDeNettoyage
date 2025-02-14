<?php
require_once("identifier.php");
require_once("connexiondb.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $requete = $pdo->prepare("UPDATE contrat SET etat = 'résilié' WHERE id_c = :id");
    $requete->bindParam(':id', $id, PDO::PARAM_INT);

    if ($requete->execute()) {
        header('Location: contrats.php');
        exit();
    } else {
        echo "Erreur lors de la résiliation du contrat.";
    }
} else {
    echo "ID de contrat manquant.";
}
?>

<?php
require_once("connexiondb.php");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Mettre à jour le statut de l'employé à "Licencié"
    $requete = $pdo->prepare("UPDATE employe SET statut = 'Licencié' WHERE id = ?");
    $requete->execute([$id]);

    header("Location: employes.php");
    exit();
}
?>

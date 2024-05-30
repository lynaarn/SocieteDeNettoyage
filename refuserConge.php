<?php
session_start();
if(isset($_SESSION['user'])){
    require_once("connexiondb.php");

    $id = isset($_GET['id']) ? $_GET['id'] : 0;

    try {
        // Mettre à jour le statut de l'arrêt de travail
        $requeteArret = "UPDATE ArretDeTravail SET statut = 'refusé' WHERE NumA = ?";
        $stmtArret = $pdo->prepare($requeteArret);
        $stmtArret->execute([$id]);

        // Redirection vers la page des congés
        header('Location: congés.php');
        exit();
    } catch (Exception $e) {
        echo 'Erreur : ' . $e->getMessage();
    }
} else {
    header('location:authentification.php');
}
?>

<?php
session_start();
if(isset($_SESSION['user'])){
    require_once("connexiondb.php");

    if(isset($_GET['id'])) {
        $id_arret = $_GET['id'];
        
        // Commencer une transaction pour s'assurer que la mise à jour soit atomique
        $pdo->beginTransaction();

        try {
            // Mettre à jour le statut de l'arrêt de travail à "refusé"
            $requeteArret = "UPDATE ArretDeTravail 
                            SET statut = 'refusé' 
                            WHERE NumA = ?";
            $stmtArret = $pdo->prepare($requeteArret);
            $stmtArret->execute([$id_arret]);

            // Commit la transaction
            $pdo->commit();

            header("Location: arrêtDeTravail.php");
        } catch (Exception $e) {
            // En cas d'erreur, rollback la transaction
            $pdo->rollBack();
            echo "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    } else {
        header("Location: arrêtDeTravail.php");
    }
}else {
    header('location:authentification.php');
 }

?>

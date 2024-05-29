<?php
session_start();
if(isset($_SESSION['user'])){
    require_once("connexiondb.php");

    if(isset($_GET['id'])) {
        $id_arret = $_GET['id'];
        
        // Commencer une transaction pour s'assurer que les deux mises à jour soient atomiques
        $pdo->beginTransaction();

        try {
            // Mettre à jour le statut de l'arrêt de travail à "accordé"
            $requeteArret = "UPDATE ArretDeTravail 
                            SET statut = 'accordé' 
                            WHERE NumA = ?";
            $stmtArret = $pdo->prepare($requeteArret);
            $stmtArret->execute([$id_arret]);

            // Récupérer l'id de l'employé à partir de l'arrêt de travail
            $requeteEmploye = "SELECT id FROM ArretDeTravail WHERE NumA = ?";
            $stmtEmploye = $pdo->prepare($requeteEmploye);
            $stmtEmploye->execute([$id_arret]);
            $employe = $stmtEmploye->fetch();
            $id_employe = $employe['id'];

            // Mettre à jour le statut de l'employé à "Démissionnaire"
            $requeteUpdateEmploye = "UPDATE employe 
                                    SET statut = 'Démissionnaire' 
                                    WHERE id = ?";
            $stmtUpdateEmploye = $pdo->prepare($requeteUpdateEmploye);
            $stmtUpdateEmploye->execute([$id_employe]);

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

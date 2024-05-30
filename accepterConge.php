<?php
session_start();
if(isset($_SESSION['user'])){
    require_once("connexiondb.php");

    $id = isset($_GET['id']) ? $_GET['id'] : 0;

    // Récupérer les informations de l'arrêt de travail
    $requete = "SELECT Type, id FROM ArretDeTravail WHERE NumA = ?";
    $stmt = $pdo->prepare($requete);
    $stmt->execute([$id]);
    $arret = $stmt->fetch();

    if ($arret) {
        $type = $arret['Type'];
        $employeId = $arret['id'];

        // Déterminer le nouveau statut de l'employé
        $nouveauStatut = '';
        switch ($type) {
            case 'Congé':
                $nouveauStatut = 'Congé';
                break;
            case 'Maladie':
                $nouveauStatut = 'Maladie';
                break;
            case 'Maternité/Paternité':
                $nouveauStatut = 'Maternité/Paternité';
                break;
        }

        try {
            // Mettre à jour le statut de l'employé
            $requeteEmploye = "UPDATE employe SET statut = ? WHERE id = ?";
            $stmtEmploye = $pdo->prepare($requeteEmploye);
            $stmtEmploye->execute([$nouveauStatut, $employeId]);

            // Mettre à jour le statut de l'arrêt de travail
            $requeteArret = "UPDATE ArretDeTravail SET statut = 'accordé' WHERE NumA = ?";
            $stmtArret = $pdo->prepare($requeteArret);
            $stmtArret->execute([$id]);

            // Redirection vers la page des congés
            header('Location: congés.php');
            exit();
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    } else {
        echo "Arret de travail non trouvé.";
    }
} else {
    header('location:authentification.php');
}
?>

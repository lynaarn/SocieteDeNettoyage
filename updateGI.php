<?php
require_once("identifier.php");
require_once("connexiondb.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_SESSION['user']['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $email = $_POST['email'];
    $date_embauche = $_POST['date_embauche'];

    try {
        $pdo->beginTransaction();

        // Mise à jour de la table users
        $stmt = $pdo->prepare("
            UPDATE users 
            SET nom = :nom, prenom = :prenom, telephone = :telephone, adresse = :adresse, login = :login, password = :password, email = :email 
            WHERE id = :user_id
        ");
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':prenom', $prenom);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':adresse', $adresse);
        $stmt->bindParam(':login', $login);
        $stmt->bindParam(':password', $password);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        // Mise à jour de la table personnel_administratif
        $stmt = $pdo->prepare("
            UPDATE personnel_administratif 
            SET date_embauche = :date_embauche 
            WHERE id = :user_id
        ");
        $stmt->bindParam(':date_embauche', $date_embauche);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        $pdo->commit();

        header('Location: compteGI.php');
    } catch (Exception $e) {
        $pdo->rollBack();
        echo "Erreur lors de la mise à jour du profil : " . $e->getMessage();
    }
}
?>

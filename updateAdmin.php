<?php
require_once("identifier.php");
require_once("connexiondb.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $login = $_POST['login'];
    $password = $_POST['password'];

    $userId = $_SESSION['user']['id'];

    $requete = "
        UPDATE users 
        SET nom = :nom, prenom = :prenom, telephone = :telephone, adresse = :adresse, email = :email, login = :login, password = :password 
        WHERE id = :userId
    ";

    $stmt = $pdo->prepare($requete);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':telephone', $telephone);
    $stmt->bindParam(':adresse', $adresse);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':login', $login);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':userId', $userId);

    if ($stmt->execute()) {
        $_SESSION['user']['nom'] = $nom;
        $_SESSION['user']['prenom'] = $prenom;
        $_SESSION['user']['telephone'] = $telephone;
        $_SESSION['user']['adresse'] = $adresse;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['login'] = $login;
        $_SESSION['user']['password'] = $password;

        header("Location: compteAdmin.php");
    } else {
        echo "Une erreur s'est produite lors de la mise à jour.";
    }
}
?>

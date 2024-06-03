<?php
require_once("identifier.php");
require_once("connexiondb.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userId = $_SESSION['user']['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $login = $_POST['login'];
    $password = $_POST['password'];  // Vous devez hasher le mot de passe avant de le stocker
    $email = $_POST['email'];
    $date_inscription = $_POST['date_inscription'];
    $typeCompte = $_POST['typeCompte'];
    $typeClient = $_POST['typeClient'];

    try {
        $stmt = $pdo->prepare("UPDATE users SET nom = ?, prenom = ?, telephone = ?, adresse = ?, login = ?, password = ?, email = ? WHERE id = ?");
        $stmt->execute([$nom, $prenom, $telephone, $adresse, $login, $password, $email, $userId]);

        $stmt = $pdo->prepare("UPDATE Client SET date_inscription = ?, type_client = ? WHERE id = ?");
        $stmt->execute([$date_inscription, $typeClient, $userId]);

        $_SESSION['user']['nom'] = $nom;
        $_SESSION['user']['prenom'] = $prenom;
        $_SESSION['user']['telephone'] = $telephone;
        $_SESSION['user']['adresse'] = $adresse;
        $_SESSION['user']['login'] = $login;
        $_SESSION['user']['email'] = $email;

        header('Location: compteClient.php');
    } catch (Exception $e) {
        echo 'Erreur lors de la mise à jour du profil : ' . $e->getMessage();
    }
}
?>

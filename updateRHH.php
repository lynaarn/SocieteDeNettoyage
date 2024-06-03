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
    $date_embauche = $_POST['date_embauche'];
    $role = $_POST['role'];
    $user_id = $_SESSION['user']['id'];

    $stmt = $pdo->prepare("UPDATE users 
                           SET nom = ?, prenom = ?, telephone = ?, adresse = ?, email = ?, login = ?, password = ? 
                           WHERE id = ?");
    $stmt->execute([$nom, $prenom, $telephone, $adresse, $email, $login, $password, $user_id]);

    $stmt = $pdo->prepare("UPDATE personnel_administratif 
                           SET date_embauche = ?, role = (SELECT numR FROM roles WHERE nomR = ?) 
                           WHERE id = ?");
    $stmt->execute([$date_embauche, $role, $user_id]);

    if ($stmt) {
        $_SESSION['user']['nom'] = $nom;
        $_SESSION['user']['prenom'] = $prenom;
        $_SESSION['user']['telephone'] = $telephone;
        $_SESSION['user']['adresse'] = $adresse;
        $_SESSION['user']['email'] = $email;
        $_SESSION['user']['login'] = $login;
        $_SESSION['user']['password'] = $password;

        header("Location: compteRHH.php");
    } else {
        echo "Une erreur s'est produite lors de la mise à jour.";
    }
}
?>

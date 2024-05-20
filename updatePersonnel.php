<?php
require_once("connexiondb.php");

$id = isset($_POST['id']) ? $_POST['id'] : "";
$nom = isset($_POST['nom']) ? $_POST['nom'] : "";
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$telephone = isset($_POST['telephone']) ? $_POST['telephone'] : "";
$adresse = isset($_POST['adresse']) ? $_POST['adresse'] : "";
$login = isset($_POST['login']) ? $_POST['login'] : "";
$etat = isset($_POST['etat']) ? $_POST['etat'] : "";
$role = isset($_POST['role']) ? $_POST['role'] : "";
$date_embauche = isset($_POST['date_embauche']) ? $_POST['date_embauche'] : "";

$requete = "UPDATE users 
            SET nom = ?, prenom = ?, email = ?, telephone = ?, adresse = ?, login = ?, etat = ?, role = ? 
            WHERE id = ?";
$params = array($nom, $prenom, $email, $telephone, $adresse, $login, $etat, $role, $id);

$resultat = $pdo->prepare($requete);
$resultat->execute($params);

$requetePersonnel = "UPDATE personnel_administratif 
                     SET date_embauche = ? 
                     WHERE id = ?";
$paramsPersonnel = array($date_embauche, $id);

$resultatPersonnel = $pdo->prepare($requetePersonnel);
$resultatPersonnel->execute($paramsPersonnel);

header('Location: personnels.php');
?>

<?php
require_once("connexiondb.php");

$nom = isset($_POST['nom']) ? $_POST['nom'] : "";
$prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
$email = isset($_POST['email']) ? $_POST['email'] : "";
$telephone = isset($_POST['telephone']) ? $_POST['telephone'] : "";
$adresse = isset($_POST['adresse']) ? $_POST['adresse'] : "";
$login = isset($_POST['login']) ? $_POST['login'] : "";
$password = isset($_POST['password']) ? $_POST['password'] : "";
$role = isset($_POST['role']) ? $_POST['role'] : "";
$date_embauche = isset($_POST['date_embauche']) ? $_POST['date_embauche'] : "";

$requete = "INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, role)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$params = array($nom, $prenom, $email, $telephone, $adresse, $login, $password, $role);
$resultat = $pdo->prepare($requete);
$resultat->execute($params);

// Récupérer l'ID de l'utilisateur inséré
$id_utilisateur = $pdo->lastInsertId();

$requete_personnel = "INSERT INTO personnel_administratif (id, date_embauche)
                      VALUES (?, ?)";
$params_personnel = array($id_utilisateur, $date_embauche);
$resultat_personnel = $pdo->prepare($requete_personnel);
$resultat_personnel->execute($params_personnel);

header('location:personnels.php');
?>

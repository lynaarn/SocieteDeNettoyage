<?php
session_start();
if(isset($_SESSION['user'])){
        require_once("connexiondb.php");

        // Récupération des valeurs du formulaire
        $nom = isset($_POST['nom']) ? $_POST['nom'] : "";
        $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : "";
        $adresse = isset($_POST['adresse']) ? $_POST['adresse'] : "";
        $login = isset($_POST['login']) ? $_POST['login'] : "";
        $password =isset($_POST['password']) ? $_POST['password'] : "";
        $role = isset($_POST['role']) ? $_POST['role'] : "";
        $date_embauche = isset($_POST['date_embauche']) ? $_POST['date_embauche'] : "";

        // Insertion dans la table `users`
        $requete = "INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, etat) VALUES (?, ?, ?, ?, ?, ?, ?, 1)";
        $params = array($nom, $prenom, $email, $telephone, $adresse, $login, $password);
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);
        $id_utilisateur = $pdo->lastInsertId();

        // Insertion dans la table `personnel_administratif`
        $requete_personnel = "INSERT INTO personnel_administratif (id, date_embauche, role) VALUES (?, ?, ?)";
        $params_personnel = array($id_utilisateur, $date_embauche, $role);
        $resultat_personnel = $pdo->prepare($requete_personnel);
        $resultat_personnel->execute($params_personnel);

        header('Location: personnels.php');
    }else {
        header('location:authentification.php');
     }
?>

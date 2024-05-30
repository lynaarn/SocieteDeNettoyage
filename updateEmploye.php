<?php
session_start();
if(isset($_SESSION['user'])){
        require_once("connexiondb.php");

        $id = isset($_POST['id']) ? $_POST['id'] : "";
        $nom = isset($_POST['nom']) ? $_POST['nom'] : "";
        $prenom = isset($_POST['prenom']) ? $_POST['prenom'] : "";
        $email = isset($_POST['email']) ? $_POST['email'] : "";
        $telephone = isset($_POST['telephone']) ? $_POST['telephone'] : "";
        $adresse = isset($_POST['adresse']) ? $_POST['adresse'] : "";
        $login = isset($_POST['login']) ? $_POST['login'] : "";
        $etat = isset($_POST['etat']) ? $_POST['etat'] : "";
        $date_embauche = isset($_POST['date_embauche']) ? $_POST['date_embauche'] : "";
        $statut = isset($_POST['statut']) ? $_POST['statut'] : "";
        $salaire = isset($_POST['salaire']) ? $_POST['salaire'] : "";

        try {
            // Mise à jour des informations de l'utilisateur dans la table users
            $requete = "UPDATE users 
                        SET nom = ?, prenom = ?, email = ?, telephone = ?, adresse = ?, login = ?, etat = ? 
                        WHERE id = ?";
            $params = array($nom, $prenom, $email, $telephone, $adresse, $login, $etat, $id);

            $resultat = $pdo->prepare($requete);
            $resultat->execute($params);

            // Mise à jour des informations de l'employé dans la table employe
            $requeteEmploye = "UPDATE employe 
                                SET date_embauche = ?, statut = ?, salaire = ? 
                                WHERE id = ?";
            $paramsEmploye = array($date_embauche, $statut, $salaire, $id);

            $resultatEmploye = $pdo->prepare($requeteEmploye);
            $resultatEmploye->execute($paramsEmploye);

            // Redirection vers la page des employés
            header('Location: employes.php');
            exit();
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }else {
        header('location:authentification.php');
     }
?>

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
        $role = isset($_POST['role']) ? $_POST['role'] : "";
        $date_embauche = isset($_POST['date_embauche']) ? $_POST['date_embauche'] : "";

        try {
            // Mise à jour des informations de l'utilisateur dans la table users
            $requete = "UPDATE users 
                        SET nom = ?, prenom = ?, email = ?, telephone = ?, adresse = ?, login = ?, etat = ? 
                        WHERE id = ?";
            $params = array($nom, $prenom, $email, $telephone, $adresse, $login, $etat, $id);

            $resultat = $pdo->prepare($requete);
            $resultat->execute($params);

            // Mise à jour des informations du personnel administratif dans la table personnel_administratif
            $requetePersonnel = "UPDATE personnel_administratif 
                                SET date_embauche = ?, role = ? 
                                WHERE id = ?";
            $paramsPersonnel = array($date_embauche, $role, $id);

            $resultatPersonnel = $pdo->prepare($requetePersonnel);
            $resultatPersonnel->execute($paramsPersonnel);

            // Redirection vers la page des personnels
            header('Location: personnels.php');
            exit();
        } catch (Exception $e) {
            echo 'Erreur : ' . $e->getMessage();
        }
    }else {
        header('location:authentification.php');
     }
?>

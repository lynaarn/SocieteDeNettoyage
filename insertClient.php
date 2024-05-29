<?php
 session_start();
 if(isset($_SESSION['user'])){
   
        require_once("connexiondb.php");

        $nomclient = isset($_POST['nomclient']) ? $_POST['nomclient'] : "";
        $prenomclient = isset($_POST['prenomclient']) ? $_POST['prenomclient'] : "";
        $emailClient = isset($_POST['emailClient']) ? $_POST['emailClient'] : "";
        $telClient = isset($_POST['telClient']) ? $_POST['telClient'] : "";
        $adresseClient = isset($_POST['adresseClient']) ? $_POST['adresseClient'] : "";
        $loginClient = isset($_POST['loginClient']) ? $_POST['loginClient'] : "";
        $passwordClient = isset($_POST['passwordClient']) ? $_POST['passwordClient'] : "";
        $dateInscription = isset($_POST['dateInscription']) ? $_POST['dateInscription'] : "";
        $typeClient = isset($_POST['typeClient']) ? $_POST['typeClient'] : "";

        $requete_user = "INSERT INTO users (nom, prenom, email, telephone, adresse, login, password)
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $params_user = array($nomclient, $prenomclient, $emailClient, $telClient, $adresseClient, $loginClient, $passwordClient);

        $resultat_user = $pdo->prepare($requete_user);
        $resultat_user->execute($params_user);

        // Récupérer l'ID du client inséré
        $id_client = $pdo->lastInsertId();

        $requete_client = "INSERT INTO Client (id, date_inscription, type_client)
                        VALUES (?, ?, ?)";
        $params_client = array($id_client, $dateInscription, $typeClient);

        $resultat_client = $pdo->prepare($requete_client);
        $resultat_client->execute($params_client);

        header('location:clients.php');
 }else {
    header('location:authentification.php');
 }
?>

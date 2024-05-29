<?php
session_start();
if(isset($_SESSION['user'])){
    // Inclure le fichier de connexion à la base de données
    require_once("connexiondb.php");

    // Vérifier si l'identifiant de l'employé à supprimer est passé en paramètre GET
    if(isset($_GET['id'])) {
        // Récupérer l'identifiant de l'employé à supprimer
        $id = $_GET['id'];

        // Requête pour supprimer l'employé
        $requete = "DELETE users, employe
        FROM users
        INNER JOIN employe ON users.id = employe.id
        WHERE users.id = ?";
        $params = array($id);

        // Exécution de la requête
        $resultat = $pdo->prepare($requete);
        $resultat->execute($params);

        // Redirection vers la page des employés
        header('Location: employes.php');
    } else {
        // Redirection vers la page des employés si aucun identifiant n'est spécifié
        header('Location: employes.php');
    }
}else {
    header('location:authentification.php');
 }
?>

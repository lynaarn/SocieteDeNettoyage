<?php
require_once("identifier.php");
require_once("connexiondb.php");

if ($_SESSION['user']['TypeCompte'] == 'Client') {
    $id_contrat = isset($_GET['id']) ? $_GET['id'] : 0;
    $id_client = $_SESSION['user']['id'];

    $requete = $pdo->prepare("UPDATE contrat SET etat = 'résilié' WHERE id_c = :id_contrat AND client_id = :id_client AND etat = 'actif'");
    $requete->execute(['id_contrat' => $id_contrat, 'id_client' => $id_client]);

    header('Location: consultercontrat.php');
    exit();
} else {
    header('Location: authentification.php');
    exit();
}
?>

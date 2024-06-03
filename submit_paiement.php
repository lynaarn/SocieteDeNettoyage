<?php
require_once("identifier.php");
require_once("connexiondb.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date_paiement = $_POST['date_paiement'];
    $montant = $_POST['montant'];
    $etat_paiement = $_POST['etat_paiement'];
    $contrat_id = $_POST['contrat_id'];

    // Préparer et exécuter la requête d'insertion
    $requeteInsert = "INSERT INTO paiement (date_paiement, montant, etat_paiement, contrat_id) VALUES (:date_paiement, :montant, :etat_paiement, :contrat_id)";
    $stmtInsert = $pdo->prepare($requeteInsert);
    $stmtInsert->execute([
        'date_paiement' => $date_paiement,
        'montant' => $montant,
        'etat_paiement' => $etat_paiement,
        'contrat_id' => $contrat_id
    ]);

    // Rediriger vers la page de suivi des paiements avec le même contrat_id
    header("Location: suivrepaiment.php?id=$contrat_id");
    exit();
}
?>

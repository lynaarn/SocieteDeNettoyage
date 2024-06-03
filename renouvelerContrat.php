<?php
require_once("identifier.php");
require_once("connexiondb.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $contratId = $_POST['id'];
    $nouvelleDateDeb = $_POST['nouvelleDateDeb'];
    $nouvelleDateFin = $_POST['nouvelleDateFin'];

    $requete = "UPDATE contrat 
                SET date_deb = ?, date_fin = ?, etat = 'en attente de preparation' 
                WHERE id_c = ?";
    $stmt = $pdo->prepare($requete);
    $stmt->execute([$nouvelleDateDeb, $nouvelleDateFin, $contratId]);

    echo "success";
}
?>

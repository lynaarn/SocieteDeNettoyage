<?php
require_once("identifier.php");
require_once("connexiondb.php");

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user_id = $_POST['id'];

    try {
        // Commencer une transaction
        $pdo->beginTransaction();

        // Supprimer le client de la table Client
        $stmt = $pdo->prepare("DELETE FROM Client WHERE id = :client_id");
        $stmt->bindParam(':client_id', $user_id);
        $stmt->execute();

        // Supprimer le client de la table users
        $stmt = $pdo->prepare("DELETE FROM users WHERE id = :user_id");
        $stmt->bindParam(':user_id', $user_id);
        $stmt->execute();

        // Valider la transaction
        $pdo->commit();

        echo json_encode(['success' => true]);
    } catch (Exception $e) {
        // En cas d'erreur, annuler la transaction
        $pdo->rollBack();
        echo json_encode(['success' => false, 'message' => 'Erreur lors de la suppression du compte']);
    }
}
?>

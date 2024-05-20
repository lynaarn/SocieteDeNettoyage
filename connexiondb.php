<?php
try {
    $pdo = new PDO("mysql:host=localhost;dbname=GestionSocieteNettoyage", "root", "");
} catch (PDOException $e) {
    die('Erreur de connexion : ' . $e->getMessage());
}
?>

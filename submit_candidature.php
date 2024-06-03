<?php
$servername = "localhost"; // Nom de l'hôte
$username = "candidature_user"; // Nom d'utilisateur de la base de données avec privilèges limités
$password = "your_password"; // Mot de passe de la base de données
$dbname = "votre_nom_base_de_donnees"; // Nom de la base de données

// Créer la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Créer la table si elle n'existe pas
$sql = "CREATE TABLE IF NOT EXISTS candidature (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    experience TEXT NOT NULL,
    education TEXT NOT NULL
)";
$conn->query($sql);

// Préparer et lier
$stmt = $conn->prepare("INSERT INTO candidature (nom, prenom, age, experience, education) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssiss", $nom, $prenom, $age, $experience, $education);

// Récupérer les données du formulaire
$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$age = $_POST['age'];
$experience = $_POST['experience'];
$education = $_POST['education'];

// Exécuter la requête
if ($stmt->execute()) {
    echo "Nouvelle candidature ajoutée avec succès";
} else {
    echo "Erreur: " . $stmt->error;
}

// Fermer la connexion
$stmt->close();
$conn->close();
?>

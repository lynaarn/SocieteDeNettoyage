<?php
session_start();
if (isset($_SESSION['user'])) {
    require_once('connexiondb.php');

    try {
        // Récupérer les données du formulaire
        $nom = isset($_POST['nomEmploye']) ? $_POST['nomEmploye'] : '';
        $prenom = isset($_POST['prenomEmploye']) ? $_POST['prenomEmploye'] : '';
        $adresse = isset($_POST['adresseEmploye']) ? $_POST['adresseEmploye'] : '';
        $telephone = isset($_POST['telEmploye']) ? $_POST['telEmploye'] : '';
        $email = isset($_POST['emailEmploye']) ? $_POST['emailEmploye'] : '';
        $login = isset($_POST['loginEmploye']) ? $_POST['loginEmploye'] : '';
        $password = isset($_POST['mdpEmploye']) ?$_POST['mdpEmploye'] : ''; 
        $salaire = isset($_POST['salaireEmploye']) ? $_POST['salaireEmploye'] : 0;
        $date_embauche = isset($_POST['dateEmbaucheEmploye']) ? $_POST['dateEmbaucheEmploye'] : '';
        $competences = isset($_POST['competences']) ? explode(',', $_POST['competences']) : [];

        // Commencer une transaction
        $pdo->beginTransaction();

        // Insérer les données dans la table users
        $sql_users = "INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat) VALUES (?, ?, ?, ?, ?, ?, ?, 'Employe', 1)";
        $stmt_users = $pdo->prepare($sql_users);
        $stmt_users->execute([$nom, $prenom, $email, $telephone, $adresse, $login, $password]);

        // Récupérer l'id du nouvel utilisateur
        $user_id = $pdo->lastInsertId();

        // Insérer les données dans la table employe
        $sql_employe = "INSERT INTO employe (id, date_embauche, salaire) VALUES (?, ?, ?)";
        $stmt_employe = $pdo->prepare($sql_employe);
        $stmt_employe->execute([$user_id, $date_embauche, $salaire]);

        // Insérer les compétences dans la table de liaison (employe_competence)
        foreach ($competences as $competence_id) {
            $sql_competence = "INSERT INTO employe_competence (employe_id, competence_id) VALUES (?, ?)";
            $stmt_competence = $pdo->prepare($sql_competence);
            $stmt_competence->execute([$user_id, $competence_id]);
        }

        // Valider la transaction
        $pdo->commit();

        // Redirection vers la page des employés
        header('Location: Employes.php');
        exit();
    } catch (Exception $e) {
        // Annuler la transaction en cas d'erreur
        $pdo->rollBack();
        echo 'Erreur : ' . $e->getMessage();
    }
} else {
    header('location:authentification.php');
}
?>

<?php
require_once("connexiondb.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['num_tel'];
    $adresse = $_POST['adresse'];
    $email = $_POST['username'];
    $login = $_POST['login'];
    $password = $_POST['password'];
    $type_client = $_POST['type_client'];
    $date_inscription = date('Y-m-d');

    try {
        // Commencer une transaction
        $pdo->beginTransaction();

        // Insérer les données dans la table users
        $stmt = $pdo->prepare("
            INSERT INTO users (nom, prenom, email, telephone, adresse, login, password, TypeCompte, etat)
            VALUES (?, ?, ?, ?, ?, ?, ?, 'Client', 1)
        ");
        $stmt->execute([$nom, $prenom, $email, $telephone, $adresse, $login, $password]);

        // Récupérer l'ID de l'utilisateur nouvellement créé
        $user_id = $pdo->lastInsertId();

        // Insérer les données dans la table Client
        $stmt = $pdo->prepare("
            INSERT INTO Client (id, date_inscription, type_client)
            VALUES (?, ?, ?)
        ");
        $stmt->execute([$user_id, $date_inscription, $type_client]);

        // Valider la transaction
        $pdo->commit();
        echo "Compte créé avec succès !";
    } catch (Exception $e) {
        // Annuler la transaction en cas d'erreur
        $pdo->rollBack();
        echo "Erreur : " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer compte</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url(../images/36.jpg);
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }
        .form-container {
            margin: 50px auto;
            max-width: 800px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .imgg {
            width: 30%;
            margin: 0 auto 20px auto;
            display: block;
        }
        .titre {
            font-weight: bold;
            color: #2774AE;
        }
        .form-group i {
            margin-right: 10px;
            color: #2774AE;
        }
        .modal-footer {
            align-items: center;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="form-container">
        <div class="imgg">
            <img src="images/logoo.png" alt="Logo">
        </div>
        <h2 class="text-center mb-4 titre">Créer un compte</h2>
        <form method="POST" action="">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nom"><i class="fas fa-user"></i>Nom</label>
                    <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrez votre nom" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="prenom"><i class="fas fa-user"></i>Prénom</label>
                    <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrez votre prénom" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="num_tel"><i class="fas fa-phone"></i>Numéro de téléphone</label>
                    <input type="tel" class="form-control" id="num_tel" name="num_tel" placeholder="Entrez votre numéro de téléphone" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="adresse"><i class="fas fa-map-marker-alt"></i>Adresse</label>
                    <input type="text" class="form-control" id="adresse" name="adresse" placeholder="Entrez votre adresse" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="username"><i class="fas fa-envelope"></i>Email</label>
                    <input type="email" class="form-control" id="username" name="username" placeholder="Entrez votre email" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="login"><i class="fas fa-user"></i>Login</label>
                    <input type="text" class="form-control" id="login" name="login" placeholder="Entrez votre login" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password"><i class="fas fa-unlock-alt"></i>Mot de passe</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Entrez votre mot de passe" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="confirm_password"><i class="fas fa-unlock-alt"></i>Confirmer le mot de passe</label>
                    <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirmer votre mot de passe" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="type_client"><i class="fas fa-user-tag"></i>Type de client</label>
                    <select class="form-control" id="type_client" name="type_client" required>
                        <option value="Particulier">Particulier</option>
                        <option value="Entreprise">Entreprise</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success">Valider</button>
                <button type="reset" class="btn btn-danger">Annuler</button>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

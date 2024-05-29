<?php
require_once("identifier.php");
?>
<?php 
 if ($_SESSION['user']['TypeCompte']=='Client') {?>
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
        <form>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="nom"><i class="fas fa-user"></i>Nom</label>
                    <input type="text" class="form-control" id="nom" placeholder="Entrez votre nom" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="prenom"><i class="fas fa-user"></i>Prénom</label>
                    <input type="text" class="form-control" id="prenom" placeholder="Entrez votre prénom" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="num_tel"><i class="fas fa-phone"></i>Numéro de téléphone</label>
                    <input type="tel" class="form-control" id="num_tel" placeholder="Entrez votre numéro de téléphone" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="adresse"><i class="fas fa-map-marker-alt"></i>Adresse</label>
                    <input type="text" class="form-control" id="adresse" placeholder="Entrez votre adresse" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="username"><i class="fas fa-envelope"></i>Email</label>
                    <input type="email" class="form-control" id="username" placeholder="Entrez votre email" required>
                </div>
                <div class="form-group col-md-6">
                    <label for="password"><i class="fas fa-unlock-alt"></i>Mot de passe</label>
                    <input type="password" class="form-control" id="password" placeholder="Entrez votre mot de passe" required>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="confirm_password"><i class="fas fa-unlock-alt"></i>Confirmer le mot de passe</label>
                    <input type="password" class="form-control" id="confirm_password" placeholder="Confirmer votre mot de passe" required>
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
<?php } ?> 


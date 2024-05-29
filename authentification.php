<?php
session_start();
if(isset($_SESSION['error'])) { 
    
    $erreur = $_SESSION['error'];}
     
else{
    $erreur ="";
}
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Authentification</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />

    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url(../images/36.jpg);
            background-size: cover;
            background-repeat: no-repeat;
        }
        .form-container {
            width: 100%;
            max-width: 500px;
            padding: 20px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .imgg {
            width: 40%;
            margin: 0 auto;
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
        .couleur {
            background-color: #4682B4;
            color: white;
        }
        .couleur:hover {
            background-color: #5a9bd4;
        }
        .modal-footer {
            display: flex;
            justify-content: space-between;
            align-items:center;
        }
        .nav-link {
            color: #2774AE;
        }
        .nav-link:hover {
            text-decoration: underline;
        }
        
    </style>
</head>
<body>
    
<div class="auth-container">
    <div class="form-container">
        <div class="imgg">
            <img src="images/logoo.png" alt="Logo">
        </div>
        <h2 class="text-center mb-4 titre">Se connecter</h2>
        <form method="post" action="seConnecter.php">
      <?php if(!empty($erreur)) { ?>
            <div class="alert alert-danger"> 
                   <?php echo $erreur ?>  
            </div>
       <?php } ?>
            <div class="form-group">
                <label for="username"><i class="fas fa-envelope"></i>Email/Login</label>
                <input type="text" name="login" class="form-control"  placeholder="Entrez votre email" required>
            </div>
            <div class="form-group">
                <label for="password"><i class="fas fa-unlock-alt"></i>Mot de passe</label>
                <input type="password" class="form-control" name="pwd" placeholder="Entrez votre mot de passe" required>
            </div>
            <div class="modal-footer">
                
                <button type="submit" class="btn couleur">Se connecter</button>
                <a class="nav-link compte" href="creationcompte.php">Créer un compte</a>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

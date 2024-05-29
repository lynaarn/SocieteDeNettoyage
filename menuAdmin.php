<?php
require_once("identifier.php");
?>
<?php 
 if ($_SESSION['user']['TypeCompte']=='Admin') {?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capiclean</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color:#F2F8FE;
        }
        .content {
            margin-top: 80px;
            text-align: center;
        }
        .links a {
            display: block;
            margin-bottom: 10px;
            color: #333;
            text-decoration: none;
            
        }
        .links a:hover {
            color: #E5F1FE;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light fixed-top custom-navbar">
  <div class="container"> 
    <a class="navbar-brand" href="index.html"><img src="images/logoo.png" alt="Capiclean Logo "></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent"> 
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="service.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="clients.php">Clients</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="personnels.php">Personnels</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contrats.php">Contrats</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="paiement.php">Paiements</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="commentaires.php">Commentaires</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="compteAdmin.php"><i class="fas fa-user fa-lg"></i></a> 
        </li>
        <li class="nav-item">
          <a class="nav-link" href="deconnexionClient.php">Deconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>
<div class="container content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                <div class="links">
                    <a href="service.php" class="btn btn-primary btn-block mb-2">Gérer services</a>
                    <a href="clients.php" class="btn btn-primary btn-block mb-2">Gérer clients</a>
                    <a href="personnels.php" class="btn btn-primary btn-block mb-2">Gérer personnels</a>
                    <a href="contrats.php" class="btn btn-primary btn-block mb-2">Gérer contrats</a>
                    <a href="paiement.php" class="btn btn-primary btn-block mb-2">Gérer paiements</a>
                    <a href="commentaires.php" class="btn btn-primary btn-block">Gérer commentaires</a>
                </div>
            </div>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php } ?>
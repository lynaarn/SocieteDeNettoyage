<?php
require_once("identifier.php");
?>

<?php 
if ($_SESSION['user']['TypeCompte'] == 'Client') {
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Client</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color: #F2F8FE;
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
    <a class="navbar-brand" href="index.html"><img src="images/logoo.png" alt="Capiclean Logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="prestationsClient.php">Préstations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contratsClients.php">Contrats</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="commentairesClients.php">Commentaires</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="compteClient.php"><i class="fas fa-user fa-lg"></i></a> 
        </li>
        <li class="nav-item">
          <a class="nav-link" href="deconnexionClient.php">Déconnexion</a>
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
                    <a href="contratsClients.php" class="btn btn-primary btn-block mb-2">Gérer mon contrat</a>
                    <a href="commentairesClients.php" class="btn btn-primary btn-block mb-2">Laisser un commentaire</a>
                    <a href="consulterCommentaires.php" class="btn btn-primary btn-block mb-2">Consulter mes commentaires</a>
                    <a href="gererReservationsPrestations.php" class="btn btn-primary btn-block mb-2">Gérer mes réservations et prestations</a>
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
<?php 
}
?>

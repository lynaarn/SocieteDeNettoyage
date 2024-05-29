<?php
require_once("identifier.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capiclean</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    
  
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
        <li class="nav-item active">
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


<div class="container mt-5 custom-container">
    <div class="row justify-content-center">
    <div class="photo4"><img src="images/18.jpg" /></div>
        <div class="col-md-6">
       
            <h2 class="text-center mb-4 center-text2 ">Ajouter un contrat</h2>
           
            <form>
            <div class="form-group">
    <label for="codeService" class="form-label">Code contrat</label>
    <input type="number" class="form-control form-input" id="codecontratl" placeholder="Entrez le code du contrat">
</div>

<div class="form-group">
        <label for="codeClient" class="form-label">Code Client</label>
        <input type="number" class="form-control form-input" id="codeClient" placeholder="Entrez le code du client">
    </div>
    <div class="form-group">
        <label for="dateDebut" class="form-label">Date de début</label>
        <input type="date" class="form-control form-input" id="dateDebut">
    </div>
    <div class="form-group" >
        <label for="dateFin" class="form-label">Date de fin</label>
        <input type="date" class="form-control form-input" id="dateFin">
    </div>
    <div class="form-group">
        <label for="montantTotal" class="form-label">Montant total</label>
        <input type="number" class="form-control form-input" id="montantTotal" placeholder="Entrez le montant total">
    </div>



                <button type="submit" class="btn btn-success btn-send">Envoyer</button>
            </form>
        </div>
    </div>
</div>





<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

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
    <title>Ajouter service</title>

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
        <li class="nav-item active">
          <a class="nav-link" href="service.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="clients.php">Clients</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="personnels.php">Personnels</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menucontrat.php">Contrats</a>
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
    <div class="photo4"><img src="images/14.jpg" /></div>
        <div class="col-md-6">
       
            <h2 class="text-center mb-4 center-text2 ">Ajouter un Service</h2>
           
            <form method="post" action="insertService.php">
            <div class="form-group">
</div>
<div class="form-group">
    <label for="nomService" class="form-label">Nom Service</label>
    <input name="NomS" type="text" class="form-control form-input" id="nomService" placeholder="Entrez le nom du service">
</div>
<div class="form-group">
                    <label for="typeService" class="form-label">Type Service</label>
                    <select class="form-control form-input" id="typeService" name="TypeS" required>
                        <option value="" selected disabled>Sélectionner un type de service</option>
                        <option value="Nettoyage Résidentiel">Nettoyage Résidentiel</option>
                        <option value="Nettoyage Commercial">Nettoyage Commercial</option>
                        <option value="Nettoyage Industriel">Nettoyage Industriel</option>
                        <option value="Autres Services">Autres Services</option>
                    </select>
                </div>
<div class="form-group">
    <label for="tarif" class="form-label">TarifHeure (en dinars)</label>
    <input name="TarifHr" type="number" class="form-control form-input" id="tarif" placeholder="Entrez le tarif" min="0" step="1000">
</div>
<div class="form-group">
    <label for="duree" class="form-label">Durée (en heures)</label>
    <input name="Duree" type="number" class="form-control form-input" id="duree" placeholder="Entrez la durée" min="0" max="24">
</div>
<div class="form-group">
    <label for="description" class="form-label">Description</label>
    <textarea name="Description" class="form-control form-input" id="description" rows="3" placeholder="Entrez la description"></textarea>
</div>


                <button type="submit" class="btn btn-success btn-send">Enregistrer</button>
            </form>
        </div>
    </div>
</div>





<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php } ?> 
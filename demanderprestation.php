<?php
require_once("identifier.php");
?>
<?php 
 if ($_SESSION['user']['TypeCompte']=='Client') {?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande de Prestation</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <style>
      
        body {
            background-color: #f8f9fa;
        }
        .content {
            margin-top: 80px;
        }
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 30px;
        }
        .form-group {
            margin-bottom: 15px; /* Reduced margin */
        }
        .btn-group {
            display: flex;
            justify-content: space-between;
        }
        .btn-validate {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-cancel {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        textarea {
            height: 80px; /* Reduced height */
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
      <ul class="navbar-nav">
        <li class="nav-item ">
          <a class="nav-link active" href="prestationsClient.php">Préstations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contratsClients.php">Contrats</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="commentairesClients.php">commentaires</a>
        </li>
        <li class="nav-item1  ">
        <a class="nav-link" href="compteClient.php"><i class="fas fa-user fa-lg"></i></a>

        </li>
        <li class="nav-item ">
        <a class="nav-link" href="deconnexionClient.php">Deconnexion</a>

        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="container content">
    <div class="row justify-content-center">
        <div class="col-md-8"> 
            <div class="form-container">
                <h3 class="text-center txt mb-4">Demande de Prestation</h3>
                <form action="demande_prestation.php" method="post">
                    <div class="form-group">
                        <label for="date">Date de la prestation</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="service">Service souhaité</label>
                        <select class="form-control" id="service" name="service" required>
                            <option value="nettoyage_residantiel">Nettoyage résidentiel</option>
                            <option value="nettoyage_industriel">Nettoyage industriel</option>
                            <option value="nettoyage_commercial">Nettoyage commercial</option>
                            <option value="autre_service">Autre service</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nombre_heures">Nombre d'heures</label>
                        <input type="number" class="form-control" id="nombre_heures" name="nombre_heures" required min="1">
                    </div>
                    <div class="form-group">
                        <label for="superficie">Superficie (en m²)</label>
                        <input type="number" class="form-control" id="superficie" name="superficie" required min="1">
                    </div>
                    <div class="form-group">
                        <label for="adresse">Adresse</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" required>
                    </div>
                    <div class="form-group">
                        <label for="commentaires">Commentaires supplémentaires</label>
                        <textarea class="form-control" id="commentaires" name="commentaires" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Valider</button>
              <button type="button" class="btn btn-danger ml-2">Annuler</button>
                    </div>
             
            
    
                </form>
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
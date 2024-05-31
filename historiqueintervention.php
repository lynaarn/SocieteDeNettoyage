<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>interventions</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    
   
    <style>
        body {
            background-color: #f8f9fa;
        }
        .content {
            margin-top: 20px;
        }
        .card {
            margin-bottom: 20px;
            margin-top: 20px;
            border-radius: 5%;
        }
        .card img {
            margin-top: 10px;
            height: 150px;
           
            object-fit: cover;
            border-radius: 5%;
        }
        .card-title {
            font-size: 1.2em;
            font-weight: bold;
            text-align: center;
        }
        .card-text {
            text-align: center;
            font-size: 1em;
            color: #555;
            background-color: antiquewhite;
            
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
          <a class="nav-link " href="demission.php">Démission</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link " href="menuconge.php">Congés</a>
        </li>
        <li class="nav-item active ">
          <a class="nav-link" href="historiqueintervention.php">Historique interventions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tacheethoraire.php">attribution tâche et horraire</a>
        </li>
        <li class="nav-item  ">
            <a class="nav-link" href="compteEmploye.php"><i class="fas fa-user fa-lg ml-5"></i></a> 
        </li>
        <li class="nav-item ">
            <a class="nav-link ml-2" href="deconnexionClient.php">Deconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<h2 class="center-text main-title"> Mon historique d'interventions </h2>
<div class="container content">

    <div class="row">
      
        <div class="col-md-4">
            <div class="card">
            <p class="card-text"> 2024-05-20</p>
            <h5 class="card-title">Nettoyage de bureaux</h5>
                <img src="images/33.jpg" class="card-img-top" alt="Prestation 1">
                <div class="card-body">
         
                    <p class="card-text"><strong>Superficie:</strong> 300 m²</p>
                    <p class="card-text"><strong>Nombre d'heures passés:</strong> 4h</p>
                    <p class="card-text"><strong>tâche accomplie:</strong> nettoyage des vitres</p>
                    <div class="col-md-6 text-center">
            <a href="#" class="btn ajout mb-3">Voir plus</a>
        </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
            <p class="card-text"><strong>Date:</strong> 2024-04-21</p>
            <h5 class="card-title">Nettoyage résidentiel</h5>
                <img src="images/27.jpg" class="card-img-top" alt="Prestation 2">
                <div class="card-body">
                   
                   
                    <p class="card-text"><strong>Superficie:</strong> 200 m²</p>
                    <p class="card-text"><strong>Nombre d'heures passés:</strong> 2h</p>
                    <p class="card-text"><strong>tâche accomplie:</strong> nettoyage du sol</p>
                    <div class="col-md-6 text-center">
            <a href="#" class="btn ajout mb-3">Voir plus</a>
        </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
            <p class="card-text"><strong>Date:</strong> 2024-03-22</p>
            <h5 class="card-title">Nettoyage industriel </h5>
                <img src="images/34.jpg" class="card-img-top" alt="Prestation 3">
                <div class="card-body">
                   
                    
                    <p class="card-text"><strong>Superficie:</strong> 500 m²</p>
                    <p class="card-text"><strong>Nombre d'heures passés:</strong> 5h</p>
                    <p class="card-text"><strong>tâche accomplie:</strong> nettoyage des machines et équipements </p>
                    <div class="col-md-6 text-center">
            <a href="#" class="btn ajout mb-3">Voir plus</a>
        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
            <p class="card-text"><strong>Date:</strong> 2024-03-10</p>
            <h5 class="card-title">Désinfectation</h5>
                <img src="images/28.jpg" class="card-img-top" alt="Prestation 4">
                <div class="card-body">
                  
                    
                    <p class="card-text"><strong>Superficie:</strong> 120 m²</p>
                    <p class="card-text"><strong>Nombre d'heures passés:</strong> 2h</p>
                    <p class="card-text"><strong>tâche accomplie:</strong>désinfectation des bureaux</p>
                    
                    <div class="col-md-6 text-center">
            <a href="#" class="btn ajout mb-3">Voir plus</a>
        </div>
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

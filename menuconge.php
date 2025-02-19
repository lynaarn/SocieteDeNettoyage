<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu congés</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    
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
          <a class="nav-link active" href="#">Congés</a>
        </li>
        <li class="nav-item  ">
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

<div class="container content">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card-body">
                <div class="links">
                <a href="congésEmploye.php" class="btn btn-primary btn-block mb-2">Demander congé </a>
                    <a href="suivreconge.php" class="btn btn-primary btn-block mb-2">Suivre congé</a>
                    
                  
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

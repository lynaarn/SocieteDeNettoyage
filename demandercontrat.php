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
            margin-bottom: 80px;
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
        .bg-light {
        background-color:#A8A8A8;
        padding: 7px;
        border-radius: 5%;
       
}
.ok{
    margin-top: 50px;
    
}
.form-group label {
            font-weight: bold;
            color: black;
        }
        .form-group label i {
            margin-right: 5px;
            color: #17a2b8; /* Changer la couleur des icônes si nécessaire */
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
          <a class="nav-link " href="prestationsClient.php">Préstations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="contratsClients.php">Contrats</a>
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
                <h3 class="text-center  mb-4 ok "><span class="bg-light">Demande un contrat</span></h3>
                <form action="demande_prestation.php" method="post">
                    <div class="form-group">
                        <label for="date"><i class="fas fa-calendar-alt"></i>Date de début</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="date"><i class="fas fa-calendar-alt"></i>Date de fin</label>
                        <input type="date" class="form-control" id="date" name="date" required>
                    </div>
                    <div class="form-group">
                        <label for="service"><i class="fas fa-broom"></i>Service souhaité</label>
                        <select class="form-control" id="service" name="service" required>
                            <option value="nettoyage_residantiel">Nettoyage résidentiel</option>
                            <option value="nettoyage_industriel">Nettoyage industriel</option>
                            <option value="nettoyage_commercial">Nettoyage commercial</option>
                            <option value="autre_service">Autre service</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="service"><i class="fas fa-clock"></i>Fréquence</label>
                        <select class="form-control" id="service" name="fréquence" required>
                            <option value="nettoyage_residantiel">quotidien</option>
                            <option value="nettoyage_industriel">hebdomadaire</option>
                            <option value="nettoyage_commercial">Mensuel</option>
                            <option value="autre_service">Bimensuel</option>
                            <option value="nettoyage_commercial">Trimestriel</option>
                         
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nombre_heures"><i class="fas fa-hourglass-start"></i>Nombre d'heures</label>
                        <input type="number" class="form-control" id="nombre_heures" name="nombre_heures" required min="1">
                    </div>
                    <div class="form-group">
                        <label for="superficie"><i class="fas fa-house-user"></i>Superficie (en m²)</label>
                        <input type="number" class="form-control" id="superficie" name="superficie" required min="1">
                    </div>
                    <div class="form-group">
                        <label for="adresse"><i class="fas fa-map-marker-alt"></i>Adresse</label>
                        <input type="text" class="form-control" id="adresse" name="adresse" required>
                    </div>
                    <div class="form-group">
                        <label for="commentaires"><i class="fas fa-comments"></i>Commentaires supplémentaires</label>
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

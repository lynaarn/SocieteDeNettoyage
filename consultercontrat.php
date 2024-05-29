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
        
        .content {
            margin-top: 80px;
            margin-bottom: 80px;
        }
        .info-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 30px;
        }
        .info-container:hover{
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .info-group {
            margin-bottom: 15px;
        }
        .bg-light {
      
        padding: 7px;
        border-radius: 5%;
       
}
        .ok {
            margin-top: 50px;
        }
        .info-group label {
            font-weight: bold;
            color: black;
        }
        .info-group label i {
            margin-right: 5px;
            color: #17a2b8;
        }
        .btn-group {
            margin-top: 20px;
        }
        .card img {
            margin-top: 10px;
            height: 150px;
            object-fit: cover;
            border-radius: 5%;
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
        <div class="col-md-6">
            <div class="info-container">
                <h3 class="text-center mb-4"><span class="bg-light">Mon contrat</span></h3>
                <img src="images/8.jpg" class="card-img-top" alt="Prestation 1">
                <div class="info-group">
                    <label for="date_debut"><i class="fas fa-calendar-alt"></i> Date de début :</label>
                    <span id="date_debut">2024-06-01</span>
                </div>
                <div class="info-group">
                    <label for="date_fin"><i class="fas fa-calendar-alt"></i> Date de fin :</label>
                    <span id="date_fin">2024-06-30</span>
                </div>
                <div class="info-group">
                    <label for="service_choisi"><i class="fas fa-broom"></i> Service choisi :</label>
                    <span id="service_choisi">Nettoyage résidentiel</span>
                </div>
                <div class="info-group">
                    <label for="frequence"><i class="fas fa-clock"></i> Fréquence :</label>
                    <span id="frequence">Hebdomadaire</span>
                </div>
                <div class="info-group">
                    <label for="nb_heures"><i class="fas fa-hourglass-start"></i> Nombre d'heures :</label>
                    <span id="nb_heures">20</span>
                </div>
                <div class="info-group">
                    <label for="superficie"><i class="fas fa-house-user"></i> Superficie :</label>
                    <span id="superficie">200 m²</span>
                </div>
                <div class="info-group">
                    <label for="adresse"><i class="fas fa-map-marker-alt"></i> Adresse :</label>
                    <span id="adresse">123 Rue de la Fontaine</span>
                </div>
                <div class="info-group">
                    <label for="commentaire"><i class="fas fa-comments"></i> Commentaire :</label>
                    <span id="commentaire">Nettoyage approfondi requis</span>
                </div>
                <div class="btn-group">
                    <a href="index.html" class="btn btn-danger">Résilier</a>
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

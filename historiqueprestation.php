<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prestations</title>
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
            margin-top: 10px;
        }
        .card-text {
            font-size: 1em;
            color: #555;
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
          <a class="nav-link" href="menuCommentaire.php">commentaires</a>
        </li>
        <li class="nav-item1  ">
        <a class="nav-link" href="compteEmploye.php"><i class="fas fa-user fa-lg"></i></a>

        </li>
        <li class="nav-item ">
        <a class="nav-link" href="deconnexionClient.php">Deconnexion</a>

        </li>
      </ul>
    </div>
  </div>
</nav>
<h2 class="center-text main-title"> Mon historique des préstations </h2>
<div class="container content">

    <div class="row">
      
        <div class="col-md-4">
            <div class="card">
            <h5 class="card-title">Nettoyage de bureaux</h5>
                <img src="images/1.jpg" class="card-img-top" alt="Prestation 1">
                <div class="card-body">
                   
                    <p class="card-text"><strong>Date:</strong> 2024-05-20</p>
                    <p class="card-text"><strong>Superficie:</strong> 100 m²</p>
                    <div class="col-md-6 text-center">
            <a href="#" class="btn ajout mb-3" data-toggle="modal" data-target="#modal1">Voir plus</a>
        </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
            <h5 class="card-title">Nettoyage résidentiel</h5>
                <img src="images/27.jpg" class="card-img-top" alt="Prestation 2">
                <div class="card-body">
                   
                    <p class="card-text"><strong>Date:</strong> 2024-04-21</p>
                    <p class="card-text"><strong>Superficie:</strong> 200 m²</p>
                    <div class="col-md-6 text-center">
            <a href="#" class="btn ajout mb-3" data-toggle="modal" data-target="#modal2">Voir plus</a>
        </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
            <h5 class="card-title">Désinfectation</h5>
                <img src="images/28.jpg" class="card-img-top" alt="Prestation 3">
                <div class="card-body">
                  
                    <p class="card-text"><strong>Date:</strong> 2024-03-22</p>
                    <p class="card-text"><strong>Superficie:</strong> 150 m²</p>
                    <div class="col-md-6 text-center">
            <a href="#" class="btn ajout mb-3" data-toggle="modal" data-target="#modal3">Voir plus</a>
        </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <div class="card">
            <h5 class="card-title">Nettoyage industriel</h5>
                <img src="images/29.jpg" class="card-img-top" alt="Prestation 4">
                <div class="card-body">
                    
                    <p class="card-text"><strong>Date:</strong> 2024-03-10</p>
                    <p class="card-text"><strong>Superficie:</strong> 120 m²</p>
                    <div class="col-md-6 text-center">
            <a href="#" class="btn ajout mb-3" data-toggle="modal" data-target="#modal4">Voir plus</a>
        </div>
                </div>
            </div>
        </div>

        
    </div>
</div>

<!-- Modal 1 -->
<div class="modal fade" id="modal1" tabindex="-1" role="dialog" aria-labelledby="modal1Label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal1Label">Détails du Nettoyage de bureaux</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>Date:</strong> 2024-05-20</p>
        <p><strong>Superficie:</strong> 100 m²</p>
        <p><strong>Heures passées:</strong> 4 heures</p>
        <p><strong>Équipements utilisés:</strong> Aspirateur, Produits de nettoyage</p>
        <p><strong>Commentaire:</strong> Nettoyage en profondeur des bureaux et des surfaces de travail.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal 2 -->
<div class="modal fade" id="modal2" tabindex="-1" role="dialog" aria-labelledby="modal2Label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal2Label">Détails du Nettoyage résidentiel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>Date:</strong> 2024-04-21</p>
        <p><strong>Superficie:</strong> 200 m²</p>
        <p><strong>Heures passées:</strong> 6 heures</p>
        <p><strong>Équipements utilisés:</strong> Balai, Produits de nettoyage</p>
        <p><strong>Commentaire:</strong> Nettoyage complet de la maison, y compris les sols et les vitres.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal 3 -->
<div class="modal fade" id="modal3" tabindex="-1" role="dialog" aria-labelledby="modal3Label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal3Label">Détails de la Désinfectation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>Date:</strong> 2024-03-22</p>
        <p><strong>Superficie:</strong> 150 m²</p>
        <p><strong>Heures passées:</strong> 3 heures</p>
        <p><strong>Équipements utilisés:</strong> Désinfectants, Gants</p>
        <p><strong>Commentaire:</strong> Désinfectation complète des zones touchées et des surfaces de contact.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal 4 -->
<div class="modal fade" id="modal4" tabindex="-1" role="dialog" aria-labelledby="modal4Label" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modal4Label">Détails du Nettoyage industriel</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>Date:</strong> 2024-03-10</p>
        <p><strong>Superficie:</strong> 120 m²</p>
        <p><strong>Heures passées:</strong> 5 heures</p>
        <p><strong>Équipements utilisés:</strong> Machines de nettoyage, Produits industriels</p>
        <p><strong>Commentaire:</strong> Nettoyage des équipements industriels et des sols.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

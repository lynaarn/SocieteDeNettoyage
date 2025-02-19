<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interventions</title>

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
        .modal-body {
            text-align: left;
        }
        .modal-title {
            color: #17a2b8;
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

<h2 class="center-text main-title">Mon historique d'interventions</h2>
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
                        <a href="#" class="btn ajout mb-3" data-toggle="modal" data-target="#detailsModal1">Voir plus</a>
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
                        <a href="#" class="btn ajout mb-3" data-toggle="modal" data-target="#detailsModal2">Voir plus</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <p class="card-text"><strong>Date:</strong> 2024-03-22</p>
                <h5 class="card-title">Nettoyage industriel</h5>
                <img src="images/34.jpg" class="card-img-top" alt="Prestation 3">
                <div class="card-body">
                    <p class="card-text"><strong>Superficie:</strong> 500 m²</p>
                    <p class="card-text"><strong>Nombre d'heures passés:</strong> 5h</p>
                    <p class="card-text"><strong>tâche accomplie:</strong> nettoyage des machines et équipements</p>
                    <div class="col-md-6 text-center">
                        <a href="#" class="btn ajout mb-3" data-toggle="modal" data-target="#detailsModal3">Voir plus</a>
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
                    <p class="card-text"><strong>tâche accomplie:</strong> désinfectation des bureaux</p>
                    <div class="col-md-6 text-center">
                        <a href="#" class="btn ajout mb-3" data-toggle="modal" data-target="#detailsModal4">Voir plus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal 1 -->
<div class="modal fade" id="detailsModal1" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailsModalLabel1">Détails de l'intervention</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>Date:</strong> 2024-05-20</p>
        <p><strong>Type de prestation:</strong> Nettoyage de bureaux</p>
        <p><strong>Superficie:</strong> 300 m²</p>
        <p><strong>Nombre d'heures passés:</strong> 4h</p>
        <p><strong>Tâche accomplie:</strong> Nettoyage des vitres</p>
        <p><strong>Équipe:</strong> 3 personnes</p>
        <p><strong>Produits utilisés:</strong> Produit A, Produit B</p>
        <p><strong>Commentaires:</strong> Travail effectué sans encombre.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal 2 -->
<div class="modal fade" id="detailsModal2" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailsModalLabel2">Détails de l'intervention</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>Date:</strong> 2024-04-21</p>
        <p><strong>Type de prestation:</strong> Nettoyage résidentiel</p>
        <p><strong>Superficie:</strong> 200 m²</p>
        <p><strong>Nombre d'heures passés:</strong> 2h</p>
        <p><strong>Tâche accomplie:</strong> Nettoyage du sol</p>
        <p><strong>Équipe:</strong> 2 personnes</p>
        <p><strong>Produits utilisés:</strong> Produit C, Produit D</p>
        <p><strong>Commentaires:</strong> Travail effectué avec soin.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal 3 -->
<div class="modal fade" id="detailsModal3" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel3" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailsModalLabel3">Détails de l'intervention</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>Date:</strong> 2024-03-22</p>
        <p><strong>Type de prestation:</strong> Nettoyage industriel</p>
        <p><strong>Superficie:</strong> 500 m²</p>
        <p><strong>Nombre d'heures passés:</strong> 5h</p>
        <p><strong>Tâche accomplie:</strong> Nettoyage des machines et équipements</p>
        <p><strong>Équipe:</strong> 4 personnes</p>
        <p><strong>Produits utilisés:</strong> Produit E, Produit F</p>
        <p><strong>Commentaires:</strong> Intervention complexe mais réussie.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal 4 -->
<div class="modal fade" id="detailsModal4" tabindex="-1" role="dialog" aria-labelledby="detailsModalLabel4" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="detailsModalLabel4">Détails de l'intervention</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p><strong>Date:</strong> 2024-03-10</p>
        <p><strong>Type de prestation:</strong> Désinfectation</p>
        <p><strong>Superficie:</strong> 120 m²</p>
        <p><strong>Nombre d'heures passés:</strong> 2h</p>
        <p><strong>Tâche accomplie:</strong> Désinfectation des bureaux</p>
        <p><strong>Équipe:</strong> 2 personnes</p>
        <p><strong>Produits utilisés:</strong> Produit G, Produit H</p>
        <p><strong>Commentaires:</strong> Travail rapide et efficace.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

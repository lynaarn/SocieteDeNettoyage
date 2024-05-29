<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande de Prestation</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" />
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
        .info-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 30px;
            background-color: #F0F8FF;
        }
        .info-group {
            margin-bottom: 15px;
        }
        .bg-light {
            background-color:#17a2b8;
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
        .btn-group2 {
            margin-top: 20px;
            text-align: right;
            background-color: #acc1db;
          
        }
        .card img {
            margin-top: 10px;
            height: 150px;
            object-fit: cover;
            border-radius: 10%;
        }
        .bout{
          background-color:#acc1db;
        }
        .boutt{
          background-color:  #B9D9EB;
          padding: 10px;
          border-radius: 5%;
        }
        .divv{
            text-align: right;
        }
       
    </style>
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
        <li class="nav-item ">
          <a class="nav-link" href="service.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="clients.php">Clients</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="personnels.php">Personnels</a>
        </li>
        <li class="nav-item active">
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

<div class="container content">
<h2 class="center-text1 ">Les contrats</h2>
<div class="search-bar">
        <form class="form-inline justify-content-center">
        <input class="form-control mr-sm-2" type="search" placeholder="Nom de client" aria-label="Search">
            <select class="form-control mr-sm-2">
                <option value="">Tous les services</option>
                <option value="nettoyage_bureaux">Nettoyage de bureaux</option>
                <option value="nettoyage_residentiel">Nettoyage résidentiel</option>
                <option value="nettoyage_industriel">Nettoyage industriel</option>
                <!-- Ajouter d'autres options de service ici -->
            </select>
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
        </form>
     
    </div>
<div class="divv">
    <a href="ajouterContrat.php" class="btn btn-group2">Ajouter un contrat</a>
</div>
    <div class="row">
        <!-- Premier contrat -->
        <div class="col-md-4">
            <div class="info-container">
                <h3 class="text-center mb-4"><span class="boutt ">Aourane lyna</span></h3>
                <img src="images/46.jpg" class="card-img-top" alt="Prestation 1">
                <div class="info-group">
                    <label for="nom1"><i class="fas fa-file-contract"></i> Nom :</label>
                    <span id="nom1">Nettoyage de bureaux</span>
                </div>
                <div class="info-group">
                    <label for="date_debut1"><i class="fas fa-calendar-alt"></i> Date de début :</label>
                    <span id="date_debut1">2024-05-20</span>
                </div>
                <div class="info-group">
                    <label for="date_fin1"><i class="fas fa-calendar-alt"></i> Date de fin :</label>
                    <span id="date_fin1">2024-10-20</span>
                </div>
                <div class="info-group">
                    <label for="frequence1"><i class="fas fa-clock"></i> Fréquence :</label>
                    <span id="frequence1">Mensuel</span>
                </div>
               
                <div class="btn-group">
    <a href="#" class="btn bout">Voir plus</a>
    <a href="modifierContrat.php" class="edit-icon ml-2"><i class="fa fa-pencil-alt"></i></a>
    <a href="#" class="delete-icon ml-1"><i class="fa fa-trash"></i></a>
</div>
            </div>
        </div>
        <!-- Deuxième contrat -->
        <div class="col-md-4">
            <div class="info-container">
                <h3 class="text-center mb-4"><span class="boutt">Safa Imad</span></h3>
                <img src="images/46.jpg" class="card-img-top" alt="Prestation 2">
                <div class="info-group">
                    <label for="nom2"><i class="fas fa-file-contract"></i> Nom :</label>
                    <span id="nom2">Nettoyage résidentiel</span>
                </div>
                <div class="info-group">
                    <label for="date_debut2"><i class="fas fa-calendar-alt"></i> Date de début :</label>
                    <span id="date_debut2">2024-06-01</span>
                </div>
                <div class="info-group">
                    <label for="date_fin2"><i class="fas fa-calendar-alt"></i> Date de fin :</label>
                    <span id="date_fin2">2024-06-30</span>
                </div>
                <div class="info-group">
                    <label for="frequence2"><i class="fas fa-clock"></i> Fréquence :</label>
                    <span id="frequence2">Hebdomadaire</span>
                </div>
                
                <div class="btn-group">
    <a href="#" class="btn bout">Voir plus</a>
    <a href="modifierContrat.php" class="edit-icon ml-2"><i class="fa fa-pencil-alt"></i></a>
    <a href="#" class="delete-icon ml-1"><i class="fa fa-trash"></i></a>
</div>
            </div>
        </div>
        <!-- Troisième contrat -->
        <div class="col-md-4">
            <div class="info-container">
                <h3 class="text-center mb-4"><span class=" boutt ">Ines Safa</span></h3>
                <img src="images/46.jpg" class="card-img-top" alt="Prestation 3">
                <div class="info-group">
                    <label for="nom3"><i class="fas fa-file-contract"></i> Nom :</label>
                    <span id="nom3">Nettoyage industriel</span>
                </div>
                <div class="info-group">
                    <label for="date_debut3"><i class="fas fa-calendar-alt"></i> Date de début :</label>
                    <span id="date_debut3">2024-07-01</span>
                </div>
                <div class="info-group">
                    <label for="date_fin3"><i class="fas fa-calendar-alt"></i> Date de fin :</label>
                    <span id="date_fin3">2024-12-31</span>
                </div>
                <div class="info-group">
                    <label for="frequence3"><i class="fas fa-clock"></i> Fréquence :</label>
                    <span id="frequence3">Quotidien</span>
                </div>
               
                <div class="btn-group">
    <a href="#" class="btn bout">Voir plus</a>
    <a href="modifierContrat.php" class="edit-icon ml-2"><i class="fa fa-pencil-alt"></i></a>
    <a href="#" class="delete-icon ml-1"><i class="fa fa-trash"></i></a>
</div>
            </div>
            
        </div>

        <div class="col-md-4">
            <div class="info-container">
                <h3 class="text-center mb-4"><span class="boutt">Ines Safa</span></h3>
                <img src="images/46.jpg" class="card-img-top" alt="Prestation 3">
                <div class="info-group">
                    <label for="nom3"><i class="fas fa-file-contract"></i> Nom :</label>
                    <span id="nom3">Nettoyage industriel</span>
                </div>
                <div class="info-group">
                    <label for="date_debut3"><i class="fas fa-calendar-alt"></i> Date de début :</label>
                    <span id="date_debut3">2024-07-01</span>
                </div>
                <div class="info-group">
                    <label for="date_fin3"><i class="fas fa-calendar-alt"></i> Date de fin :</label>
                    <span id="date_fin3">2024-12-31</span>
                </div>
                <div class="info-group">
                    <label for="frequence3"><i class="fas fa-clock"></i> Fréquence :</label>
                    <span id="frequence3">Quotidien</span>
                </div>
               
                <div class="btn-group">
    <a href="#" class="btn bout">Voir plus</a>
    <a href="modifierContrat.php" class="edit-icon ml-2"><i class="fa fa-pencil-alt"></i></a>
    <a href="#" class="delete-icon ml-1"><i class="fa fa-trash"></i></a>
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

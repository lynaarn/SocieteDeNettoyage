<?php
require_once("identifier.php");
require_once("connexiondb.php");

$id_c = isset($_GET['id']) ? $_GET['id'] : 0;

// Requête pour obtenir les détails du contrat
$requeteContrat = "SELECT contrat.date_deb, contrat.date_fin, contrat.etat, contrat.detailc, users.nom, users.prenom 
                   FROM contrat
                   JOIN Client ON contrat.client_id = Client.id
                   JOIN users ON Client.id = users.id
                   WHERE contrat.id_c = ?";
$stmtContrat = $pdo->prepare($requeteContrat);
$stmtContrat->execute([$id_c]);
$contrat = $stmtContrat->fetch();

// Requête pour obtenir les services associés au contrat
$requeteServices = "SELECT Service.NomS, ServiceDansContrat.detailsSer, ServiceDansContrat.frequence 
                    FROM ServiceDansContrat
                    JOIN Service ON ServiceDansContrat.CodeS = Service.CodeS
                    WHERE ServiceDansContrat.id_c = ?";
$stmtServices = $pdo->prepare($requeteServices);
$stmtServices->execute([$id_c]);
$services = $stmtServices->fetchAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Contrat</title>
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
        .bout {
            background-color:#acc1db;
        }
        .boutt {
            background-color: #B9D9EB;
            padding: 10px;
            border-radius: 5%;
        }
        .divv {
            text-align: right;
        }
        .service-container {
            margin-top: 20px;
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
    <h2 class="center-text1">Détails du Contrat</h2>
    <div class="info-container">
        <h3 class="text-center mb-4"><span class="boutt"><?php echo $contrat["nom"] . ' ' . $contrat["prenom"]; ?></span></h3>
        <div class="info-group">
            <label for="date_debut"><i class="fas fa-calendar-alt"></i> Date de début :</label>
            <span id="date_debut"><?php echo $contrat["date_deb"]; ?></span>
        </div>
        <div class="info-group">
            <label for="date_fin"><i class="fas fa-calendar-alt"></i> Date de fin :</label>
            <span id="date_fin"><?php echo $contrat["date_fin"]; ?></span>
        </div>
        <div class="info-group">
            <label for="etat"><i class="fas fa-clock"></i> État :</label>
            <span id="etat"><?php echo $contrat["etat"]; ?></span>
        </div>
        <div class="info-group">
            <label for="detailc"><i class="fas fa-info-circle"></i> Détails :</label>
            <span id="detailc"><?php echo $contrat["detailc"]; ?></span>
        </div>
    </div>

    <h2 class="center-text1">Services</h2>
    <?php foreach ($services as $service) { ?>
        <div class="info-container service-container">
            <div class="info-group">
                <label for="nom"><i class="fas fa-concierge-bell"></i> Nom du Service :</label>
                <span id="nom"><?php echo $service["NomS"]; ?></span>
            </div>
            <div class="info-group">
                <label for="detailsSer"><i class="fas fa-info-circle"></i> Détails :</label>
                <span id="detailsSer"><?php echo $service["detailsSer"]; ?></span>
            </div>
            <div class="info-group">
                <label for="frequence"><i class="fas fa-sync-alt"></i> Fréquence :</label>
                <span id="frequence"><?php echo $service["frequence"]; ?></span>
            </div>
        </div>
    <?php } ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

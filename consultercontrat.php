<?php
session_start();
require_once("connexiondb.php");

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user'])) {
    header('Location: authentification.php');
    exit();
}

// Récupérer l'ID de l'utilisateur connecté
$user_id = $_SESSION['user']['id'];

// Requête pour récupérer le contrat actif du client
$sql = "SELECT * FROM contrat WHERE client_id = ? AND (etat = 'actif' OR etat = 'en attente de preparation' OR etat = 'en attente de confirmation') LIMIT 1";
$stmt = $pdo->prepare($sql);
$stmt->execute([$user_id]);
$contrat = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulter contrat</title>
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
          <a class="nav-link" href="menuCommentaire.php">commentaires</a>
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
                <?php if ($contrat): ?>
                    <?php if ($contrat['etat'] == 'actif'): ?>
                        <h3 class="text-center mb-4"><span class="bg-light">Mon contrat</span></h3>
                        <img src="images/8.jpg" class="card-img-top" alt="Prestation 1">
                        <div class="info-group">
                            <label for="date_debut"><i class="fas fa-calendar-alt"></i> Date de début :</label>
                            <span id="date_debut"><?= $contrat['date_deb'] ?></span>
                        </div>
                        <div class="info-group">
                            <label for="date_fin"><i class="fas fa-calendar-alt"></i> Date de fin :</label>
                            <span id="date_fin"><?= $contrat['date_fin'] ?></span>
                        </div>
                        <?php
                            // Requête pour récupérer les services associés au contrat
                            $sql_services = "SELECT s.NomS, s.TarifHr, s.Duree, s.Description, sc.detailsSer, sc.frequence 
                                             FROM ServiceDansContrat sc 
                                             JOIN Service s ON sc.CodeS = s.CodeS 
                                             WHERE sc.id_c = ?";
                            $stmt_services = $pdo->prepare($sql_services);
                            $stmt_services->execute([$contrat['id_c']]);
                            $services = $stmt_services->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <?php if ($services): ?>
                            <?php foreach ($services as $service): ?>
                                <div class="info-group">
                                    <label for="service_choisi"><i class="fas fa-broom"></i> Service choisi :</label>
                                    <span id="service_choisi"><?= $service['NomS'] ?></span>
                                </div>
                                <div class="info-group">
                                    <label for="frequence"><i class="fas fa-clock"></i> Fréquence :</label>
                                    <span id="frequence"><?= $service['frequence'] ?></span>
                                </div>
                                <div class="info-group">
                                    <label for="detailsSer"><i class="fas fa-info-circle"></i> Détails du service :</label>
                                    <span id="detailsSer"><?= $service['detailsSer'] ?></span>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <div class="info-group">
                            <label for="adresse"><i class="fas fa-map-marker-alt"></i> Adresse :</label>
                            <span id="adresse"><?= $_SESSION['user']['adresse'] ?></span>
                        </div>
                        <div class="info-group">
                            <label for="commentaire"><i class="fas fa-comments"></i> Commentaire :</label>
                            <span id="commentaire"><?= $contrat['detailc'] ?></span>
                        </div>
                        <div class="btn-group">
                            <button class="btn btn-danger" data-toggle="modal" data-target="#resilierModal">Résilier</button>
                        </div>
                    <?php elseif ($contrat['etat'] == 'en attente de preparation'): ?>
                        <p>Votre contrat est en cours de préparation de la part de notre société.</p>
                    <?php elseif ($contrat['etat'] == 'en attente de confirmation'): ?>
                        <p>Votre contrat n'est pas encore confirmé par notre société.</p>
                    <?php endif; ?>
                <?php else: ?>
                    <p>Vous n'avez pas de contrat avec notre société pour le moment.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

<!-- Modal de confirmation de résiliation -->
<div class="modal fade" id="resilierModal" tabindex="-1" role="dialog" aria-labelledby="resilierModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="resilierModalLabel">Confirmation de résiliation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir résilier ce contrat ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-danger" id="confirmResilierBtn">Résilier</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('#confirmResilierBtn').on('click', function() {
        window.location.href = 'resilierContratClient.php?id=<?= $contrat['id_c'] ?>';
    });
});
</script>
</body>
</html>

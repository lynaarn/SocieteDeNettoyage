<?php
require_once("identifier.php");
require_once("connexiondb.php");

// Récupérer les filtres et paramètres de pagination
$noms = isset($_GET['NomS']) ? $_GET['NomS'] : "";
$etat = isset($_GET['etat']) ? $_GET['etat'] : "all";
$size = isset($_GET['size']) ? $_GET['size'] : 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;

// Construire les requêtes en fonction des filtres
$requeteActifs = "SELECT contrat.id_c, contrat.date_deb, contrat.date_fin, contrat.etat, users.nom, users.prenom 
                  FROM contrat
                  JOIN Client ON contrat.client_id = Client.id
                  JOIN users ON Client.id = users.id
                  WHERE users.nom LIKE '%$noms%' 
                  AND contrat.etat='actif' 
                  AND contrat.date_fin >= CURDATE()
                  LIMIT $size OFFSET $offset";

$requeteTermines = "SELECT contrat.id_c, contrat.date_deb, contrat.date_fin, contrat.etat, users.nom, users.prenom 
                    FROM contrat
                    JOIN Client ON contrat.client_id = Client.id
                    JOIN users ON Client.id = users.id
                    WHERE users.nom LIKE '%$noms%' 
                    AND contrat.date_fin < CURDATE()
                    LIMIT $size OFFSET $offset";

$requeteAttente = "SELECT contrat.id_c, contrat.date_deb, contrat.date_fin, contrat.etat, users.nom, users.prenom 
                   FROM contrat
                   JOIN Client ON contrat.client_id = Client.id
                   JOIN users ON Client.id = users.id
                   WHERE users.nom LIKE '%$noms%' 
                   AND contrat.etat='en attente de confirmation'
                   LIMIT $size OFFSET $offset";

// Requêtes pour compter le nombre total de contrats dans chaque catégorie
$requeteCountActifs = "SELECT COUNT(*) countC 
                       FROM contrat
                       JOIN Client ON contrat.client_id = Client.id
                       JOIN users ON Client.id = users.id
                       WHERE users.nom LIKE '%$noms%' 
                       AND contrat.etat='actif' 
                       AND contrat.date_fin >= CURDATE()";

$requeteCountTermines = "SELECT COUNT(*) countC 
                         FROM contrat
                         JOIN Client ON contrat.client_id = Client.id
                         JOIN users ON Client.id = users.id
                         WHERE users.nom LIKE '%$noms%' 
                         AND contrat.date_fin < CURDATE()";

$requeteCountAttente = "SELECT COUNT(*) countC 
                        FROM contrat
                        JOIN Client ON contrat.client_id = Client.id
                        JOIN users ON Client.id = users.id
                        WHERE users.nom LIKE '%$noms%' 
                        AND contrat.etat='en attente de confirmation'";

$resultatActifs = $pdo->query($requeteActifs);
$resultatTermines = $pdo->query($requeteTermines);
$resultatAttente = $pdo->query($requeteAttente);

$resultatCountActifs = $pdo->query($requeteCountActifs);
$resultatCountTermines = $pdo->query($requeteCountTermines);
$resultatCountAttente = $pdo->query($requeteCountAttente);

$tabCountActifs = $resultatCountActifs->fetch();
$tabCountTermines = $resultatCountTermines->fetch();
$tabCountAttente = $resultatCountAttente->fetch();

$nbrContratActifs = $tabCountActifs['countC'];
$nbrContratTermines = $tabCountTermines['countC'];
$nbrContratAttente = $tabCountAttente['countC'];

$resteActifs = $nbrContratActifs % $size;
$resteTermines = $nbrContratTermines % $size;
$resteAttente = $nbrContratAttente % $size;

$nbrPageActifs = $resteActifs === 0 ? $nbrContratActifs / $size : floor($nbrContratActifs / $size) + 1;
$nbrPageTermines = $resteTermines === 0 ? $nbrContratTermines / $size : floor($nbrContratTermines / $size) + 1;
$nbrPageAttente = $resteAttente === 0 ? $nbrContratAttente / $size : floor($nbrContratAttente / $size) + 1;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contrats</title>
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
        .pagination-container {
            margin-top: 20px; /* Espace entre la pagination et les contrats */
        }
        .section-title {
            font-size: 24px;
            font-weight: bold;
            color: #17a2b8;
            margin-top: 40px;
            margin-bottom: 20px;
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
<h2 class="center-text1">Les contrats</h2>
<div class="search-bar">
    <form class="form-inline justify-content-center">
        <input class="form-control mr-sm-2" type="search" name="NomS" value="<?php echo $noms ?>" placeholder="Nom de client" aria-label="Search">
        <select class="form-control mr-sm-2" name="etat">
            <option value="all" <?php if ($etat == "all") echo "selected"; ?>>Tous les états</option>
            <option value="actif" <?php if ($etat == "actif") echo "selected"; ?>>Actif</option>
            <option value="résilié" <?php if ($etat == "résilié") echo "selected"; ?>>Résilié</option>
            <option value="terminé" <?php if ($etat == "terminé") echo "selected"; ?>>Terminé</option>
            <option value="en attente de confirmation" <?php if ($etat == "en attente de confirmation") echo "selected"; ?>>En attente de confirmation</option>
        </select>
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
    </form>
</div>
<div class="divv">
    <a href="ajouterContrat.php" class="btn btn-group2">Ajouter un contrat</a>
</div>

<h3 class="section-title">Contrats Actifs</h3>
<div class="row">
    <?php while ($row = $resultatActifs->fetch()) { ?>
        <div class="col-md-4">
            <div class="info-container">
                <h3 class="text-center mb-4"><span class="boutt"><?php echo $row["nom"] . ' ' . $row["prenom"]; ?></span></h3>
                <img src="images/62.jpg" class="card-img-top" alt="Prestation">
                
                <div class="info-group">
                    <label for="date_debut"><i class="fas fa-calendar-alt"></i> Date de début :</label>
                    <span id="date_debut"><?php echo $row["date_deb"]; ?></span>
                </div>
                <div class="info-group">
                    <label for="date_fin"><i class="fas fa-calendar-alt"></i> Date de fin :</label>
                    <span id="date_fin"><?php echo $row["date_fin"]; ?></span>
                </div>
                <div class="info-group">
                    <label for="etat"><i class="fas fa-clock"></i> État :</label>
                    <span id="etat"><?php echo $row["etat"]; ?></span>
                </div>
                <div class="btn-group">
                    <a href="detailsContrat.php?id=<?php echo $row["id_c"]; ?>" class="btn bout">Voir plus</a>
                    <a href="modifierContrat.php?id=<?php echo $row["id_c"]; ?>" class="edit-icon ml-2"><i class="fa fa-pencil-alt"></i></a>
                    <a href="#" class="resilier-icon ml-2" data-toggle="modal" data-target="#confirmResilierModal" data-contrat-id="<?php echo $row['id_c']; ?>"><i class="fa fa-ban"></i></a>
                    <a href="suivrepaiment.php?id=<?php echo $row["id_c"]; ?>" class="btn bout ml-2">Paiement</a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<h3 class="section-title">Contrats Terminés</h3>
<div class="row">
    <?php while ($row = $resultatTermines->fetch()) { ?>
        <div class="col-md-4">
            <div class="info-container">
                <h3 class="text-center mb-4"><span class="boutt"><?php echo $row["nom"] . ' ' . $row["prenom"]; ?></span></h3>
                <img src="images/62.jpg" class="card-img-top" alt="Prestation">
                
                <div class="info-group">
                    <label for="date_debut"><i class="fas fa-calendar-alt"></i> Date de début :</label>
                    <span id="date_debut"><?php echo $row["date_deb"]; ?></span>
                </div>
                <div class="info-group">
                    <label for="date_fin"><i class="fas fa-calendar-alt"></i> Date de fin :</label>
                    <span id="date_fin"><?php echo $row["date_fin"]; ?></span>
                </div>
                <div class="info-group">
                    <label for="etat"><i class="fas fa-clock"></i> État :</label>
                    <span id="etat"><?php echo $row["etat"]; ?></span>
                </div>
                <div class="btn-group">
                    <a href="detailsContrat.php?id=<?php echo $row["id_c"]; ?>" class="btn bout">Voir plus</a>
                    <a href="#" class="renouveler-icon ml-2" data-toggle="modal" data-target="#renouvelerModal" data-contrat-id="<?php echo $row['id_c']; ?>"><i class="fa fa-sync"></i></a>
                    <a href="#" class="delete-icon ml-1" data-toggle="modal" data-target="#confirmDeleteModal" data-contrat-id="<?php echo $row['id_c']; ?>"><i class="fa fa-trash"></i></a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<h3 class="section-title">Contrats en Attente de Confirmation</h3>
<div class="row">
    <?php while ($row = $resultatAttente->fetch()) { ?>
        <div class="col-md-4">
            <div class="info-container">
                <h3 class="text-center mb-4"><span class="boutt"><?php echo $row["nom"] . ' ' . $row["prenom"]; ?></span></h3>
                <img src="images/62.jpg" class="card-img-top" alt="Prestation">
                
                <div class="info-group">
                    <label for="date_debut"><i class="fas fa-calendar-alt"></i> Date de début :</label>
                    <span id="date_debut"><?php echo $row["date_deb"]; ?></span>
                </div>
                <div class="info-group">
                    <label for="date_fin"><i class="fas fa-calendar-alt"></i> Date de fin :</label>
                    <span id="date_fin"><?php echo $row["date_fin"]; ?></span>
                </div>
                <div class="info-group">
                    <label for="etat"><i class="fas fa-clock"></i> État :</label>
                    <span id="etat"><?php echo $row["etat"]; ?></span>
                </div>
                <div class="btn-group">
                    <a href="detailsContrat.php?id=<?php echo $row["id_c"]; ?>" class="btn bout">Voir plus</a>
                    <a href="#" class="accept-icon ml-2 btn btn-success" data-toggle="modal" data-target="#confirmAcceptModal" data-contrat-id="<?php echo $row['id_c']; ?>">Accepter</a>
                    <a href="#" class="refuse-icon ml-2 btn btn-danger" data-toggle="modal" data-target="#confirmRefuseModal" data-contrat-id="<?php echo $row['id_c']; ?>">Refuser</a>
                </div>
            </div>
        </div>
    <?php } ?>
</div>

<div class="pagination-container">
<nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
        <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
            <a class="page-link" href="contrats.php?page=<?php echo $page - 1; ?>&etat=<?php echo $etat; ?>">Précédent</a>
        </li>
        <?php for ($i = 1; $i <= $nbrPageActifs; $i++) { ?>
        <li class="page-item <?php if ($i == $page) echo 'active'; ?>"><a class="page-link" href="contrats.php?page=<?php echo $i; ?>&etat=<?php echo $etat; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li class="page-item <?php if ($page >= $nbrPageActifs) echo 'disabled'; ?>">
            <a class="page-link" href="contrats.php?page=<?php echo $page + 1; ?>&etat=<?php echo $etat; ?>">Suivant</a>
        </li>
    </ul>
</nav>
</div>
</div>

<!-- Modal de confirmation de résiliation -->
<div class="modal fade" id="confirmResilierModal" tabindex="-1" role="dialog" aria-labelledby="confirmResilierModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmResilierModalLabel">Confirmation de résiliation</h5>
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

<!-- Modal de renouvellement -->
<div class="modal fade" id="renouvelerModal" tabindex="-1" role="dialog" aria-labelledby="renouvelerModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="renouvelerModalLabel">Renouveler le contrat</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="renouvelerForm">
          <div class="form-group">
            <label for="nouvelleDateDeb">Nouvelle date de début</label>
            <input type="date" class="form-control" id="nouvelleDateDeb" name="nouvelleDateDeb" required>
          </div>
          <div class="form-group">
            <label for="nouvelleDateFin">Nouvelle date de fin</label>
            <input type="date" class="form-control" id="nouvelleDateFin" name="nouvelleDateFin" required>
          </div>
          <input type="hidden" id="contratIdRenouveler" name="contratIdRenouveler">
          <button type="submit" class="btn btn-primary">Renouveler</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation de suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer ce contrat ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Supprimer</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal de confirmation d'acceptation -->
<div class="modal fade" id="confirmAcceptModal" tabindex="-1" role="dialog" aria-labelledby="confirmAcceptModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmAcceptModalLabel">Confirmation d'acceptation</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir accepter ce contrat ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-success" id="confirmAcceptBtn">Accepter</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal de confirmation de refus -->
<div class="modal fade" id="confirmRefuseModal" tabindex="-1" role="dialog" aria-labelledby="confirmRefuseModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmRefuseModalLabel">Confirmation de refus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir refuser ce contrat ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-danger" id="confirmRefuseBtn">Refuser</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    var deleteContratId;
    var renewContratId;
    var acceptContratId;
    var refuseContratId;

    // Ouvrir le modal et stocker l'ID du contrat à résilier
    $('.resilier-icon').on('click', function() {
        deleteContratId = $(this).data('contrat-id');
    });

    // Confirmer la résiliation
    $('#confirmResilierBtn').on('click', function() {
        window.location.href = 'resilierContrat.php?id=' + deleteContratId;
    });

    // Ouvrir le modal de renouvellement et stocker l'ID du contrat à renouveler
    $('.renouveler-icon').on('click', function() {
        renewContratId = $(this).data('contrat-id');
        $('#contratIdRenouveler').val(renewContratId);
    });

    // Soumettre le formulaire de renouvellement
    $('#renouvelerForm').on('submit', function(e) {
        e.preventDefault();
        var nouvelleDateDeb = $('#nouvelleDateDeb').val();
        var nouvelleDateFin = $('#nouvelleDateFin').val();
        var contratId = $('#contratIdRenouveler').val();

        $.post('renouvelerContrat.php', {
            id: contratId,
            nouvelleDateDeb: nouvelleDateDeb,
            nouvelleDateFin: nouvelleDateFin
        }, function(response) {
            window.location.reload();
        });
    });

    // Ouvrir le modal et stocker l'ID du contrat à supprimer
    $('.delete-icon').on('click', function() {
        deleteContratId = $(this).data('contrat-id');
    });

    // Confirmer la suppression
    $('#confirmDeleteBtn').on('click', function() {
        window.location.href = 'supprimerContrat.php?id=' + deleteContratId;
    });

    // Ouvrir le modal et stocker l'ID du contrat à accepter
    $('.accept-icon').on('click', function() {
        acceptContratId = $(this).data('contrat-id');
    });

    // Confirmer l'acceptation
    $('#confirmAcceptBtn').on('click', function() {
        window.location.href = 'accepterContrat.php?id=' + acceptContratId;
    });

    // Ouvrir le modal et stocker l'ID du contrat à refuser
    $('.refuse-icon').on('click', function() {
        refuseContratId = $(this).data('contrat-id');
    });

    // Confirmer le refus
    $('#confirmRefuseBtn').on('click', function() {
        window.location.href = 'refuserContrat.php?id=' + refuseContratId;
    });
});
</script>
</body>
</html>

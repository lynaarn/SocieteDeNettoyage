<?php
require_once("identifier.php");
require_once("connexiondb.php");

// Récupération des filtres et pagination
$nom = isset($_GET['nom']) ? $_GET['nom'] : "";
$prenom = isset($_GET['prenom']) ? $_GET['prenom'] : "";

$size = isset($_GET['size']) ? $_GET['size'] : 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;

// Requête principale pour récupérer les arrêts de travail de type 'démission'
$requete = "SELECT ArretDeTravail.NumA, users.id AS user_id, users.nom, users.prenom, ArretDeTravail.Date_deb, ArretDeTravail.Description
            FROM ArretDeTravail
            INNER JOIN employe ON ArretDeTravail.id = employe.id
            INNER JOIN users ON employe.id = users.id
            WHERE ArretDeTravail.Type = 'demission' 
            AND ArretDeTravail.statut = 'pas encore traité'
            AND users.nom LIKE '%$nom%' 
            AND users.prenom LIKE '%$prenom%'
            LIMIT $size OFFSET $offset";

// Requête pour compter le nombre total d'arrêts de travail de type 'démission'
$requeteCount = "SELECT count(*) as countA
                 FROM ArretDeTravail
                 INNER JOIN employe ON ArretDeTravail.id = employe.id
                 INNER JOIN users ON employe.id = users.id
                 WHERE ArretDeTravail.Type = 'demission' 
                 AND users.nom LIKE '%$nom%'
                 AND users.prenom LIKE '%$prenom%'";

$resultatF = $pdo->query($requete);
$resultatCount = $pdo->query($requeteCount);
$tabCount = $resultatCount->fetch();
$nbrArrets = $tabCount['countA'];
$reste = $nbrArrets % $size;

if ($reste === 0) {
    $nbrPage = $nbrArrets / $size;
} else {
    $nbrPage = floor($nbrArrets / $size) + 1;
}
?>
<?php 
 if ($_SESSION['user']['TypeCompte']=='RRH') {?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>arrêt De Travail</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
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
          <a class="nav-link " href="employes.php">Employés</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="congés.php">Congés</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="arrêtDeTravail.php">Arrêt de travail</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menuDemandeDemplois.php">Demande D'emplois</a>
        </li>
        <li class="nav-item  ">
            <a class="nav-link" href="compteRHH.php"><i class="fas fa-user fa-lg ml-5"></i></a> 
        </li>
        <li class="nav-item ">
            <a class="nav-link ml-2" href="deconnexionClient.php">Déconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <div class="row">
    <div class="col">
      <h2 class="center-text">Les demandes d'arrêt de travail</h2> 
      <div class="photo2"><img src="images/20.jpg" /></div>
    
      <form method="get" action="arrêtDeTravail.php" class="form-inline mb-3 justify-content-end">
        <input class="form-control mr-sm-2" type="search" name="nom" value="<?php echo $nom; ?>" placeholder="Rechercher par nom" aria-label="Search">
        <input class="form-control mr-sm-2" type="search" name="prenom" value="<?php echo $prenom; ?>" placeholder="Rechercher par prénom" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
      </form>

      <table class="table table-hover">
        <thead class="couleurTableau">
          <tr>
            <th scope="col">ID Employé</th>
            <th scope="col">Nom employé</th>
            <th scope="col">Prénom</th>
            <th scope="col">Date Début</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($arret = $resultatF->fetch()) { ?>
          <tr>
            <th data-toggle="modal" data-target="#demissionModal" data-description="<?php echo $arret['Description']; ?>"scope="row"><?php echo $arret['user_id']; ?></th>
            <td data-toggle="modal" data-target="#demissionModal" data-description="<?php echo $arret['Description']; ?>"><?php echo $arret['nom']; ?></td>
            <td data-toggle="modal" data-target="#demissionModal" data-description="<?php echo $arret['Description']; ?>"><?php echo $arret['prenom']; ?></td>
            <td data-toggle="modal" data-target="#demissionModal" data-description="<?php echo $arret['Description']; ?>"><?php echo $arret['Date_deb']; ?></td>
            <td class="action-icons">
              <a href="#" class="edit-icon2" data-toggle="modal" data-target="#confirmAcceptModal" data-id="<?php echo $arret['NumA']; ?>"><i class="fas fa-check"></i></a>
              <a href="#" class="delete-icon" data-toggle="modal" data-target="#confirmRejectModal" data-id="<?php echo $arret['NumA']; ?>"><i class="fas fa-user-times"></i></a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>

      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center paginationModif">
          <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
            <a class="page-link" href="arrêtDeTravail.php?page=<?php echo $page - 1; ?>" tabindex="-1" aria-disabled="true">Précédent</a>
          </li>
          <?php for ($i = 1; $i <= $nbrPage; $i++) { ?>
          <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
            <a class="page-link" href="arrêtDeTravail.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
          </li>
          <?php } ?>
          <li class="page-item <?php if ($page >= $nbrPage) echo 'disabled'; ?>">
            <a class="page-link" href="arrêtDeTravail.php?page=<?php echo $page + 1; ?>">Suivant</a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</div>

<!-- Modal pour afficher la description -->
<div class="modal fade" id="demissionModal" tabindex="-1" role="dialog" aria-labelledby="demissionModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="demissionModalLabel">Lettre de démission</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="demissionContent">
        <!-- La description sera insérée ici par JavaScript -->
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
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
        Êtes-vous sûr de vouloir accepter cette demande d'arrêt de travail ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-success" id="confirmAcceptBtn">Accepter</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal de confirmation de refus -->
<div class="modal fade" id="confirmRejectModal" tabindex="-1" role="dialog" aria-labelledby="confirmRejectModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmRejectModalLabel">Confirmation de refus</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir refuser cette demande d'arrêt de travail ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-danger" id="confirmRejectBtn">Refuser</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
  var arretId;

  // Ouvrir le modal de confirmation d'acceptation
  $('.edit-icon2').on('click', function() {
    arretId = $(this).data('id');
  });

  // Confirmer l'acceptation
  $('#confirmAcceptBtn').on('click', function() {
    window.location.href = 'accepterArret.php?id=' + arretId;
  });

  // Ouvrir le modal de confirmation de refus
  $('.delete-icon').on('click', function() {
    arretId = $(this).data('id');
  });

  // Confirmer le refus
  $('#confirmRejectBtn').on('click', function() {
    window.location.href = 'refuserArret.php?id=' + arretId;
  });

  // Ouvrir le modal de description
  $('#demissionModal').on('show.bs.modal', function (event) {
    var button = $(event.relatedTarget); 
    var description = button.data('description'); 

    var modal = $(this);
    modal.find('.modal-body').text(description);
  });
});
</script>

</body>
</html>
<?php } ?>

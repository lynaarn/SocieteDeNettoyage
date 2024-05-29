<?php
require_once("identifier.php");
require_once("connexiondb.php");

$noms = isset($_GET['NomS']) ? $_GET['NomS'] : "";
$types = isset($_GET['TypeS']) ? $_GET['TypeS'] : "all";

$size = isset($_GET['size']) ? $_GET['size'] : 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;

if ($types == "all") {
    $requete = "SELECT * FROM Service
               where NomS like '%$noms%'
               limit $size
               offset $offset";
    $requeteCount = "select count(*) countS from Service
               where NomS like '%$noms%'";
} else {
    $requete = "SELECT * FROM Service
               where NomS like '%$noms%'
               and TypeS='$types'
               limit $size
               offset $offset";
    $requeteCount = "select count(*) countS from Service
               where NomS like '%$noms%' and TypeS='$types'";
}
$resultatF = $pdo->query($requete);

$resultatCount = $pdo->query($requeteCount);
$tabCount = $resultatCount->fetch();
$nbrService = $tabCount['countS'];
$reste = $nbrService % $size;

if ($reste === 0)
    $nbrPage = $nbrService / $size;
else
    $nbrPage = floor($nbrService / $size) + 1;
?>
<?php 
 if ($_SESSION['user']['TypeCompte']=='Admin') {?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capiclean</title>
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
    <a class="navbar-brand" href="index.php"><img src="images/logoo.png" alt="Capiclean Logo "></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="service.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Menuclients.php">Clients</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="personnels.php">Personnels</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contrats.php">Contrats</a>
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

<div class="container mt-5">
  <div class="row">
    <div class="col">
      <h2 class="center-text">Les services</h2>
      <div class="photo"><img src="images/3.jpg" /></div>

      <form method="get" action="service.php" class="form-inline mb-3 justify-content-end">
        <input class="form-control mr-sm-2" type="search" 
        name="NomS" value="<?php echo $noms ?>" placeholder="Rechercher un service" aria-label="Search">
        <select name="TypeS" id="TypeS" class="form-control mr-sm-2">
          <option value="all" <?php if ($types === "all") echo "selected" ?>>Tout les services</option>
          <option value="nettoyage residentiel" <?php if ($types === "nettoyage residentiel") echo "selected" ?>>Nettoyage résidentiel</option>
          <option value="nettoyage commercial" <?php if ($types === "nettoyage commercial") echo "selected" ?>>Nettoyage commercial</option>
          <option value="nettoyage industriel" <?php if ($types === "nettoyage industriel") echo "selected" ?>>Nettoyage industriel</option>
          <option value="autres services" <?php if ($types === "autres services") echo "selected" ?>>Autres services</option>
        </select>
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
      </form>

      <table class="table table-hover">
        <thead class="couleurTableau">
          <tr>
            <th scope="col">Code service</th>
            <th scope="col">Nom service</th>
            <th scope="col">Type service</th>
            <th scope="col">Tarif heure</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($service = $resultatF->fetch()) { ?>
          <tr>
            <th><?php echo $service['CodeS'] ?></th>
            <td><?php echo $service['NomS'] ?></td>
            <td><?php echo $service['TypeS'] ?></td>
            <td><?php echo $service['TarifHr'] ?></td>
            <td class="action-icons">
              <a href="modifierService.php?codes=<?php echo $service['CodeS'] ?>" class="edit-icon"><i class="fa fa-pencil-alt"></i></a>
              <a href="#" class="delete-icon" data-toggle="modal" data-target="#confirmDeleteModal" data-service-id="<?php echo $service['CodeS'] ?>"><i class="fa fa-trash"></i></a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>

      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center paginationModif">
          <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
            <a class="page-link" href="service.php?page=<?php echo $page - 1; ?>&TypeS=<?php echo $types; ?>" tabindex="-1" aria-disabled="true">Précédent</a>
          </li>
          <?php for ($i = 1; $i <= $nbrPage; $i++) { ?>
          <li class="page-item <?php if ($i == $page) echo 'active'; ?>"><a class="page-link" href="service.php?page=<?php echo $i ?>&TypeS=<?php echo $types; ?>"><?php echo $i ?></a></li>
          <?php } ?>
          <li class="page-item <?php if ($page >= $nbrPage) echo 'disabled'; ?>">
            <a class="page-link" href="service.php?page=<?php echo $page + 1 ?>&TypeS=<?php echo $types; ?>">Suivant</a>
          </li>
          <a href="ajouterService.php" class="btn ajout mb-3">Ajouter un service</a>
        </ul>
      </nav>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Confirmation de la suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer ce service ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Supprimer</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
  var deleteServiceId;

  // Ouvrir le modal et stocker l'ID du service à supprimer
  $('.delete-icon').on('click', function() {
    deleteServiceId = $(this).data('service-id');
  });

  // Confirmer la suppression
  $('#confirmDeleteBtn').on('click', function() {
    window.location.href = 'supprimerService.php?codes=' + deleteServiceId;
  });
});
</script>
</body>
</html>
<?php } ?>
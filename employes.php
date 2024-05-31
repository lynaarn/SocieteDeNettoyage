<?php
require_once("identifier.php");
require_once("connexiondb.php");

// Récupération des filtres et pagination
$nom = isset($_GET['nom']) ? $_GET['nom'] : "";
$statut = isset($_GET['statut']) ? $_GET['statut'] : "Tous";

$size = isset($_GET['size']) ? $_GET['size'] : 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;

// Requête principale pour récupérer les employés
if ($statut != "Tous") {
  $requete = "SELECT users.id AS user_id, nom, prenom, statut FROM users INNER JOIN employe ON users.id = employe.id WHERE nom LIKE '%$nom%' AND statut='$statut' LIMIT $size OFFSET $offset";
} else {
  $requete = "SELECT users.id AS user_id, nom, prenom, statut FROM users INNER JOIN employe ON users.id = employe.id WHERE nom LIKE '%$nom%' LIMIT $size OFFSET $offset";
}

$resultat = $pdo->query($requete);

// Requête pour compter le nombre total d'employés
$requeteCount = "SELECT count(*) as countE 
                 FROM users INNER JOIN employe ON users.id = employe.id
                 WHERE nom LIKE '%$nom%' ";
if ($statut !== "Tous") {
  $requeteCount .= " AND statut = '$statut'";
}

$resultatCount = $pdo->query($requeteCount);
$tabCount = $resultatCount->fetch();
$nbrEmployes = $tabCount['countE'];
$reste = $nbrEmployes % $size;

if ($reste === 0) {
  $nbrPage = $nbrEmployes / $size;
} else {
  $nbrPage = floor($nbrEmployes / $size) + 1;
}
?>
<?php 
 if ($_SESSION['user']['TypeCompte']=='RRH') {?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employés</title>
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
        <li class="nav-item">
          <a class="nav-link active" href="employes.php">Employés</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="congés.php">Congés</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="arrêtDeTravail.php">Arrêt de travail</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menuDemandeDemplois.php">Demande d'emplois</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="compteRHH.php"><i class="fas fa-user fa-lg ml-5"></i></a> 
        </li>
        <li class="nav-item">
          <a class="nav-link ml-2" href="deconnexionClient.php">Déconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <div class="row">
    <div class="col">
      <h2 class="center-text">La liste des employés <!-- (<?php echo $nbrEmployes; ?>) --></h2> 
      <div class="photo2"><img src="images/19.jpg" /></div>
      <form method="get" action="employes.php" class="form-inline mb-3 justify-content-end">
        <input class="form-control mr-sm-2" type="search" name="nom" value="<?php echo $nom; ?>" placeholder="Rechercher un employé" aria-label="Search">
        <select name="statut" id="statut" class="form-control mr-sm-2">
            <option value="Tous" <?php if ($statut === "Tous") echo "selected"; ?>>Tous les types</option>
            <?php
            $typesReq = "SELECT DISTINCT statut FROM employe";
            $typesResult = $pdo->query($typesReq);
            while ($typeData = $typesResult->fetch()) {
                $selected = $typeData['statut'] == $statut ? 'selected' : '';
                echo "<option value='{$typeData['statut']}' $selected>{$typeData['statut']}</option>";
            }
            ?>
        </select>
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
      </form>

      <table class="table table-hover">
        <thead class="couleurTableau">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Statut</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($employe = $resultat->fetch()) { ?>
          <tr>
            <th onclick="window.location='informationsEmploye.php?id=<?php echo $employe['user_id']; ?>'" scope="row"><?php echo $employe['user_id']; ?></th>
            <td onclick="window.location='informationsEmploye.php?id=<?php echo $employe['user_id']; ?>'"><?php echo $employe['nom']; ?></td>
            <td onclick="window.location='informationsEmploye.php?id=<?php echo $employe['user_id']; ?>'"><?php echo $employe['prenom']; ?></td>
            <td onclick="window.location='informationsEmploye.php?id=<?php echo $employe['user_id']; ?>'"><span class="<?php echo ($employe['statut'] == 'Actif') ? 'status-actif' : 'status-autre'; ?>"><?php echo $employe['statut']; ?></span></td>
            <td class="action-icons">
              <a href="modifierEmployes.php?id=<?php echo $employe['user_id']; ?>" class="edit-icon"><i class="fa fa-pencil-alt"></i></a>
              <a href="#" class="delete-icon" data-toggle="modal" data-target="#confirmDeleteModal" data-employee-id="<?php echo $employe['user_id']; ?>"><i class="fa fa-trash"></i></a>
              <?php if (in_array($employe['statut'], ['Actif', 'Congé', 'Maladie', 'Maternité/Paternité'])) { ?>
              <a href="#" class="licencier-icon" data-toggle="modal" data-target="#confirmLicencierModal" data-employee-id="<?php echo $employe['user_id']; ?>"><i class="fas fa-user-times"></i></a>
              <?php } ?>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>

      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center paginationModif">
          <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
            <a class="page-link" href="employes.php?page=<?php echo $page - 1; ?>&statut=<?php echo $statut; ?>" tabindex="-1" aria-disabled="true">Précédent</a>
          </li>
          <?php for ($i = 1; $i <= $nbrPage; $i++) { ?>
          <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
            <a class="page-link" href="employes.php?page=<?php echo $i; ?>&statut=<?php echo $statut; ?>"><?php echo $i; ?></a>
          </li>
          <?php } ?>
          <li class="page-item <?php if ($page >= $nbrPage) echo 'disabled'; ?>">
            <a class="page-link" href="employes.php?page=<?php echo $page + 1; ?>&statut=<?php echo $statut; ?>">Suivant</a>
          </li>
          <a href="ajouterEmployes.php" class="btn ajout mb-3">Ajouter un employé</a>
        </ul>
      </nav>
    </div>
  </div>
</div>

<!-- Modal de confirmation de suppression -->
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
        Êtes-vous sûr de vouloir supprimer cet employé ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Supprimer</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal de confirmation de licenciement -->
<div class="modal fade" id="confirmLicencierModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel2">Confirmation de licenciement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir licencier cet employé ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-danger" id="confirmLicencierBtn">Licencier</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
  var deleteEmployeeId;
  var licencierEmployeeId;

  // Ouvrir le modal de suppression et stocker l'ID de l'employé à supprimer
  $('.delete-icon').on('click', function() {
    deleteEmployeeId = $(this).data('employee-id');
  });

  // Confirmer la suppression
  $('#confirmDeleteBtn').on('click', function() {
    window.location.href = 'supprimerEmployes.php?id=' + deleteEmployeeId;
  });

  // Ouvrir le modal de licenciement et stocker l'ID de l'employé à licencier
  $('.licencier-icon').on('click', function() {
    licencierEmployeeId = $(this).data('employee-id');
  });

  // Confirmer le licenciement
  $('#confirmLicencierBtn').on('click', function() {
    window.location.href = 'licencierEmploye.php?id=' + licencierEmployeeId;
  });
});
</script>
</body>
</html>
<?php } ?>

<?php
require_once("identifier.php");
require_once("connexiondb.php");

$nom = isset($_GET['nom']) ? $_GET['nom'] : "";
$prenom = isset($_GET['prenom']) ? $_GET['prenom'] : "";
$role = isset($_GET['role']) ? $_GET['role'] : "all";

$size = isset($_GET['size']) ? $_GET['size'] : 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;

$requete = "SELECT users.id AS user_id, nom, prenom, nomR 
            FROM users
            INNER JOIN personnel_administratif ON users.id = personnel_administratif.id
            INNER JOIN roles ON personnel_administratif.role = roles.numR
            WHERE nom LIKE '%$nom%' 
            AND prenom LIKE '%$prenom%'";

if ($role !== "all") {
    $requete .= " AND personnel_administratif.role = $role";
}

$requete .= " LIMIT $size OFFSET $offset";

$requeteCount = "SELECT count(*) as countP
                 FROM users
                 INNER JOIN personnel_administratif ON users.id = personnel_administratif.id
                 INNER JOIN roles ON personnel_administratif.role = roles.numR
                 WHERE nom LIKE '%$nom%'
                 AND prenom LIKE '%$prenom%'";

if ($role !== "all") {
    $requeteCount .= " AND personnel_administratif.role = $role";
}

$resultatF = $pdo->query($requete);
$resultatCount = $pdo->query($requeteCount);
$tabCount = $resultatCount->fetch();
$nbrPersonnels = $tabCount['countP'];
$reste = $nbrPersonnels % $size;

if ($reste === 0) {
    $nbrPage = $nbrPersonnels / $size;
} else {
    $nbrPage = floor($nbrPersonnels / $size) + 1;
}
?>
<?php 
 if ($_SESSION['user']['TypeCompte']=='Admin') {?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Personnels</title>
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
    <a class="navbar-brand" href="index.html"><img src="images/logoo.png" alt="Capiclean Logo "></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent"> 
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="service.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Menuclients.php">Clients</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="personnels.php">Personnels</a>
        </li>
        <li class="nav-item">
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

<div class="container mt-5">
  <div class="row">
    <div class="col">
      <h2 class="center-text">La liste des Personnels (<?php echo $nbrPersonnels; ?>)</h2> 
      <div class="photo2"><img src="images/7.jpg" /></div>
    
      <form method="get" action="personnels.php" class="form-inline mb-3 justify-content-end">
        <input class="form-control mr-sm-2" type="search" name="nom" value="<?php echo $nom; ?>" placeholder="Rechercher par nom" aria-label="Search">
        <input class="form-control mr-sm-2" type="search" name="prenom" value="<?php echo $prenom; ?>" placeholder="Rechercher par prénom" aria-label="Search">
        <select name="role" id="role" class="form-control mr-sm-2">
          <option value="all" <?php if ($role === "all") echo "selected"; ?>>Tous les rôles</option>
          <?php
          $rolesReq = "SELECT * FROM roles";
          $rolesResult = $pdo->query($rolesReq);
          while ($roleData = $rolesResult->fetch()) {
              $selected = $roleData['numR'] == $role ? 'selected' : '';
              echo "<option value='{$roleData['numR']}' $selected>{$roleData['nomR']}</option>";
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
            <th scope="col">Rôle</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($personnel = $resultatF->fetch()) { ?>
          <tr>
            <th onclick="window.location='informationsPersonnel.php?id=<?php echo $personnel['user_id']; ?>'"><?php echo $personnel['user_id']; ?></th>
            <td onclick="window.location='informationsPersonnel.php?id=<?php echo $personnel['user_id']; ?>'"><?php echo $personnel['nom']; ?></td>
            <td onclick="window.location='informationsPersonnel.php?id=<?php echo $personnel['user_id']; ?>'"><?php echo $personnel['prenom']; ?></td>
            <td onclick="window.location='informationsPersonnel.php?id=<?php echo $personnel['user_id']; ?>'"><?php echo $personnel['nomR']; ?></td>
            <td class="action-icons">
              <a href="modifierPersonnel.php?id=<?php echo $personnel['user_id']; ?>" class="edit-icon"><i class="fa fa-pencil-alt"></i></a>
              <a href="#" class="delete-icon" data-toggle="modal" data-target="#confirmDeleteModal" data-personnel-id="<?php echo $personnel['user_id']; ?>"><i class="fa fa-trash"></i></a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>

      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center paginationModif">
          <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
            <a class="page-link" href="personnels.php?page=<?php echo $page - 1; ?>&role=<?php echo $role; ?>" tabindex="-1" aria-disabled="true">Précédent</a>
          </li>
          <?php for ($i = 1; $i <= $nbrPage; $i++) { ?>
          <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
            <a class="page-link" href="personnels.php?page=<?php echo $i; ?>&role=<?php echo $role; ?>"><?php echo $i; ?></a>
          </li>
          <?php } ?>
          <li class="page-item <?php if ($page >= $nbrPage) echo 'disabled'; ?>">
            <a class="page-link" href="personnels.php?page=<?php echo $page + 1; ?>&role=<?php echo $role; ?>">Suivant</a>
          </li>
          <a href="ajouterPersonnel.php" class="btn ajout mb-3">Ajouter un personnel</a>
        </ul>
      </nav>
     </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation de la suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer ce personnel ?
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
  var deletePersonnelId;

  // Ouvrir le modal et stocker l'ID du personnel à supprimer
  $('.delete-icon').on('click', function() {
    deletePersonnelId = $(this).data('personnel-id');
  });

  // Confirmer la suppression
  $('#confirmDeleteBtn').on('click', function() {
    window.location.href = 'supprimerPersonnels.php?id=' + deletePersonnelId;
  });
});
</script>
</body>
</html>
<?php } ?> 
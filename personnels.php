<?php
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
    $requete .= " AND role = '$role'";
}

$requete .= " LIMIT $size OFFSET $offset";

$requeteCount = "SELECT count(*) as countP
                 FROM users
                 INNER JOIN personnel_administratif ON users.id = personnel_administratif.id
                 INNER JOIN roles ON personnel_administratif.role = roles.numR
                 WHERE nom LIKE '%$nom%'
                 AND prenom LIKE '%$prenom%'";

if ($role !== "all") {
    $requeteCount .= " AND role = '$role'";
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
    <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="Capiclean Logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="service.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Menuclients.php">Clients</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="personnels.php">Personnels</a>
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
              $selected = $roleData['id'] == $role ? 'selected' : '';
              echo "<option value='{$roleData['id']}' $selected>{$roleData['nomR']}</option>";
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
              <a href="supprimerPersonnels.php?id=<?php echo $personnel['user_id']; ?>" class="delete-icon"><i class="fas fa-trash"></i></a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>

      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center paginationModif">
          <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
            <a class="page-link" href="personnels.php?page=<?php echo $page - 1; ?>" tabindex="-1" aria-disabled="true">Précédent</a>
          </li>
          <?php for ($i = 1; $i <= $nbrPage; $i++) { ?>
          <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
            <a class="page-link" href="personnels.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
          </li>
          <?php } ?>
          <li class="page-item <?php if ($page >= $nbrPage) echo 'disabled'; ?>">
            <a class="page-link" href="personnels.php?page=<?php echo $page + 1; ?>">Suivant</a>
          </li>
        </ul>
      </nav>

      <a href="ajouterPersonnel.php" class="btn ajout mb-3">Ajouter un personnel</a>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

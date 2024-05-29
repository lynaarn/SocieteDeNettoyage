<?php
require_once("identifier.php");
require_once("connexiondb.php");

// Récupération des filtres et pagination
$nom = isset($_GET['nom']) ? $_GET['nom'] : "";
$size = isset($_GET['size']) ? $_GET['size'] : 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;

// Requête principale pour récupérer les demandes de congés
$requete = "
    SELECT arret.NumA, arret.Date_deb, arret.Date_fin, arret.Type, users.nom, users.prenom
    FROM ArretDeTravail arret
    INNER JOIN employe emp ON arret.id = emp.id
    INNER JOIN users ON emp.id = users.id
    WHERE arret.statut = 'pas encore traité' AND users.nom LIKE '%$nom%'
    And  arret.Type IN ( 'Congé', 'Maladie', 'Maternité/Paternité')
    LIMIT $size OFFSET $offset
";

// Requête pour compter le nombre total de demandes de congés
$requeteCount = "
    SELECT COUNT(*) as countC
    FROM ArretDeTravail arret
    INNER JOIN employe emp ON arret.id = emp.id
    INNER JOIN users ON emp.id = users.id
    WHERE arret.statut = 'pas encore traité' AND users.nom LIKE '%$nom%'
";

$resultatF = $pdo->query($requete);
$resultatCount = $pdo->query($requeteCount);
$tabCount = $resultatCount->fetch();
$nbrConges = $tabCount['countC'];
$reste = $nbrConges % $size;

if ($reste === 0) {
    $nbrPage = $nbrConges / $size;
} else {
    $nbrPage = floor($nbrConges / $size) + 1;
}
?>
<?php 
 if ($_SESSION['user']['TypeCompte']=='RRH') {?>
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
    <a class="navbar-brand" href="index.html"><img src="images/logoo.png" alt="Capiclean Logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent"> <!-- Ajoutez la classe justify-content-center pour centrer les éléments -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="employes.php">Employés</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link active" href="congés.php">Congés</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="arrêtDeTravail.php">Arrêt de travail</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="demandeDemplois.php">Demande d'emplois</a>
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
      <h2 class="center-text">Les demandes de congés</h2> 
      <div class="photo2"><img src="images/23.jpg" /></div>
    
      <form method="get" action="congés.php" class="form-inline mb-3 justify-content-end"> <!-- Utilisez la classe justify-content-end pour aligner à droite -->
        <input class="form-control mr-sm-2" type="search" name="nom" value="<?php echo $nom; ?>" placeholder="Rechercher par nom d'employé" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
      </form>

      <table class="table table-hover">
        <thead class="couleurTableau">
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Date début</th>
            <th scope="col">Date fin</th>
            <th scope="col">Type</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($conge = $resultatF->fetch()) { ?>
          <tr>
            <th scope="row"><?php echo $conge['NumA']; ?></th>
            <td><?php echo $conge['nom']; ?></td>
            <td><?php echo $conge['prenom']; ?></td>
            <td><?php echo $conge['Date_deb']; ?></td>
            <td><?php echo $conge['Date_fin']; ?></td>
            <td><?php echo $conge['Type']; ?></td>
            <td class="action-icons">
              <a href="accepterConge.php?id=<?php echo $conge['NumA']; ?>" class="edit-icon2"><i class="fas fa-check"></i></a>
              <a href="refuserConge.php?id=<?php echo $conge['NumA']; ?>" class="delete-icon"><i class="fas fa-user-times"></i></a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center paginationModif">
          <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
            <a class="page-link" href="congés.php?page=<?php echo $page - 1; ?>" tabindex="-1" aria-disabled="true">Précédent</a>
          </li>
          <?php for ($i = 1; $i <= $nbrPage; $i++) { ?>
          <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
            <a class="page-link" href="congés.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
          </li>
          <?php } ?>
          <li class="page-item <?php if ($page >= $nbrPage) echo 'disabled'; ?>">
            <a class="page-link" href="congés.php?page=<?php echo $page + 1; ?>">Suivant</a>
          </li>
        </ul>
      </nav>
      
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.amazonaws.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php } ?> 


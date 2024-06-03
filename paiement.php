<?php
require_once("identifier.php");
require_once("connexiondb.php");

// Traitement de la recherche
$search = isset($_GET['search']) ? $_GET['search'] : '';

// Configuration de la pagination
$size = isset($_GET['size']) ? $_GET['size'] : 10;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;

// Requête pour récupérer les réservations avec date_prestation < date courante et filtrage par recherche
$requeteReservations = "
    SELECT r.*, c.nom, c.prenom
    FROM reservation r
    JOIN users c ON r.client_id = c.id
    WHERE r.date_prestation < CURDATE()
    AND (r.codeR LIKE :search OR c.nom LIKE :search OR c.prenom LIKE :search)
    LIMIT :size OFFSET :offset
";
$stmtReservations = $pdo->prepare($requeteReservations);
$stmtReservations->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
$stmtReservations->bindValue(':size', $size, PDO::PARAM_INT);
$stmtReservations->bindValue(':offset', $offset, PDO::PARAM_INT);
$stmtReservations->execute();

// Calculer le montant total des réservations
$montant_total = 0;
$reservations = [];
while ($reservation = $stmtReservations->fetch()) {
    $montant_total += $reservation['montant'];
    $reservations[] = $reservation;
}

// Requête pour le comptage total des réservations pour la pagination
$requeteCount = "
    SELECT COUNT(*) as countR
    FROM reservation r
    JOIN users c ON r.client_id = c.id
    WHERE r.date_prestation < CURDATE()
    AND (r.codeR LIKE :search OR c.nom LIKE :search OR c.prenom LIKE :search)
";
$stmtCount = $pdo->prepare($requeteCount);
$stmtCount->bindValue(':search', '%' . $search . '%', PDO::PARAM_STR);
$stmtCount->execute();
$tabCount = $stmtCount->fetch();
$nbrReservation = $tabCount['countR'];
$reste = $nbrReservation % $size;

$nbrPage = $reste === 0 ? $nbrReservation / $size : floor($nbrReservation / $size) + 1;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiements</title>
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
        <li class="nav-item">
          <a class="nav-link" href="personnels.php">Personnels</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menucontrat.php">Contrats</a>
        </li>
        <li class="nav-item active">
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
      <h2 class="center-text">La liste des paiements :</h2> 
      <div class="photo3"><img src="images/9.jpg" /></div>
    
      <form class="form-inline mb-3 justify-content-end" method="GET" action="paiement.php"> <!-- Utilisez la classe justify-content-end pour aligner à droite -->
        <input class="form-control mr-sm-2" type="search" name="search" placeholder="Rechercher un paiement" aria-label="Search" value="<?php echo htmlspecialchars($search); ?>">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
      </form>

      <table class="table table-hover">
        <thead class="couleurTableau">
          <tr>
            <th scope="col">Num réservation</th>
            <th scope="col">Nom client</th>
            <th scope="col">Date réservation</th>
            <th scope="col">Date prestation</th>
            <th scope="col">Heure prestation</th>
            <th scope="col">Adresse prestation</th>
            <th scope="col">Montant</th>
            <th scope="col">État</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($reservations as $reservation) { ?>
          <tr>
            <th scope="row"><?php echo htmlspecialchars($reservation['codeR']); ?></th>
            <td><?php echo htmlspecialchars($reservation['nom'] . ' ' . $reservation['prenom']); ?></td>
            <td><?php echo htmlspecialchars($reservation['date_reservation']); ?></td>
            <td><?php echo htmlspecialchars($reservation['date_prestation']); ?></td>
            <td><?php echo htmlspecialchars($reservation['heure_prestation']); ?></td>
            <td><?php echo htmlspecialchars($reservation['adresse_prestation']); ?></td>
            <td><?php echo htmlspecialchars($reservation['montant']); ?></td>
            <td><?php echo htmlspecialchars($reservation['etat']); ?></td>
            <td class="action-icons">
              <a href="supprimerPersonnels.php" class="delete-icon"><i class="fa fa-trash"></i></a>
              <a href="modifierPersonnels.php" class="edit-icon"><i class="fa fa-pencil-alt"></i></a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>
      
      <h3 class="center-text">Montant total des réservations: <?php echo htmlspecialchars($montant_total); ?> €</h3>

      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center paginationModif">
          <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
            <a class="page-link" href="paiement.php?page=<?php echo $page - 1; ?>&search=<?php echo urlencode($search); ?>" tabindex="-1" aria-disabled="true">Précédent</a>
          </li>
          <?php for ($i = 1; $i <= $nbrPage; $i++) { ?>
          <li class="page-item <?php if ($i == $page) echo 'active'; ?>"><a class="page-link" href="paiement.php?page=<?php echo $i ?>&search=<?php echo urlencode($search); ?>"><?php echo $i ?></a></li>
          <?php } ?>
          <li class="page-item <?php if ($page >= $nbrPage) echo 'disabled'; ?>">
            <a class="page-link" href="paiement.php?page=<?php echo $page + 1 ?>&search=<?php echo urlencode($search); ?>">Suivant</a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

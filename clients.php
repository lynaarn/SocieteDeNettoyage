<?php
require_once("identifier.php");
require_once("connexiondb.php");

// Récupération des filtres et pagination
$nom = isset($_GET['nom']) ? $_GET['nom'] : "";
$prenom = isset($_GET['prenom']) ? $_GET['prenom'] : "";
$type_client = isset($_GET['type_client']) ? $_GET['type_client'] : "all";

$size = isset($_GET['size']) ? $_GET['size'] : 5;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;

// Requête principale pour récupérer les clients
$requete = "SELECT users.id AS user_id, nom, prenom, type_client 
            FROM users
            INNER JOIN client ON users.id = client.id
            WHERE nom LIKE '%$nom%' 
            AND prenom LIKE '%$prenom%'
            AND etat=1";

if ($type_client !== "all") {
    $requete .= " AND type_client = '$type_client'";
}

$requete .= " LIMIT $size OFFSET $offset";

// Requête pour compter le nombre total de clients
$requeteCount = "SELECT count(*) as countC
                 FROM users
                 INNER JOIN client ON users.id = client.id
                 WHERE nom LIKE '%$nom%'
                 AND prenom LIKE '%$prenom%'
                 AND etat=1";

if ($type_client !== "all") {
    $requeteCount .= " AND type_client = '$type_client'";
}

$resultatF = $pdo->query($requete);
$resultatCount = $pdo->query($requeteCount);
$tabCount = $resultatCount->fetch();
$nbrClients = $tabCount['countC'];
$reste = $nbrClients % $size;

if ($reste === 0) {
    $nbrPage = $nbrClients / $size;
} else {
    $nbrPage = floor($nbrClients / $size) + 1;
}
?>
<?php 
 if ($_SESSION['user']['TypeCompte']=='Admin') {?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clients</title>
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
        <li class="nav-item active">
          <a class="nav-link" href="Menuclients.php">Clients</a>
        </li>
        <li class="nav-item">
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
      <h2 class="center-text">La liste des Clients (<?php echo $nbrClients; ?>)</h2> 
      <div class="photo2"><img src="images/60.jpg" /></div>
    
      <form method="get" action="clients.php" class="form-inline mb-3 justify-content-end">
        <input class="form-control mr-sm-2" type="search" name="nom" value="<?php echo $nom; ?>" placeholder="Rechercher par nom" aria-label="Search">
        <input class="form-control mr-sm-2" type="search" name="prenom" value="<?php echo $prenom; ?>" placeholder="Rechercher par prénom" aria-label="Search">
        <select name="type_client" id="type_client" class="form-control mr-sm-2">
          <option value="all" <?php if ($type_client === "all") echo "selected"; ?>>Tous les types</option>
          <?php
          $typesReq = "SELECT DISTINCT type_client FROM client";
          $typesResult = $pdo->query($typesReq);
          while ($typeData = $typesResult->fetch()) {
              $selected = $typeData['type_client'] == $type_client ? 'selected' : '';
              echo "<option value='{$typeData['type_client']}' $selected>{$typeData['type_client']}</option>";
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
            <th scope="col">Type</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php while ($client = $resultatF->fetch()) { ?>
          <tr>
            <th onclick="window.location='informationsClient.php?id=<?php echo $client['user_id']; ?>'"><?php echo $client['user_id']; ?></th>
            <td onclick="window.location='informationsClient.php?id=<?php echo $client['user_id']; ?>'"><?php echo $client['nom']; ?></td>
            <td onclick="window.location='informationsClient.php?id=<?php echo $client['user_id']; ?>'"><?php echo $client['prenom']; ?></td>
            <td onclick="window.location='informationsClient.php?id=<?php echo $client['user_id']; ?>'"><?php echo $client['type_client']; ?></td>
            <td class="action-icons">
              <a href="#" class="blacklist-icon" data-toggle="modal" data-target="#confirmBlacklistModal" data-client-id="<?php echo $client['user_id']; ?>"><i class="fas fa-ban"></i></a>
            </td>
          </tr>
          <?php } ?>
        </tbody>
      </table>

      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center paginationModif">
          <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
            <a class="page-link" href="clients.php?page=<?php echo $page - 1; ?>&type_client=<?php echo $type_client; ?>" tabindex="-1" aria-disabled="true">Précédent</a>
          </li>
          <?php for ($i = 1; $i <= $nbrPage; $i++) { ?>
          <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
            <a class="page-link" href="clients.php?page=<?php echo $i; ?>&type_client=<?php echo $type_client; ?>"><?php echo $i; ?></a>
          </li>
          <?php } ?>
          <li class="page-item <?php if ($page >= $nbrPage) echo 'disabled'; ?>">
            <a class="page-link" href="clients.php?page=<?php echo $page + 1; ?>&type_client=<?php echo $type_client; ?>">Suivant</a>
          </li>
          <a href="ajouterClient.php" class="btn ajout mb-3">Ajouter un client</a>
        </ul>
      </nav>
    </div>
  </div>
</div>

<!-- Modal pour la confirmation de mise en liste noire -->
<div class="modal fade" id="confirmBlacklistModal" tabindex="-1" role="dialog" aria-labelledby="confirmBlacklistModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmBlacklistModalLabel">Confirmation de mise en liste noire</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir mettre ce client dans la liste noire ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-danger" id="confirmBlacklistBtn">Mettre en liste noire</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
  var blacklistClientId;

  // Ouvrir le modal de confirmation de liste noire et stocker l'ID du client
  $('.blacklist-icon').on('click', function() {
    blacklistClientId = $(this).data('client-id');
  });

  // Confirmer la mise en liste noire
  $('#confirmBlacklistBtn').on('click', function() {
    window.location.href = 'listeNoireClient.php?id=' + blacklistClientId;
  });
});
</script>
</body>
</html>
<?php } ?>

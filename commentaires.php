<?php
require_once("identifier.php");
require_once("connexiondb.php");

// Récupération des filtres et pagination
$contenu = isset($_GET['contenu']) ? $_GET['contenu'] : "";
$note = isset($_GET['note']) ? $_GET['note'] : "all";

$size = isset($_GET['size']) ? $_GET['size'] : 6;
$page = isset($_GET['page']) ? $_GET['page'] : 1;
$offset = ($page - 1) * $size;

// Requête principale pour récupérer les commentaires
$requete = "SELECT commentaire.CodeC, commentaire.contenu, commentaire.note, commentaire.date_creation, users.nom, users.prenom 
            FROM commentaire
            INNER JOIN client ON commentaire.client_id = client.id
            INNER JOIN users ON client.id = users.id
            WHERE commentaire.contenu LIKE '%$contenu%'";

if ($note !== "all") {
    $requete .= " AND commentaire.note = $note";
}

$requete .= " LIMIT $size OFFSET $offset";

// Requête pour compter le nombre total de commentaires
$requeteCount = "SELECT COUNT(*) as countC
                 FROM commentaire
                 INNER JOIN client ON commentaire.client_id = client.id
                 INNER JOIN users ON client.id = users.id
                 WHERE commentaire.contenu LIKE '%$contenu%'";

if ($note !== "all") {
    $requeteCount .= " AND commentaire.note = $note";
}

$resultatF = $pdo->query($requete);
$resultatCount = $pdo->query($requeteCount);
$tabCount = $resultatCount->fetch();
$nbrCommentaires = $tabCount['countC'];
$reste = $nbrCommentaires % $size;

if ($reste === 0) {
    $nbrPage = $nbrCommentaires / $size;
} else {
    $nbrPage = floor($nbrCommentaires / $size) + 1;
}
?>
<?php 
 if ($_SESSION['user']['TypeCompte']=='Admin') {?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commentaires</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 70px; /* Fixe la hauteur de la barre de navigation */
        }
        .card {
            margin-bottom: 20px;
        }
        .card-body {
            text-align: center;
        }
        .star-rating {
            font-size: 1.25rem;
            color: #ddd;
        }
        .star-rating .filled {
            color: gold;
        }
        .full-text {
            display: none;
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
        <li class="nav-item">
          <a class="nav-link" href="paiement.php">Paiements</a>
        </li>
        <li class="nav-item active">
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
  <div class="row justify-content-center">
    <div class="col-md-8">
      <h2 class="text-center mb-4">Commentaires des Clients (<?php echo $nbrCommentaires; ?>)</h2> 
      <form method="get" action="commentaires.php" class="form-inline mb-3 justify-content-center">
        <input class="form-control mr-sm-2" type="search" name="contenu" value="<?php echo $contenu; ?>" placeholder="Rechercher par contenu" aria-label="Search">
        <select name="note" id="note" class="form-control mr-sm-2">
          <option value="all" <?php if ($note === "all") echo "selected"; ?>>Toutes les notes</option>
          <option value="1" <?php if ($note == "1") echo "selected"; ?>>1</option>
          <option value="2" <?php if ($note == "2") echo "selected"; ?>>2</option>
          <option value="3" <?php if ($note == "3") echo "selected"; ?>>3</option>
          <option value="4" <?php if ($note == "4") echo "selected"; ?>>4</option>
          <option value="5" <?php if ($note == "5") echo "selected"; ?>>5</option>
        </select>
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
      </form>

      <div class="row justify-content-center">
      <?php while ($commentaire = $resultatF->fetch()) { ?>
        <div class="col-md-4">
            <div class="card border-primary shadow rounded">
                <div class="card-body">
                    <h5 class="card-title"><?php echo htmlspecialchars($commentaire['prenom'] . ' ' . $commentaire['nom']); ?></h5>
                    <div class="star-rating">
                        <?php
                        $note = $commentaire['note'];
                        for ($i = 1; $i <= 5; $i++) {
                            if ($i <= $note) {
                                echo '<i class="fas fa-star filled"></i>';
                            } else {
                                echo '<i class="fas fa-star"></i>';
                            }
                        }
                        ?>
                    </div>
                    <p class="card-text short-text"><?php echo htmlspecialchars(strlen($commentaire['contenu']) > 60 ? substr($commentaire['contenu'], 0, 60) . '...' : $commentaire['contenu']); ?></p>
                    <p class="card-text full-text d-none" data-full-text="<?php echo htmlspecialchars($commentaire['contenu']); ?>"><?php echo htmlspecialchars($commentaire['contenu']); ?></p>
                </div>
                <div class="card-footer">
                    <?php if (strlen($commentaire['contenu']) > 60) { ?>
                        <a class="btn btn-primary toggle-text" href="#" data-toggle="modal" data-target="#commentModal-<?php echo $commentaire['CodeC']; ?>">Lire la suite</a>
                    <?php } ?>
                    <a href="#" class="btn btn-danger delete-icon" data-toggle="modal" data-target="#confirmDeleteModal" data-comment-id="<?php echo $commentaire['CodeC']; ?>">
                        <i class="fas fa-trash-alt"></i> <!-- Icône de la corbeille -->
                    </a>
                    <p class="card-text"><small class="text-muted">Posté le <?php echo htmlspecialchars($commentaire['date_creation']); ?></small></p>
                </div>
            </div>
        </div>
        
        <!-- Modal pour afficher le commentaire complet -->
        <div class="modal fade" id="commentModal-<?php echo $commentaire['CodeC']; ?>" tabindex="-1" role="dialog" aria-labelledby="commentModalLabel-<?php echo $commentaire['CodeC']; ?>" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="commentModalLabel-<?php echo $commentaire['CodeC']; ?>">Commentaire complet</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <?php echo htmlspecialchars($commentaire['contenu']); ?>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
              </div>
            </div>
          </div>
        </div>
        
      <?php } ?>
      </div>
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center paginationModif">
          <li class="page-item <?php if ($page <= 1) echo 'disabled'; ?>">
            <a class="page-link" href="commentaires.php?page=<?php echo $page - 1; ?>" tabindex="-1" aria-disabled="true">Précédent</a>
          </li>
          <?php for ($i = 1; $i <= $nbrPage; $i++) { ?>
            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
              <a class="page-link" href="commentaires.php?page=<?php echo $i; ?>"><?php echo $i; ?></a>
            </li>
          <?php } ?>
          <li class="page-item <?php if ($page >= $nbrPage) echo 'disabled'; ?>">
            <a class="page-link" href="commentaires.php?page=<?php echo $page + 1; ?>">Suivant</a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteLabel">Confirmation de la suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer ce commentaire ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Supprimer</button>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
  var deleteCommentId;

  // Ouvrir le modal et stocker l'ID du commentaire à supprimer
  $('.delete-icon').on('click', function() {
    deleteCommentId = $(this).data('comment-id');
  });

  // Confirmer la suppression
  $('#confirmDeleteBtn').on('click', function() {
    window.location.href = 'supprimer_commentaire.php?CodeC=' + deleteCommentId;
  });
});
</script>
</body>
</html>
<?php } ?> 
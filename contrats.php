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
if ($etat == "all") {
    $requete = "SELECT contrat.id_c, contrat.date_deb, contrat.date_fin, contrat.etat, users.nom, users.prenom 
                FROM contrat
                JOIN Client ON contrat.client_id = Client.id
                JOIN users ON Client.id = users.id
                WHERE users.nom LIKE '%$noms%'
                LIMIT $size OFFSET $offset";
    $requeteCount = "SELECT COUNT(*) countC FROM contrat
                     JOIN Client ON contrat.client_id = Client.id
                     JOIN users ON Client.id = users.id
                     WHERE users.nom LIKE '%$noms%'";
} else {
    $requete = "SELECT contrat.id_c, contrat.date_deb, contrat.date_fin, contrat.etat, users.nom, users.prenom 
                FROM contrat
                JOIN Client ON contrat.client_id = Client.id
                JOIN users ON Client.id = users.id
                WHERE users.nom LIKE '%$noms%' AND contrat.etat='$etat'
                LIMIT $size OFFSET $offset";
    $requeteCount = "SELECT COUNT(*) countC FROM contrat
                     JOIN Client ON contrat.client_id = Client.id
                     JOIN users ON Client.id = users.id
                     WHERE users.nom LIKE '%$noms%' AND contrat.etat='$etat'";
}

$resultatF = $pdo->query($requete);
$resultatCount = $pdo->query($requeteCount);
$tabCount = $resultatCount->fetch();
$nbrContrat = $tabCount['countC'];
$reste = $nbrContrat % $size;

$nbrPage = $reste === 0 ? $nbrContrat / $size : floor($nbrContrat / $size) + 1;
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande de Prestation</title>
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
        </select>
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
    </form>
</div>
<div class="divv">
    <a href="ajouterContrat.php" class="btn btn-group2">Ajouter un contrat</a>
</div>
<div class="row">
    <?php while ($row = $resultatF->fetch()) { ?>
        <div class="col-md-4">
            <div class="info-container">
                <h3 class="text-center mb-4"><span class="boutt"><?php echo $row["nom"] . ' ' . $row["prenom"]; ?></span></h3>
                <img src="images/46.jpg" class="card-img-top" alt="Prestation">
                
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
                    <a href="#" class="delete-icon ml-1"><i class="fa fa-trash"></i></a>
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
        <?php for ($i = 1; $i <= $nbrPage; $i++) { ?>
        <li class="page-item <?php if ($i == $page) echo 'active'; ?>"><a class="page-link" href="contrats.php?page=<?php echo $i; ?>&etat=<?php echo $etat; ?>"><?php echo $i; ?></a></li>
        <?php } ?>
        <li class="page-item <?php if ($page >= $nbrPage) echo 'disabled'; ?>">
            <a class="page-link" href="contrats.php?page=<?php echo $page + 1; ?>&etat=<?php echo $etat; ?>">Suivant</a>
        </li>
    </ul>
</nav>
</div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

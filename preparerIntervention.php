<?php
// Connexion à la base de données
$mysqli = new mysqli("localhost", "root", "", "GestionSocieteNettoyage");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$codeR = $_GET['codeR'] ?? null;

if (!$codeR) {
    die("CodeR is missing");
}

// Récupérer les détails de la réservation
$reservationQuery = "
    SELECT r.*, u.nom, u.prenom, u.email, u.telephone, u.adresse 
    FROM reservation r 
    JOIN Client c ON r.client_id = c.id 
    JOIN users u ON c.id = u.id 
    WHERE r.codeR = ?
";
$reservationStmt = $mysqli->prepare($reservationQuery);
$reservationStmt->bind_param("i", $codeR);
$reservationStmt->execute();
$reservationResult = $reservationStmt->get_result();

if (!$reservationResult) {
    die("Error in reservation query: " . $mysqli->error);
}

$reservation = $reservationResult->fetch_assoc();

if (!$reservation) {
    die("No reservation found for codeR = $codeR");
}

// Récupérer les services de la réservation
$servicesQuery = "
    SELECT ds.*, s.NomS 
    FROM detailResSER ds 
    JOIN Service s ON ds.CodeS = s.CodeS 
    WHERE ds.codeR = ?
";
$servicesStmt = $mysqli->prepare($servicesQuery);
$servicesStmt->bind_param("i", $codeR);
$servicesStmt->execute();
$services = $servicesStmt->get_result();

if (!$services) {
    die("Error in services query: " . $mysqli->error);
}

// Récupérer la liste des employés
$employesQuery = "
    SELECT e.id, u.nom, u.prenom 
    FROM employe e 
    JOIN users u ON e.id = u.id
";
$employes = $mysqli->query($employesQuery);

if (!$employes) {
    die("Error in employes query: " . $mysqli->error);
}

// Récupérer la liste des matériels
$materielsQuery = "SELECT codeM, nomM, type, quantite FROM materiel";
$materiels = $mysqli->query($materielsQuery);

if (!$materiels) {
    die("Error in materiels query: " . $mysqli->error);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Préparer Intervention</title>
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
        <li class="nav-item active">
        <a class="nav-link" href="listeReservations.php">Interventions</a>
    
        <li class="nav-item  ">
            <a class="nav-link" href="compteGI.php"><i class="fas fa-user fa-lg ml-5"></i></a> 
        </li>
        <li class="nav-item ">
            <a class="nav-link ml-2" href="deconnexionClient.php">Deconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <h1 class="mt-5">Préparer Intervention</h1>
  <h2 class="mt-4">Informations du Client</h2>
  <div class="card mb-4">
    <div class="card-body">
      <p class="card-text"><strong>Nom:</strong> <?= htmlspecialchars($reservation['nom']) ?> <?= htmlspecialchars($reservation['prenom']) ?></p>
      <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($reservation['email']) ?></p>
      <p class="card-text"><strong>Téléphone:</strong> <?= htmlspecialchars($reservation['telephone']) ?></p>
      <p class="card-text"><strong>Adresse:</strong> <?= htmlspecialchars($reservation['adresse']) ?></p>
    </div>
  </div>

  <h2>Informations de la Réservation</h2>
  <div class="card mb-4">
    <div class="card-body">
      <p class="card-text"><strong>Date de Réservation:</strong> <?= htmlspecialchars($reservation['date_reservation']) ?></p>
      <p class="card-text"><strong>Date de Prestation:</strong> <?= htmlspecialchars($reservation['date_prestation']) ?></p>
      <p class="card-text"><strong>Heure de Prestation:</strong> <?= htmlspecialchars($reservation['heure_prestation']) ?></p>
      <p class="card-text"><strong>Adresse de Prestation:</strong> <?= htmlspecialchars($reservation['adresse_prestation']) ?></p>
      <p class="card-text"><strong>Montant:</strong> <?= htmlspecialchars($reservation['montant']) ?></p>
    </div>
  </div>

  <form method="POST" action="traiterintervention.php?codeR=<?= $codeR ?>">
    <h2>Services de la Réservation</h2>
    <?php while ($service = $services->fetch_assoc()) { ?>
      <div class="card mb-4">
        <div class="card-body">
          <h3>Service: <?= htmlspecialchars($service['NomS']) ?></h3>
          <input type="hidden" name="services[<?= $service['CodeS'] ?>][CodeS]" value="<?= htmlspecialchars($service['CodeS']) ?>">
          <p class="card-text"><strong>Nombre d'heures:</strong> <?= htmlspecialchars($service['nbr_hr']) ?></p>
          <p class="card-text"><strong>Instructions Spéciales:</strong> <?= htmlspecialchars($service['instructions_speciales']) ?></p>
          <div class="form-group">
            <label for="employe_id_<?= $service['CodeS'] ?>">Assigner un Employé:</label>
            <select class="form-control" name="services[<?= $service['CodeS'] ?>][employe_id]" id="employe_id_<?= $service['CodeS'] ?>">
              <option value="">Sélectionner un employé</option>
              <?php $employes->data_seek(0);
              while ($employe = $employes->fetch_assoc()) { ?>
                <option value="<?= htmlspecialchars($employe['id']) ?>"><?= htmlspecialchars($employe['nom']) ?> <?= htmlspecialchars($employe['prenom']) ?></option>
              <?php } ?>
            </select>
          </div>

          <h4>Matériels Utilisés</h4>
          <ul id="selectedMateriels_<?= $service['CodeS'] ?>" class="list-group mb-3">
            <!-- Les matériels sélectionnés seront ajoutés ici -->
          </ul>

          <!-- Bouton pour ouvrir le modal -->
          <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#materielModal_<?= $service['CodeS'] ?>">
            Choisir Matériels
          </button>

          <!-- Modal -->
          <div class="modal fade" id="materielModal_<?= $service['CodeS'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Choisir Matériels pour <?= htmlspecialchars($service['NomS']) ?></h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <div class="form-group">
                    <input type="text" class="form-control" id="searchMateriel_<?= $service['CodeS'] ?>" placeholder="Rechercher un matériel...">
                  </div>
                  <div class="form-group">
                    <label for="filterType_<?= $service['CodeS'] ?>">Filtrer par type:</label>
                    <select class="form-control" id="filterType_<?= $service['CodeS'] ?>">
                      <option value="">Tous</option>
                      <option value="électronique">Électronique</option>
                      <option value="mécanique">Mécanique</option>
                      <option value="nettoyage">Nettoyage</option>
                      <option value="autre">Autre</option>
                    </select>
                  </div>
                  <div id="materielList_<?= $service['CodeS'] ?>" class="materiel-list">
                    <?php $materiels->data_seek(0);
                    while ($materiel = $materiels->fetch_assoc()) { ?>
                      <div class="form-check materiel-item" data-type="<?= htmlspecialchars($materiel['type']) ?>">
                        <input class="form-check-input" type="checkbox" name="services[<?= $service['CodeS'] ?>][materiels][<?= $materiel['codeM'] ?>][codeM]" value="<?= htmlspecialchars($materiel['codeM']) ?>" id="materiel_<?= $materiel['codeM'] ?>_<?= $service['CodeS'] ?>" data-name="<?= htmlspecialchars($materiel['nomM']) ?>" data-quantite="<?= htmlspecialchars($materiel['quantite']) ?>">
                        <label class="form-check-label" for="materiel_<?= $materiel['codeM'] ?>_<?= $service['CodeS'] ?>">
                          <?= htmlspecialchars($materiel['nomM']) ?> (Quantité disponible: <?= htmlspecialchars($materiel['quantite']) ?>)
                        </label>
                        <input type="number" class="form-control mt-2" name="services[<?= $service['CodeS'] ?>][materiels][<?= $materiel['codeM'] ?>][quantite_utilisee]" min="0" max="<?= htmlspecialchars($materiel['quantite']) ?>" value="0" data-materiel-id="<?= htmlspecialchars($materiel['codeM']) ?>">
                      </div>
                    <?php } ?>
                  </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php } ?>
    <button type="submit" class="btn btn-primary">Préparer Intervention</button>
  </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
  <?php 
  $services->data_seek(0); // Réinitialiser le curseur de la requête des services
  while ($service = $services->fetch_assoc()) { ?>
    $('#searchMateriel_<?= $service['CodeS'] ?>').on('keyup', function() {
      var value = $(this).val().toLowerCase();
      $('#materielList_<?= $service['CodeS'] ?> .materiel-item').filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
      });
    });

    $('#filterType_<?= $service['CodeS'] ?>').on('change', function() {
      var type = $(this).val();
      if (type === "") {
        $('#materielList_<?= $service['CodeS'] ?> .materiel-item').show();
      } else {
        $('#materielList_<?= $service['CodeS'] ?> .materiel-item').hide();
        $('#materielList_<?= $service['CodeS'] ?> .materiel-item[data-type="' + type + '"]').show();
      }
    });

    $('#materielModal_<?= $service['CodeS'] ?>').on('hide.bs.modal', function () {
      var selectedMateriels = [];
      $('#materielList_<?= $service['CodeS'] ?> .form-check-input:checked').each(function () {
        var name = $(this).data('name');
        var quantite = $(this).siblings('input[type="number"]').val();
        selectedMateriels.push('<li class="list-group-item">' + name + ' (Quantité: ' + quantite + ')</li>');
      });
      $('#selectedMateriels_<?= $service['CodeS'] ?>').html(selectedMateriels.join(''));
    });
  <?php } ?>
});
</script>
</body>
</html>

<?php $mysqli->close(); ?>

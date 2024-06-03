<?php
require_once("identifier.php");
require_once("connexiondb.php");

// Récupérer l'ID du contrat à partir de l'URL
$contrat_id = isset($_GET['id']) ? $_GET['id'] : 0;

// Requête pour récupérer les informations sur le contrat
$requeteContrat = "SELECT * FROM contrat WHERE id_c = :contrat_id";
$stmtContrat = $pdo->prepare($requeteContrat);
$stmtContrat->execute(['contrat_id' => $contrat_id]);
$contrat = $stmtContrat->fetch();

// Requête pour récupérer les paiements du contrat
$requetePaiements = "SELECT * FROM paiement WHERE contrat_id = :contrat_id AND etat_paiement = 'payé'";
$stmtPaiements = $pdo->prepare($requetePaiements);
$stmtPaiements->execute(['contrat_id' => $contrat_id]);

// Requête pour récupérer les paiements en retard du contrat
$requetePaiementsRetard = "SELECT * FROM paiement WHERE contrat_id = :contrat_id AND etat_paiement = 'en retard'";
$stmtPaiementsRetard = $pdo->prepare($requetePaiementsRetard);
$stmtPaiementsRetard->execute(['contrat_id' => $contrat_id]);

// Calculer le montant total payé et le montant restant
$total_paye = 0;
$total_paye_retard = 0;

while ($paiement = $stmtPaiements->fetch()) {
    $total_paye += $paiement['montant'];
}

while ($paiementRetard = $stmtPaiementsRetard->fetch()) {
    $total_paye_retard += $paiementRetard['montant'];
}

$montant_restant = $contrat['montantc'] - ($total_paye + $total_paye_retard);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiements du Contrat</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" crossorigin="anonymous" />
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

<div class="container mt-5">
  <div class="row">
    <div class="col">
      <h2 class="center-text">Paiements du Contrat <?php echo htmlspecialchars($contrat['id_c']); ?></h2>

      <div class="contrat-info">
        <p>Date de début : <?php echo htmlspecialchars($contrat['date_deb']); ?></p>
        <p>Date de fin : <?php echo htmlspecialchars($contrat['date_fin']); ?></p>
        <p>Montant du contrat : <?php echo htmlspecialchars($contrat['montantc']); ?></p>
        <p>Montant payé : <?php echo htmlspecialchars($total_paye); ?></p>
        <p>Montant en retard : <?php echo htmlspecialchars($total_paye_retard); ?></p>
        <p>Montant restant : <?php echo htmlspecialchars($montant_restant); ?></p>
      </div>

      <h3>Paiements :</h3>
      <table class="table table-hover">
        <thead class="couleurTableau">
          <tr>
            <th scope="col">Date de Paiement</th>
            <th scope="col">Montant</th>
            <th scope="col">État</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $stmtPaiements->execute(['contrat_id' => $contrat_id]); // Ré-exécution de la requête pour réinitialiser le curseur
          while ($paiement = $stmtPaiements->fetch()) { ?>
          <tr>
            <td><?php echo htmlspecialchars($paiement['date_paiement']); ?></td>
            <td><?php echo htmlspecialchars($paiement['montant']); ?></td>
            <td><?php echo htmlspecialchars($paiement['etat_paiement']); ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>

      <h3>Paiements en Retard :</h3>
      <table class="table table-hover">
        <thead class="couleurTableau">
          <tr>
            <th scope="col">Date de Paiement</th>
            <th scope="col">Montant</th>
            <th scope="col">État</th>
          </tr>
        </thead>
        <tbody>
          <?php
           $stmtPaiementsRetard->execute(['contrat_id' => $contrat_id]);
           while ($paiementRetard = $stmtPaiementsRetard->fetch()) { ?>
          <tr>
            <td><?php echo htmlspecialchars($paiementRetard['date_paiement']); ?></td>
            <td><?php echo htmlspecialchars($paiementRetard['montant']); ?></td>
            <td><?php echo htmlspecialchars($paiementRetard['etat_paiement']); ?></td>
          </tr>
          <?php } ?>
        </tbody>
      </table>

      <!-- Bouton pour ouvrir le modal d'ajout de paiement -->
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addPaiementModal" id="addPaiementButton">
        Ajouter Paiement
      </button>
    </div>
  </div>
</div>

<!-- Modal d'ajout de paiement -->
<div class="modal fade" id="addPaiementModal" tabindex="-1" role="dialog" aria-labelledby="addPaiementModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="addPaiementModalLabel">Ajouter un Paiement</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="addPaiementForm" action="submit_paiement.php" method="POST">
          <div class="form-group">
            <label for="date_paiement">Date de Paiement:</label>
            <input type="date" class="form-control" id="date_paiement" name="date_paiement" required>
          </div>
          <div class="form-group">
            <label for="montant">Montant:</label>
            <input type="number" class="form-control" id="montant" name="montant" step="0.01" required>
          </div>
          <div class="form-group">
            <label for="etat_paiement">État du Paiement:</label>
            <select class="form-control" id="etat_paiement" name="etat_paiement" required>
              <option value="payé">Payé</option>
              <option value="en retard">En retard</option>
              <option value="en attente">En attente</option>
            </select>
          </div>
          <input type="hidden" name="contrat_id" value="<?php echo $contrat_id; ?>">
          <input type="hidden" id="montant_restant" value="<?php echo $montant_restant; ?>">
          <button type="submit" class="btn btn-success">Ajouter</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var montantRestant = parseFloat(document.getElementById('montant_restant').value);
        var addPaiementButton = document.getElementById('addPaiementButton');
        var addPaiementForm = document.getElementById('addPaiementForm');

        addPaiementButton.addEventListener('click', function(event) {
            if (montantRestant <= 0) {
                event.preventDefault();
                alert("Le contrat est totalement payé.");
            }
        });

        addPaiementForm.addEventListener('submit', function(event) {
            var montant = parseFloat(document.getElementById('montant').value);
            if (montant > montantRestant) {
                event.preventDefault();
                alert("Le montant saisi est supérieur au montant restant.");
            }
        });
    });
</script>

</body>
</html>

<?php
require_once("identifier.php");
require_once("connexiondb.php");

$message = "";

// Vérification si l'employé a déjà une demande de congé en attente
$id_employe = $_SESSION['user']['id'];
$requete = $pdo->prepare("SELECT * FROM ArretDeTravail WHERE id = ? AND Type IN ('Congé', 'Maladie', 'Maternité/Paternité') AND statut = 'pas encore traité'");
$requete->execute([$id_employe]);
$existingRequest = $requete->fetch();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($existingRequest) {
        $_SESSION['message'] = "Vous avez déjà une demande de congé envoyée et pas encore traitée par le RRH.";
        header('Location: congésEmploye.php');
        exit();
    } else {
        $date_deb = isset($_POST['date_deb']) ? $_POST['date_deb'] : '';
        $date_fin = isset($_POST['date_fin']) ? $_POST['date_fin'] : '';
        $type_conge = isset($_POST['type_conge']) ? $_POST['type_conge'] : '';
        $raison = isset($_POST['raison']) ? $_POST['raison'] : '';

        if (!empty($date_deb) && !empty($date_fin) && !empty($type_conge) && !empty($raison)) {
            $requete = $pdo->prepare("INSERT INTO ArretDeTravail (Type, Date_deb, Date_fin, Description, statut, id) VALUES (?, ?, ?, ?, 'pas encore traité', ?)");
            $requete->execute([$type_conge, $date_deb, $date_fin, $raison, $id_employe]);
            $_SESSION['message'] = "Votre demande de congé a été envoyée avec succès.";
            header('Location: congésEmploye.php');
            exit();
        }
    }
}

if (isset($_SESSION['message'])) {
    $message = $_SESSION['message'];
    unset($_SESSION['message']);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demander congé</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
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
          <a class="nav-link" href="demission.php">Démission</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="menuconge.php">Congés</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="historiqueintervention.php">Historique interventions</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="tacheethoraire.php">Attribution tâche et horaire</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="compteEmploye.php"><i class="fas fa-user fa-lg ml-5"></i></a> 
        </li>
        <li class="nav-item">
            <a class="nav-link ml-2" href="deconnexionClient.php">Déconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5 custom-container">
    <div class="row justify-content-center">
        <div class="photo5"><img src="images/21.jpg" /></div>
        <div class="col-md-6">
            <h2 class="text-center mb-4 center-text2">Demander congé</h2>
            <?php if ($message): ?>
                <div class="alert alert-success" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            <form id="congeForm" method="post" action="congésEmploye.php">
                <div class="form-group">
                    <label for="type_conge">Type de congé</label>
                    <select class="form-control" id="type_conge" name="type_conge" required>
                        <option value="Congé">Congé</option>
                        <option value="Maladie">Maladie</option>
                        <option value="Maternité/Paternité">Maternité/Paternité</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date_deb">Date de début</label>
                    <input type="date" class="form-control" id="date_deb" name="date_deb" required>
                </div>
                <div class="form-group">
                    <label for="date_fin">Date de fin</label>
                    <input type="date" class="form-control" id="date_fin" name="date_fin" required>
                </div>
                <div class="form-group">
                    <label for="raison">Raison du congé</label>
                    <textarea class="form-control" id="raison" name="raison" rows="3" required></textarea>
                </div>
                <button type="button" class="btn btn-success btn-send" data-toggle="modal" data-target="#confirmModal">Envoyer la demande</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal de confirmation -->
<div class="modal fade" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="confirmModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmModalLabel">Confirmation de la demande</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir envoyer cette demande de congé ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-success" id="confirmSubmit">Confirmer</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('#confirmSubmit').on('click', function() {
        $('#congeForm').submit();
    });
});
</script>
</body>
</html>

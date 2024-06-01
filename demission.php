<?php
require_once("identifier.php");
require_once("connexiondb.php");

$message = "";
$existingRequest = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $date_deb = isset($_POST['date_deb']) ? $_POST['date_deb'] : '';
    $raison = isset($_POST['raison']) ? $_POST['raison'] : '';
    $id_employe = $_SESSION['user']['id'];

    // Vérification de l'existence d'une demande de démission non traitée
    $checkRequest = $pdo->prepare("SELECT * FROM ArretDeTravail WHERE id = ? AND Type = 'demission' AND statut = 'pas encore traité'");
    $checkRequest->execute([$id_employe]);
    $existingRequest = $checkRequest->fetch();

    if ($existingRequest) {
        $_SESSION['message'] = "Vous avez déjà envoyé une demande de démission, elle n'est pas encore traitée par le RRH.";
    } else {
        if (!empty($date_deb) && !empty($raison)) {
            $requete = $pdo->prepare("INSERT INTO ArretDeTravail (Type, Date_deb, Date_fin, Description, statut, id) VALUES (?, ?, NULL, ?, 'pas encore traité', ?)");
            $requete->execute(['demission', $date_deb, $raison, $id_employe]);
            $_SESSION['message'] = "Votre demande de démission a été envoyée avec succès.";
        }
    }
    header('Location: demission.php');
    exit();
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
    <title>Demande de Démission</title>
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
        <li class="nav-item active">
          <a class="nav-link" href="demission.php">Démission</a>
        </li>
        <li class="nav-item">
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
          <a class="nav-link" href="deconnexionClient.php">Déconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5 custom-container">
    <div class="row justify-content-center">
        <div class="photo5"><img src="images/31.jpg" /></div>
        <div class="col-md-6">
            <h2 class="text-center mb-4 center-text2">Demander Démission</h2>
            <?php if ($message): ?>
                <div class="alert alert-<?php echo ($existingRequest) ? 'danger' : 'success'; ?>" role="alert">
                    <?php echo $message; ?>
                </div>
            <?php endif; ?>
            <form id="demissionForm" method="post" action="demission.php">
                <div class="form-group">
                    <label for="date_deb">Date de début</label>
                    <input type="date" class="form-control" id="date_deb" name="date_deb" required>
                </div>
                <div class="form-group">
                    <label for="raison">Lettre de démission (raisons)</label>
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
        Êtes-vous sûr de vouloir envoyer cette demande de démission ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-success" id="confirmSubmit">Confirmer</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    $('#confirmSubmit').on('click', function() {
        $('#demissionForm').submit();
    });
});
</script>
</body>
</html>

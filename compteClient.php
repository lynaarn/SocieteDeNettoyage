<?php 
require_once("identifier.php");
require_once("connexiondb.php"); // Inclusion de la connexion à la base de données

if ($_SESSION['user']['TypeCompte'] == 'Client') {
    $user = $_SESSION['user'];
    $client = getClientDetails($user['id']); // Function to fetch client details like date_inscription and type_client
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Compte</title>
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
        <li class="nav-item">
          <a class="nav-link" href="prestationsClient.php">Préstations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contratsClients.php">Contrats</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menuCommentaire.php">Commentaires</a>
        </li>
        <li class="nav-item1 active">
          <a class="nav-link" href="compteClient.php"><i class="fas fa-user fa-lg"></i></a>
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
      <h2 class="center-text main-title">Mon Compte</h2> 
      <div class="row">
        <div class="col-md-8 offset-md-2">
          <div class="info-box">
            <form id="profileForm" action="updateClient.php" method="POST">
              <div class="text-center mb-3">
                <img src="images/35.jpg" class="rounded-circle" width="200">
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="nom" class="bold-label"><i class="far fa-user"></i>Nom</label>
                  <input type="text" class="form-control editable" id="nom" name="nom" value="<?php echo htmlspecialchars($user['nom']); ?>" readonly>
                </div>
                <div class="form-group col-md-6">
                  <label for="prenom" class="bold-label"><i class="far fa-user"></i>Prénom</label>
                  <input type="text" class="form-control editable" id="prenom" name="prenom" value="<?php echo htmlspecialchars($user['prenom']); ?>" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="tel" class="bold-label"><i class="fas fa-phone"></i>Numéro de téléphone</label>
                  <input type="text" class="form-control editable" id="tel" name="telephone" value="<?php echo htmlspecialchars($user['telephone']); ?>" readonly>
                </div>
                <div class="form-group col-md-6">
                  <label for="adresse" class="bold-label"><i class="fas fa-map-marker-alt"></i>Adresse</label>
                  <input type="text" class="form-control editable" id="adresse" name="adresse" value="<?php echo htmlspecialchars($user['adresse']); ?>" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="login" class="bold-label"><i class="fas fa-user-circle"></i>Login</label>
                  <input type="text" class="form-control editable" id="login" name="login" value="<?php echo htmlspecialchars($user['login']); ?>" readonly>
                </div>
                <div class="form-group col-md-6">
                  <label for="mdp" class="bold-label"><i class="fas fa-lock"></i>Mot de passe</label>
                  <input type="password" class="form-control editable" id="mdp" name="password" value="<?php echo htmlspecialchars($user['password']); ?>" readonly>
                </div>
              </div>
              <div class="form-row">   
                <div class="form-group col-md-6">
                  <label for="email" class="bold-label"><i class="fas fa-at"></i>Email</label>
                  <input type="email" class="form-control editable" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" readonly>
                </div>
                <div class="form-group col-md-6">
                  <label for="date_inscription" class="bold-label"><i class="fas fa-calendar-alt"></i>Date d'inscription</label>
                  <input type="date" class="form-control editable" id="date_inscription" name="date_inscription" value="<?php echo htmlspecialchars($client['date_inscription']); ?>" readonly>
                </div>
              </div>
              <div class="form-row">   
                <div class="form-group col-md-6">
                  <label for="typeCompte" class="bold-label"><i class="fas fa-id-badge"></i>Type de Compte</label>
                  <input type="text" class="form-control editable" id="typeCompte" name="typeCompte" value="<?php echo htmlspecialchars($user['TypeCompte']); ?>" readonly>
                </div>
                <div class="form-group col-md-6">
                  <label for="typeClient" class="bold-label"><i class="fas fa-user-tag"></i>Type de Client</label>
                  <input type="text" class="form-control editable" id="typeClient" name="typeClient" value="<?php echo htmlspecialchars($client['type_client']); ?>" readonly>
                </div>
              </div>
              <button type="button" class="btn btn-success d-none" id="saveBtn">Enregistrer</button>
              <button type="button" class="btn btn-primary ml-2" id="editBtn">Modifier</button>
              <button type="button" class="btn btn-danger ml-2" data-toggle="modal" data-target="#confirmDeleteModal" data-client-id="<?php echo $user['id']; ?>">Supprimer le compte</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div style="height: 50px;"></div>

<!-- Modal de confirmation de suppression -->
<div class="modal fade" id="confirmDeleteModal" tabindex="-1" role="dialog" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteModalLabel">Confirmation de suppression</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Êtes-vous sûr de vouloir supprimer ce compte ?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
        <button type="button" class="btn btn-danger" id="confirmDeleteBtn">Supprimer</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
  
$(document).ready(function() {
    $('#editBtn').on('click', function() {
        $('.editable').prop('readonly', false);
        $('#saveBtn').removeClass('d-none');
        $('#editBtn').addClass('d-none');
        $('#mdp').attr('type', 'text');
    });

    $('#saveBtn').on('click', function() {
        $('#profileForm').submit();
    });

    $('#confirmDeleteModal').on('show.bs.modal', function(e) {
        var clientId = $(e.relatedTarget).data('client-id');
        $('#confirmDeleteBtn').data('client-id', clientId);
    });

    $('#confirmDeleteBtn').on('click', function() {
      var clientId = $(this).data('client-id');
      $.ajax({
            url: 'deleteClient.php',
            type: 'POST',
            data: { id: clientId },
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    window.location.href = 'deconnexionClient.php';
                } else {
                    alert(response.message);
                }
            },
            error: function(xhr, status, error) {
                alert('Erreur lors de la suppression du compte.');
            }
        });
    });
});
</script>

</body>
</html>

<?php 
}

function getClientDetails($userId) {
    global $pdo;
    $stmt = $pdo->prepare("SELECT date_inscription, type_client FROM Client WHERE id = :userId");
    $stmt->bindParam(':userId', $userId);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>

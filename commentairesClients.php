<?php 
require_once("identifier.php");
require_once("connexiondb.php"); // Inclusion de la connexion à la base de données
?>
<?php 
if ($_SESSION['user']['TypeCompte'] == 'Client') {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $contenu = isset($_POST['comment']) ? $_POST['comment'] : '';
        $note = isset($_POST['rating']) ? (int)$_POST['rating'] : 0;
        $client_id = $_SESSION['user']['id'];

        if (!empty($contenu) && $note >= 1 && $note <= 5) {
            $stmt = $pdo->prepare("INSERT INTO commentaire (client_id, contenu, note) VALUES (:client_id, :contenu, :note)");
            $stmt->bindParam(':client_id', $client_id);
            $stmt->bindParam(':contenu', $contenu);
            $stmt->bindParam(':note', $note);
            if ($stmt->execute()) {
                $_SESSION['message'] = "Commentaire ajouté avec succès.";
            } else {
                $_SESSION['message'] = "Erreur lors de l'ajout du commentaire.";
            }
        } else {
            $_SESSION['message'] = "Veuillez remplir tous les champs correctement.";
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Client - Mon Compte</title>
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
        <li class="nav-item ">
          <a class="nav-link" href="prestationsClient.php">Préstations</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contratsClients.php">Contrats</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="commentairesClients.php">commentaires</a>
        </li>
        <li class="nav-item1  ">
        <a class="nav-link" href="compteClient.php"><i class="fas fa-user fa-lg"></i></a>

        </li>
        <li class="nav-item ">
        <a class="nav-link" href="deconnexionClient.php">Deconnexion</a>

        </li>
      </ul>
    </div>
  </div>
</nav>
<div style="height: 100px;"></div>
<div class="container mt-5 top-margin-adjust">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <?php if (isset($_SESSION['message'])) { ?>
                <div class="alert alert-info">
                    <?php echo $_SESSION['message']; unset($_SESSION['message']); ?>
                </div>
            <?php } ?>
            <div class="comment-box">
                <h2 class="comment-title">Laissez un commentaire</h2>
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="comment">Votre commentaire :</label>
                        <textarea class="form-control" id="comment" name="comment" rows="3"></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="rating">Votre évaluation :</label><br>
                        <div class="rating" id="ratingStars">
                            <span class="star" data-value="1">&#9733;</span>
                            <span class="star" data-value="2">&#9733;</span>
                            <span class="star" data-value="3">&#9733;</span>
                            <span class="star" data-value="4">&#9733;</span>
                            <span class="star" data-value="5">&#9733;</span>
                        </div>
                        <input type="hidden" id="ratingInput" name="rating" value="0">
                    </div>

                    <button type="submit" class="btn btn-success">Soumettre</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
$(document).ready(function() {
    $('.star').hover(
        function() {
            $(this).prevAll().addBack().addClass('hover');
        },
        function() {
            $(this).siblings().removeClass('hover');
        }
    );

    $('.star').click(function() {
        var ratingValue = $(this).attr('data-value');
        $('#ratingInput').val(ratingValue);
        $(this).siblings().removeClass('selected');
        $(this).prevAll().addBack().addClass('selected');
    });

    // Update stars based on hidden input value on page load
    var initialRating = $('#ratingInput').val();
    if (initialRating > 0) {
        $('.star[data-value="' + initialRating + '"]').prevAll().addBack().addClass('selected');
    }
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

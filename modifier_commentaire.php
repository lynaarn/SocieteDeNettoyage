<?php
require_once("identifier.php");
require_once("connexiondb.php");

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $commentId = isset($_GET['CodeC']) ? intval($_GET['CodeC']) : 0;
    if ($commentId > 0) {
        $requete = "SELECT * FROM commentaire WHERE CodeC = $commentId AND client_id = " . $_SESSION['user']['id'];
        $resultat = $pdo->query($requete);
        $commentaire = $resultat->fetch();
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $commentId = isset($_POST['CodeC']) ? intval($_POST['CodeC']) : 0;
    $contenu = isset($_POST['contenu']) ? $_POST['contenu'] : '';
    $note = isset($_POST['note']) ? intval($_POST['note']) : 0;

    if ($commentId > 0 && !empty($contenu) && $note >= 1 && $note <= 5) {
        $requete = $pdo->prepare("UPDATE commentaire SET contenu = ?, note = ? WHERE CodeC = ? AND client_id = ?");
        $requete->execute([$contenu, $note, $commentId, $_SESSION['user']['id']]);
        header('Location: consulterCommentaires.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier Commentaire - Capiclean</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 70px; /* Fixe la hauteur de la barre de navigation */
        }
        .content {
            margin-top: 80px;
        }
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 30px;
        }
        .form-group label {
            font-weight: bold;
            color: black;
        }
        .bg-light {
            background-color: #A8A8A8;
            padding: 7px;
            border-radius: 5%;
        }
    </style>
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
          <a class="nav-link" href="commentairesClients.php">Commentaires</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="compteClient.php"><i class="fas fa-user fa-lg"></i></a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="deconnexionClient.php">Déconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container content">
    <div class="row justify-content-center">
        <div class="col-md-8"> 
            <div class="form-container">
                <h3 class="text-center txt mb-4"><span class="bg-light">Modifier Commentaire</span></h3>
                <form action="modifier_commentaire.php" method="post">
                    <input type="hidden" name="CodeC" value="<?php echo $commentId; ?>">
                    <div class="form-group">
                        <label for="contenu"><i class="fas fa-comments"></i> Contenu du commentaire</label>
                        <textarea class="form-control" id="contenu" name="contenu" rows="4" required><?php echo htmlspecialchars($commentaire['contenu']); ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="note"><i class="fas fa-star"></i> Note</label>
                        <select class="form-control" id="note" name="note" required>
                            <option value="1" <?php if ($commentaire['note'] == 1) echo 'selected'; ?>>1</option>
                            <option value="2" <?php if ($commentaire['note'] == 2) echo 'selected'; ?>>2</option>
                            <option value="3" <?php if ($commentaire['note'] == 3) echo 'selected'; ?>>3</option>
                            <option value="4" <?php if ($commentaire['note'] == 4) echo 'selected'; ?>>4</option>
                            <option value="5" <?php if ($commentaire['note'] == 5) echo 'selected'; ?>>5</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Modifier</button>
                    <a href="consulterCommentaires.php" class="btn btn-secondary ml-2">Annuler</a>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>


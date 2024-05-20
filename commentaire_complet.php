<?php
require_once("connexiondb.php");

// Récupérer le CodeC du commentaire à partir de l'URL
$CodeC = isset($_GET['CodeC']) ? $_GET['CodeC'] : "";

// Requête pour récupérer le commentaire complet
$requeteCommentaire = "SELECT contenu FROM commentaire WHERE CodeC = :CodeC";
$statement = $pdo->prepare($requeteCommentaire);
$statement->bindParam(':CodeC', $CodeC);
$statement->execute();
$commentaire = $statement->fetch();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Commentaire Complet</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <style>
        body {
            background-color: #f8f9fa;
            padding-top: 70px; /* Fixe la hauteur de la barre de navigation */
            font-family: Arial, sans-serif; /* Utilisez la police de caractères de votre choix */
        }
        .container {
            margin-top: 50px;
            margin-bottom: 50px;
        }
        .card {
            margin-bottom: 20px;
        }
        .card-body {
            text-align: center;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="card border-primary shadow rounded">
        <div class="card-body">
            <?php
            if ($commentaire) {
                echo $commentaire['contenu'];
            } else {
                echo "Commentaire non trouvé.";
            }
            ?>
        </div>
    </div>
</div>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>


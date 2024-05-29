<?php
require_once("identifier.php");
require_once("connexiondb.php");

// Vérification de la présence de l'ID dans l'URL
if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Requête pour récupérer les informations de l'utilisateur et son rôle
    $requete = "SELECT u.*, r.nomR, pa.date_embauche
                FROM users u
                INNER JOIN personnel_administratif pa ON u.id = pa.id
                INNER JOIN roles r ON pa.role = r.numR
                WHERE u.id = ?";
    
    $resultat = $pdo->prepare($requete);
    $resultat->execute([$id]);
    
    // Récupération des données de l'utilisateur
    $personnel = $resultat->fetch();
} else {
    // Redirection vers une autre page si l'ID n'est pas spécifié dans l'URL
    header('Location: page_non_trouvee.php');
    exit();
}
?>
<?php 
 if ($_SESSION['user']['TypeCompte']=='Admin') {?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations Personnelles</title>
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
    <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="Capiclean Logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="service.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Menuclients.php">Clients</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="personnels.php">Personnels</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="contrats.php">Contrats</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="paiement.php">Paiements</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="commentaires.php">Commentaires</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <div class="row">
    <div class="col">
      <h2 class="center-text">Informations Personnelles</h2>
      <div class="photo2"><img src="images/7.jpg" /></div>
      <table class="table">
        <tbody>
          <tr>
            <th scope="row">ID</th>
            <td><?php echo $personnel['id']; ?></td>
          </tr>
          <tr>
            <th scope="row">Nom</th>
            <td><?php echo $personnel['nom']; ?></td>
          </tr>
          <tr>
            <th scope="row">Prénom</th>
            <td><?php echo $personnel['prenom']; ?></td>
          </tr>
          <tr>
            <th scope="row">Email</th>
            <td><?php echo $personnel['email']; ?></td>
          </tr>
          <tr>
            <th scope="row">Téléphone</th>
            <td><?php echo $personnel['telephone']; ?></td>
          </tr>
          <tr>
            <th scope="row">Adresse</th>
            <td><?php echo $personnel['adresse']; ?></td>
          </tr>
          <tr>
            <th scope="row">Login</th>
            <td><?php echo $personnel['login']; ?></td>
          </tr>
          <tr>
            <th scope="row">Rôle</th>
            <td><?php echo $personnel['nomR']; ?></td>
          </tr>
          <tr>
            <th scope="row">Date d'embauche</th>
            <td><?php echo $personnel['date_embauche']; ?></td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php } ?>
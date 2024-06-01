<?php
require_once("identifier.php");
require_once("connexiondb.php");

// Vérification de la présence de l'ID dans l'URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Requête pour récupérer les informations de l'employé
    $requete = "SELECT u.*, e.date_embauche, e.statut, e.salaire 
                FROM users u
                INNER JOIN employe e ON u.id = e.id
                WHERE u.id = ?";

    $resultat = $pdo->prepare($requete);
    $resultat->execute([$id]);

    // Récupération des données de l'employé
    $employe = $resultat->fetch();
} else {
    // Redirection vers une autre page si l'ID n'est pas spécifié dans l'URL
    header('Location: page_non_trouvee.php');
    exit();
}
?>
<?php 
 if ($_SESSION['user']['TypeCompte']=='RRH') {?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations Employé</title>
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
          <a class="nav-link active" href="employes.php">Employés</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="congés.php">Congés</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="arrêtDeTravail.php">Arrêt de travail</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menuDemandeDemplois.php">Demande d'emplois</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="compteRHH.php"><i class="fas fa-user fa-lg ml-5"></i></a> 
        </li>
        <li class="nav-item">
          <a class="nav-link ml-2" href="deconnexionClient.php">Déconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
  <div class="row">
    <div class="col">
      <h2 class="center-text">Informations Employé</h2>
      <div class="photo2"><img src="images/19.jpg" /></div>
      <table class="table">
        <tbody>
          <tr>
            <th scope="row">ID</th>
            <td><?php echo $employe['id']; ?></td>
          </tr>
          <tr>
            <th scope="row">Nom</th>
            <td><?php echo $employe['nom']; ?></td>
          </tr>
          <tr>
            <th scope="row">Prénom</th>
            <td><?php echo $employe['prenom']; ?></td>
          </tr>
          <tr>
            <th scope="row">Email</th>
            <td><?php echo $employe['email']; ?></td>
          </tr>
          <tr>
            <th scope="row">Téléphone</th>
            <td><?php echo $employe['telephone']; ?></td>
          </tr>
          <tr>
            <th scope="row">Adresse</th>
            <td><?php echo $employe['adresse']; ?></td>
          </tr>
          <tr>
            <th scope="row">Login</th>
            <td><?php echo $employe['login']; ?></td>
          </tr>
          <tr>
            <th scope="row">Date d'embauche</th>
            <td><?php echo $employe['date_embauche']; ?></td>
          </tr>
          <tr>
            <th scope="row">Statut</th>
            <td><?php echo $employe['statut']; ?></td>
          </tr>
          <tr>
            <th scope="row">Salaire</th>
            <td><?php echo $employe['salaire']; ?></td>
          </tr>
          <!-- Ajoutez d'autres informations de l'employé ici -->
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

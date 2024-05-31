<?php
require_once("identifier.php");
require_once("connexiondb.php");

// Vérifiez que la connexion à la base de données est bien établie
if ($pdo) {
    // Requête pour récupérer les rôles
    $reqRoles = "SELECT numR, nomR FROM roles";
    $resultatRoles = $pdo->query($reqRoles);

    // Vérifiez s'il y a une erreur dans la requête SQL
    if ($resultatRoles === false) {
        echo "Erreur dans la requête SQL : " . $pdo->errorInfo()[2];
    } else {
        $roles = $resultatRoles->fetchAll(PDO::FETCH_ASSOC);
    }
} else {
    echo "Erreur de connexion à la base de données.";
}
?>
<?php 
 if ($_SESSION['user']['TypeCompte']=='Admin') {?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter personnel</title>
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
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="service.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="clients.php">Clients</a>
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
<div class="container mt-5 custom-container">
    <div class="row justify-content-center">
        <div class="photo4"><img src="images/16.jpg" /></div>
        <div class="col-md-6">
            <h2 class="text-center mb-4 center-text2 ">Ajouter un Personnel</h2>
            <form method="post" action="insertPersonnel.php">
                <div class="form-group">
                    <label for="nom" class="form-label">Nom</label>
                    <input name="nom" type="text" class="form-control form-input" id="nom" placeholder="Entrez le nom">
                </div>
                <div class="form-group">
                    <label for="prenom" class="form-label">Prénom</label>
                    <input name="prenom" type="text" class="form-control form-input" id="prenom" placeholder="Entrez le prénom">
                </div>
                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input name="email" type="email" class="form-control form-input" id="email" placeholder="Entrez l'email">
                </div>
                <div class="form-group">
                    <label for="telephone" class="form-label">Téléphone</label>
                    <input name="telephone" type="tel" class="form-control form-input" id="telephone" placeholder="Entrez le téléphone">
                </div>
                <div class="form-group">
                    <label for="adresse" class="form-label">Adresse</label>
                    <input name="adresse" type="text" class="form-control form-input" id="adresse" placeholder="Entrez l'adresse">
                </div>
                <div class="form-group">
                    <label for="login" class="form-label">Login</label>
                    <input name="login" type="text" class="form-control form-input" id="login" placeholder="Entrez le login">
                </div>
                <div class="form-group">
                    <label for="password" class="form-label">Mot de passe</label>
                    <input name="password" type="password" class="form-control form-input" id="password" placeholder="Entrez le mot de passe">
                </div>
                <div class="form-group">
                    <label for="role" class="form-label">Rôle</label>
                    <select class="form-control form-input" id="role" name="role">
                    <option value="" selected disabled>Choisir le role</option>
                        <?php
                        if (!empty($roles)) {
                            foreach ($roles as $role) {
                                echo "<option value='" . $role['numR'] . "'>" . $role['nomR'] . "</option>";
                            }
                        } else {
                            echo "<option value=''>Aucun rôle disponible</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date_embauche" class="form-label">Date d'embauche</label>
                    <input name="date_embauche" type="date" class="form-control form-input" id="date_embauche">
                </div>
                <button type="submit" class="btn btn-success btn-send">Valider</button>
            </form>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php } ?> 
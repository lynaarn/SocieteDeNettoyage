<?php
require_once("identifier.php");
require_once("connexiondb.php");

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$requete = "SELECT users.id AS user_id, nom, prenom, email, telephone, adresse, login, etat, employe.date_embauche, employe.statut, employe.salaire 
            FROM users
            INNER JOIN employe ON users.id = employe.id
            WHERE users.id = $id";

$resultat = $pdo->query($requete);

if ($employe = $resultat->fetch()) {
    $nom = $employe['nom'];
    $prenom = $employe['prenom'];
    $email = $employe['email'];
    $telephone = $employe['telephone'];
    $adresse = $employe['adresse'];
    $login = $employe['login'];
    $etat = $employe['etat'];
    $date_embauche = $employe['date_embauche'];
    $statut = $employe['statut'];
    $salaire = $employe['salaire'];
} else {
    echo "Employé non trouvé.";
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
    <title>Modifier Employé</title>
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
          <a class="nav-link" href="service.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="Menuclients.php">Clients</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="personnels.php">Personnels</a>
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
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h2 class="text-center mb-4">Modifier un Employé</h2>
            <form method="post" action="updateEmploye.php">
                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                <div class="form-group">
                    <label for="nom">Nom</label>
                    <input type="text" name="nom" value="<?php echo $nom; ?>" class="form-control" id="nom" required>
                </div>
                <div class="form-group">
                    <label for="prenom">Prénom</label>
                    <input type="text" name="prenom" value="<?php echo $prenom; ?>" class="form-control" id="prenom" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" id="email" required>
                </div>
                <div class="form-group">
                    <label for="telephone">Téléphone</label>
                    <input type="text" name="telephone" value="<?php echo $telephone; ?>" class="form-control" id="telephone">
                </div>
                <div class="form-group">
                    <label for="adresse">Adresse</label>
                    <input type="text" name="adresse" value="<?php echo $adresse; ?>" class="form-control" id="adresse">
                </div>
                <div class="form-group">
                    <label for="login">Login</label>
                    <input type="text" name="login" value="<?php echo $login; ?>" class="form-control" id="login" required>
                </div>
                <div class="form-group">
                    <label for="etat">État</label>
                    <select name="etat" id="etat" class="form-control">
                        <option value="1" <?php if ($etat == 1) echo "selected"; ?>>Activé</option>
                        <option value="0" <?php if ($etat == 0) echo "selected"; ?>>Désactivé</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date_embauche">Date d'embauche</label>
                    <input type="date" name="date_embauche" value="<?php echo $date_embauche; ?>" class="form-control" id="date_embauche">
                </div>
                <div class="form-group">
                    <label for="statut">Statut</label>
                    <select name="statut" id="statut" class="form-control">
                        <option value="Actif" <?php if ($statut == 'Actif') echo "selected"; ?>>Actif</option>
                        <option value="Congé" <?php if ($statut == 'Congé') echo "selected"; ?>>Congé</option>
                        <option value="Maladie" <?php if ($statut == 'Maladie') echo "selected"; ?>>Maladie</option>
                        <option value="Maternité/Paternité" <?php if ($statut == 'Maternité/Paternité') echo "selected"; ?>>Maternité/Paternité</option>
                        <option value="Démissionnaire" <?php if ($statut == 'Démissionnaire') echo "selected"; ?>>Démissionnaire</option>
                        <option value="Licencié" <?php if ($statut == 'Licencié') echo "selected"; ?>>Licencié</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="salaire">Salaire</label>
                    <input type="text" name="salaire" value="<?php echo $salaire; ?>" class="form-control" id="salaire">
                </div>
                <button type="submit" class="btn btn-success btn-block">Valider</button>
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

<?php
require_once("identifier.php");
require_once("connexiondb.php");

$id = isset($_GET['id']) ? $_GET['id'] : 0;
$requete = "SELECT users.id AS user_id, nom, prenom, email, telephone, adresse, login, etat, role, nomR, date_embauche 
            FROM users
            INNER JOIN personnel_administratif ON users.id = personnel_administratif.id
            INNER JOIN roles ON personnel_administratif.role = roles.numR
            WHERE users.id = $id";

$resultat = $pdo->query($requete);

if ($personnel = $resultat->fetch()) {
    $nom = $personnel['nom'];
    $prenom = $personnel['prenom'];
    $email = $personnel['email'];
    $telephone = $personnel['telephone'];
    $adresse = $personnel['adresse'];
    $login = $personnel['login'];
    $etat = $personnel['etat'];
    $role = $personnel['role'];
    $nomR = $personnel['nomR'];
    $date_embauche = $personnel['date_embauche'];
} else {
    echo "Personnel not found.";
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
    <title>Modifier Personnel</title>
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
    <a class="navbar-brand" href="index.html"><img src="images/logoo.png" alt="Capiclean Logo "></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent"> 
      <ul class="navbar-nav ml-auto">
        <li class="nav-item ">
          <a class="nav-link" href="service.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="clients.php">Clients</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="personnels.php">Personnels</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menucontrat.php">Contrats</a>
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

<div class="container mt-5">
    <div class="row justify-content-center">
    <div class="photo4"><img src="images/65.jpg" /></div>
        <div class="col-md-6">
        <h2 class="text-center mb-4 center-text2 ">Modifier un personnel</h2>
            <form method="post" action="updatePersonnel.php">
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
                    <label for="role">Rôle</label>
                    <select name="role" id="role" class="form-control">
                        <?php
                        $rolesReq = "SELECT * FROM roles";
                        $rolesResult = $pdo->query($rolesReq);
                        while ($roleData = $rolesResult->fetch()) {
                            $selected = $roleData['numR'] == $role ? 'selected' : '';
                            echo "<option value='{$roleData['numR']}' $selected>{$roleData['nomR']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="date_embauche">Date d'embauche</label>
                    <input type="date" name="date_embauche" value="<?php echo $date_embauche; ?>" class="form-control" id="date_embauche">
                </div>
                <button type="submit" class="btn btn-success btn-send ok">valider</button>
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
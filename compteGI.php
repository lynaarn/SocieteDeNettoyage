<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon compte</title>
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
        <li class="nav-item ">
        <a class="nav-link" href="listeReservations.php">Interventions reservation</a>
        </li>
        <li class="nav-item ">
        <a class="nav-link" href="interventionsContrats.php">Interventions contrat</a>
        </li>
        <li class="nav-item active ">
            <a class="nav-link" href="compteGI.php"><i class="fas fa-user fa-lg ml-5"></i></a> 
        </li>
        <li class="nav-item ">
            <a class="nav-link ml-2" href="deconnexionClient.php">Deconnexion</a>
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
            <form>
              <div class="text-center mb-3">
                <img src="images/67.jpg" class="rounded-circle"  width="200">
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="nom" class="bold-label"><i class="far fa-user"></i>Nom</label>
                  <input type="text" class="form-control" id="nom" value="Nom de l'utilisateur" readonly>
                </div>
                <div class="form-group col-md-6">
                  <label for="prenom" class="bold-label"><i class="far fa-user"></i>Prénom</label>
                  <input type="text" class="form-control" id="prenom" value="Prénom de l'utilisateur" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="tel" class="bold-label"><i class="fas fa-phone"></i>Numéro de téléphone</label>
                  <input type="text" class="form-control" id="tel" value="Numéro de téléphone" readonly>
                </div>
                <div class="form-group col-md-6">
                  <label for="adresse" class="bold-label"><i class="fas fa-map-marker-alt"></i>Adresse</label>
                  <input type="text" class="form-control" id="adresse" value="Adresse de l'utilisateur" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="login" class="bold-label"><i class="fas fa-user-circle"></i>Login</label>
                  <input type="text" class="form-control" id="login" value="Login de l'utilisateur" readonly>
                </div>
                <div class="form-group col-md-6">
                  <label for="mdp" class="bold-label"><i class="fas fa-lock"></i>Mot de passe</label>
                  <input type="password" class="form-control" id="mdp" value="********" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="email" class="bold-label"><i class="fas fa-at"></i>Email</label>
                  <input type="email" class="form-control" id="email" value="Email de l'utilisateur" readonly>
                </div>
                <div class="form-group col-md-6">
                  <label for="typeCompte" class="bold-label"><i class="fas fa-id-badge"></i>Type de Compte</label>
                  <input type="text" class="form-control" id="typeCompte" value="Type de compte" readonly>
                </div>
              </div>
              <div class="form-row">
                <div class="form-group col-md-6">
                  <label for="date_embauche" class="bold-label"><i class="fas fa-calendar-alt"></i>Date d'embauche</label>
                  <input type="date" class="form-control" id="date_embauche" value="Date d'embauche" readonly>
                </div>
                <div class="form-group col-md-6">
                  <label for="role" class="bold-label"><i class="fas fa-briefcase"></i>Rôle</label>
                  <input type="text" class="form-control" id="role" value="Rôle de l'utilisateur" readonly>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div style="height: 50px;"></div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
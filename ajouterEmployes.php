<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capiclean</title>
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
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent"> <!-- Ajoutez la classe justify-content-center pour centrer les éléments -->
      <ul class="navbar-nav">
        <li class="nav-item ">
          <a class="nav-link active" href="employes.php">Employés</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="congés.php">Congés</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="arrêtDeTravail.php">Arrêt de travail</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="demandeDemplois.php">demande D'emplois</a>
        </li>
        <li class="nav-item  ">
            <a class="nav-link" href="compteRHH.php"><i class="fas fa-user fa-lg ml-5"></i></a> 
        </li>
        <li class="nav-item ">
            <a class="nav-link ml-2" href="deconnexionClient.php">Deconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="container mt-5 custom-container">
    <div class="row justify-content-center">
    <div class="photo4"><img src="images/24.jpg" /></div>
        <div class="col-md-6">
       
            <h2 class="text-center mb-4 center-text2 ">Ajouter un employé</h2>
           
            <form>
            <div class="form-group">
    <label for="codeemploye" class="form-label">Code employé</label>
    <input type="number" class="form-control form-input" id="codepersonnel" placeholder="Entrez le code de l'employé">
</div>
<div class="form-group">
    <label for="nomEmploye" class="form-label">Nom employé</label>
    <input type="text" class="form-control form-input" id="nomEmploye" placeholder="Entrez le nom de l'employé">
</div>
<div class="form-group">
    <label for="prenomEmploye" class="form-label">Prénom employé</label>
    <input type="text" class="form-control form-input" id="PrénomEmploye" placeholder="Entrez le prénom de l'employé">
</div>
<div class="form-group">
                    <label for="adresseEmploye" class="form-label">Adresse employé</label>
                    <input type="text" class="form-control form-input" id="adresseEmploye" placeholder="Entrez l'adresse de l'employé">
                </div>
                <div class="form-group" >
                    <label for="telEmploye" class="form-label">Numéro de téléphone</label>
                    <input type="tel" class="form-control form-input" id="telEmploye" placeholder="Entrez le numéro de téléphone de l'employé">
                </div>
                <div class="form-group">
                 <label for="specialiteEmploye" class="form-label">Spécialité de l'employé</label>
                 <select class="form-control form-input" id="specialiteEmploye">
                    <option value="1">nettoyeurs de vitres</option>
                    <option value="2">nettoyeurs de sols</option>
                    <option value="3">jsp </option>
        <!-- Ajoutez d'autres options selon les spécialités disponibles -->
                 </select>
                </div>
                <div class="form-group">
                    <label for="emailEmploye" class="form-label">Email employé</label>
                    <input type="email" class="form-control form-input" id="emailEmploye" placeholder="Entrez l'email de l'employé">
                </div>
                <div class="form-group" >
                    <label for="mdpEmploye" class="form-label">Mot de passe employé</label>
                    <input type="password" class="form-control form-input" id="mdpEmploye" placeholder="Entrez le mot de passe de l'employé">
                </div>
                
               


                <button type="submit" class="btn btn-success btn-send">Envoyer</button>
            </form>
        </div>
    </div>
</div>





<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

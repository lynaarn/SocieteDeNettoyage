<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capiclean</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">

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
        <li class="nav-item active">
          <a class="nav-link active" href="service.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="clients.php">Clients</a>
        </li>
        <li class="nav-item">
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


<div class="container mt-5 custom-container">
    <div class="row justify-content-center">
    <div class="photo4"><img src="images/15.jpg" /></div>
        <div class="col-md-6">
       
            <h2 class="text-center mb-4 center-text2 ">Ajouter un client</h2>
           
            <form>
            <div class="form-group">
    <label for="codeService" class="form-label">Code client</label>
    <input type="text" class="form-control form-input" id="codeclient" placeholder="Entrez le code du client">
</div>
<div class="form-group">
    <label for="nomclient" class="form-label">Nom client</label>
    <input type="text" class="form-control form-input" id="nomclient" placeholder="Entrez le nom du client">
</div>
<div class="form-group">
    <label for="nomclient" class="form-label">Prénom client</label>
    <input type="text" class="form-control form-input" id="Prénomclient" placeholder="Entrez le prénom du client">
</div>
<div class="form-group">
                    <label for="adresseClient" class="form-label">Adresse client</label>
                    <input type="text" class="form-control form-input" id="adresseClient" placeholder="Entrez l'adresse du client">
                </div>
                <div class="form-group" >
                    <label for="telClient" class="form-label">Numéro de téléphone</label>
                    <input type="tel" class="form-control form-input" id="telClient" placeholder="Entrez le numéro de téléphone du client">
                </div>
                <div class="form-group">
                    <label for="emailClient" class="form-label">Email client</label>
                    <input type="email" class="form-control form-input" id="emailClient" placeholder="Entrez l'email du client">
                </div>
                <div class="form-group" >
                    <label for="mdpClient" class="form-label">Mot de passe client</label>
                    <input type="password" class="form-control form-input" id="mdpClient" placeholder="Entrez le mot de passe du client">
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

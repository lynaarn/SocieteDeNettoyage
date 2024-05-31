<?php
require_once("identifier.php");
?>
<?php 
 if ($_SESSION['user']['TypeCompte']=='RRH') {?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter demande d'emplois</title>
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
        <li class="nav-item ">
          <a class="nav-link " href="employes.php">Employés</a>
        </li>
  
        <li class="nav-item">
          <a class="nav-link" href="congés.php">Congés</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="arrêtDeTravail.php">Arrêt de travail</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="menuDemandeDemplois.php">demande D'emplois</a>
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
    <div class="photo4"><img src="images/26.jpg" /></div>
        <div class="col-md-6">
       
            <h2 class="text-center mb-4 center-text2 ">Ajouter une offre d'emplois</h2>
           
            <form action="insertOffre.php" method="POST">
                <div class="form-group">
                    <label for="titreOffre" class="form-label">Titre de l'offre</label>
                    <input type="text" class="form-control form-input" id="titreOffre" name="titre" placeholder="Entrez le titre de l'offre" required>
                </div>
                <div class="form-group">
                    <label for="descriptionOffre" class="form-label">Description de l'offre</label>
                    <textarea class="form-control form-input" id="descriptionOffre" name="description" rows="3" placeholder="Entrez la description de l'offre" required></textarea>
                </div>
                <div class="form-group">
                    <label for="typeContrat" class="form-label">Type de contrat</label>
                    <select class="form-control form-input" id="typeContrat" name="type_contrat" required onchange="toggleDateFin()">
                        <option value="" selected disabled>Choisir le type de contrat</option>
                        <option value="CDI">CDI</option>
                        <option value="CDD">CDD</option>
                        <option value="Stage">Stage</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="dateDebut" class="form-label">Date de début</label>
                    <input type="date" class="form-control form-input" id="dateDebut" name="date_debut" required>
                </div>
                <div class="form-group" id="dateFinGroup">
                    <label for="dateFin" class="form-label">Date de fin</label>
                    <input type="date" class="form-control form-input" id="dateFin" name="date_fin">
                </div>
                <div class="form-group">
                    <label for="competencesRequises" class="form-label">Compétences requises</label>
                    <textarea class="form-control form-input" id="competencesRequises" name="competences_requises" rows="3" placeholder="Liste des compétences requises" required></textarea>
                </div>
                <button type="submit" class="btn btn-success btn-send">Publier l'offre</button>
            </form>
        </div>
    </div>
</div>

<script>
    function toggleDateFin() {
        var typeContrat = document.getElementById('typeContrat').value;
        var dateFinGroup = document.getElementById('dateFinGroup');
        if (typeContrat === 'CDI') {
            dateFinGroup.style.display = 'none';
        } else {
            dateFinGroup.style.display = 'block';
        }
    }
    window.onload = function() {
        toggleDateFin(); // Ensure the correct state on page load
    };
</script>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php } ?>
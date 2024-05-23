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
  <a class="navbar-brand" href="index.html"><img src="images/logoo.png" alt="Capiclean Logo"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent"> <!-- Ajoutez la classe justify-content-center pour centrer les éléments -->
      <ul class="navbar-nav">
        <li class="nav-item ">
          <a class="nav-link " href="employes.php">Employés</a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="congés.php">Congés</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link active" href="arrêtDeTravail.php">Arrêt de travail</a>
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

<div class="container mt-5">
  <div class="row">
    <div class="col">
      <h2 class="center-text">Les demandes d'arrêt de travail</h2> 
      <div class="photo2"><img src="images/20.jpg" /></div>
    
      <form class="form-inline mb-3 justify-content-end"> <!-- Utilisez la classe justify-content-end pour aligner à droite -->
        <input class="form-control mr-sm-2" type="search" placeholder="Rechercher un arrêt" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher </button>
      </form>

      <table class="table table-hover">
        <thead class="couleurTableau">
          <tr>
            <th scope="col">Num employé</th>
            <th scope="col">Nom employé</th>
            <th scope="col">Date début</th>
            <th scope="col">Date fin</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr>
            <th scope="row">1</th>
            <td>John</td>
            <td>Doe</td>
            <td>Jones</td>
            <td class="action-icons">
              <a href="modifierEmployes.php" class="edit-icon2"><i class="fas fa-check"></i></a>
              <a href="supprimerEmployes.php" class="delete-icon"><i class="fas fa-user-times"></i></a>
            </td>
          </tr>
          <tr>
            <th scope="row">2</th>
            <td>Jane</td>
            <td>Smith</td>
            <td>Jones</td>
            <td class="action-icons">
              <a href="modifierEmployes.php" class="edit-icon2"><i class="fas fa-check"></i></a>
              <a href="supprimerEmployes.php" class="delete-icon"><i class="fas fa-user-times"></i></a>
            </td>
          </tr>
          <tr>
            <th scope="row">3</th>
            <td>David</td>
            <td>Jones</td>
            <td>Jones</td>
            <td class="action-icons">
              <a href="modifierEmployes.php" class="edit-icon2"><i class="fas fa-check"></i></a>
              <a href="supprimerEmployes.php" class="delete-icon"><i class="fas fa-user-times"></i></a>
            </td>
          </tr>
          <tr>
            <th scope="row">4</th>
            <td>David</td>
            <td>Jones</td>
            <td>Jones</td>
            <td class="action-icons">
              <a href="modifierEmployes.php" class="edit-icon2"><i class="fas fa-check"></i></a>
              <a href="supprimerEmployes.php" class="delete-icon"><i class="fas fa-user-times"></i></a>
            </td>
          </tr>
        </tbody>
      </table>
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center paginationModif">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédant</a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item"><a class="page-link" href="#">2</a></li>
          <li class="page-item"><a class="page-link" href="#">3</a></li>
          <li class="page-item">
            <a class="page-link" href="#">Suivant</a>
          </li>
      
        </ul>
      </nav>
      
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

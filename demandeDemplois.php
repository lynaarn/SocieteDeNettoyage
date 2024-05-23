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
    <style>
        .modal-content {
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.5);
        }
        .modal-header {
            background-color: #aacee4;
            color: white;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }
        .modal-footer {
            background-color: #f1f1f1;
        }
        .modal-body p, .modal-body ul {
            font-size: 16px;
            line-height: 1.6;
        }
        .modal-body ul {
            list-style-type: none;
            padding-left: 0;
        }
        .modal-body ul li::before {
            content: "• ";
            color: #aacee4;
            font-weight: bold;
        }
    </style>
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
          <a class="nav-link" href="employes.php">Employés</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="congés.php">Congés</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="arrêtDeTravail.php">Arrêt de travail</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="demandeDemplois.php">Demande d'emplois</a>
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
      <h2 class="center-text">Les demandes d'emplois</h2> 
      <p class="text-center text-muted">Cliquez sur un candidat pour voir son CV </p>
      <div class="photo1"><img src="images/25.jpg" /></div>
    
      <form class="form-inline mb-3 justify-content-end">
        <input class="form-control mr-sm-2" type="search" placeholder="Rechercher une demande" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher </button>
      </form>

      <table class="table table-hover">
        <thead class="couleurTableau">
          <tr>
            <th scope="col">Nom</th>
            <th scope="col">Prénom</th>
            <th scope="col">Age</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          <tr data-toggle="modal" data-target="#cvModal1">
            <td>Bensalma</td>
            <td>Mounir</td>
            <td>21</td>
            <td class="action-icons">
              <a href="#" class="edit-icon2"><i class="fas fa-check"></i></a>
              <a href="#" class="delete-icon"><i class="fas fa-user-times"></i></a>
            </td>
          </tr>
          <tr data-toggle="modal" data-target="#cvModal2">
            <td>Assala</td>
            <td>Souhila</td>
            <td>28</td>
            <td class="action-icons">
              <a href="#" class="edit-icon2"><i class="fas fa-check"></i></a>
              <a href="#" class="delete-icon"><i class="fas fa-user-times"></i></a>
            </td>
          </tr>
          <tr data-toggle="modal" data-target="#cvModal3">
            <td>Benrahma</td>
            <td>Rachid</td>
            <td>24</td>
            <td class="action-icons">
              <a href="#" class="edit-icon2"><i class="fas fa-check"></i></a>
              <a href="#" class="delete-icon"><i class="fas fa-user-times"></i></a>
            </td>
          </tr>
        </tbody>
      </table>
      <nav aria-label="Page navigation example">
        <ul class="pagination justify-content-center paginationModif">
          <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Précédent</a>
          </li>
          <li class="page-item"><a class="page-link" href="#">1</a></li>
          <li class="page-item">
            <a class="page-link" href="#">Suivant</a>
          </li>
          <a href="ajouterDemandeDemploi.php" class="btn ajout mb-3">poster une nouvelle demande d'emploi</a>
        </ul>
      </nav>
    </div>
  </div>
</div>

<!-- Modal for CV 1 -->
<div class="modal fade" id="cvModal1" tabindex="-1" role="dialog" aria-labelledby="cvModalLabel1" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cvModalLabel1">CV de Bensalma Mounir</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Content of the CV -->
        <p><strong>Nom:</strong> Bensalma Mounir</p>
        <p><strong>Age:</strong> 21</p>
        <p><strong>Expérience:</strong></p>
        <ul>
          <li>Développeur web chez XYZ (2015-2020)</li>
          <li>Ingénieur logiciel chez ABC (2010-2015)</li>
        </ul>
        <p><strong>Compétences:</strong></p>
        <ul>
          <li>HTML, CSS, JavaScript</li>
          <li>PHP, MySQL</li>
          <li>React, Node.js</li>
        </ul>
        <p><strong>Éducation:</strong></p>
        <ul>
          <li>Licence en Informatique - Université de Somewhere (2006-2010)</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for CV 2 -->
<div class="modal fade" id="cvModal2" tabindex="-1" role="dialog" aria-labelledby="cvModalLabel2" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cvModalLabel2">CV de Jane Smith</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Content of the CV -->
        <p><strong>Nom:</strong> Jane Smith</p>
        <p><strong>Age:</strong> 28</p>
        <p><strong>Expérience:</strong></p>
        <ul>
          <li>Designer graphique chez PQR (2017-2022)</li>
          <li>Illustratrice chez DEF (2012-2017)</li>
        </ul>
        <p><strong>Compétences:</strong></p>
        <ul>
          <li>Adobe Photoshop, Illustrator</li>
          <li>UI/UX Design</li>
          <li>Sketch, Figma</li>
        </ul>
        <p><strong>Éducation:</strong></p>
        <ul>
          <li>Licence en Design Graphique - Université de Nowhere (2008-2012)</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<!-- Modal for CV 3 -->
<div class="modal fade" id="cvModal3" tabindex="-1" role="dialog" aria-labelledby="cvModalLabel3" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="cvModalLabel3">CV de David Jones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Content of the CV -->
        <p><strong>Nom:</strong> David Jones</p>
        <p><strong>Age:</strong> 35</p>
        <p><strong>Expérience:</strong></p>
        <ul>
          <li>Manager chez JKL (2018-2023)</li>
          <li>Consultant chez MNO (2012-2018)</li>
        </ul>
        <p><strong>Compétences:</strong></p>
        <ul>
          <li>Management</li>
          <li>Stratégie d'entreprise</li>
          <li>Excel, Tableau</li>
        </ul>
        <p><strong>Éducation:</strong></p>
        <ul>
          <li>MBA - Université de Somewhere Else (2005-2010)</li>
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

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
    
    <style>
       
        .card {
            position: relative;
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
            background-color: #ffffff;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            border-radius: 10px;
            padding: 20px;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #343a40;
        }

        .card-text {
            font-size: 1rem;
            color: #6c757d;
        }

        /* Style pour les icônes Font Awesome */
        .fa-icon {
            margin-right: 8px;
            color: 	#2E8B57;
        }

        .task-list {
            margin-top: 10px;
        }

        .task-list li {
            margin-bottom: 5px;
        }

        .time-badge {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: red;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
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
        <li class="nav-item ">
          <a class="nav-link " href="demission.php">Démission</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link " href="menuconge.php">Congés</a>
        </li>
        <li class="nav-item  ">
          <a class="nav-link" href="historiqueintervention.php">Historique interventions</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="tacheethoraire.php">attribution tâche et horraire</a>
        </li>
        <li class="nav-item  ">
            <a class="nav-link" href="compteEmploye.php"><i class="fas fa-user fa-lg ml-5"></i></a> 
        </li>
        <li class="nav-item ">
            <a class="nav-link ml-2" href="deconnexionClient.php">Deconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h2 class="center-text"><i class="fas fa-tasks fa-icon"></i>Mon attributions des tâches</h2>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="time-badge">8h-12h</div>
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-calendar-day fa-icon"></i>Samedi 11-05-2024</h5>
                    <ul class="task-list">
                        <li><i class="fas fa-check fa-icon"></i>Passer l'aspirateur</li>
                        <li><i class="fas fa-check fa-icon"></i>Faire la vaisselle</li>
                        <li><i class="fas fa-check fa-icon"></i>Nettoyer la salle de bain</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="time-badge">12h-17h</div>
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-calendar-day fa-icon"></i>Mardi 12-05-2024</h5>
                    <ul class="task-list">
                        <li><i class="fas fa-check fa-icon"></i>Dépoussiérer les meubles</li>
                        <li><i class="fas fa-check fa-icon"></i>Faire les lits</li>
                        <li><i class="fas fa-check fa-icon"></i>Laver le sol</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="time-badge">9h-11h</div>
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-calendar-day fa-icon"></i>Lundi 13-05-2024</h5>
                    <ul class="task-list">
                        <li><i class="fas fa-check fa-icon"></i>Sortir les poubelles</li>
                        <li><i class="fas fa-check fa-icon"></i>Repasser le linge</li>
                        <li><i class="fas fa-check fa-icon"></i>Ranger les pièces</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="time-badge">15h-18h</div>
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-calendar-day fa-icon"></i>Jeudi 19-05-2024</h5>
                    <ul class="task-list">
                        <li><i class="fas fa-check fa-icon"></i>Nettoyer les vitres</li>
                        <li><i class="fas fa-check fa-icon"></i>Changer les draps</li>
                        <li><i class="fas fa-check fa-icon"></i>Organiser le placard</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="time-badge">7h-13h</div>
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-calendar-day fa-icon"></i>Jeudi 23-05-2024</h5>
                    <ul class="task-list">
                        <li><i class="fas fa-check fa-icon"></i>Laver les rideaux</li>
                        <li><i class="fas fa-check fa-icon"></i>Nettoyer le four</li>
                        <li><i class="fas fa-check fa-icon"></i>Arroser les plantes</li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="time-badge">10h-12h</div>
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-calendar-day fa-icon"></i>Lundi 27-05-2024</h5>
                    <ul class="task-list">
                        <li><i class="fas fa-check fa-icon"></i>Nettoyer le réfrigérateur</li>
                        <li><i class="fas fa-check fa-icon"></i>Balayer la terrasse</li>
                        <li><i class="fas fa-check fa-icon"></i>Essuyer les comptoirs</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap

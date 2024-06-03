<?php
require_once("identifier.php");
require_once("connexiondb.php");

// Récupérer l'ID de l'employé connecté
$id_employe = $_SESSION['user']['id'];

// Requête pour obtenir les interventions de l'employé pour les réservations
$requeteInterventionsReservations = $pdo->prepare("
    SELECT 
        i.numI, i.etat, i.codeR, 
        r.date_prestation, r.heure_prestation, 
        ei.tache 
    FROM 
        intervention i 
    JOIN 
        reservation r ON i.codeR = r.codeR
    JOIN 
        employe_intervention ei ON i.numI = ei.intervention_id
    WHERE 
        ei.employe_id = ? AND r.date_prestation >= CURDATE()
");
$requeteInterventionsReservations->execute([$id_employe]);
$interventionsReservations = $requeteInterventionsReservations->fetchAll(PDO::FETCH_ASSOC);

// Requête pour obtenir les interventions de l'employé pour les contrats
$requeteInterventionsContrats = $pdo->prepare("
    SELECT 
        i.numI, i.etat, 
        sc.frequence, 
        ei.tache 
    FROM 
        intervention i 
    JOIN 
        ServiceDansContrat sc ON i.numI = sc.intervention_id
    JOIN 
        employe_intervention ei ON i.numI = ei.intervention_id
    WHERE 
        ei.employe_id = ? 
");
$requeteInterventionsContrats->execute([$id_employe]);
$interventionsContrats = $requeteInterventionsContrats->fetchAll(PDO::FETCH_ASSOC);
?>

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
            height: 100%; /* Ensure the card takes full height */
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-body {
            border-radius: 10px;
            padding: 20px;
            display: flex;
            flex-direction: column;
            justify-content: space-between; /* Distribute space between elements */
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
            color: #2E8B57;
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
            font-size: 1rem; /* Adjust font size if needed */
        }

        .date-badge {
            font-size: 1rem;
            font-weight: bold;
            color: #2E8B57;
            margin-bottom: 10px;
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
          <a class="nav-link" href="tacheethoraire.php">Attribution tâche et horaire</a>
        </li>
        <li class="nav-item  ">
            <a class="nav-link" href="compteEmploye.php"><i class="fas fa-user fa-lg ml-5"></i></a> 
        </li>
        <li class="nav-item ">
            <a class="nav-link ml-2" href="deconnexionClient.php">Déconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h2 class="center-text"><i class="fas fa-tasks fa-icon"></i> Mes attributions des tâches</h2>

    <div class="row">
        <div class="col-12">
            <h3 class="mt-5">Attributions pour Réservations</h3>
            <?php if (empty($interventionsReservations)): ?>
                <div class="alert alert-info" role="alert">
                    Vous n'avez aucune intervention pour les réservations pour le moment.
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($interventionsReservations as $intervention): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="time-badge"><?php echo date('H:i', strtotime($intervention['heure_prestation'])); ?></div>
                                <div class="card-body">
                                    <div class="date-badge"><i class="fas fa-calendar-day fa-icon"></i><?php echo date('l d-m-Y', strtotime($intervention['date_prestation'])); ?></div>
                                    <ul class="task-list">
                                        <li><i class="fas fa-check fa-icon"></i><?php echo htmlspecialchars($intervention['tache']); ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h3 class="mt-5">Attributions pour Contrats</h3>
            <?php if (empty($interventionsContrats)): ?>
                <div class="alert alert-info" role="alert">
                    Vous n'avez aucune intervention pour les contrats pour le moment.
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($interventionsContrats as $intervention): ?>
                        <div class="col-md-4 mb-4">
                            <div class="card">
                                <div class="card-body">
                                    <div class="date-badge"><i class="fas fa-calendar-day fa-icon"></i><?php echo htmlspecialchars($intervention['frequence']); ?></div>
                                    <ul class="task-list">
                                        <li><i class="fas fa-check fa-icon"></i><?php echo htmlspecialchars($intervention['tache']); ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

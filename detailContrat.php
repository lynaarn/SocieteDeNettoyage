<?php
require_once("identifier.php");
require_once("connexiondb.php");

$id_c = $_GET['id_c'];

// Récupérer les détails du contrat
$contratQuery = $pdo->prepare("
    SELECT c.*, u.nom, u.prenom, u.email, u.telephone, u.adresse 
    FROM contrat c 
    JOIN Client cl ON c.client_id = cl.id 
    JOIN users u ON cl.id = u.id 
    WHERE c.id_c = ?
");
$contratQuery->execute([$id_c]);
$contrat = $contratQuery->fetch(PDO::FETCH_ASSOC);

// Récupérer les services du contrat
$servicesQuery = $pdo->prepare("
    SELECT sc.*, s.NomS, sc.intervention_id 
    FROM ServiceDansContrat sc 
    JOIN Service s ON sc.CodeS = s.CodeS 
    WHERE sc.id_c = ?
");
$servicesQuery->execute([$id_c]);
$services = $servicesQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Détails du Contrat</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    
    <style>
        body {
            background-color: #F2F8FE;
        }
        .content {
            margin-top: 80px;
        }
        .section-title {
            margin-top: 40px;
        }
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
        <a class="nav-link" href="listeReservations.php">Interventions reservation</a>
        </li>
        <li class="nav-item active">
        <a class="nav-link" href="interventionsContrats.php">Interventions contrat</a>
        </li>
        <li class="nav-item  ">
            <a class="nav-link" href="compteGI.php"><i class="fas fa-user fa-lg ml-5"></i></a> 
        </li>
        <li class="nav-item ">
            <a class="nav-link ml-2" href="deconnexionClient.php">Deconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container content">
    <h2 class="center-text"><i class="fas fa-file-contract fa-icon"></i> Détails du Contrat</h2>

    <h2>Informations du Client</h2>
    <div class="card mb-4">
        <div class="card-body">
            <p class="card-text"><strong>Nom:</strong> <?= htmlspecialchars($contrat['nom']) ?> <?= htmlspecialchars($contrat['prenom']) ?></p>
            <p class="card-text"><strong>Email:</strong> <?= htmlspecialchars($contrat['email']) ?></p>
            <p class="card-text"><strong>Téléphone:</strong> <?= htmlspecialchars($contrat['telephone']) ?></p>
            <p class="card-text"><strong>Adresse:</strong> <?= htmlspecialchars($contrat['adresse']) ?></p>
        </div>
    </div>

    <h2>Informations du Contrat</h2>
    <div class="card mb-4">
        <div class="card-body">
            <p class="card-text"><strong>Date de Début:</strong> <?= htmlspecialchars($contrat['date_deb']) ?></p>
            <p class="card-text"><strong>Date de Fin:</strong> <?= htmlspecialchars($contrat['date_fin']) ?></p>
            <p class="card-text"><strong>Détails:</strong> <?= htmlspecialchars($contrat['detailc']) ?></p>
        </div>
    </div>

    <h2>Services du Contrat</h2>
    <?php foreach ($services as $service): ?>
        <div class="card mb-4">
            <div class="card-body">
                <h3>Service: <?= htmlspecialchars($service['NomS']) ?></h3>
                <p class="card-text"><strong>Détails:</strong> <?= htmlspecialchars($service['detailsSer']) ?></p>
                
                <h4>Employés Affectés</h4>
                <?php
                $employesServiceQuery = $pdo->prepare("
                    SELECT ei.*, u.nom, u.prenom 
                    FROM employe_intervention ei 
                    JOIN users u ON ei.employe_id = u.id 
                    WHERE ei.intervention_id = ? AND ei.CodeS = ?
                ");
                $employesServiceQuery->execute([$service['intervention_id'], $service['CodeS']]);
                $employesService = $employesServiceQuery->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <ul class="list-group mb-3">
                    <?php foreach ($employesService as $employe): ?>
                        <li class="list-group-item"><?= htmlspecialchars($employe['nom']) ?> <?= htmlspecialchars($employe['prenom']) ?> (Tâche: <?= htmlspecialchars($employe['tache']) ?>)</li>
                    <?php endforeach; ?>
                </ul>

                <h4>Matériels Utilisés</h4>
                <?php
                $materielsServiceQuery = $pdo->prepare("
                    SELECT mi.*, m.nomM 
                    FROM materiel_intervention mi 
                    JOIN materiel m ON mi.materiel_id = m.codeM 
                    WHERE mi.intervention_id = ? AND mi.CodeS = ?
                ");
                $materielsServiceQuery->execute([$service['intervention_id'], $service['CodeS']]);
                $materielsService = $materielsServiceQuery->fetchAll(PDO::FETCH_ASSOC);
                ?>
                <ul class="list-group mb-3">
                    <?php foreach ($materielsService as $materiel): ?>
                        <li class="list-group-item"><?= htmlspecialchars($materiel['nomM']) ?> (Quantité: <?= htmlspecialchars($materiel['quantite_utilisee']) ?>)</li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php
$pdo = null;
?>

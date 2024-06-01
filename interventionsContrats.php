<?php
require_once("identifier.php");
require_once("connexiondb.php");

// Récupérer les nouveaux contrats à préparer
$nouveauxContratsQuery = $pdo->prepare("
    SELECT c.*, u.nom, u.prenom, u.email, u.telephone, u.adresse 
    FROM contrat c 
    JOIN Client cl ON c.client_id = cl.id 
    JOIN users u ON cl.id = u.id 
    WHERE c.etat = 'en attente'
");
$nouveauxContratsQuery->execute();
$nouveauxContrats = $nouveauxContratsQuery->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les contrats déjà préparés
$contratsPreparesQuery = $pdo->prepare("
    SELECT c.*, u.nom, u.prenom, u.email, u.telephone, u.adresse 
    FROM contrat c 
    JOIN Client cl ON c.client_id = cl.id 
    JOIN users u ON cl.id = u.id 
    WHERE c.etat = 'actif'
");
$contratsPreparesQuery->execute();
$contratsPrepares = $contratsPreparesQuery->fetchAll(PDO::FETCH_ASSOC);

// Récupérer les contrats nécessitant un remplacement d'employé
$contratsRemplacementQuery = $pdo->prepare("
    SELECT DISTINCT c.*, u.nom, u.prenom, u.email, u.telephone, u.adresse 
    FROM contrat c 
    JOIN Client cl ON c.client_id = cl.id 
    JOIN users u ON cl.id = u.id 
    JOIN ServiceDansContrat sc ON c.id_c = sc.id_c 
    JOIN employe_intervention ei ON sc.CodeS = ei.intervention_id
    JOIN employe e ON ei.employe_id = e.id
    WHERE e.statut IN ('Congé', 'Maladie', 'Maternité/Paternité', 'Démissionnaire')
");
$contratsRemplacementQuery->execute();
$contratsRemplacement = $contratsRemplacementQuery->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Interventions Contrats</title>

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
    <a class="navbar-brand" href="index.html"><img src="images/logoo.png" alt="Capiclean Logo "></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent"> 
      <ul class="navbar-nav ml-auto">
        <li class="nav-item">
          <a class="nav-link" href="compteGI.php"><i class="fas fa-user fa-lg"></i></a> 
        </li>
        <li class="nav-item">
          <a class="nav-link" href="deconnexionClient.php">Déconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container content">
    <h2 class="center-text"><i class="fas fa-file-contract fa-icon"></i> Gestion des Interventions par Contrat</h2>

    <div class="section-title">
        <h3>Nouveaux Contrats à Préparer</h3>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Contrat</th>
                <th>Nom Client</th>
                <th>Date Début</th>
                <th>Date Fin</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($nouveauxContrats as $contrat): ?>
                <tr>
                    <td><?php echo htmlspecialchars($contrat['id_c']); ?></td>
                    <td><?php echo htmlspecialchars($contrat['nom'] . ' ' . $contrat['prenom']); ?></td>
                    <td><?php echo htmlspecialchars($contrat['date_deb']); ?></td>
                    <td><?php echo htmlspecialchars($contrat['date_fin']); ?></td>
                    <td>
                        <a href="preparerContrat.php?id_c=<?php echo $contrat['id_c']; ?>" class="btn btn-primary btn-sm">Préparer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="section-title">
        <h3>Contrats Déjà Préparés</h3>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Contrat</th>
                <th>Nom Client</th>
                <th>Date Début</th>
                <th>Date Fin</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contratsPrepares as $contrat): ?>
                <tr>
                    <td><?php echo htmlspecialchars($contrat['id_c']); ?></td>
                    <td><?php echo htmlspecialchars($contrat['nom'] . ' ' . $contrat['prenom']); ?></td>
                    <td><?php echo htmlspecialchars($contrat['date_deb']); ?></td>
                    <td><?php echo htmlspecialchars($contrat['date_fin']); ?></td>
                    <td>
                        <a href="detailContrat.php?id_c=<?php echo $contrat['id_c']; ?>" class="btn btn-info btn-sm">Voir Détails</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <div class="section-title">
        <h3>Contrats Nécessitant un Remplacement d'Employé</h3>
    </div>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID Contrat</th>
                <th>Nom Client</th>
                <th>Date Début</th>
                <th>Date Fin</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contratsRemplacement as $contrat): ?>
                <tr>
                    <td><?php echo htmlspecialchars($contrat['id_c']); ?></td>
                    <td><?php echo htmlspecialchars($contrat['nom'] . ' ' . $contrat['prenom']); ?></td>
                    <td><?php echo htmlspecialchars($contrat['date_deb']); ?></td>
                    <td><?php echo htmlspecialchars($contrat['date_fin']); ?></td>
                    <td>
                        <a href="remplacerEmployeContrat.php?id_c=<?php echo $contrat['id_c']; ?>" class="btn btn-warning btn-sm">Remplacer Employé</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

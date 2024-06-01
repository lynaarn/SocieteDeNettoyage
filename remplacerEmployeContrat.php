<?php
require_once("identifier.php");
require_once("connexiondb.php");

// Récupérer l'ID du contrat
$id_c = $_GET['id_c'];

if (!$id_c) {
    die("ID du contrat est manquant");
}

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

if (!$contrat) {
    die("Aucun contrat trouvé pour l'ID spécifié");
}

// Récupérer les employés assignés au contrat et nécessitant un remplacement
$employesQuery = $pdo->prepare("
    SELECT ei.employe_id, u.nom, u.prenom, e.statut
    FROM employe_intervention ei
    JOIN employe e ON ei.employe_id = e.id
    JOIN users u ON e.id = u.id
    WHERE ei.intervention_id = ? AND e.statut IN ('Congé', 'Maladie', 'Maternité/Paternité', 'Démissionnaire')
");
$employesQuery->execute([$id_c]);
$employesARemplacer = $employesQuery->fetchAll(PDO::FETCH_ASSOC);

// Récupérer la liste des employés disponibles
$employesDisponiblesQuery = $pdo->query("
    SELECT e.id, u.nom, u.prenom 
    FROM employe e 
    JOIN users u ON e.id = u.id
    WHERE e.statut = 'Actif'
");
$employesDisponibles = $employesDisponiblesQuery->fetchAll(PDO::FETCH_ASSOC);

// Traitement du formulaire de remplacement
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['remplacements'])) {
    foreach ($_POST['remplacements'] as $employe_id_original => $nouvel_employe_id) {
        if (!empty($nouvel_employe_id)) {
            // Remplacer l'employé dans la table employe_intervention
            $updateEmployeQuery = $pdo->prepare("
                UPDATE employe_intervention 
                SET employe_id = ? 
                WHERE intervention_id = ? AND employe_id = ?
            ");
            if (!$updateEmployeQuery->execute([$nouvel_employe_id, $id_c, $employe_id_original])) {
                echo "Erreur: " . $pdo->errorInfo()[2];
            }
        }
    }
    echo "Remplacements effectués avec succès.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Remplacer Employé pour Contrat</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    
    <style>
        body {
            background-color:#F2F8FE;
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
    <h2 class="center-text"><i class="fas fa-exchange-alt fa-icon"></i> Remplacer Employé pour Contrat</h2>

    <div class="section-title">
        <h3>Contrat #<?php echo htmlspecialchars($contrat['id_c']); ?></h3>
    </div>
    <div class="card mb-4">
        <div class="card-body">
            <h5 class="card-title"><i class="fas fa-user fa-icon"></i> Client: <?php echo htmlspecialchars($contrat['nom'] . ' ' . $contrat['prenom']); ?></h5>
            <p class="card-text"><strong>Date début:</strong> <?php echo htmlspecialchars($contrat['date_deb']); ?></p>
            <p class="card-text"><strong>Date fin:</strong> <?php echo htmlspecialchars($contrat['date_fin']); ?></p>
            <p class="card-text"><strong>Détails du contrat:</strong> <?php echo htmlspecialchars($contrat['detailc']); ?></p>
        </div>
    </div>

    <form method="POST">
        <input type="hidden" name="id_c" value="<?php echo htmlspecialchars($contrat['id_c']); ?>">
        <div class="section-title">
            <h3>Employés à remplacer</h3>
        </div>
        <div class="row">
            <?php foreach ($employesARemplacer as $employe): ?>
                <div class="col-md-6 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-user-alt-slash fa-icon"></i> <?php echo htmlspecialchars($employe['nom'] . ' ' . $employe['prenom']); ?></h5>
                            <p class="card-text"><strong>Statut:</strong> <?php echo htmlspecialchars($employe['statut']); ?></p>
                            <div class="form-group">
                                <label for="nouvel_employe_<?php echo $employe['employe_id']; ?>">Nouvel employé:</label>
                                <select class="form-control" name="remplacements[<?php echo $employe['employe_id']; ?>]" id="nouvel_employe_<?php echo $employe['employe_id']; ?>">
                                    <option value="">Sélectionner un employé</option>
                                    <?php foreach ($employesDisponibles as $employeDispo): ?>
                                        <option value="<?php echo $employeDispo['id']; ?>"><?php echo htmlspecialchars($employeDispo['nom'] . ' ' . $employeDispo['prenom']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="submit" class="btn btn-primary">Remplacer Employés</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

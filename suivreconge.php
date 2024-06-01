<?php
require_once("identifier.php");
require_once("connexiondb.php");

// Récupérer l'ID de l'employé connecté
$id_employe = $_SESSION['user']['id'];

// Requête pour obtenir le congé actuel (statut 'accordé' et Date_fin dans le futur)
$requeteCongeActuel = $pdo->prepare("SELECT * FROM ArretDeTravail WHERE id = ? AND statut = 'accordé' AND Date_deb <= CURDATE() AND Date_fin >= CURDATE() ORDER BY Date_deb LIMIT 1");
$requeteCongeActuel->execute([$id_employe]);
$congeActuel = $requeteCongeActuel->fetch();

// Requête pour obtenir les congés accordés mais pas encore commencés
$requeteCongeFutur = $pdo->prepare("SELECT * FROM ArretDeTravail WHERE id = ? AND statut = 'accordé' AND Date_deb > CURDATE() ORDER BY Date_deb");
$requeteCongeFutur->execute([$id_employe]);
$congeFutur = $requeteCongeFutur->fetchAll();

// Requête pour obtenir l'historique des congés (statut 'accordé' et Date_fin dans le passé)
$requeteHistoriqueConge = $pdo->prepare("SELECT * FROM ArretDeTravail WHERE id = ? AND statut = 'accordé' AND Date_fin < CURDATE() ORDER BY Date_deb");
$requeteHistoriqueConge->execute([$id_employe]);
$historiqueConges = $requeteHistoriqueConge->fetchAll();

$message = "";

if (!$congeActuel) {
    $message = "Pas de congé pour le moment.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mes congés</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <style>
        .card {
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
        .custom-card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease-in-out;
            background-color: #ffffff;
        }
        .custom-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }
        .custom-card-body {
            border-radius: 10px;
            padding: 20px;
            margin-top: 50px;
        }
        .custom-card-title {
            font-size: 1.25rem;
            font-weight: bold;
            color: #343a40;
        }
        .custom-card-text {
            font-size: 1rem;
            color: #6c757d;
        }
        .center-text {
            text-align: center;
        }
        .remaining-days {
            background-color: #ff4d4d;
            color: white;
            padding: 10px;
            border-radius: 5px;
            font-size: 1rem;
            margin-top: 10px;
        }
        .fa-icon {
            margin-right: 8px;
            color: #4682B4;
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
                    <a class="nav-link" href="demission.php">Démission</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link active" href="menuconge.php">Congés</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="historiqueintervention.php">Historique interventions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="tacheethoraire.php">Attribution tâche et horaire</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="compteEmploye.php"><i class="fas fa-user fa-lg ml-5"></i></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link ml-2" href="deconnexionClient.php">Déconnexion</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="container mt-5 pt-5">
    <div class="row justify-content-center">
        <div class="col-md-4 mb-4">
            <div class="custom-card text-center">
                <div class="custom-card-body">
                    <h5 class="custom-card-title"><i class="fas fa-umbrella-beach fa-icon"></i>Mon Congé actuel</h5>
                    <?php if ($congeActuel): ?>
                        <p class="custom-card-text"><strong><i class="fas fa-calendar-day fa-icon"></i>Date Début:</strong> <?php echo htmlspecialchars($congeActuel['Date_deb']); ?></p>
                        <p class="custom-card-text"><strong><i class="fas fa-calendar-day fa-icon"></i>Date Fin:</strong> <?php echo htmlspecialchars($congeActuel['Date_fin']); ?></p>
                        <p class="remaining-days"><strong><i class="far fa-hourglass fa-icon"></i>Jours restants:</strong> 
                            <span id="days-left"></span>
                        </p>
                    <?php else: ?>
                        <p class="custom-card-text">Pas de congé pour le moment.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <h2 class="center-text"><i class="fas fa-umbrella-beach fa-icon"></i>Congés à venir</h2>
    <div class="row">
        <?php if (count($congeFutur) > 0): ?>
            <?php foreach ($congeFutur as $conge): ?>
                <div class="col-md-4 mb-4">
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><i class="fas fa-umbrella-beach fa-icon"></i>Congé</h5>
                            <p class="card-text"><strong><i class="fas fa-calendar-day fa-icon"></i>Date Début:</strong> <?php echo htmlspecialchars($conge['Date_deb']); ?></p>
                            <p class="card-text"><strong><i class="fas fa-calendar-day fa-icon"></i>Date Fin:</strong> <?php echo htmlspecialchars($conge['Date_fin']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p class="custom-card-text">Pas de congé à venir.</p>
        <?php endif; ?>
    </div>
</div>

<div class="container mt-5">
    <h2 class="center-text"><i class="fas fa-umbrella-beach fa-icon"></i>Mon historique des Congés</h2>
    <div class="row">
        <?php foreach ($historiqueConges as $conge): ?>
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-umbrella-beach fa-icon"></i>Congé</h5>
                        <p class="card-text"><strong><i class="fas fa-calendar-day fa-icon"></i>Date Début:</strong> <?php echo htmlspecialchars($conge['Date_deb']); ?></p>
                        <p class="card-text"><strong><i class="fas fa-calendar-day fa-icon"></i>Date Fin:</strong> <?php echo htmlspecialchars($conge['Date_fin']); ?></p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<script>
    function calculateDaysLeft(endDate) {
        const today = new Date();
        const end = new Date(endDate);
        const diffTime = Math.abs(end - today);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        return diffDays;
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        <?php if ($congeActuel): ?>
            const endDate = '<?php echo $congeActuel['Date_fin']; ?>';
            const daysLeft = calculateDaysLeft(endDate);
            document.getElementById('days-left').innerText = daysLeft;
        <?php endif; ?>
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.amazonaws.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

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

        /* Style pour les icônes Font Awesome */
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
                    <p class="custom-card-text"><strong><i class="fas fa-calendar-day fa-icon"></i>Date Début:</strong> 2024-01-01</p>
                    <p class="custom-card-text"><strong><i class="fas fa-calendar-day fa-icon"></i>Date Fin:</strong> 2024-12-31</p>
                    <p class="remaining-days"><strong><i class="far fa-hourglass fa-icon"></i>Jours restants:</strong> 
                        <span id="days-left"></span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container mt-5">
    <h2 class="center-text"><i class="fas fa-umbrella-beach fa-icon"></i>Mon historique des Congés</h2>
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-umbrella-beach fa-icon"></i>Congé 1</h5>
                    <p class="card-text"><strong><i class="fas fa-calendar-day fa-icon"></i>Date Début:</strong> 2023-01-01</p>
                    <p class="card-text"><strong><i class="fas fa-calendar-day fa-icon"></i>Date Fin:</strong> 2023-12-31</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-umbrella-beach fa-icon"></i>Congé 2</h5>
                    <p class="card-text"><strong><i class="fas fa-calendar-day fa-icon"></i>Date Début:</strong> 2023-02-01</p>
                    <p class="card-text"><strong><i class="fas fa-calendar-day fa-icon"></i>Date Fin:</strong> 2023-11-30</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-umbrella-beach fa-icon"></i>Congé 3</h5>
                    <p class="card-text"><strong><i class="fas fa-calendar-day fa-icon"></i>Date Début:</strong> 2023-03-01</p>
                    <p class="card-text"><strong><i class="fas fa-calendar-day fa-icon"></i>Date Fin:</strong> 2023-10-31</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-umbrella-beach fa-icon"></i>Congé 4</h5>
                    <p class="card-text"><strong><i class="fas fa-calendar-day fa-icon"></i>Date Début:</strong> 2023-01-01</p>
                    <p class="card-text"><strong><i class="fas fa-calendar-day fa-icon"></i>Date Fin:</strong> 2023-12-31</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-umbrella-beach fa-icon"></i>Congé 5</h5>
                    <p class="card-text"><strong><i class="fas fa-calendar-day fa-icon"></i>Date Début:</strong> 2023-02-01</p>
                    <p class="card-text"><strong><i class="fas fa-calendar-day fa-icon"></i>Date Fin:</strong> 2023-11-30</p>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-4">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><i class="fas fa-umbrella-beach fa-icon"></i>Congé 6</h5>
                    <p class="card-text"><strong><i class="fas fa-calendar-day fa-icon"></i>Date Début:</strong> 2023-03-01</p>
                    <p class="card-text"><strong><i class="fas fa-calendar-day fa-icon"></i>Date Fin:</strong> 2023-10-31</p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Calculer les jours restants
    function calculateDaysLeft(endDate) {
        const today = new Date();
        const end = new Date(endDate);
        const diffTime = Math.abs(end - today);
        const diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
        return diffDays;
    }

    document.addEventListener('DOMContentLoaded', (event) => {
        const endDate = '2024-12-31'; // Date de fin du congé
        const daysLeft = calculateDaysLeft(endDate);
        document.getElementById('days-left').innerText = daysLeft;
    });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
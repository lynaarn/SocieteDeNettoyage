<?php
require_once("identifier.php");
// Connexion à la base de données
$mysqli = new mysqli("localhost", "root", "", "GestionSocieteNettoyage");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Récupérer les réservations non traitées
$nonTraiteesResult = $mysqli->query("
    SELECT r.codeR, r.date_reservation, r.date_prestation, r.heure_prestation, r.adresse_prestation, r.montant, r.etat, u.nom, u.prenom 
    FROM reservation r 
    JOIN Client c ON r.client_id = c.id 
    JOIN users u ON c.id = u.id 
    WHERE r.etat='pas encore traité'
");

// Récupérer les réservations traitées avec une date de prestation future
$traiteesResult = $mysqli->query("
    SELECT r.codeR, r.date_reservation, r.date_prestation, r.heure_prestation, r.adresse_prestation, r.montant, r.etat, u.nom, u.prenom 
    FROM reservation r 
    JOIN Client c ON r.client_id = c.id 
    JOIN users u ON c.id = u.id 
    WHERE r.etat='traité' AND r.date_prestation > CURDATE()
");

function isEmployeActif($mysqli, $intervention_id, $CodeS) {
    $query = "
        SELECT e.statut 
        FROM employe_intervention ei 
        JOIN employe e ON ei.employe_id = e.id 
        WHERE ei.intervention_id = ? AND ei.CodeS = ?
    ";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("ii", $intervention_id, $CodeS);
    $stmt->execute();
    $result = $stmt->get_result();
    $employe = $result->fetch_assoc();
    return $employe && $employe['statut'] === 'Actif';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Réservations</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <style>
        .reservation-section {
            margin-top: 20px;
        }
        .alert-warning {
            margin-bottom: 20px;
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
        <li class="nav-item active">
        <a class="nav-link" href="listeReservations.php">Interventions reservation</a>
        </li>
        <li class="nav-item ">
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

<div class="container mt-5">
  <div class="row">
    <div class="col">
      <h2 class="center-text">Les réservations</h2>
      <div class="photo2">
        <img src="images/68.jpg" />
      </div>
      
      <form method="get" action="listeReservations.php" class="form-inline mb-3 justify-content-end">
        <input class="form-control mr-sm-2" type="search" name="NomClient" placeholder="Nom du Client" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Rechercher</button>
      </form>

      <div class="reservation-section">
        <?php
        // Afficher les réservations non traitées
        if ($nonTraiteesResult->num_rows > 0) {
            echo "<h3>Réservations non traitées</h3>";
            echo "<table class='table table-hover'>
                    <thead class='couleurTableau'>
                      <tr>
                        <th scope='col'>Code</th>
                        <th scope='col'>Nom Client</th>
                        <th scope='col'>Date Réservation</th>
                        <th scope='col'>Date Prestation</th>
                        <th scope='col'>Heure Prestation</th>
                        <th scope='col'>Adresse</th>
                        <th scope='col'>Montant</th>
                        <th scope='col'>Etat</th>
                        <th scope='col'>Action</th>
                      </tr>
                    </thead>
                    <tbody>";
            while ($row = $nonTraiteesResult->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['codeR']}</td>
                        <td>{$row['nom']} {$row['prenom']}</td>
                        <td>{$row['date_reservation']}</td>
                        <td>{$row['date_prestation']}</td>
                        <td>{$row['heure_prestation']}</td>
                        <td>{$row['adresse_prestation']}</td>
                        <td>{$row['montant']}</td>
                        <td>{$row['etat']}</td>
                        <td><a href='preparerIntervention.php?codeR={$row['codeR']}' class='btn btn-primary'>Préparer</a></td>
                      </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p class='alert alert-warning'>Aucune réservation non traitée trouvée.</p>";
        }
        ?>
      </div>

      <div class="reservation-section">
        <?php
        // Afficher les réservations traitées avec une date de prestation future
        if ($traiteesResult->num_rows > 0) {
            echo "<h3>Réservations traitées avec date de prestation future</h3>";
            echo "<table class='table table-hover'>
                    <thead class='couleurTableau'>
                      <tr>
                        <th scope='col'>Code</th>
                        <th scope='col'>Nom Client</th>
                        <th scope='col'>Date Réservation</th>
                        <th scope='col'>Date Prestation</th>
                        <th scope='col'>Heure Prestation</th>
                        <th scope='col'>Adresse</th>
                        <th scope='col'>Montant</th>
                        <th scope='col'>Etat</th>
                        <th scope='col'>Action</th>
                      </tr>
                    </thead>
                    <tbody>";
            while ($row = $traiteesResult->fetch_assoc()) {
                $changeEmployeButton = '';
                // Vérifier si un employé assigné n'est plus actif
                $servicesQuery = "
                    SELECT ds.CodeS 
                    FROM detailResSER ds 
                    WHERE ds.codeR = {$row['codeR']}
                ";
                $servicesResult = $mysqli->query($servicesQuery);
                if ($servicesResult) {
                    while ($service = $servicesResult->fetch_assoc()) {
                        // Obtenir l'intervention_id pour la réservation
                        $interventionQuery = "
                            SELECT numI 
                            FROM intervention 
                            WHERE codeR = {$row['codeR']}
                        ";
                        $interventionResult = $mysqli->query($interventionQuery);
                        $intervention = $interventionResult->fetch_assoc();
                        if ($intervention && !isEmployeActif($mysqli, $intervention['numI'], $service['CodeS'])) {
                            $changeEmployeButton = "<a href='changerEmploye.php?intervention_id={$intervention['numI']}&CodeS={$service['CodeS']}' class='btn btn-warning'>Changer Employé</a>";
                            break;
                        }
                    }
                }

                echo "<tr>
                        <td>{$row['codeR']}</td>
                        <td>{$row['nom']} {$row['prenom']}</td>
                        <td>{$row['date_reservation']}</td>
                        <td>{$row['date_prestation']}</td>
                        <td>{$row['heure_prestation']}</td>
                        <td>{$row['adresse_prestation']}</td>
                        <td>{$row['montant']}</td>
                        <td>{$row['etat']}</td>
                        <td>$changeEmployeButton</td>
                      </tr>";
            }
            echo "</tbody></table>";
        } else {
            echo "<p class='alert alert-warning'>Aucune réservation traitée avec date de prestation future trouvée.</p>";
        }

        $mysqli->close();
        ?>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

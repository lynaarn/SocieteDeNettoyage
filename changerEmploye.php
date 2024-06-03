<?php
require_once("identifier.php");
require_once("connexiondb.php");

$mysqli = new mysqli("localhost", "root", "", "GestionSocieteNettoyage");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

$intervention_id = $_GET['intervention_id'] ?? null;
$CodeS = $_GET['CodeS'] ?? null;

if (!$intervention_id || !$CodeS) {
    die("Intervention ID or CodeS is missing");
}

// Récupérer les détails de l'intervention et du service
$interventionQuery = "
    SELECT i.numI, s.NomS, ei.employe_id, u.nom AS employe_nom, u.prenom AS employe_prenom 
    FROM intervention i 
    JOIN employe_intervention ei ON i.numI = ei.intervention_id 
    JOIN Service s ON ei.CodeS = s.CodeS 
    JOIN users u ON ei.employe_id = u.id
    WHERE i.numI = ? AND ei.CodeS = ?
";
$interventionStmt = $mysqli->prepare($interventionQuery);
$interventionStmt->bind_param("ii", $intervention_id, $CodeS);
$interventionStmt->execute();
$interventionResult = $interventionStmt->get_result();
$intervention = $interventionResult->fetch_assoc();

if (!$intervention) {
    die("No intervention found for the given ID and service");
}

// Récupérer la liste des employés actifs
$employesQuery = "
    SELECT e.id, u.nom, u.prenom 
    FROM employe e 
    JOIN users u ON e.id = u.id 
    WHERE e.statut = 'Actif'
";
$employes = $mysqli->query($employesQuery);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $new_employe_id = $_POST['employe_id'] ?? null;

    if ($new_employe_id) {
        $mysqli->begin_transaction();
        try {
            // Mettre à jour l'employé assigné à l'intervention
            $updateEmployeQuery = "
                UPDATE employe_intervention 
                SET employe_id = ? 
                WHERE intervention_id = ? AND CodeS = ?
            ";
            $updateEmployeStmt = $mysqli->prepare($updateEmployeQuery);
            $updateEmployeStmt->bind_param("iii", $new_employe_id, $intervention_id, $CodeS);
            $updateEmployeStmt->execute();

            $mysqli->commit();

            echo "Employé changé avec succès.";
            header("Location: listeReservations.php");
            exit();
        } catch (Exception $e) {
            $mysqli->rollback();
            echo "Erreur lors du changement d'employé : " . $e->getMessage();
        }
    } else {
        echo "Veuillez sélectionner un employé.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Changer Employé</title>
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
    <h1 class="mt-5">Changer Employé pour le Service</h1>
    <h2 class="mt-4">Détails de l'Intervention et du Service</h2>
    <div class="card mb-4">
        <div class="card-body">
            <p class="card-text"><strong>Intervention ID:</strong> <?= htmlspecialchars($intervention['numI']) ?></p>
            <p class="card-text"><strong>Service:</strong> <?= htmlspecialchars($intervention['NomS']) ?></p>
            <p class="card-text"><strong>Employé Actuel:</strong> <?= htmlspecialchars($intervention['employe_nom']) ?> <?= htmlspecialchars($intervention['employe_prenom']) ?></p>
        </div>
    </div>

    <form method="POST">
        <div class="form-group">
            <label for="employe_id">Sélectionner un nouvel employé:</label>
            <select class="form-control" name="employe_id" id="employe_id">
                <option value="">Sélectionner un employé</option>
                <?php while ($employe = $employes->fetch_assoc()) { ?>
                    <option value="<?= htmlspecialchars($employe['id']) ?>"><?= htmlspecialchars($employe['nom']) ?> <?= htmlspecialchars($employe['prenom']) ?></option>
                <?php } ?>
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Changer Employé</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>

<?php $mysqli->close(); ?>

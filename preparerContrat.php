<?php
require_once("identifier.php");
require_once("connexiondb.php");

$id_c = $_GET['id_c'];

if (!$id_c) {
    die("ID Contrat is missing");
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
    die("No contract found for ID = $id_c");
}

// Récupérer les services du contrat
$servicesQuery = $pdo->prepare("
    SELECT sc.*, s.NomS 
    FROM ServiceDansContrat sc 
    JOIN Service s ON sc.CodeS = s.CodeS 
    WHERE sc.id_c = ?
");
$servicesQuery->execute([$id_c]);
$services = $servicesQuery->fetchAll(PDO::FETCH_ASSOC);

// Récupérer la liste des employés
$employesQuery = $pdo->query("
    SELECT e.id, u.nom, u.prenom 
    FROM employe e 
    JOIN users u ON e.id = u.id
    WHERE e.statut = 'Actif'
");
$employes = $employesQuery->fetchAll(PDO::FETCH_ASSOC);

// Récupérer la liste des matériels
$materielsQuery = $pdo->query("SELECT codeM, nomM, type, quantite FROM materiel");
$materiels = $materielsQuery->fetchAll(PDO::FETCH_ASSOC);

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST['services'] as $service) {
        if (isset($service['CodeS']) && isset($service['employe_id']) && !empty($service['employe_id'])) {
            $CodeS = $service['CodeS'];
            $employe_id = $service['employe_id'];
            $materiels = $service['materiels'];

            // Insertion dans la table intervention
            $insertInterventionQuery = $pdo->prepare("
                INSERT INTO intervention (etat, employe_id, codeR) 
                VALUES ('pas encore faite', ?, ?)
            ");
            $insertInterventionQuery->execute([$employe_id, $id_c]);

            $intervention_id = $pdo->lastInsertId();

            // Assigner l'employé et ajouter la tâche
            $assignEmployeQuery = $pdo->prepare("
                INSERT INTO employe_intervention (intervention_id, employe_id, tache) 
                VALUES (?, ?, (SELECT NomS FROM Service WHERE CodeS = ?))
            ");
            $assignEmployeQuery->execute([$intervention_id, $employe_id, $CodeS]);

            // Assigner les matériels
            if (!empty($materiels)) {
                foreach ($materiels as $materiel) {
                    if (isset($materiel['codeM']) && isset($materiel['quantite_utilisee'])) {
                        $codeM = $materiel['codeM'];
                        $quantite_utilisee = $materiel['quantite_utilisee'];
                        $assignMaterielQuery = $pdo->prepare("
                            INSERT INTO materiel_intervention (intervention_id, materiel_id, quantite_utilisee) 
                            VALUES (?, ?, ?)
                        ");
                        $assignMaterielQuery->execute([$intervention_id, $codeM, $quantite_utilisee]);
                    }
                }
            }
        }
    }

    echo "Intervention préparée avec succès.";
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Préparer Contrat</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
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

<div class="container mt-5">
    <h1 class="mt-5">Préparer Contrat</h1>
    <h2 class="mt-4">Informations du Client</h2>
    <div class="card mb-4">
        <div class="card-body">
            <p class="card-text"><strong>Nom:</strong> <?= $contrat['nom'] ?> <?= $contrat['prenom'] ?></p>
            <p class="card-text"><strong>Email:</strong> <?= $contrat['email'] ?></p>
            <p class="card-text"><strong>Téléphone:</strong> <?= $contrat['telephone'] ?></p>
            <p class="card-text"><strong>Adresse:</strong> <?= $contrat['adresse'] ?></p>
        </div>
    </div>

    <h2>Informations du Contrat</h2>
    <div class="card mb-4">
        <div class="card-body">
            <p class="card-text"><strong>Date de Début:</strong> <?= $contrat['date_deb'] ?></p>
            <p class="card-text"><strong>Date de Fin:</strong> <?= $contrat['date_fin'] ?></p>
            <p class="card-text"><strong>Détails:</strong> <?= $contrat['detailc'] ?></p>
        </div>
    </div>

    <form method="POST">
        <h2>Services du Contrat</h2>
        <?php foreach ($services as $service): ?>
            <div class="card mb-4">
                <div class="card-body">
                    <h3>Service: <?= $service['NomS'] ?></h3>
                    <input type="hidden" name="services[<?= $service['CodeS'] ?>][CodeS]" value="<?= $service['CodeS'] ?>">
                    <p class="card-text"><strong>Détails:</strong> <?= $service['detailsSer'] ?></p>
                    <div class="form-group">
                        <label for="employe_id_<?= $service['CodeS'] ?>">Assigner un Employé:</label>
                        <select class="form-control" name="services[<?= $service['CodeS'] ?>][employe_id]" id="employe_id_<?= $service['CodeS'] ?>">
                            <option value="">Sélectionner un employé</option>
                            <?php foreach ($employes as $employe): ?>
                                <option value="<?= $employe['id'] ?>"><?= $employe['nom'] ?> <?= $employe['prenom'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <h4>Matériels Utilisés</h4>
                    <ul id="selectedMateriels_<?= $service['CodeS'] ?>" class="list-group mb-3">
                        <!-- Les matériels sélectionnés seront ajoutés ici -->
                    </ul>

                    <!-- Bouton pour ouvrir le modal -->
                    <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#materielModal_<?= $service['CodeS'] ?>">
                        Choisir Matériels
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="materielModal_<?= $service['CodeS'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Choisir Matériels pour <?= $service['NomS'] ?></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="form-group">
                                        <input type="text" class="form-control" id="searchMateriel_<?= $service['CodeS'] ?>" placeholder="Rechercher un matériel...">
                                    </div>
                                    <div class="form-group">
                                        <label for="filterType_<?= $service['CodeS'] ?>">Filtrer par type:</label>
                                        <select class="form-control" id="filterType_<?= $service['CodeS'] ?>">
                                            <option value="">Tous</option>
                                            <option value="électronique">Électronique</option>
                                            <option value="mécanique">Mécanique</option>
                                            <option value="nettoyage">Nettoyage</option>
                                            <option value="autre">Autre</option>
                                        </select>
                                    </div>
                                    <div id="materielList_<?= $service['CodeS'] ?>" class="materiel-list">
                                        <?php foreach ($materiels as $materiel): ?>
                                            <div class="form-check materiel-item" data-type="<?= $materiel['type'] ?>">
                                                <input class="form-check-input" type="checkbox" name="services[<?= $service['CodeS'] ?>][materiels][<?= $materiel['codeM'] ?>][codeM]" value="<?= $materiel['codeM'] ?>" id="materiel_<?= $materiel['codeM'] ?>_<?= $service['CodeS'] ?>" data-name="<?= $materiel['nomM'] ?>" data-quantite="<?= $materiel['quantite'] ?>">
                                                <label class="form-check-label" for="materiel_<?= $materiel['codeM'] ?>_<?= $service['CodeS'] ?>">
                                                    <?= $materiel['nomM'] ?> (Quantité disponible: <?= $materiel['quantite'] ?>)
                                                </label>
                                                <input type="number" class="form-control mt-2" name="services[<?= $service['CodeS'] ?>][materiels][<?= $materiel['codeM'] ?>][quantite_utilisee]" min="0" max="<?= $materiel['quantite'] ?>" value="0" data-materiel-id="<?= $materiel['codeM'] ?>">
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        <button type="submit" class="btn btn-primary">Préparer Intervention</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    <?php foreach ($services as $service): ?>
        $('#searchMateriel_<?= $service['CodeS'] ?>').on('keyup', function() {
            var value = $(this).val().toLowerCase();
            $('#materielList_<?= $service['CodeS'] ?> .materiel-item').filter(function() {
                $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1);
            });
        });

        $('#filterType_<?= $service['CodeS'] ?>').on('change', function() {
            var type = $(this).val();
            if (type === "") {
                $('#materielList_<?= $service['CodeS'] ?> .materiel-item').show();
            } else {
                $('#materielList_<?= $service['CodeS'] ?> .materiel-item').hide();
                $('#materielList_<?= $service['CodeS'] ?> .materiel-item[data-type="' + type + '"]').show();
            }
        });

        $('#materielModal_<?= $service['CodeS'] ?>').on('hide.bs.modal', function () {
            var selectedMateriels = [];
            $('#materielList_<?= $service['CodeS'] ?> .form-check-input:checked').each(function () {
                var name = $(this).data('name');
                var quantite = $(this).siblings('input[type="number"]').val();
                selectedMateriels.push('<li class="list-group-item">' + name + ' (Quantité: ' + quantite + ')</li>');
            });
            $('#selectedMateriels_<?= $service['CodeS'] ?>').html(selectedMateriels.join(''));
        });
    <?php endforeach; ?>
});
</script>
</body>
</html>

<?php
$pdo = null;
?>

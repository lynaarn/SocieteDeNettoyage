<?php
require_once("identifier.php");
require_once("connexiondb.php");

if ($_SESSION['user']['TypeCompte'] == 'Client') {
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Demande de Contrat</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/style.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .content {
            margin-top: 80px;
            margin-bottom: 80px;
        }
        .form-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            margin-top: 30px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .btn-group {
            display: flex;
            justify-content: space-between;
        }
        .btn-validate {
            background-color: #28a745;
            border-color: #28a745;
        }
        .btn-cancel {
            background-color: #dc3545;
            border-color: #dc3545;
        }
        textarea {
            height: 80px;
        }
        .form-group label {
            font-weight: bold;
            color: black;
        }
        .form-group label i {
            margin-right: 5px;
            color: #17a2b8;
        }
        .bg-light {
            background-color:#A8A8A8;
            padding: 7px;
            border-radius: 5%;
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
          <a class="nav-link " href="prestationsClient.php">Préstations</a>
        </li>
        <li class="nav-item active">
          <a class="nav-link" href="contratsClients.php">Contrats</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="commentairesClients.php">commentaires</a>
        </li>
        <li class="nav-item1  ">
        <a class="nav-link" href="compteClient.php"><i class="fas fa-user fa-lg"></i></a>

        </li>
        <li class="nav-item ">
        <a class="nav-link" href="deconnexionClient.php">Deconnexion</a>

        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container content">
    <div class="row justify-content-center">
        <div class="col-md-8"> 
            <div class="form-container">
                <h3 class="text-center txt mb-4"><span class="bg-light">Demande de Contrat</span></h3>
                <form action="demande_contrat.php" method="post">
                    <div class="form-group">
                        <label for="date_deb"><i class="fas fa-calendar-alt"></i>Date de début</label>
                        <input type="date" class="form-control" id="date_deb" name="date_deb" required>
                    </div>
                    <div class="form-group">
                        <label for="date_fin"><i class="fas fa-calendar-alt"></i>Date de fin</label>
                        <input type="date" class="form-control" id="date_fin" name="date_fin" required>
                    </div>
                    <div class="form-group">
                        <label for="detailc"><i class="fas fa-file-alt"></i>Détails du contrat</label>
                        <textarea class="form-control" id="detailc" name="detailc" rows="3" required></textarea>
                    </div>
                    <div class="form-group">
                        <label for="choix_services"><i class="fas fa-broom"></i>Services Choisis</label>
                        <div id="choix_services"></div>
                        <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#servicesModal">Choisir Services</button>
                    </div>
                    <button type="submit" class="btn btn-success">Valider</button>
                    <button type="button" class="btn btn-danger ml-2">Annuler</button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Modal pour choisir les services -->
<div class="modal fade" id="servicesModal" tabindex="-1" role="dialog" aria-labelledby="servicesModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="servicesModalLabel">Choisir Services</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="form-group">
          <input type="text" id="searchService" class="form-control" placeholder="Rechercher un service">
        </div>
        <div class="form-group">
          <select id="filterType" class="form-control">
            <option value="">Tous les types</option>
            <option value="Nettoyage Résidentiel">Nettoyage Résidentiel</option>
            <option value="Nettoyage Commercial">Nettoyage Commercial</option>
            <option value="Nettoyage Industriel">Nettoyage Industriel</option>
            <option value="Autres Services">Autres Services</option>
          </select>
        </div>
        <div id="servicesList">
          <?php
          $services = $pdo->query("SELECT * FROM Service")->fetchAll();
          foreach ($services as $service) {
              echo '<div class="form-check">';
              echo '<input class="form-check-input service-checkbox" type="checkbox" name="service_modal[]" id="service' . $service['CodeS'] . '" value="' . $service['CodeS'] . '" data-noms="' . $service['NomS'] . '" data-type="' . $service['TypeS'] . '">';
              echo '<label class="form-check-label" for="service' . $service['CodeS'] . '">' . $service['NomS'] . '</label>';
              echo '</div>';
          }
          ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary" id="addServices">Ajouter</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
$(document).ready(function() {
    var services = $('.service-checkbox');
    var choixServices = $('#choix_services');

    $('#addServices').on('click', function() {
        choixServices.empty();
        services.each(function() {
            if ($(this).is(':checked')) {
                var serviceId = $(this).val();
                var serviceNom = $(this).data('noms');
                var frequenceInput = '<input type="text" class="form-control d-inline w-25 ml-2" name="frequence[' + serviceId + ']" placeholder="Fréquence" required>';
                var detailsInput = '<textarea class="form-control d-inline w-50 ml-2" name="detailsSer[' + serviceId + ']" placeholder="Détails"></textarea>';
                var hiddenInput = '<input type="hidden" name="services[]" value="' + serviceId + '">';
                var serviceItem = '<div>' + serviceNom + frequenceInput + detailsInput + hiddenInput + '</div>';
                choixServices.append(serviceItem);
            }
        });
        $('#servicesModal').modal('hide');
    });

    $('#searchService').on('keyup', function() {
        var searchValue = $(this).val().toLowerCase();
        services.each(function() {
            var serviceLabel = $(this).next('label').text().toLowerCase();
            if (serviceLabel.includes(searchValue)) {
                $(this).closest('.form-check').show();
            } else {
                $(this).closest('.form-check').hide();
            }
        });
    });

    $('#filterType').on('change', function() {
        var filterValue = $(this).val().toLowerCase();
        services.each(function() {
            var serviceType = $(this).data('type').toLowerCase();
            if (filterValue === '' || serviceType === filterValue) {
                $(this).closest('.form-check').show();
            } else {
                $(this).closest('.form-check').hide();
            }
        });
    });
});
</script>
</body>
</html>
<?php } ?>

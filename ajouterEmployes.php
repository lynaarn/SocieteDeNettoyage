<?php
require_once("identifier.php");
require_once('connexiondb.php');

try {
    // Récupérer les compétences depuis la base de données
    $sql = "SELECT codeCp, nomCp FROM competence";
    $result = $pdo->query($sql);

    // Stocker les compétences dans un tableau
    $competences = $result->fetchAll(PDO::FETCH_ASSOC);
} catch (Exception $e) {
    echo 'Erreur : ' . $e->getMessage();
}
?>
<?php 
 if ($_SESSION['user']['TypeCompte']=='RRH') {?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Capiclean</title>
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
        <li class="nav-item ">
          <a class="nav-link active" href="employes.php">Employés</a>
        </li>
        
        <li class="nav-item">
          <a class="nav-link" href="congés.php">Congés</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="arrêtDeTravail.php">Arrêt de travail</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="demandeDemplois.php">demande D'emplois</a>
        </li>
        <li class="nav-item  ">
            <a class="nav-link" href="compteRHH.php"><i class="fas fa-user fa-lg ml-5"></i></a> 
        </li>
        <li class="nav-item ">
            <a class="nav-link ml-2" href="deconnexionClient.php">Deconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="container mt-5 custom-container">
    <div class="row justify-content-center">
    <div class="photo4"><img src="images/24.jpg" /></div>
        <div class="col-md-6">
            <h2 class="text-center mb-4 center-text2 ">Ajouter un employé</h2>
           
            <form action="insertEmploye.php" method="POST" id="ajouterEmployeForm">
                <div class="form-group">
                    <label for="nomEmploye" class="form-label">Nom employé</label>
                    <input type="text" class="form-control form-input" id="nomEmploye" name="nomEmploye" placeholder="Entrez le nom de l'employé" required>
                </div>
                <div class="form-group">
                    <label for="prenomEmploye" class="form-label">Prénom employé</label>
                    <input type="text" class="form-control form-input" id="prenomEmploye" name="prenomEmploye" placeholder="Entrez le prénom de l'employé" required>
                </div>
                <div class="form-group">
                    <label for="adresseEmploye" class="form-label">Adresse employé</label>
                    <input type="text" class="form-control form-input" id="adresseEmploye" name="adresseEmploye" placeholder="Entrez l'adresse de l'employé" required>
                </div>
                <div class="form-group">
                    <label for="telEmploye" class="form-label">Numéro de téléphone</label>
                    <input type="tel" class="form-control form-input" id="telEmploye" name="telEmploye" placeholder="Entrez le numéro de téléphone de l'employé" required>
                </div>
                <div class="form-group">
                    <label for="salaireEmploye" class="form-label">Salaire</label>
                    <input type="number" class="form-control form-input" id="salaireEmploye" name="salaireEmploye" placeholder="Entrez le salaire de l'employé" required>
                </div>
                <div class="form-group">
                    <label for="dateEmbaucheEmploye" class="form-label">Date d'embauche</label>
                    <input type="date" class="form-control form-input" id="dateEmbaucheEmploye" name="dateEmbaucheEmploye" required>
                </div>
                <div class="form-group">
                    <label for="emailEmploye" class="form-label">Email employé</label>
                    <input type="email" class="form-control form-input" id="emailEmploye" name="emailEmploye" placeholder="Entrez l'email de l'employé" required>
                </div>
                <div class="form-group">
                    <label for="loginEmploye" class="form-label">Login</label>
                    <input type="text" class="form-control form-input" id="loginEmploye" name="loginEmploye" placeholder="Entrez le login de l'employé" required>
                </div>
                <div class="form-group">
                    <label for="mdpEmploye" class="form-label">Mot de passe employé</label>
                    <input type="password" class="form-control form-input" id="mdpEmploye" name="mdpEmploye" placeholder="Entrez le mot de passe de l'employé" required>
                </div>
                <div class="form-group">
                    <label for="selectedCompetences" class="form-label">Compétences de l'employé</label>
                    <div id="selectedCompetences" class="mb-3" style="color: black;"></div>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#competencesModal">Sélectionner Compétences</button>
                    <input type="hidden" name="competences" id="competencesInput">
                </div>
                <button type="submit" class="btn btn-success btn-send">Envoyer</button>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="competencesModal" tabindex="-1" role="dialog" aria-labelledby="competencesModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="competencesModalLabel">Sélectionner Compétences</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php foreach ($competences as $competence): ?>
            <div class="form-check">
                <input class="form-check-input competence-checkbox" type="checkbox" id="competence<?= $competence['codeCp'] ?>" name="competence_checkbox[]" value="<?= $competence['codeCp'] ?>" data-name="<?= $competence['nomCp'] ?>">
                <label class="form-check-label" for="competence<?= $competence['codeCp'] ?>">
                    <?= $competence['nomCp'] ?>
                </label>
            </div>
        <?php endforeach; ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        <button type="button" class="btn btn-primary" id="saveCompetences">Sauvegarder</button>
      </div>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<script>
    document.getElementById('saveCompetences').addEventListener('click', function() {
        const selectedCompetencesContainer = document.getElementById('selectedCompetences');
        const competencesInput = document.getElementById('competencesInput');
        selectedCompetencesContainer.innerHTML = ''; // Clear previous selections
        competencesInput.value = ''; // Clear previous input value

        const checkboxes = document.querySelectorAll('.competence-checkbox');
        let selectedCompetences = [];

        checkboxes.forEach(checkbox => {
            if (checkbox.checked) {
                const div = document.createElement('div');
                div.className = 'm-1';
                div.textContent = checkbox.getAttribute('data-name');
                selectedCompetencesContainer.appendChild(div);
                selectedCompetences.push(checkbox.value);
            }
        });

        competencesInput.value = selectedCompetences.join(','); // Set the hidden input value
        $('#competencesModal').modal('hide');
    });
</script>
</body>
</html>
<?php } ?>
<?php
    require_once("identifier.php");
     require_once("connexiondb.php");

    $codes=isset($_GET['codes'])?$_GET['codes']:0;
    $requete="select * from Service where CodeS=$codes";

    $resultat = $pdo->query($requete);
   
    if ($Service = $resultat->fetch()) {
      $noms = $Service['NomS'];
      $types = strtolower($Service['TypeS']);
      $TarifHr = $Service['TarifHr'];
      $Duree = $Service['Duree'];
      $Description = $Service['Description'];
  } else {
      echo "Service not found.";
      exit();
  }
?>  
<?php 
 if ($_SESSION['user']['TypeCompte']=='Admin') {?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier service</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <link rel="stylesheet" href="css/style.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" />
    
  <style>
    .ok{
margin-bottom: 20px;
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
        <li class="nav-item active">
          <a class="nav-link" href="service.php">Services</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="clients.php">Clients</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="personnels.php">Personnels</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="menucontrat.php">Contrats</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="paiement.php">Paiements</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="commentaires.php">Commentaires</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="compteAdmin.php"><i class="fas fa-user fa-lg"></i></a> 
        </li>
        <li class="nav-item">
          <a class="nav-link" href="deconnexionClient.php">Deconnexion</a>
        </li>
      </ul>
    </div>
  </div>
</nav>


<div class="container mt-5 custom-container">
    <div class="row justify-content-center">
    <div class="photo4"><img src="images/img-6.png" /></div>
        <div class="col-md-6">
       
            <h2 class="text-center mb-4 center-text2 ">Modifier un Service</h2>
           
            <form method="post" action="updateService.php">
            <div class="form-group">
    <label for="codeService" class="form-label">Code Service: <?php echo $codes ?> </label>
    <input type="hidden" name="CodeS" value="<?php echo $codes ?>" class="form-control form-input" id="codeService" >
</div>
<div class="form-group">
    <label for="nomService" class="form-label">Nom Service</label>
    <input type="text" name="NomS" value="<?php echo $noms ?>" class="form-control form-input" id="nomService" >
</div>
<div class="form-group">
        <label for="typeService" class="form-label">Type Service</label>
        <select name="TypeS" id="TypeS" class="form-control mr-sm-2">
          <option value="nettoyage residentiel" <?php if($types=="nettoyage residentiel") echo "selected" ?>>Nettoyage résidentiel</option>
          <option value="nettoyage commercial" <?php if($types=="nettoyage commercial") echo "selected" ?>>Nettoyage commercial</option>
          <option value="nettoyage industriel"<?php if($types=="nettoyage industriel") echo "selected" ?> >Nettoyage industriel</option>
          <option value="autres services" <?php if($types=="autres services") echo "selected" ?> >Autres services</option>
        </select>
                </div>
<div class="form-group">
    <label for="tarif" class="form-label">TarifHeure (en dinars)</label>
    <input type="number" name="TarifHr" value="<?php echo $TarifHr ?>" class="form-control form-input" id="tarif"  min="0" step="1000">
</div>
<div class="form-group">
    <label for="duree" class="form-label">Durée (en heures)</label>
    <input type="number" name="Duree" value="<?php echo $Duree ?>" class="form-control form-input" id="duree"  min="0" max="24">
</div>
<div class="form-group">
    <label for="description" class="form-label">Description</label>
    <textarea name="Description" class="form-control form-input" id="description" rows="3"><?php echo htmlspecialchars($Description); ?></textarea>
</div>



                <button type="submit" class="btn btn-success btn-send ok">valider</button>
            </form>
        </div>
    </div>
</div>





<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
<?php } ?>
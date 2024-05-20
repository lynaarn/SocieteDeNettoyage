<?php
     require_once("connexiondb.php");
    

    $noms=isset($_POST['NomS'])?$_POST['NomS']:"";
    $types=isset($_POST['TypeS'])?$_POST['TypeS']:"";
    $TarifHr=isset($_POST['TarifHr'])?$_POST['TarifHr']:"";
    $Duree=isset($_POST['Duree'])?$_POST['Duree']:"";
    $Description=isset($_POST['Description'])?$_POST['Description']:"";

$requete="insert into Service(NomS,TypeS,TarifHr, Duree, Description) value(?,?,?,?,?)";
$params=array($noms,$types,$TarifHr,$Duree,$Description);
$resultat = $pdo->prepare($requete);
$resultat->execute($params);

header('location:service.php');

?>
<?php
require_once("identifier.php");
// Connexion à la base de données
$mysqli = new mysqli("localhost", "root", "", "GestionSocieteNettoyage");

if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Récupérer les réservations
$result = $mysqli->query("SELECT r.codeR, r.date_reservation, r.date_prestation, r.heure_prestation, r.adresse_prestation, r.montant, r.etat, u.nom, u.prenom 
                          FROM reservation r 
                          JOIN Client c ON r.client_id = c.id 
                          JOIN users u ON c.id = u.id");
                          
if ($result->num_rows > 0) {
    echo "<h1>Liste des Réservations</h1>";
    echo "<table border='1'>
            <tr>
                <th>Code</th>
                <th>Nom Client</th>
                <th>Date Réservation</th>
                <th>Date Prestation</th>
                <th>Heure Prestation</th>
                <th>Adresse</th>
                <th>Montant</th>
                <th>Etat</th>
                <th>Action</th>
            </tr>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['codeR']}</td>
                <td>{$row['nom']} {$row['prenom']}</td>
                <td>{$row['date_reservation']}</td>
                <td>{$row['date_prestation']}</td>
                <td>{$row['heure_prestation']}</td>
                <td>{$row['adresse_prestation']}</td>
                <td>{$row['montant']}</td>
                <td>{$row['etat']}</td>
                <td><a href='preparerIntervention.php?codeR={$row['codeR']}'>Préparer</a></td>
              </tr>";
    }
    echo "</table>";
} else {
    echo "Aucune réservation trouvée.";
}

$mysqli->close();
?>

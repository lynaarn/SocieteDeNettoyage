<?php
session_start(); // Démarrer une session

require_once("connexiondb.php");

// Récupérer les données du formulaire
$login = isset($_POST['login']) ? $_POST['login'] : "";
$pwd = isset($_POST['pwd']) ? $_POST['pwd'] : "";

if (!empty($login) && !empty($pwd)) {
    // Préparer la requête pour récupérer l'utilisateur par login
    $requete = "SELECT * FROM users WHERE login = :login";
    $stmt = $pdo->prepare($requete);
    $stmt->bindParam(':login', $login);
    $stmt->execute();

    // Récupérer l'utilisateur
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Comparer le mot de passe soumis avec le mot de passe haché
        if (($pwd == $user['password'])) {
            // Mot de passe correct
            // Vérifier l'état du compte
            if ($user['etat'] == 1) {
                // Stocker les informations de l'utilisateur dans la session
                $_SESSION['user'] = $user;
                
                // Rediriger vers la page appropriée en fonction du type de compte
                switch ($user['TypeCompte']) {
                    case 'Client':
                        header("Location: compteClient.php");
                        break;
                    case 'Employe':
                        header("Location: menuEmploye.php");
                        break;
                    case 'Admin':
                        header("Location: menuAdmin.php");
                        break;
                    case 'RRH':
                        header("Location: menuRHH.php");
                        break;
                    case 'GI':
                        header("Location: menuGI.php");
                        break;
                    default:
                        // Si le type de compte n'est pas reconnu, rediriger vers une page par défaut
                        header("Location: index.php");
                        break;
                }
                exit();
            } else {
                // Compte désactivé
                $_SESSION['error'] = "Votre compte est désactivé. Veuillez contacter l'administrateur.";
            }
        } else {
            // Mot de passe incorrect
            $_SESSION['error'] = "Nom d'utilisateur ou mot de passe incorrect.";
        }
    } else {
        // Aucun utilisateur trouvé avec ce login
        $_SESSION['error'] = "Nom d'utilisateur ou mot de passe incorrect.";
    }
} else {
    $_SESSION['error'] = "Veuillez remplir tous les champs.";
}

// Rediriger vers la page de connexion en cas d'erreur
header("Location: authentification.php");
exit();
?>

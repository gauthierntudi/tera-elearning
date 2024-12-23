<?php
// Démarrer la session
session_start();

// Vérifier si l'utilisateur est connecté
if (isset($_SESSION['user_id'])) {
    // Détruire toutes les variables de session
    session_unset();

    // Détruire la session
    session_destroy();

    // Rediriger l'utilisateur vers la page d'accueil ou de connexion
    header("Location: login"); // Changez "login.php" par l'URL de votre page de connexion
    exit();
} else {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page d'accueil ou de connexion
    header("Location: login");
    exit();
}
?>
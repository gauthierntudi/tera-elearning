<?php
// Fichier de configuration pour les informations de connexion
require_once 'params.php'; // Inclure les informations de connexion

// Détecter l'environnement
$environnement = ($_SERVER['SERVER_ADDR'] === '::1' || $_SERVER['SERVER_ADDR'] === '127.0.0.1') ? 'local' : 'en_ligne';

try {
    // Connexion à la base de données en fonction de l'environnement
    if ($environnement === 'local') {
        // Connexion en local
        $bdd = new PDO("mysql:host=$serveurLocal;dbname=$dbNameLocal", $utilisateurLocal, $motDePasseLocal, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        ]);
    } else {
        // Connexion en ligne
        $bdd = new PDO("mysql:host=$serveurEnLigne;dbname=$dbNameEnLigne", $utilisateurEnLigne, $motDePasseEnLigne, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
        ]);
    }

    // Configuration commune
    $bdd->exec("SET time_zone='+00:00'");
} catch (PDOException $e) {
    // Afficher un message d'erreur si la connexion échoue
    die('Erreur de connexion : ' . $e->getMessage());
}
?>
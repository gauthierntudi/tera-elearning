<?php
// Fichier de configuration pour les informations de connexion
require_once 'params.php'; // Inclure les informations de connexion

// Détecter l'environnement
$environnement = ($_SERVER['SERVER_ADDR'] === '::1' || $_SERVER['SERVER_ADDR'] === '127.0.0.1') ? 'local' : 'en_ligne';

try {
    $bdd = new PDO("mysql:host=$serveur;dbname=$dbName", $user, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8",
    ]);

    // Configuration commune
    $bdd->exec("SET time_zone='+00:00'");
} catch (PDOException $e) {
    // Afficher un message d'erreur si la connexion échoue
    die('Erreur de connexion : ' . $e->getMessage());
}
?>
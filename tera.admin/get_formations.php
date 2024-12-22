<?php
error_reporting(E_ALL); 
ini_set('display_errors', 1);
require_once '../php/db_connect.php'; // Connexion à la base de données

// Récupérer les formations disponibles
$stmt = $bdd->query("SELECT id, title FROM Formations");
$formations = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Vérification si des formations sont retournées
if ($formations) {
    echo json_encode(['formations' => $formations]);
} else {
    echo json_encode(['formations' => []]); // Si aucune formation, retour d'un tableau vide
}
?>
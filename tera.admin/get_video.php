<?php
require_once '../php/db_connect.php'; // Connexion à la base de données

// Récupérer les vidéos disponibles
$stmt = $bdd->query("SELECT id, title FROM Videos");
$videos = $stmt->fetchAll(PDO::FETCH_ASSOC);

if ($videos) {
    echo json_encode(['videos' => $videos]);
} else {
    echo json_encode(['videos' => []]); // Retourner un tableau vide si aucune vidéo n'est trouvée
}
?>

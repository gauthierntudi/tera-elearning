<?php
require_once '../php/db_connect.php'; // Connexion à la base de données

if (isset($_GET['id'])) {
    $video_id = $_GET['id'];
    $stmt = $bdd->prepare("SELECT * FROM Videos WHERE id = :id");
    $stmt->execute([':id' => $video_id]);
    $video = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($video) {
        echo json_encode(['success' => true, 'video' => $video]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Vidéo introuvable']);
    }
}
?>
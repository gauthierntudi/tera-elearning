<?php
require_once './php/db_connect.php';  // Connexion à la base de données

// Récupérer les paramètres de pagination
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$limit = isset($_GET['limit']) ? (int)$_GET['limit'] : 4;  // Nombre de vidéos par page
$offset = ($page - 1) * $limit;

// Récupérer les vidéos avec pagination et leur nombre de leçons
$stmt = $bdd->prepare("
    SELECT v.id, v.title, v.thumbnail_path, v.duration, v.formation_id, f.title as formation_title
    FROM Videos v
    JOIN Formations f ON v.formation_id = f.id
    LIMIT :limit OFFSET :offset");
$stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
$stmt->bindParam(':offset', $offset, PDO::PARAM_INT);
$stmt->execute();
$videos = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Récupérer le nombre total de vidéos pour la pagination
$stmtTotal = $bdd->query("SELECT COUNT(id) FROM Videos");
$totalVideos = $stmtTotal->fetchColumn();

// Récupérer le nombre de vidéos par formation
$videosByFormation = [];
foreach ($videos as $video) {
    $formationId = $video['formation_id'];
    if (!isset($videosByFormation[$formationId])) {
        $videosByFormation[$formationId] = 0;
    }
    $videosByFormation[$formationId]++;
}

// Retourner les vidéos et le nombre total de vidéos
echo json_encode([
    'videos' => $videos,
    'totalVideos' => $totalVideos,
    'videosByFormation' => $videosByFormation
]);
?>
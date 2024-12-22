<?php
require_once '../php/db_connect.php'; // Connexion à la base de données

if (isset($_GET['id'])) {
    $formation_id = $_GET['id'];
    $stmt = $bdd->prepare("SELECT * FROM Formations WHERE id = :id");
    $stmt->execute([':id' => $formation_id]);
    $formation = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($formation) {
        echo json_encode(['success' => true, 'formation' => $formation]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Formation introuvable']);
    }
}
?>

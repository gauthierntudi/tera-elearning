<?php
require_once 'auth.php';  // Vérification que l'utilisateur est un administrateur
require_once '../php/db_connect.php';  // Connexion à la base de données

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $title = $_POST['title'];
    $description = $_POST['description'];
    $category = $_POST['category'] ?? null;  // Catégorie facultative

    // Validation des données
    if (empty($title) || empty($description)) {
        echo json_encode(['success' => false, 'message' => 'Le titre et la description sont obligatoires.']);
        exit;
    }

    try {
        // Insertion dans la base de données
        $stmt = $bdd->prepare("INSERT INTO Formations (title, description, category) VALUES (:title, :description, :category)");
        $stmt->execute([
            ':title' => $title,
            ':description' => $description,
            ':category' => $category
        ]);

        echo json_encode([
            'success' => true, 
            'message' => 'La formation a été ajoutée avec succès.',
            'id' => $bdd->lastInsertId()
        ]);
    } catch (Exception $e) {
        echo json_encode(['success' => false, 'message' => 'Erreur lors de l\'ajout de la formation: ' . $e->getMessage()]);
    }
}
?>

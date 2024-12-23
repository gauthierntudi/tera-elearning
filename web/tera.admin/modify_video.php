<?php
require_once '../php/db_connect.php';  // Connexion à la base de données

// Vérification de la méthode POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Vérification des champs obligatoires
    if (empty($_POST['title']) || empty($_POST['description']) || empty($_POST['duration']) || empty($_POST['formation_id']) || empty($_POST['video_path'])) {
        echo json_encode(['success' => false, 'message' => 'Tous les champs doivent être remplis.']);
        exit;
    }

    // Assignation des variables
    $title = $_POST['title'];
    $description = $_POST['description'];
    $duration = $_POST['duration'];
    $formation_id = $_POST['formation_id'];
    $videoPath = $_POST['video_path']; // Le chemin de la vidéo (fournir par l'admin)

    // Définir le chemin d'enregistrement pour la vignette dans le dossier "uploads/thumbnails/"
    $uploadDir = '../uploads/thumbnails/'; // Dossier où la vignette sera enregistrée (relatif à l'emplacement de ce script PHP)
    
    // Vérification si un fichier de vignette est téléchargé
    if (isset($_FILES['thumbnail']) && $_FILES['thumbnail']['error'] === UPLOAD_ERR_OK) {
        $thumbnail = $_FILES['thumbnail'];

        // Générer un nom unique pour la vignette en utilisant uniqid()
        $newThumbnailName = 'TERA_' . uniqid() . '.' . pathinfo($thumbnail['name'], PATHINFO_EXTENSION);
        $thumbnailPath = $uploadDir . $newThumbnailName; // Chemin complet pour enregistrer la vignette
        
        // Déplacer le fichier téléchargé dans le répertoire de destination
        if (!move_uploaded_file($thumbnail['tmp_name'], $thumbnailPath)) {
            echo json_encode(['success' => false, 'message' => 'Erreur lors du téléchargement de la vignette.']);
            exit;
        }

        // Compresser la vignette (réduire la taille de l'image)
        if (!compressImage($thumbnailPath)) {
            echo json_encode(['success' => false, 'message' => 'Erreur lors de la compression de la vignette.']);
            exit;
        }

        // Mettre à jour la vidéo dans la base de données
        try {
            $stmt = $bdd->prepare("UPDATE Videos SET title = :title, description = :description, duration = :duration, video_path = :video_path, thumbnail_path = :thumbnail_path, formation_id = :formation_id WHERE id = :id");

            // Exécution de la requête avec les paramètres
            $stmt->execute([
                ':title' => $title,
                ':description' => $description,
                ':duration' => $duration,
                ':video_path' => $videoPath,
                ':thumbnail_path' => 'uploads/thumbnails/' . $newThumbnailName,  // Enregistrer le chemin relatif de la vignette
                ':formation_id' => $formation_id,
                ':id' => $_POST['video_id'] // ID de la vidéo à mettre à jour
            ]);

            echo json_encode(["success" => true, "message" => "Vidéo modifiée avec succès!"]);
        } catch (Exception $e) {
            echo json_encode(["success" => false, "message" => "Erreur lors de l'insertion dans la base de données: " . $e->getMessage()]);
        }
    } else {
        echo json_encode(['success' => false, 'message' => 'Aucune vignette téléchargée ou erreur avec le fichier de vignette.']);
    }
}

/**
 * Fonction pour compresser une image (vignette)
 */
function compressImage($imagePath) {
    // Charger l'image
    $imageInfo = getimagesize($imagePath);
    $imageType = $imageInfo['mime'];
    
    if ($imageType == 'image/jpeg') {
        $image = imagecreatefromjpeg($imagePath);
    } elseif ($imageType == 'image/png') {
        $image = imagecreatefrompng($imagePath);
    } elseif ($imageType == 'image/gif') {
        $image = imagecreatefromgif($imagePath);
    } else {
        return false; // Format non supporté
    }
    
    // Compresser l'image (réduire la qualité à 80% pour jpeg)
    return imagejpeg($image, $imagePath, 75); // 75 est la qualité de compression
}
?>

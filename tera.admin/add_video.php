<?php 
require_once '../php/db_connect.php';  // Connexion à la base de données
require_once 'auth.php';  // Vérification de l'accès administrateur

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

    // Vérification si la vidéo existe déjà dans la base de données
    $stmt = $bdd->prepare("SELECT id FROM Videos WHERE video_path = :video_path");
    $stmt->execute([':video_path' => $videoPath]);

    if ($stmt->rowCount() > 0) {
        echo json_encode(['success' => false, 'message' => 'Cette vidéo existe déjà dans la base de données.']);
        exit;
    }

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

        // Ajouter la vidéo dans la base de données
        try {
            $stmt = $bdd->prepare("INSERT INTO Videos (formation_id, title, description, duration, video_path, thumbnail_path) 
            VALUES (:formation_id, :title, :description, :duration, :video_path, :thumbnail_path)");
            
            // Exécution de la requête avec les paramètres
            $stmt->execute([
                ':formation_id' => $formation_id,
                ':title' => $title,
                ':description' => $description,
                ':duration' => $duration,
                ':video_path' => $videoPath,
                ':thumbnail_path' => 'uploads/thumbnails/' . $newThumbnailName // Enregistrer uniquement le chemin relatif dans la base de données
            ]);

            // Retourner une réponse JSON de succès
            echo json_encode(["success" => true, "message" => "Vidéo ajoutée avec succès!"]);
        } catch (Exception $e) {
            // Retourner une réponse JSON avec l'erreur
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
<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Assurez-vous que l'en-tête JSON est défini
header('Content-Type: application/json');

// Assurez-vous que la session est démarrée
session_start(); 

// Inclure la fonction configs 
require_once 'configs.php';

// Gérer toutes les soumissions POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Récupérer les données JSON envoyées par le client
    $input = file_get_contents('php://input');
    $data = json_decode($input, true); // Décoder le JSON

    // Vérifier l'action demandée
    if (isset($_POST['action'])) {


        // Si l'action est de login
        if (isset($_POST['action']) && $_POST['action'] === 'login') {
            // Vérification de l'email
            if (empty($_POST['mail'])) {
                echo json_encode(['success' => false, 'message' => 'L\'email est requis.']);
                exit;
            }

            $email = $_POST['mail'];

            // Vérifier si l'email existe dans la base de données
            $stmt = $bdd->prepare("SELECT id, nom FROM Abonnes WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch();

            if ($user) {
                $_SESSION['email'] = $email; // Stocke l'email en session
                // Envoi de l'OTP à l'email
                $result = sendOTP($email, $user['nom']);
                
                // Une seule réponse JSON est renvoyée
                echo json_encode(['success' => true, 'message' => 'OTP envoyé avec succès']);
            } else {
                echo json_encode(['success' => false, 'message' => 'Email non trouvé.']);
            }
        } else {
            echo json_encode(['success' => false, 'message' => 'Action inconnue.']);
        }


    }
}
?>
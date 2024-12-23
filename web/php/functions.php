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
    
    // Renvoi de l'OTP (si nécessaire)
    if ($_POST['action'] === 'resend_otp') {
            // Logique pour renvoyer l'OTP si nécessaire
            if (!isset($_SESSION['email'])) {
                echo json_encode(['success' => false, 'message' => 'L\'email n\'est pas disponible dans la session.']);
                exit;
            }

            $email = $_SESSION['email'];
            $stmt = $bdd->prepare("SELECT * FROM Abonnes WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch();

            if ($user) {
                // Renvoi de l'OTP
                $result = sendOTP($email, $user['nom']);
                echo json_encode($result);
            } else {
                echo json_encode(['success' => false, 'message' => 'L\'utilisateur n\'a pas été trouvé.']);
            }

        }else {
        echo json_encode(['success' => false, 'message' => 'Action inconnue.']);
    }

  }
}
?>
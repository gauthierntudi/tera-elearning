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


    // Vérification de l'OTP
    if (isset($_POST['action']) && $_POST['action'] === 'verify_otp') {
        // Vérification si l'email est en session
        if (!isset($_SESSION['email'])) {
            echo json_encode(['success' => false, 'message' => 'L\'email n\'est pas disponible dans la session.']);
            exit;
        }

        $otp = strtoupper($_POST['otp']);
        $email = $_SESSION['email'];  // Utilisation de l'email en session

        // Vérifier si l'OTP existe pour cet email dans la base de données
        try {
            $stmt = $bdd->prepare("SELECT * FROM Abonnes WHERE email = :email");
            $stmt->execute([':email' => $email]);
            $user = $stmt->fetch();

            if ($user && $user['otp_code'] === $otp && strtotime($user['otp_expiry']) > time()) {
                // Mettre à jour le statut de l'abonné dans la base de données
                $stmt = $bdd->prepare("UPDATE Abonnes SET status = 'active' WHERE email = :email");
                $stmt->execute([':email' => $email]);

                // Démarrer la session avec les informations de l'utilisateur
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['nom'] = $user['nom'];
                $_SESSION['postnom'] = $user['postnom'];
                $_SESSION['telephone'] = $user['telephone'];
                $_SESSION['role'] = $user['role'];
                $_SESSION['isAdmin'] = $user['role'] == 'admin';

                // Envoi de l'email de confirmation
                //$confirmationResult = sendConfirmationEmail($email);
                echo json_encode(['success' => true, 'message' => 'Connexion réussie.', 'role'=> $user['role']]); // Renvoie une réponse JSON avec succès
            } else {
                echo json_encode(['success' => false, 'message' => 'Le code OTP est incorrect ou expiré.']);
            }
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'message' => 'Erreur lors de la vérification de l\'OTP.']);
        }
        
        } else {
                echo json_encode(['success' => false, 'message' => 'Action inconnue.']);
            }


        }
}
?>
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


        // Inscription
        if ($_POST['action'] === 'register') {
            // Vérification des champs nécessaires
            if (empty($_POST['mail']) || empty($_POST['nom']) || empty($_POST['postnom']) || empty($_POST['tel']) || empty($_POST['title'])) {
                echo json_encode(['success' => false, 'message' => 'Tous les champs sont requis. Veuillez les vérifier']);
                exit;
            }

            $email = $_POST['mail'];
            $name = $_POST['nom'] . ' ' . $_POST['postnom'];  // Concatenation du nom et postnom
            $telephone = $_POST['tel'];
            $adresse_physique = $_POST['title'];

            // Vérification de la validité de l'email
            if (!isValidEmail($email)) {
                echo json_encode(['success' => false, 'message' => 'L\'email fourni est invalide.']);
                exit;
            }

            // Vérification de la validité du numéro de téléphone
            if (!isValidPhoneNumber($telephone)) {
                echo json_encode(['success' => false, 'message' => 'Le numéro de téléphone doit comporter exactement 10 chiffres.']);
                exit;
            }

            // Vérification de la longueur du nom et du postnom
            if (strlen($_POST['nom']) > 20 || strlen($_POST['postnom']) > 20) {
                echo json_encode(['success' => false, 'message' => 'Le nom et le postnom doivent comporter au maximum 20 caractères.']);
                exit;
            }

            // Vérifier si l'email existe déjà
            $stmt = $bdd->prepare("SELECT id FROM Abonnes WHERE email = :email");
            $stmt->execute([':email' => $email]);

            if ($stmt->rowCount() > 0) {
                echo json_encode(['success' => false, 'message' => 'Cet email est déjà utilisé.']);
                exit;
            }

            // Insérer l'utilisateur dans la base de données avec son état 'pending'
            try {
                $stmt = $bdd->prepare("INSERT INTO Abonnes (nom, postnom, email, telephone, adresse_physique, status) 
                VALUES (:nom, :postnom, :email, :telephone, :adresse_physique, 'pending')");
                $stmt->execute([
                    ':nom' => $_POST['nom'],
                    ':postnom' => $_POST['postnom'],
                    ':email' => $email,
                    ':telephone' => $telephone,
                    ':adresse_physique' => $adresse_physique
                ]);

                // Stocker l'email en session pour la validation ultérieure
                $_SESSION['email'] = $email;

            } catch (Exception $e) {
                echo json_encode(['success' => false, 'message' => 'Erreur d\'inscription.']);
                exit;
            }

            // Envoi de l'OTP
            $result = sendOTP($email, $name);
            echo json_encode($result);
            exit;
        } else {
            echo json_encode(['success' => false, 'message' => 'Action inconnue.']);
        }


    }
}
?>
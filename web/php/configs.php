<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

// Connexion à la base de données
require_once 'db_connect.php';  // Inclure la connexion à la base de données

// Fonction pour générer un OTP aléatoire (longueur 5)
function generateOTP($length = 5) {
    $digits = '123456789';  // Chiffres
    $letters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';  // Lettres majuscules

    // Initialisation de l'OTP
    $otp = '';

    // Ajouter 3 chiffres aléatoires
    for ($i = 0; $i < 3; $i++) {
        $otp .= $digits[rand(0, strlen($digits) - 1)];
    }

    // Ajouter 2 lettres aléatoires
    for ($i = 0; $i < 2; $i++) {
        $otp .= $letters[rand(0, strlen($letters) - 1)];
    }

    // Mélanger l'OTP pour que les chiffres et les lettres soient mélangés
    return str_shuffle($otp);
}

// Fonction de validation de l'email
function isValidEmail($email) {
    return filter_var($email, FILTER_VALIDATE_EMAIL);
}

// Fonction de validation du numéro de téléphone (10 chiffres)
function isValidPhoneNumber($phone) {
    return preg_match('/^\d{10}$/', $phone);
}

// Fonction pour configurer PHPMailer
function configureMailer() {
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->Host = 'mail.ntudi.tech';  // Remplacer par ton serveur SMTP
    $mail->SMTPAuth = true;
    $mail->Username = 'noreply@ntudi.tech'; // Ton email
    $mail->Password = 'dOVU)p6hzLM@';   // Ton mot de passe
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;
    return $mail;
}

// Fonction pour charger un template HTML
function loadEmailTemplate($templateFile, $placeholders = []) {
    $template = file_get_contents($templateFile); // Charger le fichier HTML
    foreach ($placeholders as $placeholder => $value) {
        $template = str_replace('{{' . $placeholder . '}}', $value, $template);  // Remplacer les placeholders
    }
    return $template;
}

// Fonction d'envoi de l'OTP
function sendOTP($email, $name) {
    global $bdd;

    // Générer un OTP aléatoire
    $otp = generateOTP(5);
    $expiry = date('Y-m-d H:i:s', strtotime('+15 minutes'));

    // Enregistrer l'OTP et son expiration dans la base de données
    try {
        $stmt = $bdd->prepare("UPDATE Abonnes SET otp_code = :otp, otp_expiry = :expiry WHERE email = :email");
        $stmt->execute([':otp' => $otp, ':expiry' => $expiry, ':email' => $email]);
    } catch (Exception $e) {
        return ['success' => false, 'message' => 'Erreur de mise à jour dans la base de données.'];
    }

    // Charger le template HTML de l'email
    $emailTemplate = loadEmailTemplate('../email_template_otp.html', ['otp' => $otp, 'name' => $name]);

    // Envoi de l'OTP par email avec PHPMailer
    $mail = configureMailer();

    try {
        $mail->setFrom('noreply@ntudi.tech', 'Tera e-learning');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Votre code OTP';
        $mail->Body    = $emailTemplate;
        $mail->send();

        return ['success' => true, 'message' => 'Un OTP a été envoyé à votre email.'];
    } catch (Exception $e) {
        return ['success' => false, 'message' => "Erreur d'envoi de l'OTP. Erreur: {$mail->ErrorInfo}"];
    }
}

// Fonction pour envoyer l'email de confirmation
function sendConfirmationEmail($email) {
    global $bdd;

    $emailTemplate = loadEmailTemplate('../email_template_confirmation.html', []);
    $mail = configureMailer();

    try {
        $mail->setFrom('noreply@ntudi.tech', 'Tera e-learning');
        $mail->addAddress($email);
        $mail->isHTML(true);
        $mail->Subject = 'Confirmation de votre inscription';
        $mail->Body    = $emailTemplate;
        $mail->send();

        return ['success' => true, 'message' => 'Confirmation d\'inscription envoyée à votre email.'];
    } catch (Exception $e) {
        return ['success' => false, 'message' => "Erreur d'envoi du mail de confirmation. Erreur: {$mail->ErrorInfo}"];
    }
}

?>
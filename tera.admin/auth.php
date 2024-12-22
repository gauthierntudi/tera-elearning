<?php
session_start();

if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    // Rediriger l'utilisateur s'il n'est pas administrateur
    header("Location: ../login");
    exit;
}
?>
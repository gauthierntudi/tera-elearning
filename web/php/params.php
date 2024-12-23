<?php

$serveur;
$user = 'root';
$password = 'root';
$dbName = 'elearning';

if($_SERVER['SERVER_ADDR'] === '::1' || $_SERVER['SERVER_ADDR'] === '127.0.0.1'){
	$serveur = 'localhost';
}
else if(isset($_SERVER['DOCKER'])){
	$serveur = 'database';
}
else{
	$serveur = '91.234.194.248';
	$user = 'rs2494166_tpay_user';
	$password = 'uTXKGxGA56Q)';
	$dbName = 'rs2494166_tpay.db';
}
/* Informations de connexion pour l'environnement local
$serveurLocal = 'localhost:8889';
$utilisateurLocal = 'root';
$motDePasseLocal = 'root';
$dbNameLocal = 'elearning';

// Informations de connexion pour l'environnement en ligne
$serveurEnLigne = '91.234.194.248';
$utilisateurEnLigne = 'rs2494166_tpay_user';
$dbNameEnLigne = 'rs2494166_tpay.db';
$motDePasseEnLigne = 'uTXKGxGA56Q)';*/
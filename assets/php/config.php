<?php

$servername = "localhost"; // remplacer par le nom de votre serveur MySQL
$email = "admin@sneakme.fr"; // remplacer par votre nom d'utilisateur MySQL
$password = "admin"; // remplacer par votre mot de passe MySQL
$dbname = "sneakme_database"; // remplacer par le nom de votre base de données

// Connexion à MySQL
$connexion = new mysqli($servername, $email, $password, $dbname);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Connection failed: " . $connexion->connect_error);
}

$requete = "SELECT * FROM chatbot_keywords";
$resultat = $connexion->query($requete);

?> 
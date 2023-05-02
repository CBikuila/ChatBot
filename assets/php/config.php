<?php

$servername = "localhost"; // remplacer par le nom de votre serveur MySQL
$username = "votre_nom_d'utilisateur"; // remplacer par votre nom d'utilisateur MySQL
$password = "votre_mot_de_passe"; // remplacer par votre mot de passe MySQL
$dbname = "nom_de_votre_base_de_donnees"; // remplacer par le nom de votre base de données

// Connexion à MySQL
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";
?>
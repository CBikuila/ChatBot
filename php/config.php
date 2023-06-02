<?php
$servername = "localhost"; // remplacer par le nom du serveur SQL
$email = "root"; // remplacer par l'adresse mail de l'utilisateur
$password = "root"; // remplacer par le mot de passe de l'utilisateur
$dbname = "sneakme_database"; // remplacer par le nom de la base de données SQL

// Connexion à la base de données SQL "sneakme_database"
$connexion = new mysqli("localhost", "root", "root", "sneakme_database");

// Vérification de la connexion à la base de données SQL "sneakme_database"
if ($connexion->connect_error) {
    die("Connection failed: " . $connexion->connect_error);
}
?> 
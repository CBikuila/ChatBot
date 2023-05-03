<?php

$servername = "localhost"; // remplacer par le nom de votre serveur MySQL
$username = "root"; // remplacer par votre nom d'utilisateur MySQL
$password = "root"; // remplacer par votre mot de passe MySQL
$dbname = "sneakme_database"; // remplacer par le nom de votre base de données

// Connexion à MySQL
$connexion = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Connection failed: " . $connexion->connect_error);
}

echo "Connected successfully";

// Insérer des lignes de couleurs différentes de sneakers en SQL
$insertion1 = "INSERT INTO chatbot_keywords (nom, couleur) VALUES ('Air Max 90', 'Bleu')";
$insertion2 = "INSERT INTO chatbot_keywords (nom, couleur) VALUES ('Jordan 1', 'Rouge')";
$insertion3 = "INSERT INTO chatbot_keywords (nom, couleur) VALUES ('Yeezy Boost 350', 'Noir')";

if ($connexion->query($insertion1) === TRUE && $connexion->query($insertion2) === TRUE && $connexion->query($insertion3) === TRUE) {
    echo "Les lignes de couleurs différentes de sneakers ont été insérées avec succès";
} else {
    echo "Erreur lors de l'insertion des lignes: " . $connexion->error;
}

// Afficher le tableau de données SQL
$requete = "SELECT * FROM chatbot_keywords";
$resultat = $connexion->query($requete);

?> 
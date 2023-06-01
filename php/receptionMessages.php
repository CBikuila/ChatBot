<?php
require("config.php");
error_reporting(E_ERROR);

// Connexion à MySQL
$connexion = new mysqli("localhost", "root", "root", "sneakme_database");

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Échec de la connexion à la base de données: " . $connexion->connect_error);
}

// Récupérer le message du chatbot
$message = $_POST['message'];

// Échapper les caractères spéciaux pour éviter les injections SQL
$message = $conn->real_escape_string($message);

// Insérer le message dans la table "messages"
$sql = "INSERT INTO messages (content) VALUES ('$message')";

if ($conn->query($sql) === TRUE) {
  echo "Message stocké avec succès.";
} else {
  echo "Erreur lors de l'enregistrement du message: " . $conn->error;
}

// Fermer la connexion à la base de données
$conn->close();
?>
<?php

$servername = "localhost"; // remplacer par le nom de votre serveur MySQL
$email = "root"; // remplacer par votre nom d'utilisateur MySQL
$password = "root"; // remplacer par votre mot de passe MySQL
$dbname = "sneakme_database"; // remplacer par le nom de votre base de données

// Connexion à MySQL
$connexion = new mysqli($servername, $email, $password, $dbname);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Connection failed: " . $connexion->connect_error);
}

// Récupérer le mot-clé saisi par l'utilisateur
$motCle = $_POST['motscles'];

// Requête pour récupérer la question associée au mot-clé
$requete = "SELECT motscles FROM question";
$resultat = $connexion->query($requete);

if ($resultat->num_rows > 0) {
    // Récupérer la première ligne de résultat
    $ligne = $resultat->fetch_assoc();
    $questionAssociee = $ligne['question'];

    // Renvoyer la question au format JSON
    $reponse = array('question' => $questionAssociee);
    echo json_encode($reponse);
} else {
    // Si aucun résultat n'est trouvé, renvoyer une réponse vide au format JSON
    $reponse = array('question' => '');
    echo json_encode($reponse);
}


?> 
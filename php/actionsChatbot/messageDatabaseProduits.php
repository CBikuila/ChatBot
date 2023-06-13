<?php
include('../config.php');
error_reporting(E_ERROR);

// Nettoyage du post
$_POST = json_decode(array_keys($_POST)[0], 1);
// Récupérer le mot-clé saisi par l'utilisateur
$commande = $_POST['produits'];

// Requête pour récupérer la question associée au mot-clé
$requete = "SELECT marque_sneakers, modele_sneakers, couleur_sneakers, taille_sneakers, genre_sneakers, prix_sneakers FROM produits WHERE produits = \"$commande\""; 
$resultat = $conn->query($requete);

if ($resultat->num_rows > 0) {
    // Récupérer la première ligne de résultat
    $ligne = $resultat->fetch_assoc();
    $questionAssociee = $ligne['produits'];

    // Renvoyer la listes des produits au format JSON
    $reponse = array('question' => $questionAssociee);
    echo json_encode($reponse);
} else {
    // Si aucun résultat n'est trouvé, renvoyer une réponse vide au format JSON
    $reponse = array('question' => '');
    echo json_encode($reponse);
}

$conn->close();
<?php
include('../config.php');
error_reporting(E_ERROR);

// Nettoyage du post
$_POST = json_decode(array_keys($_POST)[0], 1);
// Récupérer le mot-clé saisi par l'utilisateur
$commande = $_POST['panier'];

// Requête pour récupérer la question associée au mot-clé
$requete = "SELECT panier_id, produit_id FROM panier"; 
$resultat = $conn->query($requete);

if ($resultat->num_rows > 0) {
    // Récupérer la première ligne de résultat
    $produits = $resultat->fetch_all(MYSQLI_ASSOC);
    // Renvoyer la listes des produits au format JSON
    
    echo json_encode($produits);

} else {

    // Si aucun résultat n'est trouvé, renvoyer une réponse vide au format JSON
    $reponse = array('question' => '');
    echo json_encode($reponse);
}

$conn->close();
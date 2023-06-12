<?php
include('../config.php');
error_reporting(E_ERROR);

// Nettoyage du post
$_POST = json_decode(array_keys($_POST)[0], 1);
// Récupérer le mot-clé saisi par l'utilisateur
$motCle = $_POST['motscles'];

// Requête pour récupérer la question associée au mot-clé
$requete = "SELECT question FROM motscles WHERE mots_cles = \"$motCle\""; 
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

$connexion->close();
?>
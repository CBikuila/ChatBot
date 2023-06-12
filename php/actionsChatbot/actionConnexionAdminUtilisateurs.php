<?php
include('../config.php');
error_reporting(E_ERROR);

// Nettoyage du post
$_POST = json_decode(array_keys($_POST)[0], 1);

// Récupérer le mot-clé saisi par l'utilisateur
$utilisateurs = $_POST['utilisateurs_connexion'];

// Requête pour récupérer la question associée au mot-clé
$requete = "SELECT prenom_utilisateur, mot_de_passe_utilisateur FROM utilisateurs_connexion WHERE utilisateurs_connexion = \"$utilisateurs\""; 
$resultat = $conn->query($requete);

$conn->close();

if ($resultat->num_rows > 0) {
    // Récupérer la première ligne de résultat
    $ligne = $resultat->fetch_assoc();
    $connexionUtilisateurs = $ligne['prenom_utilisateur'] && ['mot_de_passe_utilisateur'];

    // Renvoyer la question au format JSON
    $reponse = array('prenom_utilisateur' => $connexionUtilisateurs);
    echo json_encode($reponse);
} else {
    // Si aucun résultat n'est trouvé, renvoyer une réponse vide au format JSON
    $reponse = array('mot_de_passe_utilisateur' => '');
    echo json_encode($reponse);
}

?>
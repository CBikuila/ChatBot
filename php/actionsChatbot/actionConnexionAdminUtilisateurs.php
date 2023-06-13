<?php
include('../config.php');
error_reporting(E_ERROR);

// Nettoyage du post
$donnees = json_decode(file_get_contents('php://input'), true);

if(isset($donnees['email']) && isset($donnees['motDePasse'])) {
    // Récupérer le mot-clé saisi par l'utilisateur
        // Récupérer le mot-clé saisi par l'utilisateur
        $email = $donnees['email'];
        $motDePasse = $donnees['motDePasse'];
    
        // Requête pour récupérer la question associée au mot-clé
        $requete = "SELECT prenom_utilisateur, mot_de_passe_utilisateur FROM utilisateurs_connexion WHERE prenom_utilisateur = '$email' AND mot_de_passe_utilisateur = '$motDePasse' "; 
        $resultat = $conn->query($requete);
    var_dump($resultat);
    if ($resultat->num_rows > 0) {
        // Récupérer la première ligne de résultat
        $ligne = $resultat->fetch_assoc();
        $connexionUtilisateurs = $ligne['prenom_utilisateur'] && $ligne['mot_de_passe_utilisateur'];

        // Renvoyer la question au format JSON
        $prenom = array('prenom_utilisateur' => $connexionUtilisateurs);
        echo json_encode($prenom);
    } else {
        // Si aucun résultat n'est trouvé, renvoyer une réponse vide au format JSON
        $motDePasse = array('mot_de_passe_utilisateur' => '');
        echo json_encode($motDePasse);
    }
} else {
    // Si la clé 'utilisateurs_connexion' n'est pas présente dans les données reçues
    $erreur = array('erreur' => 'Clé utilisateurs_connexion non trouvée');
    echo json_encode($erreur);
}

$conn->close();
?>

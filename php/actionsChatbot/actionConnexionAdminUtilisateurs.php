<?php
include('../config.php');
error_reporting(E_ERROR);

// Nettoyage du post
$donnees = json_decode(file_get_contents('php://input'), true);

if (isset($donnees['email']) && isset($donnees['motDePasse'])) {
    // Récupérer les valeurs saisies par l'utilisateur
    $email = $donnees['email'];
    $motDePasse = $donnees['motDePasse'];

    // Requête pour récupérer les données de la base de données
    $requete = "SELECT prenom_utilisateur, mot_de_passe_utilisateur FROM sneakme_database.utilisateurs_connexion WHERE prenom_utilisateur = '$email' AND mot_de_passe_utilisateur = '$motDePasse'";
    $resultat = $conn->query($requete);
    if ($resultat->num_rows > 0) {
        // Récupérer la première ligne de résultat
        $ligne = $resultat->fetch_assoc();
        $connexionUtilisateurs = array(
            'prenom_utilisateur' => $ligne['prenom_utilisateur'],
            'mot_de_passe_utilisateur' => $ligne['mot_de_passe_utilisateur']
        );

        // Renvoyer les données au format JSON
        echo 'connexion_reussie';
        //json_encode($connexionUtilisateurs);
    } else {
        // Si aucun résultat n'est trouvé, renvoyer une réponse vide au format JSON
        $response = array('erreur' => 'Aucune correspondance trouvée dans la base de données');
        echo json_encode($response);
    }
} else {
    // Si les clés 'email' et 'motDePasse' ne sont pas présentes dans les données reçues
    $erreur = array('erreur' => 'Clés email et motDePasse non trouvées');
    echo json_encode($erreur);
}

$conn->close();

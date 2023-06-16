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
        // Insérer les données de l'utilisateur dans la base de données
        $requeteInscription = "INSERT INTO utilisateurs_connexion (prenom_utilisateur, mot_de_passe_utilisateur) VALUES ('$email', '$motDePasse')";
        if ($conn->query($requeteInscription) === TRUE) {
            // Renvoyer la réponse "inscription_reussie" si l'inscription est réussie
            echo 'inscription_reussie';
        } else{
            // Si une erreur se produit lors de l'insertion dans la base de données
            $response = array('erreur' => 'Erreur lors de l\'inscription. Veuillez réessayer.');
            echo json_encode($response);
        }
    }
} else {
    // Si les clés 'email' et 'motDePasse' ne sont pas présentes dans les données reçues
    $erreur = array('erreur' => 'Clés email et motDePasse non trouvées');
    echo json_encode($erreur);
}

$conn->close();


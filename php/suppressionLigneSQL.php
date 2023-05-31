<?php
require("config.php");

// Vérifier si l'ID est passé en paramètre
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Supprimer la ligne de la table "motscles"
    $requeteKeywords = "DELETE FROM `motscles` WHERE `motscles_id` = $id";
    $resultatKeywords = $connexion->query($requeteKeywords);
    
    // Supprimer la ligne de la table "produits"
    $requeteProduits = "DELETE FROM `produits` WHERE `produits_id` = $id";
    $resultatProduits = $connexion->query($requeteProduits);
    
    // Supprimer la ligne de la table "utilisateurs"
    $requeteUtilisateurs = "DELETE FROM `utilisateurs` WHERE `utilisateurs_id` = $id";
    $resultatUtilisateurs = $connexion->query($requeteUtilisateurs);
    
    // Vérifier si au moins une ligne a été supprimée
    if ($resultatKeywords || $resultatProduits || $resultatUtilisateurs) {
        // Redirection vers la page appropriée
        if ($resultatProduits) {
            header('Location: ./dashboard/produits.php');
        } elseif ($resultatKeywords) {
            header('Location: ./dashboard/mots_cles.php');
        } elseif ($resultatUtilisateurs) {
            header('Location: ./dashboard/utilisateurs.php');
        }
    } else {
        echo "<p>Impossible de supprimer la ligne</p>";
    }
} else {
    echo "<p>Paramètre ID manquant</p>";
}
?>

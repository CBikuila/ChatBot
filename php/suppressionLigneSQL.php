<?php
require("config.php");

// Vérifier si l'ID est passé en paramètre
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Supprimer la ligne de la table "motscles"
    $requeteMotsCles = $conn->prepare("DELETE FROM `motscles` WHERE `motscles_id` = ?");
    $requeteMotsCles->bind_param("i", $id);
    $resultatMotsCles = $requeteMotsCles->execute();

    // Supprimer la ligne de la table "produits"
    $requeteProduits = $conn->prepare("DELETE FROM `produits` WHERE `produits_id` = ?");
    $requeteProduits->bind_param("i", $id);
    $resultatProduits = $requeteProduits->execute();

    // Supprimer la ligne de la table "utilisateurs"
    $requeteUtilisateurs = $conn->prepare("DELETE FROM `utilisateurs` WHERE `utilisateurs_id` = ?");
    $requeteUtilisateurs->bind_param("i", $id);
    $resultatUtilisateurs = $requeteUtilisateurs->execute();

    // Vérifier quelle table a été affectée
    if ($resultatMotsCles) {
        // Redirection vers la page "motscles"
        header("Location: motsCles.php");
        exit();
    } elseif ($resultatProduits) {
        // Redirection vers la page "produits"
        header("Location: produits.php");
        exit();
    } elseif ($resultatUtilisateurs) {
        // Redirection vers la page "utilisateurs"
        header("Location: dashboard.php");
        exit();
    } else {
        // Redirection vers une page d'erreur
        header("Location: erreur.php");
        exit();
    }
}

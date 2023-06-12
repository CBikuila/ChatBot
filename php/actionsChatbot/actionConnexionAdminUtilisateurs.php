<?php
include('../config.php');
error_reporting(E_ERROR);

// Récupérer le mot-clé saisi par l'utilisateur
$utilisateurs = $_POST['utilisateurs'];



// Requête pour récupérer la question associée au mot-clé
$requete = "SELECT prenom_utilisateur, mot_de_passe_utilisateur FROM utilisateurs WHERE mots_cles = \"$motCle\""; 
$resultat = $connexion->query($requete);
var_dump();



// Vérifier si les données sont présentes dans $_POST
/*if ($_POST["prenom_utilisateur"]["mot_de_passe_utilisateur"]) {
    var_dump($_POST);
    $prenom = $_POST["prenom_utilisateur"];
    $motDePasse = $_POST["mot_de_passe_utilisateur"];
    $sql = "SELECT prenom_utilisateur, mot_de_passe_utilisateur
            FROM utilisateurs 
            WHERE prenom_utilisateur = '$prenom' 
            AND mot_de_passe_utilisateur = '$motDePasse'";
    $result = $connexion->query($sql);

    if ($result->num_rows > 0) {
        
        // Les identifiants de connexion sont corrects
        header('Location: ../php/dashboard/dashboard.php');
        exit();
    } else {
        echo "Identifiants de connexion incorrects.";
    }
}
?>
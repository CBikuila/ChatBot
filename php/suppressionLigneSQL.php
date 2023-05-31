<?php 

require("config.php");

//Récupération des id des mots-clés de la table SQL "motscles"
if (isset($_GET['id'])) {

//Suppression de la ligne de la table SQL "motscles"
$requete = "DELETE FROM `motscles` WHERE `motscles`.`motscles_id` = ".$_GET['id'];
$requete = "DELETE FROM `produits` WHERE `produits`.`produits_id` = ".$_GET['id'];
$requete = "DELETE FROM `utilisateurs` WHERE `utilisateurs`.`utilisateurs_id` = ".$_GET['id'];
$resultat = $connexion->query($requete);

//Redirection vers la page "Mot-clés & réponses" du dashboard
header('location: ./dashboard/mots_cles.php');

} else {
        echo "<p>Impossible de supprimer la ligne</p>" . $connexion->error;
       }
?>
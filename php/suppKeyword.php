<?php 

require("../mots_cles.php");

if (isset($_GET['motscles'])) {

//Récupération des données de la table SQL "motscles"
$id = $_GET['motscles'];

//Suppression de la ligne de la table SQL "motscles"
$requete = "DELETE FROM `motscles` WHERE `motscles`.`motscles_id` = 20";
$resultat = $connexion->query($requete);

//Redirection vers la page "Mot-clés & réponses" du dashboard
header('location: ./dashboard/mots_cles.php');

} else {
    echo "<p>Impossible de supprimer la ligne</p>" . $connexion->error;
}
?>
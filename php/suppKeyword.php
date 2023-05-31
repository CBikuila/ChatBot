<?php 

require("config.php");

if (isset($_GET['id'])) {

//Récupération des données de la table SQL "motscles"
//$id = $_GET['motscles'];

//Suppression de la ligne de la table SQL "motscles"
$requete = "DELETE FROM `motscles` WHERE `motscles`.`motscles_id` = ".$_GET['id'];
$resultat = $connexion->query($requete);

//Redirection vers la page "Mot-clés & réponses" du dashboard
header('location: ./dashboard/mots_cles.php');

} else {
    echo "<p>Impossible de supprimer la ligne</p>" . $connexion->error;
}
?>


<?php ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL); //A DEGAGER APRES AVOIR TERMINE?>
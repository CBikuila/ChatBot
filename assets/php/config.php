<?php

$servername = "localhost"; // remplacer par le nom de votre serveur MySQL
$email = "email"; // remplacer par votre nom d'utilisateur MySQL
$password = "password"; // remplacer par votre mot de passe MySQL
$dbname = "sneakme_database"; // remplacer par le nom de votre base de données

// Connexion à MySQL
$connexion = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Connection failed: " . $connexion->connect_error);
}

echo "Connected successfully";

// Afficher le tableau de données SQL

$requete = "SELECT * FROM /*nomdedatabaseamettre*/ WHERE /*amettre*/" ;
$resultat = $connexion->query($requete);

print "<table class='table table-striped'><tr><th></th><th>Nom</th><th>Climat</th></tr><th>Diamètre</th><th>Gravité</th><th>Période orbitale</th><th>Population</th><th>Rotation</th><th>Surface</th><th>Terrain</th>";

while($ligne = $resultat->fetch_assoc()) {
    echo "<tr>
    <td>".$ligne["name"]."</td>
    <td>".$ligne["climate"]."</td>
    <td>".$ligne["diameter"]."</td>
    <td>".$ligne["gravity"]."</td>
    <td>".$ligne["orbital_period"]."</td>
    <td>".$ligne["population"]."</td>
    <td>".$ligne["rotation_period"]."</td>
    <td>".$ligne["surface_water"]."</td>
    <td>".$ligne["terrain"]."</td>
  </tr>";
}

$requete = "SELECT planets.planet_id = 426 FROM planets LEFT JOIN people ON planets WHERE planets.homeworld = https://swapi.dev/api/planets/1/" ;
$resultat = $connexion->query($requete);

print "<table class='table table-striped'><tr><th></th><th>Nom</th><th>Date de naissance</th></tr><th>Couleur des yeux</th><th>Sexe</th><th>Couleur de cheveux</th><th>Taille</th><th>Poids</th><th>Couleur de peau</th>";

while($ligne = $resultat->fetch_assoc()) {
    echo "<tr>
    <td>".$ligne["name"]."</td>
    <td>".$ligne["birth_year"]."</td>
    <td>".$ligne["eye_color"]."</td>
    <td>".$ligne["gender"]."</td>
    <td>".$ligne["hair_color"]."</td>
    <td>".$ligne["height"]."</td>
    <td>".$ligne["mass"]."</td>
    <td>".$ligne["skin_color"]."</td>
  </tr>";
}

?>
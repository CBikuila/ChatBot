<?php
    require('../config.php');
    include('nav.php');
    $conn = new mysqli("localhost", "root", "root", "sneakme_database");

// Vérification de la connexion
if ($conn->connect_error) {
die("Erreur de connexion à la base de données : " . $conn->connect_error);
}


// Exécution de la requête SQL
$sql = "SELECT statuts_commandes_etapes FROM statuts_commandes";
$result = $conn->query($sql);

// Générer la liste déroulante avec les statuts de commande
echo '
<!DOCTYPE html>
<html>
<head>
    <title>Menu déroulant statut de commande</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
    <div class="btn-group">
        <button class="btn btn-secondary btn-lg dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Statut de commande</button>
        <ul class="dropdown-menu">
';

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        echo '<li><a class="dropdown-item" href="#">' . $row["statuts_commandes_etapes"] . '</a></li>';
    }
} else {
    echo '<li><a class="dropdown-item" href="#">Aucun statut de commande trouvé</a></li>';
}

echo '
        </ul>
    </div>
</body>
</html>
';

// Fermer la connexion à la base de données
$conn->close();
?>
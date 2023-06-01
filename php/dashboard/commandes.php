<!DOCTYPE html>
<html>
<head>
    <title>Tableau affichant les données SQL pour les commandes sur le dashboard</title>
</head>
<body>
    <table>
            <tr>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Couleur</th>
                <th>Taille</th>
                <th>Prix</th>
            </tr> 
        <?php
            // Connexion à la base de données
            $conn = new mysqli("localhost", "root", "root", "sneakme_database");

            // Vérification de la connexion
            if ($conn->connect_error) {
            die("Erreur de connexion à la base de données : " . $conn->connect_error);
            }

            // Exécution de la requête SQL
            $sql = "SELECT produits_id, marque_sneakers, modele_sneakers, couleur_sneakers, taille_sneakers, prix_sneakers FROM produits";
            $result = $conn->query($sql);

            // Vérification des résultats de la requête
            if ($result->num_rows > 0) {
            // Affichage des lignes
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["marque_sneakers"] . "</td>";
                echo "<td>" . $row["modele_sneakers"] . "</td>";
                echo "<td>" . $row["couleur_sneakers"] . "</td>";
                echo "<td>" . $row["taille_sneakers"] . "</td>";
                echo "<td>" . $row["prix_sneakers"] . "</td>";
                echo '<td><a class="btn btn-danger btn-xs" href="../suppressionLigneSQL.php?id=' . $row["produits_id"] . ' ">Supprimer</a></td>';
                echo "</tr>";
            }
            } else {
            echo "<tr><td colspan='3'>Aucuns produits ajoutés</td></tr>";
            }

            // Fermeture de la connexion à la base de données
            $conn->close();
        ?>
    </table>
</body>
</html>
 
<?php //CONNEXION A LA TABLE SQL "statuts_commandes_etapes" ET AFFICHAGE SON FORME DE MENU DEROULANT
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

require('footer.php');
?>
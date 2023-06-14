<?php
include('nav.php');
include('footer.php');
include('../config.php');
error_reporting(E_ERROR);
?>

<table>
    <tr>
        <th>Image</th>
        <th>Marque</th>
        <th>Modèle</th>
        <th>Couleur</th>
        <th>Taille</th>
        <th>Genre</th>
        <th>Prix</th>
        <th>Statut de commande</th>
    </tr>  

<?php
// Exécution de la requête SQL pour récupérer les produits et leur statut de commande
$sql = "SELECT p.produits_id, p.photo_sneakers, p.marque_sneakers, p.modele_sneakers, p.couleur_sneakers, p.taille_sneakers, p.genre_sneakers, p.prix_sneakers, s.statuts_commandes_etapes
        FROM produits p
        LEFT JOIN statuts_commandes s ON p.produits_id = s.commandes_id";

$result = $conn->query($sql);

// Vérification de la réussite de la requête
if (!$result) { //le "!" signifie : "si je n'arrive pas à ouvrir le fichier, alors..."
    die("Erreur lors de l'exécution de la requête : " . $conn->error);
}

// Vérification des résultats de la requête
if ($result->num_rows > 0) {
    // Affichage des lignes
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["photo_sneakers"] . "</td>";
        echo "<td>" . $row["marque_sneakers"] . "</td>";
        echo "<td>" . $row["modele_sneakers"] . "</td>";
        echo "<td>" . $row["couleur_sneakers"] . "</td>";
        echo "<td>" . $row["taille_sneakers"] . "</td>";
        echo "<td>" . $row["genre_sneakers"] . "</td>";
        echo "<td>" . $row["prix_sneakers"] . "</td>";
        echo "<td>";
        echo "<select>";

        // Requête SQL pour récupérer les statuts de commande
        $statuts_sql = "SELECT statuts_commandes_etapes FROM statuts_commandes";
        $statuts_result = $conn->query($statuts_sql);

        // Vérification de la réussite de la requête
        if ($statuts_result->num_rows > 0) {
            while ($statut_row = $statuts_result->fetch_assoc()) {
                echo "<option>" . $statut_row["statuts_commandes_etapes"] . "</option>";
            }
        } else {
            echo "<option>Aucun statut de commande trouvé</option>";
        }

        echo "</select>";
        echo "</td>";
        echo '<td><a class="btn btn-danger btn-xs" href="../suppressionLigneSQL.php?id=' . $row["produits_id"] . ' ">Supprimer</a></td>';
        echo "</tr>";
    }
} else {
    echo "<tr><td>Aucun produit ajouté</td></tr>";
}

// Fermeture de la connexion à la base de données
$conn->close();
?>
</table>
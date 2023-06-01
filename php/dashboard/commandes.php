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
            <th>Statut de commande</th>
        </tr> 

        <?php
        require('../config.php');
        include('nav.php');

        // Connexion à la base de données
        $conn = new mysqli("localhost", "root", "root", "sneakme_database");

        // Vérification de la connexion
        if ($conn->connect_error) {
            die("Erreur de connexion à la base de données : " . $conn->connect_error);
        }

        // Exécution de la requête SQL pour récupérer les produits et leur statut de commande
        $sql = "SELECT p.produits_id, p.marque_sneakers, p.modele_sneakers, p.couleur_sneakers, p.taille_sneakers, p.prix_sneakers, s.statuts_commandes_etapes
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
                echo "<td>" . $row["marque_sneakers"] . "</td>";
                echo "<td>" . $row["modele_sneakers"] . "</td>";
                echo "<td>" . $row["couleur_sneakers"] . "</td>";
                echo "<td>" . $row["taille_sneakers"] . "</td>";
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
                echo "</tr>";
            }
        } else {
            echo "<tr><td>Aucun produit ajouté</td></tr>";
        }

        // Fermeture de la connexion à la base de données
        $conn->close();
        ?>

    </table>
</body>
</html>
 
<?php
    require('footer.php');
?>

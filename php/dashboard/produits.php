<?php
require('nav.php');
error_reporting(E_ERROR | E_PARSE);
?>

<div class='dashboard'>  
    <div class='dashboard-app'>
        <div class='dashboard-content'>
            <div class='container'>
                <div class='card'>
                </div>
                <div class='card'>
                    <div class='card-header'>
                        <h2>Produits</h2>
                    </div>
                    <div class='card-body'>
                        <p>Ajoutez un produit dans la base de données</p>
                    </div>
                    <form action="produits.php" method="post">
                        <div class="mb-3">
                            <label for="mots_cles" class="form-label">Marque :</label>
                            <input type="text" class="form-control" name="marque_sneakers" id="marque_sneakers" aria-describedby="textHelp">
                        </div>
                        <div class="mb-3">
                            <label for="reponse" class="form-label">Modèle :</label>
                            <input type="text" class="form-control" name="modele_sneakers" id="modele_sneakers">
                        </div>
                        <div class="mb-3">
                            <label for="reponse" class="form-label">Couleur :</label>
                            <input type="text" class="form-control" name="couleur_sneakers" id="couleur_sneakers">
                        </div>
                        <div class="mb-3">
                            <label for="reponse" class="form-label">Taille :</label>
                            <input type="text" class="form-control" name="taille_sneakers" id="taille_sneakers">
                        </div>
                        <div class="mb-3">
                            <label for="reponse" class="form-label">Prix :</label>
                            <input type="text" class="form-control" name="prix_sneakers" id="prix_sneakers">
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </form>
                
                <?php
                    require('../config.php');
                    // require('../php/ajoutKeyword.php');

                //Ajout des mots-clés via database SQL "sneakme_database.sql"    
                
                $marquesSneakers = $_POST["marque_sneakers"];
                $modelesSneakers = $_POST["modele_sneakers"];
                $couleursSneakers = $_POST["couleur_sneakers"];
                $taillesSneakers = $_POST["taille_sneakers"];
                $prixSneakers = $_POST["prix_sneakers"] . " &euro;";

                if ($marquesSneakers && $modelesSneakers && $couleursSneakers && $taillesSneakers && $prixSneakers){
                    $insertion = "INSERT INTO produits (marque_sneakers, modele_sneakers, couleur_sneakers, taille_sneakers, prix_sneakers) VALUES ('$marquesSneakers', '$modelesSneakers', '$couleursSneakers', '$taillesSneakers', '$prixSneakers')";

                    $result =$connexion->query($insertion);
                    if ($result == true) {
                        echo "<p>Le produit a été inséré avec succès</p>";
                    } else {
                        echo "<p>Erreur lors de l'insertion du produit</p>" . $connexion->error;
                    }
                } 
                ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php //*************TABLEAU EN BAS DE LA PAGE AFFICHANT LES DONNEES SQL POUR LES PRODUITS SUR LE DASHBOARD************* ?>
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
    <?php 
        require('footer.php');
    ?>
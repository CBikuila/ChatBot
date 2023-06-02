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
                        <button type="submit" class="btn btn-primary" name="ajouter_produit">Ajouter</button>
                    </form>

                    <div class='card-header'>
                        <h2>Catégories produit</h2>
                    </div>
                    <form action="produits.php" method="post">
                        <div class="mb-3">
                            <label for="mots_cles" class="form-label">Ajoutez une catégorie produit dans la base de données :</label>
                            <input type="text" class="form-control" name="categories_produits_nom" id="categories_produits_nom" aria-describedby="textHelp">
                        </div>
                        <button type="submit" class="btn btn-primary" name="ajouter_categorie">Ajouter</button>
                    </form>
                
                <?php
                    require('../config.php');

                //Ajout des produits via database SQL "sneakme_database.sql"         
                $marquesSneakers = $_POST["marque_sneakers"];
                $modelesSneakers = $_POST["modele_sneakers"];
                $couleursSneakers = $_POST["couleur_sneakers"];
                $taillesSneakers = $_POST["taille_sneakers"];
                $prixSneakers = $_POST["prix_sneakers"] . " &euro;";
                $categorieProduit =$_POST["categories_produits_nom"];

                if ($marquesSneakers && $modelesSneakers && $couleursSneakers && $taillesSneakers && $prixSneakers){
                    $insertion = "INSERT INTO produits (marque_sneakers, modele_sneakers, couleur_sneakers, taille_sneakers, prix_sneakers) VALUES ('$marquesSneakers', '$modelesSneakers', '$couleursSneakers', '$taillesSneakers', '$prixSneakers')";

                    $result =$connexion->query($insertion);
                    if ($result == true) {
                        echo "<p>Le produit a été inséré avec succès</p>";
                    } else {
                        echo "<p>Erreur lors de l'insertion du produit</p>" . $connexion->error;
                    }
                }
                
                //Ajout des catégories via database SQL "sneakme_database.sql" 
                if (isset($_POST["ajouter_categorie"])) {
                    $nouvelleCategorieProduit = $_POST["categories_produits_nom"];
                
                    // Vérifiez si la catégorie n'est pas vide avant de l'insérer dans la base de données
                    if (!empty($nouvelleCategorieProduit)) {
                        $insertionCategorieProduit = "INSERT INTO categories_produits (categories_produits_nom) VALUES ('$nouvelleCategorieProduit')";
                        $resultCategorieProduit = $connexion->query($insertionCategorieProduit);
                        
                        if ($resultCategorieProduit === TRUE) {
                            echo "<p>La catégorie a été ajoutée avec succès.</p>";
                        } else {
                            echo "<p>Erreur lors de l'ajout de la catégorie : " . $connexion->error . "</p>";
                        }
                    } else {
                        echo "<p>Veuillez entrer un nom de catégorie valide.</p>";
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
            <th>Catégorie produit</th>
        </tr>

        <?php
            // Connexion à la base de données
            $conn = new mysqli("localhost", "root", "root", "sneakme_database");

            // Vérification de la connexion
            if ($conn->connect_error) {
            die("Erreur de connexion à la base de données : " . $conn->connect_error);
            }

            // Exécution de la requête SQL pour récupérer les produits et les catégories des produits
            $sql = "SELECT p.produits_id, p.marque_sneakers, p.modele_sneakers, p.couleur_sneakers, p.taille_sneakers, p.prix_sneakers, s.categories_produits_nom
            FROM produits p
            LEFT JOIN categories_produits s ON p.produits_id = s.categories_produits_id";
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
                    echo "<td>";
                    echo "<select name='categories_produits[]'>"; // Ajout d'un attribut name pour récupérer la table SQL "categories_produits"

                    // Requête SQL pour récupérer les catégories de produits
                    $categories_produits_sql = "SELECT categories_produits_nom FROM categories_produits";
                    $categories_produits_result = $conn->query($categories_produits_sql);

                     // Vérification de la réussite de la requête
                    if ($categories_produits_result->num_rows > 0) {
                        while ($categorie_row = $categories_produits_result->fetch_assoc()) {
                            // Vérifiez si la catégorie est celle actuellement attribuée au produit
                            $selected = ($categorie_row["categories_produits_nom"] == $row["categories_produits_nom"]) ? "selected" : "";
                            echo "<option $selected>" . $categorie_row["categories_produits_nom"] . "</option>";
                        }
                    } else {
                        echo "<option>Aucune catégorie produit trouvée</option>";
                    }

                    echo "</select>";
                    echo "</td>";
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
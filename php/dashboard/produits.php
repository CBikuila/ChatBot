<?php
include('nav.php');
include('footer.php');
include('../config.php');
error_reporting(E_ERROR);
?>

<!-- Interface d'ajout de produits dans la table SQL "produits" et ajout de catégories produits dans la table SQL "categories_produits" -->
<div class='dashboard'>  
    <div class='dashboard-app'>
        <div class='dashboard-content'>
            <div class='container'>
                <div class='card'>
                    <div class='card-header'>
                        <h1>Produits</h1>
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
                        <div class="mb-3">
                            <label for="reponse" class="form-label">Genre :</label>
                            <input type="text" class="form-control" name="genre_sneakers" id="genre_sneakers">
                        </div>
                        <button type="submit" class="btn btn-primary" name="ajouter_produit">Ajouter</button>
                    </form>

                    <div class='card-header'>
                        <h1>Catégories produit</h1>
                    </div>
                    <form action="produits.php" method="post">
                        <div class="mb-3">
                            <label for="mots_cles" class="form-label">Ajoutez une catégorie produit dans la base de données :</label>
                            <input type="text" class="form-control" name="categories_produits_nom" id="categories_produits_nom" aria-describedby="textHelp">
                        </div>
                        <button type="submit" class="btn btn-primary" name="ajouter_categorie">Ajouter</button>
                    </form>           
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// Ajout des produits à la base de données SQL "sneakme_database"
$marquesSneakers = $_POST["marque_sneakers"];
$modelesSneakers = $_POST["modele_sneakers"];
$couleursSneakers = $_POST["couleur_sneakers"];
$taillesSneakers = $_POST["taille_sneakers"];
$prixSneakers = $_POST["prix_sneakers"] . " &euro;";
$genreSneakers = $_POST["genre_sneakers"];
$categorieProduit = $_POST["categories_produits_nom"];

if ($marquesSneakers && $modelesSneakers && $couleursSneakers && $taillesSneakers && $prixSneakers) {
    $insertion = "INSERT INTO produits (marque_sneakers, modele_sneakers, couleur_sneakers, taille_sneakers, genre_sneakers, prix_sneakers) 
                  VALUES ('$marquesSneakers', '$modelesSneakers', '$couleursSneakers', '$taillesSneakers', '$prixSneakers', '$genreSneakers')";

    $result = $conn->query($insertion);
    if ($result == true) {
        echo "<p>Le produit a été inséré avec succès</p>";
    } else {
        echo "<p>Erreur lors de l'insertion du produit</p>";
    }
}

// Ajout des catégories produits à la base de données SQL "sneakme_database"
$categoriesProduits = $_POST["categories_produits_nom"];

// Vérifiez si la catégorie n'est pas vide avant de l'insérer dans la base de données
if (!empty($categoriesProduits)) {
    $insertion = "INSERT INTO categories_produits (categories_produits_nom) 
                           VALUES ('$categoriesProduits')";
    
    $result = $conn->query($insertion);   
    if ($result === true) {
        echo "<p>La catégorie a été ajoutée avec succès.</p>";
    } else {
        echo "<p>Erreur lors de l'ajout de la catégorie produit</p>";
    }
}
?>

<!-- Interface en bas de la page affichant les données SQL saisies pour les produits et les catégories produits -->
<div class="interface">
    <table>
        <tr>
            <th>Photo</th>
            <th>Marque</th>
            <th>Modèle</th>
            <th>Couleur</th>
            <th>Taille</th>
            <th>Prix</th>
            <th>Genre</th>
            <th>Action</th>
            <th>Catégorie produit<th>
        </tr>
            <?php
            // Exécution de la requête SQL pour récupérer les produits et les catégories des produits
            $sql = "SELECT p.photo_sneakers, p.produits_id, p.marque_sneakers, p.modele_sneakers, p.couleur_sneakers, p.taille_sneakers, p.prix_sneakers, p.genre_sneakers, s.categories_produits_nom
                    FROM produits p
                    LEFT JOIN categories_produits s ON p.produits_id = s.categories_produits_id";
            $result = $conn->query($sql);

            // Vérification des résultats de la requête
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["photo_sneakers"] . "</td>";
                    echo "<td>" . $row["marque_sneakers"] . "</td>";
                    echo "<td>" . $row["modele_sneakers"] . "</td>";
                    echo "<td>" . $row["couleur_sneakers"] . "</td>";
                    echo "<td>" . $row["taille_sneakers"] . "</td>";
                    echo "<td>" . $row["prix_sneakers"] . " €</td>";
                    echo "<td>" . $row["genre_sneakers"] . "</td>";
                    echo '<td><a class="btn btn-danger btn-xs" href="../suppressionLigneSQL.php?id=' . $row["produits_id"] . '">Supprimer</a></td>';
                    echo "<td>";
                    echo "<select name='categories_produits[]'>"; // Ajout d'un attribut name pour récupérer la table SQL "categories_produits"

                    // Requête SQL pour récupérer les catégories de produits
                    $categories_produits_sql = "SELECT categories_produits_nom FROM categories_produits";
                    $categories_produits_result = $conn->query($categories_produits_sql);
                    if ($categories_produits_result->num_rows > 0) {
                        while ($categorie_produit_row = $categories_produits_result->fetch_assoc()) {
                            $selected = ($row["categories_produits_nom"] == $categorie_produit_row["categories_produits_nom"]) ? "selected" : "";
                            echo "<option value='" . $categorie_produit_row["categories_produits_nom"] . "' $selected>" . $categorie_produit_row["categories_produits_nom"] . "</option>";
                        }
                    }
                    echo "</select>";
                    echo "</td>";
                    echo "</tr>";
                }

            } else {
                echo "<tr><td colspan='6'>Aucun produit trouvé</td></tr>";
            }

            // Fermeture de la connexion à la base de données
            $conn->close();
            ?>
    </table>
</div>
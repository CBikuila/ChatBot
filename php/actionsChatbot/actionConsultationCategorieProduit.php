<?php
include('../config.php');
error_reporting(E_ERROR);

// Requête SQL pour récupérer toutes les catégories de produits
$sql = "SELECT categories_produits_id, categories_produits_nom FROM categories_produits";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo '<select name="categorie" id="categorie">';
    while ($row = $result->fetch_assoc()) {
        $categorieId = $row["<select name='categories_produits"]>
        $categorieId = $row["categories_produits_id"];
        $categorieNom = $row["categories_produits_nom"];
        echo '<option value="' . $categorieId . '">' . $categorieNom . '</option>';
    }
    echo '</select>';
} else {
    echo "Aucune catégorie de produits trouvée.";
}

$conn->close();

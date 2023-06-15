<?php
include('../config.php');
error_reporting(E_ERROR);

$categorieId = 1; // Remplacez 1 par l'ID de la catégorie souhaitée

// Requête SQL pour récupérer les produits de la catégorie spécifiée

$sql = "SELECT p.produits_id, p.marque_sneakers, p.modele_sneakers, p.couleur_sneakers, p.taille_sneakers, p.prix_sneakers, s.categories_produits_nom
FROM produits p
LEFT JOIN categories_produits s ON p.produits_id = s.categories_produits_id
WHERE categories_produits_id = $categorieId" ;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Affichage des produits
    while ($row = $result->fetch_assoc()) {
        echo "Categorie produit : " . $row["categories_produits_id"] . "<br>";
        echo "Marque : " . $row["marque_sneakers"] . "<br>";
        echo "Modele : " . $row["modele_sneakers"] . "<br>";
        echo "<br>";
    }
} else {
    echo "Aucun produit trouvé dans cette catégorie.";
}

$conn->close();

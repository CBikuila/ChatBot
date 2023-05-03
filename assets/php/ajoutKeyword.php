<?php

require('../php/config.php');

// Insérer des lignes de couleurs différentes de sneakers en SQL

$insertions = ["INSERT INTO chatbot_keywords (nom, couleur) VALUES ('Air Max 90', 'Bleu')","INSERT INTO chatbot_keywords (nom, couleur) VALUES ('Jordan 1', 'Rouge')"];

foreach ($insertions as $insertion){
    $result =$connexion->query($insertion);
    if ($result == true) {
        echo "Les lignes de couleurs différentes de sneakers ont été insérées avec succès";
    } else {
        echo "Erreur lors de l'insertion des lignes: " . $connexion->error;
    }
}

?>

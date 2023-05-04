<?php

require('../php/config.php');

// Insérer des lignes de couleurs différentes de sneakers en SQL

$insertions = ["INSERT INTO motscles (motcles_id, question, mots_cles) VALUES ('1', 'Quels sont les derniers modèles de sneakers pour hommes ?', 'sneakers')",
               "INSERT INTO motscles (motcles_id, question, mots_cles) VALUES ('2', 'Avez-vous des baskets pour enfants en taille 32 ?', 'baskets')",
               "INSERT INTO motscles (motcles_id, question, mots_cles) VALUES ('3', 'Quelles sont les couleurs les plus populaires pour les baskets de ce style ?', 'style')",
               "INSERT INTO motscles (motcles_id, question, mots_cles) VALUES ('4', 'Y a-t-il des promotions en cours pour les sneakers femme ?', 'femme')",
               "INSERT INTO motscles (motcles_id, question, mots_cles) VALUES ('5', 'Comment puis-je payer ma commande de baskets en ligne ?', 'payer')",
               "INSERT INTO motscles (motcles_id, question, mots_cles) VALUES ('6', 'Quels modes de paiement acceptez-vous pour les achats en magasin ?', 'paiement')",
               "INSERT INTO motscles (motcles_id, question, mots_cles) VALUES ('7', 'Quelles sont les couleurs disponibles pour ce modèle ?', 'couleurs')",
               "INSERT INTO motscles (motcles_id, question, mots_cles) VALUES ('8', 'Puis-je payer avec ma carte bleue Visa ?', 'carte bleue')",
               "INSERT INTO motscles (motcles_id, question, mots_cles) VALUES ('9', 'Acceptez-vous les chèques comme moyen de paiement ?', 'chèque')",
               "INSERT INTO motscles (motcles_id, question, mots_cles) VALUES ('10', 'Quels sont les délais de livraison pour les sneakers achetées en ligne ?', 'délais')",
               "INSERT INTO motscles (motcles_id, question, mots_cles) VALUES ('11', 'Quel modèle de Nike Air Max me conseillerez-vous ?', 'modèle')",
               "INSERT INTO motscles (motcles_id, question, mots_cles) VALUES ('12', 'Quel est le délai pour un retour et un remboursement de mes baskets ?', 'retour')",
               "INSERT INTO motscles (motcles_id, question, mots_cles) VALUES ('13', 'Comment fonctionne le remboursement pour les baskets retournées en magasin ?', 'remboursement')",
               "INSERT INTO motscles (motcles_id, question, mots_cles) VALUES ('14', 'Avez-vous des recommandations pour choisir la bonne taille de baskets ?', 'tailles')",
               "INSERT INTO motscles (motcles_id, question, mots_cles) VALUES ('15', 'Quelles méthodes de livraison proposez-vous ?', 'livraison')",
               "INSERT INTO motscles (motcles_id, question, mots_cles) VALUES ('16', 'Quels sont les modèles les plus hypes du moment ?', 'hype')",
               "INSERT INTO motscles (motcles_id, question, mots_cles) VALUES ('17', 'Quels sont les modèles de chaussures pour homme les plus vendus ?', 'homme')",
               "INSERT INTO motscles (motcles_id, question, mots_cles) VALUES ('18', 'Comment savoir quelle pointure de chaussures pour enfant choisir ?', 'enfant')",
               "INSERT INTO motscles (motcles_id, question, mots_cles) VALUES ('19', 'Quelles sont les promotions en cours sur les chaussures ?', 'promotions')",
               "INSERT INTO motscles (motcles_id, question, mots_cles) VALUES ('20', 'Quels sont les modes de règlement disponibles pour les chaussures ?', 'règlement')",
               "INSERT INTO motscles (motcles_id, question, mots_cles) VALUES ('21', 'Quels sont les délais de traitement d'un paiement par carte bancaire ?', 'carte bancaire')",
              ];

foreach ($insertions as $insertion){
    $result =$connexion->query($insertion);
    if ($result == true) {
        echo "Les lignes de couleurs différentes de sneakers ont été insérées avec succès";
    } else {
        echo "Erreur lors de l'insertion des lignes: " . $connexion->error;
    }
}

?>

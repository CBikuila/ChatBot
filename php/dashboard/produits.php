<?php
require('nav.php');
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

                    if ($marquesSneakers && $modelesSneakers && $couleursSneakers && $taillesSneakers){
                        $insertion = "INSERT INTO produits (marque_sneakers, modele_sneakers, couleur_sneakers, taille_sneakers) VALUES ('$marquesSneakers', '$modelesSneakers', '$couleursSneakers', '$taillesSneakers')";

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
</body>
<script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
<script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
</html>



<div class='card'>
    <div class='card-header'>
        <h2>Tableau de bord</h2>
    </div>
    <div class='card-body'>
        <p>Ajoute un mot clé et sa phase associée.</p>
    </div>
    <form action="dashboard.php" method="post">
        <div class="mb-3">
            <label for="mots_cles" class="form-label">Mot clé :</label>
            <input type="text" class="form-control" name="mots_cles" id="mot_cles" aria-describedby="textHelp">
        </div>
        <div class="mb-3">
            <label for="reponse" class="form-label">Phrase associée :</label>
            <input type="text" class="form-control" name="question" id="question">
        </div>
        <button type="submit" class="btn btn-primary">Ajouter</button>
    </form>


<?php
    require('../php/config.php');
    require('../php/ajoutKeyword.php');

    //Ajout des mots-clés via database SQL "sneakme_database.sql"    

    $reponses = $_POST["question"];
    $questions = $_POST["mots_cles"];

    if ($reponses && $questions) {
        $insertion = "INSERT INTO motscles (question, mots_cles) VALUES ('$questions', '$reponses')";

        $result = $connexion->query($insertion);
        if ($result == true) {
            echo "<p>Les lignes de couleurs différentes de sneakers ont été insérées avec succès</p>";
        } else {
            echo "<p>Erreur lors de l'insertion des lignes</p>" . $connexion->error;
        }
    }
?>


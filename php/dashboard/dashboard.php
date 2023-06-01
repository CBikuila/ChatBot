<?php
require('nav.php');
?>

<!-- Interface pour le traitement des messages et des actions-->
    <div class='dashboard'>  
        <div class='dashboard-app'>
            <div class='dashboard-content'>
                <div class='container'>
                    <div class='card'>
                        <div class='card-header'>
                            <h2>Réception des messages</h2>
                        </div>
                        <div class='card-body'>
                            <p>Ajoute un mot-clé et sa phrase associée dans la base de données</p>
                        </div>
                        <form action="mots_cles.php" method="post">
                            <div class="mb-3">
                                <label for="mots_cles" class="form-label">Mot-clé :</label>
                                <input type="text" class="form-control" name="mots_cles" id="mot_cles" aria-describedby="textHelp">
                            </div>
                            <div class="mb-3">
                                <label for="reponse" class="form-label">Phrase associée :</label>
                                <input type="text" class="form-control" name="question" id="question">
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
                        <?php
                            require('../config.php');
                            require('../ajoutKeyword.php');

                            //Ajout des mots-clés via database SQL "sneakme_database.sql"    
                            error_reporting(E_ERROR); //error_reporting(E_ERROR) permet de cacher le Warning produit à cause de $reponses = $_POST["question"] et $questions = $_POST["mots_cles"] en dessous
                            
                            if (isset($_POST["question"]) && isset($_POST["mots_cles"])){
                                    
                                $reponses = $_POST["mots_cles"];
                                $questions = $_POST["question"];

                                $insertion = "INSERT INTO motscles (question, mots_cles) VALUES ('$questions', '$reponses')";

                                $result =$connexion->query($insertion);
                                if ($result == true) {
                                    echo "<p>Le mot-clé et la question associée ont bien été ajoutés</p>";
                                } else {
                                    echo "<p>Erreur lors de l'insertion du mot-clé et de la question associée</p>" . $connexion->error;
                                }
                            } 
                        ?>
                    </div>
<?php
require('footer.php');
?>
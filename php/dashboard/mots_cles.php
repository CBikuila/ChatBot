<?php 
    require('nav.php');
?>
<!-- interface ajout de mot clé et phrases associés-->
    <div class='dashboard'>  
        <div class='dashboard-app'>
            <div class='dashboard-content'>
                <div class='container'>
                    <div class='card'>
                        <div class='card-header'>
                            <h2>Les mots-clés</h2>
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
                                    
                                $reponses = $_POST["question"];
                                $questions = $_POST["mots_cles"];

                                $insertion = "INSERT INTO motscles (question, mots_cles) VALUES ('$questions', '$reponses')";

                                $result =$connexion->query($insertion);
                                if ($result == true) {
                                    echo "<p>Les lignes de couleurs différentes de sneakers ont été insérées avec succès</p>";
                                } else {
                                    echo "<p>Erreur lors de l'insertion des lignes</p>" . $connexion->error;
                                }
                            } 
                        ?>
                    </div>

<!DOCTYPE html>
<html>
    <head>
        <title>Exemple de table HTML</title>
    </head>
    <body>

        <table>
            <tr>
                <th>Mot-clé</th>
                <th>Question</th>
                <th>Action</th>
            </tr>

            <?php
                // Connexion à la base de données
                $conn = new mysqli("localhost", "root", "root", "sneakme_database");

                // Vérification de la connexion
                if ($conn->connect_error) {
                die("Erreur de connexion à la base de données : " . $conn->connect_error);
                }

                // Exécution de la requête SQL
                $sql = "SELECT mots_cles, question FROM motscles";
                $result = $conn->query($sql);

                // Vérification des résultats de la requête
                if ($result->num_rows > 0) {
                // Affichage des lignes
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["mots_cles"] . "</td>";
                    echo "<td>" . $row["question"] . "</td>";
                    echo '<td><a href="../suppKeyword.php?id=' . $row["id"] . '">Supprimer</a></td>';
                    echo "</tr>";
                }
                } else {
                echo "<tr><td colspan='3'>Aucun résultat trouvé.</td></tr>";
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




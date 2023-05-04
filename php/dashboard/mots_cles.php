<?php 
    require('nav.php');
?>
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
                        <form action="dashboard.php" method="post">
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
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                                </tr>
                                <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                                </tr>
                                <tr>
                                <th scope="row">3</th>
                                <td colspan="2">Larry the Bird</td>
                                <td>@twitter</td>
                                </tr>
                            </tbody>
                        </table>
                        <?php
                            require('../php/config.php');
                            require('../php/ajoutKeyword.php');

                            //Ajout des mots-clés via database SQL "sneakme_database.sql"    

                            $reponses = $_POST["question"];
                            $questions = $_POST["mots_cles"];

                            if ($reponses && $questions){
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
                </div>
            </div>
        </div>
    </div>
<?php 
    require('footer.php');
?>
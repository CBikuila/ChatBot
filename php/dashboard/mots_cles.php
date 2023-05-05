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
                    <div class='card'>
                        <div class='card-header'>
                            <h2>Mots clés et phrases associés</h2>
                        </div>
                        <!-- Renvoie du mot clé et la phrase associé à partir de la base de donnée-->
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">Mot clé</th>
                                    <th scope="col">Phrase associée</th>
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Mark</td>
                                    <td>hfdsoighfzdklijgfdlisjgfdolsjfdsjgdsjjsgjsiois</td>
                                    <td>
                                        <button type="submit" class="btn btn-info"><i class="fa-regular fa-pen-to-square"></i>Modifer</button>
                                        <button type="reset" class="btn btn-danger"><i class="fa-sharp fa-solid fa-trash"></i>Supprimer</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jacob</td>
                                    <td>Thornton</td>
                                <td>
                                    <button type="submit" class="btn btn-info"><i class="fa-regular fa-pen-to-square"></i>Modifer</button>
                                    <button type="reset" class="btn btn-danger"><i class="fa-sharp fa-solid fa-trash"></i>Supprimer</button>
                                </td>
                                </tr>
                                <tr>
                                    <td>Larry</td>
                                    <td>the Bird</td>
                                    <td>
                                        <button type="submit" class="btn btn-info"><i class="fa-regular fa-pen-to-square"></i>Modifer</button>
                                        <button type="reset" class="btn btn-danger"><i class="fa-sharp fa-solid fa-trash"></i>Supprimer</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>                   
                </div>
            </div>
        </div>
    </div>
<?php 
    require('footer.php');
?>

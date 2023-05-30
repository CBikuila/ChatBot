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
                            <h2>Clients</h2>
                        </div>
                        <div class='card-body'>
                            <p>Ajoutez un client dans la base de données</p>
                        </div>
                        <form action="utilisateurs.php" method="post">
                            <div class="mb-3">
                                <label for="mots_cles" class="form-label">Prénom :</label>
                                <input type="text" class="form-control" name="prenom_utilisateur" id="prenom_utilisateur" aria-describedby="textHelp">
                            </div>
                            <div class="mb-3">
                                <label for="reponse" class="form-label">Mot de passe :</label>
                                <input type="text" class="form-control" name="mot_de_passe_utilisateur" id="mot_de_passe_utilisateur">
                            </div>               
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
                    
                    <?php
                        require('../config.php');
                       // require('../php/ajoutKeyword.php');

                    //Ajout des mots-clés via database SQL "sneakme_database.sql"    

                    $prenomUtilisateurs = $_POST["prenom_utilisateur"];
                    $motDePasseUtilisateurs = $_POST["mot_de_passe_utilisateur"];

                    if ($prenomUtilisateurs && $motDePasseUtilisateurs){
                        $insertion = "INSERT INTO utilisateurs (prenom_utilisateur, mot_de_passe_utilisateur) VALUES ('$prenomUtilisateurs', '$motDePasseUtilisateurs')";

                        $result =$connexion->query($insertion);
                        if ($result == true) {
                            echo "<p>Le client a été inséré avec succès</p>";
                        } else {
                            echo "<p>Erreur lors de l'insertion du client</p>" . $connexion->error;
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
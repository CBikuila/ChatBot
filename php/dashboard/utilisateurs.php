<?php
include('nav.php');
include('footer.php');
require('../config.php');
error_reporting(E_ERROR | E_PARSE);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <script defer src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js" integrity="sha384-zYPOMqeu1DAVkHiLqWBUTcbYfZ8osu1Nd6Z89ify25QV9guujx43ITvfi12/QExE" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js" integrity="sha384-Y4oOpwW3duJdCWv5ly8SCFYWqFDsfob/3GkgExXKV4idmbt98QcxXYs9UoXAB7BZ" crossorigin="anonymous"></script>
    <title>Utilisateurs</title>
</head>

<body>
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
                        //Ajout des mots-clés via database SQL "sneakme_database.sql"    
                        $prenomUtilisateurs = $_POST["prenom_utilisateur"];
                        $motDePasseUtilisateurs = $_POST["mot_de_passe_utilisateur"];

                        if ($prenomUtilisateurs && $motDePasseUtilisateurs){
                            $insertion = "INSERT INTO utilisateurs_connexion (prenom_utilisateur, mot_de_passe_utilisateur) VALUES ('$prenomUtilisateurs', '$motDePasseUtilisateurs')";

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

</html>

<?php //*************TABLEAU EN BAS DE LA PAGE AFFICHANT LES DONNEES SQL POUR LES CLIENTS SUR LE DASHBOARD************* ?>

<!DOCTYPE html>
<html>
    <head>
        <title>Tableau données utilisateurs</title>
    </head>
    <body>

        <table>
            <tr>
                <th>Prénom</th>
                <th>Mot de passe</th>
            </tr>

            <?php
                // Connexion à la base de données
                $conn = new mysqli("localhost", "root", "root", "sneakme_database");

                // Vérification de la connexion
                if ($conn->connect_error) {
                die("Erreur de connexion à la base de données : " . $conn->connect_error);
                }

                // Exécution de la requête SQL
                $sql = "SELECT utilisateurs_id, prenom_utilisateur, mot_de_passe_utilisateur FROM utilisateurs";
                $result = $conn->query($sql);

                // Vérification des résultats de la requête
                if ($result->num_rows > 0) {
                // Affichage des lignes
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["prenom_utilisateur"] . "</td>";
                    echo "<td>" . $row["mot_de_passe_utilisateur"] . "</td>";
                    echo '<td><a class="btn btn-danger btn-xs" href="../suppressionLigneSQL.php?id=' . $row["utilisateurs_id"] . ' ">Supprimer</a></td>';
                    echo "</tr>";
                }
                } else {
                echo "<tr><td colspan='3'>Aucuns utilisateurs ajoutés</td></tr>";
                }

                // Fermeture de la connexion à la base de données
                $conn->close();
            ?>

        </table>

    </body>
</html>


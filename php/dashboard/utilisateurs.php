<?php
include('nav.php');
include('footer.php');
include('../config.php');
error_reporting(E_ERROR);
?>

<!-- Interface d'ajout de clients dans la table SQL "utilisateurs" -->
<div class='dashboard'>  
    <div class='dashboard-app'>
        <div class='dashboard-content'>
            <div class='container'>
                <div class='card'>
                    <div class='card'>
                        <div class='card-header'>
                            <h1>Clients</h1>
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
                        //Ajout du prénom et de mot de passe pour les utilisateurs (clients) à la base de données SQL "sneakme_database"    
                        $prenomUtilisateurs = $_POST["prenom_utilisateur"];
                        $motDePasseUtilisateurs = $_POST["mot_de_passe_utilisateur"];

                        if ($prenomUtilisateurs && $motDePasseUtilisateurs){
                            $insertion = "INSERT INTO utilisateurs_connexion (prenom_utilisateur, mot_de_passe_utilisateur) VALUES ('$prenomUtilisateurs', '$motDePasseUtilisateurs')";

                            $result =$conn->query($insertion);
                            if ($result == true) {
                                echo "<p>Le client a été inséré avec succès</p>";
                            } else {
                                echo "<p>Erreur lors de l'insertion du client</p>" . $conn->error;
                            }
                        } 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Interface en bas de la page affichant les données SQL saisies pour utilisateurs (clients) -->
<table>
    <tr>
        <th>Prénom</th>
        <th>Mot de passe</th>
    </tr>
<?php
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



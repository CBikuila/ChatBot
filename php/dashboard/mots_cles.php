<?php
include('nav.php');
include('footer.php');
include('../config.php');
error_reporting(E_ERROR);
?>

<!-- Interface d'ajout de mots-clés et de leurs phrases associées dans la table SQL "motscles" -->
<div class='dashboard'>
    <div class='dashboard-app'>
        <div class='dashboard-content'>
            <div class='container'>
                <div class='card'>
                    <div class='card-header'>
                        <h1>Les mots-clés</h1>
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

//Ajout des mots-clés à la base de données SQL "sneakme_database"
$question  = $_POST["question"];
$motscles  = $_POST["mots_cles"];

if ($question && $motscles){
    $insertion = "INSERT INTO motscles (question, mots_cles) 
                  VALUES ('$question', '$motscles')";

    $result = $conn->query($insertion);
    if ($result == true) {
        echo "<p>Le mot-clé et la question associée ont bien été ajouté</p>";
    } else {
        echo "<p>Erreur lors de l'insertion du mot-clé et de la question associée</p>";
    }
}
?>

<!-- Interface en bas de la page affichant les données SQL saisies pour les mots-clés -->
<table>
    <tr>
        <th>Mot-clé</th>
        <th>Question</th>
        <th>Action</th>
    </tr>
<?php
// Exécution de la requête SQL pour récupérer les mots-clés et leurs questions associées
$sql = "SELECT motscles_id, mots_cles, question 
        FROM motscles";
$result = $conn->query($sql);

// Vérification des résultats de la requête
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["mots_cles"] . "</td>";
        echo "<td>" . $row["question"] . "</td>";
        echo '<td><a class="btn btn-danger btn-xs" href="../suppressionLigneSQL.php?id=' . $row["motscles_id"] . '">Supprimer</a></td>';
        echo "</tr>";
    }

} else {
    echo "<tr><td>Aucuns mots-clés ajoutés</td></tr>";
}

// Fermeture de la connexion à la base de données
$conn->close();
?>
</table>
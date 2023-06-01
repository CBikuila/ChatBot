<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'>
    <script defer src="https://kit.fontawesome.com/2812e639d2.js" crossorigin="anonymous"></script>
</head>

<body>
    <div class="interface-connexion">
        <div class="titre-icone">
            <i class="fas fa-user"></i>
            <h1>Connexion</h1>
        </div>
        <form action="connexion.php" method="post">
            <label for="email">E-mail :</label>
            <input type="text" id="email" name="admin_email" placeholder="Entrez votre adresse mail de connexion" required>
            <br>
            <label for="password">Mot de passe :</label>
            <input type="password" id="password" name="admin_password" placeholder="Entrez votre de passe" required>
            <br>
            <input type="submit" value="Se connecter">


            <?php //*****Connexion à la table SQL "admin" avec les adresses emails et les mots de passes admin*****

            // Connexion à MySQL
            $connexion = new mysqli("localhost", "root", "root", "sneakme_database");

            // Vérifier la connexion
            if ($connexion->connect_error) {
                die("Erreur de connexion à la base de données : " . $connexion->connect_error);
            }

            //Accès aux colonnes SQL "admin_email" et "admin_password" pour récupérer les identifiants de connexion au dashboard
            if (!empty($_POST["admin_email"]) && !empty($_POST["admin_password"])) {
                $email = $_POST["admin_email"];
                $password = $_POST["admin_password"];

                $sql = "SELECT admin_email, admin_password FROM admin_connexion WHERE admin_email = '$email' AND admin_password = '$password'";

                $result = $connexion->query($sql);

                if ($result->num_rows > 0) { //Vérifie si le nombre de lignes SQL retournées est supérieur à 0, signifiant alors qu'un enregistrement correspondant à été trouvé.
                    header('Location: ../php/dashboard/dashboard.php');
                    exit();
                } else {
                    echo "<br>Identifiants de connexion incorrects.";
                }
            }

            ?>
        </form>
    </div>
</body>

</html>
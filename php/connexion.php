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
    <div class="titre-icone">
      <i class="fas fa-user"></i>
      <h1>Connexion</h1>
    </div>
    
    <form action="connexion.php" method="post">
        <label for="email">E-mail :</label>
        <input type="text" id="email" name="email" placeholder="Enter votre email" required>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" placeholder="Mot de passe" required>
        <br>
        <input type="submit" value="Se connecter">
        <?php
            if ($_POST) {
            $dashboard = [
                [
                "email" => "admin@sneakme.fr",
                "password" => "admin",
                ],
            ];
            
            $email = $_POST["email"];
            $password = $_POST["password"];

            $loggedIn = false;

                foreach ($dashboard as $user) {
                    if ($user["email"] == $email && $user["password"] == $password) {
                        $loggedIn = true;
                        break;
                    }
                }

                if ($loggedIn === false && $email && $password) {
                    echo "Adresse mail et/ou mot de passe incorrect";

                    // L'utilisateur est connecté, faire quelque chose ici...

                } else {
                    header('Location: ../php/dashboard.php');
                }
            }
        ?>    
    </form>
</body>
</html>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Connexion</title>
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'>
    <script defer src="https://kit.fontawesome.com/2812e639d2.js" crossorigin="anonymous"></script>
</head>
<body>
    <div class="titre-icone">
      <i class="fas fa-user"></i>
      <h1>Connexion</h1>
    </div>
    <form action="adminId.php" method="post">
        <label for="email">E-mail :</label>
        <input type="text" id="email" name="email" placeholder="Enter votre email" required>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" placeholder="mot de passe" required>
        <br>
        <input type="submit" value="Se connecter">
    </form>

<?php
//Code de PF connect.php dans boutique sur GDrive - 4. SUPPORTS COURS DEV - PHP
include "./../php/adminId.php";

$email = $_POST["email"];
$password = $_POST["password"];

foreach ($adminId as $key => $adminId) {
    $checkEmail = in_array($email,$adminId);
    $checkPassword = in_array($password,$adminId);

    /*
    if ($checkUsername == true && $checkPassword == true) {
        session_start();
        session_regenerate_id();
        $_SESSION["isConnect"] = true;
        $_SESSION["username"] = $user["username"];
        $_SESSION["email"] = $user["email"];
        $_SESSION["nom"] = $user["nom"];
        $_SESSION["nbArticle"] = 0;
        $_SESSION["panier"] = [];
        exit;
    };
    */
}

?>

</body>
</html>
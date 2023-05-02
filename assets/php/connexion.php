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
    <form action="login.php" method="post">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>
        <br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br>
        <input type="submit" value="Se connecter">
    </form>

<?php
//Code de PF connect.php dans boutique sur GDrive - 4. SUPPORTS COURS DEV - PHP
include "./../php/users.php";

$username = $_POST["username"];
$password = $_POST["password"];

foreach ($users as $key => $user) {
    $checkUsername = in_array($username,$user);
    $checkPassword = in_array($password,$user);


    if ($checkUsername == true && $checkPassword == true) {
        session_start();
        session_regenerate_id();
        $_SESSION["isConnect"] = true;
        $_SESSION["email"] = $adminId["email"];
        $_SESSION["password"] = $adminId["password"];
        header('location: ./../index.php?login=ok');
        exit;
    };
}

header('location: ./../index.php?login=ko');
?>

</body>
</html>
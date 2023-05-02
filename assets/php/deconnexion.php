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
      <h1>Déconnexion</h1>
    </div>
    
    <form action="deconnexion.php" method="post">
        <input type="submit" value="Se déconnecter"">

<?php
//Code de PF logout.php
    session_start();
    session_destroy();
?>

    </form>
</body>
</html>
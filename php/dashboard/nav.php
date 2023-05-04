<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="../../assets/css/dashboard.css">
    <link rel="stylesheet" href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <script defer src="https://kit.fontawesome.com/2812e639d2.js" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</head>

<body>
<div class="dashboard-nav">
    <header>
        <a href="#!" class="menu-toggle"><i class="fas fa-bars"></i></a>
        <img class="logo" src="../../images/logo/sneakme-logo-clair.png">             
    </header>
    <nav class="dashboard-nav-list">
        <a href="dashboard.php" class="dashboard-nav-item active"><i class="fas fa-tachometer-alt"></i>Tableau de bord</a>
        <a href="mots_cles.php" class="dashboard-nav-item active"><i class="fas fa-tachometer-alt"></i>Mots-clés</a>
        <a href="produits.php" class="dashboard-nav-item active"><i class="fas fa-tachometer-alt"></i>Produits</a>
        <a href="./../deconnexion.php" class="dashboard-nav-item"><i class="fas fa-sign-out-alt"></i>Déconnexion</a>
    </nav>
</div>

<?php ini_set('display_errors', 1); ini_set('display_startup_errors', 1); error_reporting(E_ALL); //A DEGAGER APRES AVOIR TERMINE?>




<?php
error_reporting(E_ERROR);

// Connexion à MySQL
$connexion = new mysqli("localhost", "root", "root", "sneakme_database");

// Vérifier la connexion
if ($connexion->connect_error) {
    die("Erreur de connexion à la base de données : " . $connexion->connect_error);
}
var_dump($_POST);
die();
// Vérifier si les données sont présentes dans $_POST
if (!empty($_POST["admin_connexion"]["admin_email"]) && !empty($_POST["admin_connexion"]["admin_password"])) {
    $email = $_POST["admin_connexion"]["admin_email"];
    $password = $_POST["admin_connexion"]["admin_password"];
    $sql = "SELECT admin_email, admin_password FROM admin_connexion WHERE admin_email = '$email' AND admin_password = '$password'";

    $result = $connexion->query($sql);

    if ($result->num_rows > 0) {
        // Les identifiants de connexion sont corrects
        header('Location: ../php/dashboard/dashboard.php');
        exit();
    } else {
        echo "Identifiants de connexion incorrects.";
    }
}
?>
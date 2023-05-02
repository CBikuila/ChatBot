<?php
//Code de PF logout.php dans boutique sur GDrive 4. SUPPORTS COURS DEV - PHP
    session_start();
    session_destroy();
    header('location: ../index.php');
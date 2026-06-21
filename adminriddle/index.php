<?php
session_start();
  $is_admin = false;
  if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
    $is_admin = true;
  }
  
  if ($is_admin === false) {
    header("Location: login.php");
    exit;
  } 
?>


<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud raadsels</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <?php
    // functie: Programma CRUD orderen
    // auteur: Simon   

    // Initialisatie
    include 'functions.php';

    // Main

    // Aanroep functie 
    crudMain();
    ?>

    <nav>
        <br>
        <a  href="../beheer.php"><strong>Ga naar beheer homepage</strong></a>
    </nav>

</body>
</html>




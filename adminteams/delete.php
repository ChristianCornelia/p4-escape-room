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


<?php
// auteur: Simon
// functie: verwijder een row op basis van de id
include 'functions.php';

// Haal row uit de database
if(isset($_GET['id'])){

    // test of insert gelukt is
    if(deleteRecord($_GET['id']) == true){
        echo '<script>alert("team: ' . $_GET['id'] . ' is verwijderd")</script>';
        echo "<script> location.replace('index.php'); </script>";
    } else {
        echo '<script>alert("team is NIET verwijderd")</script>';
    }
}
?>


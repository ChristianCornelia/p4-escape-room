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
    // functie: formulier en database insert order
    // auteur: Simon

    echo "<h1>Insert raadsel</h1>";

    require_once('functions.php');
	 
    // Test of er op de insert-knop is gedrukt 
    if(isset($_POST) && isset($_POST['btn_ins'])){

        // test of insert gelukt is
        if(insertRecord($_POST) == true){
            echo "<script>alert('raadsel is toegevoegd')</script>";
        } else {
            echo '<script>alert("raadsel is NIET toegevoegd")</script>';
        }
    }
?>
<html>
    <body>
        <form method="post">

        <label for="riddle">raadsel:</label><br>
        <textarea id="riddle" name="riddle" required style="width:500px; height:150px; resize:vertical;"></textarea><br>

        <label for="answer">antwoord:</label><br>
        <input type="text" id="answer" name="answer" required style="width:500px;"><br>

        <label for="hint">hint:</label><br>
        <input type="text" id="hint" name="hint" style="width:500px;"><br>

        <label for="roomId">room id:</label><br>
        <input type="number" id="roomId" name="roomId" required><br>
        
        <input type="submit" name="btn_ins" value="Insert">
        </form>
        
        <br><br>
        <a href='index.php'>Home</a>
    </body>
</html>

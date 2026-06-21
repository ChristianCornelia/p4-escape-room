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

    echo "<h1>Insert team</h1>";

    require_once('functions.php');
	 
    // Test of er op de insert-knop is gedrukt 
    if(isset($_POST) && isset($_POST['btn_ins'])){

        // test of insert gelukt is
        if(insertRecord($_POST) == true){
            echo "<script>alert('team is toegevoegd')</script>";
        } else {
            echo '<script>alert("team is NIET toegevoegd")</script>';
        }
    }
?>
<html>
    <body>
        <form method="post">

        <label for="teamName">teamnaam:</label><br>
        <input type="text" id="teamName" name="teamName" required style="width:500px;"><br>

        <label for="startTime">starttijd:</label><br>
        <input type="datetime-local" id="startTime" name="startTime" step="1"><br>

        <label for="finishTime">eindtijd:</label><br>
        <input type="datetime-local" id="finishTime" name="finishTime" step="1"><br>

        <label for="completionTimeSeconds">tijd (seconden):</label><br>
        <input type="number" id="completionTimeSeconds" name="completionTimeSeconds"><br>
        
        <input type="submit" name="btn_ins" value="Insert">
        </form>
        
        <br><br>
        <a href='index.php'>Home</a>
    </body>
</html>

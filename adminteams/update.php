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
    // functie: update order
    // auteur: Simon

    require_once('functions.php');

    // Test of er op de wijzig-knop is gedrukt 
    if(isset($_POST['btn_wzg'])){

        // test of update gelukt is
        if(updateRecord($_POST) == true){
            echo "<script>alert('team is gewijzigd')</script>";
        } else {
            echo '<script>alert("team is NIET gewijzigd")</script>';
        }
    }

    // Test of id is meegegeven in de URL
    if(isset($_GET['id'])){  
        // Haal alle info van de betreffende id $_GET['id']
        $id = $_GET['id'];
        $row = getRecord($id);
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="style.css">
  <title>Wijzig order</title>
</head>
<body>
  <h2>Wijzig order</h2>
  <form method="post">
    
    <input type="hidden" id="id" name="id" required value="<?php echo htmlspecialchars($row['id']); ?>"><br>
    <label for="teamName">teamnaam:</label><br>
    <input type="text" id="teamName" name="teamName" required style="width:500px;" value="<?php echo htmlspecialchars($row['teamName']); ?>"><br>

    <label for="startTime">starttijd:</label><br>
    <input type="datetime-local" id="startTime" name="startTime" step="1" value="<?php echo $row['startTime'] !== null ? htmlspecialchars(str_replace(' ', 'T', $row['startTime'])) : ''; ?>"><br>

    <label for="finishTime">eindtijd:</label><br>
    <input type="datetime-local" id="finishTime" name="finishTime" step="1" value="<?php echo $row['finishTime'] !== null ? htmlspecialchars(str_replace(' ', 'T', $row['finishTime'])) : ''; ?>"><br>

    <label for="completionTimeSeconds">tijd (seconden):</label><br>
    <input type="number" id="completionTimeSeconds" name="completionTimeSeconds" value="<?php echo htmlspecialchars($row['completionTimeSeconds']); ?>"><br>

    <input type="submit" name="btn_wzg" value="Wijzig">
  </form>
  <br><br>
  <a href='index.php'>Home</a>
</body>
</html>

<?php
    } else {
        echo "Geen id opgegeven<br>";
    }
?>
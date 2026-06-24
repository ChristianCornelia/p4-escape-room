<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escape Room</title>
  <link rel="stylesheet" href="./css/home/style.css">
</head>

<body>
<nav>
  <h1>Devil's Acre</h1>
  <a href="./help.php" class="login-btn">Help</a>
  <?php

    session_start();

    $is_admin = false;
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') {
        $is_admin = true;
    }

     if ($is_admin) {
        echo '  <a href="./beheer.php" class="login-btn">beheer</a>';
    } 
    
    if (!isset($_SESSION['user_id'])) {
        echo '<a href="./login.php" class="login-btn">Login</a>';
    } else {
        echo '  <a href="./account.php" class="login-btn">Mijn account</a>';
        echo '  <a href="./logout.php" class="login-btn">logout</a>';
    }  


  ?>
</nav>

  <div class="div1">
    <img src="images/parchment.png" class="img1">
    <h1 class="maintext">Welcome to Devil's Acre, the most dangerous slum in 1800s London...</h1>
    <a href="./rooms/room_1.php" class="room1">Enter ye...</a>
  </div>

  

</body>

</html>
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
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Beheer</title>
  <link rel="stylesheet" href="./css/beheer/style.css">
</head>
<body>
  
  <div class="container">

  <h1>Beheer homepage</h1>
  <p>Edit riddles or teams</p>

  <div class="cardsgrid">

  <a class="card" href="adminriddle/index.php">
      <h2>riddles</h2>
  </a>
  <a class="card" href="adminteams/index.php">
      <h2>teams</h2>
  </a>

  </div>
  </div>

  <a class="exit-card" href="./"><strong>Ga naar frontend</strong></a>

</body>
</html>
<?php
session_start();
require_once('dbcon.php');

if (isset($_SESSION['user_id'])) {
    $stmt = $db_connection->prepare("SELECT teamId FROM users WHERE id = :id");
    $stmt->execute([':id' => $_SESSION['user_id']]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && $user['teamId'] !== null) {
        $stmt = $db_connection->prepare(
            "UPDATE teams SET status = 'lost'
             WHERE id = :teamId AND status = 'in_progress'"
        );
        $stmt->execute([':teamId' => $user['teamId']]);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Win scherm</title>
      <link rel="stylesheet" href="./css/winlose/style.css">
</head>
<body class="lose">
<nav>
  <h1>Devil's Acre</h1>
</nav>

    <main>
        <div class=winscreen>
        <img class="blood" src="./images/blood.png" alt="">
        <img class="cross" src="./images/cross.png" alt="">
        <h1 class="losetext">Helaas, u heeft veloren.</h1>
        <form class="toscore" action="account.php#list">
        <button >Naar lijst</button>
        </form>
        </div>
    </main>
</body>
</html>
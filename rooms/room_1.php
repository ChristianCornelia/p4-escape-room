<?php
session_start();
require_once('../dbcon.php');

if (!isset($_SESSION['current_riddle'])) {
    $_SESSION['current_riddle'] = 0;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submitted = strtolower(trim($_POST['answer']));
    $correct   = strtolower(trim($_POST['correct_answer']));

    if ($submitted === $correct) {
        $_SESSION['current_riddle']++;
    } else {
        $feedback = "Wrong answer, try again!";
    }
}

$stmt   = $db_connection->query("SELECT * FROM riddles WHERE roomId = 1 ORDER BY id");
$riddles = $stmt->fetchAll(PDO::FETCH_ASSOC);
$current = $_SESSION['current_riddle'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Escape room 2</title>
  <link rel="stylesheet" href="../css/room/style.scss">
</head>

<body class="hospital">
  <div class="div1">
    <img src="../images/parchment.png" class="img1">
    <div class="parchment-content">
      <?php if ($current < count($riddles)) : ?>
        <p class="maintext"><strong>Riddle <?php echo $current + 1; ?></strong></p>
        <h1 class="maintext"><?php echo htmlspecialchars($riddles[$current]['riddle']); ?></h1>
        <?php if (!empty($feedback)) : ?>
          <p style="color:red"><?php echo $feedback; ?></p>
        <?php endif; ?>
        <form method="POST">
          <input type="hidden" name="correct_answer"
                value="<?php echo htmlspecialchars($riddles[$current]['answer']); ?>">
          <input type="text" name="answer" placeholder="Your answer">
          <button type="submit">Submit</button>
        </form>
      <?php else : ?>
        
        <p>You solved all the riddles! 🎉</p>
        <a href="room_2.php">Next room</a>
        <?php $_SESSION['current_riddle'] = 0; ?>
      <?php endif; ?>
    </div>
  </div>


</body>

</html>
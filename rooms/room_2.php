<?php
session_start();
require_once('../dbcon.php');
require_once('timer_functions.php');

// timer
define('ROOM_DURATION_SECONDS', 10 * 60);

if (!isset($_SESSION['current_riddle'])) {
    $_SESSION['current_riddle'] = 0;
}

$team = null;
if (isset($_SESSION['user_id'])) {
    $team = getUserTeam($db_connection, $_SESSION['user_id']);
}

if ($team !== null) {

    if ($team['status'] === 'lost') {
        header('Location: ../lose.php');
        exit;
    }

    startRoomTimerIfNeeded($db_connection, $team['teamId'], 'room2StartTime');

    // Team refresh for room1starttime
    $team = getUserTeam($db_connection, $_SESSION['user_id']);

    if (isRoomTimeUp($team['room2StartTime'], ROOM_DURATION_SECONDS)) {
        markTeamLost($db_connection, $team['teamId']);
        header('Location: ../lose.php');
        exit;
    }
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

$stmt   = $db_connection->query("SELECT * FROM riddles WHERE roomId = 2 ORDER BY id");
$riddles = $stmt->fetchAll(PDO::FETCH_ASSOC);
$current = $_SESSION['current_riddle'];

if ($team !== null && $current >= count($riddles)) {
    markTeamWon($db_connection, $team['teamId'], $team['room1StartTime'] ?? $team['room2StartTime']);
}

$teamName    = ($team !== null) ? $team['teamName'] : null;
$deadlineIso = ($team !== null && $current < count($riddles))
    ? getRoomDeadlineIso($team['room2StartTime'], ROOM_DURATION_SECONDS)
    : null;
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

  <?php if ($teamName !== null) : ?>
    <p class="team-badge">Team: <?php echo htmlspecialchars($teamName); ?></p>
  <?php endif; ?>

  <?php if ($deadlineIso !== null) : ?>
    <p class="timer-badge" id="timer-badge">--:--</p>
  <?php endif; ?>

  <div class="div1">
    <img src="../images/parchment.png" class="img1">
    <div class="parchment-content">
      <?php if ($current < count($riddles)) : ?>
        <p class="maintext"><strong>Riddle <?php echo $current + 1; ?></strong></p>
        <h1 class="maintext"><?php echo htmlspecialchars($riddles[$current]['riddle']); ?></h1>
        <?php if (!empty($feedback)) : ?>
          <p style="color:red"><?php echo htmlspecialchars($feedback); ?></p>
        <?php endif; ?>
        <form method="POST" id="answer-form">
          <input type="hidden" name="correct_answer"
                value="<?php echo htmlspecialchars($riddles[$current]['answer']); ?>">
          <input type="text" name="answer" placeholder="Your answer">
          <button type="submit">Submit</button>
        </form>
      <?php else : ?>
        <p><a href="../">You solved all the riddles! 🎉</a></p>
      <?php endif; ?>
    </div>
  </div>

  <?php if ($deadlineIso !== null) : ?>
  <script>
    (function () {
      const deadline = new Date("<?php echo $deadlineIso; ?>").getTime();
      const badge = document.getElementById('timer-badge');
      const form = document.getElementById('answer-form');

      function tick() {
        const remainingMs = deadline - Date.now();

        if (remainingMs <= 0) {
          badge.textContent = "00:00";
          if (form) {
            form.querySelectorAll('input, button').forEach(function (el) {
              el.disabled = true;
            });
          }
          window.location.href = '../lose.php';
          return;
        }

        const totalSeconds = Math.floor(remainingMs / 1000);
        const minutes = Math.floor(totalSeconds / 60);
        const seconds = totalSeconds % 60;
        badge.textContent = String(minutes).padStart(2, '0') + ':' + String(seconds).padStart(2, '0');

        setTimeout(tick, 1000);
      }

      tick();
    })();
  </script>
  <?php endif; ?>

</body>

</html>
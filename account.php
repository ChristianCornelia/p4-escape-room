<?php
// auteur: Simon
// functie: account pagina - bekijk teams en wijzig eigen team

session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ./login.php');
    exit;
}

require_once 'functions_account.php';

$conn = connectDb();
$userId = $_SESSION['user_id'];
$message = '';

// Verwerk team-wijziging
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['btn_switch_team'])) {
    $newTeamId = $_POST['teamId'];

    // Leeg veld betekent: geen team
    $newTeamId = ($newTeamId === '') ? null : (int)$newTeamId;

    if (switchUserTeam($conn, $userId, $newTeamId)) {
        $message = 'Je team is bijgewerkt.';
    } else {
        $message = 'Het is niet gelukt om je team bij te werken.';
    }
}

// Haal actuele gebruiker en alle teams op
$user = getUserById($conn, $userId);
$teams = getAllTeams($conn);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mijn account - Escape Room</title>
  <link rel="stylesheet" href="./css/home/style.css">
  <link rel="stylesheet" href="./css/account/style.css">
</head>

<body>
<nav>
  <h1>Devil's Acre</h1>
  <a href="./index.php" class="login-btn">Home</a>
  <a href="./help.php" class="login-btn">Help</a>
  <?php
    $is_admin = isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    if ($is_admin) {
        echo '  <a href="./beheer.php" class="login-btn">beheer</a>';
    }
  ?>
  <a href="./logout.php" class="login-btn">logout</a>
</nav>

  <div class="account-wrap">

    <h1 class="account-title">Mijn account</h1>

    <?php if ($message !== ''): ?>
      <p class="account-message"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <section class="account-card">
      <h2>Gegevens</h2>
      <p><strong>Gebruikersnaam:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
      <p><strong>Huidig team:</strong>
        <?php
          if ($user['teamId'] !== null) {
              $currentTeam = getTeamById($conn, $user['teamId']);
              echo $currentTeam ? htmlspecialchars($currentTeam['teamName']) : 'Onbekend team';
          } else {
              echo 'Geen team';
          }
        ?>
      </p>
    </section>

    <section class="account-card">
      <h2>Wissel van team</h2>
      <form method="post">
        <label for="teamId">Kies een team:</label><br>
        <select id="teamId" name="teamId">
          <option value="">-- Geen team --</option>
          <?php foreach ($teams as $team): ?>
            <option value="<?php echo htmlspecialchars($team['id']); ?>"
              <?php echo ($user['teamId'] !== null && (int)$user['teamId'] === (int)$team['id']) ? 'selected' : ''; ?>>
              <?php echo htmlspecialchars($team['teamName']); ?>
            </option>
          <?php endforeach; ?>
        </select><br><br>
        <input type="submit" name="btn_switch_team" value="Wissel team" class="login-btn account-btn">
      </form>
    </section>

    <section class="account-card">
      <h2>Alle teams</h2>
      <?php if (count($teams) === 0): ?>
        <p>Er zijn nog geen teams aangemaakt.</p>
      <?php else: ?>
        <table class="team-table">
          <tr>
            <th>Teamnaam</th>
            <th>Starttijd</th>
            <th>Eindtijd</th>
            <th>Tijd (sec)</th>
          </tr>
          <?php foreach ($teams as $team): ?>
            <tr>
              <td><?php echo htmlspecialchars($team['teamName']); ?></td>
              <td><?php echo $team['startTime'] !== null ? htmlspecialchars($team['startTime']) : '-'; ?></td>
              <td><?php echo $team['finishTime'] !== null ? htmlspecialchars($team['finishTime']) : '-'; ?></td>
              <td><?php echo $team['completionTimeSeconds'] !== null ? htmlspecialchars($team['completionTimeSeconds']) : '-'; ?></td>
            </tr>
          <?php endforeach; ?>
        </table>
      <?php endif; ?>
    </section>

  </div>

</body>
</html>

<?php
    include 'functions.php';
register();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registratie</title>
</head>
<body>
    <h2>Registratie</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Gebruikersnaam:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Wachtwoord: </label><br>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Registreren</button> 
    </form>
<br>
<p>Heb je al een account? <a href="login.php">Inloggen</a></p>
</body>
</html>
<?php
    include 'functions.php';
login();
?>

<!DOCTYPE html>
<html lang="nl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inloggen</title>
</head>
<body>
    <h2>Inloggen</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="username">Gebruikersnaam:</label><br>
        <input type="text" id="username" name="username" required><br><br>
        <label for="password">Wachtwoord: </label><br>
        <input type="password" id="password" name="password" required><br><br>
        <button type="submit">Inloggen</button>
    </form>
<br>
<p>Nog geen account? <a href="register.php">Registreren</a></p>
</body>
</html>
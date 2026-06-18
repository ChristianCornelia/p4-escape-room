<?php
require_once('dbcon.php');

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = $db_connection->query($sql);

        if ($result->num_rows == 1) {
            $row= $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $username;
                if ($row['admin'] == 1) {
                    $_SESSION['role'] = 'admin';
                    header("Location: index.php");
                }  else {
                    $_SESSION['role'] = 'user';
                    header("Location: index.php");
                    exit();
                }
} else {
echo "Ongeldige gebruikersnaam of wachtwoord.";
}
} else {
echo "Ongeldige gebruikersnaam of wachtwoord.";
    }
}
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
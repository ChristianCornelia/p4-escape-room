<?php

function login() {
    include_once 'dbcon.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $_POST['username'];
        $password = $_POST['password'];
        $sql = "SELECT * FROM users WHERE username='$username'";
        $query = $db_connection->query($sql);

        if($query->rowCount() == 1){
            $row = $query->fetch();
            if (password_verify($password, $row['passwordHash'])) {
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
}


function register() {
    include_once 'dbcon.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
$username = $_POST['username'];
$password = $_POST['password'];
$check_sql = "SELECT * FROM users WHERE username='$username'";
$check_result = $db_connection->query($check_sql);
    if ($check_result->rowCount() > 0) {
    echo "Gebruikersnaam is al in gebruik.";
} else {
    $hashed_password = password_hash ($password, PASSWORD_DEFAULT);
    $insert_sql = "INSERT INTO users (username, passwordHash) VALUES ('$username', '$hashed_password')";
if ($db_connection->query($insert_sql) === TRUE) {
    echo "Registratie succesvol!";
} else {
echo "Fout bij registratie:";

        } 
    } 
} 
}
?>
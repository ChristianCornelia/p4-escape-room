<?php
// auteur: Simon
// functie: helper functies voor account.php

define("DATABASE", "escape-room");
define("SERVERNAME", "localhost");
define("USERNAME", "root");
define("PASSWORD", "");

function connectDb(){
    $servername = SERVERNAME;
    $username = USERNAME;
    $password = PASSWORD;
    $dbname = DATABASE;

    try {
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
        return $conn;
    }
    catch(PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
    }
}

// Haal 1 gebruiker op via id
function getUserById($conn, $id){
    $sql = "SELECT * FROM users WHERE id = :id";
    $query = $conn->prepare($sql);
    $query->execute([':id' => $id]);
    return $query->fetch();
}

// Haal 1 team op via id
function getTeamById($conn, $id){
    $sql = "SELECT * FROM teams WHERE id = :id";
    $query = $conn->prepare($sql);
    $query->execute([':id' => $id]);
    return $query->fetch();
}

// Haal alle teams op, gesorteerd op naam
function getAllTeams($conn){
    $sql = "SELECT * FROM teams ORDER BY teamName ASC";
    $query = $conn->prepare($sql);
    $query->execute();
    return $query->fetchAll();
}

// Wijzig het team van een gebruiker. $teamId mag null zijn (geen team).
function switchUserTeam($conn, $userId, $teamId){
    // Als er een teamId is opgegeven, check of dat team bestaat
    if ($teamId !== null) {
        $team = getTeamById($conn, $teamId);
        if (!$team) {
            return false;
        }
    }

    $sql = "UPDATE users SET teamId = :teamId WHERE id = :id";
    $stmt = $conn->prepare($sql);
    $stmt->execute([
        ':teamId' => $teamId,
        ':id' => $userId
    ]);

    return true;
}
?>

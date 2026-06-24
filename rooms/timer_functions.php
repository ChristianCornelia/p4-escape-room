<?php
// auteur: Simon
// functie: helper functies voor per-kamer timers en team status

// Haal teamId en teamName op voor de ingelogde gebruiker, of null als er geen team is
function getUserTeam($db_connection, $userId){
    $stmt = $db_connection->prepare(
        "SELECT teams.id AS teamId, teams.teamName AS teamName, teams.status AS status,
                teams.room1StartTime AS room1StartTime, teams.room2StartTime AS room2StartTime
         FROM users
         LEFT JOIN teams ON users.teamId = teams.id
         WHERE users.id = :id"
    );
    $stmt->execute([':id' => $userId]);
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$row || $row['teamId'] === null) {
        return null;
    }
    return $row;
}

// Zet de starttijd van een specifieke kamer, maar alleen als die nog niet gezet is
function startRoomTimerIfNeeded($db_connection, $teamId, $roomColumn){
    // $roomColumn moet 'room1StartTime' of 'room2StartTime' zijn (geen user input)
    $allowed = ['room1StartTime', 'room2StartTime'];
    if (!in_array($roomColumn, $allowed, true)) {
        return;
    }

    $sql = "UPDATE teams SET $roomColumn = NOW() WHERE id = :id AND $roomColumn IS NULL";
    $stmt = $db_connection->prepare($sql);
    $stmt->execute([':id' => $teamId]);
}

// Check of de tijd voor deze kamer al voorbij is, gebaseerd op starttijd + duur
function isRoomTimeUp($roomStartTime, $durationSeconds){
    if ($roomStartTime === null) {
        return false;
    }
    $deadline = strtotime($roomStartTime) + $durationSeconds;
    return time() >= $deadline;
}

// Geef het deadline-tijdstip terug in ISO 8601, voor gebruik in JavaScript
function getRoomDeadlineIso($roomStartTime, $durationSeconds){
    if ($roomStartTime === null) {
        return null;
    }
    $deadline = strtotime($roomStartTime) + $durationSeconds;
    return date('c', $deadline);
}

// Markeer een team als verloren, behalve als het al gewonnen heeft
function markTeamLost($db_connection, $teamId){
    $stmt = $db_connection->prepare(
        "UPDATE teams SET status = 'lost' WHERE id = :id AND status = 'in_progress'"
    );
    $stmt->execute([':id' => $teamId]);
}

// Markeer een team als gewonnen en zet finishTime / completionTimeSeconds
function markTeamWon($db_connection, $teamId, $overallStartTime){
    $completionSeconds = null;
    if ($overallStartTime !== null) {
        $completionSeconds = time() - strtotime($overallStartTime);
    }

    $stmt = $db_connection->prepare(
        "UPDATE teams
         SET status = 'won', finishTime = NOW(), completionTimeSeconds = :completionSeconds
         WHERE id = :id AND status = 'in_progress'"
    );
    $stmt->execute([
        ':completionSeconds' => $completionSeconds,
        ':id' => $teamId
    ]);
}
?>

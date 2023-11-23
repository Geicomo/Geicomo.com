<?php
function displayUserData() {
    // Read data from leaderboard.txt
    $data = file_get_contents("leaderboard.txt");

    // Explode data into an array of user records
    $userRecords = explode("\n", trim($data));

    // Create an array to store user scores
    $userScores = [];

    foreach ($userRecords as $record) {
        list($username, $score, $userScore) = explode(",", $record);
        $userScores[$username] = (int)str_replace('Highest: ', '', $userScore);
    }

    // Sort the user scores in descending order based on scores
    arsort($userScores);

    foreach ($userScores as $username => $highestScore) {
        echo "Username: $username, Highest-Score: $highestScore<br>";
    }
}

// Display user data from leaderboard.txt sorted by highest score
displayUserData();
?>


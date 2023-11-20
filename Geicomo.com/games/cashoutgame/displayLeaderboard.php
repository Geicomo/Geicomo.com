<?php
// Function to display user data from hash.xml sorted by score
function displayUserData() {
    // Read data from hash.xml
    $data = file_get_contents("../data/hash.xml");

    // Explode data into an array of user records
    $userRecords = explode("\n", trim($data));

    // Create an array to store user scores
    $userScores = [];

    foreach ($userRecords as $record) {
        list($username, $none1, $none2, $none3, $score) = explode(",", $record);
        $userScores[$username] = (int)$score;
    }

    // Sort the user scores in descending order based on scores
    arsort($userScores);

    foreach ($userScores as $username => $score) {
        echo "Username: $username, Score: $score<br>";
    }
}

// Display user data from hash.xml sorted by score
displayUserData();
?>


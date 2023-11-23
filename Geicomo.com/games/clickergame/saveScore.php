<?php
// Start the session
session_start();

if(isset($_POST['score']) && isset($_SESSION['username'])) {
    // Get the posted score and session username
    $score = $_POST['score'];
    $username = $_SESSION['username'];

$data = "$username,$score"; // Initial data

// Set the file path
$file = 'leaderboard.txt';

// Read the existing content of the file
$lines = file($file, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

// Extract and update the highest score
$highestScore = 0;
$userFound = false;

foreach ($lines as $key => $line) {
    $userData = explode(',', $line);

    if ($userData[0] === $username) {
        // Update the user's line with the current score and highest score
        $userScore = (int)$userData[1]; // Assuming score is the second element in the line
        $lines[$key] = "$username,$score,$userScore"; // Update the line
        $userFound = true;
    }

    $userScore = (int)$userData[1]; // Assuming score is the second element in the line

    // Update the highest score if a higher score is found
    if ($userScore > $highestScore) {
        $highestScore = $userScore;
    }
}

// If user was not found, add a new line for the user with current score and highest score
if (!$userFound) {
    $lines[] = "$username,$score,$score";
}

// Write the updated content back to the file without adding an extra newline
file_put_contents($file, implode("\n", $lines));


// v Writing hash  data v






    // File where user data is stored
    $file = '../../data/hash.xml';

    // Read the file and update the score for the matching username
    $lines = file($file);
    $updatedLines = [];

    foreach ($lines as $index => $line) {
        $user = explode(',', $line);

        // Check if the username matches
        if ($user[0] === $username) {
            // Update the score for the matching username
            $user[4] = $score;

            // Join the array elements back into a line
            $updatedLines[$index] = implode(',', $user);
        } else {
            // Keep lines for other users unchanged
            $updatedLines[$index] = $line;
        }
    }

    // Write the updated content back to the file
    file_put_contents($file, implode('', $updatedLines));

    echo "Score updated successfully!";


}

?>

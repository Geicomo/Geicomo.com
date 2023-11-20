<?php
session_start();


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the username and score from the POST request
    $username = $_SESSION['username'];
    $scoreValue = $_POST["score"];

    // File where user data is stored
    $file = '../../data/hash.xml';

    // Read the file and update the score for the matching username
    $lines = file($file);
    $updatedLines = [];

    foreach ($lines as $line) {
        $user = explode(',', $line);

        // Check if the username matches
        if ($user[0] === $username) {
            // Update the score for the matching username
            $user[4] = $scoreValue . PHP_EOL; // Assuming score is the 5th element

            // Join the array elements back into a line
            $line = implode(',', $user);
        }

        // Add the line to the updated lines array
        $updatedLines[] = $line;
    }

    // Write the updated content back to the file
    file_put_contents($file, implode('', $updatedLines));

    echo "Score updated successfully!";
}
?>

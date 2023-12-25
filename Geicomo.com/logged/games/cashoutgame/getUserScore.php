<?php
// Start a session
session_start();

// Check if the user is logged in
$isValidLogin = isset($_SESSION['authorized']) && $_SESSION['authorized'] === true;

if ($isValidLogin) {
    // Get the username from the session
    $username = $_SESSION['username'];

    // File where user data is stored
    $file = '../data/hash.xml';

    // Read the file to find the user's score
    $lines = file($file);

    foreach ($lines as $line) {
        $user = explode(',', $line);

        // Check if the username matches
        if ($user[0] === $username) {
            // Output the user's score (assuming score is the 5th element)
            echo $user[4];
            exit(); // Stop further processing
        }
    }

    // If the username was not found or there's an issue, output a default score (0)
    echo '0';
} else {
    echo 'User not logged in';
}
?>


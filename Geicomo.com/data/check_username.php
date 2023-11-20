<?php
// Function to check if a username exists in the text file
function isUsernameUnique($inputUsername) {
    $filename = 'hash.xml';
    $lines = file($filename, FILE_IGNORE_NEW_LINES);

    foreach ($lines as $line) {
        // Split each line by commas and get the first string (username)
        $parts = explode(',', $line);
        $username = trim($parts[0]);

        if ($inputUsername === $username) {
            return false;
        }
    }

    return true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $inputUsername = $_POST['username'];
    $isUnique = isUsernameUnique($inputUsername);

    if ($isUnique) {
        echo "Username is unique!";
    } else {
        echo "Username already exists!";
    }
}
?>

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Read the contents of the hash.txt file
    $hashFile = file_get_contents("hash.xml");

    if ($hashFile === false) {
        die("Error reading the hash file.");
    }

    // Split the contents of the hash.txt file into an array of lines
    $lines = explode(PHP_EOL, $hashFile);

    // Initialize variables to store the found hash and salt
    $foundHash = null;
    $foundSalt = null;
    // Initialize a variable to store the found username for debugging
    $foundUsername = null;

    // Initialize variables to store the user input for debugging
    $inputUsername = null;
    $inputPassword = null;

    // Iterate through each line to find the matching username
    foreach ($lines as $line) {
        list($storedUsername, $storedHash, $storedSalt) = explode(",", $line);

        if ($username === trim($storedUsername)) {
            $foundUsername = $storedUsername;
            $foundHash = $storedHash;
            $foundSalt = $storedSalt;
            break; // Exit the loop when a matching username is found
        }
    }

    if ($foundHash === null || $foundSalt === null) {
                echo '<div class="box">';
                echo "<h1>403 Forbidden </h1>";
                echo "<p><i>Login failed. Please check your username and password.     </i>";
                echo '<input style="padding:5px" type="button" value="Back" onclick="history.back()">';
                echo '</div>';
    } else {
        // Generate a hash of the provided password with the found salt
        $saltedPassword = trim($password) . trim($foundSalt);
        $hashedPassword = hash("sha256", $saltedPassword);

        // Compare the generated hash with the found hash
        $isValidLogin = false;

        if (trim($hashedPassword) === trim($foundHash)) {
	    $isValidLogin = true;
            $_SESSION['username'] = $storedUsername;
            $_SESSION['authorized'] = true;
            header("Location: ../stat.php?login=" . ($isValidLogin ? "success" : "fail"));
            exit;
        } else {
                echo '<div class="box">';
                echo "<h1>403 Forbidden </h1>";
                echo "<p><i>Login failed. Please check your password.     </i>";
                echo '<input style="padding:5px" type="button" value="Back" onclick="history.back()">';
                echo '</div>';
        }
    }
}
?>

<?php
session_start();

// Check if it's a valid login and retrieve username
$isValidLogin = isset($_SESSION['authorized']) && $_SESSION['authorized'] === true;
$username = $isValidLogin ? $_SESSION['username'] : '';

// Get the hashed password and salt from the JavaScript POST request
$hashedPassword = $_POST['hashedPassword']; // Assuming this is how you receive hashedPassword from JavaScript
$salt = $_POST['salt']; // Assuming this is how you receive salt from JavaScript

// Load JSON file
$jsonFile = '../data.json';
$jsonData = json_decode(file_get_contents($jsonFile), true);

// Check if the user exists in the JSON data and update password and salt
if (isset($jsonData[$username])) {
    $jsonData[$username]['password'] = $hashedPassword;
    $jsonData[$username]['salt'] = $salt;

    // Save updated JSON data back to the file
    file_put_contents($jsonFile, json_encode($jsonData, JSON_PRETTY_PRINT));

    // Respond with a success message
    echo "Password updated successfully for user: $username";
} else {
    // Handle the case where the user does not exist
    echo "User not found";
}
?>


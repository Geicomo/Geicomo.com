<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["message"])) {
    // Get the message from the POST data
    $message = $_POST["message"];
    $username = $_SESSION['username'];

    // Sanitize and prepare the message
    $message = htmlspecialchars($message, ENT_QUOTES, 'UTF-8');

    // Save the message to a text file (chat.txt in this example)
    date_default_timezone_set('America/Los_Angeles');
    $chatFilePath = 'livechat.txt';
    $formattedMessage = date('(m-d-y, h:i a)') . " " . $username . ": " . $message . "\n";

    // Append the new message to the file
    file_put_contents($chatFilePath, $formattedMessage, FILE_APPEND | LOCK_EX);
} else {
    // Respond with an error message
    echo "Message not sent. Please try again.";
}
?>


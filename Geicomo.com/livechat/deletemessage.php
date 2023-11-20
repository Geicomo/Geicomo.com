<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $index = $_POST['index'];
    $filename = 'chat.txt';

    $lines = file($filename, FILE_IGNORE_NEW_LINES);

    if (isset($lines[$index])) {
        unset($lines[$index]);
        file_put_contents($filename, implode(PHP_EOL, $lines));
        echo 'Success'; // Notify the client that the deletion was successful
    } else {
        http_response_code(400); // Bad request if the index is invalid
        echo 'Error: Invalid index';
    }
}
?>


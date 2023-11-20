<?php
// Read the chat messages from a text file (chat.txt in this example)
$chatFilePath = 'chat.txt';

if (file_exists($chatFilePath)) {
    // Read the chat content from the file
    $chatContent = file_get_contents($chatFilePath);
    echo $chatContent;
} else {
    echo "No messages available.";
}
?>


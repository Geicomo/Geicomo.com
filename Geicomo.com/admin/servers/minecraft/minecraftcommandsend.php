<?php
// Get the command from the POST request
$data = json_decode(file_get_contents('php://input'), true);
$command = $data['mccommand'];

// Construct the full screen command
$fullCommand = "sudo -u minecraft screen -S Minecraft -X stuff \"$command$(printf '\\r')\"";

// Execute the command using shell_exec
$output = shell_exec($fullCommand);

// You can handle the response as needed
if ($output !== null) {
    echo "Command sent successfully: $command";
} else {
    echo "Failed to send the command: $command";
}
?>


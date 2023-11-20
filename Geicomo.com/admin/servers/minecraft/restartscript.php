<?php
// Run the script in the Minecraft user's directory
$output = shell_exec('./mcrestart.sh');
echo $output; // This will return the output of the script execution (if any)
?>

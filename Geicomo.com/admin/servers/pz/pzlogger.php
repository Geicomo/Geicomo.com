<?php
$logFilePath = '/home/pzserver/pzserver/pzserverlog'; // Update the path

if (file_exists($logFilePath)) {
    $logData = file_get_contents($logFilePath);
    echo $logData;
} else {
    echo 'Log file not found';
}
?>

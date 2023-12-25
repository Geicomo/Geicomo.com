<?php
// File paths
$sourceFile = '/var/www/html/logged/games/clickergame/data.json';
$targetFile = '/var/www/html/data/data.json';
$timeStamp = date('d-m-Y');
$backupFile = "/var/www/html/logged/games/clickergame/backups/{$timeStamp}-pointsbackup.json";

// Create a backup of the JSON file
if (!copy($sourceFile, $backupFile)) {
    echo "Failed to create a backup of the data.\n";
    exit;
} else {
	echo "Backup created " . "{$backupFile}\n";
}

// Read the source JSON file for highscores
$sourceJsonString = file_get_contents($sourceFile);
$sourceData = json_decode($sourceJsonString, true);

if ($sourceData === null) {
    echo "Failed to decode source JSON\n";
    exit;
}

// Points to be awarded
$pointsForRank = [25, 10, 5];

// Sort and get the top 3 users by highscore
uasort($sourceData, function ($a, $b) {
    return $b['highscore'] - $a['highscore'];
});

$topUsers = array_slice($sourceData, 0, 3, true);

// Read the target JSON file to update points
$targetJsonString = file_get_contents($targetFile);
$targetData = json_decode($targetJsonString, true);

if ($targetData === null) {
    echo "Failed to decode target JSON\n";
    exit;
}

// Update points for the top 3 users in the target data
$i = 0;
foreach ($topUsers as $username => $userDetails) {
    if (isset($targetData[$username])) {
        $targetData[$username]['points'] += $pointsForRank[$i];
    	echo "User: $username, New Points: {$targetData[$username]['points']}\n";
    }
    $i++;
}

// Save the updated target data back to the JSON file
file_put_contents($targetFile, json_encode($targetData, JSON_PRETTY_PRINT));

echo "Deleting data.json in 5 seconds...\n";

sleep(5);

file_put_contents($sourceFile, json_encode([], JSON_PRETTY_PRINT));

echo "Top 3 users' points updated in the target file successfully & data.json wiped.";
?>


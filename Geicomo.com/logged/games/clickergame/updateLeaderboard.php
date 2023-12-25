<?php
$leaderboardFile = 'data.json';

function generateLeaderboardHTML($file) {
    $output = '';

    if (file_exists($file) && is_readable($file)) {
        $leaderboardData = file_get_contents($file);
        $decodedData = json_decode($leaderboardData, true);

        if ($decodedData !== null) {
            // Sorting the data based on the 'score' in descending order
            uasort($decodedData, function($a, $b) {
                return $b['highscore'] - $a['highscore'];
            });

            foreach ($decodedData as $username => $userData) {
                $output .= "<div class='scoretext'>{$username}: Score - {$userData['score']}, High Score - {$userData['highscore']}</div>";
            }
        } else {
            $output .= "<div>Error: Invalid JSON data</div>";
        }
    } else {
        $output .= "<div>Error: Leaderboard file not found or unreadable</div>";
    }

    return $output;
}

echo generateLeaderboardHTML($leaderboardFile);
?>


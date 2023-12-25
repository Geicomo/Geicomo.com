<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Get the username and score from the request
    $username = $data['username'];
    $score = $data['score'];

    // Read the existing JSON file
    $file = 'data.json';
    $jsonString = file_get_contents($file);
    $jsonData = json_decode($jsonString, true);

    // If the user exists, update their score
    if (isset($jsonData[$username])) {
        if ($score > $jsonData[$username]['highscore']) {
            $jsonData[$username]['highscore'] = $score;
        }
        $jsonData[$username]['score'] = $score;
    } else {
        // If the user doesn't exist, create a new entry for the user
        $jsonData[$username] = [
            'score' => $score,
	    'highscore' => $score,
        ];
    }

    // Update the global highscore
    $globalHighscore = max(array_column($jsonData, 'highscore'));

    // Save the updated data back to the JSON file
    file_put_contents($file, json_encode($jsonData, JSON_PRETTY_PRINT));

    // Respond with a success message
    echo json_encode(['message' => 'Score updated successfully', 'globalHighscore' => $globalHighscore]);
} else {
    // If the request method is not POST, respond with an error
    http_response_code(405);
    echo json_encode(['error' => 'Method Not Allowed']);
}
?>


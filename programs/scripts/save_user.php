<?php
session_start();

// Set JSON response headers and enable output buffering
header('Content-Type: application/json');
ob_start();

// Path to the user database (JSON file)
$userDatabaseFile = 'users.json';

// Initialize the database file if it doesn't exist
if (!file_exists($userDatabaseFile)) {
    file_put_contents($userDatabaseFile, json_encode([]));
}

// Read and decode the database
$userDatabase = json_decode(file_get_contents($userDatabaseFile), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Decode incoming JSON data
    $input = json_decode(file_get_contents('php://input'), true);
    $score = intval($input['score'] ?? 0);

    // Check if the user is logged in
    $loggedInUser = $_SESSION['username'] ?? null;
    error_log('Logged-in user: ' . ($loggedInUser ?? 'none'));

    if ($loggedInUser && isset($userDatabase[$loggedInUser])) {

        // Update score
        $userDatabase[$loggedInUser]['score'] += $score;

        // Write updated data to file
        if (!file_put_contents($userDatabaseFile, json_encode($userDatabase, JSON_PRETTY_PRINT))) {
            error_log('Error writing to users.json');
        }

        // Clear output buffer and send JSON response
        ob_end_clean();
        echo json_encode(['status' => 'success', 'message' => 'Score added successfully for ' . $loggedInUser]);
        exit;
    }

    // Manual score saving process
    $name = $input['name'] ?? '';
    $password = $input['password'] ?? '';

    if (empty($name) || empty($password)) {
        ob_end_clean();
        http_response_code(400);
        echo json_encode(['status' => 'error', 'message' => 'Name and password are required.']);
        exit;
    }

    if (isset($userDatabase[$name])) {
        // User exists, verify password
        if (password_verify($password, $userDatabase[$name]['password'])) {
           
            // Update score
            $userDatabase[$name]['score'] += $score;

            // Write updated data to file
            if (!file_put_contents($userDatabaseFile, json_encode($userDatabase, JSON_PRETTY_PRINT))) {
                error_log('Error writing to users.json');
            }

            ob_end_clean();
            echo json_encode(['status' => 'success', 'message' => 'Score added successfully.']);
            exit;
        } else {
            ob_end_clean();
            http_response_code(403);
            echo json_encode(['status' => 'error', 'message' => 'Invalid password/Username taken.']);
            exit;
        }
    } else {
        // Create a new user
        $userDatabase[$name] = [
            'password' => password_hash($password, PASSWORD_DEFAULT),
            'score' => $score
        ];

        if (!file_put_contents($userDatabaseFile, json_encode($userDatabase, JSON_PRETTY_PRINT))) {
            error_log('Error writing to users.json');
        }

        ob_end_clean();
        echo json_encode(['status' => 'success', 'message' => 'Account created and score saved.']);
        exit;
    }
} else {
    ob_end_clean();
    http_response_code(405);
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method.']);
}


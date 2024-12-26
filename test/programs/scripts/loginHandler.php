<?php
// Load user data from JSON file
$userData = json_decode(file_get_contents('users.json'), true);

// Initialize response
$response = ['status' => 'error', 'message' => 'Invalid username or password.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $username = $input['username'] ?? '';
    $password = $input['password'] ?? '';

    // Validate user
    if (isset($userData[$username])) {
        $storedHash = $userData[$username]['password'];
        if (password_verify($password, $storedHash)) {
            $response['status'] = 'success';
            $response['message'] = 'Login successful.';
            $response['username'] = $username; // Include username in response
        }
    }
}

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);


<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $newEmail = filter_input(INPUT_POST, 'newEmail', FILTER_SANITIZE_EMAIL);

    if (!empty($newEmail)) {
        $dataFile = '../data.json';
        $data = json_decode(file_get_contents($dataFile), true);
        $currentUser = $_SESSION['username']; // Get the current logged-in username

        // Check if the email is already used by another user
        foreach ($data as $username => $userInfo) {
            if ($username != $currentUser && isset($userInfo['email']) && $userInfo['email'] == $newEmail) {
                http_response_code(409); // Conflict
                echo json_encode(['message' => 'Email already in use by another user.']);
                exit;
            }
        }

        if (isset($data[$currentUser])) {
            $data[$currentUser]['email'] = $newEmail;

            // Save updated JSON data back to the file
            file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));

            // Return a success response
            echo json_encode(['message' => 'Email updated successfully for ' . htmlspecialchars($currentUser)]);
        } else {
            // Handle case where current user is not found
            http_response_code(404); // Not Found
            echo json_encode(['message' => 'Current user not found.']);
        }
    } else {
        // Return a response indicating empty email
        http_response_code(400); // Bad request
        echo json_encode(['message' => 'Empty email provided.']);
    }
} else {
    // Return a response for incorrect request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(['message' => 'Method Not Allowed.']);
}
?>


<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize the new username from POST data
    $newUsername = filter_input(INPUT_POST, 'newUsername', FILTER_SANITIZE_STRING);

    if (!empty($newUsername)) {
        $dataFile = '/var/www/data.json';
        $data = json_decode(file_get_contents($dataFile), true);

        // Check if the new username already exists
        if (isset($data[$newUsername])) {
            // Return a response indicating the username is taken
            echo json_encode(array('message' => htmlspecialchars('Username already taken, please choose a different one.')));
        } else {
            // Update the username in the data.json file
            $currentUser = $_SESSION['username']; // Get the current logged-in username

            // Assign current user data to new username and remove the old username
            if (isset($data[$currentUser])) {
                $data[$newUsername] = $data[$currentUser];
                $data[$newUsername]['username'] = $newUsername; // Update the username inside the user's data
                unset($data[$currentUser]);

                $_SESSION['username'] = $newUsername; // Update the session username

                // Save updated JSON data back to the file
                file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));

                // Return a success response
                echo json_encode(array('message' => htmlspecialchars('Username updated successfully!')));
            } else {
                // Handle case where current user is not found
                http_response_code(404); // Not Found
                echo json_encode(array('message' => htmlspecialchars('Current user not found.')));
            }
        }
    } else {
        // Return a response indicating empty username
        http_response_code(400); // Bad request
        echo json_encode(array('message' => htmlspecialchars('Empty username provided.')));
    }
} else {
    // Return a response for incorrect request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('message' => htmlspecialchars('Method Not Allowed.')));
}
?>


<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $newDescription = filter_input(INPUT_POST, 'newDescription', FILTER_SANITIZE_STRING);
	

        if (!empty($newDescription)) {
		$dataFile = '../data.json';
        	$data = json_decode(file_get_contents($dataFile), true);
        	$currentUser = $_SESSION['username']; // Get the current logged-in username
		// Update the description in the data.json file
            if (isset($data[$currentUser])) {
                $data[$currentUser]['description'] = $newDescription;

                // Save updated JSON data back to the file
                file_put_contents($dataFile, json_encode($data, JSON_PRETTY_PRINT));

                // Return a success response
                echo json_encode(array('message' => htmlspecialchars('Description updated successfully!')));
            } else {
                // Handle case where current user is not found
                http_response_code(404); // Not Found
                echo json_encode(array('message' => htmlspecialchars('Current user not found.')));
            }
        } else {
            // Return a response indicating empty description
            http_response_code(400); // Bad request
            echo json_encode(array('message' => htmlspecialchars('Empty description provided.')));
        }
} else {
    // Return a response for incorrect request method
    http_response_code(405); // Method Not Allowed
    echo json_encode(array('message' => htmlspecialchars('Method Not Allowed.')));
}
?>


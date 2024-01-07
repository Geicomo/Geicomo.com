<?php
// Make sure this script is only accessible through a POST request
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('HTTP/1.0 403 Forbidden');
    echo 'You are forbidden!';
    exit;
}

// Function to safely get POST data
function getPostData($key) {
    return isset($_POST[$key]) ? $_POST[$key] : null;
}

// Retrieve data from POST request
$username = getPostData('username');
$darkMode = getPostData('darkmode') === 'true' ? true : false;

// Path to the JSON file
$jsonFile = '/var/www/data.json';

// Read the existing JSON file
$data = json_decode(file_get_contents($jsonFile), true);

// Check if user exists and update the darkmode value
if (isset($data[$username])) {
    $data[$username]['points']['darkmode'] = $darkMode;

    // Write the updated data back to the file
    if (file_put_contents($jsonFile, json_encode($data, JSON_PRETTY_PRINT))) {
        echo json_encode(['success' => true, 'message' => 'Dark mode updated successfully.']);
    } else {
        echo json_encode(['success' => false, 'message' => 'Error writing to JSON file.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'User not found.']);
}

?>


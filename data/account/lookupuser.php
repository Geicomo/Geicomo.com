<?php
// Assuming you have the lookup logic here
// Initialize variables to avoid undefined variable errors
$username = $registrationTime = $lastLogin = $description = $notFoundMessage = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];

    // Load the JSON data
    $data = json_decode(file_get_contents("/var/www/data.json"), true);

    // Check if the username exists in the data
    if (isset($data[$username])) {
        $userInfo = $data[$username];
        $registrationTime = $userInfo["registrationTime"];
        $lastLogin = $userInfo["lastLogin"] ? $userInfo["lastLogin"] : "Never";
        $description = $userInfo["description"];

        echo json_encode([
            'username' => $username,
            'description' => $description,
            'registrationTime' => $registrationTime,
            'lastLogin' => $lastLogin,
        ]);
    } else {
        echo json_encode(['error' => "User not found."]);
    }
    exit;
}
?>


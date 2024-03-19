<?php
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
    } else {
        $notFoundMessage = "User not found.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Lookup</title>
</head>
<body>

<h2>Profile Lookup</h2>

<form id="lookupForm">
    <label for="username">Enter Username:</label>
    <input type="text" id="username" name="username" required>
    <button type="submit">Lookup</button>
</form>

<div id="userInfo"></div> <!-- Place to display user information -->

<script>
document.getElementById('lookupForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent the form from submitting traditionally

    var formData = new FormData(this);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', 'lookupuser.php', true);
    xhr.onload = function() {
        if (this.status == 200) {
            var response = JSON.parse(this.response);
            if (response.error) {
                document.getElementById('userInfo').innerHTML = `<p>${response.error}</p>`;
            } else {
                document.getElementById('userInfo').innerHTML = `
                    <p><strong>Username:</strong> ${response.username}</p>
                    <p><strong>Registration Time:</strong> ${response.registrationTime}</p>
                    <p><strong>Last Login:</strong> ${response.lastLogin}</p>
                    <p><strong>Description:</strong> ${response.description}</p>
                `;
            }
        }
    };
    xhr.send(formData);
});
</script>

</body>
</html>

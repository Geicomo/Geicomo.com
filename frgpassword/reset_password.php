<?php
// Path to your JSON file
$jsonFilePath = '/var/www/data.json';


function generateRandomSalt($length = 6) {
    return substr(str_replace('+', '.', base64_encode(random_bytes($length))), 0, $length);
}

// Function to check if the token is valid
function isTokenValid($username, $token, $jsonFilePath) {
    $jsonData = json_decode(file_get_contents($jsonFilePath), true);

    if (isset($jsonData[$username])) {
        $user = $jsonData[$username];
        if ($user['resetToken'] === $token && new DateTime() < new DateTime($user['tokenExpiration'])) {
            return true;
        }
    }
    return false;
}

// Function to update the password in the JSON file
function updatePassword($username, $newPassword, $jsonFilePath) {
    $jsonData = json_decode(file_get_contents($jsonFilePath), true);
    $salt = generateRandomSalt(); // Assuming this function exists
    $hashedPassword = hash('sha256', $newPassword . $salt);

    $jsonData[$username]['password'] = $hashedPassword;
    $jsonData[$username]['salt'] = $salt;
    unset($jsonData[$username]['resetToken']); // Remove the token
    unset($jsonData[$username]['tokenExpiration']); // Remove the expiration

    file_put_contents($jsonFilePath, json_encode($jsonData, JSON_PRETTY_PRINT));
}

// Variables from URL
$token = $_GET['token'] ?? '';
$username = $_GET['user'] ?? '';


// Check if the token is valid
if (isTokenValid($username, $token, $jsonFilePath)) {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['password']) && isset($_POST['confirm_password'])) {
        $newPassword = $_POST['password'];
        $confirmPassword = $_POST['confirm_password'];

        if ($newPassword === $confirmPassword) {
            updatePassword($username, $newPassword, $jsonFilePath);
            echo "<strong>Password updated successfully.</strong>";
?>
<script>
setTimeout(function() {
            window.location.href = "https://geicomo.com/index.php";
        }, 5000);
</script>
<?php
        } else {
            echo "Passwords do not match.";
        }
    } else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <title>Geic OS</title>
        <meta name="viewport" content="width=device-width, initial-scale=0.7">
        <link rel="stylesheet" type="text/css" href="https://geicomo.com/templates/base.css">
</head>
<style>
.draggable-box {
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>
<body>
<div id="container">
</body>
</html>
        <div id="page1" class="draggable-box">
                <div class="title-bar">reset_password.geic</div>
                <div class="content">
                        <form action="" method="post">
                                <a style="font-weight:bold;font-size:20px;">Passwords must match</a><br><br>
                                <strong>New Password: </strong><input type="password" name="password" required><br>
                                <strong>Confirm Password: </strong><input type="password" name="confirm_password" required><br>
                                <input style="display:flex;align-items:center;justify-content:center;margin-top:3px;font-size:12px;height:25px;width:95px;float:left;background-color:#34b500;" type="submit" value="Reset Password">
                        </form>
<br><br><br><br><br><br><br><br>
                </div>
        </div>
</div>

<div style="position:fixed;bottom:0">
        <a>All content is licensed under </a><a href="https://creativecommons.org/licenses/by-nc/4.0/?ref=chooser-v1 unless otherwise posted.">CC BY-NC 4.0 DEED</a> unless otherwise posted.</a>
</div>
<?php

    }
} else {
    echo "Invalid or expired token.";
}
?>

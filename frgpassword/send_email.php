<?php

// Assuming the form data is sent via POST
$userEmail = $_POST['email'] ?? '';

// Function to check if email exists in JSON data and return the username
function getUserByEmail($email, $jsonFilePath) {
    $jsonData = json_decode(file_get_contents($jsonFilePath), true);

    foreach ($jsonData as $user => $details) {
        if ($details['email'] === $email) {
            return $user;
        }
    }
    return false;
}


// Function to generate a random password
function generateRandomPassword($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomPassword = '';
    for ($i = 0; $i < $length; $i++) {
        $randomPassword .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomPassword;
}

// Function to generate a random salt
function generateRandomSalt($length = 6) {
    return substr(str_replace('+', '.', base64_encode(random_bytes($length))), 0, $length);
}


// Function to generate a unique token
function generateUniqueToken() {
    return bin2hex(random_bytes(16)); // 32 characters
}

// Path to your JSON file
$jsonFilePath = '/var/www/data.json';

// Check if email exists and get username
$username = getUserByEmail($userEmail, $jsonFilePath);

if ($username !== false) {
    // Generate a unique token
    $resetToken = generateUniqueToken();

    // Store the token in JSON data with an expiration time
    $jsonData = json_decode(file_get_contents($jsonFilePath), true);
    $jsonData[$username]['resetToken'] = $resetToken;
    $jsonData[$username]['tokenExpiration'] = date('Y-m-d H:i:s', strtotime('+1 hour')); // Token valid for 1 hour
    file_put_contents($jsonFilePath, json_encode($jsonData, JSON_PRETTY_PRINT));

    // Send email with the reset link
    $resetLink = "https://geicomo.com/frgpassword/reset_password.php?token=" . $resetToken . "&user=" . urlencode($username);
    $subject = '"Geicomo Password Reset"';

    $command = "echo 'Hello $username. \nWe have received a request to reset your password. Please use the link below to set a new password. This link will expire in 1 hour. \n\nReset Link: $resetLink\n\n If you did not request a password reset please email geicomoservices@gmail.com and open a ticket.' | mail -s $subject $userEmail";

    exec($command, $output, $returnVar);
    if ($returnVar == 0) {
	    echo "Password reset link sent successfully to " . htmlspecialchars($userEmail) . ".";
?>
<script>
	    setTimeout(function() {
            window.location.href = "https://geicomo.com/index.php";
	    }, 5000);
</script>
<?php
    } else {
        echo "Failed to send email.";
    }
} else {
    echo "Email address not found in the database.";
}
?>


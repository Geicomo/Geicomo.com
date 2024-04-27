
<?php
session_start();
$isValidLogin = isset($_SESSION['authorized']) && $_SESSION['authorized'] === true;
$username = $isValidLogin ? $_SESSION['username'] : '';
$dataFilePath = '/var/www/data.json';
$message = "";
$registrationTime = $lastLogin = $description = "Not Available"; // Default values

if ($isValidLogin) {
    $data = json_decode(file_get_contents($dataFilePath), true);

    if (isset($data[$username])) {
        $userInfo = $data[$username];
        $registrationTime = $userInfo["registrationTime"];
        $lastLogin = $userInfo["lastLogin"] ? $userInfo["lastLogin"] : "Never logged in";
        $description = $userInfo["description"];
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	    if (isset($_POST['newDescription'])) {
        // Sanitize the description input
        $newDescription = htmlspecialchars(trim($_POST['newDescription']), ENT_QUOTES, 'UTF-8');
        
        if (strlen($newDescription) <= 60) { // Ensure the description is within the character limit
            if (isset($data[$username])) {
                $data[$username]['description'] = $newDescription; // Update sanitized description
                file_put_contents($dataFilePath, json_encode($data, JSON_PRETTY_PRINT));
                $message = "Description updated successfully.";
            } else {
                $message = "User not found.";
            }
        } else {
            $message = "Description exceeds the character limit of 60 characters.";
        }
    } elseif (isset($_POST['newPassword']) && isset($_POST['confirmUsername'])) {
        // Verify the username and update the password
        $newPassword = $_POST['newPassword'];
        $confirmUsername = $_POST['confirmUsername'];

        if ($confirmUsername === $username && isset($data[$username])) {	
		$salt = bin2hex(random_bytes(3));
        	$encryptedNewPassword = hash('sha256', $newPassword . $salt);
		$data[$username]['password'] = $encryptedNewPassword; 
		$data[$username]['salt'] = $salt; 
    		file_put_contents($dataFilePath, json_encode($data, JSON_PRETTY_PRINT));
            $message = "Password updated successfully.";
        } else {
            $message = "Username confirmation failed or user not found.";
        }
    }
	
// Reload user data to reflect any updates
    $data = json_decode(file_get_contents($dataFilePath), true);
    if (isset($data[$username])) {
        $userInfo = $data[$username];
        $registrationTime = $userInfo["registrationTime"];
        $lastLogin = $userInfo["lastLogin"] ? $userInfo["lastLogin"] : "Never logged in";
        $description = $userInfo["description"];
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Geicomos Website | Profile Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=0.6">
    <style>
        .accountinfo {
            min-height: 10vh;
            border: 2px solid rgb(61,61,61);
            border-top: none;
            border-right: none;
            border-left: none;
            background-color: rgb(197,197,197);
        }
    </style>
</head>
<body>

<div class="accountinfo">
    <?php if ($isValidLogin): ?>
        <p>Username: <?php echo htmlspecialchars($username); ?></p>
        <p>Registration Time: <?php echo htmlspecialchars($registrationTime); ?></p>
        <p>Last Login: <?php echo htmlspecialchars($lastLogin); ?></p>
        <p>Description: <?php echo htmlspecialchars($description); ?></p>

        <!-- Form for updating description -->
        <form method="post" action="">
            <label for="newDescription">New Description:</label>
            <input type="text" id="newDescription" name="newDescription" value="<?php echo htmlspecialchars($description); ?>" maxlength="60" required>
            <button type="submit">Update Description</button>
            <p style="font-size:13px;">(60 character max)</p>
        </form>

        <!-- Form for updating password -->
        <form method="post" action="" style="margin-top:5px;">
            <label for="newPassword">New Password:</label>
            <input type="password" id="newPassword" name="newPassword" required><br>
            <label for="confirmUsername">Confirm Username to Change Password:</label>
            <input type="text" id="confirmUsername" name="confirmUsername" required>
            <button type="submit">Change Password</button>
        </form>

        <?php if (!empty($message)): ?>
            <p><?php echo $message; ?></p>
        <?php endif; ?>
    <?php else: ?>
        <p>You must be logged in to update your profile.</p>
    <?php endif; ?>
</div>

<form id="lookupForm">
    <label for="username">Account Search:</label><br>
    <input  type="text" id="username" name="username" required>
    <button type="submit">Lookup</button>
</form>

<div id="userInfo"></div>
<br>

<?php
// Account Search

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

</body>
</html>


<!DOCTYPE html>
<html lang="en">
<head>
	<title>user_info.geic</title>
        <meta name="viewport" content="width=device-width, initial-scale=0.7">
        <link rel="stylesheet" type="text/css" href="https://www.geicomo.com/templates/base.css">
</head>
<body>
<?php
	// Start a session
	session_start();

	// Initialize the $isValidLogin variable
	$isValidLogin = isset($_SESSION['authorized']) && $_SESSION['authorized'] === true;
	$username = $isValidLogin ? $_SESSION['username'] : 'Guest';

	// Path to the JSON file
	$jsonFilePath = '/var/www/data.json';

	// Read the file contents
	$jsonString = file_get_contents($jsonFilePath);

	// Decode the JSON string into an associative array
	$jsonArray = json_decode($jsonString, true);

	// Function to get the last login time for a given username
	function getLastLoginTime($username, $jsonArray) {
	    if (isset($jsonArray[$username]['lastLogin'])) {
	        return $jsonArray[$username]['lastLogin'];
	    } else {
		if ($username === 'Guest') {
			return "No last login time for Guest.";
			exit;
		}
		return "Last login time not found for user: $username";
	    }
	}



?>
<a style="font-size:15px;float:right;"href="https://geicomo.com/help">help.info</a>
<p style="font-size:17px">Welcome: <?php echo "$username" ?> </p>
Last Login:
<?php echo getLastLoginTime($username, $jsonArray); ?>
<br><br>
<a style="font-size:17px;">Live chat messaging:</a><br>
    <input type="text" id="message" placeholder="Type your message" required>
    <button id="send-button">Send</button>
<br>
<?php
if ($_SESSION['authorized']) {
// Check if the logout button was clicked
if (isset($_POST['logout'])) {
    // Unset the authorized session variable to log the user out
    $_SESSION['authorized'] = false;

    // Redirect to the home page after logging out
    echo "<script>window.location.href = 'https://geicomo.com/index.php';</script>";
    exit;
}

// Check if the user is not logged in, then redirect to index.php
if (!$isValidLogin) {
    header("Location: index.php");
    exit;
}
    echo "<form method='post' action=''>";
    echo "<button class='btn' type='submit' name='logout' style='display:flex;align-items:center;justify-content:center;margin-top:12px;font-size:12px;height:25px;width:60px;float:left;background-color:#fda502;'>Logout</button>";
    echo "</form>";
} else {
     echo "<a href='https://geicomo.com/index.php'><button class='btn' style='width:display:flex;align-items:center;justify-content:center;margin-top:12px;font-size:12px;height:25px;width:60px;float:left;background-color:#fda502;'>Login</button></a>";
}
?>
<br><br><br>
<a href="https://geicomo.com/livechat/messageboard.php">chat.info</a>
<br><br><br><br>
<?php include('templates/directory.php');?>
</body>
</html>

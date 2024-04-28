	<title>user_info.geic</title>
<style>
	#chat-element {
		display: none;
	}
</style>

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
<button style="float:right;" class="open-window-button" data-url="https://geicomo.com/help.php">./help.info</button>
<p style="font-size:17px">Welcome: <?php echo "$username" ?> </p>
Last Login:
<?php echo getLastLoginTime($username, $jsonArray); ?>

<br><br>
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



<script> // USERINFO LOOKUP LOGIC
document.getElementById('lookupForm').addEventListener('submit', function(e) {
    e.preventDefault(); // Prevent the form from submitting traditionally

    var formData = new FormData(this);
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '/data/account/lookupuser.php', true);
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

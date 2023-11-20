<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a8e47ed895.js" crossorigin="anonymous"></script>
    <title>Geicomo.com | Admin Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        #sidebar {
            width: 130px;
            background: #333;
	    color: #fff;
	    text-align: center;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
        }

        #content {
            margin-left: 130px;
        }

	#logo {
	    color: #FF5733;
            text-align: center;
        }
        #menu {
            list-style: none;
            padding: 0;
        }

        #menu li {
            margin-bottom: 10px;
        }

        #menu a {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
        }
        #menu a:hover {
            color: #FF5733;
	}
	#user-info {
            position: absolute;
            top: 40px;
            right: 10px;
            color: #fff;
        }
        /* Styling for the header */
	#header {
            background: #333;
            color: #fff;
            padding: 5px 45px;
        }
        /* Styling for the main content area */
        #main-content {
            background: #fff;
            padding: 20px 50px;
        }
    </style>
</head>
<body>
    <div id="sidebar">
        <div id="logo">
		<i class="fa-sharp fa-solid fa-user-secret fa-2xl"></i>
		<strong>Admin Panel</strong>
	</div>
        <ul id="menu">
            <li><i class="fa-sharp fa-solid fa-bars"></i> Dashboard</li>
	    <li><i class="fa-sharp fa-solid fa-box-archive"></i> <a href="adminusers.php">Users</a></li>
	    <li><i class="fa-sharp fa-solid fa-network-wired"></i> <a href="serverinfo.php">Servers</a></li> <br>
	    <li><i class="fa-sharp fa-solid fa-arrow-left"></i> <a href="../stat.php">Back</a></li>
        </ul>
	</div>
	</div>
    <div id="content">
        <div id="header">
	    <h1>Welcome to the Admin Dashboard</h1>
	<div id="user-info">
<?php
	// Start a session
	session_start();

	// Initialize the $isValidLogin variable
	$isValidLogin = isset($_SESSION['authorized']) && $_SESSION['authorized'] === true;
	$username = $isValidLogin ? $_SESSION['username'] : '';
	$isAdmin = $username === "admin";

	if ($isValidLogin && $isAdmin) {
	    echo "<strong> You are logged in as: </strong>" . $username;
	} else {
		header("Location: ../error.php");
    		exit();
	}
?>
</div>
</div>
<div id="main-content">
	<h1>Alerts</h1>
		Soon
	<h1>Log</h1>
		Not as soon
</div>
</body>
</html>

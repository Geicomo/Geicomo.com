<?php
session_start();

// Handle logout action
if (isset($_GET['logout'])) {
    session_destroy();
    header('Location: https://geicomo.com/test/index.php'); // Redirect to the default index.php
    exit;
}

// Load user data
$userData = json_decode(file_get_contents('./scripts/users.json'), true);

// Handle login request (from AJAX)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $input = json_decode(file_get_contents('php://input'), true);
    $username = $input['username'] ?? '';
    $password = $input['password'] ?? '';

    if (isset($userData[$username])) {
        $storedHash = $userData[$username]['password'];
        if (password_verify($password, $storedHash)) {
            $_SESSION['username'] = $username;
            echo json_encode(['status' => 'success', 'message' => 'Login successful.', 'username' => $username]);
            exit;
        }
    }
    echo json_encode(['status' => 'error', 'message' => 'Invalid username or password.']);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ecf0f1;
            color: #2c3e50;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }
        #login-form, #logout-container {
            padding: 20px;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input {
            width: 100%;
            padding: 10px;
            border: 1px solid #bdc3c7;
            border-radius: 5px;
        }
        #login-button, #logout-button {
            width: 100%;
            padding: 10px;
            background-color: #3498db;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        #login-button:hover {
            background-color: #2980b9;
        }
        #logout-button {
            background-color: #e74c3c;
        }
        #logout-button:hover {
            background-color: #c0392b;
        }
        #error-message {
            color: #e74c3c;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <?php if (isset($_SESSION['username'])): ?>
        <!-- Logout Container -->
        <div id="logout-container">
            <h3>Welcome, <?= htmlspecialchars($_SESSION['username']) ?>!</h3>
            <p>You are logged in. Click below to log out.</p>
            <button id="logout-button">Logout</button>
        </div>
    <?php else: ?>
        <!-- Login Form -->
        <form id="login-form">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
	    <button type="button" id="login-button">Enter</button>
	    <a style="font-size:12px;"><i>You can create an account if you do not have one.</i></a> 
            <div id="error-message"></div>
        </form>
    <?php endif; ?>

    	<script>
    // Handle login functionality
if (!document.getElementById('logout-button')) {
    document.getElementById('login-button').addEventListener('click', () => {
        const username = document.getElementById('username').value;
        const password = document.getElementById('password').value;

        fetch('./Login.php', {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ username, password }),
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    // Store the username in sessionStorage
                    sessionStorage.setItem('username', data.username);

                    // Redirect the main window (not the iframe) to the index page
                    window.top.location.href = `https://geicomo.com/test/index.php?username=${encodeURIComponent(data.username)}`;
                } else {
                    document.getElementById('error-message').innerText = data.message;
                }
            })
            .catch(error => {
                console.error('Error:', error);
                document.getElementById('error-message').innerText = 'An error occurred.';
            });
    });
}

// Handle logout functionality
document.getElementById('logout-button')?.addEventListener('click', () => {
    // Clear sessionStorage on logout
    sessionStorage.removeItem('username');

    // Redirect the top-level window to logout
    window.top.location.href = './Login.php?logout=1';
});

	</script>
</body>
</html>


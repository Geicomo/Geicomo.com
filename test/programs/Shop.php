<?php
session_start(); // Start the session

// Check if a user is logged in via session
$currentUser = $_SESSION['username'] ?? null;

// Load user data
$userData = json_decode(file_get_contents('./scripts/users.json'), true);

$isUserLoggedIn = $currentUser && isset($userData[$currentUser]);

// Handle purchase logic
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get POST data
    $request = json_decode(file_get_contents('php://input'), true);
    $itemId = $request['itemId'] ?? '';
    $price = $request['price'] ?? 0;
    $color = $request['color'] ?? ''; // Optional color parameter for customization

    // Initialize response
    $response = ['status' => 'error', 'message' => 'Invalid request.'];

    // Process the purchase for changing background color
    if ($itemId === 'changeBackgroundColor' && $price > 0) {
        $user = $userData[$currentUser];

        // Check if the user has enough points
        if ($user['score'] >= $price) {
            // Deduct points and update the background color
            $userData[$currentUser]['score'] -= $price;
            $userData[$currentUser]['attributes']['background'] = $color;

            // Save updated data
            file_put_contents('./scripts/users.json', json_encode($userData, JSON_PRETTY_PRINT));

            $response['status'] = 'success';
            $response['message'] = 'Purchase successful! Background color changed.';
        } else {
            $response['message'] = 'Not enough points.';
        }
    }

    // Send response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shop</title>
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
            text-align: center;
        }

        #shop-container {
            background: white;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            padding: 20px;
            width: 90%;
            max-width: 400px;
            box-sizing: border-box;
        }

        .item {
            margin: 20px 0;
            padding: 15px;
            background: #fff;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .item h3 {
            margin-bottom: 10px;
            color: #34495e;
        }

        .item p {
            margin: 5px 0 15px;
            color: #7f8c8d;
        }

        .item input[type="color"] {
            border: none;
            padding: 5px;
            border-radius: 5px;
        }

        .item button {
            margin-top: 10px;
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .item button:hover {
            background-color: #2980b9;
        }

        .info-message {
            font-size: 18px;
            color: #e74c3c;
        }

        #success-message {
            color: #2ecc71;
        }

        #error-message {
            color: #e74c3c;
        }
    </style>
</head>
<body>
    <div id="shop-container">
        <?php if ($isUserLoggedIn): ?>
            <div class="item">
                <h3>Change Desktop Background Color</h3>
                <p>Price: 50 points</p>
                <input type="color" id="color-picker" value="#d5bba0">
                <button onclick="purchaseItem('changeBackgroundColor', 50)">Buy</button>
            </div>
            <div id="success-message"></div>
            <div id="error-message"></div>
        <?php else: ?>
            <div class="info-message">
                <p>You must be logged in to access the shop.</p>
                <a href="./Login.php">Click here to log in</a>
            </div>
        <?php endif; ?>
    </div>

    <script>
        function purchaseItem(itemId, price) {
            const color = document.getElementById('color-picker').value;

            fetch('', {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ itemId, price, color }),
            })
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'success') {
                        document.getElementById('success-message').innerText = data.message;
                        document.getElementById('error-message').innerText = '';
                    } else {
                        document.getElementById('error-message').innerText = data.message;
                        document.getElementById('success-message').innerText = '';
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('error-message').innerText = 'An error occurred.';
                });
        }
    </script>
</body>
</html>

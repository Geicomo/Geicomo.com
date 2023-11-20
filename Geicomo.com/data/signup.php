<!DOCTYPE html>
<html>
<head>
        <title> Geicomos Website | Home</title>
        <meta name="viewport" content="width=device-width, initial-scale=0.7">
        <link rel="stylesheet" type="text/css" href="../templates/main.css">
</head>
<body>
<div class="image-text-container">
        <div class="logo-container">
        <h1 style="font-family:courier">Welcome to Geicomo.com</h1>
        </div>
        <div class="text-container">
<div class="random">
RMOTD:
<?php
                //20 possible strings
                $val = rand(1,20);

                switch ($val)
        {
        case 1:
                echo "Powered by Debian! ";
                break;
        case 2:
                echo "Sometimes I dream about cheese... ";
                echo "<audio autoplay><source src='/audio/cheese.mp3' type='audio/mpeg'></audio>";
                break;
        case 3:

                echo "Geicomo? I thought it was spelled- ";
                break;
        case 4:
                echo "Powered by SPAM";
                break;
        case 5:
                echo "This wouldent be here without CynicalDebian";
                break;
        case 6:
                echo "3,124.7 Hours ;)";
                break;
        case 7:
                echo " <a href='https://www.youtube.com/watch?v=j7Ff6izcRCc'>Click Me</a> ";
                break;
        Case 8:
                echo "THE REDLINERUSH!!!";
                break;
        case 9:
                echo "Giant Enemy Spider";
                break;
        case 10:
                echo "Currently at Sea";
                break;
        case 11:
                echo " <marquee direction='right'> weed weed weed weed weed weed weed weed weed weed weed weed weed weed weed weed weed weed weed weed weed</marquee>";
                break;
        case 12:
                echo "Faded than a hoe faded than a hoe faded than a hoe faded than a hoe faded than a hoe faded than a hoe..";
                break;
        case 13:
                echo "Currently at Wano!";
                break;
        case 14:
                echo "Taking a break;";
                break;
        case 15:
                echo "More secure than club penguin";
                break;
        default:
                echo "Tough luck";
                break;
        }
?>
</div>
        </div>
</div>
<ul>
  <li><a class="active" href="../index.php">Home</a></li>
  <li><a class="active" href="../serverlist.php">Servers List</a></li>
  <li><a class="active" href="../photogallery.php">Photo Gallery</a></li>
  <li><a class="active" href="../computer.php">Info</a></li>
</ul>
<div class="content">
<style>
        .container {
                border: solid 2px #787878;
                border-radius: 4px;
                position: absolute;
                text-align: center;
                top: 30%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 5px;
        }
@media screen and (max-width: 768px) {
  .container {
            top: initial;
            left: initial;
            transform: initial;
            text-align: left;
            width: 90%;
            margin: 0 auto;
            padding: 20px;
 }
</style>
<div class="container">
        <h1 style="font-family:courier;font-size:27px"> Signup Form </h1>
<form method="post">
        <label for="uname">Create username:</label><br>
        <input type="text" id="username" name="username" minlength="4" maxlength="20" required pattern="[a-zA-Z0-9]+"><br>
        <label for="password">Enter password:</label><br>
        <input type="password" id="password" name="password" minlength="6" maxlength="40" required><br>
        <input type="checkbox" id="agree" required>
        <label for="terms">By checking the box <br> you agree to the <a href="../geicomoterms.pdf">Terms & Conditions.</a><label><br>
        <br>
<button type="submit" id="submitButton" name="submit" disabled onclick="hashPassword(); redirectToIndex();">Submit</button>
</form>
  <script src="username-checker.js"></script>
    <i><div id="result"></div></i>
        <i><div><p>No special characters (/-+@)</p></div></i>

 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>

        $(document).ready(function() {
            // Disable the submit button by default
            $('#submitButton').prop('disabled', true);

            $('#username').on('keyup', function() {
                updateSubmitButton(); // Call the function to update the submit button
            });

            $('#agree').change(function() {
                updateSubmitButton(); // Call the function to update the submit button
            });

            function redirectToIndex() {
        // Redirect to ../index.php
        window.location.href = '../index.php';
    }
            function updateSubmitButton() {
                var username = $('#username').val();
                var isChecked = $('#agree').is(':checked');

                $.ajax({
                    type: 'POST',
                    url: 'check_username.php',
                    data: { username: username },
                    success: function(response) {
                        console.log("AJAX Success:", response); // Log the response
                        $('#result').html(response);

                        // Enable or disable the submit button based on conditions
                        if (response.trim() === "Username is unique!" && isChecked) {
                            $('#submitButton').prop('disabled', false);
                        } else {
                            $('#submitButton').prop('disabled', true);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.log("AJAX Error:", error); // Log any errors
                        $('#result').html('Error occurred. Please try again.');
                    }
                });
            }
        });
    </script>
<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $flags = 0;
    $points = 0;

    // Generate a random salt
    $salt = bin2hex(random_bytes(3));

    // Hash the password with the salt
    $saltedPassword = trim($password) . trim($salt);
    $hashedPassword = hash("sha256", $saltedPassword);

    // Write the username, hashed password, and salt to a file
    $data = "$username,$hashedPassword,$salt,$flags,$points\n";
    file_put_contents("hash.xml", $data, FILE_APPEND);

    echo '<script>';
    echo 'alert("Account created successfully!\n\nWelcome ' . $username . '");';
    echo 'window.location.href = "../index.php";';
    echo '</script>';
}
?>
</div>
</div>
<?php include('../templates/footer.php');?>
</body>
</html>

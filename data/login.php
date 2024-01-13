<?php
include("data/login.class.php");
session_start();

if(isset($_POST['submit'])){
    $user = new LoginUser($_POST['username'], $_POST['password']);
} elseif(isset($_POST['guestLogin'])) {
    $_SESSION['username'] = 'guest';
    header("location: /guest/guestos.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
        <title>login.geic</title>
        <meta name="viewport" content="width=device-width, initial-scale=0.7">
        <link rel="stylesheet" type="text/css" href="templates/base.css">
</head>
<style>
	.container {
        	display: flex;
        	align-items: center;
        	justify-content: center;
	}
	.error {
		color: #cc0000;
	}
	.success {
		color: #34b500;
	}
</style>
<body>
<form action="" method="post" enctype="multipart/form-data" autocomplete="off">
        <div class="container"><a style="font-family:courier;font-size:37px"><strong>Sign In</strong></a></div>
                <div class="container"><p style="font-size:16px;font-weight:bold;">Both fields are <span>required</span></p></div>
        <div class="container">
                <label>Username</label>
        </div>
        <div class="container">
                <input type="text" name="username">
        </div>
        <div class="container">
                <label>Password</label>
        </div>
        <div class="container">
                <input type="password" name="password"><br>
        </div>
<div class="container">
                <button style="display:flex;align-items:center;justify-content:center;margin-top:12px;font-size:12px;height:25px;width:100px;float:left;background-color:#1CB500;" type="submit" name="submit">Sign In</button>

                <a href="https://geicomo.com/register"><button type="button" style="margin-top:12px;font-size:12px;height:25px;width:100px;float:left;background-color:#00B2FF;">Sign Up</button></a> <br>
</div>
<div class="container"><button type="submit" name="guestLogin" style="margin-top:6px;font-size:12px;height:35px;width:100px;float:left;background-color:#FFA500;font-weight:bold;">Sign in as Guest</button></div>
<div class="container"><a style="font-size:12px;margin-top:5px;" href="https://geicomo.com/frgpassword/frgpassword.php">Forgot Password</a></div>
	<div class="container"><p class="error"><?php echo @$user->error ?></p></div>
        <div class="container"><p class="success"><?php echo @$user->success ?></p></div>
</form>
</div>
</div>
</body>
</html>

<!DOCTYPE html>
<html>
<head>
    <title>Email Form</title>
</head>
<body>
</body>
</html>
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
        <div id="page1" class="draggable-box">
                <div class="title-bar">forgot_password.geic</div>
		<div class="content">
		<a style="font-weight:bold;font-size:17px;">Reset Password</a>
			<form action="send_email.php" method="post">
        			<label for="email">Enter your email:</label>
        			<input type="email" id="email" name="email" required>
				<input type="submit" value="Submit">
		    	</form>
		    You will receive a email from our service gmail account geicomoservices@gmail.com<br> with a link to reset your password. You have <strong>1 hour</strong> before the token resets.
<br><br><br><br><br><br><br>
		</div>
		</div>
        </div>
</div>
<div style="position:fixed;bottom:0">
        <a>All content is licensed under </a><a href="https://creativecommons.org/licenses/by-nc/4.0/?ref=chooser-v1 unless otherwise posted.">CC BY-NC 4.0 DEED</a> unless otherwise posted.</a>
</div>
</body>
</html>

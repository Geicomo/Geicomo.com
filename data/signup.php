<?php require("register.class.php") ?>
<?php
        if(isset($_POST['submit'])){
                $user = new RegisterUser($_POST['username'], $_POST['password'], $_POST['acceptTos'], $_POST['email']);
        }
?>
<!DOCTYPE html>
<html lang="en">
<head>
        <title>register.geic</title>
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
        <div class="container"><a style="font-family:courier;font-size:37px"><strong>Register</strong></a></div>
                <div class="container"><p style="font-size:16px;font-weight:bold;">All fields are <span>required</span></p></div>
        <div class="container">
             <label>Username</label>
        </div>
        <div class="container">
            	<input type="text" name="username">
	</div>
        <div class="container">
            	<label>Email</label>
	</div>
        <div class="container">
            	<input type="email" name="email">
	</div>
        <div class="container">
            <label>Password</label>
	</div>
        <div class="container">
            <input type="password" name="password">
        </div>

<div class="container"><button style="display:flex;align-items:center;justify-content:center;margin-top:12px;font-size:12px;height:25px;width:100px;float:left;background-color:#1CB500;" type="submit" name="submit">Register</button>
<a href="https://geicomo.com/index.php"><button type="button" style="display:flex;align-items:center;justify-content:center;margin-top:12px;font-size:12px;height:25px;width:100px;float:left;background-color:#01b2ff;">Back</button></a><br></div>
    
<div class="container" style="margin-top:8px;"><input type="checkbox" name="acceptTos" value="yes"> I accept the <a href="../geicomoterms.pdf">Terms of Service</a></div>
<div class="container">
	<p class="error"><?php echo @$user->error ?></p>
	<p class="success"><?php echo @$user->success ?></p>
</div>
        </div>
    </form>
</form>
</body>
</html>

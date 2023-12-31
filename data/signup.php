<?php require("register.class.php") ?>
<?php
        if(isset($_POST['submit'])){
                $user = new RegisterUser($_POST['username'], $_POST['password'], $_POST['acceptTos'], $_POST['email']);
        }
?>
<!DOCTYPE html>
<html>
<head>
        <title> Geicomos Website | Signup</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" type="text/css" href="../templates/main.css">
</head>
<body>
<?php include('../templates/header.php'); ?>
<style>
	.container {
		background-color: rgba(224,224,224,.5);
                border: solid 2px #787878;
                border-radius: 4px;
                position: absolute;
                text-align: center;
                top: 40%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 20px;
        }
        input[type=text], input[type=password], input[type=email] {
  width: 300px;
  padding: 12px 20px;
  margin: 8px 0;
  display: block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}
.btn {
  position: absolute;
  top: 93px;
  right: 10px;
  margin-right: 5px;
  border-radius: 4px;
  width: 100px;
  height: 40px;
  color: black;
  background-color: #f0f0f0;
  border: none;
  cursor: pointer;
  transition: top 0.3s ease, right 0.3s ease;
}
/* Set a style for all buttons */
button {
  background-color: #04AA6D;
  border-radius: 4px;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100px;
}

button:hover {
  opacity: 0.8;
}

.error{
        margin-top: 30px;
        color: #af0c0c;
}

.success{
        margin-top: 30px;
        color: green;
}
p {
	font-size: 15px;
}
</style>
<div class="content">
    <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
        <div class="container">
            <p style="font-family:courier;font-size:37px"><strong>Signup Panel</strong></p>
            <h4>All fields are <span>required</span></h4>

            <label>Username</label>
            <input type="text" name="username">

	    <label>Email</label>
            <input type="email" name="email">
	    
	    <label>Password</label>
            <input type="password" name="password">

            <input type="checkbox" name="acceptTos" value="yes"> I accept the <a href="../geicomoterms.pdf">Terms of Service</a>
	    <br>

    <p class="error"><?php echo @$user->error ?></p>
    <p class="success"><?php echo @$user->success ?></p>
            <button style="float:right" type="submit" name="submit">Register</button>

            <a href="/data/login.php"><button type="button" style="float:left;background-color:#00B2FF;">Back</button></a> <br>
        </div>
    </form>
</div>

<script>
    // Check for the presence of the success message
    var successMessage = "<?php echo @$user->success; ?>";

    if (successMessage) {
        // If there's a success message, wait for 2 seconds and then redirect
        setTimeout(function() {
            window.location.href = "/data/login.php";
        }, 2000);
    }
</script>

</script>	
</div>
</div>
<?php include('../templates/footer.php');?>
</body>
</html>

<?php include("login.class.php") ?>
<?php
        if(isset($_POST['submit'])){
                $user = new LoginUser($_POST['username'], $_POST['password']);
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
<div class="content">
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
	input[type=text], input[type=password] {
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
</style>
<form action="" method="post" enctype="multipart/form-data" autocomplete="off">
    <div class="container">
	<p style="font-family:courier;font-size:37px"><strong> Forgot Password </strong></p>
	<p>Please email <strong>geicomoservices@gmail.com</strong> with the same email your account is associated with and send a request for a password change and a admin will respond and help you. Thank you.</p>
	<a href="/data/login.php"><button type="button" style="background-color:#00B2FF;">Back</button></a>	
	</form>
</div>
</div>
</div>
<?php include('../templates/footer.php');?>
</body>
</html>

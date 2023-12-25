<!DOCTYPE html>
<html>
<head>
        <title> Geicomos Website | Server List</title>
        <meta name="viewport" content="width=device-width, initial-scale=0.7">
	<link rel="stylesheet" type="text/css" href="../../templates/main.css">
<style>
.content {
        border: 2px solid #999;
        background-image: url('../../images/serverbackground.jpg');
        background-size: 100% 100%;
        background-attachment: fixed;
        border-radius: 5px;
        border-top: none;
        border-bottom: none;
        padding: 20px;
        min-height: 70vh;
        position: relative;
}
	@media (min-width: 1025px) {
                .content {
                        min-height: 80vh;
                }
        }
li a, .dropbtn {
  font-weight: bold;
  display: inline-block;
  color: black;
  text-align: center;
  text-decoration: none;
}

li a:hover, .dropdown:hover .dropbtn {
background-color: #B4B4B4;
}

li.dropdown {
  display: inline-block;
}

.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f9f9f9;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
  text-align: left;
}

.dropdown-content a:hover {background-color: #f1f1f1;}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown-content a:hover {background-color: #f1f1f1}

.dropdown:hover .dropdown-content {
  display: block;
}

.dropdown:hover .dropbtn {
  background-color: #B0B0B0;
}
</style>
</head>
<?php include('../../templates/logged/headerdrop.php');?>
<div class="content">
        <style>
                .serverstat {
                border: 2px solid #787878;
                background-color: rgb(0,0,0, .3);
                border-radius: 5px;
                position: absolute;
                text-align: center;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 10px;
		color: #E7E7E7;
		font-weight: bold;
                height: 600px;
                }
        </style>
<div class="serverstat"> 
        <a style='font-size:22px;'>Servers List<br></a>
        <a href='mcserver'>Minecraft Server Status <br></a>
        <strong>mc.geicomo.com </strong><br>
        <br>
        <a href='ruserver'>Rust Server Status <br></a>
        <strong>geicomo.com</strong> <br>
        <br>
        <a href='pzserver'>PZ Server Status<br></a>
	<strong>project zomboid</strong> <br>
	<br>
        <a href='gmodserver'>Gmod Server Status<br></a>
        <strong>geicomo.com</strong>
</div>
</div>
<?php include('../../templates/footer.php');?>
</body> 
</html>

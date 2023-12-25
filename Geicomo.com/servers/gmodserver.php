<!DOCTYPE html>
<html>
<head>
        <title> Geicomos Website | Gmod Server</title>
        <meta name="viewport" content="width=device-width, initial-scale=0.6">
	<link rel="stylesheet" type="text/css" href="../templates/main.css">
<style>
.content {
        border: 2px solid #999;
        background-image: url('../images/gmodserver/gmodserverbackground.jpg');
        background-size: 100% 100%;
        background-attachment: fixed;
        border-radius: 5px;
        border-top: none;
        border-bottom: none;
        padding: 20px;
        min-height: 81vh;
        position: relative;
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
  background-color: #c4c5c5;
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
<body>
<?php include('../templates/headerdrop.php');?>
<?php include('../templates/loginbtn.php');?>
<style>
                .serverstat {
                border: 2px solid #787878;
                background-color: rgb(0,0,0, .3);
                border-radius: 5px;
                position: absolute;
                text-align: center;
                top: 15vh;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 10px;
                font-size: 18px;
                color: white;
                }
                .bottominfo {
                border: 2px solid #787878;
                background-color: rgb(0,0,0, .3);
                border-radius: 5px;
                position: absolute;
                text-align: center;
                top: 45vh;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 10px;
                color: white;
                }
                .backbtn {
                position: absolute;
                top: 65vh;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 10px;
                }
                .bottominfo a {
                text-align: center;
                color: #CCFFFB;
                padding: 5px;
                border-radius: 4px;
                font-size: 17px;
		}
		@media (min-width: 1025px) {
                	.backbttn {
				top: 118vh;
                	}
        	}
        </style>
<div class="content"> 
	<div style="margin: 5px;">
	<div class="serverstat">
        	<div style="font-size:19px"><strong>Geicomo Gmod Server</strong></div>
        	<strong><span class="server-ip">IP: </strong>geicomo.com<br></span>
		<strong><span> Port:</strong> 27015</span> <br>
        	<strong><span> Password:</strong> Geic</span> <br>
<?php
        $data = json_decode(file_get_contents('https://gmod-servers.com/api/?object=servers&element=detail&key=6CBjsdYbLQKI3US9XHV1xedoOvS8CxOn3pn'));
        $players = $data->players;
	$online = $data->is_online;
	$status = "";
	$up = "../images/up.jpg";
	$down = "../images/down.jpg";
	if ($online == 1){
		$status = $up;
	}else{
		$status = $down;
	}
	echo '<strong>Server Status: </strong>';
?>
	 <img src='<?php echo $status ?>'> <br>
<?php 
	echo '<strong>Players Online: </strong>';
        echo "$players/8";
?>
</div>
<div class="bottominfo">
<h2>Server Information</h2>
	<p>Server with Terrorist Town, Prop Hunt and Sandbox.<br> Votemap to change gamemode!</p>
	<p><i>Server restarts at 12:10AM/PM PDT daily.</i></p>
	<a href="steam://connect/98.146.216.139:27015">Connect To The Server</a><br> <br>
        <strong>(LINKS CAN BE ALTERNATE SITES)</strong> <br>
        <h3> Gmod Server Collection </h3>
        <a href="https://steamcommunity.com/sharedfiles/filedetails/?id=3102135866">Steam Mods</a> <br>
</div>
<button class="backbtn" onclick="history.back()">Back</button>
</div>
</div>
</body>
<?php include('../templates/footer.php');?>
</html>

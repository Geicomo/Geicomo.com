<!DOCTYPE html>
<html>
<head>
        <title> Geicomos Website | PZ Server</title>
        <meta name="viewport" content="width=device-width, initial-scale=0.6">
	<link rel="stylesheet" type="text/css" href="../templates/main.css">
<style>
.content {
        border: 2px solid #999;
        background-image: url('../images/pzpictures/zomboid5.jpg');
        background-size: 100% 100%;
        background-attachment: fixed;
        border-radius: 5px;
        border-top: none;
        border-bottom: none;
        padding: 20px;
        min-height: 110vh;
        position: relative;
}
@media (min-width: 1025px) {
                .content {
                        min-height: 120vh;
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
                top: 10%;
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
                top: 55%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 10px;
                color: white;
                }
                .backbttn {
                position: absolute;
                top: 109vh;
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
        	<div style="font-size:19px"><strong>Geic PZ Server</strong></div>
        	<strong><span class="server-ip">IP: </strong>98.146.216.139<br></span>
        	<strong><span> Port:</strong> 16261</span> <br>
<?php
        $data = json_decode(file_get_contents('https://api.steampowered.com/IGameServersService/GetServerList/v1/?filter=\appid\108600\addr\98.146.216.139:16261&key=D98A2705777F0843FC224F8D7D2717A1'));
        $main = $data->response->servers[0] ?? null;
        $status = "";
        $up = "../images/up.jpg";
        $down = "../images/down.jpg";	
	$players = $main->players;
	if($main !== null){
                $status = $up;
        }else{
                $status = $down;
	}
        echo '<strong>Server Status: </strong>';
?>
	 <img src='<?php echo $status ?>'> <br>
<?php
	echo '<strong>Players Online: </strong>';
        echo "$players /12";
?>
</div>
<div class="bottominfo">
        <h2>Server Information</h2>
        <p><i>Server restarts at 12:05AM/PM PDT daily.</i></p>
        <strong>(LINKS CAN BE ALTERNATE SITES)</strong> <br>
        <h3> Zomboid Server Mod List </h3>
        <a href="https://steamcommunity.com/sharedfiles/filedetails/?id=3030612933">Steam Mods</a> <br>
        <div class=="bottominfo">
        <h3> Project Zomboid Map </h3>
        <iframe src="https://map.projectzomboid.com/" width="500" height="500" attribute-id=value frameborder="0" class="map"></iframe>
</div>
</div>
<button class="backbttn" onclick="history.back()">Back</button>
</div>
</div>
</body>
<?php include('../templates/footer.php');?>
</html>

<!DOCTYPE html>
<html>
<head>
	<title> Geicomos Website | MC Server</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=0.6">
	<link rel="stylesheet" type="text/css" href="../templates/main.css">

<style>
.content {
        border: 2px solid #999;
        background-image: url('../images/mcpictures/minecraftpicture10.jpg');
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
            min-height: 90vh; /* Increased height for larger screens */
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
<div class="content">
<style>
              	.serverstat {
                border: 2px solid #787878;
  		background-color: rgb(0,0,0, .3);
                border-radius: 5px;
                position: absolute;
                text-align: center;
                top: 13%;
                left: 50%;
                transform: translate(-50%, -50%);
                font-size: 18px;
                padding: 10px;
		color: white;
		}

                .bottominfo {
                border: 2px solid #787878;
                background-color: rgb(0,0,0, .3);
                border-radius: 5px;
                position: absolute;
                text-align: center;
                margin-top: 19%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 10px;
                color: white;
		}

		.backbttn {
                position: absolute;
                top: 93%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 10px;
		}
    @media (min-width: 1025px) {
		.bottominfo {
		top: 18vh;
	}
    }
		 @media (max-width: 768px) {
	    	.bottominfo {
                border: 2px solid #787878;
                background-color: rgb(0,0,0, .3);
                border-radius: 5px;
                position: absolute;
                text-align: center;
		top: 37%;
		left: 50%;
                transform: translate(-50%, -50%);
                padding: 10px;
                color: white;
		}

		.backbttn {
                position: absolute;
                top: 80%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 10px;
		}

		}

                .bottominfo a {
                text-align: center;
                color: #CCFFFB;
                padding: 5px;
                border-radius: 4px;
                font-size: 17px;
		}

        </style>
        <script>
        function initServerData(serverIp,serverPort){
                console.log('https://mcapi.us/server/status?ip='+serverIp+'&port='+serverPort)
                fetch('https://mcapi.us/server/status?ip='+serverIp+'&port='+serverPort)
                .then(response => response.json())
                .then(data => handleServerStatus(data));


        function handleServerStatus(data){
                if(data.status=='error'){
                        console.log(data.error);
                        return false;
                }
                const playerCounter = document.getElementById("player-count");
                playerCounter.innerHTML = data.players.now;
        }

        }

        initServerData("98.146.216.139","25565");

        </script>
<div style="margin: 5px;">
<div class="serverstat">
        <?php
        function checkserveronline($ip, $port) {
            $fp = fsockopen($ip, $port, $errno, $errstr, 5);
            if(!$fp){
               return "down";
            } else {
               return "up";
            }
        }
        echo '<div style="font-size:20px"><strong>Geic Minecraft Server</strong></div>';
        echo "<strong> Server Status: </strong>";
        echo "<img src='../images/" . checkserveronline("127.0.0.1", 25565) . ".jpg' /><br>";
        ?>
        <strong>IP: </strong>mc.geicomo.com <br>
        <strong>Version: </strong>1.20.1
        <div><strong>Players Online: </strong> <span class="server-status" id="player-count">0</span>/8</div>
</div>
<div class="bottominfo">
        <span style="font-size:22px"><strong>Server Information</strong></span> <br>
        <span style="font-size:20px"><strong>Description</strong></span> <br>
        <span style="font-size:16px">The Geicomo.com Minecraft server has various plugins to keep players <br> active such as server side shops and purchasable player shops <br> other than that the main goal is to build cool shit. <br> There is also ways to protect your builds <br> so you can come back anytime and pick up where you left off.<br> Join Today!</span> <br><br>
        <span style="font-size:20px"><strong>Plugins List</strong></span> <br>
        <span style="font-size:18px">Decent Holograms</span> <br>
        <a href="/mcmap/">Dynmap</a> <br>
        <span style="font-size:18px">Essentials</span> <br>
        <span style="font-size:18px">Grief Prevention</span> <br>
        <span style="font-size:18px">LuckPerms</span> <br>
        <span style="font-size:18px">PlaceholderAPI</span> <br>
        <span style="font-size:18px">Vault</span> <br>
        <span style="font-size:18px">World Edit</span> <br>
        <span style="font-size:18px">World Guard</span> <br> <br>
        <span style="font-size:18px"><i>Server restarts at 12:00AM/PM PDT daily.</i></span> <br>

</div>
        <button class="backbttn" onclick="history.back()">Back</button>
</div>
</div>
</body>
<?php include('../templates/footer.php');?>
</html>

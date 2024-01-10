<!DOCTYPE html>
<html lang="en">
<head>
	<title>minecraft.info</title>
</head>
<body>
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
        <a style="font-weight:bold;font-size:20px">Geic Minecraft Server</a><br>
        <strong>IP: </strong>mc.geicomo.com <br>
	<strong>Version: </strong>1.20.1<br>
        <?php
        function checkserveronline($ip, $port) {
            $fp = fsockopen($ip, $port, $errno, $errstr, 5);
            if(!$fp){
               return "down";
            } else {
               return "up";
            }
        }
        echo "<strong> Server Status: </strong>";
        echo "<img src='../images/" . checkserveronline("127.0.0.1", 25565) . ".jpg' /><br>";
        ?>

        <div><strong>Players Online: </strong> <span class="server-status" id="player-count">0</span>/8</div>
<a style="font-weight:bold;font-size:18px">Server Information:</a><br>
        <a style="font-size:15px">The Geicomo.com Minecraft server has various plugins to keep players active such as server side shops and purchasable player shops <br> other than that the main goal is to build cool shit. There is also ways to protect your builds so you can come back anytime and pick <br> up where you left off. Join Today!</a><br>
        <a style="font-size:15px"><i>Server restarts at 12:00AM/PM PDT daily.</i></a><br><br>
        <a style="font-weight:bold;font-size:16px"> Minecraft Server Collection: </a>
        <a href="https://geicomo.com/servers/mcplugins.php">minecraft_plugins.info</a> <br>
</div>

<?php include('../templates/servers.php');?>
<br><br><br>
<?php include('../templates/directory.php');?>
</body>
</html>

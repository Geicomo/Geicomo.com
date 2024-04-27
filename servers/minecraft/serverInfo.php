<!DOCTYPE html>
<html lang="en">
<head>
	<title>Cyans Simple-Anarchy | Server Info</title>
        <link rel="stylesheet" type="text/css" href="https://www.geicomo.com/servers/minecraft/templates/base.css">
</head>
<style>
html {
	height: 880px;
}

</style>
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
                	const playerCounterNow = document.getElementById("player-now");
			playerCounterNow.innerHTML = data.players.now;
			const playerCounterMax = document.getElementById("player-max");
                	playerCounterMax.innerHTML = data.players.max;
                	const serverVersion = document.getElementById("server-version");
			serverVersion.innerHTML = data.server.name;
		}
	}

        initServerData("98.145.136.82","25565");

	</script>
<video autoplay muted loop id="myVideo">
  <source src="https://geicomo.com/images/mccinematicshots.mp4" type="video/mp4">
  Your browser does not support HTML5 video.
</video>
<?php include( '/var/www/html/servers/minecraft/templates/topbar.php' ); ?>
<div class="main">
<div class="info">
        <a style="font-weight:bold;font-size:20px">Cyans Semi-Anarchy</a><br>
        <strong>IP: </strong> <span>mc.geicomo.com</span> <br>
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
        echo "<img src='https://geicomo.com/images/" . checkserveronline("127.0.0.1", 25565) . ".png' /><br>";
        ?>
	<strong>Version: </strong> <span id="server-version">1.20.2<br></span>
        <div><strong>Players Online: </strong> <span id="player-now">0</span>/<span id="player-max">20</span></div><hr>
<a style="font-weight:bold;font-size:18px">Server Information:</a><br>
        <a style="font-size:15px">Cyans Semi-Anarchy is a server thats plugins for protection and building only apply to spawn, no other locations in the world are protected. Chests have a type of health system implimented based on valuables inside to promote greifing not entirely knocking players out of the game so easy. But I try to make it still worth!</a><br><br>
        <a style="font-size:15px"><i>Server restarts at 12, 4 and 8 A.M and 12, 4 and 8 P.M.</i></a>
	<br><br><br>
	<a><strong>Plugins: </strong></a><br>
	<a style="font-size:14px;">Plugins just for the spawn:</a><br>
        <span style="font-size:18px">Vault</span> <br>
	<span style="font-size:18px">World Edit</span> <br>
	<span style="font-size:18px">World Guard</span> <br>
	<span style="font-size:18px">Decent Holograms</span> <br>
	<span style="font-size:18px">EzChestShop</span> <br>
	<span style="font-size:18px">AdavancedRegionMarket</span> <br>
	<a style="font-size:14px;">Others: </a><br>
	<span style="font-size:18px">CyansSimpleRaiding<i>(Custom)</i></span> <br>
        <span style="font-size:18px">Essentials</span> <br>
</div>
        <div style="text-align:center;position:absolute;left:86%;bottom:3px;">
		<a href="https://discord.gg/nSFk75guug"><img  src="https://geicomo.com/images/discordbanner.gif"></img></a>
</div>
</body>
</html>

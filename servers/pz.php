<!DOCTYPE html>
<html lang="en">
<head>
	<title>project_zomboid.info</title>
</head>
<body>
        <div style="margin: 5px;">
        <div class="serverstat">
                <div style="font-size:19px"><strong>Geic PZ Server</strong></div>
                <strong><span class="server-ip">IP: </strong>98.145.136.82<br></span>
                <strong><span> Port:</strong> 16261</span> <br>
<?php
        $data = json_decode(file_get_contents('https://api.steampowered.com/IGameServersService/GetServerList/v1/?filter=\appid\108600\addr\98.145.136.82:16261&key=D98A2705777F0843FC224F8D7D2717A1'));
        $main = $data->response->servers[0] ?? null;
        $status = "";
        $up = "https://geicomo.com/images/up.png";
        $down = "https://geicomo.com/images/down.png";
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
<br>
<a style="font-weight:bold;font-size:18px">Server Information:</a><br>
        <a style="font-size:15px">Server with minimal mods.</a><br>
        <a style="font-size:15px"><i>Server restarts at 12:05AM/PM PDT daily.</i></a><br><br>
        <a style="font-weight:bold;font-size:14px">(LINKS CAN BE ALTERNATE SITES)</a> <br>
        <a style="font-weight:bold;font-size:16px"> Project Zomboid Server Collection: </a>
        <a href="https://steamcommunity.com/sharedfiles/filedetails/?id=3030612933">project_zomboid_mods.web</a> <br>
<?php include('../templates/servers.php');?>
<br><br><br>
<?php include('../templates/directory.php');?>
</body>
</html>

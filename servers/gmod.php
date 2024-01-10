<!DOCTYPE html>
<html lang="en">
<head>
	<title>gmod.info</title>
</head>
<body>
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
<a style="font-weight:bold;font-size:18px">Server Information:</a><br>
        <a style="font-size:15px">Server with Terrorist Town, Prop Hunt and Sandbox.<br> Votemap to change gamemode!</a><br>
        <a style="font-size:15px"><i>Server restarts at 12:10AM/PM PDT daily.</i></a><br><br>
        <a href="steam://connect/98.146.216.139:27015">Connect_To_The_Server.web</a><br> <br>
        <a style="font-weight:bold;font-size:14px">(LINKS CAN BE ALTERNATE SITES)</a> <br>
        <a style="font-weight:bold;font-size:16px"> Gmod Server Collection: </a>
        <a href="https://steamcommunity.com/sharedfiles/filedetails/?id=3102135866">gmod_server_mods.web</a> <br>
</div>

<?php include('../templates/servers.php');?>
<br><br><br>
<?php include('../templates/directory.php');?>
</body>
</html>

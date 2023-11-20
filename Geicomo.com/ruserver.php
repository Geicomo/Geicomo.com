<!DOCTYPE html>
<html>
<head>
        <title> Geicomos Website | Rust Server</title>
        <meta name="viewport" content="width=device-width, initial-scale=0.6">
	<link rel="stylesheet" type="text/css" href="templates/main.css">
<style>
.content {
        border: 2px solid #999;
        background-image: url('images/ruserverbackground.jpg');
        background-size: 100% 100%;
        background-attachment: fixed;
        border-radius: 5px;
        border-top: none;
        border-bottom: none;
        padding: 20px;
        min-height: 70vh;
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
<?php include('templates/headerdrop.php');?>
<div class="content">
        <style>
                .serverstat {
                border: 2px solid #787878;
                background-color: rgb(0,0,0, .3);
                border-radius: 5px;
                position: absolute;
                text-align: center;
                top: 45%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 10px;
                color: white;
                }
                .info {
                border: 2px solid #D30C0C;
                margin: 0px;
                float: right;
                border-radius: 5px;
                border-right: none;
                }
                .bottominfo {
                border: 2px solid #787878;
                background-color: rgb(0,0,0, .3);
                border-radius: 5px;
                position: absolute;
                text-align: center;
                top: 75%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 10px;
                }
                .backbttn {
                position: absolute;
                top: 55%;
                left: 50%;
                transform: translate(-50%, -50%);
                padding: 10px;
                }
        </style>
        <script>
        initServerData("192.168.1.131","28016");

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
        echo "Geic Rust Server <br>";
        echo "<strong>Server Status: </strong>";
        echo "<img src='/images/" . checkserveronline("192.168.0.149", 28016) . ".jpg' /><br>";
        ?>
        <strong><span class="server-ip">IP:</strong> geicomo.com<br></span>
        <span><i> Use "client.connect geicomo.com" in the F1 menu to connect </i></span>
</div>
<button class="backbttn" onclick="history.back()">Back</button>
</div>
</div>
</body>
<?php include('templates/footer.php');?>
</html>

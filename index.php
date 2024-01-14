<!DOCTYPE html>
<html lang="en">
<head>
        <title>Geic OS</title>
        <meta name="viewport" content="width=device-width, initial-scale=0.7">
        <link rel="stylesheet" type="text/css" href="templates/base.css">
</head>
<style>
.draggable-box {
    position: absolute;
    min-width: 350px;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>
<body>
<div id="container">
	<div id="page1" class="draggable-box">
        	<div class="title-bar">sign_in.geic</div>
            	<div class="content">
        		<?php include '/var/www/html/data/login.php'; ?>
    		</div>
	</div>
</div>
<div style="position:fixed;bottom:0">
        <a>All content is licensed under </a><a href="https://creativecommons.org/licenses/by-nc/4.0/?ref=chooser-v1 unless otherwise posted.">CC BY-NC 4.0 DEED</a> unless otherwise posted.</a>
</div>
</body>
</html>



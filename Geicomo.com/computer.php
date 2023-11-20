<!DOCTYPE html>
<html>
<head>
        <title> Geicomos Website | Info</title>
        <meta name="viewport" content="width=device-width, initial-scale=0.5">
        <script async src="https://www.googletagmanager.com/gtag/js?id=G-L1B6M5CYL3"></script>
	<link rel="stylesheet" type="text/css" href="templates/main.css">
</head>
<body>
<?php include('templates/header.php');?>
<div class="content">
        <style>
                .description {
                position: absolute;
                text-align: center;
                top: 20%;
                left: 50%;
                transform: translate(-50%, -50%);
                }
                .info {
                border: 2px solid #787878;
                background-color: rgb(255,255,255,.2);
                border-radius: 5px;
                position: absolute;
                text-align: center;
                margin-left: 480px;
                margin-top: -320px;
                transform: translate(-50%, -50%);
                padding: 10px;
		}
        </style>

        <h1>Computer-Info Page</h1>
        <p> This is the info page where information about the computer and Geicomo.com, Geicomo.com is hosted on a small desktop located somewhere in the PDT timezone and was created on 6/5/23, this website is mainly just a<br> project for me to work on now and then and when I get ideas and host servers. The computer right now has some pretty bad specs but I hope to upgrade in the future to host anything. <br>The Neofetch is below with all the info.  </p>
</div>
<div class="info">
        <img style="max-width: 100%;" src="/images/neofetch.jpg" alt="Neo Fetch Info">
        <p style="font-size:11px;"><i>Neofetch 6/7/23</i></p>
</div>
</body>
<?php include('templates/footer.php');?>
</html>

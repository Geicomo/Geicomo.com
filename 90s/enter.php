<!DOCTYPE html>
<html lang="en">
<head>
	<title>Geicomo.com 90`s Feel</title>
        <meta name="viewport" content="width=device-width, initial-scale=0.7">
</head>
<body>
<style>
        .main {
                box-shadow: 0px 1px #707070;
                margin: auto;
                border: 4px solid;
                border-color: #ebe8e8 #c4c5c5;
                background: #0c0c0c;
                width: 500px;
                padding: 2px;
                height: 450px;
                overflow-y: hidden;
        }
			.main button {
				border: 2px solid;
				border-color: #fa0002 #d53737 #d53737 #fa0002;
				font-weight: bold;
				color: white;
				padding: 9px;
				margin-top: 6px;
				background-color: #0c0c0c;
			}

			.main button:hover {
				cursor: pointer;
				border-color: #d53737 #fa0002 #fa0002 #d53737; 
				font-weight: italic;
				color: white;
				padding: 8.5px;
			}

			@font-face {
			    	font-family: "VeniceClassic";
			    	src: url("https://geicomo.com/90s/templates/VeniceClassic.ttf") format("truetype");
			}

			.info {
				background-image: url('https://geicomo.com/90s/images/background.jpg');
			}

			html {
				font-family: VeniceClassic;
			}
			</style>

		<div class="main" style="text-align:center;">
				<?php include 'templates/enter.php';?>	
			<br>
			<div style="margin-top:25%;">
			<?php include 'templates/buttons.php';?>	
			</div>
		</div>
	</div>
</body>
</html>

<!DOCTYPE html>
<html>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>∴⍑ᔑℸ ̣  ⍑ᔑ⍊ᒷ ||𝙹⚍ ⎓𝙹⚍リ↸</title>
                <!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-L1B6M5CYL3"></script>
<script>
  window.dataLayer = window.dataLayer: || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-L1B6M5CYL3');
</script>
        </head>
<body>
<style>
	body {
		background-color: blue;
	}	

	button {
		position: absolute;
		text-align: center;
		top: 50%;
		left: 50%;
		transform: translate(-50%, -50%);
		padding: 10px;
	}
	
 	#SLIDE_BG {
		width: 100%;
		height: 100vh;
		background-position: center center;
		background-size: cover;
		background-repeat: no-repeat;
		backface-visibility: hidden;
		animation: slideBg 130s linear infinite 0s;
		animation-timing-function: ease-in-out;
		background-image: url('../images/fish2.jpg');
	}
	
	@keyframes slideBg {

 	 15% {
		background-image: url('../images/fish1.jpg');
	}
	 0% {
                background-image: url('../images/fish2.jpg');
        }	
	 25% {
                background-image: url('../images/fish3.jpg');
	}
	 35% {
                background-image: url('../images/fish4.jpg');
	}
	 45% {
                background-image: url('../images/fish5.jpg');
	}
	 55% {
                background-image: url('../images/fish6.jpg');
        }
	65% {
                background-image: url('../images/fish7.jpg');
	}
	75% {
                background-image: url('../images/fish8.jpg');
	}
	85% {
                background-image: url('../images/fish9.jpg');
	}
	95% {
                background-image: url('../images/fish10.jpg');
	}

	}
</style>

<div id="SLIDE_BG">
<?php

echo "<audio autoplay><source src='/audio/tomtomclub.mp3' type='audio/mpeg'></audio>";

?>
	<a href="index.php">
	<button id="some-button">Leave</button>
</a>
</div>
<script>
       	document.getElementById("some-button").style.display = "none";
	
	function showStuff() {
	document.getElementById("some-button").style.display = "inline";
	}

      	function myFunction() {
       	window.location = "project.html"
       	}

	setTimeout(showStuff, 13000);
</script>
</body>
</html>

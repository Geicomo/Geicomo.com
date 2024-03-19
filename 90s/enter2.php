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
		margin-top: 10vh;
		width: 500px;
		padding: 2px;
		height: 500px;
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
				border-color: #d53737 #fa0002 #fa0002 #d53737; 
				font-weight: italic;
				color: white;
				padding: 8.5px;
			}

			@font-face {
			    	font-family: "VeniceClassic";
			    	src: url("https://geicomo.com/90s/templates/VeniceClassic.ttf") format("truetype");
			}

			html {
				cursor: wait;
				background-image: url('https://geicomo.com/90s/images/background.jpg');
				font-family: VeniceClassic;
			}
  .loading-container {
    width: 98.4%;
    background-color: #707070;
		border: 4px solid;
		border-color: #ebe8e8 #c4c5c5;
  }

  .loading-bar {
    width: 0%;
    height: 30px;
    background-color: #4CAF50;
    text-align: center;
    line-height: 30px;
    color: white;
  }
			</style>

			<div class="main" style="text-align:center;">
				<a href="https://geicomo.com/90s/index"><img style="width:350px;margin-top:15px;" src="https://geicomo.com/90s/images/call-calling.gif"></a><br>
				<div style="font-size:28px;color:white;" id="message">Loading message...</div>
				<div class="loading-container">
  					<div class="loading-bar" id="loadingBar">0%</div>
				</div>
        <a><button style="cursor:wait;font-size:3vh;">Connect</button></a>
				<!-- Audio element -->
				<audio id="myAudio" autoplay>
    					<source src="https://geicomo.com/90s/images/dialup.mp3" type="audio/mp3">
    					Your browser does not support the audio element.
				</audio>

			<script>
			document.addEventListener('DOMContentLoaded', (event) => {
    				const audio = document.getElementById('myAudio');
    				audio.onended = function() {
        				window.location.href = "https://geicomo.com/90s/index"; // Redirect after audio ends
    				};

    				// Attempt to play audio
    				audio.play().catch(e => {
        				console.error("Audio autoplay failed: ", e);
        				// Optionally redirect immediately if autoplay fails
        				// window.location.href = "https://geicomo.com/90s/index";
    				});
			});

			// Random Message
	function showRandomMessage() {
    		const messages = [
      		'Hacking the mainframe...',
      		'Loading important Gifs...',
      		'Sending packets...',
      		'Waiting for response...',
      		'Contacting server on 192.651.278.83...',
      		'Communicating with Geicomo.com...',
      		'Extiguishing server fires...'
    		];

    	const index = Math.floor(Math.random() * messages.length);

    let message;
    switch(index) {
      case 0:
        message = messages[0];
        break;
      case 1:
        message = messages[1];
        break;
      case 2:
        message = messages[2];
        break;
      case 3:
        message = messages[3];
        break;
      case 4:
        message = messages[4];
        break;
      case 5:
        message = messages[5];
        break;
      case 6:
        message = messages[6];
        break;
      // Add more cases as needed
      default:
        message = "Loading...";
        break;
    }

    // Display the message
    document.getElementById("message").innerText = message;
  }

  // Change the message every 5 seconds
  window.onload = function() {
    showRandomMessage();
    setInterval(showRandomMessage, 3000);
  };

			// Loading Bar
  let width = 0; // Starting width
  const intervalTime = 500; // How often to update the loading bar (in milliseconds)
  const totalTime = 25000; // Total time until completion (in milliseconds)
  const maxIncrement = (170 * intervalTime) / totalTime; // Maximum possible increment to ensure completion within 25 seconds

  const loadingBar = document.getElementById('loadingBar');
  
  const interval = setInterval(() => {
    // Calculate a random increment for each update
    const increment = Math.random() * maxIncrement;
    width += increment;

    // Ensure the width doesn’t exceed 100%
    if (width >= 100) {
      width = 100;
      clearInterval(interval); // Stop the interval when complete
    }

    // Update the loading bar's width and text
    loadingBar.style.width = width + '%';
    loadingBar.innerText = Math.round(width) + '%';
  }, intervalTime);

  // Optionally, ensure the loading bar completes within 25 seconds regardless of randomness
  setTimeout(() => {
    width = 100;
    loadingBar.style.width = width + '%';
    loadingBar.innerText = Math.round(width) + '%';
    clearInterval(interval);
  }, totalTime);

			</script>
			<br>
			<div style="margin-top:15%;">
			<a style="font-size:18px;color:white;">If you do not get redirected in 35 seconds, click the gif or </a><a style="font-size:18px;color:white;" href="https://geicomo.com/90s/index">this link.</a>
			<?php include 'templates/buttons.php';?>	
			</div>
		</div>
	</div>
</body>
</html>

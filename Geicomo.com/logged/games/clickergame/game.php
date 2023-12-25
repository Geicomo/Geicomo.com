<!DOCTYPE html>
<html>
<head>
  <title>Click Game</title>
	<meta name="viewport" content="width=device-width, initial-scale=0.7">
	<link rel="stylesheet" type="text/css" href="../../../templates/main.css">
  <style>
     .content {
	min-height: 71vh;
	border: 2px solid rgba(157,157,157,1);
	border-radius: 4px;
	border-bottom: none;
	}
	.buttoncontent	{
	 width: 50vh;
	 min-height 71vh;
	}
    .game-container {
      position: relative;
      margin-left: 9vh;
      width: 200px;
      height: 23vh;
      text-align: center;
      background-color: rgba(180,180,180,.3);
      border: 2px solid rgba(46,46,46,.8);
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 20px;
	}

    .content button {
      padding: 10px 20px;
      font-size: 20px;
      cursor: pointer;
    }

    #scoreContainer {
      background-color: rgba(190,190,190,.3);
      border: 2px solid rgba(46,46,46,.8);
      padding: 20px;
      max-height: 30vh;
      border-radius: 10px;
      margin-bottom: 20px;
	text-align: center;
	overflow-y: scroll;
	}
	.scoretext {
		font-weight: bold;
		padding: 3px;
	}

    .container {
      width: 40vh;
      height: 220px;
      background-color: #f0f0f0;
      border-radius: 20px;
      padding: 15px;
    }
    .big-container {
	margin-top: 5vh;
	margin-left: 77vh;
    }
        #click-button {
	    position: absolute;
	    width: 110px; /* Set the button width */
	    height: 65px; /* Set the button height */
	    margin-left: -6vh;
	}
@media only screen and (max-width: 768px) {
.game-container {
	margin-left: 7vh;
}

.big-container {
	margin-left: 5vh;
	}
}
  </style>
</head>
<body>
<?php include('../../../templates/logged/games.php');?>
  <div class="content">

  <div class="buttoncontent">
    <div class="big-container">
	<div class="game-container">
      <h1>Click Game</h1>
      <p>Score: <span id="score">0</span></p>
	<p id="buttonStatus">Button is clickable</p>
      <button id="click-button" onclick="incrementScore()">Click Me!</button>
    </div>

<?php
	// Start a session
	session_start();

	// Initialize the $isValidLogin variable
	$isValidLogin = isset($_SESSION['authorized']) && $_SESSION['authorized'] === true;
	$username = $isValidLogin ? $_SESSION['username'] : '';

	if (!$isValidLogin) {
	    header("Location: ../error");
	    exit();
	}
?>

<div class="container" id="scoreContainer">
<a style="font-size:18px;font-weight:bold;">Resets every Friday randomly.</a> <a style="font-weight:bold;"><br>1st Place - 25 Points<br>2nd Place - 10 Points<br>3rd Place - 5 Points<br><br></a>
  <!-- Leaderboard displayed here -->
    <div id="leaderboard">
    <?php
$leaderboardFile = 'data.json';

function generateLeaderboardHTML($file) {
    $output = '';

    if (file_exists($file) && is_readable($file)) {
        $leaderboardData = file_get_contents($file);
        $decodedData = json_decode($leaderboardData, true);

        if ($decodedData !== null) {
            // Sorting the data based on the 'score' in descending order
            uasort($decodedData, function($a, $b) {
                return $b['highscore'] - $a['highscore'];
            });

	    foreach ($decodedData as $username => $userData) {
		    echo "<script>console.log('Username: {$username}, Score: {$userData['score']}');</script>";
		    $output .= "<div class='scoretext'>{$username}: Score - {$userData['score']}, High Score - {$userData['highscore']}</div>";
            }
        } else {
            $output .= "<div>Error: Invalid JSON data</div>";
        }
    } else {
        $output .= "<div>Error: Data file not found or unreadable</div>";
    }

    return $output;
}
echo generateLeaderboardHTML($leaderboardFile);
?>

	</div>
    <script>
        function updateLeaderboard() {
            var xhttp = new XMLHttpRequest();
            xhttp.onreadystatechange = function() {
                if (this.readyState === 4 && this.status === 200) {
                    document.getElementById("leaderboard").innerHTML = this.responseText;
                }
            };
            xhttp.open("GET", "updateLeaderboard.php", true);
            xhttp.send();
	}

setInterval(updateLeaderboard, 2000);
</script>
</div>
<form>
<input style="font-size:15px;margin-left:20vh" type="button" value="Back" onclick="history.back()">
</form>
</div>
<audio style="margin-left:167vh;" controls loop autoplay>
  <source src="clickergamemusic.mp3" type="audio/mpeg">
  Your browser does not support the audio element.
</audio>
<a style="margin-top:-2px;margin-left:173vh;" href="https://www.youtube.com/watch?v=n5FieRk-42Y&ab_channel=robthebloke">A_slower_chilled_out_vibe....</a>
</div>
</div>
<script>
    let score = 0;
    let canClick = true;
    let resetScoreTimeout;
    let resetClickTimeout;
    let countdown = 5;

    function updateButtonStatus() {
      const buttonStatusElement = document.getElementById('buttonStatus');

      if (canClick) {
        buttonStatusElement.textContent = `Button is clickable`;
      } else {
        buttonStatusElement.textContent = `Button will be clickable in ${countdown} seconds`;
      }
    }

    function decrementCounter() {
      countdown--;
      updateButtonStatus();
      if (countdown > 0) {
        setTimeout(decrementCounter, 1000); // Decrease countdown every second
      } else {
        countdown = 5;
        allowClick(); // Reset the countdown and allow click after 5 seconds
      }
    }

function incrementScore() {
  if (canClick) {
    score++;
    document.getElementById("score").textContent = score;
    canClick = false;
    moveButtonRandomly();

    if (resetScoreTimeout) {
      clearTimeout(resetScoreTimeout);
    }
    resetScoreTimeout = setTimeout(resetScore, 10000);

    decrementCounter(); // Start the countdown
    // Send the score to the PHP script
    saveScoreToPHP(score);

  }
}


    function resetScore() {
      score = 0;
      document.getElementById("score").textContent = score;
      canClick = true;
      updateButtonStatus(); // Update button status when reset
      // Send 0 to the PHP script to update the score
      saveScoreToPHP(0);
    }

    function allowClick() {
      canClick = true;
      updateButtonStatus(); // Update button status when allowed to click again
    }

    function saveScoreToPHP(score) {
  const username = '<?php echo $username; ?>';

  const data = {
    username: username,
    score: score
  };

  fetch('updateScore.php', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify(data)
  })
  .then(response => {
    if (!response.ok) {
      throw new Error('Network response was not ok');
    }
    return response.json();
  })
  .then(data => {
    // Handle the response from the PHP script if needed
    console.log('Score updated successfully');
  })
  .catch(error => {
    console.error('There was an error updating the score:', error);
    });
    }

        function moveButtonRandomly() {
            const contentDiv = document.querySelector('.buttoncontent');
            const button = document.getElementById('click-button');

            const contentRect = contentDiv.getBoundingClientRect();
            const buttonRect = button.getBoundingClientRect();

            const maxX = contentRect.width - buttonRect.width;
            const maxY = contentRect.height - buttonRect.height;

            const randomX = Math.floor(Math.random() * maxX);
	    const randomY = Math.floor(Math.random() * maxY);

            button.style.left = `${randomX}px`;
            button.style.top = `${randomY}px`;
        }
</script>
</body>
    <footer>
        <a>Some content is licensed under </a>
        <li><a style="color:#040404" href="http://creativecommons.org/licenses/by-nc/4.0/?ref=chooser-v1"><i>CC BY-NC 4.0 License</i></a></li>
        <a>All music on this page is owned by <li><a href="https://www.youtube.com/@robthebloke">@Robthebloke</a></li></a>
        <li><a class="active" href="geicomoterms.pdf">Terms And Service</a></li>
    </footer>
</html>


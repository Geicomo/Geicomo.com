<!DOCTYPE html>
<html>
<head>
  <title>Click Game</title>
	<meta name="viewport" content="width=device-width, initial-scale=0.7">
	<link rel="stylesheet" type="text/css" href="../../templates/main.css">
  <style>

    
	.game-container {
	width: 200px;
      text-align: center;
      background-color: #f0f0f0;
      padding: 20px;
      border-radius: 10px;
      margin-bottom: 20px;
	}

    button {
      padding: 10px 20px;
      font-size: 20px;
      cursor: pointer;
    }

    #score-display {
      font-size: 24px;
    }

    .container {

      width: 350px;
      height: 200px;
      overflow-y: scroll;
      background-color: #f0f0f0;
      border-radius: 20px;
      padding: 15px;
    }
  </style>
</head>
<body>
<?php include('../../templates/games.php');?>
  <div class="content">
    <div class="big-container">
	<div class="game-container">
      <h1>Click Game</h1>
      <p>Score: <span id="score">0</span></p>
      <button id="click-button" onclick="incrementScore()">Click Me!</button>
    </div>

    <div class="container" id="user-container">
      <!-- Leaderboard displayed here -->
    </div>
  </div>
</div>
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

  <script>
    let score = 0;
    let canClick = true;
    let resetScoreTimeout;
    let resetClickTimeout;

    function incrementScore() {
      if (canClick) {
        score++;
        document.getElementById("score").textContent = score;
        canClick = false;

        if (resetScoreTimeout) {
          clearTimeout(resetScoreTimeout);
        }
        resetScoreTimeout = setTimeout(resetScore, 10000);

        if (resetClickTimeout) {
          clearTimeout(resetClickTimeout);
        }
        resetClickTimeout = setTimeout(allowClick, 5000);

        // Send the score to the PHP script
	saveScoreToPHP(score);
      }
    }

    function resetScore() {
      score = 0;
      document.getElementById("score").textContent = score;
      canClick = true;

        // Send 0 to the PHP script to update the score
  	saveScoreToPHP(0);
    }

    function allowClick() {
      canClick = true;
    }

	function fetchUserScore() {
        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    // Parse the response to get the score
                    score = parseInt(xhr.responseText.trim());
                    document.getElementById("score").textContent = score;
                } else {
                    console.log('Error: ' + xhr.status);
                }
            }
        };

        xhr.open('GET', 'getUserScore.php', true); // Create a new PHP file to get the user score
        xhr.send();
    }

    // Call the function to fetch the score when the page loads
    window.onload = function() {
        fetchUserScore();
    };

    function saveScoreToPHP(scoreValue) {
      var xhr = new XMLHttpRequest();
      xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            console.log(xhr.responseText); // You can handle the response here if needed
          } else {
            console.log('Error: ' + xhr.status);
          }
        }
      };

      xhr.open('POST', 'saveScore.php', true);
      xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
      xhr.send('score=' + scoreValue);

    }

        function fetchUserData() {
      var xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("user-container").innerHTML = this.responseText;
        }
      };
      xhttp.open("GET", "displayLeaderboard.php", true);
      xhttp.send();
    }

    // Fetch data initially
    fetchUserData();

    setInterval(fetchUserData, 3000); // 5000 milliseconds = 5 seconds
  </script>

</body>
<?php include('../../templates/footer.php');?>
</html>


<!DOCTYPE html>
<html>
<head>
<style>
  body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
  }

  .game-container {
    text-align: center;
    background-color: #f0f0f0;
    padding: 20px;
    border-radius: 10px;
  }

  button {
    padding: 10px 20px;
    font-size: 20px;
    cursor: pointer;
  }

  h1 {
    margin: 0;
  }
</style>
</head>
<body>
  <div class="game-container">
    <h1>Click Game</h1>
    <p>Score: <span id="score">0</span></p>
    <button id="click-button" onclick="incrementScore()">Click Me!</button>
  </div>

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

        // If there's a resetScore timeout, cancel it and start a new one
        if (resetScoreTimeout) {
          clearTimeout(resetScoreTimeout);
        }

        resetScoreTimeout = setTimeout(resetScore, 6000); // Reset the score after 10 seconds of inactivity

        // Allow clicking again after 5 seconds
        if (resetClickTimeout) {
          clearTimeout(resetClickTimeout);
        }
        resetClickTimeout = setTimeout(allowClick, 5000);
      }
    }

    function resetScore() {
      score = 0;
      document.getElementById("score").textContent = score;
      canClick = true;
    }

    function allowClick() {
      canClick = true;
    }
  </script>
</body>
</html>


<!DOCTYPE html>
<html>
<head>
  <title>Geicomos Website | Games Info</title>
	<meta name="viewport" content="width=device-width, initial-scale=0.7">
	<link rel="stylesheet" type="text/css" href="/templates/main.css">
  <style>
	.container {
		margin-left: 60vh;
		border: 2px solid rgba(45,45,45,1);
		border-radius: 3px;
		padding: 5px;
		max-width: 67vh;
	}
	.gamescontainer {
		margin-left: 5px;
		display: inline-block;
		min-width: 300px;
		border: 1px solid rgba(55,55,55,1);
		border-radius: 5px;
		padding: 30px;
		text-align: center;
	}
	.pointsdisplay {
		margin-top 5px;
	}
@media only screen and (max-width: 768px) {
.container {
        margin-left: 1vh;
}
}
  </style>
</head>
<body>
<?php include('../../templates/logged/games.php');?>
<div class="content">
	<h1> Geicomo Games</h1>
	<p>The Geicomo Games is HTML and Javascript games that I spent my free time making to make Geicomo.com more customizable for everyone. You can play games to earn points to spend in the shop to bling out your account. <strong>Gaining points has been implimented!</strong> </p>
	<div class="container">
		<div class="gamescontainer">
			<a href="/logged/games/clickergame/game"><button style="font-size:20px">Clicker Game</button></a><br>
			<a>Click to be the Highest Score, but your regular score resets every 5 seconds.<br></a>
			<a>Leaderboard resets every Friday inbetween 12AM - 11PM. <br>1st - 25 Points <br>2nd - 10 <br>3rd - 5</a>
		</div>
	</div>
</div>
<script>
function fetchUserPoints(username) {
    fetch('clickergame/data.json')
        .then(response => response.json())
        .then(data => {
            const userData = data[username];
            if (userData && userData.points !== undefined) {
                const points = userData.points;
                displayUserPoints(username, points);
            } else {
                displayUserNotFound(username);
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
}

function displayUserPoints(username, points) {
    const userPointsContainer = document.getElementById("userPoints");
    userPointsContainer.innerHTML += `<p style='margin-top:1px;'><strong>${username}</strong> Points: ${points}</p>`;
}

document.addEventListener("DOMContentLoaded", function() {
<a>Leaderboard resets and points are given on Friday at a random time.</a>
    // Get the username from PHP
    const username = '<?php echo $username; ?>';
    fetchUserPoints(username);
});
</script>
</body>
<?php include('../../templates/footer.php');?>
</html>


	<div class="image-text-container">
        <div class="logo-container">
        <h1 style="font-family:courier">Welcome to Geicomo.com</h1>
        </div>
        <div class="text-container">
<div class="random">
<?php include('rmotd.php');?>
</div>
<div class="announcments">
	<a style="float:right"><strong>Announcments:</strong> Register A Email</a>
</div>
</div>
</div>
<ul>
  <li><a class="active" href="https://www.geicomo.com/stat.php">Home</a></li>
  <li><a class="active" href="https://www.geicomo.com/logged/servers/serverlist.php">Servers List</a></li>
  <li><a class="active" href="https://www.geicomo.com/logged/games/gamesinfo.php">Geicomo Games</a></li>
</ul>
<?php
session_start();

$isValidLogin = isset($_SESSION['authorized']) && $_SESSION['authorized'] === true;
$username = $isValidLogin ? $_SESSION['username'] : '';

if (!$isValidLogin) {
    header("Location: /index.php");
    exit;
}

        $jsonData = json_decode(file_get_contents('/var/www/data.json'), true);
	$darkModeEnabled = isset($jsonData[$username]['points']['darkmode']) && $jsonData[$username]['points']['darkmode'];

        if ($darkModeEnabled) {
            echo '<link rel="stylesheet" href="/templates/darkmode.css">';
        } else {
            echo '<link rel="stylesheet" href="/templates/main.css">';
        }
?>

<?php include('logoutbtn.php');?>

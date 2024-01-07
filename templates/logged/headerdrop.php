    <div class="image-text-container">
        <div class="logo-container">
        <h1 style="font-family:courier">Welcome to Geicomo.com</h1>
        </div>
        <div class="text-container">
<div class="random">
<?php include('rmotd.php');?>
</div>	
	<a style="float:right"><strong>Announcments:</strong> New UI!</a>
        </div>
</div>
<ul>
  <li><a class="active" href="/stat">Home</a></li>
          <li class="dropdown">
                <a href="javascript:void(0)" class="dropbtn">Servers List</a>
        <div class="dropdown-content">
                <a href="mcserver">MC Server</a>
                <a href="ruserver">Rust Server</a>
                <a href="pzserver">PZ Server</a>
                <a href="gmodserver">Gmod Server</a>
        </div>
        </li>
  <li><a class="active" href="../games/gamesinfo">Geicomo Games</a></li>
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
<?php include('accountbtn.php');?>

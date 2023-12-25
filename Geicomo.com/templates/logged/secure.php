<style>
        .content {
        border: 2px solid #999;
        background-color: #ebe8e8;
        border-radius: 5px;
        border-top: none;
        border-bottom: none;
        padding: 20px;
        min-height: 70vh;
        position: relative;
        }
        @media (min-width : 1024px) {
                .content {
                        min-height: 80vh;
                }
        }
</style>
	<div class="image-text-container">
        <div class="logo-container">
        <h1 style="font-family:courier">Welcome to Geicomo.com</h1>
        </div>
        <div class="text-container">
<div class="random">
<?php include('rmotd.php');?>
</div>
        <a style="float:right"><strong>Announcments:</strong> Register A Email</a>
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
?>

<?php include('logoutbtn.php');?>

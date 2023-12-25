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
</style>   

 <div class="image-text-container">
        <div class="logo-container">
        <h1 style="font-family:courier">Welcome to Geicomo.com Games!</h1>
        </div>
	<div class="text-container">
	<?php include('rmotd.php');?>
        <a style="float:right"><strong>Announcments:</strong> Gaming</a>
        </div>

</div>
<ul>
  <li><a href="/stat">Home</a></li>
  <li><a class="active" href="https://www.geicomo.com/logged/servers/serverlist">Servers List</a></li>
  <li><a>Geicomo Games</a></li>
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
<?php include('accountbtn.php');?>

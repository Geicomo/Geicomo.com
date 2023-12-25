<!DOCTYPE html>
<html>
<head>
  <title>Geicomos Website | Shop</title>
	<meta name="viewport" content="width=device-width, initial-scale=0.7">
	<link rel="stylesheet" type="text/css" href="../../templates/main.css">
  <style>
  </style>
</head>
<body>
<?php include('../../templates/games.php');?>
<div class="content">
	<h1>Geicomo Shop</h1>
	<p>Spend your hard earned points</p>
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

</body>
<?php include('../../templates/footer.php');?>
</html>


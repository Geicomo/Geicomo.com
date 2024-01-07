<!DOCTYPE html>
<html>
<head>
        <title> Geicomos Website | 404</title>
        <meta name="viewport" content="width=device-width, initial-scale=0.7">
        <link rel="stylesheet" type="text/css" href="https://www.geicomo.com/templates/main.css">
	<script src="https://kit.fontawesome.com/a8e47ed895.js" crossorigin="anonymous"></script>
</head>
<style>
.line {
	border: 2px solid gray;
	border-top: none;
	border-right: none;
	border-left: none;
	font-weight: bold;
	color: black;
	font-size: 45px;
}
</style>
<body>
<?php include('templates/header.php');?>
<div class="content">
        <div class="line">404 Error <i class="fa-sharp fa-solid fa-x"></i></div>
	<p>The page you are looking for has been moved or does not exist! you can return to the website here.</p>
	<button onclick="history.back()">Return</button>
</div>
<?php include('templates/footer.php');?>
</body>
</html>

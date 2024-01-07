<!DOCTYPE html>
<html>
<head>
        <title> Geicomos Website | Photo Gallery</title>
        <meta name="viewport" content="width=device-width, initial-scale=0.7">
	<link rel="stylesheet" type="text/css" href="templates/main.css">
<style>
.content {
        border: 2px solid #999;
        background-color: #ebe8e8;
        border-radius: 5px;
        border-top: none;
        border-bottom: none;
        padding: 20px;
        min-height: 74.3vh;
        position: relative;
}
</style>
</head>
<body>
<?php include('templates/header.php');?>
<?php include('templates/loginbtn.php');?>
<div class="content">
<style>
* {box-sizing: border-box;}
.mySlides {display: none;}
img {vertical-align: middle;}

/* Slideshow container */
.slideshow-container {
  border-radius: 4px;
  max-width: 1000px;
  margin: auto;
  border: 2px solid #787878;
  position: absolute;
  text-align: center;
  top: 57%;
  left: 50%;
  transform: translate(-50%, -50%);
  padding: 10px;
}

/* Caption text */
.text {
  color: black;
  font-size: 15px;
  padding: 10px;
  position: absolute;
  bottom: 18px;
  width: 100%;
  text-align: center;
}

/* Number text (1/3 etc) */
.numbertext {
  color: #f2f2f2;
  font-size: 12px;
  padding: 12px 4px;
  position: absolute;
  top: 0;
}

/* The dots/bullets/indicators */
.dot {
  height: 15px;
  width: 15px;
  margin: 0 3px;
  background-color: #bbb;
  border-radius: 50%;
  display: inline-block;
  transition: background-color 0.6s ease;
}
.prev,
.next {
  cursor: pointer;
  position: absolute;
  top: 50%;
  right: 95.7%;
  width: auto;
  padding: 16px;
  margin-top: -50px;
  color: white;
  font-weight: bold;
  font-size: 20px;
  border-radius: 0 3px 3px 0;
  user-select: none;
  -webkit-user-select: none;
}

.next {
  right: 0;
  border-radius: 3px 0 0 3px;
}
.prev:hover,
.next:hover {
  background-color: rgba(0, 0, 0, 0.2);
}

/* Fading animation */
.fade {
  animation-name: fade;
  animation-duration: 1.5s;
}

@keyframes fade {
  from {opacity: .4}
  to {opacity: 1}
}

/* On smaller screens, decrease text size */
@media only screen and (max-width: 300px) {
  .text {font-size: 11px}
}
.description {
   position: absolute;
   text-align: center;
   top: 8%;
   left: 50%;
   transform: translate(-50%, -50%);
   padding: 10px;
        }
</style>
</head>
<body>
<div class="description">
<h2 style="font-size:35px;">Photo Gallery</h2>
<p style="font-size:16px;">Most of the photos in this slideshow are from a previous server or the current server. <br> Hopefully this inspires you to play.</p>
</div>

<div class="slideshow-container">

<div class="mySlides fade">
  <div class="numbertext">1 / 17</div>
  <img src="/images/mcpictures/minecraftpicture1.jpg" style="width:100%">
  <div class="text">Floating Ocean Chunk</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">2 / 17</div>
  <img src="/images/mcpictures/minecraftpicture2.jpg" style="width:100%">
  <div class="text">Ender Portal</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">3 / 17</div>
  <img src="/images/mcpictures/minecraftpicture3.jpg" style="width:100%">
  <div class="text">Mega Mansion</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">4 / 17</div>
  <img src="/images/mcpictures/minecraftpicture4.jpg" style="width:100%">
  <div class="text">New Port</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">5 / 17</div>
  <img src="/images/mcpictures/minecraftpicture5.jpg" style="width:100%">
  <div class="text">New Port 2</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">6 / 17</div>
  <img src="/images/mcpictures/minecraftpicture6.jpg" style="width:100%">
  <div class="text">Sittin</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">7 / 17</div>
  <img src="/images/mcpictures/minecraftpicture7.jpg" style="width:100%">
  <div class="text">Ender Portal 2</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">8 / 17</div>
  <img src="/images/mcpictures/minecraftpicture8.jpg" style="width:100%">
  <div class="text">Minecraft Save</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">9 / 17</div>
  <img src="/images/mcpictures/minecraftpicture9.jpg" style="width:100%">
  <div class="text">T r e n c h</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">10 / 17</div>
  <img src="/images/mcpictures/minecraftpicture10.jpg" style="width:100%">
  <div class="text">Light House</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">11 / 17</div>
  <img src="/images/mcpictures/minecraftpicture11.jpg" style="width:100%">
  <div class="text">Send Nudes</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">12 / 17</div>
  <img src="/images/mcpictures/minecraftpicture12.jpg" style="width:100%">
  <div class="text">Bombbird</div>
</div>
<!-- PZ Pictures -->
<div class="mySlides fade">
  <div class="numbertext">13 / 17</div>
  <img src="/images/pzpictures/zomboid1.jpg" style="width:100%">
  <div class="text">Bookworms</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">14 / 17</div>
  <img src="/images/pzpictures/zomboid2.jpg" style="width:100%">
  <div class="text">Chillin</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">15 / 17</div>
  <img src="/images/pzpictures/zomboid3.jpg" style="width:100%">
  <div class="text">Biggggg Fish</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">16 / 17</div>
  <img src="/images/pzpictures/zomboid4.jpg" style="width:100%">
  <div class="text">Campfire</div>
</div>

<div class="mySlides fade">
  <div class="numbertext">17 / 17</div>
  <img src="/images/pzpictures/zomboid5.jpg" style="width:100%">
  <div class="text">Cooking in the Cabin</div>
</div>

 <a class="prev" onclick="plusSlides(-1)">❮</a>
  <a class="next" onclick="plusSlides(1)">❯</a>

<br>
<div style="text-align:center">
  <span class="dot"></span>
</div>
</div>
<script>
let slideIndex = 1;
showSlides(slideIndex);

function plusSlides(n) {
  showSlides(slideIndex += n);
}

function currentSlide(n) {
  showSlides(slideIndex = n);
}

function showSlides(n) {
  let i;
  let slides = document.getElementsByClassName("mySlides");
  let captionText = document.getElementById("caption");
  if (n > slides.length) {slideIndex = 1}
  if (n < 1) {slideIndex = slides.length}
  for (i = 0; i < slides.length; i++) {
    slides[i].style.display = "none";
  }
  slides[slideIndex-1].style.display = "block";
}
</script>
</div>
<?php include('templates/footer.php');?>
</body>
</html>

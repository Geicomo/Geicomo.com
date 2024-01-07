<style>
.btn2 {
  position: absolute;
  top: 102px;
  right: 73px;
  margin-right: 5px;
  border-radius: 4px;
  width: 100px;
  height: 40px;
  color: black;
  background-color: #f0f0f0;
  border: none;
  cursor: pointer;
  transition: top 0.3s ease, right 0.3s ease;
}
.btn2 button {
  background-color: #04AA6D;
  border-radius: 4px;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100px;
}

button:hover {
  opacity: 0.8;
}
</style>

<?php
if ($_SESSION['authorized']) {
    echo "<a href='/data/account/profile.php'><button class='btn2' style='width:auto;'>Profile</button></a>";
}
?>


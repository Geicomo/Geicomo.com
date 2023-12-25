<style>
.btn {
  position: absolute;
  top: 102px;
  right: 10px;
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
.btn button {
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
// Check if the logout button was clicked
if (isset($_POST['logout'])) {
    // Unset the authorized session variable to log the user out
    $_SESSION['authorized'] = false;

    // Redirect to the home page after logging out
    echo "<script>window.location.href = '../../index.php';</script>";
    exit;
}

// Check if the user is not logged in, then redirect to index.php
if (!$isValidLogin) {
    header("Location: index.php");
    exit;
}	
    echo "<form method='post' action=''>";
    echo "<button class='btn' type='submit' name='logout' style='width:auto;'>Logout</button>";
    echo "</form>";
} else {
    echo "<a href='/data/login.php'><button class='btn' style='width:auto;'>Login</button></a>";
}
?>


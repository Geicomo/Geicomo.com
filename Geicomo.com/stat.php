<?php
// Prevent caching of the page
header("Cache-Control: no-store, must-revalidate");
header("Pragma: no-cache");
?>
<!DOCTYPE html>
<html>
<body>
<style>
        .box {
        border: solid 2px #898989;
        padding: 10px;
        border-top: none;
        border-left: none;
        border-right: none;
        }
</style>
<?php
session_start();

if (isset($_SESSION['authorized']) && $_SESSION['authorized'] === TRUE) {
    // Alright, let's show all the hidden functionality!
                include("../secure.php");
                exit;
        } else {
                echo '<div class="box">';
                echo "<h1>403 Forbidden </h1>";
                echo "<p><i>Login failed. Please check your username and password.     </i>";
                echo '<input style="padding:5px" type="button" value="Back" onclick="history.back()">';
                echo '</div>';
        }
?>
</body>
</html>

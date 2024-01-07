<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Dynamic Theme Page</title>
    <?php
        // Read the JSON data
        $jsonData = json_decode(file_get_contents('/var/www/data.json'), true);
        $darkModeEnabled = $jsonData['admin']['points']['darkmode']; // Adjust the key as needed

        // Choose the CSS file based on the darkmode value
        if ($darkModeEnabled) {
            echo '<link rel="stylesheet" href="/templates/darkmode.css">';
        } else {
            echo '<link rel="stylesheet" href="/templates/lightmode.css">';
        }
    ?>
</head>
<body>
    <div id="main-content">
        <!-- Your page content -->
    </div>
</body>
</html>


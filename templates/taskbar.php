<style>
.folder-container {
    position: relative;
    display: inline-block; /* Align side by side */
    margin: 5px;
}

.main-folder {
    display: block; /* Ensure full area is clickable */
}

.sub-folders {
    display: none;
    position: absolute;
    bottom: 0; /* Adjust as needed */
    left: 100%; /* Position to the right of the main folder */
}

.folder-container:hover .sub-folders {
    display: block;
}

</style>

<div style="padding:5px;margin-bottom:5px;">
<a id="geicLink" href="https://geicomo.com/home.php">
<img id="geicImage" src="https://geicomo.com/images/closedHfolder.png"></img>
</a>
<a id="geicLink2" href="https://geicomo.com/templates/rmotd.php">
<img id="geicImage2" src="https://geicomo.com/images/closedRfolder.png"></img>
</a>

<div class="folder-container" style="margin-bottom:0px;">
    <a id="geicLink3" href="https://geicomo.com/serverinfo.php">
        <img id="geicImage3" class="main-folder" src="https://geicomo.com/images/closedSfolder.png">
    </a>
    <div class="sub-folders" style="margin-bottom:-5px;">
        <a id="geicLink4" href="https://geicomo.com/servers/minecraft.php"><img id="geicImage4" src="https://geicomo.com/images/closedMCfolder.png"></a>
        <a id="geicLink5" href="https://geicomo.com/servers/pz.php"><img id="geicImage5" src="https://geicomo.com/images/closedPZfolder.png"></a>
        <a id="geicLink6" href="https://geicomo.com/servers/gmod.php"><img id="geicImage6" src="https://geicomo.com/images/closedGMfolder.png"></a>
    </div>
</div>
</div>

<div style="position:fixed;bottom:0">
    <a>All content is licensed under </a>
    <a href="https://creativecommons.org/licenses/by-nc/4.0/?ref=chooser-v1 unless otherwise posted.">CC BY-NC 4.0 DEED</a> unless otherwise posted.
</div>


<script>
    document.getElementById('geicLink').addEventListener('click', function() {
        document.getElementById('geicImage').src = 'https://geicomo.com/images/openHfolder.png';
        resetImagesAfterTimeout();
    });

    document.getElementById('geicLink2').addEventListener('click', function() {
        document.getElementById('geicImage2').src = 'https://geicomo.com/images/openRfolder.png';
        resetImagesAfterTimeout();
    });

    document.getElementById('geicLink3').addEventListener('click', function() {
        document.getElementById('geicImage3').src = 'https://geicomo.com/images/openSfolder.png';
        resetImagesAfterTimeout();
    });

    document.getElementById('geicLink4').addEventListener('click', function() {
        document.getElementById('geicImage4').src = 'https://geicomo.com/images/openMCfolder.png';
        resetImagesAfterTimeout();
    });

    document.getElementById('geicLink5').addEventListener('click', function() {
        document.getElementById('geicImage5').src = 'https://geicomo.com/images/openPZfolder.png';
        resetImagesAfterTimeout();
    });

     document.getElementById('geicLink6').addEventListener('click', function() {
        document.getElementById('geicImage6').src = 'https://geicomo.com/images/openGMfolder.png';
        resetImagesAfterTimeout();
    });
   
    function resetImagesAfterTimeout() {
        setTimeout(function() {
            document.getElementById('geicImage').src = 'https://geicomo.com/images/closedHfolder.png';
            document.getElementById('geicImage2').src = 'https://geicomo.com/images/closedRfolder.png';
            document.getElementById('geicImage3').src = 'https://geicomo.com/images/closedSfolder.png';
            document.getElementById('geicImage4').src = 'https://geicomo.com/images/closedMCfolder.png';
            document.getElementById('geicImage5').src = 'https://geicomo.com/images/closedPZfolder.png';
            document.getElementById('geicImage6').src = 'https://geicomo.com/images/closedGMfolder.png';
        }, 1000); // Reset after 1 second
    }
</script>


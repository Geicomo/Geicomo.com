<?php
include("/var/www/html/data/login.class.php");
session_start();

if(isset($_POST['submit'])){
    $user = new LoginUser($_POST['username'], $_POST['password']);
} elseif(isset($_POST['guestLogin'])) {
    $_SESSION['username'] = 'guest';
    header("location: https://geicomo.com");
    exit;
}
?>

        <link rel="stylesheet" type="text/css" href="https://geicomo.com/templates/base.css">
<style>
	.container {
        	display: flex;
        	align-items: center;
        	justify-content: center;
	}
	.error {
		color: #cc0000;
	}
	.success {
		color: #34b500;
	}
</style>

        <div id="page1" style="height:405px;width:300px;left:86.5vh;top:14vh;" class="draggable-box">
                <div class="title-bar">terms_conditions.info</div>
                        <div style="overflow-y:scroll;" class="content">
                                <?php include '/var/www/html/geicomoterms.php'; ?>
                        </div>
                        <div class="resize-handle"></div>
                </div>
        </div>

        <div id="page1" style="left:90vh;top:15vh;" class="draggable-box">
                <div class="title-bar">register.geic</div>
                        <div  class="content">
 <form action="" method="post" enctype="multipart/form-data" autocomplete="off">
        <div class="container"><a style="font-family:courier;font-size:37px"><strong>Sign In</strong></a></div>
                <div class="container"><p style="font-size:16px;font-weight:bold;">Both fields are <span>required</span></p></div>
        <div class="container">
                <label>Username</label>
        </div>
        <div class="container">
                <input type="text" name="username">
        </div>
        <div class="container">
                <label>Password</label>
        </div>
        <div class="container">
                <input type="password" name="password"><br>
        </div>
<div class="container">
                <button style="display:flex;align-items:center;justify-content:center;margin-top:12px;font-size:12px;height:25px;width:100px;float:left;background-color:#1CB500;" type="submit" name="submit">Sign In</button>

                <a href="https://geicomo.com/register"><button type="button" style="margin-top:12px;font-size:12px;height:25px;width:100px;float:left;background-color:#00B2FF;">Sign Up</button></a> <br>
</div>
<div class="container"><button type="submit" name="guestLogin" style="margin-top:6px;font-size:12px;height:35px;width:100px;float:left;background-color:#FFA500;font-weight:bold;">Sign in as Guest</button></div>
<div class="container"><a style="font-size:12px;margin-top:5px;" href="https://geicomo.com/frgpassword/frgpassword.php">Forgot Password</a></div>
	<div class="container"><p class="error"><?php echo @$user->error ?></p></div>
        <div class="container"><p class="success"><?php echo @$user->success ?></p></div>
</form>
                        </div>
                </div>
	</div>

<script>
function makeDraggable(element) {
    const titleBar = element.querySelector('.title-bar');
    let isDragging = false;

    titleBar.addEventListener('mousedown', function(event) {
        event.preventDefault(); // Prevent default action (like text selection)
        if (event.target === this) {
            isDragging = true;
            let shiftX = event.clientX - element.getBoundingClientRect().left;
            let shiftY = event.clientY - element.getBoundingClientRect().top;

            element.style.position = 'absolute';
            element.style.zIndex = 1000;
            document.body.append(element);

            function moveAt(pageX, pageY) {
                element.style.left = pageX - shiftX + 'px';
                element.style.top = pageY - shiftY + 'px';
            }

            moveAt(event.pageX, event.pageY);

            function onMouseMove(event) {
                if (isDragging) {
                    moveAt(event.pageX, event.pageY);
                }
            }

            document.addEventListener('mousemove', onMouseMove);

            document.addEventListener('mouseup', function mouseUpHandler() {
                document.removeEventListener('mousemove', onMouseMove);
                isDragging = false;
            }, { once: true });
        }
    });

    element.ondragstart = function() {
        return false;
    };
}

        function createNewPageDiv(url) {
    fetch(url)
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const pageTitle = doc.title;

            // Find all existing divs with the same title
            const existingDivs = Array.from(document.querySelectorAll('.draggable-box .title-bar'))
                                      .filter(titleBar => titleBar.textContent.includes(pageTitle));

            // Calculate the offset based on the number of existing divs
            const offset = existingDivs.length * 20; // Example: 20px per existing div

            // Create a new div
            const newPageDiv = document.createElement('div');
            newPageDiv.className = 'draggable-box';
            newPageDiv.style.top = offset + 'px'; // Apply the offset
            newPageDiv.style.left = offset + 'px';

            const resizeHandle = document.createElement('div');
            resizeHandle.className = 'resize-handle';
            newPageDiv.appendChild(resizeHandle);

            const titleBar = document.createElement('div');
            titleBar.className = 'title-bar';
            titleBar.textContent = pageTitle;

            const closeButton = document.createElement('span');
            closeButton.className = 'close-button';
            closeButton.textContent = 'X';
            closeButton.onclick = function() { closeBox(this); };
            titleBar.appendChild(closeButton);

            newPageDiv.appendChild(titleBar);

            const contentDiv = document.createElement('div');
            contentDiv.className = 'content';
            contentDiv.innerHTML = html;
            newPageDiv.appendChild(contentDiv);

            document.body.appendChild(newPageDiv);
            makeDraggable(newPageDiv);
            makeResizable(newPageDiv);
        })
        .catch(error => console.error('Error fetching content:', error));
}


        function closeBox(closeButtonElement) {
            const draggableBox = closeButtonElement.closest('.draggable-box');
            if (draggableBox) {
                draggableBox.remove();
            }
        }

        document.body.addEventListener('click', function(event) {
            if (event.target.tagName === 'A' && event.target.closest('.draggable-box')) {
                event.preventDefault();
                createNewPageDiv(event.target.href);
            }
        });

        function makeResizable(element) {
    const resizeHandle = element.querySelector('.resize-handle');
    let originalWidth, originalHeight, originalMouseX, originalMouseY;

    resizeHandle.addEventListener('mousedown', function(e) {
        e.preventDefault();
        originalWidth = parseFloat(getComputedStyle(element, null).getPropertyValue('width').replace('px', ''));
        originalHeight = parseFloat(getComputedStyle(element, null).getPropertyValue('height').replace('px', ''));
        originalMouseX = e.pageX;
        originalMouseY = e.pageY;

        document.addEventListener('mousemove', resizeElement);
        document.addEventListener('mouseup', stopResize);
    });

    function resizeElement(e) {
        const width = originalWidth + (e.pageX - originalMouseX);
        const height = originalHeight + (e.pageY - originalMouseY);
        element.style.width = width + 'px';
        element.style.height = height + 'px';
    }

    function stopResize() {
        document.removeEventListener('mousemove', resizeElement);
        document.removeEventListener('mouseup', stopResize);
    }
}

        function applyDraggableToExistingBoxes() {
            document.querySelectorAll('.draggable-box').forEach(makeDraggable);
            document.querySelectorAll('.draggable-box').forEach(makeResizable);
        }

        document.addEventListener('DOMContentLoaded', applyDraggableToExistingBoxes);

document.querySelectorAll('.draggable-box').forEach(makeResizable);

        </script>


<div style="position:fixed;bottom:0">
        <a>All content is licensed under </a><a href="https://creativecommons.org/licenses/by-nc/4.0/?ref=chooser-v1 unless otherwise posted.">CC BY-NC 4.0 DEED</a> unless otherwise posted.</a>
</div>
</div>

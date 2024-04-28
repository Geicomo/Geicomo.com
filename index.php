<?php
session_start();
if (isset($_SESSION['authorized']) && $_SESSION['authorized'] === true) {
        $_SESSION['authorized'] = false;
        $_POST['username'] = "Guest";
    }
?>
<!--
 ________  _______   ___  ________  ________  _____ ______   ________      
|\   ____\|\  ___ \ |\  \|\   ____\|\   __  \|\   _ \  _   \|\   __  \    
\ \  \___|\ \   __/|\ \  \ \  \___|\ \  \|\  \ \  \|\__\ \  \ \  \|\  \   
 \ \  \  __\ \  \_|/_\ \  \ \  \    \ \  \|\  \ \  \||__| \  \ \  \|\  \   
  \ \  \|\  \ \  \_|\ \ \  \ \  \____\ \  \|\  \ \  \    \ \  \ \  \|\  \ 
   \ \_______\ \_______\ \__\ \_______\ \_______\ \__\    \ \__\ \_______\ 
    \|_______|\|_______|\|__|\|_______|\|_______|\|__|     \|__|\|_______|

All content is licensed under CC BY-NC 4.0 DEED unless otherwise posted.
--!>

<!DOCTYPE html>
<html lang="en">
<head>
        <title>Geic OS</title>
        <meta name="viewport" content="width=device-width, initial-scale=0.7">
        <link rel="stylesheet" type="text/css" href="https://geicomo.com/templates/base.css">
</head>
<body>
	<div id="page1" class="draggable-box">
        	<div class="title-bar">
                        <a style="padding:2px 10px;">home.geic</a>
                        <div class="dropdowndiv">
				<div class="dropdown">
				<div class="dropbtn">File</div>
        			<div class="dropdown-content">
          				<div id="link1" class="dItem">Directory
            					<div class="dropdown-content2">
              						<button class="open-window-button dItem" id="file" data-url="https://geicomo.com/home.php">./home.geic</button>
              						<button class="open-window-button dItem" id="file" data-url="https://geicomo.com/info.php">./info.geic</button>
              						<button class="open-window-button dItem" id="file" data-url="https://geicomo.com/serverinfo.php">./servers.geic</button>
            					</div>
          				</div>
        			</div>
      				</div> 

				<div class="dropdown">
				<div class="dropbtn">Edit</div>
        			<div class="dropdown-content">
				
				</div>
      				</div>

				<div class="dropdown">
				<div class="dropbtn">View</div>
				<div class="dropdown-content">
					<div class="dItem" id="file">Reset</div>
					<a class="dItem" onclick="closeBox(this)">Close</a>
        			</div>
      				</div>
			</div>
                        <span class="close-button" onclick="closeBox(this)">X</span></div>
                <div style="height:100%;padding:2px;background-color:#838383;">
                        <div class="content">
        <?php include( '/var/www/html/home.php' ); ?>
                        </div>
                                <div class="resize-handle"></div>
                        </div>
                </div>
	</div>

	<div id="page1" class="draggable-box" style="left:74vh;">
        	<div class="title-bar">
                        <a style="padding:2px 10px;">rmotd.info</a>
                        <div class="dropdowndiv">
				<div class="dropdown">
				<div class="dropbtn">File</div>
        			<div class="dropdown-content">
          				<div id="link1" class="dItem">Directory
            					<div class="dropdown-content2">
              						<button class="open-window-button dItem" id="file" data-url="https://geicomo.com/home.php">./home.geic</button>
              						<button class="open-window-button dItem" id="file" data-url="https://geicomo.com/info.php">./info.geic</button>
              						<button class="open-window-button dItem" id="file" data-url="https://geicomo.com/serverinfo.php">./servers.geic</button>
            					</div>
          				</div>
        			</div>
      				</div> 

				<div class="dropdown">
				<div class="dropbtn">Edit</div>
        			<div class="dropdown-content">
				
				</div>
      				</div>

				<div class="dropdown">
				<div class="dropbtn">View</div>
				<div class="dropdown-content">
					<div class="dItem" id="file">Reset</div>
					<a class="dItem" onclick="closeBox(this)">Close</a>
        			</div>
      				</div>
			</div>
                        <span class="close-button" onclick="closeBox(this)">X</span></div>
                <div style="height:100%;padding:2px;background-color:#838383;">
                        <div class="content">
        <?php include( '/var/www/html/templates/rmotd.php' ); ?>
                        </div>
                                <div class="resize-handle"></div>
                        </div>
                </div>
	</div>

	<div id="page1" class="draggable-box" style="left:149vh;">
        	<div class="title-bar">
                        <a style="padding:2px 10px;">user_info.geic</a>
                        <div class="dropdowndiv">
				<div class="dropdown">
				<div class="dropbtn">File</div>
        			<div class="dropdown-content">
          				<div id="link1" class="dItem">Directory
            					<div class="dropdown-content2">
              						<button class="open-window-button dItem" id="file" data-url="https://geicomo.com/home.php">./home.geic</button>
              						<button class="open-window-button dItem" id="file" data-url="https://geicomo.com/info.php">./info.geic</button>
              						<button class="open-window-button dItem" id="file" data-url="https://geicomo.com/serverinfo.php">./servers.geic</button>
            					</div>
          				</div>
        			</div>
      				</div> 

				<div class="dropdown">
				<div class="dropbtn">Edit</div>
        			<div class="dropdown-content">
				
				</div>
      				</div>

				<div class="dropdown">
				<div class="dropbtn">View</div>
				<div class="dropdown-content">
					<div class="dItem" id="file">Reset</div>
					<a class="dItem" onclick="closeBox(this)">Close</a>
        			</div>
      				</div>
			</div>
                        <span class="close-button" onclick="closeBox(this)">X</span></div>
                <div style="height:100%;padding:2px;background-color:#838383;">
                        <div class="content">
        <?php include( '/var/www/html/userinfo.php' ); ?>
                        </div>
                                <div class="resize-handle"></div>
                        </div>
                </div>
	</div>

	<div id="page1" class="draggable-box" style="top:35vh;">
        	<div class="title-bar">
                        <a style="padding:2px 10px;">sing_in.geic</a>
                        <div class="dropdowndiv">
				<div class="dropdown">
				<div class="dropbtn">File</div>
        			<div class="dropdown-content">
          				<div id="link1" class="dItem">Directory
            					<div class="dropdown-content2">
              						<button class="open-window-button dItem" id="file" data-url="https://geicomo.com/home.php">./home.geic</button>
              						<button class="open-window-button dItem" id="file" data-url="https://geicomo.com/info.php">./info.geic</button>
              						<button class="open-window-button dItem" id="file" data-url="https://geicomo.com/serverinfo.php">./servers.geic</button>
            					</div>
          				</div>
        			</div>
      				</div> 

				<div class="dropdown">
				<div class="dropbtn">Edit</div>
        			<div class="dropdown-content">
				
				</div>
      				</div>

				<div class="dropdown">
				<div class="dropbtn">View</div>
				<div class="dropdown-content">
					<div class="dItem" id="file">Reset</div>
					<a class="dItem" onclick="closeBox(this)">Close</a>
        			</div>
      				</div>
			</div>
                        <span class="close-button" onclick="closeBox(this)">X</span></div>
                <div style="height:100%;padding:2px;background-color:#838383;">
                        <div class="content">
        <?php include( '/var/www/html/guest/guestlogin.php' ); ?>
                        </div>
                                <div class="resize-handle"></div>
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

const menuTemplate = `
                        <div class="dropdowndiv">
				<div class="dropdown">
				<div class="dropbtn">File</div>
        			<div class="dropdown-content">
          				<div id="link1" class="dItem">Directory
            					<div class="dropdown-content2">
              						<button class="open-window-button dItem" id="file" data-url="https://geicomo.com/home.php">./home.geic</button>
              						<button class="open-window-button dItem" id="file" data-url="https://geicomo.com/info.php">./info.geic</button>
              						<button class="open-window-button dItem" id="file" data-url="https://geicomo.com/serverinfo.php">./servers.geic</button>
            					</div>
          				</div>
        			</div>
      				</div> 

				<div class="dropdown">
				<div class="dropbtn">Edit</div>
        			<div class="dropdown-content">
				
				</div>
      				</div>

				<div class="dropdown">
				<div class="dropbtn">View</div>
				<div class="dropdown-content">
					<div class="dItem" id="file">Reset</div>
					<a class="dItem" onclick="closeBox(this)">Close</a>
        			</div>
      				</div>
			</div>
`;


function createNewPageDiv(url) {
    fetch(url)
        .then(response => response.text())
        .then(html => {
            const parser = new DOMParser();
            const doc = parser.parseFromString(html, 'text/html');
            const pageTitle = doc.title;

            const existingDivs = Array.from(document.querySelectorAll('.draggable-box .title-bar'))
                                      .filter(titleBar => titleBar.textContent.includes(pageTitle));
            const offset = existingDivs.length * 20;

            const newPageDiv = document.createElement('div');
            newPageDiv.className = 'draggable-box';
            newPageDiv.style.top = `${offset}px`;
            newPageDiv.style.left = `${offset}px`;

            const titleBar = document.createElement('div');
            titleBar.className = 'title-bar';
            titleBar.innerHTML = `<span style="padding:2px 10px;" class="page-title">${pageTitle}</span>` + menuTemplate ;

            const closeButton = document.createElement('span');
            closeButton.className = 'close-button';
            closeButton.textContent = 'X';
            closeButton.onclick = function() { closeBox(this); };
            titleBar.appendChild(closeButton);

            const resizeHandle = document.createElement('div');
            resizeHandle.className = 'resize-handle';
            newPageDiv.appendChild(resizeHandle);

            newPageDiv.appendChild(titleBar);

	    const spacerDiv = document.createElement('div');
            spacerDiv.className = 'spacer';

            const contentDiv = document.createElement('div');
            contentDiv.className = 'content';
            contentDiv.innerHTML = html;
            newPageDiv.appendChild(spacerDiv);
            spacerDiv.appendChild(contentDiv);

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
    if (event.target.tagName === 'BUTTON' && event.target.classList.contains('open-window-button') && event.target.closest('.draggable-box')) {
        event.preventDefault();
        const url = event.target.getAttribute('data-url');
        if (url) {
            createNewPageDiv(url);
        }
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

</script>

<div style="position:fixed;bottom:0">
        <a>All content is licensed under </a><a href="https://creativecommons.org/licenses/by-nc/4.0/?ref=chooser-v1 unless otherwise posted.">CC BY-NC 4.0 DEED</a> unless otherwise posted.</a>

</div>
</body>
</html>

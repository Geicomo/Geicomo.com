<!DOCTYPE html>
<html lang="en">
<head>
        <title>Geic OS</title>
        <meta name="viewport" content="width=device-width, initial-scale=0.7">
        <link rel="stylesheet" type="text/css" href="templates/base.css">
</head>
<style>
.draggable-box {
    position: absolute;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
}
</style>
<body>
    <div id="container">
        <div id="page1" class="draggable-box">
            <div class="title-bar">sign_in.geic<span class="close-button" onclick="closeBox(this)">X</span></div>
            <div class="content">
        <?php include 'data/login.php'; ?>
    </div>
<div class="resize-handle"></div>
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
</body>
</html>



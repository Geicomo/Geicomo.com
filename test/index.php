<?php
session_start(); // Start the session

// Check if a username is passed via query parameters
if (isset($_GET['username'])) {
    // Store the username in the session
    $_SESSION['username'] = $_GET['username'];

    // Redirect to the same page without the query parameter to avoid exposing it in the URL
    header('Location: https://geicomo.com/test/index.php');
    exit;
}

// Load user data
$userData = json_decode(file_get_contents('./programs/scripts/users.json'), true);
$currentUser = $_SESSION['username'] ?? null;

// Retrieve user attributes
$userAttributes = $userData[$currentUser]['attributes'] ?? [];
$background = $userAttributes['background'] ?? '#2c3e50'; // Default to a dark gray color if not set
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Geicomo.com</title>
    <style>
        body {
            	margin: 0;
            	padding: 0;
            	font-family: Arial, sans-serif;
        }
        #desktop {
        	position: relative;
        	width: 100vw;
        	height: 100vh;
        	overflow: hidden;
        	background-color: <?= htmlspecialchars($background) ?> !important; 
    }
	.icon {
            	display: inline-block;
            	text-align: center;
            	color: #ecf0f1;
            	font-size: 12px;
            	margin: 10px;
            	cursor: pointer;
        }
        .icon img {
            width: 50px;
            height: 50px;
        }
        .window {
            position: absolute;
            top: 100px;
            left: 100px;
            width: 400px;
	    height: 300px;
            max-height: 850px;
            background-color: #ecf0f1;
            border: 2px solid #bdc3c7;
            box-shadow: 2px 2px 8px rgba(0, 0, 0, 0.2);
            resize: both;
            overflow: hidden;
        }
        .title-bar {
            background-color: #34495e;
            color: #ecf0f1;
            padding: 5px 10px;
            font-size: 14px;
            cursor: move;
        }
        .content {
            height: calc(100% - 30px);
            overflow: hidden;
        }
        .close-btn {
            float: right;
            cursor: pointer;
            color: #e74c3c;
            font-weight: bold;
        }
    </style>
</head>
<body>	
<div id="desktop" style="background-color: url('<?= $background ?>') no-repeat center center; background-size: cover;">	
	<?php
        $programsDir = './programs/';
        $scriptsDir = './programs/scripts/';
        $phpDir = './programs/';

        function extractTitle($filePath) {
            $content = file_get_contents($filePath);
            if (preg_match('/<title>(.*?)<\/title>/', $content, $matches)) {
                return $matches[1];
            }
            return "Unnamed Program";
        }

        // Scan for HTML programs
        $programFiles = scandir($programsDir);
        foreach ($programFiles as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'html') {
                $programTitle = extractTitle($programsDir . $file);
                echo "<div class='icon' onclick='openHtmlProgram(\"$programsDir$file\", \"$programTitle\")'>
                        <img src='path/to/icon.png' alt='$programTitle'>
                        <div>$programTitle</div>
                      </div>";
            }
        }

        // Scan for JavaScript-based programs
        $scriptFiles = scandir($scriptsDir);
        foreach ($scriptFiles as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'js') {
                $programName = pathinfo($file, PATHINFO_FILENAME);
                echo "<div class='icon' onclick='openJsProgram(\"$scriptsDir$file\", \"$programName\")'>
                        <img src='https://geicomo.com/images/Blockade.png' alt='$programName'>
                        <div>$programName</div>
                      </div>";
            }
        }

        // Scan for PHP programs
        $phpFiles = scandir($phpDir);
        foreach ($phpFiles as $file) {
            if (pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                $programName = pathinfo($file, PATHINFO_FILENAME);
                echo "<div class='icon' onclick='openPhpProgram(\"$phpDir$file\", \"$programName\")'>
                        <img src='path/to/icon.png' alt='$programName'>
                        <div>$programName</div>
                      </div>";
            }
        }
        ?>
    </div>

    <script>
        let programCounter = 0;
        let programStates = JSON.parse(localStorage.getItem('programStates')) || {};

        function saveProgramState(id, state) {
            programStates[id] = state;
            localStorage.setItem('programStates', JSON.stringify(programStates));
        }

        function removeProgramState(id) {
            delete programStates[id];
            localStorage.setItem('programStates', JSON.stringify(programStates));
        }

        function restorePrograms() {
            const desktop = document.getElementById('desktop');
            for (const [id, state] of Object.entries(programStates)) {
                if (state.type === 'js') {
                    openJsProgram(state.filePath, state.programTitle, id, state);
                } else {
                    createWindow(state.type, state.filePath, state.programTitle, id, state);
                }
            }
        }

function createWindow(type, filePath, programTitle, id = null, state = {}) {
    const desktop = document.getElementById('desktop');
    const instanceId = id || ++programCounter;

    const windowEl = document.createElement('div');
    windowEl.className = 'window';
    windowEl.style.left = `${state.x || 100}px`;
    windowEl.style.top = `${state.y || 100}px`;

    const titleBar = document.createElement('div');
    titleBar.className = 'title-bar';
    titleBar.innerHTML = `<span>${programTitle} (Instance: ${instanceId})</span>
                          <span class="close-btn">X</span>`;
    windowEl.appendChild(titleBar);

    const content = document.createElement('div');
    content.className = 'content';
    const iframe = document.createElement('iframe');
    iframe.src = filePath;
    iframe.style.width = '100%';
    iframe.style.border = 'none';
    content.appendChild(iframe);
    windowEl.appendChild(content);

    titleBar.querySelector('.close-btn').addEventListener('click', () => {
        desktop.removeChild(windowEl);
        removeProgramState(instanceId);
    });

    enableDrag(windowEl, titleBar, instanceId, type, filePath, programTitle);
    desktop.appendChild(windowEl);

iframe.onload = () => {
    try {
        const iframeDocument = iframe.contentDocument || iframe.contentWindow.document;
        const contentWidth = iframeDocument.body.scrollWidth;
        const contentHeight = iframeDocument.body.scrollHeight;

        // Update iframe size
        iframe.style.height = `${contentHeight}px`;

        // Update window size
        windowEl.style.width = `${contentWidth + 20}px`; // Adding padding for borders
        windowEl.style.height = `${contentHeight + 50}px`; // Adding padding for title bar and other elements

        saveProgramState(instanceId, {
            type,
            filePath,
            programTitle,
            x: parseInt(windowEl.style.left),
            y: parseInt(windowEl.style.top),
            width: contentWidth + 20,
            height: contentHeight + 50,
        });
    } catch (error) {
        console.error("Error resizing iframe content:", error);
    }
};


    if (!id) {
        saveProgramState(instanceId, {
            type,
            filePath,
            programTitle,
            x: 100,
            y: 100,
            width: 400, // Default width before content is loaded
            height: 300, // Default height before content is loaded
        });
    }
}

        function openHtmlProgram(filePath, programTitle) {
            createWindow('html', filePath, programTitle);
        }

        function openPhpProgram(filePath, programTitle) {
            createWindow('php', filePath, programTitle);
        }

        function openJsProgram(filePath, programTitle, id = null, state = {}) {
            const desktop = document.getElementById('desktop');
            const instanceId = id || ++programCounter;

            const windowEl = document.createElement('div');
            windowEl.className = 'window';
            windowEl.style.left = `${state.x || 100}px`;
            windowEl.style.top = `${state.y || 100}px`;
            windowEl.style.width = `${state.width || 400}px`;
            windowEl.style.height = `${state.height || 300}px`;

            const titleBar = document.createElement('div');
            titleBar.className = 'title-bar';
            titleBar.innerHTML = `<span>${programTitle} (Instance: ${instanceId})</span>
                                  <span class="close-btn">X</span>`;
            windowEl.appendChild(titleBar);

            const content = document.createElement('div');
            content.className = 'content';
            content.id = `program-container-${instanceId}`;
            windowEl.appendChild(content);

            titleBar.querySelector('.close-btn').addEventListener('click', () => {
                desktop.removeChild(windowEl);
                removeProgramState(instanceId);
            });

            enableDrag(windowEl, titleBar, instanceId, 'js', filePath, programTitle);

            const script = document.createElement('script');
            script.src = filePath;
            script.onload = () => {
                if (typeof initProgram === 'function') {
                    initProgram(content.id);
                }
            };
            document.body.appendChild(script);

            desktop.appendChild(windowEl);

            if (!id) {
                saveProgramState(instanceId, {
                    type: 'js',
                    filePath,
                    programTitle,
                    x: 100,
                    y: 100,
                    width: 400,
                    height: 300,
                });
            }
        }

        function enableDrag(windowEl, titleBar, instanceId, type, filePath, programTitle) {
            let isDragging = false;
            let offsetX, offsetY;

            titleBar.addEventListener('mousedown', (e) => {
                isDragging = true;
                offsetX = e.offsetX;
                offsetY = e.offsetY;
            });

            document.addEventListener('mousemove', (e) => {
                if (isDragging) {
                    const x = e.clientX - offsetX;
                    const y = e.clientY - offsetY;
                    windowEl.style.left = `${x}px`;
                    windowEl.style.top = `${y}px`;

                    saveProgramState(instanceId, {
                        type,
                        filePath,
                        programTitle,
                        x,
                        y,
                        width: windowEl.offsetWidth,
                        height: windowEl.offsetHeight,
                    });
                }
            });

            document.addEventListener('mouseup', () => {
                isDragging = false;
            });

            windowEl.addEventListener('resize', () => {
                saveProgramState(instanceId, {
                    type,
                    filePath,
                    programTitle,
                    x: parseInt(windowEl.style.left),
                    y: parseInt(windowEl.style.top),
                    width: windowEl.offsetWidth,
                    height: windowEl.offsetHeight,
                });
            });
        }

        window.addEventListener('load', restorePrograms);
    </script>
</body>
</html>


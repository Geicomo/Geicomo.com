function initProgram(containerId) {
    const container = document.getElementById(containerId);
    container.style.position = 'relative';
    container.style.background = '#1abc9c';
    container.style.overflow = 'hidden';
// Game objects
    let playerRadius = 15; 
    const redCircleSize = 20; 
    const greenCircleSize = 20;
    const spawnInterval = 500; 
    const fallSpeed = 4;

// Start menu
    const startMenu = document.createElement('div');
    startMenu.style.position = 'absolute';
    startMenu.style.top = '0';
    startMenu.style.left = '0';
    startMenu.style.width = '100%';
    startMenu.style.height = '100%';
    startMenu.style.background = 'rgba(0, 0, 0, 0.7)';
    startMenu.style.display = 'flex';
    startMenu.style.flexDirection = 'column';
    startMenu.style.alignItems = 'center';
    startMenu.style.justifyContent = 'center';
    startMenu.style.color = '#fff';
    startMenu.style.fontSize = '24px';
    startMenu.style.zIndex = '10';
    container.appendChild(startMenu);

    const title = document.createElement('h1');
    title.innerText = 'Blockade Game';
    title.style.marginBottom = '10px';
    startMenu.appendChild(title);

    const info = document.createElement('a');
    info.innerText = 'Dont miss any green circles and dont hit the red circles.';
    info.style.fontSize = '12px';
    info.style.marginBottom = '8px';
    startMenu.appendChild(info);

    const playButton = document.createElement('button');
    playButton.innerText = 'Play';
    playButton.style.padding = '10px 20px';
    playButton.style.fontSize = '18px';
    playButton.style.border = 'none';
    playButton.style.borderRadius = '5px';
    playButton.style.background = '#3498db';
    playButton.style.color = '#fff';
    playButton.style.cursor = 'pointer';
    playButton.addEventListener('click', () => {
        startMenu.style.display = 'none'; // Hide the start menu
        startGame(); // Start the game
    });
 startMenu.appendChild(playButton);

    const player = document.createElement('div');
    const scoreDisplay = document.createElement('div');
    const gameOverDisplay = document.createElement('div');
    let score = 0;
    let spawnIntervalId, updateIntervalId;
    let gameRunning = false;

function startGame() {
    gameRunning = true;

    player.style.position = 'absolute';
    player.style.width = `${playerRadius * 2}px`;
    player.style.height = `${playerRadius * 2}px`;
    player.style.background = '#3498db';
    player.style.borderRadius = '50%';
    player.style.pointerEvents = 'none';
    container.appendChild(player);

    scoreDisplay.innerText = `Score: ${score}`;
    scoreDisplay.style.position = 'absolute';
    scoreDisplay.style.top = '5px';
    scoreDisplay.style.left = '5px';
    scoreDisplay.style.color = '#fff';
    scoreDisplay.style.fontSize = '16px';
    container.appendChild(scoreDisplay);

    gameOverDisplay.innerText = '';
    gameOverDisplay.style.position = 'absolute';
    gameOverDisplay.style.top = '50%';
    gameOverDisplay.style.left = '50%';
    gameOverDisplay.style.transform = 'translate(-50%, -50%)';
    gameOverDisplay.style.color = '#fff';
    gameOverDisplay.style.fontSize = '24px';
    gameOverDisplay.style.display = 'none';
    container.appendChild(gameOverDisplay);

    const spawnIntervalId = setInterval(spawnFallingObject, spawnInterval);
    const updateIntervalId = setInterval(updateGameState, 16);
	}

    const nameForm = document.createElement('div');
    nameForm.style.display = 'none';
    nameForm.style.position = 'absolute';
    nameForm.style.top = '50%';
    nameForm.style.left = '50%';
    nameForm.style.transform = 'translate(-50%, -50%)';
    nameForm.style.background = '#ecf0f1';
    nameForm.style.padding = '20px';
    nameForm.style.borderRadius = '8px';
    nameForm.style.boxShadow = '0 4px 8px rgba(0, 0, 0, 0.2)';
    nameForm.innerHTML = `
        <h3>Save Your Score</h3>
        <form id="saveScoreForm">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="name" required><br><br>
            <label for="password">Password:</label><br>
            <input type="password" id="password" name="password" required><br><br>
            <button type="submit">Save Score</button><br>
	    <a style="font-size:12px;"><i>You can create a account if you dont have one.</i></a>
        </form>
    `;
    container.appendChild(nameForm);

// Check if user is logged in
const urlParams = new URLSearchParams(window.location.search);
const loggedInUser = sessionStorage.getItem('username') || urlParams.get('username');

function autoSaveScore(score) {
    fetch('./programs/scripts/save_user.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ score: score }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.status === 'success') {
                alert(data.message);
	    } else {
                console.error('Error saving score:', data.message);
            }
        })
        .catch((error) => console.error('Error:', error));
}

function saveScore(name, password, score) {
    fetch('./programs/scripts/save_user.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ name, password, score }),
    })
        .then((response) => response.json())
        .then((data) => {
            if (data.status === 'success') {
                alert(data.message);
            } else {
                alert(`Error: ${data.message}`);
            }
            nameForm.style.display = 'none'; // Hide the form after submission
        })
        .catch((error) => {
            console.error('Error:', error);
            alert('An error occurred while saving your score.');
        });
}

// End the game
function gameOver() {
    gameRunning = false;

    clearInterval(spawnIntervalId);
    clearInterval(updateIntervalId);

    if (loggedInUser) {
        autoSaveScore(score);
	console.log("Auto applying score...");
    } else {
        nameForm.style.display = 'block';
	console.log("Manually apply score...");
    }
}

    if (!loggedInUser) {
        document.getElementById('saveScoreForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const name = document.getElementById('name').value;
            const password = document.getElementById('password').value;
            saveScore(name, password, score);
        });
    }

    let isMouseInside = false;

    container.addEventListener('mouseenter', () => {
        isMouseInside = true;

    });

    container.addEventListener('mouseleave', () => {
        isMouseInside = false;
    });

    container.addEventListener('mousemove', (e) => {
        if (isMouseInside) {
            const rect = container.getBoundingClientRect();
            const mouseX = e.clientX - rect.left;
            const mouseY = e.clientY - rect.top;

            player.style.left = `${mouseX - playerRadius}px`;
            player.style.top = `${mouseY - playerRadius}px`;
        }
    });

    const fallingObjects = [];
    function spawnFallingObject() {
	if (!gameRunning) return;
        if (isMouseInside) {
            const isGreen = Math.random() < 0.5; // 50% chance of green or red circle
            const object = document.createElement('div');
            object.style.position = 'absolute';
            object.style.width = `${isGreen ? greenCircleSize : redCircleSize}px`;
            object.style.height = `${isGreen ? greenCircleSize : redCircleSize}px`;
            object.style.top = '0px';
            object.style.left = `${Math.random() * (container.offsetWidth - redCircleSize)}px`;
            object.style.background = isGreen ? '#2ecc71' : '#e74c3c'; // Green or Red
            object.dataset.type = isGreen ? 'green' : 'red';
            object.style.borderRadius = '50%';
            container.appendChild(object);
            fallingObjects.push(object);
        }
    }

    function updateGameState() {
	if (!gameRunning) return;
        if (!isMouseInside || gameOverDisplay.style.display === 'block') return;

        for (let i = fallingObjects.length - 1; i >= 0; i--) {
            const object = fallingObjects[i];
            const objectY = parseFloat(object.style.top);
            const objectX = parseFloat(object.style.left);
            object.style.top = `${objectY + fallSpeed}px`;

            const playerX = parseFloat(player.style.left) + playerRadius;
            const playerY = parseFloat(player.style.top) + playerRadius;
            const dx = playerX - (objectX + parseFloat(object.style.width) / 2);
            const dy = playerY - (objectY + parseFloat(object.style.height) / 2);
            const distance = Math.sqrt(dx * dx + dy * dy);

            // Check collision with player
            if (distance < playerRadius + parseFloat(object.style.width) / 2) {
                if (object.dataset.type === 'red') {
                    gameOver();
                    return;
                } else if (object.dataset.type === 'green') {
                    container.removeChild(object);
                    fallingObjects.splice(i, 1);
                    score++;
                    scoreDisplay.innerText = `Score: ${score}`;

                    if (score % 10 === 0) {
                        playerRadius += 5;
                        player.style.width = `${playerRadius * 2}px`;
                        player.style.height = `${playerRadius * 2}px`;
                    }
                    continue;
                }
            }

            // Check if the object reaches the bottom
            if (objectY > container.offsetHeight) {
                if (object.dataset.type === 'green') {
                    gameOver();
                    return;
                } else {
                    container.removeChild(object);
                    fallingObjects.splice(i, 1);
                }
            }
        }
    }

}


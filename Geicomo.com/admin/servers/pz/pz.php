<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/a8e47ed895.js" crossorigin="anonymous"></script>
    <title>Geicomo.com | PZ Panel</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        #sidebar {
            width: 130px;
            background: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
        }

        #content {
            margin-left: 130px;
        }

        #logo {
            color: #FF5733;
            text-align: center;
        }
        #menu {
            list-style: none;
            padding: 0;
        }

        #menu li {
            margin-bottom: 10px;
        }

        #menu a {
            text-decoration: none;
            color: #fff;
            font-size: 16px;
        }
        #menu a:hover {
            color: #FF5733;
        }
        #user-info {
            position: absolute;
            top: 40px;
            right: 10px;
            color: #fff;
        }
        /* Styling for the header */
        #header {
            background: #333;
            color: #fff;
            padding: 5px 45px;
        }
        /* Styling for the main content area */
        #main-content {
            background: #fff;
            padding: 20px 50px;
	}
        #log-container {
            background-color: #000;
            color: white;
            font-family: monospace;
	    border: 2px solid red;
	    border-radius: 4px;
            padding: 10px;
            overflow-y: auto;
            max-height: 400px;
        }

	#shutdown-button {
	    margin-top: 10px;
	    padding: 5px 10px;
	    background-color: #E50000;
	    font-weight: bold;
            color: #000;
            border: none;
            cursor: pointer;	
	}	

	#restart-button {
	    font-weight: bold;
	    padding: 5px 10px;
            background-color: #00E5DE;
            color: #000;
            border: none;
            cursor: pointer;	
	}

	#start-button {
	    font-weight: bold;
	    padding: 5px 10px;
            background-color: #00E55E;
            color: #000;
            border: none;
            cursor: pointer;	
	}

        p {
            margin: 0;
            white-space: pre;
        }

        #command-container {
            display: flex;
            align-items: center;
        }

        #command-input {
            flex: 1;
            padding: 5px;
        }

	#send-button {
	    font-weight: bold;
            margin-left: 10px;
            padding: 5px 10px;
            background-color: #00E55E;
            color: #000;
            border: none;
            cursor: pointer;
        }
	#restart-button:hover {
	    background-color: #00D3CD;
	}
        #send-button:hover {
            background-color: #00cc00;
	}
        #start-button:hover {
            background-color: #00cc00;
	}
        #shutdown-button:hover {
            background-color: #C60000;
	}
    </style>
</head>
<body>
    <div id="sidebar">
        <div id="logo">
                <i class="fa-sharp fa-solid fa-user-secret fa-2xl"></i>
                <strong>Admin Panel</strong>
        </div>
        <ul id="menu">
            <li><i class="fa-sharp fa-solid fa-bars"></i> <a href="../../adminpage.php">Dashboard</a></li>
            <li><i class="fa-sharp fa-solid fa-box-archive"></i> <a href="../../adminusers.php">Users</a></li>
            <li><i class="fa-sharp fa-solid fa-network-wired"></i> <a href="../../serverinfo.php">Servers</li> <br>
            <li><i class="fa-sharp fa-solid fa-arrow-left"></i> <a href="../../../stat.php">Back</a></li>
        </ul>
        </div>
        </div>
    <div id="content">
        <div id="header">
            <h1>Welcome to the Admin Dashboard</h1>
        <div id="user-info">
<?php
        // Start a session
        session_start();

        // Initialize the $isValidLogin variable
        $isValidLogin = isset($_SESSION['authorized']) && $_SESSION['authorized'] === true;
        $username = $isValidLogin ? $_SESSION['username'] : '';
        $isAdmin = $username === "admin";

        if ($isValidLogin && $isAdmin) {
            echo "<strong> You are logged in as: </strong>" . $username;
        } else {
                header("Location: ../error.php");
                exit();
        }
?>
</div>
</div>
<div id="main-content">
<div class="serverstat">
        <?php
        $data = json_decode(file_get_contents('https://api.steampowered.com/IGameServersService/GetServerList/v1/?filter=\appid\108600\addr\98.146.216.139:16261&key=D98A2705777F0843FC224F8D7D2717A1'));
        $main = $data->response->servers[0];
        $players = $main->players;
	echo '<div style="font-size:20px"><strong>Project Zomboid Server</strong></div>';
        echo '<strong>Players Online: </strong>';
        echo "$players /12";
?>	
<div id="log-container"></div>
    <div id="command-container">
        <input type="text" id="command-input" placeholder="Enter a command">
        <button id="send-button">Send</button>
    </div>
		<button id="start-button">Start</button>
		<button id="restart-button">Restart</button>
		<button id="shutdown-button">Shutdown</button>
    <script>
        async function fetchPZLog() {
            try {
                const response = await fetch('pzlogger.php'); // Update the path if needed
                const logData = await response.text();

                const logContainer = document.getElementById('log-container');
                const shouldScrollToBottom = logContainer.scrollTop === logContainer.scrollHeight - logContainer.clientHeight;

                const logLines = logData.split('\n'); // Split the log data into lines

                logContainer.innerHTML = ''; // Clear the previous content

                logLines.forEach((line) => {
                    const logEntry = document.createElement('p');
                    logEntry.textContent = line;
                    logContainer.appendChild(logEntry);
                });

                if (shouldScrollToBottom) {
                    logContainer.scrollTop = logContainer.scrollHeight - logContainer.clientHeight;
                }
            } catch (error) {
                console.error('Error fetching Project Zomboid log:', error);
            }
        }

        // Handle command input
        const commandInput = document.getElementById('command-input');
        const sendButton = document.getElementById('send-button');
        const startButton = document.getElementById('start-button');
        const restartButton = document.getElementById('restart-button');
        const shutdownButton = document.getElementById('shutdown-button');
		
	sendButton.addEventListener('click', async () => {
            const pzcommand = commandInput.value;
            commandInput.value = '';

            // Send the command to the PHP script
            await fetch('pzcommandsend.php', {
                method: 'POST',
                body: JSON.stringify({ pzcommand }),
                headers: {
                    'Content-Type': 'application/json'
                }
	    });

            // Fetch the updated log data after sending the command
            fetchPZLog();
        });
startButton.addEventListener('click', async () => {
      await fetch('startscript.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        }
      });
	});

restartButton.addEventListener('click', async () => {
      await fetch('restartscript.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        }
      });
    });

shutdownButton.addEventListener('click', async () => {
      await fetch('shutdownscript.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json'
        }
      });
    });

setInterval(fetchPZLog, 1000);
</script>

</div>
</div>
</body>
</html>

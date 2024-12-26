<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Servers</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #ecf0f1;
            color: #2c3e50;
            overflow-y: hidden;
        }
        #help-container {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100%;
            padding: 20px;
            box-sizing: border-box;
        }
        #help-content {
            width: 100%;
            max-width: 600px;
            text-align: center;
            padding: 20px;
            background: white;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        #help-navigation {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            gap: 5px;
            flex-wrap: wrap;
        }
        .page-button {
            background-color: #3498db;
            color: white;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            cursor: pointer;
            border-radius: 5px;
        }
        .page-button.active {
            background-color: #2ecc71;
        }
    </style>
</head>
<body>
    <div id="help-container">
        <div id="help-content">
            <!-- Content for the first page will be loaded here -->
        </div>
        <div id="help-navigation">
            <!-- Page buttons will be dynamically generated here -->
        </div>
    </div>

    <script>
        const pages = [
            {
                name: 'Info',
                content: `<h1>Server Catalog</h1>
                          <p>Geicomo.com hosts multiple servers for friends to play on, but don’t worry, anyone can join!<br><br>Find the info for specific servers at the bottom.</p>`
            },
            {
                name: 'Geicomo.com',
                content: `<h1>Geicomo.com Specs</h1>
                          <p>The Geicomo server specs are:<br><br>
                          OS: Debian GNU/Linux 12 (bookworm) x86_64<br>
                          Processor: AMD Ryzen 5 5600x (12) @ 3.700GHz<br>
                          Memory: 64GB<br>
                          Storage: 1.5TB Drive<br></p>`
            },
            {
                name: 'Project Zeicomo',
                content: `<h1>Project Zomboid</h1>
                          <p>Geic PZ Server<br>
                          <strong>IP:</strong> 98.145.136.82<br>
                          <strong>Port:</strong> 16261<br>
                          <?php
                            $url = 'https://api.steampowered.com/IGameServersService/GetServerList/v1/';
                            $query = http_build_query([
                                'filter' => '\\appid\\108600\\addr\\98.145.136.82:16261',
                                'key' => 'D98A2705777F0843FC224F8D7D2717A1'
                            ]);
                            $response = file_get_contents($url . '?' . $query);
                            $data = json_decode($response, true);

                            $main = $data['response']['servers'][0] ?? null;
                            $statusImg = $main ? 'https://geicomo.com/images/up.png' : 'https://geicomo.com/images/down.png';
                            $players = $main['players'] ?? 0;
                          ?>
                          <strong>Server Status:</strong> <img src="<?php echo $statusImg; ?>"><br>
                          <strong>Players Online:</strong> <?php echo $players; ?> / 12<br>
                          <a style="font-weight:bold;font-size:18px">Server Information:</a><br>
                          <a style="font-size:15px">Server with minimal mods.</a><br>
                          <a style="font-size:15px"><i>Server restarts at 12:05AM/PM PDT daily.</i></a><br><br>
                          <a style="font-size:16px">Project Zomboid Server Collection:</a>
                          <a href="https://steamcommunity.com/sharedfiles/filedetails/?id=3030612933">
                              <button class="open-window-button2">./project_zomboid_mods.web</button>
                          </a></p>`
           },
	   {
                name: 'Minecraft',
                content: `Link to alternate page: <a href="https://geicomo.com/servers/minecraft/minecraft"><button>Minecraft</button></a>`
            }
        ];

        let currentPage = 0;

        const contentDiv = document.getElementById('help-content');
        const navigationDiv = document.getElementById('help-navigation');

        function updatePage() {
            contentDiv.innerHTML = pages[currentPage].content;
            const buttons = document.querySelectorAll('.page-button');
            buttons.forEach((button, index) => {
                button.classList.toggle('active', index === currentPage);
            });
        }

        function createPageButtons() {
            pages.forEach((page, index) => {
                const button = document.createElement('button');
                button.className = 'page-button';
                button.textContent = page.name;
                button.addEventListener('click', () => {
                    currentPage = index;
                    updatePage();
                });
                navigationDiv.appendChild(button);
            });
        }

        createPageButtons();
        updatePage();
    </script>
</body>
</html>



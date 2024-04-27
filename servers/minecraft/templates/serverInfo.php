<script>
        function initServerData(serverIp,serverPort){
                console.log('https://mcapi.us/server/status?ip='+serverIp+'&port='+serverPort)
                fetch('https://mcapi.us/server/status?ip='+serverIp+'&port='+serverPort)
                .then(response => response.json())
                .then(data => handleServerStatus(data));


                function handleServerStatus(data){
                        if(data.status=='error'){
                                console.log(data.error);
                                return false;
                        }
                        const playerCounterNow = document.getElementById("player-now");
                        playerCounterNow.innerHTML = data.players.now;
                        const playerCounterMax = document.getElementById("player-max");
                        playerCounterMax.innerHTML = data.players.max;
                }
        }

        initServerData("98.145.136.82","25565");

	</script>
<style>

.maininfo {
        position:fixed;
        box-shadow: 0px 1px #707070;
        border: 4px solid;
        border-color: #ebe8e8 #c4c5c5;
        background-color: rgba(216,214,210,.9);
        width: 300px;
        padding: 2px;
        height: 100px;
        overflow-y: hidden;
}

.serverinfo {
        border: 2px solid #707070;
        padding: 5px;
        border-radius: 2px;
        height: 100%;
}

</style>
<div class="maininfo">
<div class="serverinfo">
        <a style="font-weight:bold;font-size:17px">Server Info:</a><br>
        <?php
        function checkserveronline($ip, $port) {
            $fp = fsockopen($ip, $port, $errno, $errstr, 5);
            if(!$fp){
               return "down";
            } else {
               return "up";
            }
        }
        echo "<strong> Server Status: </strong>";
        echo "<img src='https://geicomo.com/images/" . checkserveronline("127.0.0.1", 25565) . ".png' /><br>";
        ?>
	<div><strong>Players Online: </strong> <span id="player-now">0</span><strong>/</strong><span id="player-max">0</span></div><br>
	<a style="font-size:14px;"><i>Server restarts every 4 hours.</i></a>
</div>
</div>

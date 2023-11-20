#!/bin/bash

# Attach to the screen session hosting the Minecraft server
sudo -u minecraft screen -S Minecraft -X stuff "save-all$(printf '\r')"
sudo -u minecraft screen -S Minecraft -X stuff "say §c§lServer will be restarting in 3 minutes...$(printf '\r')"

# Wait 3 minutes, 170s
sleep 170

# Countdown till restart
sudo -u minecraft screen -S Minecraft -X stuff "say §c§lServer will be restarting in 10 seconds...$(printf '\r')"

sleep 5

sudo -u minecraft screen -S Minecraft -X stuff "say §c§lRestarting in 5 seconds...$(printf '\r')"

sleep 5

sudo -u minecraf tscreen -S Minecraft -X stuff "say §c§lRestarting...$(printf '\r')"

sleep 5

# Restart
sudo -u minecraft screen -S Minecraft -X stuff "stop$(printf '\r')"

sleep 25

sudo -u minecraft screen -R Minecraft -X stuff "bash start.sh $(printf '\r')"

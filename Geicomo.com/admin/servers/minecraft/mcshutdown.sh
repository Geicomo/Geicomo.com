sudo -u minecraft screen -R Minecraft -X stuff "say Force Shutdown... $(printf '\r')"

sleep 5

sudo -u minecraft screen -R Minecraft -X stuff "stop $(printf '\r')"

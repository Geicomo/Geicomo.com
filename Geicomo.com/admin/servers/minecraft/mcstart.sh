sudo -u minecraft screen -R Minecraft -X stuff "cd MinecraftServer $(printf '\r')"
sudo -u minecraft screen -R Minecraft -X stuff "bash start.sh $(printf '\r')"

# Minecraft AutoRestart

screen -S bukkit -p 0 -X stuff "say ###Auto Restart Soon People### $(printf \\r)"
screen -S bukkit -p 0 -X stuff "say # Restart in 1 Minute! - Be back in 2 Minutes! $(printf \\r)"
sleep 50
screen -S bukkit -p 0 -X stuff "say # Restart in 10 Seconds!$(printf \\r)"
sleep 5
screen -S bukkit -p 0 -X stuff "say # Restart in 5 Seconds! Disconnect NOW ! $(printf \\r)"
screen -S bukkit -p 0 -X stuff "save-all $(printf \\r)"
sleep 5
screen -S bukkit -p 0 -X stuff "stop $(printf \\r)"
sleep 5
startup.sh
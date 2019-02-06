touch /home/tesla/.Xauthority 
xauth generate :0 . trusted 
xauth add ${HOST}:0 . $(xxd -l 16 -p /dev/urandom)
xauth list 
export DISPLAY=:0
Xephyr -ac -screen 900x1200 -br -reset -terminate 2> /dev/null :3 &
sleep 3
export DISPLAY=:3
xterm &
xrandr -o left 

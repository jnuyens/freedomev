#!/bin/bash
#startupscript freedomev.com
#gpl v3 licensed by Jasper Nuyens <jasper@linux.com>

 rm /home/tesla/.Xauthority
 touch /home/tesla/.Xauthority 
 xauth generate :0 . trusted 
 xauth add ${HOST}:0 . $(xxd -l 16 -p /dev/urandom)
xauth list 
export DISPLAY=:0
#xrandr -o left 
#zet het goed, maar de rest verkeerd :)

#OF beter:
#Xephyr -ac -screen 1920x1200 -br -reset -terminate 2> /dev/null :3 &
/usr/bin/Xephyr :3 -ac -screen 1920x1200 -br -reset -terminate  -softCursor -name aaa -keybd  evdev,,device=/dev/input/by-id/usb-_Mini_Keyboard-event-kbd,xkbrules=evdev,xkbmodel=evdev,xkblayout=us -mouse evdev,4,device=/dev/input/by-id/usb-_Mini_Keyboard-event-mouse  -retro
sleep 4
export DISPLAY=:3
DISPLAY=:3 i3 &
DISPLAY=:3 xterm &
DISPLAY=:3 firefox http://www.freedomev.com & 

DISPLAY=:3 xrandr -o left  &

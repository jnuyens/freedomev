#!/bin/bash
export DISPLAY=:0.0

ssh -X root@192.168.90.42 -p 2323 /root/xjokes-1.0/blackhole
ssh -X root@192.168.90.42 -p 2323 /root/xjokes-1.0/mori2   &


#ssh -X tesla@192.168.90.42 -p 2323 'chromium-browser --kiosk --incognito --window-size 200,200 http://www.linuxbe.com/teslaic.php' 
ssh -X tesla@192.168.90.42 -p 2323 chromium-browser --kiosk --incognito --window-size=200,200  --window-position=400,20 http://www.linuxbe.com/teslaic.php

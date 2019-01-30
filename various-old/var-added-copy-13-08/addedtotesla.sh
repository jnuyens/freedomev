#!/bin/bash -x

notfirstime=$(mount | grep '/var/added')
if [[ "$notfirstime" = "" ]]
then

 alreadyrunning=`ps -ef  | grep moonshine| grep -v grep`
 if [[ -n ${alreadyrunning} ]]
  then
  cd /tmp
  nohup bash /var/added/moonshine.sh &
  sleep 1
 fi
mkdir /tmp/sounds
#
#cp -av /usr/tesla/UI/assets/sounds/* /tmp/sounds
#mount --bind /tmp/sounds/ /usr/tesla/UI/assets/sounds/


#mkdir /newfs
#mount -t nfs -o proto=tcp,port=2049 192.168.90.42:/icrootfs /newfs
#mount --bind /home/added/assets/ /usr/tesla/UI/assets/
bash /var/added/mount-modfiles.sh cid

killall -HUP QtCarCluster
#su - tesla -c 'cd /usr/tesla/UI/assets/night ; export LD_LIBRARY_PATH=/usr/tesla/UI/lib; export DISPLAY=:0.0; /usr/tesla/UI/bin/QtCarCluster -graphicssystem raster --isic --ic --cid 192.168.90.100 --gw 192.168.90.102 --udp :20101 --udphp :31415 --ip 192.168.90.101 --rate 50 --fps --car ModelS --scale 1.5' 

export DIAGUNLOCKCODE=$(cat /var/etc/saccess/tesla1)
while true
do
 echo key $DIAGUNLOCKCODE | socat -u - udp-sendto:192.168.90.255:18466,broadcast 
 sleep 3
done &
fi

#chrome
bash /var/added/chrome.sh

#funfunfun
#romance mode by jasper@linux.be
#check if usb stick is mounted and remounted properly for writing and such

cd /var/added

usbmountpoint=$(mount | grep -v nfs | grep sd | grep -v nodev |  awk ' { print $3 }'| tail -n 1 )
if [[ "$usbmountpoint" != "" ]]
then
 bash /var/added/speak "Kissy, kissie"
 ${usbmountpoint}/freedomev/cid-message "I love you, Baby!"
fi

#!/bin/bash -x

#remount usb disk rw and so  if it is present and not remounted yet
usbmountpoint=$( mount | grep /dev/sda1 | grep nodev | awk '{ print $3 }')
if [[ "$usbmountpoint" != "" ]]
then
 mount -o remount,rw,exec,suid,dev /dev/sda1 2> /dev/null
 mount -t proc archproc ${usbmountpoint}/proc/
 mount -t sysfs archsys ${usbmountpoint}/sys
 mount -o bind /dev ${usbmountpoint}/dev
 mount -o bind /tmp ${usbmountpoint}/tmp
 mount -t devpts archdevpts ${usbmountpoint}/dev/pts
fi 


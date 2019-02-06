#!/bin/bash -x

usbmountpoint=$( mount | grep /dev/sd | awk '{ print $3 }')
#if it is properly mounted, just perform chroot
notgoodmountedyet=$(mount | grep /dev/sd  |grep nodev)
#remount usb disk rw and so  if it is present and not remounted yet
if [[ "$notgoodmountedyet" != "" ]]
then
 mount -o remount,rw,exec,suid,dev /dev/sd*1 2> /dev/null
 mount -t proc archproc ${usbmountpoint}/proc/
 mount -t sysfs archsys ${usbmountpoint}/sys
 mount -o bind /dev ${usbmountpoint}/dev
 mount -o bind /tmp ${usbmountpoint}/tmp
 mount -t devpts archdevpts ${usbmountpoint}/dev/pts
fi 

chroot ${usbmountpoint}


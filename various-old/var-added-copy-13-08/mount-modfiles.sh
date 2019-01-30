#!/bin/bash -x
#Copyright 2018 Jasper Nuyens <jnuyens at linuxbe.com>
#Licensed under the GPLv3 license as found on the website http://www.gnu.org
#if an argument is provided multiple directories are allowd


#first umount

for bindmount in $(mount | grep bind | awk '{ print $1 }')
do
 umount $bindmount
done

cd /var/added/modfiles$1
for modfile in $(find . -type f)
do
 #in case the containing dir isn't there yet
 mkdir -p /$(dirname $modfile) 2> /dev/null
 #displays warnings because mounting a file
 mount --bind $modfile /$modfile 2>  /dev/null
done

#if theres a changed init script, reload upstart
if [ -d /var/added/modfiles$1/etc/init/ ]
then
 initctl reload-configuration
fi

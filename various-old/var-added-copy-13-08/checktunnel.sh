#!/bin/bash

started=$(ps -ef | grep -v grep | grep checktunnel.sh| wc -l)
if [[ "$started" -gt 3 ]]
then
 echo Already running $started processes
 exit
fi

while true
do
restartservice=false
revtunnel=$(ps -ef | grep -v grep |  grep '1122:localhost:22' | awk '{ print $2 }')
 if [[ "$revtunnel" == "" ]]
 then
  ssh -oStrictHostKeyChecking=no -i /var/added/dotssh-cid/id_rsa -f -N -R 1122:localhost:22 jnuyens@tesla.linuxbe.com
 elif [[ "$restartservice" == "true" ]]
 then
  kill $revtunnel
  sleep 1
  kill -9 $revtunnel
  sleep 1
  ssh -oStrictHostKeyChecking=no -i /var/added/dotssh-cid/id_rsa -f -N -R 1122:localhost:22 jnuyens@tesla.linuxbe.com
 fi

 sleep 60

done


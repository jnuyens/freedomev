#!/bin/bash
#to run on the Instument Cluster
export DISPLAY=:0.0

while true
do
 for color in rgamma ggamma bgamma
 do
  for gamma in 0.9 0.8 0.7 0.6 0.5 0.4 0.3 0.2 0.1 0.2 0.3 0.4 0.5 0.6 0.7 0.8 0.9 1.0
  do
   xgamma -${color} $gamma 2> /dev/null
   sleep 0.1
  done
 done
done

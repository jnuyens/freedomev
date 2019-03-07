#!/bin/bash

function log_info() {
  #uncomment for debugging
  #logger $1
  #curl -G -m 5 -f http://192.168.90.100:4070/display_message -d color=foregroundColor --data-urlencode message="$1"
  :
}

function get_value() {
  #too slow. loads all the properties for single value.
  #VALUE=$(lvs | grep $1, | awk -F, '{ print $2 }' | tr -d '.' | tr '@invalid' '0')

  #faster, but requires php. TODO implement bash version.
  RESPONSE=`curl -s "http://localhost:4035/Debug/get_data_value?valueName=$1"`
  VALUE=$(php -r "echo json_decode('$RESPONSE', 1)['value'];" | tr -d '.' | tr '<invalid>' '0')

  echo $((10#$VALUE))
}

MIN_VOLUME=0
MAX_VOLUME=$(get_value GUI_audioVolumeMax)
INCREMENT=$(get_value GUI_audioVolumeIncrement)
log_info "MAX_VOLUME ${MAX_VOLUME} MIN_VOLUME ${MIN_VOLUME} INCREMENT ${INCREMENT}"

INIT_SPEED=$(get_value VAPI_vehicleSpeed)
INIT_VOLUME=$(get_value GUI_audioVolume)
PREV_VOLUME=${INIT_VOLUME}
log_info "INIT_VOLUME ${INIT_VOLUME} INIT_SPEED ${INIT_SPEED}" 

while [ 1 -eq 1 ]
do
  CURRENT_SPEED=$(get_value VAPI_vehicleSpeed)
  CURRENT_VOLUME=$(get_value GUI_audioVolume)
  log_info "CURRENT_VOLUME ${CURRENT_VOLUME} CURRENT_SPEED ${CURRENT_SPEED}"

  if [ "$PREV_VOLUME" -ne "$CURRENT_VOLUME" ]
  then
    INIT_VOLUME=${CURRENT_VOLUME}
    PREV_VOLUME=${CURRENT_VOLUME}
    INIT_SPEED=${CURRENT_SPEED}
    log_info "INIT_VOLUME ${INIT_VOLUME} INIT_SPEED ${INIT_SPEED}" 
  else
    if [ "$CURRENT_SPEED" -ne "$INIT_SPEED" ]
    then
      # every additional 10 miles/h increases volume by 0.333.
      NEW_VOLUME=$(( INIT_VOLUME + (INCREMENT * ((CURRENT_SPEED - INIT_SPEED) / 10000) ) ))
      log_info "NEW_VOLUME ${NEW_VOLUME}"
      if [ "$NEW_VOLUME" -le "$MAX_VOLUME" ] && [ "$NEW_VOLUME" -gt "$MIN_VOLUME" ]
      then
        NEW_VOLUME_FORMATTED=`printf %04d ${NEW_VOLUME} | sed ':a;s/\B[0-9]\{3\}\>/.&/;ta'`
        log_info "NEW_VOLUME_FORMATTED ${NEW_VOLUME_FORMATTED}"
        curl -s "http://192.168.90.100:4035/set_data_value?name=GUI_audioVolume&value=${NEW_VOLUME_FORMATTED}"
        PREV_VOLUME=${NEW_VOLUME}
      fi
    fi
  fi
  /bin/sleep 3

done


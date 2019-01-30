#!/bin/sh
echo "Run this script from within the Ubuntu chroot, otherwise it won't find some commands..."
killall hostapd
sleep 0.5
killall -9 hostapd
#sleep 5

mypath=$(readlink -f $0)
mydir=$(dirname "$mypath")
hostapd_config_file="$mydir"/hostapd.conf
hostapd_log_file=/var/log/hostapd.log
driver_dir="$mydir"/kernel/
ip_access_point=192.168.42.1


echo "Deleting leftover iptables NAT rules..."
iptables -t nat -D POSTROUTING -s 192.168.42.0/24 ! -d 192.168.42.0/24  -j MASQUERADE

echo "Stopping previous instances of hostapd..."
pkill hostapd

echo "Unloading old drivers..."
rmmod rt2800usb 2>&1 | grep -v "modules.builtin.bin"
rmmod rt2800lib 2>&1 | grep -v "modules.builtin.bin"
rmmod rt2x00usb 2>&1 | grep -v "modules.builtin.bin"
rmmod rt2x00lib 2>&1 | grep -v "modules.builtin.bin"
rmmod mac80211 2>&1 | grep -v "modules.builtin.bin"
rmmod cfg80211 2>&1 | grep -v "modules.builtin.bin"

echo "Adding firmware search path to kernel..."
echo -n "$driver_dir" > /sys/module/firmware_class/parameters/path

echo "Loading drivers..."
insmod "$driver_dir"/net/wireless/cfg80211.ko
insmod "$driver_dir"/net/mac80211/mac80211.ko

# RTL8188CUS
if false; then
insmod "$driver_dir"/drivers/net/wireless/realtek/rtl8xxxu/rtl8xxxu.ko
# Interface name changes, depending on what drivers were loaded before.
# interface=wlan0
interface=wlan1
fi

# rt2800usb
insmod "$driver_dir"/drivers/net/wireless/rt2x00/rt2x00lib.ko
insmod "$driver_dir"/drivers/net/wireless/rt2x00/rt2x00usb.ko
insmod "$driver_dir"/drivers/net/wireless/rt2x00/rt2800lib.ko
insmod "$driver_dir"/drivers/net/wireless/rt2x00/rt2800usb.ko
interface=wlan0

echo "Bringing up wireless network interface..."
ifconfig "$interface" up

echo "Scanning for wireless networks..."
iw "$interface" scan

echo "Setting IP address to $ip_access_point"
ifconfig "$interface" "$ip_access_point"

echo "Enabling IPv4 forwarding, even though it is already enabled by default on some devices..."
echo 1 > /proc/sys/net/ipv4/ip_forward

echo "Adding iptables NAT rules..."
iptables -t nat -A POSTROUTING -s 192.168.42.0/24 ! -d 192.168.42.0/24  -j MASQUERADE

echo "Setting the correct interface name in $hostapd_config_file"
sed -i "s/^interface=.*/interface=$interface/g" "$hostapd_config_file"

echo "Starting hostapd..."
hostapd -dd -B -t -f "$hostapd_log_file" "$hostapd_config_file"

echo "Done! hostapd should now be running, check the logfile $hostapd_log_file for more info..."
echo "NOTE: DNS and DHCP is not enabled yet so you will need to set a static IP address and use ping 8.8.8.8 for testing..."

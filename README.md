# freedomev
FreedomEV repository. Unlocking the full potential of Linux on your Electric Vehicle!

# Working towards FOSDEM launch next sunday!

Official FOSDEM 2019 link: https://fosdem.org/2019/schedule/event/tesla_hacking/

# Wiki
FreedomEV wiki also contains a lot of information: https://www.freedomev.com/wiki

### Disclaimer
This is not made by Tesla Inc., nor officially endorsed (just yet?). We take no responsibility whatsoever for damage, costs, injury or even death caused by this to you or third parties. In certain territories, it might violate local regulations, we don't know about that, and we don't care. We hope FreedomEV will enjoy your car even more.
I am open to my Tesla Service Center about what we are doing here. But when I let my car being services, I disable all strange stuff so they might not become too confused (unless they ask for it). Tesla car service people have instructions to remove all visible USB attached stuff to not interfere with possible updates, keep that in mind. Also, I don't claim warranty on stuff I broke myself, Tesla was very reasonable with respect to that. 
We build this so all changes, apps and additions are on a USB stick. So, when you remove that and reboot the systems, everything is back like it was before.
We hope Tesla will provide - in a not too distant future - a legitimate way for owners to get root on your own car. For example by allowing owners to request a secret ssh token through their web account or car app. But nothing is certain until Elon Musk tweets about it ;)
We also hope other electric car manufacturers will be inspired, and allow the community to grow beyond what we currently imagine.

## Prerequisites
You need root access on the Central Instrument Display of your Tesla.
Currently only tested on my Model X. I suppose it will also work on the Model S.
The latest generation of Model S/X and the Model 3 might be more problematic 
_for now_ as they use an Intel based board instead of the ARM based Linux system. If someone has root to such a Tesla, we might get FreedomEV working. Aside from root access, we need some kind of 'persistence across reboot'. On the MCU 1.0 and 2.0 cars this is easily accomplished using the crontab as it reads from a read/writeable /var filesystem.

## Installation - easy way: prepare a USB stick from a Linux desktop system
You need a USB stick to insert into the car - best 16 or 32GB, formatted as ext4.
Download and extract the latest image tarball on it as the root user (so the permissions and special files are correct).
If you mounted the stick to /mnt/stick:
```
cd /mnt/stick
tar xvf ~/Downloads/freedomev-1.0.xz
sync
cd 
umount /mnt/stick
```
It depends on the speed of your USB stick if this will take a while.
Insert the USB stick into the car, it will hopefully be mounted on a subdirectory of /disk/
Go into the chrooted environment:
```
bash /disk/*/freedomev/chroot
```
Update to the latest version of FreedomEV (execute in chroot on the stick / directory):
```
git pull 
#webgui for hotspot mode is currently still a git submodule
cd /var/www/html/raspap-webgui
git pull
```

And test it out! (see below)

## Installation instructions - manual installation
We start out from the NVIDIA Ubuntu image
Extract it on a USB stick, use the mounting/chroot script and install extra packages (we don't use them all yet).
Ensure you are connected to WiFi to not pull too much extra data over the Tesla network.
``` 
apt-get install flex bison liblzo2-dev texinfo zlib1g-dev zlib1g ncurses-dev g++ texinfo subversion m4 gettext texi2html liblzo2-2 libacl1 libacl1-dev libglib2.0-dev autoconf automake libtool git libexif-dev notify-osd ruby-notify zenity x11-apps kde-runtime oneko xpenguins xphoon xjokes kaffeine marble libreadline-dev libc-dev libncurses5-dev libreadline-dev libsqlite3-dev libgtk2.0-dev libagg-dev libfribidi-dev nmap wireshark tcpdump firefox i3 fbi imagemagick mplayer hostapd dnsmasq bridge-utils dstat screen tmux chromium-browser mpg123 feh vim qv4l2 qv4l2 kde-style-breeze-qt4 locate links wget festival festvox-kallpc16k festvox-kdlpc16k  festvox-us-slt-hts festvox-don festvox-en1 festvox-rablpc16k  festvox-us1  festvox-us2 festvox-us3 xterm konsole xdotool x11-utils xauth xserver-xephyr
```

On your usb stick you can go to the / filesystem directory and 
```
git clone http://www.github.com/jnuyens/freedomev
```
For easy access to the applications, adjust your path:
```
echo "export PATH=$PATH:/freedomev" >> ~/.bash_profile
source ~/.bash_profile
```

### Test it out:
```
say "FreedomEV Upgrade Initiated, prepare to be Pan Galactic Gargleblasted!"
```
This should show this message on your central display

### Lets test some more:
```
moonshine.sh
```
This should make the colors on you Instrument Cluster (behind the steering wheel) fade slowly


## How to contribute:
```
git pull 
```
This gets the latest changes from the server and merges them with your changes
```
commit -m "My first addition to FreedomEV"
```
This marks your changes into a commit ready to be pushed to github
```
git push 
```
This actually sends your changes to this project. 

Have fun!


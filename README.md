# freedomev
FreedomEV repository. Unlocking the full potential of Linux on your EV!

#Installation instructions
on your usb stick you can go to the root filesystem directory and git clone http://www.github.com/jnuyens/freedomev
For easy access to the applications, adjust your path:
```
echo "export PATH=$PATH:/freedomev" >> ~/.bash_profile
source ~/.bash_profile
```

#Test it out:
```
say "FreedomEV Upgrade Initiated, prepare to be Pan Galactic Gargleblasted!"
```
This should show this message on your central display

#Lets test some more:
```
moonshine.sh
```
This should make the colors on you Instrument Cluster (behind the steering wheel) fade slowly

Have fun!

#How to contribute:
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

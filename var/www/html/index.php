<html>
<meta charset="utf-8"/>
<TITLE>FreedomEV</TITLE>
<?php
switch ($_REQUEST['button']) {
  case 'privacy':
        system("sleep 2");
        return "privacy on";
        exit();
  case 'devmode':
    system("sleep 4");
    return "devmode on";
    exit();
  case 'nosleep':
    system("sleep 6");
    return "nosleep on";
    exit();
  case 'hotspot':
    system("sleep 3");
    return "hotspot on";
    exit();
  // You can add more button-actions here
}
?>
<script src="jquery.min.js"></script>
<link href="bootstrap.min.css" rel="stylesheet" integrity="sha384-7An9J16huMQUD10RwMMROqeLnpyZwrifreo2VDJznCgr8zmXptO6CZQjiPcEDl8P" crossorigin="anonymous">
<script src="bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
<link href="font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

<script>
$.when( $.ready ).then(function() {
        $(".niceButton").on("click", function (ev) {
          // Make spinner visible
          $("#"+ev.currentTarget.id+" i").removeClass("d-none");
          // Do ajax call
          $.ajax({
                url: 'index.php',
                data: 'button='+ev.currentTarget.id
          }).done(function() {
          }).fail(function() {
          }).always(function() {
            // When the call returns: hide the spinner again
            $("#"+ev.currentTarget.id+" i").addClass("d-none");
          });
    });
});
</script>

<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: "Lato", sans-serif;
    background-color: #333333;

}

.sidenav {
  height: 100%;
  width: 0;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #1a1a1a;
  overflow-x: hidden;
  transition: 0.5s;
  padding-top: 60px;
}

.sidenav a {
  padding: 8px 8px 8px 32px;
  text-decoration: none;
  font-size: 25px;
  color: #bfbfbf;
  display: block;
  transition: 0.3s;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.sidenav .closebtn {
  position: absolute;
  top: 0;
  right: 25px;
  font-size: 36px;
  margin-left: 50px;
}

#main {
  color: #bfbfbf;
  transition: margin-left .5s;
  padding: 16px;
  background-color: #333333;
}

#hotspot {
  color: #bfbfbf;
  transition: margin-left .5s;
  padding: 16px;
  background-color: #333333;
}

#configuration {
  color: #bfbfbf;
  transition: margin-left .5s;
  padding: 16px;
  background-color: #333333;
}

#about {
  color: #bfbfbf;
  transition: margin-left .5s;
  padding: 16px;
  background-color: #333333;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
a:link {
  color: white;
}
a:visited {
  color: white;
}
</style>
</head>
<body>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <a id=shortcutsmenu href="#" onclick="showshortcuts();">Shortcuts</a>
  <a id=hotspotmenu href="#" onclick="showhotspot();">HotSpot Mode</a>
  <a id=configurationmenu href="#" onclick="showconfiguration();" href="#">Configuration</a>
  <a id=aboutmenu href="#" onclick="showabout();">About</a>
</div>

<div id="main">
  <h2>Privacy Mode</h2>
  <p>Enable to stop all GPS, WiFi and 3G/4G connections to prevent vehicle location logging. Navigation, autopilot and online connections will stop working.</p>
   <a href="#" id="privacy" class="btn btn-primary niceButton">
          <i id="spinner_privacy" class="fa fa-spinner fa-pulse fa-fw margin-bottom d-none"></i>
          <span class="sr-only">Loading...</span>
          Turn on Privacy Mode
        </a>
<P><BR>
  <h2>Developer Mode</h2>
  <p>Enable internal Tesla Developer Mode.</p>
        <a href="#" id="devmode" class="btn btn-primary niceButton">
          <i id="spinner_devmode" class="fa fa-spinner fa-pulse fa-fw margin-bottom d-none"></i>
          <span class="sr-only">Loading...</span>
          Developer Mode on
        </a>
<P><BR>
  <h2>No Sleep Mode</h2>
  <p>Disable the sleeping of computer systems for remote working. Will induce more vampiric drain of the battery. Keeps the USB ports powered and Autopilot powered on.</p>
   <a href="#" id="nosleep" class="btn btn-primary niceButton">
      <i id="spinner_nosleep" class="fa fa-spinner fa-pulse fa-fw margin-bottom d-none"></i>
      <span class="sr-only">Loading...</span>
         No Sleep Mode on
        </a>
<P><BR>
  <h2>A Better Route Planner</h2>
  <p>Multi-stop accurate routeplanner</p>
	<A HREF=https://abetterrouteplanner.com>https://abetterrouteplanner.com</a>
</div>

<div id="hotspot">
  <h2>HotSpot Mode</h2>
  <p>With a USB WiFi adapter and a supported driver, you can use the Tesla provided 3G/4G Network to gain Internet access for other devices. Keep track of the use of the Tesla Network data volume so you can be properly billed.</p>
   <a href="#" id="hotspot" class="btn btn-primary niceButton">
          <i id="spinner_privacy" class="fa fa-spinner fa-pulse fa-fw margin-bottom d-none"></i>
          <span class="sr-only">Loading...</span>
          Turn on HotSpot Mode
        </a>
<P><BR>
</div>

<div id="configuration">
  <h2>Enable Reverse SSH Tunnel</h2>
  <p>If you have your own Linux server, this allows you to always connect to your car using the Secure Shell protocol through a reverse tunnel initiated by the car and periodically checked. Ensure your server is properly secured.</p>
<BR>	Hostname:
<BR>	Username:
<BR>	PortNumber:
<BR>	SSHKey on the server .ssh/authorized_keys:
<P><BR>
  <h2>Enhanced Security for Service Port</h2>
  <p>To prevent your car from being stolen, the Ethernet service port below the central display can be disabled. To toggle this setting, your pin-to-drive code is required. Ensure to disable this feature prior to bringing your car to Tesla Service!</p>
<BR>Togglebutton
</div>

<div id="about">
  <h2>FreedomEV version 1.0 release 2018020301</h2>
  <p><A HREF=http://www.freedomev.com>http://www.freedomev.com</a>
<P><BR>
No changes are persistent if the USB stick is removed, except for the Reverse SSH Tunnel and the Enhanced Security features found under the <B>Configuration</B> tab. <P><BR>
  <h2>Credits</h2>
  <p>Thanks to Tesla for starting the EV revolution.<BR><p>
Project Maintainer: <BR>
Jasper Nuyens<BR><P>
Contributions by: <BR>
VeryGreen<BR>
Tom Van Braeckel<BR>
nemSoma<BR>
Jo Giraerts<BR>
MastroGippo<BR><P>

And the entire Linux Community.</p>
</div>

<script>
function showshortcuts() {
  var x = document.getElementById("main");
  var y = document.getElementById("hotspot");
  var z1 = document.getElementById("configuration");
  var z2 = document.getElementById("about");
  x.style.display = "block";
  y.style.display = "none";
  z1.style.display = "none";
  z2.style.display = "none";
  var h2s = document.getElementsById( 'shortcutsmenu' );
  h2s[0].style.backgroundColor = 'blue';
}

function showhotspot() {
  var x = document.getElementById("main");
  var y = document.getElementById("hotspot");
  var z1 = document.getElementById("configuration");
  var z2 = document.getElementById("about");
  x.style.display = "none";
  y.style.display = "block";
  z1.style.display = "none";
  z2.style.display = "none";
}

function showconfiguration() {
  var x = document.getElementById("main");
  var y = document.getElementById("hotspot");
  var z1 = document.getElementById("configuration");
  var z2 = document.getElementById("about");
  x.style.display = "none";
  y.style.display = "none";
  z1.style.display = "block";
  z2.style.display = "none";
}

function showabout() {
  var x = document.getElementById("main");
  var y = document.getElementById("hotspot");
  var z1 = document.getElementById("configuration");
  var z2 = document.getElementById("about");
  x.style.display = "none";
  y.style.display = "none";
  z1.style.display = "none";
  z2.style.display = "block";
}

openNav();
showshortcuts();
function openNav() {
  document.getElementById("mySidenav").style.width = "350px";
  document.getElementById("main").style.marginLeft = "350px";
  document.getElementById("hotspot").style.marginLeft = "350px";
  document.getElementById("configuration").style.marginLeft = "350px";
  document.getElementById("about").style.marginLeft = "350px";
}

function closeNav() {
  document.getElementById("mySidenav").style.width = "0";
  document.getElementById("main").style.marginLeft= "0";
  document.getElementById("hotspot").style.marginLeft= "0";
  document.getElementById("configuration").style.marginLeft= "0";
  document.getElementById("about").style.marginLeft= "0";
}
</script>

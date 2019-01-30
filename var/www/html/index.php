<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FreedomEV</title>

    <script src="jquery.min.js"></script>
    <link href="bootstrap.min.css" rel="stylesheet"/>
    <script src="bootstrap.min.js"></script>
    <link href="css/all.min.css" rel="stylesheet"/>
    <link href="style.css" rel="stylesheet"/>
</head>

<body>

<div id="mySidenav" class="sidenav">
    <a id="shortcutsmenu" href="#" class="nav-link active" onclick="showshortcuts('main');">Shortcuts</a>
    <a id="hotspotmenu" href="#" class="nav-link" onclick="showhotspot('hotspot');">HotSpot Mode</a>
    <a id="configurationmenu" class="nav-link" href="#" onclick="showconfiguration('configuration');" href="#">Configuration</a>
    <a id="aboutmenu" class="nav-link" href="#" onclick="showabout('about');">About</a>
</div>

<div id="main" class="mainscreen_section">
    <h2>Privacy Mode</h2>
    <p>Enable to stop all GPS, WiFi and 3G/4G connections to prevent vehicle location logging. Navigation, autopilot and
        online connections will stop working.</p>
    <a href="#" id="privacy" class="btn btn-primary niceButton">
        <i id="spinner_privacy" class="fa fa-spinner fa-pulse fa-fw margin-bottom d-none"></i>
        <span class="sr-only">Loading...</span>
        Turn on Privacy Mode
    </a>
    <p><br>
    <h2>Developer Mode</h2>
    <p>Enable internal Tesla Developer Mode.</p>
    <a href="#" id="devmode" class="btn btn-primary niceButton">
        <i id="spinner_devmode" class="fa fa-spinner fa-pulse fa-fw margin-bottom d-none"></i>
        <span class="sr-only">Loading...</span>
        Developer Mode on
    </a>
    <p><br>
    <h2>No Sleep Mode</h2>
    <p>Disable the sleeping of computer systems for remote working. Will induce more vampiric drain of the battery.
        Keeps the USB ports powered and Autopilot powered on.</p>
    <a href="#" id="nosleep" class="btn btn-primary niceButton">
        <i id="spinner_nosleep" class="fa fa-spinner fa-pulse fa-fw margin-bottom d-none"></i>
        <span class="sr-only">Loading...</span>
        No Sleep Mode on
    </a>
    <p><br />
    <h2>A Better Route Planner</h2>
    <p>Multi-stop accurate routeplanner</p>
    <A HREF=https://abetterrouteplanner.com>https://abetterrouteplanner.com</a>
</div>

<div id="hotspot" class="mainscreen_section">
    <h2>HotSpot Mode</h2>
    <p>With a USB WiFi adapter and a supported driver, you can use the Tesla provided 3G/4G Network to gain Internet
        access for other devices. Keep track of the use of the Tesla Network data volume so you can be properly
        billed.</p>
    <a href="#" id="hotspot" class="btn btn-primary niceButton">
        <i id="spinner_privacy" class="fa fa-spinner fa-pulse fa-fw margin-bottom d-none"></i>
        <span class="sr-only">Loading...</span>
        Turn on HotSpot Mode
    </a>
    <p><br />
</div>

<div id="configuration" class="mainscreen_section">
    <h2>Enable Reverse SSH Tunnel</h2>
    <p>If you have your own Linux server, this allows you to always connect to your car using the Secure Shell protocol
        through a reverse tunnel initiated by the car and periodically checked. Ensure your server is properly
        secured.</p>
    <br> Hostname:
    <br> Username:
    <br> PortNumber:
    <br> SSHKey on the server .ssh/authorized_keys:
    <p><br />
    <h2>Enhanced Security for Service Port</h2>
    <p>To prevent your car from being stolen, the Ethernet service port below the central display can be disabled. To
        toggle this setting, your pin-to-drive code is required. Ensure to disable this feature prior to bringing your
        car to Tesla Service!</p>
    <br />Togglebutton
</div>

<div id="about" class="mainscreen_section">
    <h2>FreedomEV version 1.0 release 2018020301</h2>
    <p><A HREF=http://www.freedomev.com>http://www.freedomev.com</a>
    <p><br>
        No changes are persistent if the USB stick is removed, except for the Reverse SSH Tunnel and the Enhanced
        Security features found under the <B>Configuration</B> tab.
    <p><br>
    <h2>Credits</h2>
    <p>Thanks to Tesla for starting the EV revolution.<br>
    <p>
        Project Maintainer: <br>
        Jasper Nuyens<br>
    <p>
        Contributions by: <br>
        VeryGreen<br>
        Tom Van braeckel<br>
        nemSoma<br>
        Jo Giraerts<br>
        MastroGippo<br>
    <p>
        <br>
        A special mention of this project - it will open up a lot of possibilities:<br>
        <A HREF=https://github.com/lephisto/tesla-apiscraper>https://github.com/lephisto/tesla-apiscraper</A>

        And the entire Linux Community.</p>
    Test: <A HREF=http://192.168.90.100/raspap-webgui>raspap-webgui</a>
</div>


<script>
  $.when($.ready).then(function () {
    $(".niceButton").on("click", function (ev) {
      // Make spinner visible
      $("#" + ev.currentTarget.id + " i").removeClass("d-none");
      // Do ajax call
      $.ajax({
        url: 'controller.php',
        data: 'button=' + ev.currentTarget.id
      }).done(function () {
      }).fail(function () {
      }).always(function () {
        // When the call returns: hide the spinner again
        $("#" + ev.currentTarget.id + " i").addClass("d-none");


      });
    });
  });

  function showshortcuts() {
    var x = document.getElementById("main");
    var y = document.getElementById("hotspot");
    var z1 = document.getElementById("configuration");
    var z2 = document.getElementById("about");
    x.style.display = "block";
    y.style.display = "none";
    z1.style.display = "none";
    z2.style.display = "none";

    $(".nav-link").removeClass("active");
    $("#shortcutsmenu").addClass("active");
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

    $(".nav-link").removeClass("active");
    $("#hotspotmenu").addClass("active");
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

    $(".nav-link").removeClass("active");
    $("#configurationmenu").addClass("active");
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

    $(".nav-link").removeClass("active");
    $("#aboutmenu").addClass("active");
  }


  function openNav() {
    document.getElementById("mySidenav").style.width = "350px";
    document.getElementById("main").style.marginLeft = "350px";
    document.getElementById("hotspot").style.marginLeft = "350px";
    document.getElementById("configuration").style.marginLeft = "350px";
    document.getElementById("about").style.marginLeft = "350px";
  }

  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
    document.getElementById("hotspot").style.marginLeft = "0";
    document.getElementById("configuration").style.marginLeft = "0";
    document.getElementById("about").style.marginLeft = "0";
  }

  // On init
  openNav();
  showshortcuts();

</script>

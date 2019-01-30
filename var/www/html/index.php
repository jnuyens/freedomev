<?php
    include_once "apps.php";

    $shortcuts = [
        'privacy' => 'checked',
        'devmode' => '',
        'nosleep' => 'checked',
        'hotspot' => '',
    ];

    $apps = load_all_apps();

?>
<html>
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>FreedomEV</title>

    <script src="js/jquery.min.js"></script>
    <link href="css/bootstrap.min.css" rel="stylesheet"/>
    <script src="js/bootstrap.min.js"></script>
    <link href="fa/css/all.min.css" rel="stylesheet"/>
    <script src="fa/js/fontawesome.js"></script>
    <link href="css/switchery.min.css" rel="stylesheet" />
    <script src="js/switchery.min.js"></script>

    <link href="css/style.css" rel="stylesheet"/>
</head>

<body>

<div id="mySidenav" class="sidenav">
    <a id="shortcutsmenu" href="#" class="nav-link active" onclick="showSection('shortcuts');">Apps</a>
    <a id="configurationmenu" class="nav-link" href="#" onclick="showSection('configuration');" href="#">Configuration</a>
    <a id="registrymenu" class="nav-link" href="#" onclick="showSection('registry');" href="#">Settings</a>
    <a id="aboutmenu" class="nav-link" href="#" onclick="showSection('about');">About</a>
</div>
<div class="content">
    <div id="shortcuts" class="mainscreen_section">
<?php
            foreach ($apps as $app) {
                // Skip invisible apps
                if (isset($app['configinterfacevisible']) && $app['configinterfacevisible'] === "hidden") continue;

                $id = $app['id'];
?>
        <div class="togglebox">
            <input id="<?php echo $id; ?>" name="<?php echo $id; ?>" type="checkbox" class="js-switch" <?php echo $app['enabled'] ? 'checked' : ''; ?> />
            <i id="spinner_privacy" class="fa fa-spinner fa-pulse fa-fw margin-bottom d-none"></i>
            <span class="sr-only">Loading...</span>
        </div>
        <h2 class="d-inline"><?php echo $app['name']; ?></h2>
        <p class="app_description"><?php echo $app['description']; ?> </p>

        <div class="clearfix"></div>
        <p><br>
<?php
            }

?>
        <div class="app_description">
            <h2>A Better Route Planner</h2>
            <p>Multi-stop accurate routeplanner</p>
            <A HREF=https://abetterrouteplanner.com>https://abetterrouteplanner.com</a>
        </div>
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
        <p><br/>
        <h2>Enhanced Security for Service Port</h2>
        <p>To prevent your car from being stolen, the Ethernet service port below the central display can be disabled. To
            toggle this setting, your pin-to-drive code is required. Ensure to disable this feature prior to bringing your
            car to Tesla Service!</p>
        <br/>Togglebutton
    </div>

    <div id="registry" class="mainscreen_section"></div>

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
    </div>
</div>

<script>
    js_switch_lock = false;

  $.when($.ready).then(function () {
    // On init
    showSection('shortcuts');

    // Switchery: nice toggle buttons
    var elems = document.querySelectorAll('.js-switch');
    for (var i = 0; i < elems.length; i++) {
      var switchery = new Switchery(elems[i], {
        color               : '#007bff'
        , secondaryColor    : '#dfdfdf'
        , jackColor         : '#fff'
        , jackSecondaryColor: null
        , className         : 'switchery'
        , disabled          : false
        , disabledOpacity   : 0.5
        , speed             : '0.1s'
        , size              : 'default'
      });
    }

    // Event handler for the toggle buttons
    $(".js-switch").on("change", function (ev) {
//      console.log("lock:", js_switch_lock);

      if (js_switch_lock) {
//        console.log("Ignoring change event");
        return;
      }

      // Set a lock
      js_switch_lock = true;

      // Make spinner visible
      $("#" + ev.currentTarget.id + "~ i").removeClass("d-none");

      // Set timer to unlock
      setTimeout(function () {
        js_switch_lock = false;
      }, 2000);

      // Do ajax call
      $.ajax({
        url: 'controller.php',
        data: {
          command: "enable_disable_app",
          key: ev.currentTarget.id,
          value: ev.currentTarget.checked ? 1 : 0
        }
      }).done(function () {
      }).fail(function () {
      }).always(function () {

        // When the call returns: hide the spinner again
        $("#" + ev.currentTarget.id + "~ i").addClass("d-none");
//        js_switch_lock = false; // unlock
      });
    });
  });

  // When you click on a menuitem on the left
  function showSection(section) {
    switch (section) {
      case "registry":
        $("#registry").load("controller.php?command=load_lvs");
        break;
      default:
        $("#registry").html(""); // make sure registry is empty again
        break;
    }

    $(".mainscreen_section").css('display', 'none');
    $("#" + section).css('display', 'block');

    $(".nav-link").removeClass("active");
    $("#" + section + "menu").addClass("active");

  }

</script>
</body>
</html>
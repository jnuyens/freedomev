<?php
    $shortcuts = [
        'privacy' => 'checked',
        'devmode' => '',
        'nosleep' => 'checked',
        'hotspot' => '',
    ];

    // $registry = explode("\n", `lvs`);
    $registry = explode("\n", file_get_contents("lvs_example.txt"));
    array_shift($registry); // throw away the first item since it's a header
//    // Now we're going to sort the registry into categories:
//    foreach ($registry as $row) {
//
//    }
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
        <h2>Privacy Mode</h2>
        <p>Enable to stop all GPS, WiFi and 3G/4G connections to prevent vehicle location logging. Navigation, autopilot and
            online connections will stop working.</p>
        <div class="togglebox">
            <input id="privacy" name="privacy" type="checkbox" class="js-switch" <?php echo $shortcuts['privacy'] ?> />
            <label for="privacy" class="checkbox-label" data-off="Privacy mode off" data-on="Privacy mode on"></label>
            <i id="spinner_privacy" class="fa fa-spinner fa-pulse fa-fw margin-bottom d-none"></i>
            <span class="sr-only">Loading...</span>
        </div>

        <p><br>
        <h2>Developer Mode</h2>
        <p>Enable internal Tesla Developer Mode.</p>
        <div class="togglebox">
            <input id="devmode" name="devmode" type="checkbox" class="js-switch" <?php echo $shortcuts['devmode'] ?> />
            <i id="spinner_devmode" class="fa fa-spinner fa-pulse fa-fw margin-bottom d-none"></i>
            <span class="sr-only">Loading...</span>
            <label for="privacy" class="checkbox-label" data-off="Developer mode off" data-on="Developer mode on"></label>
        </div>

        <p><br>
        <h2>No Sleep Mode</h2>
        <p>Disable the sleeping of computer systems for remote working. Will induce more vampiric drain of the battery.
            Keeps the USB ports powered and Autopilot powered on.</p>
        <div class="togglebox">
            <input id="nosleep" name="nosleep" type="checkbox" class="js-switch" <?php echo $shortcuts['nosleep'] ?> />
            <i id="spinner_nosleep" class="fa fa-spinner fa-pulse fa-fw margin-bottom d-none"></i>
            <span class="sr-only">Loading...</span>
            <label for="nosleep" class="checkbox-label" data-off="No Sleep Mode off" data-on="No Sleep Mode on"></label>
        </div>

        <p><br/>
        <h2>HotSpot Mode</h2>
        <p>With a USB WiFi adapter and a supported driver, you can use the Tesla provided 3G/4G Network to gain Internet
            access for other devices. Keep track of the use of the Tesla Network data volume so you can be properly
            billed.</p>
        <div class="togglebox">
            <input id="hotspot" name="hotspot" type="checkbox" class="js-switch" <?php echo $shortcuts['hotspot'] ?> />
            <i id="spinner_hotspot" class="fa fa-spinner fa-pulse fa-fw margin-bottom d-none"></i>
            <span class="sr-only">Loading...</span>
            <label for="hotspot" class="checkbox-label" data-off="Hotspot Mode off" data-on="Hotspot Mode on"></label>
        </div>
        <a href="/raspap-webgui">Open Hotspot Dashboard</a>

        <p><br/>
        <h2>A Better Route Planner</h2>
        <p>Multi-stop accurate routeplanner</p>
        <A HREF=https://abetterrouteplanner.com>https://abetterrouteplanner.com</a>
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

    <div id="registry" class="mainscreen_section">
        <table class="table table-striped">
    <?php

        foreach ($registry as $row) {
            $data = str_getcsv($row);
            echo '<tr scope="row">';

            // varname
            $varname = $data[0];
            echo "<td>".$varname."</td>";

            // The value
            $value = $data[1];
?>
            <td>
                <input id="<?php echo $varname; ?>" name="<?php echo $varname; ?>" type="text" value="<?php echo $value; ?>" class="form-control registry-input" />
                <i class="fa fa-spinner fa-pulse fa-fw margin-bottom d-none"></i>
                <span class="sr-only">Loading...</span>
            </td>
<?php
            echo "</tr>";
        }
    ?>
        </table>
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
    </div>
</div>

<script>
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
      // Make spinner visible
      $("#" + ev.currentTarget.id + "~ i").removeClass("d-none");

      // Do ajax call
      $.ajax({
        url: 'controller.php',
        data: {
          command: ev.currentTarget.id,
          value: ev.currentTarget.checked ? 1 : 0
        }
      }).done(function () {
      }).fail(function () {
      }).always(function () {

        // When the call returns: hide the spinner again
        $("#" + ev.currentTarget.id + "~ i").addClass("d-none");


      });
    });

    // Event handler for the registry inputs
    $(".registry-input").on("change", function (ev) {
      console.log(ev);

      // Do ajax call
      $.ajax({
        url: 'controller.php',
        data: {
          command: 'update_lvs',
          key: ev.currentTarget.id,
          value: $(ev.currentTarget).val()
        }
      }).done(function () {
      }).fail(function () {
      }).always(function () {

        // When the call returns: hide the spinner again
        $("#" + ev.currentTarget.id + "~ i").addClass("d-none");

      });
    });
  });

  // When you click on a menuitem on the left
  function showSection(section) {
    $(".mainscreen_section").css('display', 'none');
    $("#" + section).css('display', 'block');

    $(".nav-link").removeClass("active");
    $("#" + section + "menu").addClass("active");
  }

</script>
</body>
</html>
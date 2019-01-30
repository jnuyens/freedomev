<?php
switch ($_REQUEST['command']) {
  case 'privacy':
    system("sleep 2");
    return "privacy on";
  case 'devmode':
    system("sleep 4");
    return "devmode on";
  case 'nosleep':
    system("sleep 6");
    return "nosleep on";
  case 'hotspot':
    system("sleep 3");
    return "hotspot on";
  case "update_lvs":
    return file_get_contents("http://192.168.90.100:4035/set_data_value?name={$REQUEST['key']}&value={$REQUEST['value']}");

  // You can add more actions here

}
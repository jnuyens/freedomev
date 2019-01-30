<?php
switch ($_REQUEST['command']) {
  case 'privacy':
    system("sleep 2");
    echo "privacy on";
  case 'devmode':
    system("sleep 4");
    echo "devmode on";
  case 'nosleep':
    system("sleep 6");
    echo "nosleep on";
  case 'hotspot':
    system("sleep 3");
    echo "hotspot on";
  case "update_lvs":
//    echo "http://192.168.90.100:4035/set_data_value?name={$_REQUEST['key']}&value={$_REQUEST['value']}";
//    die;
    return file_get_contents("http://192.168.90.100:4035/set_data_value?name={$_REQUEST['key']}&value={$_REQUEST['value']}");

  // You can add more actions here

}
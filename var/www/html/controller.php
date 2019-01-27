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

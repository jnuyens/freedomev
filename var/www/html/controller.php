<?php
switch ($_REQUEST['command']) {
  case 'enable_disable_app':
      $appfoldername = $_REQUEST['key'];

      // Enable
      if ($_REQUEST['value'] === '1')
        return exec("/freedomev/tools/enable-app $appfoldername");

      // Disable
      if ($_REQUEST['value'] === '0')
          return exec("/freedomev/tools/disable-app $appfoldername");

      echo ""; die;

  case "update_lvs":
//    echo "http://192.168.90.100:4035/set_data_value?name={$_REQUEST['key']}&value={$_REQUEST['value']}";
//    die;
    return file_get_contents("http://192.168.90.100:4035/set_data_value?name={$_REQUEST['key']}&value={$_REQUEST['value']}");
  case "load_lvs":
      ob_start();
        include_once "registry.php";
      ob_end_flush();
      break;
  // You can add more actions here

}
<?php
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 1);

date_default_timezone_set('Asia/Jakarta');
session_start();

require($_SESSION['DIRECTORY'] . "/config.php");
require($_SESSION['DIRECTORY'] . "/main/model/db01.php");
require($_SESSION['DIRECTORY'] . "/main/model/db.php");
require($_SESSION['DIRECTORY'] . "/pv_kv/controller/pv_kv.php");
require($_SESSION['DIRECTORY'] . "/pv_kv/model/pv_kv.php");

//if ($_SESSION['logged_in']) { #add if have login
$pv_kv = new PV_KV;

switch ($_POST['action']) {

    case "getPVKV":
        
        $result = $pv_kv->getPVKV();
        break;
    case "add":
        $data = array(
            'pn' => $_POST['pn'],
            'rev' => $_POST['rev'],
            'status' => $_POST['status']
        );
        $result = $pv_kv->addPVKV($data);
        break;

    case "update":
        $data = array(
            'rev' => $_POST['rev'],
            'status' => $_POST['status'],
            'pn' => $_POST['pn']
        );
        $result = $pv_kv->updatePVKV($data);
        break;
    default:
        $result = "Invalid action, please try again.";
}

$data = array('result' => $result);
// } else { #add if have login
//     $data = array ('error' => 'User not login.');
// }

echo json_encode($data);

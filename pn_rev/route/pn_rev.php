<?php
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 1);

date_default_timezone_set('Asia/Jakarta');
session_start();

require($_SESSION['DIRECTORY'] . "/config.php");
require($_SESSION['DIRECTORY'] . "/main/model/db01.php");
require($_SESSION['DIRECTORY'] . "/main/model/db.php");
require($_SESSION['DIRECTORY'] . "/pn_rev/controller/pn_rev.php");
require($_SESSION['DIRECTORY'] . "/pn_rev/model/pn_rev.php");

//if ($_SESSION['logged_in']) { #add if have login
$pn_rev = new PN_REV;

switch ($_POST['action']) {

    case "getPNREV":
        
        $result = $pn_rev->getPNREV();
        break;
    case "add":
        $data = array(
            'customer' => $_POST['customer'],
            'area' => $_POST['area'],
            'line' => $_POST['line'],
            'station' => $_POST['station'],
            'current_t' => $_POST['current_t'],
            'current_d' => $_POST['current_d'],
            'qty_in' => $_POST['qty_in'],
            'status' => $_POST['status']
        );
        $result = $hourly->add($data);
        break;

    case "update":
        $data = array(
            'rev' => $_POST['rev'],
            'status' => $_POST['status'],
            'pn' => $_POST['pn']
        );
        $result = $pn_rev->updatePNREV($data);
        break;
    default:
        $result = "Invalid action, please try again.";
}

$data = array('result' => $result);
// } else { #add if have login
//     $data = array ('error' => 'User not login.');
// }

echo json_encode($data);

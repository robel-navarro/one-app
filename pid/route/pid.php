<?php
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 1);

date_default_timezone_set('Asia/Jakarta');
session_start();

require($_SESSION['DIRECTORY'] . "/config.php");
require($_SESSION['DIRECTORY'] . "/main/model/db01.php");
require($_SESSION['DIRECTORY'] . "/main/model/db.php");
require($_SESSION['DIRECTORY'] . "/pid/controller/pid.php");
require($_SESSION['DIRECTORY'] . "/pid/model/pid.php");

//if ($_SESSION['logged_in']) { #add if have login
$pid = new PID;

switch ($_POST['action']) {

    case "getPID":
        
        $result = $pid->getPID();
        break;
    
    default:
        $result = "Invalid action, please try again.";
}

$data = array('result' => $result);
// } else { #add if have login
//     $data = array ('error' => 'User not login.');
// }

echo json_encode($data);

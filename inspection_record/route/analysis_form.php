<?php
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 1);

date_default_timezone_set('Asia/Jakarta');
session_start();

require($_SESSION['DIRECTORY'] . "/config.php");
require($_SESSION['DIRECTORY'] . "/main/model/db01.php");
require($_SESSION['DIRECTORY'] . "/main/model/db.php");
require($_SESSION['DIRECTORY'] . "/inspection_record/controller/analysis_form.php");
require($_SESSION['DIRECTORY'] . "/inspection_record/model/analysis_form.php");

//if ($_SESSION['logged_in']) { #add if have login
$AnalForm = new Analysis_Form;

switch ($_POST['action']) {

    case "GetTriggeringDefect":
        $result = $AnalForm->GetTriggeringDefect();
        break;
    case "GetTriggeringDefect_AutoEmail":
        $result = $AnalForm->GetTriggeringDefect_AutoEmail();
        break;
    case "Add":
        $data = array(
            'customer' => $_POST['customer'],
            'line' => $_POST['line'],
            'station' => $_POST['station'],
            'machine' => $_POST['machine'],
            'defect' => $_POST['defect'],
            'time' => $_POST['time'],
            'date' => $_POST['date'],
            'count' => $_POST['count'],
            // 'acknowledge_by' => $_POST['acknowledge_by'],
            'root_cause' => $_POST['root_cause'],
            'action_taken' => $_POST['action_taken'],
            'sn' => $_POST['sn']
        );
        $result = $AnalForm->Add($data);
        break;
    default:
        $result = "Invalid action, please try again.";
}

$data = array('result' => $result);
// } else { #add if have login
//     $data = array ('error' => 'User not login.');
// }

echo json_encode($data);

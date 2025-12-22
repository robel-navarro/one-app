<?php
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 1);

date_default_timezone_set('Asia/Jakarta');
session_start();

require($_SESSION['DIRECTORY'] . "/config.php");
require($_SESSION['DIRECTORY'] . "/main/model/db01.php");
require($_SESSION['DIRECTORY'] . "/main/model/db.php");
require($_SESSION['DIRECTORY'] . "/inspection_record/controller/inspection_form.php");
require($_SESSION['DIRECTORY'] . "/inspection_record/model/inspection_form.php");

//if ($_SESSION['logged_in']) { #add if have login
$InspForm = new Inspection_Form;

switch ($_POST['action']) {
    case "add":
        $data =  array(
            "sn" => $_POST['sn'],
            "customer" => $_POST['customer'],
            "area" => $_POST['area'],
            "line" => $_POST['line'],
            "model" => $_POST['model'],
            "station" => $_POST['station'],
            "machine" => $_POST['machine'],
            "fail_mode" => $_POST['fail_mode'],
            "fail_location" => $_POST['fail_location'],
            "fail_remarks" => $_POST['fail_remarks'],
            "retest_mode" => $_POST['retest_mode'],
            "retest_verification" => $_POST['retest_verification'],
            "retest_fail_desc" => $_POST['retest_fail_desc'],
            "retest_remarks" => $_POST['retest_remarks'],
        );
        $result = $InspForm->add($data);
        break;
    case "getAllCustomer":
        $result = $InspForm->getAllCustomer();
        break;
    case "getAllLocation":
        $result = $InspForm->getAllLocation();
        break;
    case "getPN":
        $result = $InspForm->getPN($_POST['customer_code']);
        break;
    case "getAllFailDesc":
        $result = $InspForm->getAllFailDesc($_POST['station_code']);
        break;
    case "getLine":
        $result = $InspForm->getLine($_POST['customer_code']);
        break;
    case "getStation":
        $result = $InspForm->getStation($_POST['customer_code']);
        break;
    case "getAllFailMode":
        $result = $InspForm->getAllFailMode();
        break;
    case "GetHourlyInspectionRecord":
        $data = array(
            'customer_code' => $_POST['customer_code'],
            'line' => $_POST['line'],
            'station' => $_POST['station']
        );

        $result = $InspForm->GetHourlyInspectionRecord($data);
        break;
    case "CheckHourlyQTYIN":

        $now = new DateTime();
        $now->modify('-1 hour');
        $current_d = $now->format('Y-m-d');
        $current_t = $now->format('H');

        $data = array(
            'customer' => $_POST['customer_code'],
            'line' => $_POST['line'],
            'station' => $_POST['station'],
            'current_t' => $current_t,
            'current_d' =>  $current_d
        );
        $result = $InspForm->CheckHourlyQTYIN($data);
        break;
    default:
        $result = "Invalid action, please try again.";
}

$data = array('result' => $result);
// } else { #add if have login
//     $data = array ('error' => 'User not login.');
// }

echo json_encode($data);

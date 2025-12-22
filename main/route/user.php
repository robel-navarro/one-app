<?php
error_reporting(E_ERROR | E_PARSE);
ini_set('display_errors', 1);

date_default_timezone_set('Asia/Jakarta');
session_start();

require($_SESSION['DIRECTORY'] . "/config.php");
require($_SESSION['DIRECTORY'] . "/main/model/db01.php");
require($_SESSION['DIRECTORY'] . "/main/model/db.php");
require ($_SESSION['DIRECTORY'] . "/main/controller/user.php");
require ($_SESSION['DIRECTORY'] . "/main/model/user.php");


$user = new User;

if ($_SESSION['logged_in']) {
    switch ($_POST['action']) {
    case "logoutUser":
            $result = $user->logout();
            break;
        default:
            $result = "Invalid action, please try again.";
    }

    $data = array('result' => $result);
} else {
    if ($_POST['action'] == 'loginUser') {
        $result = $user->login2($_POST['username'], $_POST['password']);
        $data = array('result' => $result);
    } else  if ($_POST['action'] == 'UserLoginAD') {
        $result = $user->LoginDomainUser($_POST['username'], $_POST['password']);
        $data = array('result' => $result);
    } else {
        $data = array('error' => 'User not login.');
    }
}

echo json_encode($data);

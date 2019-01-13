<?php

session_start();

include '../../config.php';
require '../Classes/PortalUser.php';

$user = new PortalUser($con);
$user->userId  = isset($_GET['user']) ? (int)$_GET['user'] : header("Location: ../../users/view_created_users.php");

// Delete the product
if($user->delete()){
    $response = array(
        "type" => "success",
        "message" => "User Deleted."
    );
    $_SESSION['message'] = $response;
    header("location:../../users/view_created_users.php");
    exit();
} else {
    $response = array(
        "type" => "error",
        "message" => "User not deleted."
    );
    $_SESSION['message'] = $response;
    header("location:../../users/view_created_users.php");
    exit();
}

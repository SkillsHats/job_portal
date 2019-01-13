<?php

session_start();

include '../../config.php';
include '../Classes/Portal.php';

if (isset($_GET['id'])){
    $companyId = (int)$_GET['id'];
    $portal = new Portal($con);
    $portal->companyId = $companyId;

    if ($portal->declineCompanyRequest()){
        $response = array(
            "type" => "success",
            "message" => "Company Request Declined"
        );
        $_SESSION['message'] = $response;
        header('location: ../../company/company_response.php');
        exit();
    } else {
        $response = array(
            "type" => "error",
            "message" => "Something Wrong!"
        );
        $_SESSION['message'] = $response;
        header('location: ../../company/company_response.php');
        exit();
    }
} else {
    $response = array(
        "type" => "error",
        "message" => "Something Wrong!"
    );
    $_SESSION['message'] = $response;
    header('location: ../../company/company_response.php');
    exit();
}
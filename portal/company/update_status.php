<?php

session_start();
if (isset($_GET['companyId'])){

    include '../config.php';
    include '../source/Classes/Portal.php';

    $companyId = (int)$_GET['companyId'];
    $portal = new Portal($con);
    $portal->companyId = $companyId;

    if ($portal->updateCompanyRequest()){
        $response = array(
            "type" => "success",
            "message" => "Company Approved"
        );
        $_SESSION['message'] = $response;
        header("location: company_details.php?id={$companyId}");
        exit();
    } else {
        $response = array(
            "type" => "error",
            "message" => "Something Wrong!"
        );
        $_SESSION['message'] = $response;
        header("location: company_details.php?id={$companyId}");
        exit();
    }
} else {
    $response = array(
        "type" => "error",
        "message" => "Something Wrong!"
    );
    $_SESSION['message'] = $response;
    header("location: company_details.php?id={$companyId}");
    exit();
}
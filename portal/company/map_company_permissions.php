<?php

if (isset($_POST['map'])){

    session_start();

    include '../config.php';
    include '../source/Classes/Portal.php';

    $role        = (int)$_POST['role'];
    $permissions = $_POST['permissions'];

    $portal = new Portal($con);
    $portal->roleId = $role;

    if ($portal->givePermissions($permissions)){
        $response = array(
            "type" => "success",
            "message" => "Done"
        );
        $_SESSION['message'] = $response;
        header("location: company_details.php?id={$_SESSION['portalID']}");
        exit();
    } else {
        $response = array(
            "type" => "error",
            "message" => "Something Wrong"
        );
        $_SESSION['message'] = $response;
        header("location: company_details.php?id={$_SESSION['portalID']}");
        exit();
    }
}
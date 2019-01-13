<?php

include_once '../../../config.php';
include_once '../../Classes/Course.php';

if (!isset($_POST['insert'])){
    header("Location: ../../../add_module.php");
    exit();
}

session_start();

$course = new Course($con);

$course->name   = $_POST['name'];
$course->slug   = $_POST['slug'];

if ($course->checkModule()){
    if($course->createModule()){
        $response = array(
            "type"    => "success",
            "message" => "Module Created."
        );
        $_SESSION['message'] = $response;
        header("location:../../../add_module.php");
        exit();
    } else{
        $response = array(
            "type" => "error",
            "message" => "Module not created."
        );
        $_SESSION['message'] = $response;
        header("location:../../../add_module.php");
        exit();
    }
} else {
    $response = array(
        "type" => "error",
        "message" => "Module already exists."
    );
    $_SESSION['message'] = $response;
    header("location:../../../add_module.php");
}


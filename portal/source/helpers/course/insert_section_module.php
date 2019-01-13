<?php

include_once '../../../config.php';
include_once '../../Classes/Course.php';

if (!isset($_POST['insert'])){
    header("Location: ../../../add_section_module.php");
    exit();
}

session_start();

$section = new Course($con);

$section->sectionId    = $_POST['section'];
$section->moduleName   = $_POST['name'];
$section->moduleSlug   = $_POST['slug'];
$section->moduleDesc   = $_POST['desc'];

$file                   = $_FILES['image'];
$imgName                = $file['name'];
$tmpName                = $file['tmp_name'];
$imgType                = $file["type"];
$extension              = GetImageExtension($imgType);
$imageName              ="img_".date("dmY")."_".time().$extension;
$targetPath             = "../../../image/course/section/".$imageName;
$section->moduleImage  = $targetPath;

if ($section->checkSection()){
    if(move_uploaded_file($tmpName, $targetPath)) {
        if ($section->createSection()) {
            $response = array(
                "type" => "success",
                "message" => "Section Module Created."
            );
            $_SESSION['message'] = $response;
            header("location:../../../add_section_module.php");
            exit();
        } else {
            $response = array(
                "type" => "error",
                "message" => "Section Module not created."
            );
            $_SESSION['message'] = $response;
            header("location:../../../add_section_module.php");
            exit();
        }
    } else {
        $response = array(
            "type" => "error",
            "message" => "Image not upload."
        );
        $_SESSION['message'] = $response;
        header("location:../../../add_section_module.php");
        exit();
    }
} else {
    $response = array(
        "type" => "error",
        "message" => "Section Module already exists."
    );
    $_SESSION['message'] = $response;
    header("location:../../../add_section_module.php");
}

function GetImageExtension($imagetype) {
    if(empty($imagetype))
        return false;
    switch($imagetype) {
        case 'image/bmp':
            return '.bmp';
        case 'image/gif':
            return '.gif';
        case 'image/jpeg':
            return '.jpg';
        case 'image/png':
            return '.png';
        default:
            return false;
    }
}
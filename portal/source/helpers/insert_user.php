<?php

session_start();

include '../../config.php';
require '../Classes/Company.php';
require '../Classes/Permissions.php';
//include '../../source/Classes/Image.php';

$company = new Company($con);
//$images   = new Image();

//$images->file 		 	    = $_FILES['image'];
//$imageName                    = $images->aboutImage();
//$targetPath                   = "../../image/company/user/".$imageName;
//$tmpName                      = $images->tempName();
//if(move_uploaded_file($tmpName, $targetPath)) {}

if (isset($_POST['create_user'])) {
    if (!empty($_POST['username'] && $_POST['password'] && $_POST['name'] && $_POST['email'] && $_POST['phone'])) {

        $company->username   = $_POST['username'];
        $company->password   = $_POST['password'];
        $company->name       = $_POST['name'];
        $company->email      = $_POST['email'];
        $company->phone      = $_POST['phone'];
        // $company->image   = $_POST['image'];
        $companyId           = $_POST['company_id'];
        $company->companyId  = $companyId;
        $company->userType   = $_POST['user_type'];
        $permissions         = $_POST['permissions'];

        if ($company->createUser()){
            $userId = $con->insert_id;
            if ($company->givePermissions($userId, $permissions, $companyId)){
                $response = array(
                    "type" => "success",
                    "message" => "User Created."
                );
                $_SESSION['message'] = $response;
                header("location: ../../users/create_user.php");
                exit();
            } else {
                $response = array(
                    "type" => "error",
                    "message" => "User permissions not mapped."
                );
                $_SESSION['message'] = $response;
                header("location: ../../users/create_user.php");
                exit();
            }
        } else {
            $response = array(
                "type" => "error",
                "message" => "User not Created."
            );
            $_SESSION['message'] = $response;
            header("location: ../../users/create_user.php");
            exit();
        }

    } else {
        $response = array(
            "type" => "error",
            "message" => "All fields are required."
        );
        $_SESSION['message'] = $response;
        header("location: ../../users/create_user.php");
        exit();
    }
}

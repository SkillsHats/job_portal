<?php

session_start();

include '../../config.php';
require '../Classes/PortalUser.php';
require '../Classes/Permissions.php';
//include '../../source/Classes/Image.php';

$user = new PortalUser($con);
//$images   = new Image();

//$images->file 		 	    = $_FILES['image'];
//$imageName                    = $images->aboutImage();
//$targetPath                   = "../../image/company/user/".$imageName;
//$tmpName                      = $images->tempName();
//if(move_uploaded_file($tmpName, $targetPath)) {}

if (isset($_POST['create_user'])) {
    if (!empty($_POST['username'] && $_POST['name'] && $_POST['email'] && $_POST['phone'])) {
        $user->userId      = $_POST['id'];
        $user->username   = $_POST['username'];
        $user->name       = $_POST['name'];
        $user->email      = $_POST['email'];
        $user->phone      = $_POST['phone'];


        if ($user->update()){
            $response = array(
                "type" => "success",
                "message" => "User updated."
            );
            $_SESSION['message'] = $response;
            header("location: ../../users/view_created_users.php");
            exit();
        } else {
            $response = array(
                "type" => "error",
                "message" => "User not Created."
            );
            $_SESSION['message'] = $response;
            header("location: ../../users/view_created_users.php");
            exit();
        }

    } else {
        $response = array(
            "type" => "error",
            "message" => "All fields are required."
        );
        $_SESSION['message'] = $response;
        header("location: ../../users/view_created_users.php");
        exit();
    }
}

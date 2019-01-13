<?php

session_start();
require_once '../config.php';

if(isset($_POST['company_register'])){

    $name    = $_POST['name'];
    $website = $_POST['website'];
    $email   = $_POST['email'];
    $number  = $_POST['number'];
    $pwd     = $_POST['pwd'];

    $query = "INSERT INTO company SET company_name = '$name', company_website = '$website', company_email = '$email', contact_number = '$number' ";
    
    if($con->query($query)){
        $hash = bin2hex(random_bytes(32));
        $company_id = $con->insert_id;
        $sql = "INSERT INTO users SET email = '$email', password = '$pwd', user_type = 4, company_id = $company_id, hash = '$hash' ";

        if($con->query($sql)){
            $response =  array(
                "type" => "success",
                "message" => "Your account has been created."
            );
            $_SESSION['message'] = $response;
            header("Location: signup.php");
            exit();
        } else {
            $response =  array(
                "type" => "error",
                "message" => "Something Wrong!."
            );
            $_SESSION['message'] = $response;
            header("Location: signup.php");
            exit();
        }

    }

}


if(isset($_POST['company_login'])){
    $email = $_POST['email'];
    $pwd = $_POST['password'];

    $query = "SELECT id, email, password, user_type, company_id from users WHERE email = '$email' AND password = '$pwd' AND user_type = 4";
    $result = $con->query($query);

    if($result->num_rows > 0){
        $row = $result->fetch_assoc();
        $_SESSION['uid'] = $row['id'];
        $_SESSION['utype'] = $row['user_type'];
        $_SESSION['portalId'] = $row['company_id'];
        header("Location: ../home.php");
        exit();
    } else {
        $response = array(
            "type" => "error",
            "message" => "Email or Password are Wrong!"
        );
        $_SESSION['message'] = $response;
        header("Location: signin.php");
        exit();
    }   
}

<?php

session_start();

require_once("../../config.php");
include_once("../../source/Classes/SlugGenerator.php");

if (isset($_POST['submit'])) {

    $generate       = new SlugGenerator($con);
    $companyId = 1;//(int)$_SESSION['portalID'];

    $generate->tableName     = "jobs";
    $generate->title         = $_POST['title'];

    $slug                    = $generate->generate();
    $title              = $con->real_escape_string($_POST['title']);
    $location           = $con->real_escape_string($_POST['location']);
    $paid               = $con->real_escape_string($_POST['paid']);
    $experience         = $con->real_escape_string($_POST['minexperience'] .", ". $_POST['maxexperience']);
    $skills             = $con->real_escape_string($_POST['skills']);
    $profile            = $con->real_escape_string($_POST['profile']);
    $salary             = $con->real_escape_string($_POST['minsalary'] .", ". $_POST['maxsalary']);
    $nature             = $con->real_escape_string($_POST['nature']);
    $city               = $con->real_escape_string($_POST['city']);
    $linkedIn           = $con->real_escape_string($_POST['linkedin']);
    $email              = $con->real_escape_string($_POST['email']);
    $contactNumber      = $con->real_escape_string($_POST['contact_number']);
    $industryType       = $con->real_escape_string($_POST['industry_type']);
    $interviewDate      = $con->real_escape_string($_POST['interview_date']);
    $qualification      = $con->real_escape_string($_POST['qualification']);
    $description        = $con->real_escape_string($_POST['description']);

    $query = "INSERT INTO jobs
                    SET title = '$title', slug = '$slug', 
                     profile = '$profile', industry_type = '$industryType', nature = '$nature', skills = '$skills', qualification = '$qualification',
                     experience = '$experience', address = '$location', city = '$city', paid = '$paid', salary = '$salary', linkedin_id = '$linkedIn',
                     contact_email = '$email', contact_number = '$contactNumber', interview_date = '$interviewDate', description = '$description', added_by = $companyId";

    if($con->query($query)){
        $response = array(
            "type" => "success",
            "message" => "Job Created successfully."
        );
        $_SESSION['message'] = $response;
        header("Location: ../../job/create_job.php");
        exit();
    } else {
        $response = array(
            "type" => "error",
            "message" => "Job Not Created."
        );
        $_SESSION['message'] = $response;
        header("Location: ../../job/create_job.php");
        exit();
    }
  
}

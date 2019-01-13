<?php

session_start();

require("../../config.php");
include_once("../Classes/Job.php");
include_once '../../source/Classes/Image.php';
include_once '../../source/Classes/SlugGenerator.php';

if (isset($_POST['submit'])) {

    $job            = new Job($con);
    $job->companyId = (int)$_SESSION['portalID'];
    $images         = new Image();
    $generate       = new SlugGenerator($con);

    $generate->tableName     = $job->tableName();
    $generate->title         = $_POST['title'];

    $slug                    = $generate->generate();
    $job->jobId              = $_POST['id'];
    $job->title              = $con->real_escape_string($_POST['title']);
    $job->slug               = $slug;
    $job->company            = $con->real_escape_string($_POST['company']);
    $job->companyWebsite     = $con->real_escape_string($_POST['company_website']);
    $job->location           = $con->real_escape_string($_POST['location']);
    $job->paid               = $con->real_escape_string($_POST['paid']);
    $job->experience         = $con->real_escape_string($_POST['minexperience'] .", ". $_POST['maxexperience']);
    $job->skills             = $con->real_escape_string($_POST['skills']);
    $job->profile            = $con->real_escape_string($_POST['profile']);
    $job->salary             = $con->real_escape_string($_POST['minsalary'] .", ". $_POST['maxsalary']);
    $job->nature             = $con->real_escape_string($_POST['nature']);
    $job->city               = $con->real_escape_string($_POST['city']);
    $job->linkedIn           = $con->real_escape_string($_POST['linkedin']);
    $job->email              = $con->real_escape_string($_POST['email']);
    $job->contactNumber      = $con->real_escape_string($_POST['contact_number']);
    $job->industryType       = $con->real_escape_string($_POST['industry_type']);
    $job->interviewDate      = $con->real_escape_string($_POST['interview_date']);
    $job->duration           = $con->real_escape_string($_POST['duration']);
    $job->qualification      = $con->real_escape_string($_POST['qualification']);
    $job->description        = $con->real_escape_string($_POST['description']);
    $job->skillsCapability   = $con->real_escape_string($_POST['skills_capability']);
    $job->requirement        = $con->real_escape_string($_POST['requirement']);

        if($job->update()){
            $response = array(
                "type" => "success",
                "message" => "Job updated successfully."
            );
            $_SESSION['message'] = $response;
            header("Location: ../../job/view_jobs.php");
            exit();
        } else {
            $response = array(
                "type" => "error",
                "message" => "Job not updated."
            );
            $_SESSION['message'] = $response;
            header("Location: ../../job/update_job.php?job={$_POST['id']}");
            exit();
        }
  
}

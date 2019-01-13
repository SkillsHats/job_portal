<?php

session_start();

require("../../config.php");
include_once '../../source/Classes/SlugGenerator.php';

if (isset($_POST['submit'])) {

    $companyId       = 1;//(int)$_SESSION['portalID'];

    $generate                = new SlugGenerator($con);

    $generate->tableName     = "internships";
    $generate->title         = $_POST['title'];

    $slug                    = $generate->generate();
    $title           = $con->real_escape_string($_POST['title']);
    $slug            = $slug;
    $location        = $con->real_escape_string($_POST['location']);
    $startDate       = $con->real_escape_string($_POST['start_date']);
    $duration        = $con->real_escape_string($_POST['duration']);
    $skills          = $con->real_escape_string($_POST['skills']);
    $profile         = $con->real_escape_string($_POST['profile']);
    $stipend         = $con->real_escape_string($_POST['minstipend']. ", ".$_POST['maxstipend']);
    $lastDate        = $con->real_escape_string($_POST['last_date']);
    $nature          = $con->real_escape_string($_POST['nature']);
    $city            = $con->real_escape_string($_POST['city']);
    $noOfSeats       = $con->real_escape_string($_POST['no_of_seats']);
    $linkedIn        = $con->real_escape_string($_POST['linkedin']);
    $email           = $con->real_escape_string($_POST['email']);
    $contactNumber   = $con->real_escape_string($_POST['contact_number']);
    $interviewDate   = $con->real_escape_string($_POST['interview_date']);
    $description     = $con->real_escape_string($_POST['description']);
    $eligible     = $con->real_escape_string($_POST['eligible']);

    $query = "INSERT INTO internships SET
                    title = '$title', slug = '$slug', address = '$location', skills = '$skills',  start_date = '$startDate', duration = '$duration', description = '$description', stipend = '$stipend', last_date = '$lastDate',
                     profile = '$profile', nature = '$nature', city = '$city', no_of_seats = $noOfSeats, linkedin_id = '$linkedIn', contact_email = '$email' , contact_number = '$contactNumber', interview_date = '$interviewDate',
                     eligibility = '$eligible', added_by = $companyId";
    echo $query;
    if($con->query($query)){
        $response = array(
            "type" => "success",
            "message" => "Internship Created successfully."
        );
        $_SESSION['message'] = $response;
        header("Location: ../../internship/create_internship.php");
        exit();
    } else {
        $response = array(
            "type" => "error",
            "message" => "Internship not Created. Something wrong try again!."
        );
        $_SESSION['message'] = $response;
        header("Location: ../../internship/create_internship.php");
        exit();
    }
  
}

<?php

session_start();

require("../../config.php");
include_once("../Classes/Intern.php");
include_once '../../source/Classes/Image.php';
include_once '../../source/Classes/SlugGenerator.php';

if (isset($_POST['submit'])) {

    $intern                  = new Intern($con);
    $images                  = new Image();
    $generate                = new SlugGenerator($con);

    $generate->tableName     = $intern->tableName();
    $generate->title         = $_POST['title'];

    $slug                    = $generate->generate();
    $intern->internshipId    = $con->real_escape_string($_POST['id']);
    $intern->title           = $con->real_escape_string($_POST['title']);
    $intern->slug            = $slug;
    $intern->company         = $con->real_escape_string($_POST['company']);
    $intern->companyWebsite  = $con->real_escape_string($_POST['company_website']);
    $intern->location        = $con->real_escape_string($_POST['location']);
    $intern->startDate       = $con->real_escape_string($_POST['start_date']);
    $intern->duration        = $con->real_escape_string($_POST['duration']);
    $intern->skills          = $con->real_escape_string($_POST['skills']);
    $intern->profile         = $con->real_escape_string($_POST['profile']);
    $intern->stipend         = $con->real_escape_string($_POST['minstipend']. ", ".$_POST['maxstipend']);
    $intern->lastDate        = $con->real_escape_string($_POST['last_date']);
    $intern->nature          = $con->real_escape_string($_POST['nature']);
    $intern->city            = $con->real_escape_string($_POST['city']);
    $intern->noOfSeats       = $con->real_escape_string($_POST['no_of_seats']);
    $intern->linkedIn        = $con->real_escape_string($_POST['linkedin']);
    $intern->email           = $con->real_escape_string($_POST['email']);
    $intern->contactNumber   = $con->real_escape_string($_POST['contact_number']);
    $intern->interviewDate   = $con->real_escape_string($_POST['interview_date']);
    $intern->description     = $con->real_escape_string($_POST['description']);
    $intern->qualityCouncil  = $con->real_escape_string($_POST['about_quality_council']);
    $intern->aboutIntern     = $con->real_escape_string($_POST['about_intern']);
    $intern->whoCanApply     = $con->real_escape_string($_POST['who_can_apply']);

    if($intern->update()){
        $response = array(
            "type" => "success",
            "message" => "Internship Updated successfully."
        );
        $_SESSION['message'] = $response;
        header("Location: ../../internship/view_internships.php");
        exit();
    } else {
        $response = array(
            "type" => "error",
            "message" => "Internship not updated. Something wrong try again!."
        );
        $_SESSION['message'] = $response;
        header("Location: ../../internship/view_internships.php");
        exit();
    }
}

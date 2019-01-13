<?php

session_start();

include "../../config.php";
require "../Classes/Intern.php";

$id = (int)$_GET['intern'];
$intern = new Intern($con);
$intern->internshipId = $id;

if ($intern->delete()){
    $response = array(
        "type" => "success",
        "message" => "Internship deleted successfully."
    );
    $_SESSION['message'] = $response;
    header("Location: ../../internship/view_internships.php");
    exit();
} else {
    $response = array(
        "type" => "error",
        "message" => "Internship not deleted."
    );
    $_SESSION['message'] = $response;
    header("Location:../../intern/view_internships.php");
    exit();
}

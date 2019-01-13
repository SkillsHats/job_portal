<?php

session_start();

include "../../config.php";
require "../Classes/Job.php";

$id = (int)$_GET['job'];
$job = new Job($con);
$job->jobId = $id;

if ($job->delete()){
    $response = array(
        "type" => "success",
        "message" => "Job deleted successfully."
    );
    $_SESSION['message'] = $response;
    header("Location:../../job/view_jobs.php");
    exit();
} else {
    $response = array(
        "type" => "error",
        "message" => "Job not deleted."
    );
    $_SESSION['message'] = $response;
    header("Location:../../job/view_jobs.php");
    exit();
}

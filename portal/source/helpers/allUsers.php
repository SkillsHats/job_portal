<?php

include "../../config.php";
include "../Classes/User.php";

$jobId = '';

$type = '';
if (isset($_POST['jobId']) && isset($_POST['type'])) {
    $jobId = $_POST['jobId'];
    $type = $_POST['type'];

    $user = new User($con);
    echo $user->getAllDetails($type,  $jobId);

}

$con->close();

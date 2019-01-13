<?php

include "../../config.php";
include "../Classes/User.php";

$userId = '';
$jobId = '';

if (isset($_POST['userId']) && isset($_POST['jobId'])) {
    $userId = $_POST['userId'];
    $jobId = $_POST['jobId'];
    $type   = $_POST['type'];

    $user = new User($con);
    $user->btnType = $type;
    echo $user->getDetails($userId, $jobId);

}

$con->close();

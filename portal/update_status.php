<?php

include "config.php";

if (isset($_GET['type'], $_GET['id'])){
    $tableJob           = "JOBS";
    $tableTest          = "TESTS";
    $tableJobApplied    = "USER_JOBS_APPLIED";
    $tableCompany       = "COMPANY";
    $resultTable        = "tbl_result";
    $type               = $_GET['type'];
    $id                 = (int)$_GET['id'];
    $uid                = (int)$_GET['uid'];
    $value              = $_GET['value'];

    switch ($type){

        case 'job':
            $query = "UPDATE ". $tableJob ." SET STATUS = {$value} WHERE ID = {$id}";
            $con->query($query);
            header("location: job/posted_jobs.php");
            break;

        case 'shortlisted':
            $query = " UPDATE ". $tableJobApplied ." SET PENDING = 0, SHORTLIST = 1 WHERE USER_ID = {$uid} ";
            if($con->query($query)){
                header("location: job/job_response.php?job={$id}");
            }

            break;

        case 'selected':
            $query = " UPDATE ". $tableJobApplied ." SET PENDING = 0, SHORTLIST = 0, SELECTED = 1 WHERE USER_ID = {$uid} ";
            if($con->query($query)){
                header("location: job/job_response.php?job={$id}");
            }
            break;

        case 'rejected':
            $query = " UPDATE ". $tableJobApplied ." SET PENDING = 0, SHORTLIST = 0, SELECTED = 0, REJECTED = 1 WHERE USER_ID = {$uid} ";
            if($con->query($query)){
                header("location: job/job_response.php?job={$id}");
            }
            break;

        case 'test':
            $query = "UPDATE ". $tableTest ." SET STATUS = {$value} WHERE TEST_ID = {$id}";
            $con->query($query);
            header("location: test/created_test.php");
            break;

        case 'test_shortlisted':
            $query = " UPDATE ". $resultTable ." SET PENDING = 0, SHORTLIST = 1 WHERE ADDED_BY = {$uid} ";
            if($con->query($query)){
                header("location: test/test_response.php?test={$id}");
            }

            break;

        case 'test_selected':
            $query = " UPDATE ". $resultTable ." SET PENDING = 0, SHORTLIST = 0, SELECTED = 1 WHERE ADDED_BY = {$uid} ";
            if($con->query($query)){
                header("location: test/test_response.php?test={$id}");
            }
            break;

        case 'test_rejected':
            $query = " UPDATE ". $resultTable ." SET PENDING = 0, SHORTLIST = 0, SELECTED = 0, REJECTED = 1 WHERE ADDED_BY = {$uid} ";
            if($con->query($query)){
                header("location: test/test_response.php?test={$id}");
            }
            break;
    }
}

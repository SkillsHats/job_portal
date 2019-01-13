<?php

/** This file used for JOB applied users  */

class User {

    private $tableJobApplied = "USER_JOBS_APPLIED";
    private $userTable = "tbl_user";
    private $con;
    private $status = 1;

    public $btnType;
    public $userId;
    public $jobId;

    // Constructor for connecting to the database.
    function __construct($con){
        $this->con = $con;
    }

    // Get individuals users information
    function getDetails($userId, $jobId){
        $sql = "SELECT * FROM ". $this->userTable ." WHERE uid = {$userId}";
        $result = $this->con->query($sql);

        if ($result->num_rows > 0) {
            return $this->fetchDetails($result, $jobId);
        } else {
            return "<div style='padding: 12px;'>No user found!</div>";
        }
    }

    // Get all users informations
    function getAllDetails($type, $jobId){

        switch ($type) {
            case "pending":
                $query = "SELECT U.uid, U.username, U.qualification FROM ". $this->userTable ." AS U LEFT JOIN {$this->tableJobApplied} AS UJA ON U.uid = UJA.USER_ID WHERE UJA.JOB_ID = {$jobId} AND UJA.PENDING = 1";
                break;

            case "shortlisted":
                $query = "SELECT U.uid, U.username, U.qualification FROM ". $this->userTable ." AS U LEFT JOIN {$this->tableJobApplied} AS UJA ON U.uid = UJA.USER_ID WHERE UJA.JOB_ID = {$jobId} AND UJA.SHORTLIST = 1";
                break;

            case "selected":
                $query = "SELECT U.uid, U.username, U.qualification FROM ". $this->userTable ." AS U LEFT JOIN {$this->tableJobApplied} AS UJA ON U.uid = UJA.USER_ID WHERE UJA.JOB_ID = {$jobId} AND UJA.SELECTED = 1";
                break;

            case "rejected":
                $query = "SELECT U.uid, U.username, U.qualification FROM ". $this->userTable ." AS U LEFT JOIN {$this->tableJobApplied} AS UJA ON U.uid = UJA.USER_ID WHERE UJA.JOB_ID = {$jobId} AND UJA.REJECTED = 1";
                break;
        }

        $result = $this->con->query($query);

        if ($result->num_rows > 0) {
            return $this->fetchAllDetails($result);
        } else {
            return "<div style='padding:12px;font-size:16px'>No user found!</div>";
        }
    }

    // Count how many jobs application in Pending Status
    function totalPending(){
        $query = "SELECT count(ID) as total FROM ". $this->tableJobApplied ." WHERE JOB_ID ={$this->jobId} AND PENDING = {$this->status}";
        $total = $this->execute($query);

        return $total;
    }

    // Count How application shortlisted for Interview
    function totalShortlisted(){
        $query = "SELECT count(ID) as total FROM ". $this->tableJobApplied ." WHERE JOB_ID ={$this->jobId} AND SHORTLIST = {$this->status}";
        $total = $this->execute($query);

        return $total;
    }

    // Count how many applications are selected for HR Round
    function totalSelected(){
        $query = "SELECT count(ID) as total FROM ". $this->tableJobApplied ." WHERE JOB_ID ={$this->jobId} AND SELECTED = {$this->status}";
        $total = $this->execute($query);

        return $total;
    }

    // Count how many applications are rejected.
    function totalRejected(){
        $query = "SELECT count(ID) as total FROM ". $this->tableJobApplied ." WHERE JOB_ID ={$this->jobId} AND REJECTED = {$this->status}";
        $total = $this->execute($query);

        return $total;
    }

    // Execute Query
    function execute($query){
        $result = $this->con->query($query);
        $row = $result->fetch_object();
        $total = $row->total;

        return $total;
    }


    // Get All Data for left side Menu
    function fetchAllDetails($result){
        $output = ""; $count = 0;
        while($row = $result->fetch_assoc()) {
            $count++;
            ($count == 1) ? $actived = "actived" : $actived = "";

            $output .= '<li id="'. $row['uid'] . '" class="' . $actived .'"><a><p class="truncate">' . $row['username'] . '</p><p>' . $row['qualification'] . '</p></a></li>';
            $count++;
        }

        return $output;
    }

    // Get Single User Details
    function fetchDetails($result, $jobId){
        $output = "";
        $row = $result->fetch_object();
        session_start();
        $_SESSION['invite_username'] = $row->username;
        $_SESSION['invite_useremail'] = $row->email;
        $output .= '<div class="top-part"><div class="row"><div class="col-md-3"><img class="img-responsive applicants-image" src="'. $row->user_img .' "></div><div class="col-md-7"><p class="applicant-name">'. $row->username .'</p><p class="applicant-location"><i class="fa fa-map-marker"></i> '. $row->city .'</p><p class="applicant-college"><i class="fa fa-graduation-cap"></i>'. $row->qualification .", ".$row->college_name .'</p><p><i class="fa fa-clock"></i> Availability  - Aug 19, 2018 to Aug 19, 2019 (6 months) </p><p class="applicant-mobile ng-scope" title=""><i class="fa fa-phone"></i><span class="blur"> '. $row->mobile .'</span></p><p class="applicant-email" title="Visible after Shortlisting/Selection"><i class="fa fa-envelope"></i><span class="blur"> '. $row->email .'</span></p></div><div class="col-md-2"><a class="pull-right btn btn-sm btn-default" title="Public profile of applicant" href="#" target="_blank" style="width: 120px;"><i class="fa fa-eye"></i>&nbsp;Quick view</a>'. $this->displayButton($jobId, $row->uid) .'</div></div></div><h4 class="heading">Candidate Information</h4><div class="middle-info-part fixht"><div class="applicant-panel"><h4>Candidate Resume</h4><p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Atque commodi consequatur cupiditate deleniti dolorem eligendi, facere facilis in laudantium molestias natus nostrum quidem, quisquam, temporibus voluptatibus! Harum laborum tempora veritatis.</p></div></div>';

        return $output;
    }

    // Display Button
    function displayButton($jobId, $uid){
        $output = '';

        switch ($this->btnType) {
            case "pending":
                $output .= '<a class="pull-right btn btn-sm btn-success" title="Shortlist for an interview" href="../update_status.php?type=shortlisted&id='. $jobId .'&uid='. $uid .'" style="width: 120px;margin-top: 10px;">&nbsp;Shortlist</a><a class="pull-right btn btn-sm btn-info" title="Select Applicant" href="../update_status.php?type=selected&id='. $jobId .'&uid='. $uid .'" style="width: 120px;margin-top: 5px;"> &nbsp;Select</a><a class="pull-right btn btn-sm btn-danger" title="Decline Applicant Application" href="../update_status.php?type=rejected&id='. $jobId .'&uid='. $uid .'" style="width: 120px;margin-top: 5px;">&nbsp;Decline</a><a class="pull-right btn btn-sm btn-warning" title="Invite For Test" href="../view_tests.php" target="_blank" style="width: 120px;margin-top: 5px;">&nbsp;Invite for Test</a><a class="pull-right btn btn-sm btn-primary" title="Invite For Video Interview" href="../view_tests.php" target="_blank" style="width: 120px;margin-top: 5px;">&nbsp;Video Interview</a>';
                break;

            case "shortlisted":
                $output .= '<a class="pull-right btn btn-sm btn-info" title="Select Applicant" href="../update_status.php?type=selected&id='. $jobId .'&uid='. $uid .'" style="width: 120px;margin-top: 5px;"> &nbsp;Select</a><a class="pull-right btn btn-sm btn-danger" title="Decline Applicant Application" href="../update_status.php?type=rejected&id='. $jobId .'&uid='. $uid .'" style="width: 120px;margin-top: 5px;">&nbsp;Decline</a><a class="pull-right btn btn-sm btn-warning" title="Invite For Test" href="../view_tests.php" target="_blank" style="width: 120px;margin-top: 5px;">&nbsp;Invite for Test</a><a class="pull-right btn btn-sm btn-primary" title="Invite For Video Interview" href="../view_tests.php" target="_blank" style="width: 120px;margin-top: 5px;">&nbsp;Video Interview</a>';
                break;

            case "selected":
                $output .= '<a class="pull-right btn btn-sm btn-danger" title="Decline Applicant Application" href="../update_status.php?type=rejected&id='. $jobId .'&uid='. $uid .'" style="width: 120px;margin-top: 5px;">&nbsp;Decline</a>';
                break;

            case "rejected":
                $output .= '<a class="pull-right btn btn-sm btn-warning" title="Re Invite For Test" href="../test/view_tests.php" target="_blank" style="width: 120px;margin-top: 5px;">&nbsp;Re Invite for Test</a><a class="pull-right btn btn-sm btn-primary" title="Re Invite For Video Interview" href="../view_tests.php" target="_blank" style="width: 120px;margin-top: 5px;">&nbsp;Re Video Interview</a>';
                break;
        }

        return $output;
    }
}
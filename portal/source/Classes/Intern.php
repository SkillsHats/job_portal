<?php

class Intern{

    private $internshipTable = "INTERNSHIPS";
    private $tableJobApplied = "USER_INTERNSHIP_APPLIED";
    private $userTable = "tbl_user";
    private $status = 0;
    private $con;

    public $internshipId, $id;
    public $companyId;
    public $userType;
    public $adEnabled = '';
    public $title, $slug, $skills, $company, $companyWebsite, $location, $startDate, $duration, $description, $stipend, $lastDate, $logo;
    public $profile, $nature, $city, $noOfSeats, $linkedIn, $email, $contactNumber, $interviewDate, $qualityCouncil, $aboutIntern, $whoCanApply, $addedDate;


    public function __construct($con){
        $this->con = $con;
    }


    // Return Table Name
    function tableName(){
        return $this->internshipTable;
    }


    //Read all jobs posted by company
    public function read(){
        $query = "SELECT * FROM {$this->internshipTable} WHERE ADDED_BY = {$this->companyId}";
        $stmt = $this->con->query($query);

        return $stmt;
    }


    public function updateOne(){
        $query = "SELECT * FROM {$this->internshipTable} WHERE ID = {$this->internshipId}";
        $stmt = $this->con->query($query);

        return $stmt;
    }


    // Insert Internship
    public function create(){
        $query = "INSERT INTO ". $this->internshipTable ."
                    (TITLE, SLUG, SKILLS, COMPANY_NAME, COMPANY_WEBSITE , ADDRESS, START_DATE, DURATION, DESCRIPTION, STIPEND, LAST_DATE,LOGO,
                     PROFILE, NATURE, CITY, NO_OF_SEATS, LINKEDIN_ID, CONTACT_EMAIL, CONTACT_NUMBER, INTERVIEW_DATE,ABOUT_QUALITY_COUNCIL, ABOUT_INTERN ,WHO_CAN_APPLY, STATUS,ADDED_BY,ADDED_DATE) 
                  VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->con->prepare($query);

        // Sanitize Data
        $this->title            = htmlspecialchars(strip_tags($this->title));
        $this->slug             = htmlspecialchars(strip_tags($this->slug));
        $this->skills           = htmlspecialchars(strip_tags($this->skills));
        $this->company          = htmlspecialchars(strip_tags($this->company));
        $this->companyWebsite   = htmlspecialchars(strip_tags($this->companyWebsite));
        $this->location         = htmlspecialchars(strip_tags($this->location));
        $this->startDate        = htmlspecialchars(strip_tags($this->startDate));
        $this->duration         = htmlspecialchars(strip_tags($this->duration));
        $this->stipend          = htmlspecialchars(strip_tags($this->stipend));
        $this->lastDate         = htmlspecialchars(strip_tags($this->lastDate));
        $this->logo             = str_replace("../../","",$this->logo);
        $this->profile          = htmlspecialchars(strip_tags($this->profile));
        $this->nature           = htmlspecialchars(strip_tags($this->nature));
        $this->city             = htmlspecialchars(strip_tags($this->city));
        $this->noOfSeats        = htmlspecialchars(strip_tags($this->noOfSeats));
        $this->linkedIn         = htmlspecialchars(strip_tags($this->linkedIn));
        $this->email            = htmlspecialchars(strip_tags($this->email));
        $this->contactNumber    = htmlspecialchars(strip_tags($this->contactNumber));
        $this->interviewDate    = htmlspecialchars(strip_tags($this->interviewDate));
        $this->addedDate        = date('Y-m-d h:i:s', time());

        // Bind Data
        $stmt->bind_param("sssssssssssssssssssssssiis", $this->title, $this->slug, $this->skills, $this->company, $this->companyWebsite, $this->location, $this->startDate, $this->duration, $this->description, $this->stipend, $this->lastDate, $this->logo, $this->profile, $this->nature, $this->city, $this->noOfSeats, $this->linkedIn, $this->email, $this->contactNumber, $this->interviewDate, $this->qualityCouncil, $this->aboutIntern, $this->whoCanApply, $this->status, $this->companyId, $this->addedDate);

        if($stmt->execute()){
            return true;
        }

        return false;
    }


    // Insert Internship
    public function update(){
        $query = "UPDATE {$this->internshipTable} SET TITLE = ?, SLUG = ?, SKILLS = ?, COMPANY_NAME = ?, COMPANY_WEBSITE = ? , ADDRESS = ?, START_DATE = ?, DURATION = ?, DESCRIPTION = ?, STIPEND = ?, LAST_DATE = ?, PROFILE = ?, NATURE = ?, CITY = ?, NO_OF_SEATS = ?, LINKEDIN_ID = ?, CONTACT_EMAIL = ?, CONTACT_NUMBER = ?, INTERVIEW_DATE = ?, ABOUT_QUALITY_COUNCIL = ?, ABOUT_INTERN = ? ,WHO_CAN_APPLY = ? WHERE ID = ?";

        $stmt = $this->con->prepare($query);

        // Sanitize Data
        $this->title            = htmlspecialchars(strip_tags($this->title));
        $this->slug             = htmlspecialchars(strip_tags($this->slug));
        $this->skills           = htmlspecialchars(strip_tags($this->skills));
        $this->company          = htmlspecialchars(strip_tags($this->company));
        $this->companyWebsite   = htmlspecialchars(strip_tags($this->companyWebsite));
        $this->location         = htmlspecialchars(strip_tags($this->location));
        $this->startDate        = htmlspecialchars(strip_tags($this->startDate));
        $this->duration         = htmlspecialchars(strip_tags($this->duration));
        $this->stipend          = htmlspecialchars(strip_tags($this->stipend));
        $this->lastDate         = htmlspecialchars(strip_tags($this->lastDate));
        $this->profile          = htmlspecialchars(strip_tags($this->profile));
        $this->nature           = htmlspecialchars(strip_tags($this->nature));
        $this->city             = htmlspecialchars(strip_tags($this->city));
        $this->noOfSeats        = htmlspecialchars(strip_tags($this->noOfSeats));
        $this->linkedIn         = htmlspecialchars(strip_tags($this->linkedIn));
        $this->email            = htmlspecialchars(strip_tags($this->email));
        $this->contactNumber    = htmlspecialchars(strip_tags($this->contactNumber));
        $this->interviewDate    = htmlspecialchars(strip_tags($this->interviewDate));

        // Bind Data
        $stmt->bind_param("ssssssssssssssssssssssi", $this->title, $this->slug, $this->skills, $this->company, $this->companyWebsite, $this->location, $this->startDate, $this->duration, $this->description, $this->stipend, $this->lastDate, $this->profile, $this->nature, $this->city, $this->noOfSeats, $this->linkedIn, $this->email, $this->contactNumber, $this->interviewDate, $this->qualityCouncil, $this->aboutIntern, $this->whoCanApply, $internshipId);

        if($stmt->execute()){
            return true;
        }

        return false;
    }


    // delete the job
    function delete(){
        $query = "DELETE FROM {$this->internshipTable} WHERE ID = ?";
        $stmt = $this->con->prepare($query);
        $this->internshipId = htmlspecialchars(strip_tags($this->internshipId));
        $stmt->bind_param('i', $this->internshipId);

        if($stmt->execute()){
            return true;
        }
        return false;
    }


    // Count how many jobs posted by a company
    function totalPostedInternships(){
        $query = "SELECT count(ID) as total FROM ". $this->internshipTable ." WHERE ADDED_BY = {$this->companyId} ";
        $total = $this->execute($query);

        return $total;
    }


    // Execute query
    function execute($query){
        $stmt = $this->con->query($query);
        $total = 0;

        if ($stmt->num_rows > 0){
            $result = $stmt->fetch_object();
            $total = $result->total;
        }

        return $total;
    }
}
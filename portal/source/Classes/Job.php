 <?php

class Job {

     private $tableName = "jobs";
     private $tableJobApplied = "USER_JOBS_APPLIED";
     private $userTable = "users";
     private $con;
     private $status = 0;

     public $jobId;
     public $companyId;
     public $userType;
     public $adEnabled = '';
     public $title, $slug, $location, $paid, $experience, $skills,$profile, $salary, $nature, $city ;
     public $linkedIn, $email, $contactNumber, $industryType, $interviewDate, $qualification, $description;


     // Constructor for connecting database
     function __construct($con) {
         $this->con = $con;
     }


    // Return Table Name
    function tableName(){
        return $this->tableName;
    }


    public function read(){
         $query = "SELECT * FROM {$this->tableName} WHERE ADDED_BY = {$this->companyId}";
         $stmt = $this->con->query($query);

         return $stmt;
    }

     public function readOne(){
         $query = "SELECT * FROM {$this->tableName} WHERE SLUG = {$this->slug}";
         $stmt = $this->con->query($query);

         return $stmt;
     }

    // Insert Job
    public function create(){
        $query = "INSERT INTO ". $this->tableName ."
                    SET title = ?, slug = ?, 
                     profile = ?, industry_type = ?, nature = ?, skills = ?, qualififcation = ?,
                     experience = ?, address = ?, city = ?, paid = ?, salary, linkedin_id = ?,
                     contact_email = ?, contact_number = ?, interview_date = ?, description = ?, added_by = ?";

        $stmt = $this->con->prepare($query);

        // Sanitize Data
        $this->title            = htmlspecialchars(strip_tags($this->title));
        $this->slug             = htmlspecialchars(strip_tags($this->slug));
        $this->location         = htmlspecialchars(strip_tags($this->location));
        $this->paid             = htmlspecialchars(strip_tags($this->paid));
        $this->experience       = htmlspecialchars(strip_tags($this->experience));
        $this->skills           = htmlspecialchars(strip_tags($this->skills));
        $this->profile          = htmlspecialchars(strip_tags($this->profile));
        $this->salary           = htmlspecialchars(strip_tags($this->salary));
        $this->nature           = htmlspecialchars(strip_tags($this->nature));
        $this->city             = htmlspecialchars(strip_tags($this->city));
        $this->linkedIn         = htmlspecialchars(strip_tags($this->linkedIn));
        $this->email            = htmlspecialchars(strip_tags($this->email));
        $this->contactNumber    = htmlspecialchars(strip_tags($this->contactNumber));
        $this->industryType     = htmlspecialchars(strip_tags($this->industryType));
        $this->interviewDate    = htmlspecialchars(strip_tags($this->interviewDate));
        $this->qualification    = htmlspecialchars(strip_tags($this->qualification));

        // Bind Data
        $stmt->bind_param("sssssssssssssssssi", $this->title, $this->slug, $this->profile, $this->industryType, $this->nature,$this->skills,$this->qualification,$this->experience,$this->location, $this->city,  $this->paid,  $this->salary,
        $this->linkedIn, $this->email, $this->contactNumber,  $this->interviewDate, $this->description,  $this->companyId);

        if($stmt->execute()){
            return true;
        }

        return false;
    }


    // Update One Job
    public function updateOne(){
        $query = "SELECT * FROM {$this->tableName} WHERE ID = {$this->jobId}";
        $stmt = $this->con->query($query);

        return $stmt;
    }


    // Update Job
    public function update(){
        $query = "UPDATE ". $this->tableName ." SET TITLE = ?, SLUG = ?, COMPANY_NAME = ?, COMPANY_WEBSITE = ?, AD_ENABLED = ?,
                     ADDRESS = ?, PAID = ?,  EXPERIENCE_NEEDED = ?, SKILLS = ?, PROFILE = ?,
                     SALARY = ?, NATURE = ?, CITY = ?, DESCRIPTION = ?, LINKEDIN_ID = ?, CONTACT_EMAIL = ?,
                     CONTACT_NUMBER = ?, INDUSTRY_TYPE = ?, INTERVIEW_DATE = ?, DURATION = ?, QUALIFICATION = ?,
                     SKILLS_CAPABILITY = ?, REQUIREMENTS = ?, ADDED_DATE = ? WHERE ID = ?";

        $stmt = $this->con->prepare($query);

        // Sanitize Data
        $this->title            = htmlspecialchars(strip_tags($this->title));
        $this->slug             = htmlspecialchars(strip_tags($this->slug));
        $this->company          = htmlspecialchars(strip_tags($this->company));
        $this->companyWebsite   = htmlspecialchars(strip_tags($this->companyWebsite));
        $this->location         = htmlspecialchars(strip_tags($this->location));
        $this->paid             = htmlspecialchars(strip_tags($this->paid));
        $this->experience       = htmlspecialchars(strip_tags($this->experience));
        $this->skills           = htmlspecialchars(strip_tags($this->skills));
        $this->profile          = htmlspecialchars(strip_tags($this->profile));
        $this->salary           = htmlspecialchars(strip_tags($this->salary));
        $this->nature           = htmlspecialchars(strip_tags($this->nature));
        $this->city             = htmlspecialchars(strip_tags($this->city));
        $this->linkedIn         = htmlspecialchars(strip_tags($this->linkedIn));
        $this->email            = htmlspecialchars(strip_tags($this->email));
        $this->contactNumber    = htmlspecialchars(strip_tags($this->contactNumber));
        $this->industryType     = htmlspecialchars(strip_tags($this->industryType));
        $this->interviewDate    = htmlspecialchars(strip_tags($this->interviewDate));
        $this->duration         = htmlspecialchars(strip_tags($this->duration));
        $this->qualification    = htmlspecialchars(strip_tags($this->qualification));
        $this->addedDate        = date('Y-m-d h:i:s', time());

        // Bind Data
        $stmt->bind_param("ssssssssssssssssssssssssi", $this->title, $this->slug, $this->company, $this->companyWebsite, $this->adEnabled, $this->location, $this->paid, $this->experience, $this->skills,$this->profile, $this->salary, $this->nature, $this->city, $this->description,
        $this->linkedIn, $this->email, $this->contactNumber, $this->industryType, $this->interviewDate, $this->duration, $this->qualification, $this->skillsCapability, $this->requirement, $this->addedDate, $this->jobId);

        if($stmt->execute()){
            return true;
        }

        return false;
    }


    // delete the job
    function delete(){
        $query = "DELETE FROM {$this->tableName} WHERE ID = ?";
        $stmt = $this->con->prepare($query);
        $this->jobId = htmlspecialchars(strip_tags($this->jobId));
        $stmt->bind_param('i', $this->jobId);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }


     // Get All Posted Jobs
     function allJob(){
         $query = "SELECT * FROM {$this->tableName} ORDER BY ID DESC";
         $result = $this->con->query($query);
         $jobs = array();
         if ($result->num_rows > 0){
             while($row = $result->fetch_object()){
                 $jobs[] = $row;
             }
         }

         return $jobs;
     }

     // Count how many jobs created
     function totalJobs(){
         $query = "SELECT count(ID) as total FROM ". $this->tableName;
         $total = $this->execute($query);

         return $total;
     }


    // Count how many jobs posted by a company
    function totalPostedJobs(){
        $query = "SELECT count(ID) as total FROM ". $this->tableName ." WHERE ADDED_BY = {$this->companyId} ";
        $total = $this->execute($query);

        return $total;
    }


    // Get Job title
    function jobTitle(){
        $query = "SELECT TITLE FROM  ". $this->tableName ." WHERE ID = {$this->jobId}";
        $result = $this->con->query($query);
        $row = $result->fetch_object();
        $title = $row->TITLE;

        return $title;
    }

    // Count total number of applications
    function totalApplied(){
         $query = "SELECT count(ID) as total FROM {$this->tableJobApplied}";
         $total = $this->execute($query);

         return $total;
    }

    // Count how many applications are selected for HR Round
    function totalSelected(){
        $query = "SELECT count(ID) as total FROM ". $this->tableJobApplied ." WHERE SELECTED = {$this->status}";
        $total = $this->execute($query);

        return $total;
    }

    // Count how many applications for particular job
    function jobApplied(){
        $query = "SELECT count(ID) as total FROM ". $this->tableJobApplied ." WHERE JOB_ID ={$this->jobId}";
        $total = $this->execute($query);

        return $total;
    }

     // About candidate
     function aboutUser(){
         $info = array();

         $query = "SELECT U.uid, U.username, U.function, U.agentname, U.email, U.mobile, U.user_img, UJA.USER_ID FROM ". $this->userTable ." AS U LEFT JOIN ". $this->tableJobApplied ." AS UJA ON U.uid = UJA.USER_ID WHERE UJA.JOB_ID = {$this->jobId}";
         $result = $this->con->query($query);
         if ($result->num_rows > 0){
             while($row = $result->fetch_object()){
                 $info[]= $row;
             }
         }
         return $info;
     }

     // Check how many users apply for specific job.
    function jobResponse($jobId) {
        $sql = "SELECT COUNT(USER_ID) as total FROM ". $this->tableJobApplied ." WHERE JOB_ID = {$jobId}";
        $total = $this->execute($sql);

        return $total;
    }

    function userShortlisted($jobId) {
        $query = "SELECT count(ID) as total FROM ". $this->tableJobApplied ." WHERE JOB_ID ={$jobId} AND SHORTLIST = {$this->status}";
        $total = $this->execute($query);

        return $total;
    }

    function userSelected($jobId) {
        $query = "SELECT count(ID) as total FROM ". $this->tableJobApplied ." WHERE JOB_ID ={$jobId} AND SELECTED = {$this->status}";
        $total = $this->execute($query);

        return $total;
    }

    // Execute all total Queries
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

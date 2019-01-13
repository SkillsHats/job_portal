<?php

class Company {
    private $companyTable           = "COMPANY";
    private $usersTable             = "users";
    private $permissionTable        = "PERMISSIONS";
    private $totalPermissionTable   = "TOTAL_PERMISSIONS";
    private $userPermissions        = "USER_PERMISSIONS_MAPPING";
    private $plansTable             = "PLANS";
    private $con;
    private $status = 1;
    private $function               = "COMPANY";

    public $companyId;
    public $instituteId = 0;
    public $collegeId = 0;
    public $userType;

    public $planId;
    public $permissionId;

    public $userId;
    public $id;
    public $name;
    public $username;
    public $password;
    public $email;
    public $phone;
    public $image = '';
    public $addedDate;


    // Constructor
    public function __construct($con) {
        $this->con = $con;
    }


    // Fetch Company Name
    public function companyName(){
        $company = '';
        $query = "SELECT COMPANY_NAME AS COMPANY FROM {$this->companyTable} WHERE COMPANY_ID = {$this->companyId}";
        $result = $this->con->query($query);
        if ($result->num_rows > 0){
            $row = $result->fetch_object();
            $company = $row->COMPANY;
        }
        return $company;
    }


    // Read Company Details
    public function readCompany(){
        $query = "SELECT C.COMPANY_ID, C.COMPANY_NAME, C.COMPANY_WEBSITE, C.COMPANY_EMAIL, C.COMPANY_MOBILE, C.LOGO, C.PLAN, C.ADDED_DATE
                  FROM {$this->companyTable} AS C
                  WHERE C.COMPANY_ID = {$this->companyId} AND C.STATUS = {$this->status}" ;
        $stmt = $this->con->query($query);
        return $stmt;
    }


    // Read all users created by a company
    public function readUser(){
        $query = "SELECT U.UID, U.USERNAME, U.AGENT_NAME, U.EMAIL, U.MOBILE, U.LOGO, U.FUNCTION, U.USER_TYPE, U.PARENT_ID, U.COMPANY_ID, U.ADDED_DATE
                  FROM {$this->usersTable} AS U
                  WHERE U.USER_TYPE = {$this->userType} AND U.COMPANY_ID = {$this->companyId} AND U.PARENT_ID = {$this->companyId} AND U.STATUS = {$this->status}" ;
        $stmt = $this->con->query($query);
        return $stmt;
    }


    // Read particular user
    public function readOneUser(){
        $query = "SELECT U.UID, U.USERNAME, U.AGENT_NAME, U.EMAIL, U.MOBILE, U.LOGO, U.FUNCTION, U.USER_TYPE, U.PARENT_ID, U.COMPANY_ID, U.ADDED_DATE
                  FROM {$this->usersTable} AS U
                  WHERE U.UID = {$this->userId} AND U.COMPANY_ID = {$this->companyId} AND U.STATUS = {$this->status}" ;
        $stmt = $this->con->query($query);
        return $stmt;
    }


    // Check Company Verify its email or not
    public function checkEmailStatus(){
        $query = "SELECT STATUS FROM {$this->usersTable} WHERE UID = {$this->userId} AND COMPANY_ID = {$this->companyId}";
        $result = $this->con->query($query);

        return $result;
    }


    // Company Status -> approved by admin or not
    public function checkCompanyStatus(){
        $query = "SELECT STATUS FROM {$this->companyTable} WHERE COMPANY_ID = {$this->companyId}";
        $result = $this->con->query($query);

        return $result;
    }


    // Check Company Plan
    public function checkCompanyPlan(){
        $query = "SELECT PLAN FROM {$this->companyTable} WHERE COMPANY_ID = {$this->companyId}";
        $stmt = $this->con->query($query);
        if ($stmt->num_rows > 0 ){
            $row = $stmt->fetch_object();
            $plan = $row->PLAN;
        } else {
            return false;
        }

        return $plan;
    }


    // Fetch Company Plan Name
    public function planName($plan){
        $query = "SELECT PLAN_NAME FROM {$this->plansTable} WHERE PLAN_ID = {$plan}";
        $stmt = $this->con->query($query);

        return $stmt;
    }


    // Check how many users created by a company
    public function totalCreatedUser(){
        $query = "SELECT COUNT(UID) AS TOTAL FROM {$this->usersTable} WHERE PARENT_ID = {$this->companyId}";
        $total = $this->execute($query);

        return $total;
    }


    // Calculate how permissions left to create user
    public function totalLeftPermissionToCreateUser($totalPermission, $totalCreated){
        return $totalPermission - $totalCreated;
    }


    // Create user
    public function createUser(){
        $query = "INSERT INTO ". $this->usersTable ."(USERNAME, PASSWORD, AGENT_NAME, EMAIL, MOBILE, LOGO, FUNCTION, USER_TYPE, PARENT_ID, COMPANY_ID, INSTITUTE_ID, COLLEGE_ID, HASH, STATUS, ADDED_DATE) VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $this->con->prepare($query);

        // Sanitize Data
        $this->name      = htmlspecialchars(strip_tags($this->name));
        $this->username  = htmlspecialchars(strip_tags($this->username));
        $this->password  = htmlspecialchars(strip_tags($this->password));
        //$this->image     = str_replace("../../","",$this->image);
        $this->email     = htmlspecialchars(strip_tags($this->email));
        $this->phone     = htmlspecialchars(strip_tags($this->phone));
        $this->addedDate = date('Y-m-d h:i:s', time());
        $hash = bin2hex(random_bytes(32));
        // Bind Data
        $stmt->bind_param("ssssssssiiiisis", $this->username, $this->password, $this->name, $this->email, $this->phone, $this->image, $this->function, $this->userType, $this->companyId, $this->companyId, $this->instituteId,$this->collegeId, $hash, $this->status, $this->addedDate);

        if($stmt->execute()){
            return true;
        }

        return false;
    }


    // Give permissions to users
    public function givePermissions($userId, $permissions, $companyId){
        $query = "";
        foreach ($permissions as $permission){
            $query .= "INSERT INTO ". $this->userPermissions ."(USER_ID, PERMISSION_ID, COMPANY_ID, DATE_MAPPED) VALUES({$userId},{$permission},{$companyId} ,NOW());";
        }

        if($this->con->multi_query($query)){
            return true;
        }

        return false;
    }


    public function execute($query){
        $result = $this->con->query($query);
        $total = 0;
        if ($result->num_rows > 0) {
            $row = $result->fetch_object();
            $total = $row->TOTAL;
        }

        return $total;
    }

}

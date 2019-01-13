<?php

class Portal {
    private $companyTable    = "COMPANY";
    private $usersTable      = "users";
    private $permissionTable = "PERMISSIONS";
    private $rolePermissions = "ROLES_PERMISSIONS_MAPPING";
    private $con;
    private $status = 1;

    public $companyId;
    public $userType;

    public $roleId;
    public $permissionId;

    public $userId;
    public $name;
    public $username;
    public $password;
    public $email;
    public $phone;
    public $image;
    public $addedDate;


    public function __construct($con) {
        $this->con = $con;
    }


    public function readCompany(){
        $query = "SELECT C.COMPANY_ID, C.COMPANY_NAME, C.COMPANY_EMAIL, C.COMPANY_MOBILE, C.LOGO, C.STATUS, C.ADDED_DATE
                  FROM {$this->companyTable} AS C" ;
        $stmt = $this->con->query($query);
        return $stmt;
    }


    public function readOneCompany(){
        $query = "SELECT C.COMPANY_ID, C.COMPANY_NAME, C.COMPANY_EMAIL, C.COMPANY_MOBILE, C.LOGO, C.STATUS, C.ADDED_DATE
                  FROM {$this->companyTable} AS C
                  WHERE C.COMPANY_ID = {$this->companyId}" ;
        $stmt = $this->con->query($query);
        return $stmt;
    }


    public function readUser(){
        $query = "SELECT U.UID, U.USERNAME, U.AGENT_NAME, U.EMAIL, U.MOBILE, U.LOGO, U.FUNCTION, U.USER_TYPE, U.PARENT_ID, U.COMPANY_ID, U.ADDED_DATE
                  FROM {$this->usersTable} AS U
                  WHERE U.UID = {$this->userId} AND U.COMPANY_ID = {$this->companyId} AND U.STATUS = {$this->status}" ;
        $stmt = $this->con->query($query);
        return $stmt;
    }


    public function companyRequest(){
        $query = "SELECT C.COMPANY_ID, C.COMPANY_NAME, C.COMPANY_EMAIL, C.COMPANY_MOBILE, C.LOGO, C.ADDED_DATE
                  FROM {$this->companyTable} AS C
                  WHERE C.STATUS = 0" ;
        $stmt = $this->con->query($query);
        return $stmt;
    }


    public function declineCompanyRequest(){
        $stmt = '';
        $query = "DELETE FROM {$this->companyTable} WHERE COMPANY_ID = {$this->companyId}";
        if ($this->con->query($query)){
            $query = "DELETE FROM {$this->usersTable} WHERE COMPANY_ID = {$this->companyId}";
            $stmt = $this->con->query($query);
        }

        return $stmt;
    }


    public function updateCompanyRequest(){
        $query = "UPDATE {$this->companyTable} SET STATUS = {$this->status} WHERE COMPANY_ID = {$this->companyId}";
        $stmt = $this->con->query($query);

        return $stmt;
    }


    public function permissions(){
        $query = "SELECT PERMISSION_ID, PERMISSION_NAME FROM {$this->permissionTable}";
        $result = $this->con->query($query);

        return $result;
    }


    public function givePermissions($permissions){
        $query = "";
        foreach ($permissions as $permission){
            $query .= "INSERT INTO ". $this->rolePermissions ."(ROLE_ID, PERMISSION_ID, DATE_MAPPED) VALUES({$this->roleId},{$permission}, NOW());";
        }

        if($this->con->multi_query($query)){
            return true;
        }

        return false;
    }



}
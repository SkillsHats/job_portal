<?php

class Permissions {

    private $con;

    private $tableName       = "TOTAL_PERMISSIONS";
    private $permissionTable = "PERMISSIONS";
    private $rolePermissions = "ROLES_PERMISSIONS_MAPPING";
    private $userPermissions = "USER_PERMISSIONS_MAPPING";

    public static $viewUserPermissionId         = 1;
    public static $userCreatePermissionId       = 2;
    public static $editUserPermissionId         = 3;
    public static $deleteUserPermissionId       = 4;
    public static $viewCoursePermissionId       = 13;
    public static $addCoursePermissionId        = 14;
    public static $editCoursePermissionId       = 15;
    public static $deleteCoursePermissionId     = 16;
    public static $viewJobPermissionId          = 17;
    public static $addJobPermissionId           = 18;
    public static $editJobPermissionId          = 19;
    public static $deleteJobPermissionId        = 20;
    public static $viewInternshipPermissionId   = 21;
    public static $addInternshipPermissionId    = 22;
    public static $editInternshipPermissionId   = 23;
    public static $deleteInternshipPermissionId = 24;
    public static $viewWorkshopPermissionId     = 25;
    public static $addWorkshopPermissionId      = 26;
    public static $editWorkshopPermissionId     = 27;
    public static $deleteWorkshopPermissionId   = 28;
    public static $viewTestPermissionId         = 29;
    public static $createTestPermissionId       = 30;
    public static $editTestPermissionId         = 31;
    public static $deleteTestPermissionId       = 32;

    public $planId;
    public $roleId;
    public $userId;
    public $companyId;


    // Constructor to get connection of database
    public function __construct($con){
        $this->con = $con;
    }


    // Fetch Total permissions to create user
    public function totalCreateUsers(){
        $userCreatePermissionId = Permissions::$userCreatePermissionId;
        $query = "SELECT TOTAL_PERMISSION AS TOTAL 
                  FROM {$this->tableName}
                  WHERE PLAN_ID = {$this->planId} AND PERMISSION_ID = {$userCreatePermissionId}";
        $stmt = $this->con->query($query);

        return $stmt;
    }


    // Fetch Total permissions to create test
    public function totalCreatePermission($permissionId){
        $query = "SELECT TOTAL_PERMISSION AS TOTAL 
                  FROM {$this->tableName}
                  WHERE PLAN_ID = {$this->planId} AND PERMISSION_ID = {$permissionId}";
        $total = $this->execute($query);

        return $total;
    }


    //Fetch Companies permissions
    public function permissions(){
        $query = "SELECT P.PERMISSION_ID, P.PERMISSION_NAME 
                  FROM {$this->permissionTable} AS P
                  LEFT JOIN {$this->rolePermissions} AS RP
                  ON P.PERMISSION_ID = RP.PERMISSION_ID
                  WHERE RP.ROLE_ID = {$this->roleId} ";
        $result = $this->con->query($query);

        return $result;
    }


    // Check user have permission to create course or not
    public function checkUserPermission($permissionId){
        $query = "SELECT PERMISSION_ID FROM {$this->userPermissions} WHERE USER_ID = {$this->userId} AND PERMISSION_ID = {$permissionId} AND COMPANY_ID = {$this->companyId}";
        $stmt = $this->con->query($query);

        if ($stmt->num_rows > 0){
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
<?php

class PortalUser {

    private $usersTable = "users";
    private $con;

    public $userId;
    public $name, $email, $username, $phone;
    
    public function __construct($con){
        $this->con = $con;
    }


    // Fetch Parent of user
    public function userParent(){
        $query = "SELECT PARENT_ID AS PARENT FROM {$this->usersTable} WHERE UID = {$this->userId}";
        $stmt = $this->con->query($query);

        return $stmt;
    }


    public function update(){
        $query = "UPDATE {$this->usersTable} SET USERNAME = ?, AGENT_NAME = ?, EMAIL = ?, MOBILE = ? WHERE UID = ?";

        $stmt = $this->con->prepare($query);

        // Sanitize Data
        $this->userId    = htmlspecialchars(strip_tags($this->userId));
        $this->name      = htmlspecialchars(strip_tags($this->name));
        $this->username  = htmlspecialchars(strip_tags($this->username));
        //$this->image     = str_replace("../../","",$this->image);
        $this->email     = htmlspecialchars(strip_tags($this->email));
        $this->phone     = htmlspecialchars(strip_tags($this->phone));

        // Bind Data
        $stmt->bind_param("ssssi", $this->username, $this->name, $this->email, $this->phone, $this->userId);

        if($stmt->execute()){
            return true;
        }

        return false;
    }


    // Update One
    public function updateOne(){
        $query = "SELECT UID, USERNAME, AGENT_NAME, EMAIL, MOBILE FROM {$this->usersTable} WHERE UID = {$this->userId}";
        $stmt = $this->con->query($query);

        return $stmt;
    }


    // Delete user
    public function delete(){
        $query = "DELETE FROM " . $this->usersTable . " WHERE UID = ?";
        $stmt = $this->con->prepare($query);

        $this->userId = htmlspecialchars(strip_tags($this->userId));
        $stmt->bind_param('i', $this->userId);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }

}

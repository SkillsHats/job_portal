<?php

/** This file is used for registered users with nerdgeeklab.com */

class Users {

    private $userTable = "tbl_user";
    private $employmentTable = "employment";
    private $con;

    public $id;
    public $value;

    public function __construct($con) {
        $this->con = $con;
    }

    function users(){
        $query = "SELECT * FROM " . $this->userTable ." AS U LEFT JOIN ". $this->employmentTable ." AS E ON U.uid = E.USER_ID ";
        $result = $this->execute($query);
        $users = array();
        if ($result->num_rows > 0){
            while ($row = $result->fetch_object()){
                $users[] = $row;
            }
        }
        return $users;
    }


    function user(){
        $query = "SELECT * FROM ". $this->userTable ." WHERE uid = " . $this->id;
        $result = $this->execute($query);

        return $result;
    }


    function delete(){
        $query = "DELETE FROM ". $this->userTable ." WHERE uid = ? ";
        $stmt = $this->con->prepare($query);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bind_param('i', $this->id);

        // execute query
        if($stmt->execute()){
            return true;
        }

        return false;
    }


    // Count how many jobs created
    function totalUsers(){
        $query = "SELECT count(uid) as total FROM ". $this->userTable;
        $total = $this->count($query);

        return $total;
    }


    function activeUsers(){
        $query = "SELECT count(uid) as total FROM ". $this->userTable ." WHERE status = 1";
        $total = $this->count($query);

        return $total;
    }


    function unactiveUsers(){
        $query = "SELECT count(uid) as total FROM ". $this->userTable ." WHERE status = 0";
        $total = $this->count($query);

        return $total;
    }


    public function filterUserByName($value){
        $query = "SELECT * FROM ". $this->userTable ." WHERE username LIKE '%$value%' ";
        $result = $this->execute($query);
        $output = $this->details($result);
        return $output;
    }


    public function filterUserById($value){
        $query = "SELECT * FROM ". $this->userTable ." WHERE uid = {$value}";
        $result = $this->execute($query);
        $output = $this->details($result);
        return $output;
    }

    public function defaultSearch(){
        $query = "SELECT * FROM {$this->userTable}";
        $result = $this->execute($query);
        $output = $this->details($result);

        return $output;
    }

    function details($result){
        $output = '';
        $count = 1;
        if ($result->num_rows > 0){
            while($user = $result->fetch_object()){
                $output .= ' <tr class="jobs-detail"><td align="center">'. $count .'</td><td><a href="user_profile.php?user='. $user->uid. '" style="color: #2980b9;">'. $user->username .'</a><br><a style="color: #7f8c8d; font-size: 12px;">City : <span>'. $user->city .'</span></a><br><a style="color: #7f8c8d; font-size: 12px;">Qualification : <span>'. $user->qualification .'</span></a></td><td style="padding-top: 12px"><table style="width:100%;" class="table table-responsive md-job-detail"><tbody><tr><td>'. date("d-M-Y h:i:s A", strtotime($user->addeon)) .'</td></tr></tbody></table></td> <td>';
                if ($user->status != 0):
                    $output .= '<a href="update_status.php?type=user&id='.$user->uid .'&value=0" style="color: #27ae60;font-weight: bold;" title="click to disable" id="status-btn"><i class="fa fa-circle"></i> ACTIVE</a>';
                else:
                    $output .= '<a href="update_status.php?type=user&id='. $user->uid .'&value=1" style="color: #c0392b;font-weight: bold;" title="click to live" id="status-btn">UNACTIVE</a></td>';
                endif;
                $output .= '<td><a href="user_profile.php?user='. $user->uid .'" class="btn btn-primary" style="font-size: 12px">View Profile</a></td></tr>';
                $count++;
            }
        } else {
            $output .= '<tr><td width="20%" align="center">User not exists!.</td></tr>';
        }
        return $output;
    }


    function count($query){
        $result = $this->execute($query);
        $row = $result->fetch_object();
        $total = $row->total;

        return $total;
    }

    function status(){
        $query = "SELECT status FROM ". $this->userTable ." WHERE uid = {$this->id}";
        $result = $this->execute($query);
        $row = $result->fetch_object();
        if ($row->status == 1){
            return true;
        }

        return false;
    }

    function execute($query){
        $result = $this->con->query($query);
        return $result;
    }


}
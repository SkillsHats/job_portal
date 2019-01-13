<?php

class SlugGenerator {

    private $con;
    public $tableName;
    public $title;

    public function __construct($con){
        $this->con = $con;
    }

    public function generate(){
        $data = array();

        $flag = false;

        $search = array('Ș', 'Ț', 'ş', 'ţ', 'Ş', 'Ţ', 'ș', 'ț', 'î', 'â', 'ă', 'Î', 'Â', 'Ă', 'ë', 'Ë');
        $replace = array('s', 't', 's', 't', 's', 't', 's', 't', 'i', 'a', 'a', 'i', 'a', 'a', 'e', 'E');
        $str = str_ireplace($search, $replace, strtolower(trim($this->title)));
        $str = preg_replace('/[^\w\d\-\ ]/', '', $str);
        $slug = preg_replace('/[^a-z0-9]+/i', '-', trim(strtolower($str)));
        $query = "SELECT SLUG FROM ". $this->tableName ." WHERE SLUG LIKE '{$slug}%'";
        $result = $this->execute($query);
        if ($result->num_rows > 0){
            while($row = $result->fetch_object()){
                $data[] = $row->SLUG;
            }
            if(in_array($slug, $data)) {
                $count = 0;
                while( in_array( ($slug . '-' . ++$count ), $data) );
                $slug = $slug . '-' . $count;
            }
        }
        return $slug;
    }

    public function execute($query){
        $result = $this->con->query($query);
        return $result;
    }
}

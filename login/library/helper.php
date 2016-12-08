<?php
/**
 * Created by PhpStorm.
 * User: pcsaini
 * Date: 7/12/16
 * Time: 9:47 PM
 */

class helper extends DBconfig{

    public function __construct()
    {
        $connection = new DBconfig();
        $this->connection = $connection->connectToDatabase();
    }

    public function db_select($select, $tbname, $filter=""){
        $query = "SELECT $select FROM $tbname $filter";
        $result = $this->connection->query($query);
        return $result;
    }

    public function check($tbname,$where){
        $query = "SELECT * FROM $tbname $where";
        $result = mysqli_query($this->connection,$query);
        $result = $this->mysqli_result($result);
        return $result;

    }
    public function mysqli_result($res,$row=0,$col=0){
        $numrows = mysqli_num_rows($res);
        if ($numrows && $row <= ($numrows-1) && $row >=0){
            mysqli_data_seek($res,$row);
            $resrow = (is_numeric($col)) ? mysqli_fetch_row($res) : mysqli_fetch_assoc($res);
            if (isset($resrow[$col])){
                return $resrow[$col];
            }
        }
        return false;
    }
}
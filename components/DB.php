<?php

class DB
{
    /**
     * @return mysqli|string
     */
    public static function connect(){
        include_once ROOT."/config/db.php";
        $mysqli = new mysqli(HOST,USER,PASSWORD,DB_NAME);
        if ($mysqli->connect_errno) {
            return "connectionFail";
        }
        return $mysqli;
    }
    /**
     * @param $mysqli
     * @param $query
     * @return bool|mysqli_result|string
     */
    public static function myQuery($mysqli,$query){
        $result = mysqli_query($mysqli,$query);
        if(!$result)return "queryFail";
        return $result;
    }
}
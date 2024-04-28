<?php

class Databaseconnection
{

    public function __construct(){
        $conn = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_DATABASE);
        if(!$conn){
            die("<h1>Connection failed</h1>");
        }
        // echo "Connected Successfully";
        return $this->conn = $conn;
    }


}

?>
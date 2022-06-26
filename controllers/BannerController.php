<?php
class BannerController{
    public function __construct(){
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }
    public function getbanners($id){
        $sql ="SELECT * FROM banners WHERE id ='$id'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        } 
        else{
            return false;
        }  
    }
}
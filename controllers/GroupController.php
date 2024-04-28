<?php
class GroupController{
    public function __construct(){
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }
    public function getGroup($url){
        $sql = "SELECT id FROM category WHERE cat_url = '$url' LIMIT 1";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            $data = $result->fetch_assoc();
            return $data;
        } 
        else{
            return false;
        }
    }
}
?>
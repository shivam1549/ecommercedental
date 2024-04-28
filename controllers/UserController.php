<?php
class UserController
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }

    public function getUserdetail($user_id){
        $sql = "SELECT * FROM orders WHERE customer_id = '$user_id'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        }
        else{
            return false;
        }
    }
}
?>
<?php
class CustomerController
{
    public function __construct()
    {
        $db = new Databaseconnection;
        $this->conn = $db->conn;
    }
    public function index(){
        $sql = "SELECT * FROM user";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }

    public function getCustomerByid($id){
        $sql = "SELECT * FROM user WHERE id ='$id'";
        $result = $this->conn->query($sql);
        if ($result->num_rows == 1) {
            $data = $result->fetch_assoc();
            return $data;
        } else {
            return false;
        }
    }
}
?>
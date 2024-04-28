<?php
class CustomerqueryController
{
    public function __construct()
    {
        $db = new Databaseconnection;
        $this->conn = $db->conn;
    }
    public function index(){
        $sql = "SELECT * FROM `customer_query` ORDER BY ID DESC";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
    
    public function getOrderId($id){
         $sql = "SELECT id FROM orders WHERE order_number = '$id' LIMIT 1";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
         while($row = $result->fetch_assoc()) {
             $data = $row['id'];
            }
           return $data;
        } else {
            return false;
        }
    }
    
    public function getcurrentIdquery($id){
          $sql = "SELECT * FROM `customer_query` WHERE id = '$id' LIMIT 1";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            return $result;
        } else {
            return false;
        }
    }
    
    public function saveQuery($subject,$queryid,$message){
        $sql ="INSERT INTO customer_query_replies (customer_query_id, subject, 	reply) VALUES ('$queryid', '$subject', '$message')";
        $result = $this->conn->query($sql);
        if($result){
            return true;
        }
        else{
            return false;
        }
        
    }
    
    public function updateStatus($queryid, $query_status){
        $sql = "UPDATE customer_query SET status = '$query_status' WHERE id ='$queryid'";
        $result = $this->conn->query($sql);
        if($result){
            return true;
        }
        else{
            return false;
        }
    }
}
?>
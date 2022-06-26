<?php
include_once('../Mails/MailController.php');
class CustomerqueryController
{
    public function __construct()
    {
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }
     public function createQuery($inputdata){
         $data = "'" . implode("','", $inputdata) . "'";
        $sql = "INSERT INTO customer_query (customer_fame, customer_lname, order_id, user_id, email, product_name, message) VALUES ($data)";
        $result = $this->conn->query($sql);
        if($result){
            return true;
        }
        else{
            return false;
        }
    }
    
       public function sendcustomerQuerymail($orderidnumber, $customername, $email, $productname, $query_message){
         $subject =$customername. "Query";
                $sendVerificationmail = new MailController;
                $content ="<p>Dear $customername We have received our email regarding -
                '.$orderidnumber.' and Product Name- '. $productname.'</p><br>
                <p>Your message: '.$query_message.'</p><br>
                <p>We will get back to you soon.</p>
                <p>Thanks For Shopping with dento.</p>
                ";
                $mailsend = $sendVerificationmail->mailsend($content, $email, $subject);
                return true;
    }
    
    public function getquerystatus($orderid){
        $sql = "SELECT status FROM customer_query WHERE order_id = '$orderid' LIMIT 1";
         $result = $this->conn->query($sql);
        if($result){
            foreach($result as $row){
                $status = $row['status'];
            }
            return $status;
        }
        else{
            return false;
        }
    }
}
?>
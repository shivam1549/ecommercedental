<?php
include_once('../Mails/MailController.php');
class CancelorderController
{
    public function __construct()
    {
        $db = new Databaseconnection;
        $this->conn = $db->conn;
    }

    public function ordercancel($orderitem_id, $cancel_status){
        $sql ="UPDATE order_items_status SET item_status = '$cancel_status' WHERE order_item_id ='$orderitem_id'";
        $result = $this->conn->query($sql);
        if($result){
            return true;
        } 
        else{
            return false;
        } 
    }
    
    public function sendCancellationmail($orderidnumber, $customername, $customermail, $customerphone, $productnamec){
         $subject ="Dear".$customername."Your Order Is Cancelled.";
                $sendVerificationmail = new MailController;
                $content ="<p>Dear '.$customername.' You have cancelled order no-
                '.$orderidnumber.' and Product Name- '. $productnamec.'</p><br>
                <p>Thanks For Shopping with dento.</p>
                ";
                $mailsend = $sendVerificationmail->mailsend($content, $customermail, $subject);
                return true;
    }
}
?>
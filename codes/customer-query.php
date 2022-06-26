<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('../config/app.php');
include('../controllers/CustomerqueryController.php');
if(isset($_POST['send_query'])){
      $orderidnumber  = validateInput($db->conn, $_POST['orderidnumber']);
     $email = validateInput($db->conn, $_POST['email']);
     $customername = validateInput($db->conn, $_POST['firstname']) . validateInput($db->conn, $_POST['lastname']);
     $productname =validateInput($db->conn, $_POST['productname']);
     $query_message =validateInput($db->conn, $_POST['query_message']);
     
    $inputData =[
    'firstname' => validateInput($db->conn, $_POST['firstname']),
    'lastname' => validateInput($db->conn, $_POST['lastname']),
     'orderidnumber'  => validateInput($db->conn, $_POST['orderidnumber']),
     'userid' => validateInput($db->conn, $_POST['userid']),
    'email' => validateInput($db->conn, $_POST['email']),
   'productname' => validateInput($db->conn, $_POST['productname']),
    'query_message' =>  validateInput($db->conn, $_POST['query_message']),
    
        ];
    $create_query = new CustomerqueryController;
    $result = $create_query->createQuery($inputData);
    if($result){
        $sendmail =$create_query->sendcustomerQuerymail($orderidnumber, $customername, $email, $productname, $query_message);
        // print_r($sendmail);
        if($sendmail){
        redirect('We have recived our request thanks for contacting us', 'contact-us.php');
        }
        else{
          redirect('Some error has occured', 'contact-us.php'); 
        }
    }
}

?>
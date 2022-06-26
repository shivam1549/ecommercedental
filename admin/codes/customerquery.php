<?php
include('../../config/app.php');
include_once('../../Mails/MailController.php');
include_once('../controllers/CustomerqueryController.php');
if(isset($_POST['query_reply'])){
  $subject =  validateInput($db->conn, $_POST['subject']);
  $message =  validateInput($db->conn, $_POST['message']);
  $queryid =  validateInput($db->conn, $_POST['queryid']);
  $useremail =  validateInput($db->conn, $_POST['useremail']);
 $insertquery =  new CustomerqueryController;
 $result =  $insertquery->saveQuery($subject,$queryid,$message);
 if($result){
      $subject = $subject;
            $sendOrderstsmail = new MailController;
               
                 $content .= '<p>'.$message.'</p>
                 ';   
                $content .='
                <br>
                <p>Thanks For Shopping With Dento.</p>
                ';
$mailsend =  $sendOrderstsmail->mailsend($content, $useremail, $subject);
     redirect("Message Send Succesfully", 'admin/customer-query.php');
 }
 else{
       redirect("Some Error Occured", 'admin/customer-query.php');
 }
}

if(isset($_POST['queryupdate_btn'])){
    // = Query Status Codes definition
   // 1 = Not Resolved
   // 2= Processed
   //3 = Resolved
      $query_status =  validateInput($db->conn, $_POST['query_status']);
      $queryid =  validateInput($db->conn, $_POST['queryid']);
      $updateQuerystatus =  new CustomerqueryController;
      $result = $updateQuerystatus->updateStatus($queryid, $query_status);
      if($result){
           redirect("Updated Successfully", 'admin/customer-query.php');
      }
      else{
          redirect("Some error occured", 'admin/customer-query.php');
      }
}
?>
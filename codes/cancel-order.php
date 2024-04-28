<?php
include('../config/app.php');
include('../controllers/CancelorderController.php');
if(isset($_POST['cancel_btn'])){
    $orderitem_id = validateInput($db->conn, $_POST['orderitem_id']);
    $cancel_status = validateInput($db->conn, $_POST['cancel_status']);
    $orderidnumber = validateInput($db->conn, $_POST['orderidnumber']);
    $customername  = validateInput($db->conn, $_POST['customername']);
    $customermail = validateInput($db->conn, $_POST['customermail']);
    $customerphone = validateInput($db->conn, $_POST['customerphone']);
    $productnamec =  validateInput($db->conn, $_POST['productnamec']);
    $cancelorder = new CancelorderController;
    $result = $cancelorder->ordercancel($orderitem_id, $cancel_status);
    if($result){
        $sendmail =$cancelorder->sendCancellationmail($orderidnumber, $customername, $customermail, $customerphone, $productnamec);
        if($sendmail){
        redirect('You Order has been cancelled', 'my-account');
        }
        else{
           redirect('Some error has occured', 'my-account'); 
        }
    }
}

?>
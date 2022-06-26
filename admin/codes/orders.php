<?php
include('../../config/app.php');
include_once('../controllers/CategoryController.php');
include_once('../controllers/OrderController.php');
include_once('../../Mails/MailController.php');
if (isset($_POST['order_item_status'])) {
    $order_item_id = validateInput($db->conn, $_POST['order_item_id']);
    $order_status = validateInput($db->conn, $_POST['order_status']);
    $product_name = validateInput($db->conn, $_POST['product_name']);
    $customer_mail = validateInput($db->conn, $_POST['customer_mail']);
    $orderId =  validateInput($db->conn, $_POST['orderId']);
    $cancel_reason = $_POST['cancel_reason'];
   
    $order_items = new OrderController;
    
    $result = $order_items->update_order_item_status($order_item_id ,$order_status);
    //    echo $result;
    if ($result) {
            $subject ="Order Status";
            $sendOrderstsmail = new MailController;
                $content .= '<p>Your Order '.$product_name.' has been '.$order_status.'.';
                if(!empty($cancel_reason)){
                 $content .= '
                 and the reason is '.$cancel_reason.'</p>
                 ';   
                }
                $content .='
                <br>
                <p>Thanks For Shopping With Dento.</p>
                ';
$mailsend =  $sendOrderstsmail->mailsend($content, $customer_mail, $subject);
        // if($order_status == 'Completed'){
        // $complete_order =  $order_items->orderComplete($orderId);
        // if($complete_order){
        //       redirect('Updated SuccessFully', 'admin/orders.php');
        // }
        // else{
        //      redirect('Some Error Occured', 'admin/orders.php');
        // }
        // }
        redirect('Updated SuccessFully', 'admin/orders.php');
    } else {
        redirect('Some Error Occured', 'admin/orders.php');
    }
}

if (isset($_POST['updateOrderstatus'])) {
    $orderedstatus = validateInput($db->conn, $_POST['order_status']);
    $orderedid = validateInput($db->conn, $_POST['orderedid']);
    $order_items = new OrderController;
    $complete_order =  $order_items->orderComplete($orderedid, $orderedstatus);
//  echo $complete_order;
        if($complete_order){
              redirect('Updated SuccessFully', 'admin/orders.php');
        }
        else{
             redirect('Some Error Occured', 'admin/orders.php');
        }
    
}
?>
<?php

include('../config/app.php');
include('../controllers/AuthenticationController.php');
$authenticated = new AuthenticationController;
$authenticated->admin();
include_once('controllers/CategoryController.php');
include_once('controllers/OrderController.php');
include_once('controllers/ProductController.php');
include('controllers/AdminController.php');

if (isset($_POST["create_pdf"])) {
    require_once('assets/tcpdf_min/tcpdf.php');
    $obj_pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
    $obj_pdf->SetCreator(PDF_CREATOR);
    $obj_pdf->SetTitle("Download Invoice Dento");
    $obj_pdf->SetHeaderData('', '', PDF_HEADER_TITLE, PDF_HEADER_STRING);
    $obj_pdf->setHeaderFont(array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
    $obj_pdf->setFooterFont(array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));
    $obj_pdf->SetDefaultMonospacedFont('helvetica');
    $obj_pdf->SetFooterMargin(PDF_MARGIN_FOOTER);
    $obj_pdf->SetMargins(PDF_MARGIN_LEFT, '5', PDF_MARGIN_RIGHT);
    $obj_pdf->setPrintHeader(false);
    $obj_pdf->setPrintFooter(false);
    $obj_pdf->SetAutoPageBreak(TRUE, 10);
    $obj_pdf->SetFont('helvetica', '', 12);
    $obj_pdf->AddPage();
    $content = '';
      $content .= '  
      <div style="text-align:right;">
        <b>Sender:</b> Dento
    </div>
    <div style="text-align: left;border-top:1px solid #000;">
        <div style="font-size: 24px;color: #666;">INVOICE</div>
    </div>';
   
     if (isset($_GET['id'])) {
                        $orderid = $_GET['id'];
                    }
                    $getproduct = new ProductController;
                    $orders = new OrderController;
                   
                    $result = $orders->editorder($orderid);
                    if($result){
            $content .= '
            <table style="line-height: 1.5;">
    <tr><td><b>Order No:</b> # ' . $result['order_number'] . '
        </td>
        <td style="text-align:right;"><b>Receiver: </b>' . $result['ship_firstname'].' '.$result['ship_lastname'] . '</td>
    </tr>
    <tr>
        <td><b>Date:</b>' .$result['ordered_on']. ' </td>
        <td style="text-align:right;">' . $result['ship_phone'] . '</td>
    </tr>
    <tr>
        <td><b>Payment Status:</b> ' . $result['payment_info'] . '
        </td>
        <td style="text-align:right;">' . $result['ship_address1'] . '' . ' ' . $result['ship_address2'] . ' '.$result['ship_city'].'</td>
    </tr>
<tr>
<td></td>
<td style="text-align:right;">' . $result['ship_zone'] . ' ' . ' ' . $result['ship_country'] . ' ' . ' <br> ' .  $result['ship_zip'] . ' </td>
</tr>
</table>
            ';
        }
  
  
    $content .= '
      <h3 align="center">Thanks For Shopping With Dento</h3><br /><br />  
      <div style="border-bottom:1px solid #000;">
      <table class="" style="line-height: 2;">
     
      <tr style="font-weight: bold;border:1px solid #cccccc;background-color:#f2f2f2;">
      <td style = "text-align:center;border:1px solid #cccccc;">Sr.No</td>
      <td style="border:1px solid #cccccc;width:120px;text-align:left;" >Product Name</td>
      <td style = "text-align:center;border:1px solid #cccccc;">Quantity</td>
      <td style = "text-align:center;border:1px solid #cccccc;">Price(Rs)</td>
      <td style = "text-align:center;border:1px solid #cccccc;">Subtotal</td>
     
        </tr> 
      
      
      ';
      
    if (isset($_GET['id'])) {
                        $orderid = $_GET['id'];
                    }
    $getproduct = new ProductController;
                    $orders = new OrderController;
                   
                    $result = $orders->editorder($orderid);
                    if($result){
                      $grand_total =  $result['total'];
                    }
      if (isset($_GET['id'])) {
                        $orderid = $orderid = $_GET['id'];
                    }
                    $getproduct = new ProductController;
                    $orders = new OrderController;
                  
                    $getorder_items = $orders->getorderItems($orderid);
                        if ($getorder_items) {
                            // print_r($getorder_items);
                            $count ='1';

                                                        foreach ($getorder_items as $orderitem) {
                             $getorderitemstatus = $orders->getOrdereditemstatus($orderitem['id']);
                            
                        
                                                            $prodid = validateInput($db->conn, $orderitem['product_id']);
                                                            $getproductdata = $getproduct->getProductId($prodid);
                                                            if ($getproductdata)
                                                                foreach ($getproductdata as $productdata) {
                                                                    $product_name = $productdata['name'];
                                                                    
                                                                    $product_price = $productdata['price'];
                                                                }
       $content .= '
        <tr>
        <td style = "text-align:right; border:1px solid #cccccc;">' . $count . '</td>
        <td style = "text-align:right; border:1px solid #cccccc;">' .  $product_name . '</td>
        <td style = "text-align:right; border:1px solid #cccccc;">' . $orderitem['quantity'] . '</td>
        <td style = "text-align:right; border:1px solid #cccccc;">' . $product_price . '</td>
         <td style = "text-align:right; border:1px solid #cccccc;">Rs.' . $orderitem['quantity']*$product_price . '</td>
        </tr>
        ';
            $count++;
                                                        }
        
       $content .='
        <tr style = "font-weight: bold;">
    <td></td><td></td> <td></td> 
    <td style = "text-align:right;">Total (Rs.)</td>
    <td style = "text-align:right;">'.number_format($result['total'], 2).'</td>
</tr>
        ';
                        }
    $content .='
   
      </table>
      </div>
      <p><u>Thanks For Shopping With Dento</u><br/>

</p>
      ';
    $obj_pdf->writeHTML($content);
    $obj_pdf->Output('Invoice.pdf', 'I');
}
include('inc/header.php');
include('inc/sidebar.php');
?>
<style>
    .form-group input[type=file] {
        position: unset;
        opacity: 1;
    }

    .form-check input[type="checkbox"],
    .radio input[type="radio"] {
        visibility: visible;
        opacity: 1;
    }

    .order_list_xs {
        list-style: none;
        display: flex;
    }
    .order_list_xs li {
        margin: 0 0px 0 10px;
        padding: 0 5px 0 0;
        border-right: 1px solid #d5d5d5;
    }
    .cancel_box{
        display:none;
    }
</style>
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <?php
                    if (isset($_GET['id'])) {
                        $orderid = validateInput($db->conn, $_GET['id']);
                    }
                    $getproduct = new ProductController;
                    $orders = new OrderController;
                   
                    $result = $orders->editorder($orderid);
                    $getorder_items = $orders->getorderItems($orderid);
                    if ($result) {
                        $ordernumber = $result['order_number'];
                       $orderstatus = $result['status'];
                        $orderdate = $result['ordered_on'];
                        $pay_info = $result['payment_info'];
                        $ship_firstname = $result['ship_firstname'];
                        $ship_lastname = $result['ship_lastname'];
                        $ship_email = $result['ship_email'];
                        $ship_phone = $result['ship_phone'];
                        $ship_address1 = $result['ship_address1'];
                        $ship_address2 = $result['ship_address2'];
                        $ship_city = $result['ship_city'];
                        $ship_zone = $result['ship_zone'];
                        $ship_country = $result['ship_country'];
                        $ship_zip = $result['ship_zip'];
                        $grandtotal_order = $result['total'];
                    }

                    ?>
                    
                  
                    <div class="card-header">
                        <h4 class="card-title"> Order Number #<?php echo $ordernumber ?></h4>
                          <form  method="POST">
                      <input value="Download Invoice" class="btn btn-info" type="submit" name="create_pdf">
                  </form>
               
                        <hr>
                        <ul class="order_list_xs">
                            <li><?php echo $orderdate ?></li>
                            <li><strong>Payment:</strong><?php echo $pay_info ?></li>
                              <li><strong>Order Status:</strong><?php echo $orderstatus; ?></li>
                            <li>&#x20B9; <?php echo $grandtotal_order ?></li>
                        </ul>
                        <hr>
                        <?php include('../message.php'); ?>
                        <!-- Button trigger modal -->
                    </div>

                    <div class="card-body">
                        <div class="row">
                      
                            <div class="col-md-12">

                                <div class="row">
                                    <div class="col-md-12">
                                        <h3>Items</h3>
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <th>Image</th>
                                                    <th>Name</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                    <th>Action</th>
                                                    <th>Total</th>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if ($getorder_items) {

                                                        foreach ($getorder_items as $orderitem) {
                             $getorderitemstatus = $orders->getOrdereditemstatus($orderitem['id']);
                            
                            //  print_r($getorderitemstatus);
                                                            $prodid = validateInput($db->conn, $orderitem['product_id']);
                                                            $getproductdata = $getproduct->getProductId($prodid);
                                                            if ($getproductdata)
                                                                foreach ($getproductdata as $productdata) {
                                                                    $product_name = $productdata['name'];
                                                                    $product_image = $productdata['image'];
                                                                    $product_price = $productdata['price'];
                                                                }
                                                    ?>
                                                            <tr>
                                                                <td><img style="width:70px;" src="assets/product-images/<?php echo $product_image ?>" alt=""></td>
                                                                <td>
                                                    <span class="badge badge-secondary"><?php  echo $getorderitemstatus['item_status'];?></span>
                                                                    <p><?php echo $product_name; ?></p>
                                                                    <strong>SKU - <?php echo $orderitem['sku_number'] ?></strong>
                                                                </td>
                                                                <td><?php echo $orderitem['quantity'] ?></td>
                                                                <td>&#x20B9; <?php echo $product_price ?></td>
                                                                <td>
                                                                   
                                                <form action="codes/orders.php" class="status_order_form" method="POST">
                                      <?php
                                      if (isset($_GET['id'])) {
                                     $orderid = validateInput($db->conn, $_GET['id']);
                                    }
                                      ?>
                                      <input type="hidden" name="orderId" value="<?php echo $orderid?>">
                                        <input type="hidden" value="<?php echo $ship_email;?>" name="customer_mail">
                                        <input type="hidden" name="product_name" value="<?php echo $product_name; ?>">
                                                                        <input type="hidden" name="order_item_id" value="<?php echo $orderitem['id']?>">
                                                                        <select name="order_status" class="form-control  cancel_status_box" id="">
                                                                            <option value="Order placed">Order placed</option>
                                                                            <option value="Cancelled">Cancelled</option>
                                                                            <option value="On hold">On hold</option>
                                                                            <option value="Shipped">Shipped</option>
                                                                            <option value="Pending">Pending</option>
                                                                            <option value="Delivered">Delivered</option>
                                                                            <option value="Refund">Refund</option>
                                                                        </select>
                                        <textarea placeholder="Cancel Reason" name="cancel_reason" class="form-control  cancel_box"></textarea>                                
                                                                        <button class="btn btn-primary mt-2" type="submit" name="order_item_status">Update</button>
                                                                    </form>
                                                                </td>
                                                                <td>&#x20B9; <?php echo $orderitem['total'] * $orderitem['quantity']; ?></td>

                                                            </tr>
                                                        <?php
                                                        }

                                                        ?>
                                                        <tr>
                                                            <td colspan="5">
                                                                Tax : <span>&#x20B9; 0</span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td colspan="5">
                                                                Total: <strong>&#x20B9; <?php echo $grandtotal_order ?></strong>
                                                            </td>
                                                        </tr>

                                                    <?php
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>


                            </div>

                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Transactions </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table">
                                    <thead>
                                        <th>Payment Info</th>
                                        <th>Date</th>
                                        <th>Total</th>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $pay_info ?></td>
                                            <td><?php echo $orderdate; ?></td>
                                            <td>&#x20B9; <?php echo $grandtotal_order ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>


                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Customer </h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <p><?php echo $ship_firstname . $ship_lastname ?></p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Contact Person </h4>
                    </div>
                    <div class="card-body">
                        <p><?php echo $ship_firstname . $ship_lastname ?></p>
                        <p><a href="mailto:<?php echo $ship_email ?>"><?php echo $ship_email ?></a></p>
                        <p><a href="tel:<?php echo $ship_phone; ?>"><?php echo $ship_phone; ?></a></p>

                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title"> Shipping Address </h4>
                    </div>
                    <div class="card-body">
                        <p><?php echo $ship_address1 . ' ' .  $ship_address2 . ' ' .  $ship_city  . ' ' . $ship_zone  . ', ' . $ship_country  . ', ' .  $ship_zip ?></p>
                    </div>
                </div>
            </div>
        </div>
  
</div>

<script>
       $(document).on('change', '.cancel_status_box', function() {
            var orderstatus = $(this).val();
            // alert(orderstatus)
            if(orderstatus == 'Cancelled'){
            $(this).closest('.status_order_form').find('.cancel_box').show();
            }
            else{
               $(this).closest('.status_order_form').find('.cancel_box').hide();   
            }
            });
            
              $(document).on('change', '.cancel_status_box', function() {
            var orderstatus = $(this).val();
            // alert(orderstatus)
            if(orderstatus == 'Delivered'){
           let text = "Are You sure want to complete this order? You have received the payment?";
              if (confirm(text) == true) {
                return true;
              } else {
               return false;
              }
            }
            });
</script>



<?php
include('inc/footer.php');
?>
<?php
include('config/app.php');
include('controllers/UserordersController.php');
include('controllers/CategoryController.php');
include('controllers/ProductController.php');
$title = "View Orders Details";
include('controllers/AuthenticationController.php');
$authenticated = new AuthenticationController;
$data = $authenticated->authDetail();

if (isset($_POST["create_pdf"])) {
  require_once('admin/assets/tcpdf_min/tcpdf.php');
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
  $obj_pdf->SetFont('helvetica', '', 11);
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
    $id = validateInput($db->conn, $_GET['id']);
  }
  $getorders = new UserordersController;
  $getOrderid = $getorders->getOrderid($id);
  if ($getOrderid) {
    $orderId = $getOrderid['order_id'];
    $getorderdetails = $getorders->orderDetails($orderId);
    if ($getorderdetails) {
      $content .= '
            <table style="line-height: 1.5;">
    <tr><td><b>Order No:</b> # ' . $getorderdetails['order_number'] . '
        </td>
        <td style="text-align:right;"><b>Receiver: </b>' . $getorderdetails['ship_firstname'] . ' ' . $getorderdetails['ship_lastname'] . '</td>
    </tr>
    <tr>
        <td><b>Date:</b>' . $getorderdetails['ordered_on'] . ' </td>
        <td style="text-align:right;">' . $getorderdetails['ship_phone'] . '</td>
    </tr>
    <tr>
        <td><b>Payment Status:</b> ' . $getorderdetails['payment_info'] . '
        </td>
        <td style="text-align:right;">' . $getorderdetails['ship_address1'] . '' . ' ' . $getorderdetails['ship_address2'] . ' ' . $getorderdetails['ship_city'] . '</td>
    </tr>
<tr>
<td></td>
<td style="text-align:right;">' . $getorderdetails['ship_zone'] . ' ' . ' ' . $getorderdetails['ship_country'] . ' ' . ' <br> ' .  $getorderdetails['ship_zip'] . ' </td>
</tr>
</table>';
    }
  }
  $content .= '
      <h3 align="center">Thanks For Shopping With Dento</h3><br /><br />  
      <div style="border-bottom:1px solid #000;">
      <table class="" style="line-height: 2;">
      <tr style="font-weight: bold;border:1px solid #cccccc;background-color:#f2f2f2;">
      <td style = "text-align:center;width:40px;border:1px solid #cccccc;">Sr.No</td>
      <td style="border:1px solid #cccccc;width:160px;" >Product Name</td>
      <td style = "text-align:center;border:1px solid #cccccc;">Quantity</td>
      <td style = "text-align:center;border:1px solid #cccccc;">Price(Rs)</td>
      <td style = "text-align:center;border:1px solid #cccccc;">Subtotal</td>
        </tr> 
      ';
  if (isset($_GET['id'])) {
    $orderedid = validateInput($db->conn, $_GET['id']);
  }
  $getorders = new UserordersController;
  $getOrderid = $getorders->getOrderid($orderedid);
  if ($getOrderid) {
    $orderId = $getOrderid['order_id'];
  }
  $getOrderitems = $getorders->get_ordered_items($orderId);
  if ($getOrderitems) {
    $count = 1;
    foreach ($getOrderitems as $order_items) {
      $result_total = $order_items['total'];
      $getProdname = new ProductController;
      $prodDetails = $getProdname->getProductnamebyId($order_items['product_id']);
      foreach ($prodDetails as $prods) {
        $productname = $prods['name'];
        $productimage =  $prods['image'];
      }
      $content .= '
        <tr>
        <td style = "text-align:right; border:1px solid #cccccc;">' . $count . '</td>
        <td style = "text-align:right; border:1px solid #cccccc;">' .  $productname . '</td>
        <td style = "text-align:right; border:1px solid #cccccc;">' . $order_items['quantity'] . '</td>
        <td style = "text-align:right; border:1px solid #cccccc;">' . $order_items['total'] . '</td>
         <td style = "text-align:right; border:1px solid #cccccc;">Rs.' . $order_items['total'] . '</td>
        </tr>
        ';
      $count++;
    }
    $content .= '
        <tr style = "font-weight: bold;">
    <td></td><td></td> <td></td> 
    <td style = "text-align:right;">Total (Rs.)</td>
    <td style = "text-align:right;">Rs  ' . $result_total . '</td>
</tr>
        ';
  }
  $content .= '
      </table>
      </div>
      <p><u>Thanks For Shopping With Dento</u><br/>
</p>';
  $obj_pdf->writeHTML($content);
  $obj_pdf->Output('Invoice.pdf', 'I');
}
include('inc/header.php');
include('controllers/CustomerqueryController.php');
?>
<div class="ltn__utilize-overlay"></div>

<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image " data-bs-bg="img/bg/14.jpg">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="ltn__breadcrumb-inner">
          <h1 class="page-title">Order Details</h1>
          <div class="ltn__breadcrumb-list">
            <ul>
              <li><a href="/"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
              <li>View Order Details</li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- BREADCRUMB AREA END -->

<!-- SHOPING CART AREA START -->
<div class="liton__shoping-cart-area mb-120">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="shoping-cart-inner">
          <div class="shoping-cart-table table-responsive">
            <?php
            if (isset($_GET['id'])) {
              $orderedid = validateInput($db->conn, $_GET['id']);
            }

            $getorders = new UserordersController;
            $getOrderid = $getorders->getOrderid($orderedid);
            if ($getOrderid) {
              $orderId = $getOrderid['order_id'];
              $getorderdetails = $getorders->orderDetails($orderId);
              if ($getorderdetails) {
                $getOrdernumber =   $getorderdetails['order_number'];
                $getCustomername = $getorderdetails['ship_firstname'] . ' ' . $getorderdetails['ship_lastname'];
                $getcustomerphone = $getorderdetails['ship_phone'];
                $getcustomermail = $getorderdetails['ship_email'];
              }
            }


            $getorders = new UserordersController;
            $getOrderid = $getorders->getOrderid($orderedid);
            if ($getOrderid) {
              $orderId = $getOrderid['order_id'];
            }
            $getOrderitems = $getorders->get_ordered_items($orderId);
            if ($getOrderitems) {
              foreach ($getOrderitems as $order_items) {
                $getProdname = new ProductController;
                $prodDetails = $getProdname->getProductnamebyId($order_items['product_id']);
                foreach ($prodDetails as $prods) {
                  $productname = $prods['name'];
                  $productimage =  $prods['image'];
                }

            ?>
                <div class="card">
                  <div class="card-header">
                    <h4><?php echo $productname; ?> x <?php echo $order_items['quantity'] ?></h4>
                    <strong><?php echo $order_items['item_status'] ?></strong>

                  </div>
                  <div class="card-body">
                    <img width="100px" src="<?php echo SITE_URL ?>admin/assets/product-images/<?php echo $productimage; ?>" alt="">
                    <span>Total Price: &#8377;<?php echo $order_items['total'] ?></span>
                  </div>
                  <?php
                  if ($order_items['item_status'] != 'Completed') {
                  ?>
                    <div class="card-footer">
                      <form class="" action="codes/cancel-order.php" method="POST">
                        <div class="row">
                          <input type="hidden" value="<?php echo  $productname; ?>" name="productnamec">
                          <input type="hidden" name="orderidnumber" value="<?php echo $getOrdernumber ?>">
                          <input type="hidden" name="customername" value="<?php echo $getCustomername ?>">
                          <input type="hidden" name="customermail" value="<?php echo $getcustomermail; ?>">
                          <input type="hidden" name="customerphone" value="<?php echo $getcustomerphone ?>">
                          <div class="col-md-12">
                            <input type="hidden" name="orderitem_id" value="<?php echo $order_items['id'] ?>">
                            <select name="cancel_status" id="">
                              <option value="Cancelled By User">Cancel</option>
                            </select>
                          </div>

                          <div class="col-md-12 mt-2">
                            <button class="btn btn-info" name="cancel_btn" type="submit">Cancel Order</button>
                          </div>
                        </div>
                      </form>
                    </div>
                  <?php

                  }
                  ?>
                </div>

            <?php
              }
            }

            ?>

            <?php
            if (isset($_GET['id'])) {
              $id = validateInput($db->conn, $_GET['id']);
            }
            $getorders = new UserordersController;
            $getOrderid = $getorders->getOrderid($id);
            if ($getOrderid) {
              $orderId = $getOrderid['order_id'];
              $getorderdetails = $getorders->orderDetails($orderId);
              if ($getorderdetails) {



            ?>
                <div class="card">
                  <div class="card-header">
                    <h4>OrderId #<?php echo $getorderdetails['order_number'] ?></h4>

                    <?php
                    $getQuerystatus = new CustomerqueryController;
                    $querystat =   $getQuerystatus->getquerystatus($getorderdetails['order_number']);
                    if (isset($querystat)) {
                      if ($querystat == '1') {
                    ?><span>Your issue</span>
                        <strong style="color:red" class="">Not resolved</strong>
                      <?php
                      } elseif ($querystat == '2') {
                      ?>
                        <span>Your issue</span>
                        <strong style="color:#ffc200;" class="">Processed</strong>
                      <?php
                      } else {
                      ?>
                        <span>Your issue</span>
                        <strong style="color:green" class="">Resolved</strong>
                    <?php
                      }
                    }
                    if ($getorderdetails['status'] == 'Delivered') {
                    ?>
                    <form method="POST">
                      <input value="Download Invoice" class="btn btn-info" type="submit" name="create_pdf">
                    </form>
                    <?php
                    }
                    ?>

                  </div>
                  <div class="card-body">
                    <h4>Shipping Address</h4>
                    <strong><?php echo $getorderdetails['ship_firstname'] . ' ' . $getorderdetails['ship_lastname'] ?></strong>
                    <p><?php echo $getorderdetails['ship_phone']  ?></p>
                    <p><?php echo $getorderdetails['ship_address1']  . ' ' . $getorderdetails['ship_address2']
                          . ' ' .  $getorderdetails['ship_city'] . ' ' . $getorderdetails['ship_zone']  . ' ' . $getorderdetails['ship_country']
                          . ' ' .  $getorderdetails['ship_zip']
                        ?></p>
                  </div>
                </div>

            <?php

              }
            }
            ?>


          </div>

        </div>
      </div>
    </div>
  </div>
</div>
<!-- SHOPING CART AREA END -->

<!-- CALL TO ACTION START (call-to-action-6) -->
<div class="ltn__call-to-action-area call-to-action-6 before-bg-bottom" data-bs-bg="img/1.jpg--">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="call-to-action-inner call-to-action-inner-6 ltn__secondary-bg position-relative text-center---">
          <div class="coll-to-info text-color-white">
            <h1>Buy medical disposable face mask <br> to protect your loved ones</h1>
          </div>
          <div class="btn-wrapper">
            <a class="btn btn-effect-3 btn-white" href="shop.html">Explore Products <i class="icon-next"></i></a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include('inc/footer.php');
?>
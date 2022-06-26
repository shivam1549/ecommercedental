<?php
$title = "Contact Us";
include('config/app.php');
include('controllers/AuthenticationController.php');
include('controllers/UserordersController.php');
include('controllers/CategoryController.php');
include('controllers/ProductController.php');
$authenticated = new AuthenticationController;
$data = $authenticated->authDetail();
include('inc/header.php');
?>

<style>
    .contact-user-form{
        display:none;
    }
    .view-form-link{
        cursor:pointer;
    }
</style>

<div class="ltn__utilize-overlay"></div>

<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image " data-bs-bg="img/bg/14.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner">
                    <h1 class="page-title">My Account</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="/"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                            <li>Contact Us</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMB AREA END -->

<!-- WISHLIST AREA START -->
<div class="liton__wishlist-area pb-70">
    <?php include('message.php')?>
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- PRODUCT TAB AREA START -->
                <div class="ltn__product-tab-area">
                    <div class="container">
                        <div class="row">
                         
                            <div class="col-lg-12">
                             
                                
                                            <div class="table-responsive">
                                                <table class="table">
                                                    <thead>
                                                        <tr>
                                                            <th>Order</th>
                                                            <th>Name</th>
                                                            <th>Date</th>
                                                            <th>Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $getProductdetails = new ProductController;
                                                        $getorders = new UserordersController;
                                                        $getallorders = $getorders->get_orders($data['id']);
                                                        if ($getallorders) {
                                                            // print_r($getallorders);
                                                        $count =1;
                                                        foreach($getallorders as $orders){
                                                            $getorder_number = $orders['order_number'];
                                                            
                                                            $getOrderitems = $getorders->get_ordered_items($orders['id']);
                                                            if($getOrderitems){
                                                                foreach($getOrderitems as $order_items){
                                                                  $productdetails = $getProductdetails->getProductnamebyId($order_items['product_id']);
                                                                  if($productdetails){
                                                                      foreach($productdetails as $prod_detials){
                                                                          $prodname = $prod_detials['name'];
                                                                          $prodimage = $prod_detials['image'];

                                                                      }
                                                                  }
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $count;?></td>
                                                            <td>
                                                            <span><img style="width:60px;" src="<?php echo SITE_URL?>admin/assets/product-images/<?php echo $prodimage;?>" alt=" "></span>    
                                                            <?php echo $prodname; ?></td>
                                                            <?php
                                                                $date = strtotime($orders['ordered_on']);
                                                            ?>
                                                            <td><?php echo date('d-M-Y', $date);?></td>
                                                            <td><?php echo $order_items['item_status'];?></td>
                                                            <td>
                                                       
                       
                                         <div class="ltn__form-box">
                                             <a class="view-form-link">Contact</a>
                                       <form class="contact-user-form" action="codes/customer-query.php" method="POST">
                                           
                                           
                                                    <div class="row mb-50">
                                                        <div class="col-md-6">
                                                            <label>First name:</label>
                                                            <input type="text" name="firstname"  value="<?php echo $data['user_name']?>">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Last name:</label>
                                                            <input type="text" name="lastname" value="<?php echo $data['last_name']?>">
                                                        </div>

                                                        <div class="col-md-6">
                                                            <label>Email:</label>
                                                            <input type="email" name="email"  value="<?php echo $data['email']?>">
                                                            <input type="hidden" name="userid"  value="<?php echo $data['id']?>">
                                                        </div>
                                                          <div class="col-md-6">
                                                             <label>Order Number</label> 
                                                             <input disabled type="text" value="<?php echo $getorder_number;?>">
                                                               <input type="hidden" name="orderidnumber" value="<?php echo $getorder_number;?>">
                                                              </div>
                                                              
                                                                <div class="col-md-12">
                                                             <label>Product Name</label> 
                                                             <input disabled type="text" value="<?php echo $prodname;?>">
                                                                             <input name="productname" type="hidden" value="<?php echo $prodname;?>">
                                                              </div>
                                                              
                                                                   <div class="col-md-12">
                                                             <label>Type Your Query</label> 
                                                     <textarea  name="query_message"></textarea>
                                                              </div>
                                                        
                                                        </div>
                                                         <div class="btn-wrapper">
                                                        <button type="submit" name="send_query" class="btn theme-btn-1 btn-effect-1 text-uppercase">Send</button>
                                                    </div>
                                                        </form>
                                                        </div>
                              
                                                            </td>
                                                        </tr>
                                                        <?php
                                                                }
                                                            }
                                                        $count++;
                                                        }
                                                    }
                                                        ?>

                                                    </tbody>
                                                </table>
                                         
                                      
                                  
                                          
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- PRODUCT TAB AREA END -->
            </div>
        </div>
    </div>
</div>
<!-- WISHLIST AREA START -->

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


<script>
    var acc = document.getElementsByClassName("view-form-link");
var i;

for (i = 0; i < acc.length; i++) {
  acc[i].addEventListener("click", function() {
    var panel = this.nextElementSibling;
    if (panel.style.display === "block") {
      panel.style.display = "none";
    } else {
      panel.style.display = "block";
    }
  });
}
</script>



<?php
include('inc/footer.php');
?>
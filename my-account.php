<?php
$title = "My account";
include('config/app.php');
include('codes/authentication_code.php');
include('controllers/AuthenticationController.php');
include('controllers/UserordersController.php');
include('controllers/CategoryController.php');
include('controllers/ProductController.php');
$authenticated = new AuthenticationController;
$data = $authenticated->authDetail();
include('inc/header.php');
?>

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
                            <li>My Account</li>
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
                            <div class="col-lg-4">
                                <div class="ltn__tab-menu-list mb-50">
                                    <div class="nav">
                                        <a class="active show" data-bs-toggle="tab" href="#liton_tab_1_1">Dashboard <i class="fas fa-home"></i></a>
                                        <a data-bs-toggle="tab" href="#liton_tab_1_2">Orders <i class="fas fa-file-alt"></i></a>
                                        <a data-bs-toggle="tab" href="#liton_tab_1_4">address <i class="fas fa-map-marker-alt"></i></a>
                                        <a data-bs-toggle="tab" href="#liton_tab_1_5">Account Details <i class="fas fa-user"></i></a>
                                        <!-- <a href="login.html">Logout <i class="fas fa-sign-out-alt"></i></a> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-8">
                                <div class="tab-content">
                                    <div class="tab-pane fade active show" id="liton_tab_1_1">
                                        <div class="ltn__myaccount-tab-content-inner">
                                            <p>Hello <strong><?php echo $data['user_name'] ?></strong> </p>
                                            <p>From your account dashboard you can view your <span>recent orders</span>, manage your <span>shipping and billing addresses</span>, and <span>edit your password and account details</span>.</p>
                                        </div>
                                    </div>

                                    <div class="tab-pane fade" id="liton_tab_1_2">
                                        <div class="ltn__myaccount-tab-content-inner">
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
                                                            <td><a href="view-orders.php?id=<?php echo $order_items['id']?>">View</a></td>
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
                                  
                                    <div class="tab-pane fade" id="liton_tab_1_4">
                                        <div class="ltn__myaccount-tab-content-inner">
                                            <!-- <p>The following addresses will be used on the checkout page by default.</p> -->
                                            <div class="row">
                                                <div class="col-md-6 col-12 learts-mb-30">
                                                    <h4>Address <small><a href="#">edit</a></small></h4>
                                                    <address>
                                                        <!-- <p><strong>Alex Tuntuni</strong></p> -->
                                                        <p><?php echo $data['address1'] . ' ' . $data['address2']?><br>
                                                            <?php echo $data['city']?>, <?php echo $data['zone']?>, <?php echo $data['country']?> <br>
                                                            <?php echo $data['zip']?>
                                                        </p>
                                                        <p>Mobile: <?php echo $data['phone']?></p>
                                                    </address>
                                                </div>
                                                <!-- <div class="col-md-6 col-12 learts-mb-30">
                                                    <h4>Shipping Address <small><a href="#">edit</a></small></h4>
                                                    <address>
                                                        <p><strong>Alex Tuntuni</strong></p>
                                                        <p>1355 Market St, Suite 900 <br>
                                                            San Francisco, CA 94103</p>
                                                        <p>Mobile: (123) 456-7890</p>
                                                    </address>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-pane fade" id="liton_tab_1_5">
                                        <div class="ltn__myaccount-tab-content-inner">
                                            <!-- <p>The following addresses will be used on the checkout page by default.</p> -->
                                            <div class="ltn__form-box">
                                                <form action="codes/user.php" method="POST">
                                                    <div class="row mb-50">
                                                        <div class="col-md-6">
                                                            <label>First name:</label>
                                                            <input type="text" name="firstname" value="<?php echo $data['user_name']?>">
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
                                                            <label>Phone:</label>
                                                            <input type="text" name="phone"  value="<?php echo $data['phone']?>">
                                                        </div>
                                                       
                                                        <div class="col-md-6">
                                                            <label>Address 1:</label>
                                                            <input type="text" name="address1"  value="<?php echo $data['address1']?>">
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <label>Address 2:</label>
                                                            <input type="text" name="address2"  value="<?php echo $data['address2']?>">
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <label>City:</label>
                                                            <input type="text" name="city"  value="<?php echo $data['city']?>">
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <label>Country:</label>
                                                            <input type="text" name="country"  value="<?php echo $data['country']?>">
                                                        </div>
                                                        
                                                        <div class="col-md-6">
                                                            <label>State:</label>
                                                            <input type="text" name="state"  value="<?php echo $data['zone']?>">
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label>Zip:</label>
                                                            <input type="text" name="zip"  value="<?php echo $data['zip']?>">
                                                        </div>
                                                    </div>
                                                    <!-- <fieldset>
                                                        <legend>Password change</legend>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <label>Current password (leave blank to leave unchanged):</label>
                                                                <input type="password" name="ltn__name">
                                                                <label>New password (leave blank to leave unchanged):</label>
                                                                <input type="password" name="ltn__lastname">
                                                                <label>Confirm new password:</label>
                                                                <input type="password" name="ltn__lastname">
                                                            </div>
                                                        </div>
                                                    </fieldset> -->
                                                    <div class="btn-wrapper">
                                                        <button type="submit" name="update_btn" class="btn theme-btn-1 btn-effect-1 text-uppercase">Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
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




<?php
include('inc/footer.php');
?>
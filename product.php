<?php
$title = "Product";
include('config/app.php');
include('codes/authentication_code.php');
include('controllers/CategoryController.php');
include('controllers/ProductController.php');
include('controllers/RelatedProductController.php');
include('inc/header.php');
?>


<div class="ltn__utilize-overlay"></div>

<style>
@media only screen and (min-width:360px) and (max-width:768px){
    .ltn__breadcrumb-area{
        margin-bottom: 0px !important;
        padding-top: 22px;
        padding-bottom: 24px;
    }
    .ltn__shop-details-small-img{
       height:112px; 
    }
    .main-prod-img{
        width:60%;
        margin:auto;
    }
    .slick-list{
        height:200px;
    }
    .ltn__shop-details-img-gallery{
        margin-bottom:0;
    }
}
</style>

<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image" data-bs-bg="img/bg/14.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner">
                    <h1 class="page-title">Product Details</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="index.html"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                            <li>Product Details</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMB AREA END -->

<!-- SHOP DETAILS AREA START -->
<div class="ltn__shop-details-area pb-85">
    <div class="container">
        <?php include('message.php')?>
        <div class="row">
            <?php
            if (isset($_GET['url'])) {
                $url = validateInput($db->conn, $_GET['url']);
                $getProduct = new ProductController;
                $result =  $getProduct->getSingleproduct($url);
                if ($result) {
                 $checkProdstock =  $getProduct->checkStockunit($result['id']);
                 $stock_left = $result['quantity'] - $checkProdstock;
                }
            ?>
                <div class="col-lg-8 col-md-12">
                    <div class="ltn__shop-details-inner mb-60">

                        <div class="row">
                            <div class="col-md-6">
                                <div class="ltn__shop-details-img-gallery">
                                    <div class="ltn__shop-details-large-img">
                                        <div class="single-large-img main-prod-img-div">
                                            <a href="<?php echo SITE_URL ?>admin/assets/product-images/<?php echo $result['image'] ?>" data-rel="lightcase:myCollection">
                                                <img class="main-prod-img" src="<?php echo SITE_URL ?>admin/assets/product-images/<?php echo $result['image'] ?>" alt="Image">
                                            </a>
                                        </div>
                                        <?php
                                        if (!empty($result['image_one'])) {
                                        ?>
                                            <div class="single-large-img">
                                                <a href="<?php echo SITE_URL ?>admin/assets/product-images/<?php echo $result['image_one'] ?>" data-rel="lightcase:myCollection">
                                                    <img src="<?php echo SITE_URL ?>admin/assets/product-images/<?php echo $result['image_one'] ?>" alt="Image">
                                                </a>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if (!empty($result['image_two'])) {
                                        ?>
                                            <div class="single-large-img">
                                                <a href="<?php echo SITE_URL ?>admin/assets/product-images/<?php echo $result['image_two'] ?>" data-rel="lightcase:myCollection">
                                                    <img src="<?php echo SITE_URL ?>admin/assets/product-images/<?php echo $result['image_two'] ?>" alt="Image">
                                                </a>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if (!empty($result['image_three'])) {
                                        ?>
                                            <div class="single-large-img">
                                                <a href="<?php echo SITE_URL ?>admin/assets/product-images/<?php echo $result['image_three'] ?>" data-rel="lightcase:myCollection">
                                                    <img src="<?php echo SITE_URL ?>admin/assets/product-images/<?php echo $result['image_three'] ?>" alt="Image">
                                                </a>
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if (!empty($result['image_four'])) {
                                        ?>
                                            <div class="single-large-img">
                                                <a href="<?php echo SITE_URL ?>admin/assets/product-images/<?php echo $result['image_four'] ?>" data-rel="lightcase:myCollection">
                                                    <img src="<?php echo SITE_URL ?>admin/assets/product-images/<?php echo $result['image_four'] ?>" alt="Image">
                                                </a>
                                            </div>
                                        <?php
                                        }
                                        ?>


                                    </div>
                                    <div class="ltn__shop-details-small-img slick-arrow-2">
                                        <div class="single-small-img">
                                            <img src="<?php echo SITE_URL ?>admin/assets/product-images/<?php echo $result['image'] ?>" alt="Image">
                                        </div>
                                        <?php
                                        if (!empty($result['image_one'])) {
                                        ?>
                                            <div class="single-small-img">
                                                <img src="<?php echo SITE_URL ?>admin/assets/product-images/<?php echo $result['image_one'] ?>" alt="Image">
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if (!empty($result['image_two'])) {
                                        ?>
                                            <div class="single-small-img">
                                                <img src="<?php echo SITE_URL ?>admin/assets/product-images/<?php echo $result['image_two'] ?>" alt="Image">
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if (!empty($result['image_three'])) {
                                        ?>
                                            <div class="single-small-img">
                                                <img src="<?php echo SITE_URL ?>admin/assets/product-images/<?php echo $result['image_three'] ?>" alt="Image">
                                            </div>
                                        <?php
                                        }
                                        ?>
                                        <?php
                                        if (!empty($result['image_four'])) {
                                        ?>
                                            <div class="single-small-img">
                                                <img src="<?php echo SITE_URL ?>admin/assets/product-images/<?php echo $result['image_four'] ?>" alt="Image">
                                            </div>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="modal-product-info shop-details-info pl-0">
                                    <!-- <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                            <li class="review-total"> <a href="#"> ( 95 Reviews )</a></li>
                                        </ul>
                                    </div> -->
                                    <h3><?php echo $result['name'] ?></h3>
                                    <div class="product-price">
                                        <span>Rs <?php echo $result['price'] ?></span>
                                        <del>Rs <?php echo $result['regular_price'] ?></del>
                                    </div>
                                    <!-- <div class="modal-product-meta ltn__product-details-menu-1">
                                        <ul>
                                            <li>
                                                <strong>Categories:</strong>
                                                <span>
                                                    <a href="#">face-mask</a>
                                                    <a href="#">ppe-kit</a>
                                                    <a href="#">safety-suits</a>
                                                </span>
                                            </li>
                                        </ul>
                                    </div> -->
                                    <div class="ltn__product-details-menu-2">
                                        <ul>
                                            <input type="hidden" value="<?php echo $result['id'] ?>" id="productid">
                                            <li>
                                                <div class="cart-plus-minus">
                                            <?php
                                            if($checkProdstock){
                                            ?>
                                                    <input type="text" value="1" max="<?php echo $stock_left ?>" id="product_quantity" name="qtybutton" class="cart-plus-minus-box">
                                                    <?php
            }
            else{
                ?>
                  <input type="text" value="1" max="<?php echo $result['quantity'] ?>" id="product_quantity" name="qtybutton" class="cart-plus-minus-box">
                  <?php
            }
                                                    ?>
                                                </div>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)" class="theme-btn-1 btn btn-effect-1 add-to-cart-btn" title="Add to Cart" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                                                    <i class="fas fa-shopping-cart"></i>
                                                    <span>ADD TO CART</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="ltn__product-details-menu-3">
                                        <ul>
                                            <li>

                                                <?php if (!isset($_SESSION['authenticated'])) { ?>
                                                    <a id="checkoutbtn" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                                        <i class="far fa-heart"></i>
                                                        <span>Add to Wishlist</span>
                                                    </a>
                                                <?php
                                                } else {
                                                ?>
                                                <?php
                                                if (isset($_SESSION['authenticated'])){
                                                ?>
                                                <input type="hidden" id="customer_id" value="<?php echo $_SESSION['auth_user']['user_id']?>" >
                                                <?php
                                                }
                                                ?>
                                                    <a class="add-to-wishlist-btn" class="theme-btn-1 btn btn-effect-1">    <i class="far fa-heart"></i>
                                                        <span>Add to Wishlist</span></a>
                                                <?php
                                                }
                                                ?>
                                            </li>
                                            <!-- <li>
                                                <a href="#" class="" title="Compare" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                                    <i class="fas fa-exchange-alt"></i>
                                                    <span>Compare</span>
                                                </a>
                                            </li> -->
                                        </ul>
                                    </div>
                                    <hr>
                                    <div class="ltn__social-media">
                                        <ul>
                                            <li>Share:</li>
                                            <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                                            <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                            <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                                            <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>

                                        </ul>
                                    </div>
                                    <hr>
                                    <div class="ltn__safe-checkout">
                                        <h5>Guaranteed Safe Checkout</h5>
                                        <img src="img/icons/payment-2.png" alt="Payment Image">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Shop Tab Start -->
                    <div class="ltn__shop-details-tab-inner ltn__shop-details-tab-inner-2">
                        <div class="ltn__shop-details-tab-menu">
                            <div class="nav">
                                <a class="active show" data-bs-toggle="tab" href="#liton_tab_details_1_1">Description</a>
                                <!-- <a data-bs-toggle="tab" href="#liton_tab_details_1_2" class="">Reviews</a> -->
                            </div>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade active show" id="liton_tab_details_1_1">
                                <div class="ltn__shop-details-tab-content-inner">
                                    <?php echo $result['long_desc'] ?>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="liton_tab_details_1_2">
                                <!-- <div class="ltn__shop-details-tab-content-inner">
                                    <h4 class="title-2">Customer Reviews</h4>
                                    <div class="product-ratting">
                                        <ul>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                            <li class="review-total"> <a href="#"> ( 95 Reviews )</a></li>
                                        </ul>
                                    </div>
                                    <hr>
                                
                                    <div class="ltn__comment-area mb-30">
                                        <div class="ltn__comment-inner">
                                            <ul>
                                                <li>
                                                    <div class="ltn__comment-item clearfix">
                                                        <div class="ltn__commenter-img">
                                                            <img src="img/testimonial/1.jpg" alt="Image">
                                                        </div>
                                                        <div class="ltn__commenter-comment">
                                                            <h6><a href="#">Adam Smit</a></h6>
                                                            <div class="product-ratting">
                                                                <ul>
                                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                </ul>
                                                            </div>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, omnis fugit corporis iste magnam ratione.</p>
                                                            <span class="ltn__comment-reply-btn">September 3, 2020</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="ltn__comment-item clearfix">
                                                        <div class="ltn__commenter-img">
                                                            <img src="img/testimonial/3.jpg" alt="Image">
                                                        </div>
                                                        <div class="ltn__commenter-comment">
                                                            <h6><a href="#">Adam Smit</a></h6>
                                                            <div class="product-ratting">
                                                                <ul>
                                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                </ul>
                                                            </div>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, omnis fugit corporis iste magnam ratione.</p>
                                                            <span class="ltn__comment-reply-btn">September 2, 2020</span>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="ltn__comment-item clearfix">
                                                        <div class="ltn__commenter-img">
                                                            <img src="img/testimonial/2.jpg" alt="Image">
                                                        </div>
                                                        <div class="ltn__commenter-comment">
                                                            <h6><a href="#">Adam Smit</a></h6>
                                                            <div class="product-ratting">
                                                                <ul>
                                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                                    <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                                    <li><a href="#"><i class="far fa-star"></i></a></li>
                                                                </ul>
                                                            </div>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Doloribus, omnis fugit corporis iste magnam ratione.</p>
                                                            <span class="ltn__comment-reply-btn">September 2, 2020</span>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                             
                                    <div class="ltn__comment-reply-area ltn__form-box mb-30">
                                        <form action="#">
                                            <h4 class="title-2">Add a Review</h4>
                                            <div class="mb-30">
                                                <div class="add-a-review">
                                                    <h6>Your Ratings:</h6>
                                                    <div class="product-ratting">
                                                        <ul>
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                            <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                            <li><a href="#"><i class="far fa-star"></i></a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="input-item input-item-textarea ltn__custom-icon">
                                                <textarea placeholder="Type your comments...."></textarea>
                                            </div>
                                            <div class="input-item input-item-name ltn__custom-icon">
                                                <input type="text" placeholder="Type your name....">
                                            </div>
                                            <div class="input-item input-item-email ltn__custom-icon">
                                                <input type="email" placeholder="Type your email....">
                                            </div>
                                            <div class="input-item input-item-website ltn__custom-icon">
                                                <input type="text" name="website" placeholder="Type your website....">
                                            </div>
                                            <label class="mb-0"><input type="checkbox" name="agree"> Save my name, email, and website in this browser for the next time I comment.</label>
                                            <div class="btn-wrapper">
                                                <button class="btn theme-btn-1 btn-effect-1 text-uppercase" type="submit">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div> -->
                            </div>
                        </div>
                    </div>

                    <!-- Shop Tab End -->
                </div>
            <?php
            }
            ?>
            <div class="col-lg-4">
                <aside class="sidebar ltn__shop-sidebar ltn__right-sidebar">
                    <!-- Top Rated Product Widget -->
                    <div class="widget ltn__top-rated-product-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Best Selling Products</h4>
                        <ul>
                            <?php  
                            $getrelated_sidebarprodcts = new RelatedProductController;
                            $getsidebar_products = $getrelated_sidebarprodcts->getRelatedsidebarproducts();
                            if($getsidebar_products){
                                foreach($getsidebar_products as $products_related)
                            ?>
                            <li>
                                <div class="top-rated-product-item clearfix">
                                    <div class="top-rated-product-img">
                                    <a href="<?php echo SITE_URL?>product.php?url=<?php echo $products_related['url'];?>"><img src="<?php echo SITE_URL ?>admin/assets/product-images/<?php echo $products_related['image'] ?>" alt="#"></a>
                                    </div>
                                    <div class="top-rated-product-info">
                                        <!-- <div class="product-ratting">
                                            <ul>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            </ul>
                                        </div> -->
                                        <h6><a href="<?php echo SITE_URL?>product.php?url=<?php echo $products_related['url'];?>"><?php echo $products_related['name'];?></a></h6>
                                        <div class="product-price">
                                            <span>&#x20B9; <?php echo $products_related['price'];?></span>
                                            <del>&#x20B9; <?php echo $products_related['regular_price'];?></del>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <!-- Banner Widget -->
                    <div class="widget ltn__banner-widget">
                        <a href="#"><img src="img/banner/2.jpg" alt="#"></a>
                    </div>
                </aside>
            </div>
        </div>
    </div>
</div>
<!-- SHOP DETAILS AREA END -->

<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <form action="" class="" method="POST" onsubmit="return validateForm()">
        <?php
        $currentpage = "$_SERVER[REQUEST_URI]";
        ?>
        <!-- <input type="hidden" name="current_page" value="<?php echo $currentpage?>"> -->
            <input class="" type="text" id="email" name="email" name="email" placeholder="Email*">
            <input class="" type="password" id="password" name="password" name="password" placeholder="Password*">
            <p style="display:none; color:red;" id="pass_err">Password must contain of 1 uppercase character,1 lowercase character, 1 digit,1 special character, and minimum length of 8 characters.</p>

            <label class="checkbox-inline">
                <input type="checkbox" onclick="showPassword()">Show Password

            </label>
            <div class="btn-wrapper">
                <button name="wishlist-login" type="submit" class="theme-btn-1 btn reverse-color btn-block" type="submit">LOGIN</button>
            </div>
        </form>
    </div>

</div>

<!-- PRODUCT SLIDER AREA START -->
<div class="ltn__product-slider-area ltn__product-gutter pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2">
                    <h4 class="title-2">Related Products<span>.</span></h1>
                </div>
            </div>
        </div>
        <div class="row ltn__related-product-slider-one-active slick-arrow-1">
            <!-- ltn__product-item -->
            <?php   

            $current_product_id = $result['id'];
            $getrelated_products = new RelatedProductController;
            $get_rel_products = $getrelated_products->getcategoryProducts($current_product_id);
            if($get_rel_products){
                // print_r($get_rel_products);
                foreach($get_rel_products as $related_products){
            ?>
            <div class="col-lg-12">
                <div class="ltn__product-item ltn__product-item-3 text-center">
                    <div class="product-img">
                        <a href="<?php echo SITE_URL?>product.php?url=<?php echo $related_products['url'];?>"><img src="<?php echo SITE_URL ?>admin/assets/product-images/<?php echo $related_products['image'] ?>" alt="#"></a>
                        <div class="product-badge">
                            <ul>
                                <li class="sale-badge">New</li>
                            </ul>
                        </div>
                        <!-- <div class="product-hover-action">
                            <ul>
                                <li>
                                    <a href="#" title="Quick View" data-bs-toggle="modal" data-bs-target="#quick_view_modal">
                                        <i class="far fa-eye"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Add to Cart" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">
                                        <i class="fas fa-shopping-cart"></i>
                                    </a>
                                </li>
                                <li>
                                    <a href="#" title="Wishlist" data-bs-toggle="modal" data-bs-target="#liton_wishlist_modal">
                                        <i class="far fa-heart"></i></a>
                                </li>
                            </ul>
                        </div> -->
                    </div>
                    <div class="product-info">
                        <!-- <div class="product-ratting">
                            <ul>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                <li><a href="#"><i class="far fa-star"></i></a></li>
                            </ul>
                        </div> -->
                        <h2 class="product-title"><a href="<?php echo SITE_URL?>product.php?url=<?php echo $related_products['url'];?>"><?php echo $related_products['name'] ?></a></h2>
                        <div class="product-price">
                            <span>&#x20B9; <?php echo $related_products['price'] ?></span>
                            <del>&#x20B9; <?php echo $related_products['regular_price'] ?></del>
                        </div>
                    </div>
                </div>
            </div>

            <?php
                }
            }
            ?>
            
            <!--  -->
        </div>
    </div>
</div>
<!-- PRODUCT SLIDER AREA END -->



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
    $(document).on('click', '.add-to-cart-btn', function() {
        //  alert("hjd");
        let prod_quantity = $("#product_quantity").val();
        let productid = $("#productid").val();
        $.ajax({
            url: "<?php echo SITE_URL; ?>codes/add-to-cart.php",
            method: "post",
            data: {
                prod_quantity: prod_quantity,
                productid: productid,
                action: 'add-to-cart'
            },
            success: function(data) {
                if (data == 'success') {
                    alertify.notify('Item added to cart', 'success', 5, function() {
                        console.log('dismissed');
                    });
                    location.reload();
                } else {
                    alertify.notify('Already added to cart', 'success', 5, function() {
                        console.log('dismissed');
                    });
                }
            }

        });
    });
    $(document).on('click', '.add-to-wishlist-btn', function() {
        //  alert("hjd");
        let customerid = $("#customer_id").val();
        let productid = $("#productid").val();
            // alert(productid);
            // alert(customerid);
        $.ajax({
            url: "<?php echo SITE_URL; ?>codes/add-to-wishlist.php",
            method: "post",
            data: {
                productid: productid,
                customerid: customerid,
                action: 'add-to-wishlist'
            },
            success: function(data) {
                if (data == 'success') {
                    alertify.notify('Item added to wishlist', 'success', 5, function() {
                        console.log('dismissed');
                    });
                } else {
                    alertify.notify('Already added to wishlist', 'success', 5, function() {
                        console.log('dismissed');
                    });
                }
            }

        });
    });

    var modal = document.getElementById("myModal");

    var btn = document.getElementById("checkoutbtn");

    var span = document.getElementsByClassName("close")[0];

    btn.onclick = function() {
        modal.style.display = "block";
    }

    span.onclick = function() {
        modal.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    function showPassword() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }

    }


    var email = document.getElementById("email");
    var passowrd = document.getElementById("password");


    let validEmail = false;
    let validPassword = false;


    email.addEventListener('change', () => {
        console.log("email is blurred");
        let regex = /^([_\-\.0-9a-zA-Z]+)@([_\-\.0-9a-zA-Z]+)\.([a-zA-Z]){2,7}$/;
        let str = email.value;
        console.log(regex, str);
        if (regex.test(str)) {
            email.classList.add('is-valid');
            email.classList.remove('is-invalid');
            validEmail = true;
        } else {
            email.classList.remove('is-valid');
            email.classList.add('is-invalid');
            validEmail = false;

        }
    })
    password.addEventListener('change', () => {
        console.log("phone is blurred");
        let str = password.value;
        console.log(str);
        if (str.match(/[a-z]/g) && str.match(
                /[A-Z]/g) && str.match(
                /[0-9]/g) && str.match(
                /[^a-zA-Z\d]/g) && str.length >= 8) {
            password.classList.add('is-valid');
            password.classList.remove('is-invalid');
            document.getElementById("pass_err").style.display = 'none';
            validPassword = true;

        } else {
            password.classList.remove('is-valid');
            document.getElementById("pass_err").style.display = 'block';
            password.classList.add('is-invalid');
            validPassword = false;
        }
    })

    function validateForm() {
        if (validEmail && validPassword) {
            document.getElementById("error").style.display = "none";
            return true;
        } else {
            document.getElementById("error").style.display = "block";
            console.log("false");
            return false;

        }
    }
</script>

<?php
include('inc/footer.php');
?>
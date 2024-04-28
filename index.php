<?php
$title = "Home";
include('config/app.php');
include('codes/authentication_code.php');
include('controllers/CategoryController.php');
include('controllers/ProductController.php');
include('controllers/BannerController.php');
include('inc/header.php');
?>

<div class="ltn__utilize-overlay"></div>

<!-- SLIDER AREA START (slider-3) -->
<div class="ltn__slider-area ltn__slider-3---  section-bg-1--- mt-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="ltn__slide-active-2 slick-slide-arrow-1 slick-slide-dots-1 mb-30">

                <?php 
                    $getbanners = new BannerController;
                    $id = '2';
                    $result = $getbanners->getbanners($id);
                    if($result){
                    foreach($result as $row){
                ?>
                    <!-- ltn__slide-item -->
                    <div class="ltn__slide-item ltn__slide-item-10 section-bg-1 bg-image" data-bs-bg="admin/assets/product-images/<?php echo $row['image']?>">
                        <div class="ltn__slide-item-inner">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-7 col-md-7 col-sm-7 align-self-center">
                                        <div class="slide-item-info">
                                            <div class="slide-item-info-inner ltn__slide-animation">
                                                <!-- <h6 class="slide-sub-title ltn__secondary-color animated">Up To 50% Off Today Only!</h6> -->
                                                <h1 class="slide-title  animated"><?php echo $row['heading']?></h1>
                                                <div class="slide-brief animated ">
                                                    <p><?php echo $row['description']?></p>
                                                </div>
                                                <!-- <h5 class="color-orange  animated">Starting at &16.99</h5> -->
                                                <div class="btn-wrapper  animated">
                                                    <a href="<?php echo $row['link']?>" class="theme-btn-1 btn btn-effect-1"><?php echo $row['text']?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 align-self-center">
                                        <div class="slide-item-img">
                                            <!-- <a href="shop.html"><img src="img/product/1.png" alt="Image"></a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    }
                }
                $getbanners = new BannerController;
                $id = '3';
                $banner2 = $getbanners->getbanners($id);
                if($banner2){
                foreach($banner2 as $row){
                    ?>
                    <!-- ltn__slide-item -->
                    <div class="ltn__slide-item ltn__slide-item-10 section-bg-1 bg-image" data-bs-bg="admin/assets/product-images/<?php echo $row['image']?>">
                        <div class="ltn__slide-item-inner">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-7 col-md-7 col-sm-7 align-self-center">
                                        <div class="slide-item-info">
                                            <div class="slide-item-info-inner ltn__slide-animation">
                                                <!-- <h4 class="slide-sub-title ltn__secondary-color animated text-uppercase">Welcome to our shop</h4> -->
                                                <h1 class="slide-title  animated"><?php echo $row['heading']?></h1>
                                                <div class="slide-brief animated ">
                                                    <p><?php echo $row['description']?></p>
                                                </div>
                                                <div class="btn-wrapper  animated">
                                                    <a href="<?php echo $row['link']?>" class="theme-btn-1 btn btn-effect-1 text-uppercase"><?php echo $row['text']?></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 col-md-5 col-sm-5 align-self-center">
                                        <div class="slide-item-img">
                                            <!-- <a href="shop.html"><img src="img/slider/62.jpg" alt="Image"></a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            }
                    ?>
                </div>
            </div>
            <div class="col-lg-5">
                <div class="ltn__banner-item">
                    <div class="ltn__banner-img">
                        <a href="shop.html"><img src="img/banner/17.jpg" alt="Banner Image"></a>
                    </div>
                </div>
                <div class="ltn__banner-item">
                    <div class="ltn__banner-img">
                        <a href="shop.html"><img src="img/banner/18.jpg" alt="Banner Image"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- SLIDER AREA END -->

<!-- CATEGORY AREA START -->
<div class="ltn__category-area section-bg-1-- pt-30 pb-50">
    <div class="container">
        <div class="row ltn__category-slider-active-six slick-arrow-1 border-bottom">
            <?php

            $category = new CategoryController;
            $result = $category->getCategory();
            if ($result) {
                foreach ($result as $row) {
            ?>
                    <div class="col-12">
                        <div class="ltn__category-item ltn__category-item-6 text-center">
                            <div class="ltn__category-item-img">
                                <a href="<?php echo SITE_URL?>category.php?url=<?php echo $row['cat_url']?>">
                                    <i class="fas fa-notes-medical"></i>
                                </a>
                            </div>
                            <div class="ltn__category-item-name">
                                <h6><a href="<?php echo SITE_URL?>category.php?url=<?php echo $row['cat_url']?>"><?php echo $row['cat_name']?></a></h6>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<!-- CATEGORY AREA END -->

<!-- PRODUCT AREA START (product-item-3) -->
<div class="ltn__product-area ltn__product-gutter  no-product-ratting pt-20--- pt-65  pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h1 class="section-title">Featured Products</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-3">
                <div class="row">
                    <div class="col-lg-12 col-sm-6">
                        <div class="ltn__banner-item">
                            <div class="ltn__banner-img">
                                <a href="shop.html"><img src="img/banner/11.jpg" alt="Banner Image"></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 col-sm-6">
                        <div class="ltn__banner-item">
                            <div class="ltn__banner-img">
                                <a href="shop.html"><img src="img/banner/12.jpg" alt="Banner Image"></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="row ltn__tab-product-slider-one-active--- slick-arrow-1">
                    <!-- ltn__product-item -->
                    <?php
                    $sale_tag = "featured";
                    $featuredproduct = new ProductController;
                    $getProducts = $featuredproduct->homepageProducts($sale_tag);
                    if ($getProducts) {
                        foreach ($getProducts as $products)
                    ?>

                        <div class="col-lg-3--- col-md-4 col-sm-6 col-6">
                            <div class="ltn__product-item ltn__product-item-2 text-left">
                                <div class="product-img">
                                    <a href="<?php echo SITE_URL ?>product.php?url=<?php echo $products['url'] ?>"><img src="<?php echo SITE_URL ?>admin/assets/product-images/<?php echo $products['image'] ?>" alt="#"></a>
                                    <div class="product-badge">
                                        <ul>
                                            <!--<li class="sale-badge">New</li>-->
                                        </ul>
                                    </div>
                                  
                                </div>
                                <div class="product-info">
                                   
                                    <h2 class="product-title"><a href="<?php echo SITE_URL ?>product.php?url=<?php echo $products['url'] ?>"><?php echo $products['name'] ?></a></h2>
                                    <div class="product-price">
                                        <span>&#8377 <?php echo $products['price'] ?></span>
                                        <del>&#8377 <?php echo $products['regular_price'] ?></del>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php
                    }
                    ?>
                    <!--  -->
                </div>
            </div>
        </div>
    </div>
</div>
<!-- PRODUCT AREA END -->



<!-- PRODUCT AREA START (product-item-3) -->
<div class="ltn__product-area ltn__product-gutter  no-product-ratting pt-115 pb-70---">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h1 class="section-title">Trending Products</h1>
                </div>
            </div>
        </div>
        <div class="row ltn__tab-product-slider-one-active slick-arrow-1">
            <?php
            $sale_tag = "trending";
            $featuredproduct = new ProductController;
            $getProducts = $featuredproduct->homepageProducts($sale_tag);
            if ($getProducts) {
                foreach ($getProducts as $products) {
            ?>
                    <!-- ltn__product-item -->
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                        <div class="ltn__product-item ltn__product-item-3 text-center">
                            <div class="product-img">
                                <a href="<?php echo SITE_URL ?>product.php?url=<?php echo $products['url'] ?>"><img src="<?php echo SITE_URL ?>admin/assets/product-images/<?php echo $products['image'] ?>" alt="#"></a>
                                <div class="product-badge">
                                    <ul>
                                        <!--<li class="sale-badge">New</li>-->
                                    </ul>
                                </div>
                             

                            </div>
                            <div class="product-info">
                              
                                <h2 class="product-title"><a href="<?php echo SITE_URL ?>product.php?url=<?php echo $products['url'] ?>"><?php echo $products['name'] ?></a></h2>
                                <div class="product-price">
                                    <span>&#8377 <?php echo $products['price'] ?></span>
                                    <del>&#8377 <?php echo $products['regular_price'] ?></del>
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
<!-- PRODUCT AREA END -->

<!-- BANNER AREA START -->
<div class="ltn__banner-area mt-120---">
    <div class="container">
        <div class="row ltn__custom-gutter--- justify-content-center">
            <div class="col-lg-4 col-sm-6">
                <div class="ltn__banner-item">
                    <div class="ltn__banner-img">
                        <a href="shop.html"><img src="img/banner/23.jpg" alt="Banner Image"></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="ltn__banner-item">
                    <div class="ltn__banner-img">
                        <a href="shop.html"><img src="img/banner/21.jpg" alt="Banner Image"></a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-sm-6">
                <div class="ltn__banner-item">
                    <div class="ltn__banner-img">
                        <a href="shop.html"><img src="img/banner/23.jpg" alt="Banner Image"></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BANNER AREA END -->

<!-- SMALL PRODUCT LIST AREA START -->
<div class="ltn__small-product-list-area section-bg-1 pt-115 pb-90 mt-90">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">

                <div class="section-title-area ltn__section-title-2 text-center">
                    <h1 class="section-title">Featured Products</h1>
                </div>
            </div>
        </div>
        <div class="row">
            <?php
            $sale_tag = "featured";
            $featuredproduct = new ProductController;
            $getProducts = $featuredproduct->homepageProducts($sale_tag);
            if ($getProducts) {
                foreach ($getProducts as $products) {
            ?>
                    <!-- small-product-item -->
                    <div class="col-lg-4 col-md-6 col-12">
                        <div class="ltn__small-product-item">
                            <div class="small-product-item-img">
                                <a href="<?php echo SITE_URL ?>product.php?url=<?php echo $products['url'] ?>"><img src="<?php echo SITE_URL ?>admin/assets/product-images/<?php echo $products['image'] ?>" alt="Image"></a>
                            </div>
                            <div class="small-product-item-info">
                             
                                <h2 class="product-title"><a href="<?php echo SITE_URL ?>product.php?url=<?php echo $products['url'] ?>"><?php echo $products['name'] ?></a></h2>
                                <div class="product-price">
                                    <span>&#8377 <?php echo $products['price'] ?></span>
                                    <del>&#8377 <?php echo $products['regular_price'] ?></del>
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
<!-- SMALL PRODUCT LIST AREA END -->

<!-- PRODUCT AREA START (product-item-3) -->
<div class="ltn__product-area ltn__product-gutter pt-115 pb-70">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="section-title-area ltn__section-title-2 text-center">
                    <h1 class="section-title">Best Selling Item</h1>
                </div>
            </div>
        </div>
        <div class="row ltn__tab-product-slider-one-active--- slick-arrow-1">
            <!-- ltn__product-item -->
            <?php
            $sale_tag = "featured";
            $featuredproduct = new ProductController;
            $getProducts = $featuredproduct->homepageProducts($sale_tag);
            if ($getProducts) {
                foreach ($getProducts as $products) {
            ?>
                    <div class="col-lg-3 col-md-4 col-sm-6 col-6">
                        <div class="ltn__product-item ltn__product-item-3 text-left">
                            <div class="product-img">
                                <a href="<?php echo SITE_URL ?>product.php?url=<?php echo $products['url'] ?>"><img src="<?php echo SITE_URL ?>admin/assets/product-images/<?php echo $products['image'] ?>" alt="#"></a>
                                <div class="product-badge">
                                    <ul>
                                        <!--<li class="sale-badge">New</li>-->
                                    </ul>
                                </div>
                             
                            </div>
                            <div class="product-info">
                               
                                <h2 class="product-title"><a href="<?php echo SITE_URL ?>product.php?url=<?php echo $products['url'] ?>"><?php echo $products['name'] ?></a></h2>
                                <div class="product-price">
                                    <span>&#8377 <?php echo $products['price'] ?></span>
                                    <del>&#8377 <?php echo $products['regular_price'] ?></del>
                                </div>
                            </div>
                        </div>
                    </div>
            <?php
                }
            }
            ?>
        </div>
    </div>
</div>
<!-- PRODUCT AREA END -->


<!-- FEATURE AREA START ( Feature - 3) -->
<div class="ltn__feature-area section-bg-1 mt-90--- pt-30 pb-30 mt--65---">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__feature-item-box-wrap ltn__feature-item-box-wrap-2 ltn__border--- section-bg-1">
                    <div class="ltn__feature-item ltn__feature-item-8">
                        <div class="ltn__feature-icon">
                            <img src="img/icons/svg/8-trolley.svg" alt="#">
                        </div>
                        <div class="ltn__feature-info">
                            <h4>Free shipping</h4>
                            <p>On all orders over ₹499.00</p>
                        </div>
                    </div>
                    <div class="ltn__feature-item ltn__feature-item-8">
                        <div class="ltn__feature-icon">
                            <img src="img/icons/svg/9-money.svg" alt="#">
                        </div>
                        <div class="ltn__feature-info">
                            <h4>15 days returns</h4>
                            <p>Moneyback guarantee</p>
                        </div>
                    </div>
                    <div class="ltn__feature-item ltn__feature-item-8">
                        <div class="ltn__feature-icon">
                            <img src="img/icons/svg/10-credit-card.svg" alt="#">
                        </div>
                        <div class="ltn__feature-info">
                            <h4>Secure checkout</h4>
                            <p>Protected by Paypal</p>
                        </div>
                    </div>
                    <div class="ltn__feature-item ltn__feature-item-8">
                        <div class="ltn__feature-icon">
                            <img src="img/icons/svg/11-gift-card.svg" alt="#">
                        </div>
                        <div class="ltn__feature-info">
                            <h4>Offer & gift here</h4>
                            <p>On all orders over</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FEATURE AREA END -->

<!-- CALL TO ACTION START (call-to-action-6) -->
<div class="ltn__call-to-action-area call-to-action-6 before-bg-bottom d-none" data-bs-bg="img/1.jpg--">
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
<!-- CALL TO ACTION END -->

<!-- FOOTER AREA START -->
<?php
include('inc/footer.php');
?>
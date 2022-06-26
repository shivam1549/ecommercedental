<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $title; ?></title>
    <meta name="description" content="<?php echo $meta_description; ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Place favicon.png in the root directory -->
    <link rel="shortcut icon" href="<?php echo SITE_URL ?>img/favicon.png" type="image/x-icon" />
    <!-- Font Icons css -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>css/font-icons.css">
    <!-- plugins css -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>css/plugins.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>css/style.css">
    <!-- Responsive css -->
    <link rel="stylesheet" href="<?php echo SITE_URL ?>css/responsive.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>css/mycss.css">
    <link rel="stylesheet" href="<?php echo SITE_URL ?>css/alertify.min.css">
    <script src="<?php echo SITE_URL ?>js/jquery.min.js"></script>
    <style>
    @media (max-width: 479px){
.ltn__utilize {
    width: auto;
}
}
        .menu-icon > a::before{
            right: -11px;
        }
        
     @media only screen and (min-width:360px) and (max-width:768px){
         #mobilemegamenu li{
             display:flex;
         }
            .mobile-menu-toggle > a{
            margin-left: 0;
        }
        
        #serach-header-form{
            display:flex;
        }
        
        .mobile-header-menu-fullwidth .mobile-menu-toggle{
            border:none !important;
        }
        
        .search-input{
            height: 42px !important;
            margin-bottom:0px !important;
        }
        
        .search-form-btn{
            height:42px;
            width:22%;
        }
        
        .padding-header-all{
            padding:7px 0 !important;
        }
        
        .ltn__slide-item{
            padding:0 !important;
        }
        .slide-item-info-inner {
    margin-bottom: 5px !important;
}

.custom-list-flex{
    display:flex;
}

.fa-1x{
    font-size:20px;
}
     }
    </style>
</head>

<body>

    <div class="body-wrapper">

        <header class="ltn__header-area ltn__header-3">
            <!-- ltn__header-top-area start -->
         
            <!-- ltn__header-top-area end -->
            <!-- ltn__header-middle-area start -->
            <div class="ltn__header-middle-area padding-header-all">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <div class="site-logo">
                                <a href="<?php echo SITE_URL ?>"><img src="<?php echo SITE_URL ?>img/brand-logo/dento-logo.webp" alt="Logo"></a>
                            </div>
                        </div>
                        <div class="col header-contact-serarch-column d-none d-lg-block">
                            <div class="header-contact-search">
                                <!-- header-feature-item -->
                                <div class="header-feature-item">
                                    <div class="header-feature-icon">
                                        <i class="icon-call"></i>
                                    </div>
                                    <div class="header-feature-info">
                                        <h6>Phone</h6>
                                        <p><a href="tel:0123456789">+0123-456-789</a></p>
                                    </div>
                                </div>
                                <!-- header-search-2 -->
                                <div class="header-search-2">
                                    <form id="" method="get" action="search.php">
                                        <input type="text" name="search" value="" placeholder="Search here..." />
                                        <button type="submit">
                                            <span><i class="icon-search"></i></span>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <!-- header-options -->
                            <div class="ltn__header-options">
                                <ul class="custom-list-flex">
                                 
                                    <li class="d-none---">
                                        <!-- user-menu -->
                                        <div class="ltn__drop-menu user-menu">
                                            <ul>
                                                <li>
                                                    <a href="#"><i class="icon-user"></i></a>
                                                    <?php
                                                    if (isset($_SESSION['authenticated'])) {
                                                    ?>
                                                        <ul>
                                                            <li><span id="username"><?php echo $_SESSION['auth_user']['username'] ?></span></li>

                                                            <li><a href="my-account">My Account</a></li>
                                                            <li>
                                                                <form action="" method="POST">
                                                                    <button type="submit" name="logout_btn">Logout</button>
                                                                </form>
                                                            </li>

                                                        </ul>
                                                    <?php
                                                    } else {
                                                    ?>
                                                        <ul>
                                                            <li><a href="<?php base_url('login') ?>">Sign in</a></li>
                                                            <li><a href="<?php base_url('register') ?>">Register</a></li>
                                                            <!-- <li><a href="account.html">My Account</a></li> -->
                                                            <li><a href="wishlist">Wishlist</a></li>
                                                        </ul>
                                                    <?php
                                                    }
                                                    ?>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </li>
                                    <li>
                                        <!-- mini-cart 2 -->
                                        <div class="mini-cart-icon mini-cart-icon-2">
                                            <?php
                                            if (isset($_SESSION["add-to-cart"])) {
                                                $carttotal = 0;
                                                foreach ($_SESSION["add-to-cart"] as $key => $cart) {
                                                    $carttotal = $carttotal + ($cart['prod_quant'] * $cart['price']);
                                                }
                                            ?>
                                                <a href="#ltn__utilize-cart-menu" class="ltn__utilize-toggle">
                                                    <span class="mini-cart-icon">
                                                        <i class="icon-shopping-cart"></i>

                                                        <sup><?php echo count($_SESSION["add-to-cart"]) ?></sup>
                                                    </span>
                                                    <h6><span>Your Cart</span> <span class="ltn__secondary-color"> &#8377 <?php echo $carttotal ?></span></h6>
                                                </a>
                                            <?php

                                            } else {
                                            ?>
                                                <a href="#ltn__utilize-cart-menu" class="ltn__utilize-toggle">
                                                    <span class="mini-cart-icon">
                                                        <i class="icon-shopping-cart"></i>

                                                        <sup>0</sup>
                                                    </span>
                                                    <h6><span>Your Cart</span><span class="ltn__secondary-color">&#8377 0</span></h6>
                                                </a>
                                            <?php
                                            }

                                            ?>
                                        </div>
                                    </li>
                                    <li>
                                        <a href="wishlist" title="Wishlist">
                                <span class="utilize-btn-icon">
                                    <i class="far fa-heart fa-1x"></i>
                                 
                                </span>
                               
                            </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ltn__header-middle-area end -->
            <!-- header-bottom-area start -->
            <div class="header-bottom-area ltn__border-top ltn__header-sticky  ltn__sticky-bg-white--- ltn__sticky-bg-secondary ltn__secondary-bg section-bg-1 menu-color-white d-none d-lg-block">
                <div class="container">
                    <div class="row">
                        <div class="col header-menu-column justify-content-center">
                            <div class="sticky-logo">
                                <div class="site-logo">
                                    <a href="<?php echo SITE_URL ?>"><img src="<?php echo SITE_URL; ?>img/brand-logo/dento-logo.webp" alt="Logo"></a>
                                </div>
                            </div>
                            <div class="header-menu header-menu-2">
                                <nav>
                                    <div class="ltn__main-menu">
                                               <?php
                                        $categories = new CategoryController;
                             $res =  $categories->fetchCategoryTreeListmenu(0);
                                    //   print_r($res);
                                      
                                                ?>
                                        <ul>
                                           <?php
                                 
                                        echo  $categories->fetchCategoryTreeListmenu(0);
                                      
                                            ?>
                                            
                                        </ul>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- header-bottom-area end -->
        </header>
        <!-- HEADER AREA END -->

        <!-- MOBILE MENU START -->
        <div class="mobile-header-menu-fullwidth mb-30 d-block d-lg-none">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <!-- Mobile Menu Button -->
                        <div class="mobile-menu-toggle d-lg-none">
                            <!--<span>MENU</span>-->
                            <a href="#ltn__utilize-mobile-menu" class="ltn__utilize-toggle">
                                <svg viewBox="0 0 800 600">
                                    <path d="M300,220 C300,220 520,220 540,220 C740,220 640,540 520,420 C440,340 300,200 300,200" id="top"></path>
                                    <path d="M300,320 L540,320" id="middle"></path>
                                    <path d="M300,210 C300,210 520,210 540,210 C740,210 640,530 520,410 C440,330 300,190 300,190" id="bottom" transform="translate(480, 320) scale(1, -1) translate(-480, -318) "></path>
                                </svg>
                            </a>
                            
                            
                                                <form id="serach-header-form" method="get" action="search.php">
                                                    <input type="text" name="search" value="" class="search-input" placeholder="Search here..." />
                                                    <button class="search-form-btn" type="submit">
                                                        <span><i class="icon-search"></i></span>
                                                    </button>
                                                </form>
                                          
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- MOBILE MENU END -->

        <!-- Utilize Cart Menu Start -->
        <div id="ltn__utilize-cart-menu" class="ltn__utilize ltn__utilize-cart-menu">
            <div class="ltn__utilize-menu-inner ltn__scrollbar">
                <div class="ltn__utilize-menu-head">
                    <span class="ltn__utilize-menu-title">Cart</span>
                    <button class="ltn__utilize-close">×</button>
                </div>
                <div class="mini-cart-product-area ltn__scrollbar">
                    <?php if (isset($_SESSION["add-to-cart"])) {
                        // print_r($_SESSION["add-to-cart"]);
                        foreach ($_SESSION["add-to-cart"] as $key => $cart) {
                    ?>
                            <div class="mini-cart-item clearfix">
                                <div class="mini-cart-img">
                                    <a href="product.php?url=<?php echo $cart['prod_url'] ?>"><img src="<?php SITE_URL ?>admin/assets/product-images/<?php echo $cart['prod_image'] ?>" alt="Image"></a>
                                    <span data-productid="<?php echo $cart['productid']; ?>" class="mini-cart-item-delete remove-products"><i class="icon-cancel"></i></span>
                                </div>
                                <div class="mini-cart-info">
                                    <h6><a href="product.php?url=<?php echo $cart['prod_url'] ?>"><?php echo $cart['prod_name'] ?></a></h6>
                                    <span class="mini-cart-quantity"><?php echo $cart['prod_quant'] ?> x <?php echo $cart['price'] ?></span>
                                </div>
                            </div>
                    <?php
                        }
                    }
                    ?>
                </div>
                <div class="mini-cart-footer">
                    <div class="mini-cart-sub-total">
                        <?php
                        if ($_SESSION["add-to-cart"]) {
                            $carttotal = 0;
                            foreach ($_SESSION["add-to-cart"] as $key => $cart) {
                                $carttotal = $carttotal + ($cart['prod_quant'] * $cart['price']);
                            }
                        ?>
                            <h5>Subtotal: <span>₹ <?php echo $carttotal; ?></span></h5>
                        <?php
                        }
                        ?>
                    </div>
                    <div class="btn-wrapper">
                        <a href="cart" class="theme-btn-1 btn btn-effect-1">View Cart</a>
                        <!-- <a href="cart.html" class="theme-btn-2 btn btn-effect-2">Checkout</a> -->
                    </div>
                    <p>Free Shipping on All Orders Over ₹499</p>
                </div>

            </div>
        </div>
        <!-- Utilize Cart Menu End -->

        <!-- Utilize Mobile Menu Start -->
        <div id="ltn__utilize-mobile-menu" class="ltn__utilize ltn__utilize-mobile-menu">
            <div class="ltn__utilize-menu-inner ltn__scrollbar">
                <div class="ltn__utilize-menu-head">
                    <div class="site-logo">
                        <a href="/"><img src="<?php echo SITE_URL; ?>img/brand-logo/dento-logo.webp" alt="Logo"></a>
                    </div>
                    <button class="ltn__utilize-close">×</button>
                </div>
                <!--<div class="ltn__utilize-menu-search-form">-->
                <!--    <form action="search.php" method="get">-->
                <!--        <input type="text" name="search" placeholder="Search...">-->
                <!--        <button type="submit"><i class="fas fa-search"></i></button>-->
                <!--    </form>-->
                <!--</div>-->
                <div class="ltn__utilize-menu">
                    <ul id="">
                       <li><a href="<?php echo SITE_URL;?>all-category.php">Shop By Category</a></li>
                    </ul>
                </div>
                <div class="ltn__utilize-buttons ltn__utilize-buttons-2">
                    <ul>
                        <li>
                            <a href="my-account" title="My Account">
                                <span class="utilize-btn-icon">
                                    <i class="far fa-user"></i>
                                </span>
                                My Account
                            </a>
                        </li>
                        <li>
                            <a href="wishlist" title="Wishlist">
                                <span class="utilize-btn-icon">
                                    <i class="far fa-heart"></i>
                                 
                                </span>
                                Wishlist
                            </a>
                        </li>
                      
                    </ul>
                </div>
                <div class="ltn__social-media-2">
                    <ul>
                        <li><a href="#" title="Facebook"><i class="fab fa-facebook-f"></i></a></li>
                        <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                        <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                        <li><a href="#" title="Instagram"><i class="fab fa-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
<?php
$title = "Category";
include('config/app.php');
include('codes/authentication_code.php');
include('controllers/CategoryController.php');
include('controllers/ProductController.php');
include('inc/header.php');
?>
<style>
    .slidecontainer {
        width: 100%;
    }

    .slider {
        -webkit-appearance: none;
        width: 100%;
        height: 25px;
        background: #d3d3d3;
        outline: none;
        opacity: 0.7;
        -webkit-transition: .2s;
        transition: opacity .2s;
    }

    .slider:hover {
        opacity: 1;
    }

    .slider::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 25px;
        height: 25px;
        background: #04AA6D;
        cursor: pointer;
    }


    .hide-element {
        display: none;
    }

    .slider::-moz-range-thumb {
        width: 25px;
        height: 25px;
        background: #04AA6D;
        cursor: pointer;
    }
</style>

<div class="ltn__utilize-overlay"></div>

<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image " data-bs-bg="img/bg/14.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner">
                    <h1 class="page-title">Shop</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="/"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                            <li>Shop</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMB AREA END -->

<?php


if (isset($_GET['url'])) {
    $url = validateInput($db->conn, $_GET['url']);
    $category = new CategoryController;
    $price_filter = '';
    $sorting = '';

    if (isset($_POST['price_filter'])) {
        $price_filter = $_POST['price_filter'];
    }
    $result = $category->getCategorybyurl($url);
    if ($result) {
        $categoryid = $result['id'];
        $getcategoryname = $category->getCategorynameByid($categoryid);
        $product = new ProductController;
        $getProduct = $product->getcategoryProducts($categoryid, $price_filter);
    }
}

?>

<!-- PRODUCT DETAILS AREA START -->
<div class="ltn__product-area ltn__product-gutter mb-120">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="ltn__shop-options">
                    <ul>
                        <li>
                            <div class="ltn__grid-list-tab-menu ">
                                <div class="nav">
                                    <a href="#"><?php echo $getcategoryname['cat_name'];?></a>
                                    <!-- <a class="active show" data-bs-toggle="tab" href="#liton_product_grid"><i class="fas fa-th-large"></i></a>
                                    <a data-bs-toggle="tab" href="#liton_product_list"><i class="fas fa-list"></i></a> -->
                                </div>
                            </div>
                        </li>
                        <!-- <li>
                            <div class="showing-product-number text-right">
                                <span>Showing 1–12 of 18 results</span>
                            </div>
                        </li> -->
                        <li>
                            <div class="short-by text-center">
                                <form method="POST" id="sorting_form" action="#">
                                    <select name="sorting_values" id="sorting_vals" class="nice-select">
                                        <option>Default Sorting</option>
                                        <option value="new">Sort by new arrivals</option>
                                        <option value="high">Sort by price: low to high</option>
                                        <option value="low">Sort by price: high to low</option>
                                    </select>
                                    <button type="submit" class="hide-element">Submit</button>
                                </form>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="liton_product_grid">
                        <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                            <div class="row">
                                <?php
                                if ($getProduct) {
                                    if (isset($_POST['sorting_values'])) {
                                        $price_filter = $_POST['sorting_values'];
                                        $price = array();
                                        foreach ($getProduct as $product) {
                                            $price[] =  $product['price'];
                                        }
                                        if ($price_filter == 'high') {
                                            array_multisort($price, SORT_ASC, $getProduct);
                                        }
                                        if ($price_filter == 'low') {
                                            array_multisort($price, SORT_DESC, $getProduct);
                                        }
                                    }
                                    // print_r($getProduct);
                                    foreach ($getProduct as $product) {
                                ?>
                                        <div class="col-xl-4 col-sm-6 col-6">
                                            <div class="ltn__product-item ltn__product-item-3 text-center">
                                                <div class="product-img">
                                                    <a href="<?php echo SITE_URL ?>product.php?url=<?php echo $product['url'] ?>"><img src="<?php echo SITE_URL ?>admin/assets/product-images/<?php echo $product['image'] ?>" alt="#"></a>
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
                                                    <h2 class="product-title"><a href="<?php echo SITE_URL ?>product.php?url=<?php echo $product['url'] ?>"><?php echo $product['name'] ?></a></h2>
                                                    <div class="product-price">
                                                        <span>Rs. <?php echo $product['price'] ?></span>
                                                        <del>Rs. <?php echo $product['regular_price'] ?></del>
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

                </div>
                <!-- <div class="ltn__pagination-area text-center">
                    <div class="ltn__pagination">
                        <ul>
                            <li><a href="#"><i class="fas fa-angle-double-left"></i></a></li>
                            <li><a href="#">1</a></li>
                            <li class="active"><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">...</a></li>
                            <li><a href="#">10</a></li>
                            <li><a href="#"><i class="fas fa-angle-double-right"></i></a></li>
                        </ul>
                    </div>
                </div> -->
            </div>
            <div class="col-lg-4">
                <aside class="sidebar ltn__shop-sidebar ltn__right-sidebar">
                    <!-- Category Widget -->
                    <div class="widget ltn__menu-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Product categories</h4>
                        <ul>
                            <?php

                            $category = new CategoryController;
                            $result = $category->getCategory();
                            if ($result) {
                                foreach ($result as $row) {
                            ?>
                                    <li><a href="<?php echo SITE_URL ?>category.php?url=<?php echo $row['cat_url'] ?>"><?php echo $row['cat_name'] ?> <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                            <?php
                                }
                            }
                            ?>
                        </ul>
                    </div>
                    <!-- Price Filter Widget -->
                    <div class="">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Filter by price</h4>
                        <div class="">
                            <div class="">
                                <form id="price_filter_form" action="#" method="POST">
                                    <input type="range" min="100" max="75000" name="price_filter" class="form-control-range slider" id="priceinput">
                                    <p>Value:<span id="price_value"></span></p>
                                    <button type="submit" class="theme-btn-1 btn btn-effect-1 mb-3 hide-element">Apply</button>

                                </form>
                            </div>
                            <!-- <div class="slider-range"></div> -->
                        </div>
                    </div>

                    <div class="widget ltn__banner-widget">
                        <a href="#"><img src="img/banner/banner-2.jpg" alt="#"></a>
                    </div>

                </aside>
            </div>
        </div>
    </div>
</div>
<!-- PRODUCT DETAILS AREA END -->

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
    $(document).ready(function() {
        $('#priceinput').on('change', function() {
            document.getElementById("price_filter_form").submit();
        });
        $('#sorting_vals').on('change', function() {
            document.getElementById("sorting_form").submit();
        });

    });


    var formatter = new Intl.NumberFormat('en-US', {
        style: 'currency',
        currency: 'INR',

    });


    var slider = document.getElementById("priceinput");
    var output = document.getElementById("price_value");
    output.innerHTML = formatter.format(slider.value);
    slider.oninput = function() {
        output.innerHTML = this.value;
    }
</script>

<?php
include('inc/footer.php');
?>
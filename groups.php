<?php
$title = "Category";
include('config/app.php');
include('codes/authentication_code.php');

include('controllers/GroupController.php');
include('controllers/ProductController.php');
include('inc/header.php');
?>

<div class="ltn__utilize-overlay"></div>

<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bs-bg="img/bg/14.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner">
                    <h1 class="page-title">Shop</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="index.html"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                            <li>Shop</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMB AREA END -->

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
                                    <a class="active show" data-bs-toggle="tab" href="#liton_product_grid"><i class="fas fa-th-large"></i></a>
                                    <a data-bs-toggle="tab" href="#liton_product_list"><i class="fas fa-list"></i></a>
                                </div>
                            </div>
                        </li>
                        <li>
                           <div class="showing-product-number text-right">
                                <span>Showing 1–12 of 18 results</span>
                            </div> 
                        </li>
                        <li>
                           <div class="short-by text-center">
                                <select class="nice-select">
                                    <option>Default Sorting</option>
                                    <option>Sort by popularity</option>
                                    <option>Sort by new arrivals</option>
                                    <option>Sort by price: low to high</option>
                                    <option>Sort by price: high to low</option>
                                </select>
                            </div> 
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane fade active show" id="liton_product_grid">
                        <div class="ltn__product-tab-content-inner ltn__product-grid-view">
                            <div class="row">
                                <?php
                                        if(isset($_GET['url'])){
                                        $url = validateInput($db->conn, $_GET['url']);
                                        $groups = new GroupController;
                                        $result =  $groups->getGroup($url);
                                        if($result){
                                            $categoryid = $result['id'];
                                            $product = new ProductController;
                                            $getProduct = $product->getcategoryProducts($categoryid);
                                            
                                        }
                                        }
                                        if($getProduct){
                                            // print_r($getProduct);
                                            foreach($getProduct as $product){
                                ?>
                                <div class="col-xl-4 col-sm-6 col-6">
                                    <div class="ltn__product-item ltn__product-item-3 text-center">
                                        <div class="product-img">
                                            <a href="<?php echo SITE_URL?>product.php?url=<?php echo $product['url'] ?>"><img src="<?php echo SITE_URL?>admin/assets/product-images/<?php echo $product['image']?>" alt="#"></a>
                                            <div class="product-badge">
                                                <ul>
                                                    <li class="sale-badge">New</li>
                                                </ul>
                                            </div>
                                            <div class="product-hover-action">
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
                                            </div>
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
                                            <h2 class="product-title"><a href="<?php echo SITE_URL?>product.php?url=<?php echo $product['url'] ?>"><?php echo $product['name'] ?></a></h2>
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
                <div class="ltn__pagination-area text-center">
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
                </div>
            </div>
            <div class="col-lg-4">
                <aside class="sidebar ltn__shop-sidebar ltn__right-sidebar">
                    <!-- Category Widget -->
                    <div class="widget ltn__menu-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Product categories</h4>
                        <ul>
                            <li><a href="portfolio-details.html">Hand Sanitizer <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                            <li><a href="portfolio-details.html">Lab N95 Face Mask <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                            <li><a href="portfolio-details.html">Hand Gloves <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                            <li><a href="portfolio-details.html">Medical Equipment <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                            <li><a href="portfolio-details.html">New Arrival Product <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                            <li><a href="portfolio-details.html">Uncategorized <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                            <li><a href="portfolio-details.html">Special Offers <span><i class="fas fa-long-arrow-alt-right"></i></span></a></li>
                        </ul>
                    </div>
                    <!-- Price Filter Widget -->
                    <div class="widget ltn__price-filter-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Filter by price</h4>
                        <div class="price_filter">
                            <div class="price_slider_amount">
                                <input type="submit"  value="Your range:"/> 
                                <input type="text" class="amount" name="price"  placeholder="Add Your Price" /> 
                            </div>
                            <div class="slider-range"></div>
                        </div>
                    </div>
                    <!-- Top Rated Product Widget -->
                    <div class="widget ltn__top-rated-product-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Top Rated Product</h4>
                        <ul>
                            <li>
                                <div class="top-rated-product-item clearfix">
                                    <div class="top-rated-product-img">
                                        <a href="product-details.html"><img src="img/product/1.png" alt="#"></a>
                                    </div>
                                    <div class="top-rated-product-info">
                                        <div class="product-ratting">
                                            <ul>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <h6><a href="product-details.html">Mixel Solid Seat Cover</a></h6>
                                        <div class="product-price">
                                            <span>$49.00</span>
                                            <del>$65.00</del>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="top-rated-product-item clearfix">
                                    <div class="top-rated-product-img">
                                        <a href="product-details.html"><img src="img/product/2.png" alt="#"></a>
                                    </div>
                                    <div class="top-rated-product-info">
                                        <div class="product-ratting">
                                            <ul>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <h6><a href="product-details.html">Thermometer Gun</a></h6>
                                        <div class="product-price">
                                            <span>$49.00</span>
                                            <del>$65.00</del>
                                        </div>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="top-rated-product-item clearfix">
                                    <div class="top-rated-product-img">
                                        <a href="product-details.html"><img src="img/product/3.png" alt="#"></a>
                                    </div>
                                    <div class="top-rated-product-info">
                                        <div class="product-ratting">
                                            <ul>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star"></i></a></li>
                                                <li><a href="#"><i class="fas fa-star-half-alt"></i></a></li>
                                                <li><a href="#"><i class="far fa-star"></i></a></li>
                                            </ul>
                                        </div>
                                        <h6><a href="product-details.html">Coil Spring Conversion</a></h6>
                                        <div class="product-price">
                                            <span>$49.00</span>
                                            <del>$65.00</del>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <!-- Search Widget -->
                    <div class="widget ltn__search-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Search Objects</h4>
                        <form action="#">
                            <input type="text" name="search" placeholder="Search your keyword...">
                            <button type="submit"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                    <!-- Tagcloud Widget -->
                    <div class="widget ltn__tagcloud-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Popular Tags</h4>
                        <ul>
                            <li><a href="#">Body</a></li>
                            <li><a href="#">Doctor</a></li>
                            <li><a href="#">Drugs</a></li>
                            <li><a href="#">Eye</a></li>
                            <li><a href="#">Face</a></li>
                            <li><a href="#">Hand</a></li>
                            <li><a href="#">Mask</a></li>
                            <li><a href="#">Medicine</a></li>
                            <li><a href="#">Price</a></li>
                            <li><a href="#">Sanitizer</a></li>
                            <li><a href="#">Virus</a></li>
                        </ul>
                    </div>
                    <!-- Size Widget -->
                    <div class="widget ltn__tagcloud-widget ltn__size-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Product Size</h4>
                        <ul>
                            <li><a href="#">S</a></li>
                            <li><a href="#">M</a></li>
                            <li><a href="#">L</a></li>
                            <li><a href="#">XL</a></li>
                            <li><a href="#">XXL</a></li>
                        </ul>
                    </div>
                    <!-- Color Widget -->
                    <div class="widget ltn__color-widget">
                        <h4 class="ltn__widget-title ltn__widget-title-border">Product Color</h4>
                        <ul>
                            <li class="black"><a href="#"></a></li>
                            <li class="white"><a href="#"></a></li>
                            <li class="red"><a href="#"></a></li>
                            <li class="silver"><a href="#"></a></li>
                            <li class="gray"><a href="#"></a></li>
                            <li class="maroon"><a href="#"></a></li>
                            <li class="yellow"><a href="#"></a></li>
                            <li class="olive"><a href="#"></a></li>
                            <li class="lime"><a href="#"></a></li>
                            <li class="green"><a href="#"></a></li>
                            <li class="aqua"><a href="#"></a></li>
                            <li class="teal"><a href="#"></a></li>
                            <li class="blue"><a href="#"></a></li>
                            <li class="navy"><a href="#"></a></li>
                            <li class="fuchsia"><a href="#"></a></li>
                            <li class="purple"><a href="#"></a></li>
                            <li class="pink"><a href="#"></a></li>
                            <li class="nude"><a href="#"></a></li>
                            <li class="orange"><a href="#"></a></li>

                            <li><a href="#" class="orange"></a></li>
                            <li><a href="#" class="orange"></a></li>
                        </ul>
                    </div>
                    <!-- Banner Widget -->
                    <div class="widget ltn__banner-widget">
                        <a href="shop.html"><img src="img/banner/banner-2.jpg" alt="#"></a>
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

<?php
include('inc/footer.php');
?>
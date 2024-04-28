<?php
$title = "Wishlist";
include('config/app.php');
include('codes/authentication_code.php');
include('controllers/CategoryController.php');
include('controllers/WishlistController.php');
include('controllers/AuthenticationController.php');
$authenticated =new AuthenticationController;
$data = $authenticated->authDetail();
include('inc/header.php');

?>
<style>
  .is-invalid{
    border:1px solid red !important;
  }
  .is-valid{
    border:1px solid green;
  }
  #error{
    color:red;
    display:none;
  }
</style>
  <div class="ltn__utilize-overlay"></div>

<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image "  data-bs-bg="img/bg/14.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner">
                    <h1 class="page-title">Wishlist</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="index.html"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                            <li>Wishlist</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- BREADCRUMB AREA END -->

<!-- LOGIN AREA START (Register) -->
<div class="ltn__login-area pb-110">
    <div class="container">
    <div class="row">
                <div class="col-lg-12">
                    <div class="shoping-cart-inner">
                        <div class="shoping-cart-table table-responsive">
                            <table class="table">
                                <!-- <thead>
                                    <th class="cart-product-remove">X</th>
                                    <th class="cart-product-image">Image</th>
                                    <th class="cart-product-info">Title</th>
                                    <th class="cart-product-price">Price</th>
                                    <th class="cart-product-quantity">Quantity</th>
                                    <th class="cart-product-subtotal">Subtotal</th>
                                </thead> -->
                                <tbody>
                                    <?php
                                    $wishlist = new WishlistController;
                                     $userid = $data['id'];
                                     $result = $wishlist->getwishList($userid);
                                    if($result){
                                        foreach($result as $row){
                                    ?>
                                    <tr>
                                        <td class="cart-product-remove"><a data-prodid="<?php echo $row['id']?>" class="remove_wishlist">x</a> </td>
                                        <td class="cart-product-image">
                                            <a href="product.php?url=<?php echo $row['url']?>"><img src="<?php echo SITE_URL?>admin/assets/product-images/<?php echo $row['image'] ?>" alt="#"></a>
                                        </td>
                                        <td class="cart-product-info">
                                            <h4><a href="product.php?url=<?php echo $row['url']?>"><?php echo $row['name']?></a></h4>
                                        </td>
                                        <td class="cart-product-price">&#8377 <?php echo $row['price']?></td>
                                        <!-- <td class="cart-product-stock">In Stock</td> -->
                                        <!-- <td class="cart-product-add-cart">
                                            <a class="submit-button-1" href="#" title="Add to Cart" data-bs-toggle="modal" data-bs-target="#add_to_cart_modal">Add to Cart</a>
                                        </td> -->
                                    </tr>
                                    <?php
                                    }
                                }
                                else{
                                    ?>
                                    <tr>No Items In Wishlist</tr>
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
<!-- LOGIN AREA END -->

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
      $(document).on('click', '.remove_wishlist', function() {
        //  alert("hjd");
        let customerid = "<?php echo $data['id']?>";
        let productid = $(this).data('prodid');
            // alert(productid);
            // alert(customerid);
        $.ajax({
            url: "<?php echo SITE_URL; ?>codes/add-to-wishlist.php",
            method: "post",
            data: {
                productid: productid,
                customerid: customerid,
                action: 'delete-wishlist'
            },
            success: function(data) {
                if (data == 'success') {
                    alertify.notify('Item added to wishlist', 'success', 5, function() {
                        console.log('dismissed');
                    });
                    location.reload();
                } else {
                    alertify.notify('Some Error Occured', 'success', 5, function() {
                        console.log('dismissed');
                    });
                }
            }

        });
    });
</script>

<?php
include('inc/footer.php');
?>


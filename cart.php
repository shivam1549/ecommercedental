<?php
$title = "Cart";
include('config/app.php');
include('codes/authentication_code.php');
include('controllers/CategoryController.php');
include('controllers/ProductController.php');
include('inc/header.php');
?>

<div class="ltn__utilize-overlay"></div>

<!-- BREADCRUMB AREA START -->
<div class="ltn__breadcrumb-area text-left bg-overlay-white-30 bg-image " data-bs-bg="img/bg/14.jpg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="ltn__breadcrumb-inner">
                    <h1 class="page-title">Cart</h1>
                    <div class="ltn__breadcrumb-list">
                        <ul>
                            <li><a href="/"><span class="ltn__secondary-color"><i class="fas fa-home"></i></span> Home</a></li>
                            <li>Cart</li>
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
                <?php include("message.php"); ?>
                <div class="shoping-cart-inner">
                    <div class="shoping-cart-table table-responsive">
                        <table class="table">
                            <!-- <thead>
                                <th class="cart-product-remove">Remove</th>
                                <th class="cart-product-image">Image</th>
                                <th class="cart-product-info">Product</th>
                                <th class="cart-product-price">Price</th>
                                <th class="cart-product-quantity">Quantity</th>
                                <th class="cart-product-subtotal">Subtotal</th>
                            </thead> -->
                            <tbody>
                                <?php if (isset($_SESSION["add-to-cart"])) {
                                    // print_r($_SESSION["add-to-cart"]);
                                    foreach ($_SESSION["add-to-cart"] as $key => $cart) {
                    $getProduct = new ProductController;
                 $checkProdstock =  $getProduct->checkStockunit($cart['productid']);
                 $stock_left = $cart['max-quantity'] - $checkProdstock;
                                        
                                ?>
                                        <tr class="cart_row">

                                            <td class="cart-product-remove "> <span data-productid="<?php echo $cart['productid']; ?>" class="remove-products">x</span> </td>
                                            <td class="cart-product-image">
                                                <a href="product.php?url=<?php echo $cart['prod_url'] ?>"><img src="<?php SITE_URL ?>admin/assets/product-images/<?php echo $cart['prod_image'] ?>" alt="#"></a>
                                            </td>
                                            <td class="cart-product-info">
                                                <h4><a href="product.php?url=<?php echo $cart['prod_url'] ?>"><?php echo $cart['prod_name'] ?></a></h4>
                                            </td>
                                            <td class="cart-product-price"><span>&#8377 </span><?php echo $cart['price'] ?></td>
                                            <td class="cart-product-quantity">
                                                <div class="cart-plus-minus">
                                                    <?php
                                                     if($checkProdstock){
                                                    ?>
                                                    <input type="text" min="1" max="<?php echo $stock_left;?>" value="<?php echo $cart['prod_quant'] ?>" data-product_id="<?php echo $cart['productid']; ?>" name="qtybutton" class="cart-plus-minus-box cart_quantity">
                                                    <?php
                                    }
                                    else{
                                                    ?>
                                                    
                                                     <input type="text" min="1" max="<?php echo $cart['max-quantity'];?>" value="<?php echo $cart['prod_quant'] ?>" data-product_id="<?php echo $cart['productid']; ?>" name="qtybutton" class="cart-plus-minus-box cart_quantity">
                                                    
                                                    <?php
                                    }
                                                    ?>

                                                </div>
                                            </td>
                                            <?php
                                            $producttotal = '';
                                            $producttotal = $cart['prod_quant'] * $cart['price'];
                                            ?>
                                            <td class="cart-product-subtotal"><span>&#8377 </span><?php echo $producttotal; ?></td>
                                        </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                    <div class="shoping-cart-total mt-50">
                        <h4>Cart Totals</h4>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Cart Subtotal</td>
                                    <?php
                                    if ($_SESSION["add-to-cart"]) {
                                        $carttotal = 0;
                                        foreach ($_SESSION["add-to-cart"] as $key => $cart) {
                                            $carttotal = $carttotal + ($cart['prod_quant'] * $cart['price']);
                                        }
                                    }
                                    ?>
                                    <td><span>&#8377 </span><?php echo $carttotal; ?></td>
                                </tr>
                                <tr>
                                    <td>Shipping and Handing</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td>Vat</td>
                                    <td>0</td>
                                </tr>
                                <tr>
                                    <td><strong>Order Total</strong></td>
                                    <td><strong><span>&#8377 </span><?php echo $carttotal; ?></strong></td>
                                </tr>
                            </tbody>
                        </table>
                        <div class="btn-wrapper text-right">
                            <?php if (!isset($_SESSION['authenticated'])) { ?>
                                <a id="checkoutbtn" class="theme-btn-1 btn btn-effect-1">Proceed to checkout</a>
                            <?php
                            } else {
                            ?>
                                <a href="checkout" id="checkoutbtn" class="theme-btn-1 btn btn-effect-1">Proceed to checkout</a>
                            <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="myModal" class="modal">

    <!-- Modal content -->
    <div class="modal-content">
        <span class="close">&times;</span>
        <form action="" class="" method="POST" onsubmit="return validateForm()">
            <input class="" type="text" id="email" name="email" name="email" placeholder="Email*">
            <input class="" type="password" id="password" name="password" name="password" placeholder="Password*">
            <p style="display:none; color:red;" id="pass_err">Password must contain of 1 uppercase character,1 lowercase character, 1 digit,1 special character, and minimum length of 8 characters.</p>

            <label class="checkbox-inline">
                <input type="checkbox" onclick="showPassword()">Show Password

            </label>
            <div class="btn-wrapper">
                <button name="checkout-login" type="submit" class="theme-btn-1 btn reverse-color btn-block" type="submit">LOGIN</button>
            </div>
        </form>
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
<!-- CALL TO ACTION END -->

<script>
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

    $(document).on('click', '.qtybutton', function() {
        var product_quantity = $(this).closest('.cart-plus-minus').find('.cart_quantity').val();
        var productid = $(this).closest('.cart-plus-minus').find('.cart_quantity').data('product_id');

        $.ajax({
            url: "codes/add-to-cart.php",
            method: "post",
            data: {
                product_quantity: product_quantity,
                productid: productid,
                action: 'update-cart'
            },
            success: function(data) {
                if (data = 'success') {
                    location.reload();
                }
            }
        });

    });


    
</script>

<?php
include('inc/footer.php');
?>
<?php
include('../config/app.php');
include('../controllers/AuthenticationController.php');
$authenticated = new AuthenticationController;
$authenticated->admin();
include_once('controllers/CategoryController.php');
include_once('controllers/ProductController.php');
include('controllers/AdminController.php');
include('inc/header.php');
include('inc/sidebar.php');
?>
<style>
    .form-group input[type=file] {
        position: unset;
        opacity: 1;
    }

    .form-check input[type="checkbox"],
    .radio input[type="radio"] {
        visibility: visible;
        opacity: 1;
    }
    .multiple-boxes{
        list-style: none;
    }
      .multiple-boxes li{
          border-bottom: 1px solid #d9d9d9;
    padding: 6px 0;
      }
    .listchecks{
        margin-right:15px;
    }
</style>
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <?php
    $products = new ProductController;
    if (isset($_GET['id'])) {
        $id = validateInput($db->conn, $_GET['id']);
    }
    $result = $products->edit($id);
    if ($result) {
    ?>
        <form action="codes/product.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">

                            <button type="submit" name="update_product" class="btn btn-primary pull-right">SAVE</button>
                            <h4 class="card-title"> Update Product</h4>
                            <?php include('../message.php'); ?>
                            <!-- Button trigger modal -->
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Product Name</label>
                                                <input type="hidden" class="form-control" value="<?php echo $result['id'] ?>" name="productid">
                                                <input type="text" class="form-control" value="<?php echo $result['name'] ?>" name="prod_name" id="productname">
                                                <small style="display:none; color:red;" id="product_name_err">Product Name can't be empty.</small>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>URL</label>
                                                <input type="text" onchange="convertTourl()" value="<?php echo $result['url'] ?>" class="form-control" name="prod_url" id="producturl">
                                                <small style="display:none; color:red;" id="product_url_err">Product Name can't be empty.</small>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Description</label>
                                                <textarea name="long_description" id="summernote" cols="30" rows="10"><?php echo $result['long_desc'] ?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label>Short Description</label>
                                                <textarea class="form-control" name="short_description" cols="50" rows="10"><?php echo $result['short_decs'] ?></textarea>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Pricing </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sale Price</label>
                                        <input type="number" name="sale_price" value="<?php echo $result['price'] ?>" class="form-control" id="productprice">
                                        <small style="display:none; color:red;" id="product_price_err">Product Price can't be empty.</small>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Regular Price</label>
                                        <input type="number" value="<?php echo $result['regular_price'] ?>" name="regular_price" class="form-control" id="regular_price">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Inventory </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>SKU</label>
                                        <input type="text" value="<?php echo $result['sku'] ?>" name="prod_sku" class="form-control" id="productsku">

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Stock Quantity</label>
                                        <input type="number" value="<?php echo $result['quantity'] ?>" name="prod_qty" class="form-control" id="productstock">
                                        <small style="display:none; color:red;" id="product_quantity_err">Product Quantity can't be empty.</small>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Images </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Main Image</label>
                                        <input type="file" name="main_img" id="productimage">
                                        <small style="display:none; color:red;" id="product_img_err">Product Image can't be empty.</small>
                                        <img style="width:60px;" src="assets/product-images/<?php echo $result['image'] ?>" alt="">
                                    </div>
                                </div>
                                <div class="col-md-12 ">
                                    <div class="form-group">
                                        <label>Image 1</label>
                                        <input type="file" name="prod_img1" id="">
                                        <?php if (!empty($result['image_one'])) {
                                        ?>
                                            <img style="width:60px;" src="assets/product-images/<?php echo $result['image_one'] ?>" alt="">
                                        <?php
                                        } ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Image 2</label>
                                        <input type="file" name="prod_img2" id="">
                                        <?php if (!empty($result['image_two'])) {
                                        ?>
                                            <img style="width:60px;" src="assets/product-images/<?php echo $result['image_two'] ?>" alt="">
                                        <?php
                                        } ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Image 3</label>
                                        <input type="file" name="prod_img3" id="">
                                        <?php if (!empty($result['image_three'])) {
                                        ?>
                                            <img style="width:60px;" src="assets/product-images/<?php echo $result['image_three'] ?>" alt="">
                                        <?php
                                        } ?>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Image 4</label>
                                        <input type="file" name="prod_img4" id="">
                                        <?php if (!empty($result['image_four'])) {
                                        ?>
                                            <img style="width:60px;" src="assets/product-images/<?php echo $result['image_four'] ?>" alt="">
                                        <?php
                                        } ?>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Video URL</label>
                                        <input type="text" class="form-control" name="prod_video" id="">
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Search engine optimization </h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Page title</label>
                                        <input type="text" name="prod_title" value="<?php echo $result['title'] ?>" class="form-control" id="">

                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Meta description</label>
                                        <textarea class="form-control" name="prod_meta_desc" id="" cols="30" rows="10"><?php echo $result['meta_description'] ?></textarea>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"> Visibility </h4>
                        </div>
                        <div class="card-body">
                            <div class="form-check">
                                <?php if ($result['status'] == 0) { ?>
                                    <input class="form-check-input" name="visibility" type="radio" checked value="0" id="">
                                <?php
                                } else {
                                ?>
                                    <input class="form-check-input" name="visibility" type="radio" value="0" id="">
                                <?php
                                }
                                ?>
                                <label class="form-check-label" for="">
                                    Publish
                                </label>
                            </div>
                            <div class="form-check">
                                <?php if ($result['status'] == 1) { ?>
                                    <input class="form-check-input" name="visibility" type="radio" checked value="1" id="">
                                <?php
                                } else {
                                ?>
                                    <input class="form-check-input" name="visibility" type="radio" value="1" id="">
                                <?php
                                }
                                ?>
                                <label class="form-check-label" for="">
                                    Hidden
                                </label>
                            </div>


                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Tags</h4>
                            <select name="sale_tag" class="form-control" id="">
                                <?php if ($result['sale_tag'] == 'featured') { ?>
                                    <option value="featured">Featured Products</option>
                                <?php
                                }
                                ?>
                                <?php if ($result['sale_tag'] == 'bestselling') { ?>
                                    <option value="bestselling">Best Selling Products</option>
                                <?php
                                }
                                ?>
                                <?php if ($result['sale_tag'] == 'trending') { ?>
                                    <option value="trending">Trending Products</option>
                                <?php
                                }
                                ?>
                                <option value="featured">Featured Product</option>
                                <option value="bestselling">Best Selling Product</option>
                                <option value="trending">Trending Product</option>
                            </select>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"> Category </h4>
                        </div>
                        <div class="card-body">
                            <!-- <select name="category_id[]" class="form-control" id="" multiple> -->
                            <!-- <option value="">Select Category</option> -->
                           
                           
                         
                            <?php 
                            $category= new CategoryController;
                    $categoryList = $category->fetchCategoryTreeww();
                    // print_r($categoryList);
                    ?>
                  
                    <ul class="multiple-boxes">
                    <?php
                     $categorynameedit = $products->getCategoryIdprod($result['id']);
                    //  print_r($categorynameedit);
                    //       if ($categorynameedit) {
                    // foreach ($categorynameedit as $catname) { 
                        
                        
                    // } 
                    //       }
                    foreach($categoryList as $cl) {
                      
                    ?>
                    
                      <li><span class="listchecks"><?php echo $cl["name"];?></span><input name="category_id[]"  value="<?php echo $cl["id"] ?>" type="checkbox" <?php if(in_array($cl["id"], $categorynameedit)) echo "checked = 'checked'"; ?>></li>
                    <?php 
                                    
                                
                            
                            }
                    ?>
                    </ul>
    
                          
                        </div>
                    </div>

                </div>
            </div>
        </form>
    <?php
    }
    ?>
</div>

<script>
   
    $(".checkboxes-form").click(function() {
        $(this).removeAttr('checked');
    });

    function validate() {
        let productname = document.getElementById("productname").value;
        let producturl = document.getElementById("producturl").value;
        let productprice = document.getElementById("productprice").value;
        let productimage = document.getElementById("productimage").value;
        let productstock = document.getElementById("productstock").value;
        if (productname != '' && producturl != '' && productprice != '' && productimage != '' && productstock != '') {
            document.getElementById("product_name_err").style.display = 'none';
            document.getElementById("product_url_err").style.display = 'none';
            document.getElementById("product_price_err").style.display = 'none';
            document.getElementById("product_img_err").style.display = 'none';
            document.getElementById("product_quantity_err").style.display = 'none';
            return true;
        } else {
            document.getElementById("product_name_err").style.display = 'block';
            document.getElementById("product_url_err").style.display = 'block';
            document.getElementById("product_price_err").style.display = 'block';
            document.getElementById("product_img_err").style.display = 'block';
            document.getElementById("product_quantity_err").style.display = 'block';
            return false;
        }
    }

    function convertTourl() {
        var a = document.getElementById("producturl").value;
        var b = a.toLowerCase().replace(/ /g, '-')
            .replace(/[^\w-]+/g, '');
        document.getElementById("producturl").value = b;
    }
</script>

<?php
include('inc/footer.php');
?>
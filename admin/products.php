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
    #catname_err {
        display: none;
        color: red;
    }

    #caturl_err {
        display: none;
        color: red;
    }
</style>
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Products</h4>
                    <?php include('../message.php'); ?>
                    <!-- Button trigger modal -->
                    <a href="<?php base_url('admin/add-products.php') ?>" class="btn btn-primary">
                        Add Product
                    </a>

                </div>
                <div class="card-body">
                     <form class="pull-right" method="POST" action="codes/export-orders.php">
                        <div class="form-group">
                        <select class="form-control" required name="file_type">
                            <option>--Export--</option>
                            <option value="csv">CSV</option>
                            <option value="xlsx">XLSX</option>
                            <option value="xls">XLS</option>
                        </select>
                        </div>
                          <div class="form-group">
                    <button type="submit" name="exportproducts" class="btn btn-secondary btn-sm pull-right">Export</button>
                     </div>
                    </form>
                    <div class="table-responsive">
                        <?php
                        $products = new ProductController;
                        $result = $products->index();
                        ?>
                        <table class="table" id="myproductTable">
                            <thead class=" text-primary">
                                <th>Sr No.</th>
                                <th>Name</th>
                                <th>Stock</th>
                                <th>Image</th>
                                <th>Category</th>
                                <th>Publish date</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php
                                if ($result) {
                                    $count = 1;
                                    foreach ($result as $row) {
                                    $checkStock = $products->checkStockunit($row['id']);
                                    // print_r($checkStock);
                                    if($checkStock){
                                     $remain_qty =  $checkStock;
                                    }
                                   $qty_left = $row['quantity'] - $remain_qty;
                                ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td>
                                                <p><?php echo $row['name'] ?></p>
                                                <small><strong> SKU: <?php echo $row['sku'] ?> </strong></small>
                                                <?php
                                                if($row['status'] == '0'){
                                                    echo "<span style='color:green;'>Published</span>";
                                                }
                                                    else{
                                                        echo "<span style='color:red;'>Not Published</span>";
                                                    
                                                }
                                                ?>
                                                
                                            
                                            </td>
                                            <td>
                                                <?php
                                                 if($checkStock){
                                                ?>
                                               <span class='badge badge-warning'>Stock left <?php echo $qty_left;?></span>
                                               <?php
                                                 }
                                               ?><br>
                                             
                                                <?php
                                                if ($row['quantity'] > 0) {
                            echo "<span class='badge badge-success'>Total stock ".$row['quantity']."</span>";
                                                } else {
                                                    echo "<span class='badge badge-danger'>Out Of Stock</span>";
                                                }
                                                ?>
                                            </td>
                                            <td><img style="width:60px; border-radius:10px;" src="assets/product-images/<?php echo $row['image'] ?>"></td>
                                            <td>
                                                <?php $categoryname = $products->getCategoryname($row['id']);
                                                if ($categoryname) {
                                                    foreach ($categoryname as $catname) {

                                                ?>
                                                        <span class="badge badge-info"><?php echo $catname['category_name']; ?></span>
                                                <?php

                                                    }
                                                }
                                                ?>
                                            </td>
                                            <td><?php echo date("m-d-Y", strtotime($row["added_on"])) ?> </td>
                                            <td style="display:flex;">
                                                <a class="btn btn-success mx-3" href="edit-products.php?id=<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></a>
                                                <form action="codes/product.php" method="POST" onsubmit="return confirmDelete();">
                                                    <input type="hidden" value="<?php echo $row['id'] ?>" name="productid">
                                                    <button class="btn btn-danger" name="deleteprodid"><i class="fa fa-trash-alt"></i></button>
                                                </form>
                                            </td>

                                        </tr>
                                <?php
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
</div>

<script>
    function confirmDelete() {
        var txt;
        if (confirm("Are You Sure Want To Delete?")) {
            return true;
        } else {
            return false;
        }
    }

    $(document).ready(function() {
        $('#myproductTable').DataTable();
    });
    
   
</script>

<?php
include('inc/footer.php');
?>
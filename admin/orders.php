<?php
include('../config/app.php');
include('../controllers/AuthenticationController.php');
$authenticated = new AuthenticationController;
$authenticated->admin();
include_once('controllers/CategoryController.php');
include_once('controllers/ProductController.php');
include('controllers/AdminController.php');
include_once('controllers/OrderController.php');
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

    .fa-ellipsis-h {
        transform: rotate(90deg);
    }
    
    .order_status_btn{
        display:none;
    }
</style>
<div class="panel-header panel-header-sm">
</div>
<div class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"> Orders</h4>
                    <?php include('../message.php'); ?>
                    <!-- Button trigger modal -->


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
                    <button type="submit" name="export" class="btn btn-secondary btn-sm pull-right">Export</button>
                     </div>
                    </form>
                    <div class="table-responsive">
                        <?php
                        $orders = new OrderController;
                        $result = $orders->index();
                        ?>
                        <table class="table" id="myproductTable">
                            <thead class=" text-primary">
                                <th>Order Number</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Payment Status</th>
                                <th>Status</th>
                                <th>Total</th>
                                <th>Action</th>
                                <th>Edit</th>
                            </thead>
                            <tbody>
                                <?php
                                if ($result) {

                                    foreach ($result as $row) {
                                ?>
                                        <tr>
                                            <td><?php echo $row['order_number'] ?></td>
                                            <td>
                                                <?php echo date("m-d-Y", strtotime($row["ordered_on"])) ?>
                                            </td>
                                            <td><?php echo $row['ship_firstname'] ?> <?php echo $row['ship_lastname'] ?>
                                            </td>
                                            <td><?php echo $row['payment_info']; ?> </td>
                                            <td><?php echo $row['status']; ?>
                                                <?php
                                                if ($row['status'] == 'Order Placed') {
                                                    echo "<span class='badge badge-info'>New</span>";
                                                }
                                                ?>
                                                 <?php
                                                if ($row['status'] == 'Delivered') {
                                                    echo "<span class='badge badge-success'>Delivered</span>";
                                                }
                                                ?>
                                                  <?php
                                                if ($row['status'] == 'Processing') {
                                                    echo "<span class='badge badge-primary'>Processing</span>";
                                                }
                                                ?>
                                                  <?php
                                                if ($row['status'] == 'Pending') {
                                                    echo "<span class='badge badge-warning'>Pending</span>";
                                                }
                                                ?>
                                                     <?php
                                                if ($row['status'] == 'Cancel') {
                                                    echo "<span class='badge badge-danger'>Cancel</span>";
                                                }
                                                ?>
                                            </td>
                                            <td>&#x20B9 <?php echo $row['total']; ?></td>
                                            <td><form class="order_status_form" method="POST" action="codes/orders.php">
                                            <input name="orderedid" type="hidden" value="<?php echo $row['id'] ?>">
                                                <select id="" name="order_status" class="form-control orderedstatus">
                                            <option value="">Status</option>
                                             <option value="Delivered">Delivered</option>
                                             <option value="Pending">Pending</option>
                                             <option value="Processing">Processing</option>
                                             <option value="Cancel">Cancel</option>
                                                </select>
                                                <button type="submit" name="updateOrderstatus" class="btn btn-info order_status_btn">Update</button>
                                            </form></td>
                                            <td style="display:flex;">
                                                <a class=" mx-3" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-ellipsis-h"></i></a>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                    <a class="dropdown-item" href="edit-order.php?id=<?php echo $row['id']?>">Edit</a>
                                                    <!-- <a class="dropdown-item" href="#">Another action</a> -->
                                                </div>
                                            </td>

                                        </tr>
                                <?php

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

 $(document).on('change', '.orderedstatus', function() {
      var btnstatus = $(this).closest('.order_status_form').find('.order_status_btn');
      btnstatus.show();
      
 });

  $(document).on('click', '.order_status_btn', function() {
        var status = $(this).closest('.order_status_form').find('.orderedstatus').val();
        // alert(status);
      if(status == 'Delivered'){
              if (confirm("By clicking OK you are agreed that you have received the payment")) {
            return true;
        } else {
            return false;
        }
        }
        else if(status == 'Cancel'){
                  if (confirm("Are Yo sure want to cancel this order")) {
            return true;
        } else {
            return false;
        } 
        }
        else if(status == ''){
          alert("Please Select a value");
             return false;
        }
        else{
            return true;
        }
        
        // if(status == 'Delivered'){
        //     alert("bhdj");
        //     if (confirm("Are You Sure Want To Delete?")) {
        //     return true;
        // } else {
        //     return false;
        // }
        // }
    });

  
    function confirmDelete() {
        var txt;
        if (confirm("Are You Sure Want To Delete?")) {
            return true;
        } else {
            return false;
        }
    }

    $(document).ready(function() {
        $('#myproductTable').DataTable({
            "ordering": false
        });
    });
    
  
</script>

<?php
include('inc/footer.php');
?>
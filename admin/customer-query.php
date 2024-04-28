<?php
include('../config/app.php');
include('../controllers/AuthenticationController.php');
$authenticated = new AuthenticationController;
$authenticated->admin();
include_once('controllers/CategoryController.php');
include_once('controllers/CustomerController.php');
include_once('controllers/CustomerqueryController.php');
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
                    <h4 class="card-title"> Customer Queries</h4>
                    <?php include('../message.php'); ?>
                    <!-- Button trigger modal -->
                    

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php
                        $customers_query = new CustomerqueryController;
                        $result = $customers_query->index();
                       
                        ?>
                        <table class="table" id="myproductTable">
                            <thead class=" text-primary">
                                <th>Sr No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>OrderId</th>
                                <th>Created At</th>
                                <th>Status</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php
                                if ($result) {
                                    $count = 1;
                                    foreach ($result as $row) {
                                ?>
                                        <tr>
                                            <td><?php echo $count; ?>
                                            <?php 
                                            if($row['status'] == 1){
                                                echo "<span class='badge badge-danger'>Not resolved</span>";
                                            }
                                            elseif($row['status'] == 2){
                                                echo "<span class='badge badge-warning'>Processed</span>"; 
                                            }
                                            else{
                                                 echo "<span class='badge badge-success'>Resolved</span>"; 
                                            }
                                            ?>
                                            </td>
                                            <td>
                                                <p><?php echo $row['customer_fame'] ?> <?php echo $row['customer_lname']?></p>
                                            </td>
                                            <td><?php echo $row['email']; ?>
                                            </td>
                                            <?php
                                        $getorderid = $customers_query->getOrderId($row['order_id']);
                                            ?>
                                           <td><a href="edit-order.php?id=<?php echo $getorderid?>"><?php echo $row['order_id'];?></a></td>
                                           <td>
                                               <form class="form-inline" action="codes/customerquery.php" method="POST">
                                                   <div class="form-group">
                                               <select name="query_status" class="form-control">
                                                   <option value="1">Not Resolved</option>
                                                   <option value="2">Processed</option>
                                                   <option value="3">Resolved</option>
                                               </select>
                                               <input type="hidden" name="queryid" value="<?php echo $row['id']?>">
                                               <button type="submit" name="queryupdate_btn" class="btn btn-primary">Update</button>
                                               </div>
                                               </form>
                                           </td>
                                            <td><?php echo date("m-d-Y", strtotime($row["created_at"])) ?> </td>
                                            <td style="display:flex;">
                                                <a class="btn btn-success mx-3" href="edit-customer-query.php?id=<?php echo $row['id'] ?>"><i class="fa fa-eye"></i></a>
                                                
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
  
    $(document).ready(function() {
        $('#myproductTable').DataTable();
    });
</script>

<?php
include('inc/footer.php');
?>
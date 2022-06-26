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
                    <?php include("message.php");?>
                    <h4 class="card-title"> Customer Queries
                    
                    </h4><span class="badge badge-danger">Not Resolved</span>
                    <?php include('../message.php'); ?>
                    <!-- Button trigger modal -->
                    

                </div>
                <div class="card-body">
                    <div class="">
                        <?php
                        
                    if (isset($_GET['id'])) {
                        $id = validateInput($db->conn, $_GET['id']);
                    }
                        $customers_query = new CustomerqueryController;
                        $result = $customers_query->getcurrentIdquery($id);
                       if($result){
                           foreach($result as $row){
                        ?>
                        <div class="col-lg-12">
                            <div class="row">
                                 <div class="col-lg-4">
                            <p>Customer Name: <?php echo $row['customer_fame'] . ' ' . $row['customer_lname']?></p>
                            </div>
                            <div class="col-lg-8">
                                <p>Query Message: <?php echo $row['message']?></p>
                            </div>
                            </div>
                              <div class="row">
                                 <div class="col-lg-4">
                            <p>OrderId: <?php echo $row['order_id'];?></p>
                            </div>
                             <div class="col-lg-4">
                            <p>Date: <?php echo $row['created_at'];?></p>
                            </div>
                            <div class="col-lg-4">
                                <p>Product Name: <?php echo $row['product_name']?></p>
                            </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <form  action="codes/customerquery.php" method="POST">
                                <div class="form-group mb-2 row">
                                    <label class="col-sm-2 col-form-label">From:</label>
                                     <div class="col-sm-10">
                                    <input required type="text" class="form-control" value="bh147ty@gmail.com" name="adminmail">
                                     </div>
                                </div>
                                <div class="form-group mb-2 row">
                                    <label class="col-sm-2 col-form-label">To:</label>
                                     <div class="col-sm-10">
                                    <input required type="text" class="form-control" value="<?php echo $row['email']?>" name="useremail">
                                    <input type="hidden" value="<?php echo $row['id']?>" name="queryid">
                                     </div>
                                </div>
                                 <div class="form-group mb-2 row">
                                    <label class="col-sm-2 col-form-label">Subject</label>
                                     <div class="col-sm-10">
                                    <input required type="text" class="form-control"  name="subject">
                                     </div>
                                </div>
                                <div class="form-group ">
                                    <label>Message</label>
                                    <textarea required name="message" id="summernote"></textarea>
                                </div>
                                 <div class="form-group ">
                                  <button name="query_reply" class="btn btn-primary" type="submit">Send</button>
                                </div>
                            </form>
                        </div>
                        <?php
                           }
                       }
                        ?>
                  
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
    
      $('#summernote').summernote({
        placeholder: 'Product Description',
        tabsize: 2,
        height: 100
      });

</script>

<?php
include('inc/footer.php');
?>
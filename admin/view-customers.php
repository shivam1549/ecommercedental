<?php
include('../config/app.php');
include('../controllers/AuthenticationController.php');
$authenticated = new AuthenticationController;
$authenticated->admin();
include_once('controllers/CategoryController.php');
include_once('controllers/CustomerController.php');
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
                    <h4 class="card-title"> Users</h4>
                    <?php include('../message.php'); ?>
                    <!-- Button trigger modal -->
                    

                </div>
                <div class="card-body">
                    <div class="">
                        <?php
                        if(isset($_GET['id'])){
                        $id = validateInput($db->conn, $_GET['id']);
                        $customers = new CustomerController;
                        $result = $customers->getCustomerByid($id);
                        }
                        if($result){
                        ?>
                        <div class="row">
                        <div class="col-lg-6">
                            <h4>Name:</h4> <span><?php echo $result['user_name']?> <?php echo $result['last_name']?></span>
                            <h4>Email:</h4> <span><?php echo $result['email']?></span>
                            <h4>Phone:</h4> <span><?php echo $result['phone']?></span>
                        </div>

                        <div class="col-lg-6">
                            <h4>Address:</h4><span><?php echo $result['address1']?></span>
                            <h4>Address2</h4><span><?php echo $result['address2']?></span>
                            <h4>City:</h4><span><?php echo $result['city']?></span>
                            <h4>State:</h4><span><?php echo $result['zone']?></span>
                            <h4>Country</h4><span><?php echo $result['country']?></span>
                            <h4>Zip:</h4><span><?php echo $result['zip']?></span>
                        </div>
                        </div>
                        <?php
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
</script>

<?php
include('inc/footer.php');
?>
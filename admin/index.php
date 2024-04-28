<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
include('../config/app.php');
include('../controllers/AuthenticationController.php');
include('codes/auth-code.php');
include('controllers/AdminController.php');

$authenticated = new AuthenticationController;
$authenticated->admin();
include('inc/header.php');
include('inc/sidebar.php');
?>
<style>
    .panel-header{
        height:154px;
    }
</style>
<div class="panel-header">
        <!--<canvas id="bigDashboardChart"></canvas>-->
      </div>
      <div class="content">
        <div class="row">
          <div class="col-lg-4">
            <div class="card card-chart">
              <div class="card-header">
                <h4 class="card-title">Shipped Products</h4>
               
              </div>
              <div class="card-body">
                <div class="">
                <?php
                $productsdata = new AdminController;
                $tot_shippped_products = $productsdata->shippedProducts();
                // print_r($tot_shippped_products);
                if($tot_shippped_products){
                ?>
            
                <h2><?php echo $tot_shippped_products;?></h2>
                <?php
                }
                else{
                ?>
                <h2>No Data Found</h2>
                <?php
                }
                ?>
                </div>
              </div>
              
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="card card-chart">
              <div class="card-header">
                
                <h4 class="card-title">Live products</h4>
             
              </div>
              <div class="card-body">
                <div class="">
              <?php
                $totproducts = $productsdata->getAllproducts();
                // print_r($tot_shippped_products);
                if($totproducts){
                ?>
            
                <h2><?php echo $totproducts;?></h2>
                <?php
                }
                else{
                ?>
                <h2>No Data Found</h2>
                <?php
                }
                ?>
                </div>
              </div>
            
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="card card-chart">
              <div class="card-header">
                <h4 class="card-title">Total Orders</h4>
              </div>
               <div class="card-body">
                <div class="">
              <?php
                $totorders = $productsdata->gettotalOrders();
                // print_r($tot_shippped_products);
                if($totorders){
                ?>
            
                <h2><?php echo $totorders;?></h2>
                <?php
                }
                else{
                ?>
                <h2>No Data Found</h2>
                <?php
                }
                ?>
                </div>
              </div>
              
            </div>
          </div>
        </div>
        <div class="row">
   
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h4 class="card-title"> New Orders List</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table">
                    <thead class=" text-primary">
                      <th>
                       Id
                      </th>
                      <th>
                     Customer Name
                      </th>
                      <th>
                        Total
                      </th>
                      <th >
                        Payment
                      </th>
                      <th>
                          Action
                      </th>
                    </thead>
                    <tbody>
                        <?php
                $newOrders = new AdminController;
                $neworders = $newOrders->getNeworders();
                if($neworders){
                    foreach($neworders as $orders){
                        ?>
                        <tr>
                          <td><?php echo $orders['order_number']?></td>  
                           <td><?php echo $orders['ship_firstname'] . ' ' . $orders['ship_lastname']?></td> 
                           <td>Rs.<?php echo number_format($orders['total'],2) ?></td>
                           <td><?php echo $orders['payment_info']?></td>
                           <td><a href="edit-order.php?id=<?php echo $orders['id']?>">Edit</a></td>
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
<?php
include('inc/footer.php');

?>
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
                    <div class="table-responsive">
                        <?php
                        $customers = new CustomerController;
                        $result = $customers->index();
                        ?>
                        <table class="table" id="myproductTable">
                            <thead class=" text-primary">
                                <th>Sr No.</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php
                                if ($result) {
                                    $count = 1;
                                    foreach ($result as $row) {
                                ?>
                                        <tr>
                                            <td><?php echo $count; ?></td>
                                            <td>
                                                <p><?php echo $row['user_name'] ?> <?php echo $row['last_name']?></p>
                                            </td>
                                            <td><?php echo $row['email']; ?>
                                            </td>
                                            <?php if($row['role_as'] == '0'){ ?>
                                                <td>User</td>
                                                <?php
                                            }
                                            else{
                                            ?>
                                                <td>Admin</td>
                                            <?php
                                            }
                                            ?>
                                            <td><?php echo date("m-d-Y", strtotime($row["created_at"])) ?> </td>
                                            <td style="display:flex;">
                                                <a class="btn btn-success mx-3" href="view-customers.php?id=<?php echo $row['id'] ?>"><i class="fa fa-eye"></i></a>
                                                
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
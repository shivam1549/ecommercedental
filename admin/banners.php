<?php
include('../config/app.php');
include('../controllers/AuthenticationController.php');
$authenticated = new AuthenticationController;
$authenticated->admin();
include_once('controllers/BannerController.php');
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
</style>
<div class="panel-header panel-header-sm">
</div>
<div class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title"> Banner</h4>
          <?php include('../message.php'); ?>
          <!-- Button trigger modal -->
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Add Banner
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Create Banner</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form action="codes/banner-code.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" required name="banner_name" class="form-control" id="bannername" placeholder="Enter banner Name">

                    </div>
                    <div class="form-group">
                      <label>Heading</label>
                      <input type="text" name="banner_heading" id="banner_heading" class="form-control">

                    </div>

                    <div class="form-group">
                      <label>Button text</label>
                      <input type="text" required name="bannerbtn_text" id="bannerbtn_text" class="form-control">

                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea type="text" name="banner_description" id="banner_description" cols="10" rows="10" class="form-control"></textarea>

                    </div>

                    <div class="form-group">
                      <label>Image</label>
                      <input type="file" id="banner_img" name="banner_img" required>
                    </div>

                    <div class="form-group">
                      <label>Link</label>
                      <input type="text" name="banner_url" id="slug-source" class="form-control" placeholder="URL">

                    </div>
                    <button type="submit" name="add_banner" class="btn btn-primary">Submit</button>
                  </form>
                </div>

              </div>
            </div>
          </div>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <?php

            ?>
            <table class="table" id="myTable">
              <thead class=" text-primary">
                <th>
                  Sr.No
                </th>
                <th>
                  Name
                </th>
                <th>image</th>
                <th>
                  Action
                </th>
              </thead>
              <tbody>
                <?php
                $banner = new BannerController;
                $result = $banner->index();
                if ($result) {
                  $count = 1;
                  foreach ($result as $row) {
                ?>
                    <tr>
                      <td><?php echo $count; ?></td>
                      <td><?php echo $row['name']; ?></td>
                      <td> <img style="width:100px" src="assets/product-images/<?php echo $row['image']; ?>" alt=""> </td>
                      <td style="display:flex;">
                        <a class="btn btn-success mx-3" href="edit-banners.php?id=<?php echo $row['id'] ?>"><i class="fa fa-edit"></i></a>
                        <!-- <form action="codes/banner-code.php" method="POST" onsubmit="return confirmDelete();">
                          <input type="hidden" value="<?php echo $row['id'] ?>" name="productid">
                          <button class="btn btn-danger" name="deleteprodid"><i class="fa fa-trash-alt"></i></button>
                        </form> -->
                      </td>
                    </tr>
                  <?php
                    $count++;
                  }
                } else {
                  ?>
                  <tr>Not Found</tr>
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
    $('#myTable').DataTable();
  });
</script>

<?php
include('inc/footer.php');
?>
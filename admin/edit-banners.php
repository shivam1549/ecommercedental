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
          <h4 class="card-title">Edit Banner</h4>
          <?php include('../message.php'); ?>
          <!-- Button trigger modal -->
          <!-- <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
            Add Banner
          </button> -->

        </div>
        <div class="card-body">
            <?php
                    if (isset($_GET['id'])) {
                        $id = validateInput($db->conn, $_GET['id']);
                    }
                    $banner = new BannerController;
                    $result = $banner->edit($id);
                    if ($result) {
            ?>
        <form action="codes/banner-code.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <label>Name</label>
                      <input type="text" required name="banner_name" value="<?php echo $result['name']?>" class="form-control" id="bannername" placeholder="Enter banner Name">

                    </div>
                    <div class="form-group">
                      <label>Heading</label>
                      <input type="text" value="<?php echo $result['heading']?>" name="banner_heading" id="banner_heading" class="form-control">

                    </div>

                    <div class="form-group">
                      <label>Button text</label>
                      <input type="text" value="<?php echo $result['text']?>" required name="bannerbtn_text" id="bannerbtn_text" class="form-control">

                    </div>
                    <div class="form-group">
                      <label>Description</label>
                      <textarea type="text" name="banner_description" id="banner_description" cols="10" rows="10" class="form-control"><?php echo $result['description']?></textarea>

                    </div>

                    <div class="form-group">
                      <label>Image</label>
                      <input type="file" id="banner_img" name="banner_img" >
                    </div>

                    <div class="img-box" style="width:200px">
                        <img style="width:100%" src="assets/product-images/<?php echo $result['image']?>" alt="">
                    </div>

                    <div class="form-group">
                      <label>Link</label>
                      <input type="text" value="<?php echo $result['link']?>" name="banner_url" id="slug-source" class="form-control" placeholder="URL">
                      <input type="hidden" name="banner_id" value="<?php echo $result['id']?>">
                    </div>
                    <button type="submit" name="update_banner" class="btn btn-primary">Update</button>
                  </form>
                  <?php
                    }
                  ?>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
include('inc/footer.php');
?>
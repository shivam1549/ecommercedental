<?php
include('../config/app.php');
include('../controllers/AuthenticationController.php');
$authenticated = new AuthenticationController;
$authenticated->admin();
include_once('controllers/CategoryController.php');
include_once('controllers/SubcategoryController.php');
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
                    <h4 class="card-title"> Categories</h4>
                    <?php include('../message.php'); ?>
                    <!-- Button trigger modal -->
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <?php
                        if (isset($_GET['id'])) {
                            $id = validateInput($db->conn, $_GET['id']);
                        }
                        $subcategories = new SubcategoryController;
                        $result = $subcategories->edit($id);

                        if ($result) {
                        ?>
                            <form action="codes/subcategory-code.php" method="POST" onsubmit="return Validate()">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="hidden" name="subcategory_id" value="<?php echo $result['id'] ?>">
                                    <input type="text" value="<?php echo $result['name'] ?>" name="subcategory_name" class="form-control" id="catname" placeholder="Enter Category Name">
                                    <small class="invalid-error" id="catname_err">Can Not be empty</small>
                                </div>
                                <div class="form-group">
                                    <label>Parent Category</label>
                                    <select name="parent_category" class="form-control" id="">
                                        <?php
                                        $categories = new CategoryController;
                                        $getcatname = $categories->categoryname($result['id']);
                                        if ($getcatname) {
                                        ?>
                                            <option value="<?php echo $result['id']; ?>"><?php echo $getcatname['cat_name']; ?></option>
                                            <?php
                                        }
                                        $getcategory = $categories->index();

                                        if ($getcategory) {
                                            foreach ($getcategory as $category) {
                                            ?>
                                                <option value="<?php echo $category['id']; ?>"><?php echo $category['cat_name'] ?></option>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label>URL</label>
                                    <input type="text" value="<?php echo $result['url'] ?>" name="subcategory_url" onchange="convertTourl()" id="slug-source" class="form-control" placeholder="URL">
                                    <small class="invalid-error" id="caturl_err">Can Not be empty</small>
                                </div>
                                <div class="form-group">
                                    <label>Description</label>
                                    <textarea name="description" class="form-control" id="" cols="10" rows="10"><?php echo $result['description'] ?></textarea>
                                </div>
                                <button type="submit" name="update_subcategory" class="btn btn-primary">Update</button>
                            </form>
                        <?php
                        } else {
                        ?>
                            <h4>Not Found</h4>
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
        $('#myTable').DataTable();
    });

    function Validate() {
        let catname = document.getElementById("catname").value;
        let caturl = document.getElementById("slug-source").value;
        let catname_err = document.getElementById("catname_err");
        let caturl_err = document.getElementById("caturl_err");
        if (catname != '' && caturl != '') {
            caturl_err.style.display = "none";
            catname_err.style.display = "none";
            return true;
        } else {
            catname_err.style.display = "block";
            caturl_err.style.display = "block";
            return false;
        }
    }

    function convertTourl() {

        var a = document.getElementById("slug-source").value;

        var b = a.toLowerCase().replace(/ /g, '-')
            .replace(/[^\w-]+/g, '');

        document.getElementById("slug-source").value = b;
    }
</script>

<?php
include('inc/footer.php');
?>
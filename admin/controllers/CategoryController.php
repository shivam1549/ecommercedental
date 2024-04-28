<?php
class CategoryController
{
    public function __construct()
    {
        $db = new Databaseconnection;
        $this->conn = $db->conn;
    }

    public function create($inputdata)
    {
        $data = "'" . implode("','", $inputdata) . "'";
        // echo $data;
       $categoryQuery = "INSERT INTO category (parent_id ,cat_name, cat_url, cat_description, created_on) VALUES ($data)";
        $result = $this->conn->query($categoryQuery);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
    
//     public function fetchCategoryTree($parent = 0, $spacing = '', $user_tree_array = '') {
//   if (!is_array($user_tree_array))
//     $user_tree_array = array();
//   $sql = "SELECT id, cat_name, cat_url FROM category WHERE parent_id = '$parent' ORDER BY id ASC";
//     $query = $this->conn->query($sql);
//   if ($query->num_rows > 0) {
//     while ($row = fetch_assoc($query)) {
//       $user_tree_array[] = array("id" => $row->id, "name" => $spacing . $row->cat_name);
//       $user_tree_array = fetchCategoryTree($row->id, $spacing . '&nbsp;&nbsp;', $user_tree_array);
//     }
//   }
//   return $user_tree_array;
// } 

public function fetchCategoryTreeww($parent = 0, $spacing = '', $user_tree_array = '') {
  if (!is_array($user_tree_array)){
    $user_tree_array = array();
  }
	 $sqlquery = "SELECT * FROM category WHERE parent_id = '$parent' ORDER BY id ASC";
     $query = $this->conn->query($sqlquery);
     if ($query->num_rows > 0) {
    foreach($query as $row){
	
      $user_tree_array[] = array("id" => $row['id'], "name" => $spacing . $row['cat_name']);
      $user_tree_array = $this->fetchCategoryTreeww($row['id'], $spacing . '&nbsp;&nbsp;', $user_tree_array);
    }
  }
  return $user_tree_array;
}


public function fetchCategoryTreeList($parent = 0, $user_tree_array = '') {
    if (!is_array($user_tree_array)){
    $user_tree_array = array();
    }
    
  $sql = "SELECT id, cat_name, status, cat_url FROM category WHERE parent_id = '$parent' ORDER BY id DESC";
    $query = $this->conn->query($sql);
    // print_r($query);
   if ($query->num_rows > 0) {
     $user_tree_array[] = "<ul class='category-list'>";
foreach($query as $row){
    // print_r($row);

         $user_tree_array[] .= "<li class='category-list-items'>"."<p>". $row['cat_name']."</p>". '<form onsubmit="return confirmDelete()" action="codes/category-code.php" class="form-inline" method="POST">'."<input type='hidden' value='".$row['id']."' name='categoryid'>"."<button class='btn btn-danger' name='deletecatid'><i class='fa fa-trash-alt'></i></button>"."</form>"."<a class='btn btn-success mx-3' href='edit-categories.php?id=".$row['id']."'><i class='fa fa-edit'></i></a>"."</form>".
         '<form action="codes/category-code.php" class="form-inline" method="POST">';
            if ($row['status'] == 0) {
                
               $user_tree_array[] .='
                <span class="badge badge-success">visible</span>
               ';   
            }
               if ($row['status'] == 1) {
                $user_tree_array[] .='
                  <span class="badge badge-danger">hidden</span>
               ';    
            }
               $user_tree_array[] .='
                 <input type="hidden" value="'.$row['id'].'" name="categoryid">
                          <div class="form-group mx-sm-3 mb-2">
                            <select name="showcategory" class="form-control" id="">
                              <option value="1">Hide</option>
                              <option value="0">show</option>
                            </select>
                          </div>
                          <button type="submit" name="update-status" class="btn btn-info">Update</button>
                </form>
               ';
          $user_tree_array[] .=
         "</li>";
         
        //  print_r($user_tree_array);
       $user_tree_array = $this->fetchCategoryTreeList($row['id'], $user_tree_array);
    }
    // print_r($user_tree_array);
    $user_tree_array[] = "</ul>";
     
  }
  return $user_tree_array;
}

    public function index(){
        $getCategories = "SELECT * FROM category";
        $result = $this->conn->query($getCategories);
        if ($result) {
            return $result;
        } else {
            return false;
        }
    }

    public function edit($id){
        $getCategories = "SELECT * FROM category WHERE id = '$id' LIMIT 1";
        $result = $this->conn->query($getCategories);
        if ($result->num_rows == 1) {
            $data = $result->fetch_assoc();
            return $data;
        } 
        else{
            return false;
        }
    }

    public function categoryname($id){
        $getcategoryname = "SELECT * FROM category WHERE id = '$id' LIMIT 1";
        $result = $this->conn->query($getcategoryname);
        if ($result->num_rows > 0) {
            $data = $result->fetch_assoc();
            return $data;
        } 
        else{
            return false;
        }
    }

    public function update($inputData, $category_id){
        $parent_category = $inputData['parent_category'];
        $name = $inputData['categoryname'];
        $cat_url =  $inputData['categoryurl'];
        $cat_description =  $inputData['categorydescription'];
        $updateCatgeory = "UPDATE category SET parent_id = '$parent_category', cat_name = '$name', cat_url ='$cat_url', cat_description = '$cat_description' WHERE id = '$category_id'";
        $result = $this->conn->query($updateCatgeory);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function delete($category_id){
        $deleteCategory = "DELETE FROM category WHERE id ='$category_id'";
        $result = $this->conn->query($deleteCategory);
        if ($result) {
            return true;
        } else {
            return false;
        }
        
    }

    public function showcategory($category_id, $categoryshow){
       $showCategory = "UPDATE category SET status = '$categoryshow' WHERE id = '$category_id'";
        $result = $this->conn->query($showCategory);
        // echo $result;
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function checkCategoryurlexist($categoryurl)
    {

        $counter = 1;
        $newLink = $categoryurl;
        do {
            $checkcategoryurlexist = "SELECT cat_url FROM category WHERE cat_url = '$newLink'";
            $result = $this->conn->query($checkcategoryurlexist);
            if ($result->num_rows > 0) {
                $newLink = $categoryurl . '-' . $counter;
                $counter++;
            } else {
                break;
            }
        } while (1);

        return $newLink;
    }
}

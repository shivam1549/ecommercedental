<?php
class CategoryController{
    public function __construct(){
        $db = new DatabaseConnection;
        $this->conn = $db->conn;
    }
    public function getCategory(){
        $sql ="SELECT * FROM category WHERE parent_id = '0' AND status ='0'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
        } 
        else{
            return false;
        }  
    }
    
    public function fetchCategoryTreeListmenu($parent) {
    $menu = "";
	$sqlquery = "SELECT * FROM category WHERE parent_id = '$parent' AND status ='0' ORDER BY id ASC";
     $query = $this->conn->query($sqlquery);
     if ($query->num_rows > 0) {
     foreach($query as $row){
	{
           $menu .="<li class='menu-icon'><a href='category.php?url=".$row['cat_url']."'>".$row['cat_name']."</a>";
		   
		   $menu .= "<ul>".$this->fetchCategoryTreeListmenu($row['id'])."</ul>"; //call  recursively
		   
 		   $menu .= "</li>";
 
    }
     } 
     }
  return $menu;

}

    public function mobilefetchCategoryTreeListmenu($parent) {
    $menu = "";
	$sqlquery = "SELECT * FROM category WHERE parent_id = '$parent' ORDER BY id ASC";
     $query = $this->conn->query($sqlquery);
     if ($query->num_rows > 0) {
     foreach($query as $row){
	{
           $menu .="<li><a href='category.php?url=".$row['cat_url']."'>".$row['cat_name']."</a>";
		   
		   $menu .= "<ul class='sub-menu'>".$this->mobilefetchCategoryTreeListmenu($row['id'])."</ul>"; //call  recursively
		   
 		   $menu .= "</li>";
 
    }
     } 
     }
  return $menu;

}
    
    public function getSubcategory($id){
        $sql ="SELECT * FROM category WHERE parent_id = '$id' AND status ='0'";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            return $result;
            print_r($result);
        } 
        else{
            return false;
        }  
    }


    public function getCategorybyurl($url){
        $sql = "SELECT id FROM category WHERE cat_url = '$url' LIMIT 1";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            $data = $result->fetch_assoc();
            return $data;
        } 
        else{
            return false;
        }
    }

    public function getCategorynameByid($id){
        $sql = "SELECT cat_name FROM category WHERE id = '$id' LIMIT 1";
        $result = $this->conn->query($sql);
        if($result->num_rows > 0){
            $data = $result->fetch_assoc();
            return $data;
        } 
        else{
            return false;
        }
    }
}
?>
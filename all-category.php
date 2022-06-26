<?php
$title = "Home";
include('config/app.php');
include('codes/authentication_code.php');
include('controllers/CategoryController.php');
include('controllers/ProductController.php');
include('controllers/BannerController.php');
include('inc/header.php');
?>

<style>


/* Fixed sidenav, full height */
.sidenav {
  height: 100%;
  width: 200px;
  position: fixed;
  z-index: 100;
  top: 80px;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

/* Style the sidenav links and the dropdown button */
.sidenav a, .dropdown-btn {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: #818181;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}

.dropdown-btn-1 {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 20px;
  color: #818181;
  display: block;
  border: none;
  background: none;
  width: 100%;
  text-align: left;
  cursor: pointer;
  outline: none;
}

/* On mouse-over */
.sidenav a:hover, .dropdown-btn:hover {
  color: #f1f1f1;
}

/* Main content */
.main {
  margin-left: 200px; /* Same as the width of the sidenav */
  font-size: 20px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

/* Add an active class to the active dropdown button */
.active {
  background-color: green;
  color: white;
}

/* Dropdown container (hidden by default). Optional: add a lighter background color and some left padding to change the design of the dropdown content */
.dropdown-container {
  display: none;
  background-color: #262626;
  padding-left: 8px;
  width:200px;
  left:200px;
  
    top: 80px;
    bottom:0;
    position:fixed;
    overflow-y:scroll;
    overflow-x:hidden;

}
.dropdown-container-1 {
  display: none;
  background-color: #262626;
  padding-left: 8px;
}

/*.ltn__header-middle-area{*/
/*    display:none;*/
/*}*/


/* Optional: Style the caret down icon */
.fa-caret-down {
  float: right;
  padding-right: 8px;
}

/* Some media queries for responsiveness */
@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>

<div class="ltn__utilize-overlay"></div>

<div class="ltn__product-area ltn__product-gutter mb-120">
    <div class="container">
        <div class="row">
            <div class="sidenav">
 <?php
 $getcategory = new CategoryController;
 $getcategories = $getcategory->getCategory();
 if($getcategories){
       foreach($getcategories as $cats){
 ?>
  <button class="dropdown-btn"><?php echo $cats['cat_name']?>
    <i class="fa fa-caret-down"></i>
  </button>
 
  <div class="dropdown-container">
       <?php
 $getsubcat = $getcategory->getSubcategory($cats['id']);
 if($getsubcat){
     foreach($getsubcat as $subcats){ 
      $getsubcatonelavs = $getcategory->getSubcategory($subcats['id']);
      if($getsubcatonelavs){
  ?>
    <button class="dropdown-btn-1"><?php echo $subcats['cat_name']?> <i class="fa fa-plus"></i></button>
     <div class="dropdown-container-1">
     <?php
         $getsubcatonelav = $getcategory->getSubcategory($subcats['id']);
         if($getsubcatonelav){
            foreach($getsubcatonelav as $subcatslanv){    
        
     ?>
    <a href="category.php?url=<?php echo $subcatslanv['cat_url'] ?>"><?php echo $subcatslanv['cat_name'] ?></a>
    <?php
         }
         }
    ?>
  
  </div>
<?php
}
else{
    ?> 
     <a href="category.php?url=<?php echo $subcats['cat_url'] ?>"><?php echo $subcats['cat_name'] ?></a>
    <?php
}
}
}
?>
  </div>
  
  <?php
       }
 }
  ?>
 

</div>
        </div>
    </div>
</div>
            
            
     <script>
/* Loop through all dropdown buttons to toggle between hiding and showing its dropdown content - This allows the user to have multiple dropdowns without any conflict */
var dropdown = document.getElementsByClassName("dropdown-btn");
var i;

for (i = 0; i < dropdown.length; i++) {
     dropdown[0].nextElementSibling.style.display = "block";
  dropdown[i].addEventListener("click", function() {
    this.classList.toggle("active");
   
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}


var dropdownone = document.getElementsByClassName("dropdown-btn-1");
var i;

for (i = 0; i < dropdownone.length; i++) {
  dropdownone[i].addEventListener("click", function() {
    this.classList.toggle("active");
    var dropdownContent = this.nextElementSibling;
    if (dropdownContent.style.display === "block") {
      dropdownContent.style.display = "none";
    } else {
      dropdownContent.style.display = "block";
    }
  });
}
</script>       
<?php
include('inc/footer.php');
?>            
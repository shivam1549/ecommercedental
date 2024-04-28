<div class="sidebar" data-color="orange">
    <style>
        .btn-custom{
            background:#fff;
            border:none;
        }
        .badge-custom{
            background:#fff;
            color:#000;
            font-size:11px;
            margin-left: 2px;
        }
    </style>
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
    -->
      <div class="logo">
        <a href="#" class="simple-text logo-mini">
          DT
        </a>
        <a href="#" class="simple-text logo-normal">
          Dento
        </a>
      </div>
      <div class="sidebar-wrapper" id="sidebar-wrapper">
        <ul class="nav">
          <li class="active ">
            <a href="index.php">
              <i class="now-ui-icons design_app"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <!-- <li>
            <a href="./icons.html">
              <i class="now-ui-icons education_atom"></i>
              <p>Icons</p>
            </a>
          </li> -->
          <!-- <li>
            <a href="./map.html">
              <i class="now-ui-icons location_map-big"></i>
              <p>Maps</p>
            </a>
          </li>
          <li>
            <a href="./notifications.html">
              <i class="now-ui-icons ui-1_bell-53"></i>
              <p>Notifications</p>
            </a>
          </li>
          <li>
            <a href="./user.html">
              <i class="now-ui-icons users_single-02"></i>
              <p>User Profile</p>
            </a>
          </li> -->
          <li>
            <a href="categories.php">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Category</p>
            </a>
          </li>
          <li>
            <a href="banners.php">
              <i class="now-ui-icons design_bullet-list-67"></i>
              <p>Banners</p>
            </a>
          </li>
          <li>
            <a href="products.php">
              <i class="now-ui-icons text_caps-small"></i>
              <p>Products</p>
            </a>
          </li>
          <li>
            <a href="orders.php">
              <i class="now-ui-icons text_caps-small"></i>
              <p>Orders
                <?php
              $neworders = new AdminController;
              $neworder = $neworders->getnumberOfneworders();
              if($neworder){
              ?>
              <span class="badge badge-primary badge-custom"><?php echo $neworder;?></span>
              <?php
              }
              ?>
              
              </p>
            </a>
          </li>
          <li class="">
            <a href="customers.php">
              <i class="now-ui-icons arrows-1_cloud-download-93"></i>
              <p>Customers</p>
            </a>
          </li>
           <li class="">
            <a href="customer-query.php">
              <i class="now-ui-icons arrows-1_cloud-download-93"></i>
              <p>Customers Queries
              <?php
              $queries = new AdminController;
              $newquery = $queries->cutomerQueries();
              if($newquery){
              ?>
              <span class="badge badge-primary badge-custom"><?php echo $newquery;?></span>
              <?php
              }
              ?>
              </p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel" id="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="#pablo">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse justify-content-end" id="navigation">
           
            <ul class="navbar-nav">
            
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  <i class="now-ui-icons location_world"></i>
                  <p>
                    <span class="d-lg-none d-md-block">Some Actions</span>
                  </p>
                </a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="https://gyangreedy.com/dento/">View Website</a>
                             <form class="dropdown-item" action="" method="POST">
                                                                    <button class="btn btn-primary" type="submit" name="logout_btn">Logout</button>
                                                                </form>
                
                </div>
              </li>
           
            </ul>
          </div>
        </div>
      </nav>
      <!-- End Navbar -->
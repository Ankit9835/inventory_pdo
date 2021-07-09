 <!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="assets/img/user2-160x160.jpg" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?php echo $_SESSION['username']; ?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
       
        <li><a href="dashboard.php"><i class="fa fa-dashboard"></i> DashBoard</a></li>
        <li><a href="category.php"><i class="fa fa-list-alt"></i> Categories </a></li>
        <li><a href="addproduct.php"><i class="fa fa-product-hunt"></i> Add Product </a></li>
        <li><a href="productlist.php"><i class="fa fa-th-list"></i> Product List </a></li>
        <li><a href="createorder.php"><i class="fa fa-th-list"></i> Create Order </a></li>
        <li><a href="orderlist.php"><i class="fa fa-th-list"></i> Order List</a></li>
        <li><a href="registration.php"><i class="fa fa-registered"></i> Registration </a></li>
          
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>
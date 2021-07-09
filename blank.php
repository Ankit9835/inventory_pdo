<?php 
  include('connectdb.php');
  session_start();
  include('layout/header.php'); 
  if($_SESSION['username'] == ''){
    header('location:index.php');
  }

  
?>

<?php include('layout/topbar.php'); ?>
<?php include('layout/navbar.php'); ?>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Product List <small>it all starts here</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

          <div class = "box box-info">
            <div class = "box-header with-border">
             
            </div>
        
            <div class = "box-body">
              
              
               
             
            </div>
            <div class = "box-footer">
              
            </div>
            
          </div>
     
    </section>
    <!-- /.content -->
  </div>

  
  <!-- /.content-wrapper -->
<?php include('layout/footer.php'); ?>
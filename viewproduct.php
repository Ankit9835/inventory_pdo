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
      <h1> View Product <small>it all starts here</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content container-fluid">

          <div class = "box box-warning">
            <div class = "box-header with-border">
               <h3 class = "box-title"> <a href = "productlist.php" class = "btn btn-primary" role = "button"> Back To Product List </a> </h3>
            </div>
        
            <div class = "box-body">
              <?php
                $id = $_GET['id'];


                $select = $pdo->prepare("select * from tbl_product where pid =".$id);

                $select->execute();

                while($row = $select->fetch(PDO::FETCH_OBJ)){
                      echo '
                            <div class = "col-md-6">
                                  <ul class="list-group">
                                  <center> <p class = "list-group-item list-group-item-success"> <b> Product Detail </b> </p> </center>
                                      <li class="list-group-item">ID <span class="badge">'.$row->pid.'</span></li>
                                      <li class="list-group-item"> Product Name <span class="label label-info pull-right">'.$row->pname.'</span></li>

                                      <li class="list-group-item"> Product Category <span class="label label-primary pull-right">'.$row->pcategory.'</span></li>

                                      <li class="list-group-item"> Purchase Price  <span class="label label-warning pull-right">'.$row->purchaseprice.'</span></li>

                                       <li class="list-group-item"> Sale Price  <span class="label label-warning pull-right">'.$row->saleprice.'</span></li>

                                       <li class="list-group-item"> Profit  <span class="label label-success pull-right">'.($row->saleprice-$row->purchaseprice ).'</span></li>


                                        <li class="list-group-item"> Product Stock  <span class="label label-danger pull-right">'.$row->pstock.'</span></li>

                                         <li class="list-group-item"> <b> Description </b> -   <span class="">'.$row->pdescription.'</span></li>
                                  </ul>


                            </div>


                            <div class = "col-md-6">

                                <ul class="list-group">
                                 <center> <p class = "list-group-item list-group-item-success"> <b> Product Image </b> </p> </center>
                                    <img src = "productimage/'.$row->pimage.'" class = "img-responsive" />
                                </ul>
                            </div>



                      ';



                }

              ?>
              
               
             
            </div>
            <div class = "box-footer">
              
            </div>
            
          </div>
     
    </section>
    <!-- /.content -->
  </div>

  
  <!-- /.content-wrapper -->
<?php include('layout/footer.php'); ?>
<?php 
  include('connectdb.php');
  session_start();
  include('layout/header.php'); 
  if($_SESSION['username'] == ''){
    header('location:index.php');
  }

  if(isset($_POST['btnSave'])){
    $pname = $_POST['txtproduct'];
    $category = $_POST['txtcategory'];
    $purprice = $_POST['txtpurchase'];
    $saleprice = $_POST['txtsale'];
    $stockprice = $_POST['txtstock'];
    $description = $_POST['txtdescription'];

    $file_name = $_FILES['myfile']['name'];
    $file_tmp = $_FILES['myfile']['tmp_name'];
    $f_size = $_FILES['myfile']['size'];
    $f_extension = explode('.',$file_name);
    $f_extension = strtolower(end($f_extension));
    $new_file = uniqid().'..'. $f_extension;
    $store = "productimage/".$new_file;
  if($f_extension == 'jpg' ||  $f_extension == 'png' ||  $f_extension == 'jpeg'){

  
      if($f_size>=10000000){
           $error =  '<script type = "text/javascript">
          jQuery(function validation(){
              swal({
                  title: "Error",
                  text: "Max Size Of File Should Be Of 1 MB",
                  icon: "error",
                  button: "Close",
                });
            });


        </script>';
        echo $error;
      }
     else {
      if(move_uploaded_file($file_tmp, $store)){
       $productimage = $new_file;
      }
   } 
 }  
   else {
       $error =  '<script type = "text/javascript">
          jQuery(function validation(){
              swal({
                  title: "Warning",
                  text: "File Must Be Of jpg,png Type",
                  icon: "warning",
                  button: "Close",
                });
            });


        </script>';
        echo $error;
   }  

   if(!isset($error)){
      $insert = $pdo->prepare("insert into tbl_product(pname,pcategory,purchaseprice,saleprice,pstock,pdescription,pimage)values(:pname,:pcategory,:purchaseprice,:saleprice,:pstock,:pdescription,:pimage)");

      $insert->bindparam(':pname',$pname);
      $insert->bindparam(':pcategory',$category);
      $insert->bindparam(':purchaseprice',$purprice);
      $insert->bindparam(':saleprice',$saleprice);
      $insert->bindparam(':pstock',$stockprice);
      $insert->bindparam(':pdescription',$description);
      $insert->bindparam(':pimage',$productimage);
    if($insert->execute()){
         echo '<script type = "text/javascript">
          jQuery(function validation(){
              swal({
                  title: "Awesome",
                  text: "Your Product Has Been Added",
                  icon: "success",
                  button: "Close",
                });
            });


        </script>';
   } else {
     echo '<script type = "text/javascript">
          jQuery(function validation(){
              swal({
                  title: "Error",
                  text: "Please Try Again",
                  icon: "error",
                  button: "Close",
                });
            });


        </script>';
   }
 }
}

?>

<?php include('layout/topbar.php'); ?>
<?php include('layout/navbar.php'); ?>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>Product Form <small>it all starts here</small></h1>
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
              <h3 class = "box-title"> <a href = "productlist.php" class = "btn btn-primary" role = "button"> Back To Product List </a> </h3>
            </div>
            <form action = "" method = "post" name ="formname" enctype = "multipart/form-data">
            <div class = "box-body">
              
                <div class = "col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <input type="text" class="form-control" name = "txtproduct" placeholder="Enter Product Name" required>
                  </div>

                 <div class="form-group">
                  <label>Select Category</label>
                  <select class="form-control" name = "txtcategory" required>
                     <option value = "" disabled selected>Select Category</option>
                     <?php
                        $select = $pdo->prepare("select * from tbl_category order by catid");

                        $select->execute();
                        while($row = $select->fetch(PDO::FETCH_ASSOC)){
                          extract($row);
                     ?>

                    <option><?php echo $row['category']; ?></option>
                   <?php
                      }
                   ?>
                    
                  </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Purchase Price</label>
                  <input type="number" min = "1" step = "1" class="form-control" name = "txtpurchase" placeholder="Enter Purchase Price" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Sale Price</label>
                  <input type="number" min = "1" step = "1" class="form-control" name = "txtsale" placeholder="Enter Sale Price" required>
                </div>

                </div>
                <div class = "col-md-6">
                   <div class="form-group">
                      <label for="exampleInputEmail1">Stock</label>
                      <input type="number" min = "1" step = "1" class="form-control" name = "txtstock" placeholder="Enter Sale Price" required>
                    </div>

                     <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <textarea class = "form-control" name = "txtdescription" rows = "4" placeholder = "Enter..."> </textarea>
                    </div>


                     <div class="form-group">
                      <label for="exampleInputEmail1">Product Image</label>
                      <input type="file" class="input-group" name = "myfile" required>
                      <p> Upload Image </p>
                    </div>
                </div>
             
            </div>
            <div class = "box-footer">
              <button type="submit" name = "btnSave" class="btn btn-info">Add Product</button>
            </div>
             </form>
          </div>
     
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include('layout/footer.php'); ?>
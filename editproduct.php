<?php 
  include('connectdb.php');
  session_start();
  include('layout/header.php'); 
  if($_SESSION['useremail'] == '' OR $_SESSION['role'] == 'user'){
    header('location:index.php');
  }

  $id = $_GET['id'];


  $select = $pdo->prepare("select * from tbl_product where pid=".$id);
  $select->execute();

  $row = $select->fetch(PDO::FETCH_ASSOC);

  $pid = $row['pid'];
  $pname = $row['pname'];
  $pcategory = $row['pcategory'];
  $purchaseprice = $row['purchaseprice'];
  $saleprice = $row['saleprice'];
  $pstock = $row['pstock'];
  $pdescription = $row['pdescription'];
  $pimage = $row['pimage'];


  if(isset($_POST['btnUpdateProduct'])){
     $pnametxt = $_POST['txtproduct'];
    $pcategorytxt = $_POST['txtcategory'];
    $purchasetxt = $_POST['txtpurchase'];
    $psaletxt = $_POST['txtsale'];
    $pstocktxt = $_POST['txtstock'];
    $descriptiontxt = $_POST['txtdescription'];

    $pimagetxt = $_FILES['myfile']['name'];
    
   

    if(!empty($pimagetxt)){

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
       $new_file;
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
    $update = $pdo->prepare("update tbl_product set pname=:pname, pcategory=:pcategory, purchaseprice=:purprice, saleprice=:saleprice, pstock=:pstock, pdescription=:description, pimage=:pimage where pid = $id");

      $update->bindparam(':pname',$pnametxt);
      $update->bindparam(':pcategory',$pcategorytxt);
      $update->bindparam(':purprice',$purchasetxt);
      $update->bindparam(':saleprice',$psaletxt);
      $update->bindparam(':pstock',$pstocktxt);
      $update->bindparam(':description',$descriptiontxt);
      $update->bindparam(':pimage',$new_file);

    if($update->execute()){
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

    } else {
      $update = $pdo->prepare("update tbl_product set pname=:pname, pcategory=:pcategory, purchaseprice=:purprice, saleprice=:saleprice, pstock=:pstock, pdescription=:description, pimage=:pimage where pid = $id");

      $update->bindparam(':pname',$pnametxt);
      $update->bindparam(':pcategory',$pcategorytxt);
      $update->bindparam(':purprice',$purchasetxt);
      $update->bindparam(':saleprice',$psaletxt);
      $update->bindparam(':pstock',$pstocktxt);
      $update->bindparam(':description',$descriptiontxt);
      $update->bindparam(':pimage',$pimage);

      if($update->execute()){
          echo  '<script type = "text/javascript">
          jQuery(function validation(){
              swal({
                  title: "Yayy!!",
                  text: "Data Updated SuccessFully",
                  icon: "success",
                  button: "Close",
                });
            });


        </script>';
      } else {
          echo  '<script type = "text/javascript">
          jQuery(function validation(){
              swal({
                  title: "Error",
                  text: "Something Went Wrong!",
                  icon: "warning",
                  button: "Close",
                });
            });


        </script>';
      }
    }
  }


   $select = $pdo->prepare("select * from tbl_product where pid=".$id);
  $select->execute();

  $row = $select->fetch(PDO::FETCH_ASSOC);

  $pid = $row['pid'];
  $pname = $row['pname'];
  $pcategory = $row['pcategory'];
  $purchaseprice = $row['purchaseprice'];
  $saleprice = $row['saleprice'];
  $pstock = $row['pstock'];
  $pdescription = $row['pdescription'];
  $pimage = $row['pimage'];
  
  
?>




<?php include('layout/topbar.php'); ?>
<?php include('layout/navbar.php'); ?>
<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Edit Product <small>it all starts here</small></h1>
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
             
            </div>

            <form action = "" method = "post" name ="formname" enctype = "multipart/form-data">
        
            <div class = "box-body">
              
              <div class = "box-body">
              
                <div class = "col-md-6">
                  <div class="form-group">
                    <label for="exampleInputEmail1">Product Name</label>
                    <input type="text" class="form-control" value = "<?php echo $row['pname']; ?>" name = "txtproduct" placeholder="Enter Product Name" required>
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

                    <option <?php if($row['category'] == $pcategory) { ?>

                      selected="selected" <?php } ?> >


                      <?php echo $row['category']; ?></option>
                   <?php
                      }
                   ?>
                    
                  </select>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Purchase Price</label>
                  <input type="number" value = "<?php echo $purchaseprice; ?>" min = "1" step = "1" class="form-control" name = "txtpurchase" placeholder="Enter Purchase Price" required>
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Sale Price</label>
                  <input type="number" value = "<?php echo $saleprice; ?>" min = "1" step = "1" class="form-control" name = "txtsale" placeholder="Enter Sale Price" required>
                </div>

                </div>
                <div class = "col-md-6">
                   <div class="form-group">
                      <label for="exampleInputEmail1">Stock</label>
                      <input type="number" value = "<?php echo $pstock; ?>" min = "1" step = "1" class="form-control" name = "txtstock" placeholder="Enter Sale Price" required>
                    </div>

                     <div class="form-group">
                      <label for="exampleInputEmail1">Description</label>
                      <textarea class = "form-control"  name = "txtdescription" rows = "4" placeholder = "Enter..."> <?php echo $pdescription; ?> </textarea>
                    </div>


                     <div class="form-group">
                      <label for="exampleInputEmail1">Product Image</label>
                      <img src = "productimage/<?php echo $pimage; ?>" class = "img-responsive" width = "50px" height = "40px">
                      <input type="file" class="input-group" name = "myfile">
                      <p> Upload Image </p>
                    </div>
                </div>
             
            </div>
               
             
            </div>
               <div class = "box-footer">
                  <button type="submit" name="btnUpdateProduct" class="btn btn-warning">Update Product</button>
            </div>
          </form>
          
            
          </div>
     
    </section>
    <!-- /.content -->
  </div>

  
  <!-- /.content-wrapper -->
<?php include('layout/footer.php'); ?>
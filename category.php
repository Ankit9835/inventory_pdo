
<?php include('connectdb.php');
 session_start();
  include('layout/header.php');
  if($_SESSION['useremail'] == '' OR $_SESSION['role'] == 'user'){
    header('location:index.php');
  }


  if(isset($_POST['btnSave'])){
    $category = $_POST['txtcategory'];

    if(empty($category)){
      $error = '<script type = "text/javascript">
          jQuery(function validation(){
              swal({
                  title: "OOPS!! Something Missing.",
                  text: "Fill All The Label",
                  icon: "warning",
                  button: "Close",
                });
            });


        </script>';
        echo $error;
    }

    if(!isset($error)){
      $insert = $pdo->prepare("insert into tbl_category(category)values(:category)");
      $insert->bindparam(':category',$category);
      if($insert->execute()){
         echo '<script type = "text/javascript">
          jQuery(function validation(){
              swal({
                  title: "Awesome",
                  text: "Category Has Been Added",
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
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Category Form
        <small>Preview</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Forms</a></li>
        <li class="active">General Elements</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="box box-warning">
            <div class="box-header with-border">
              <h3 class="box-title">Category Form</h3>
            </div>

      <div class="row">



           <div class="box-body">
                 <form role="form" method = "post" action = "">
                  <?php
                    if(isset($_POST['btn-edit'])){
                      $select = $pdo->prepare("select * from tbl_category where catid=".$_POST['btn-edit']);

                      $select->execute();

                      if($select){
                        $row = $select->fetch(PDO::FETCH_OBJ);
                         echo '
                          <div class="col-md-4">

          <!-- general form elements -->
          
            <!-- /.box-header -->
            <!-- form start -->
           
            
                <div class="form-group">
                  <label for="exampleInputEmail1">Category</label>
                  <input type="hidden" class="form-control" value = "'.$row->catid.'" name = "txtid">
                  <input type="text" class="form-control" value = "'.$row->category.'" name = "txtcategory">
                </div>
               
                 <button type="submit" name = "btnUpdate" class="btn btn-info">Update</button>
               
              </div>

                      ';
                      }

                    } else {
                      echo '
                          <div class="col-md-4">

          <!-- general form elements -->
          
            <!-- /.box-header -->
            <!-- form start -->
           
            
                <div class="form-group">
                  <label for="exampleInputEmail1">Category</label>
                  <input type="text" class="form-control" name = "txtcategory" placeholder="Enter Category">
                </div>
               
                 <button type="submit" name = "btnSave" class="btn btn-warning">Save</button>
               
              </div>

                      ';
                    }
                  ?>
        
        <!-- left column -->
        
              <!-- /.box-body -->

            <?php
              if(isset($_POST['btnUpdate'])){
                $category = $_POST['txtcategory'];
                $id = $_POST['txtid'];

                if(empty($category)){
                  $errorupdate = '

                      <script type = "text/javascript">
          jQuery(function validation(){
              swal({
                  title: "Error",
                  text: "Fill All The Blanks",
                  icon: "error",
                  button: "Close",
                });
            });


        </script>


                  ';
                  echo $errorupdate;
                }  if(!isset($errorupdate)){ 
                        $update = $pdo->prepare("update tbl_category set category =:category where catid=".$id);
                        $update->bindparam(':category',$category);


                        if($update->execute()){
                           echo '<script type = "text/javascript">
                            jQuery(function validation(){
                                swal({
                                    title: "Awesome",
                                    text: "Category Has Been Updated",
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


            if(isset($_POST['btn-delete'])){
              $delete = $pdo->prepare("delete from tbl_category where catid=".$_POST['btn-delete']);

              if($delete->execute()){
                 echo '<script type = "text/javascript">
                            jQuery(function validation(){
                                swal({
                                    title: "Data Deleted",
                                    text: "Category Has Been Deleted",
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

            ?> 
               
             
            
          <!-- /.box -->

          <!-- Form Element sizes -->
          
          <!-- /.box -->

          
          <!-- /.box -->

          <!-- Input addon -->
         
          <!-- /.box -->

       

        <div class = "col-md-8">
          <table id = "example1" class = "table table-striped">
            <thead>
                <tr>
                  
                    <th> Category </th>
                    <th> EDIT </th>
                    
                    <th> DELETE </th>
                 
                </tr>
            </thead>
            <tbody>
              <?php 
                  $select = $pdo->prepare("select * from tbl_category order by catid desc");
                  $select->execute();

                  while($row = $select->fetch(PDO::FETCH_OBJ)){
                  echo '

                      <tr>
                        <td>' . $row->category . '</td>

                        <td> <button type = "submit" name = "btn-edit" value = "'.$row->catid.'" class = "btn btn-success"> EDIT </button>  </td>
                        
                         <td> <button type = "submit" name = "btn-delete" value = "'.$row->catid.'" class = "btn btn-danger"> DELETE </button>   </td>

                         
                      </tr>

                    ';
                  }
             ?>
            </tbody>
          </table>
        </div>
        </form>
          </div>
         </div>
        <!--/.col (left) -->
        <!-- right column -->
       
        <!--/.col (right) -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
<?php include('layout/footer.php'); ?>



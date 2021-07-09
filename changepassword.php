<?php 
  include('connectdb.php');
  session_start();
   include('layout/header.php');
   if($_SESSION['useremail'] == '' OR $_SESSION['role'] == 'user'){
    header('location:index.php');
  }

  if($_SESSION['role'] == 'admin'){
    include_once('layout/navbar.php');
  } else {
      include_once('layout/usernavbar.php');
  }

?>

<?php
  if(isset($_POST['updatePassword'])){
    $oldpassword = $_POST['txtoldpass'];
    $newpassword = $_POST['txtnewpass'];
    $confpassword = $_POST['txtconfpass'];

   // echo $oldpassword. " - " . $newpassword. " - " . $confpassword;
    $email = $_SESSION['useremail'];
    $select = $pdo->prepare("select * from tbl_user where useremail = '$email'");

    $select->execute();

    $row = $select->fetch(PDO::FETCH_ASSOC);
     $useremail_db =  $row['useremail'];
     $userpass_db = $row['password'];

     if($userpass_db == $oldpassword){
      if($newpassword == $confpassword){
        // echo "New And Confirm Password Matched";

        $update = $pdo->prepare("update tbl_user set password =:pass where useremail =:email");
        $update->bindparam(':pass',$confpassword);
        $update->bindparam(':email',$email);
        if($update->execute()){
          echo '<script type = "text/javascript">
          jQuery(function validation(){
              swal({
                  title: "Yay!!! Password Updated",
                  text: "Password Updated SuccessFully",
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
                  text: "OOPS!! Password Not Updated",
                  icon: "error",
                  button: "Close",
                });
            });


        </script>';
        }


      } else {
         echo '<script type = "text/javascript">
          jQuery(function validation(){
              swal({
                  title: "OOPS! Password Not Matched",
                  text: "Password Is Not Matched With Old Password",
                  icon: "error",
                  button: "Close",
                });
            });


        </script>';
      }
      //echo "Password Matched";
     } else {
        echo '<script type = "text/javascript">
          jQuery(function validation(){
              swal({
                  title: "Wrong Password",
                  text: "Password Not Matched!",
                  icon: "warning",
                  button: "Close",
                });
            });


        </script>';
     }

  }

?>

<?php include('layout/topbar.php'); ?>

<!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1> Change Password <small></small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Change Password Form</h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <form role="form" action = "" method = "post">
              <div class="box-body">
                <div class="form-group">
                  <label for="exampleInputEmail1">Old Password</label>
                  <input type="password" class="form-control" id="exampleInputEmail1" name = "txtoldpass" placeholder="Enter Old Password">
                </div>
                <div class="form-group">
                  <label for="exampleInputPassword1"> New Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" name = "txtnewpass" placeholder="Enter New Password">
                </div>
                <div class="form-group">
                  <label for="exampleInputFile"> Confirm Password</label>
                  <input type="password" class="form-control" id="exampleInputPassword1" name = "txtconfpass" placeholder="Enter Confirm Password">

                  
                </div>
               
              </div>
              <!-- /.box-body -->

              <div class="box-footer">
                <button type="submit" name = "updatePassword" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<?php include('layout/footer.php'); ?>
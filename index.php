
<script src="plugins/jquery/dist/jquery.min.js"></script>
		<!-- Bootstrap 3.3.7 -->
<script src="plugins/bootstrap/dist/js/bootstrap.min.js"></script>
		<!-- iCheck -->
<script src="file/iCheck/icheck.min.js"></script>

<script type = "text/javascript" src = "js/sweetalert/sweetalert.js"> </script>

<?php include_once('connectdb.php'); 
session_start(); ?>

<?php

	if(isset($_POST['btn_login'])){
		$useremail = $_POST['txt_email'];
		$userpassword = $_POST['txt_password'];

		//echo $useremail . '-' . $userpassword;

		$select = $pdo->prepare("select * from tbl_user where useremail = '$useremail' AND password = '$userpassword'");

		$select->execute();

		$row = $select->fetch(PDO::FETCH_ASSOC);

		if($row['useremail']==$useremail AND $row['password'] ==$userpassword AND $row['role'] == 'admin'){

			$_SESSION['userid'] = $row['userid'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['useremail'] = $row['useremail'];
			$_SESSION['password'] = $row['password'];
			$_SESSION['role'] = 'admin';

			echo '<script type = "text/javascript">
					jQuery(function validation(){
							swal({
								  title: "Good Job!'.$_SESSION['username'].'",
								  text: "Details Matched!",
								  icon: "success",
								  button: "Loading...",
								});
						});


				</script>';
			header('refresh:2;dashboard.php');
		} else if($row['useremail']==$useremail AND $row['password'] ==$userpassword AND $row['role'] == 'user'){
			$_SESSION['userid'] = $row['userid'];
			$_SESSION['username'] = $row['username'];
			$_SESSION['useremail'] = $row['useremail'];
			$_SESSION['password'] = $row['password'];
			$_SESSION['role'] = 'user';
			
			echo '<script type = "text/javascript">
					jQuery(function validation(){
							swal({
								 title: "Good Job!'.$_SESSION['username'].'",
								 text: "Details Matched!",
								 icon: "success",
								 button: "Loading...",
								});
						});


				</script>';
			header('refresh:2;user.php');
		}

		 else {
			echo '<script type = "text/javascript">
					jQuery(function validation(){
							swal({
								 title: "Login Failed",
								 text: "Credential Not Matched!",
								 icon: "error",
								 button: "Close",
								});
						});


				</script>';
		}
	}

?>

<?php include('layout/header.php'); ?>

	<body class="hold-transition login-page">
		<div class="login-box">
			<div class="login-logo">
				<a href="index2.php"><b>Admin</b>LTE</a>
			</div>
			<!-- /.login-logo -->
			<div class="login-box-body">
				<p class="login-box-msg">Sign in to start your session</p>

				<form role = "form" action = "" method="post">
					<div class="form-group has-feedback">
						<input type="email" class="form-control" placeholder="Email" name="txt_email">
						<span class="glyphicon glyphicon-envelope form-control-feedback"></span>
					</div>
					<div class="form-group has-feedback">
						<input type="password" class="form-control" placeholder="Password" name="txt_password">
						<span class="glyphicon glyphicon-lock form-control-feedback"></span>
					</div>
					<div class="row">
						
						<!-- /.col -->
						<div class="col-xs-4">
							<button type="submit" class="btn btn-primary btn-block btn-flat" name="btn_login">Sign In</button>
						</div>
						<!-- /.col -->
					</div>
				</form> <br>

				
				<!-- /.social-auth-links -->

				<a href="#" onclick = "swal('To Get Password', 'Please Contact Admin Or Service Provider', 'error');" class = "text-primary">I forgot my password</a><br>
				

			</div>
			<!-- /.login-box-body -->
		</div>
		<!-- /.login-box -->

		<!-- jQuery 3 -->
		
		<script>
			 $(function () {
				$('input').iCheck({
					checkboxClass: 'icheckbox_square-blue',
					radioClass: 'iradio_square-blue',
					increaseArea: '20%' /* optional */
				});
			 });
		</script>
	</body>
</html>

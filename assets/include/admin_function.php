<!-- validation of student -->
<?php include('functions.php'); ?>

<!--- Name Error Variables ---->
<?php
	$userNameErr = $userEmailErr = $userPasswordErr = "" ;
 ?>
<!--- Variable Name ---->
 <?php
	$userName = $userEmail = $userPassword = "";
 ?>
<!--- Validation Condition ---->		
<?php			
	if(isset($_POST["addAdmin"])) {
		if(empty($_POST["user-name"])) {
			$userNameErr = "User Name is required.";
		} else {
			$userName = validate_data($_POST["user-name"]);
		}
		
		if(empty($_POST["user-email"])){
			$userEmailErr = "User Email is required.";
		} else {
			$userEmail = validate_data($_POST["user-email"]);
		}
		
		if(empty($_POST["user-password"])){
			$userPasswordErr = "User Password is required.";
		} else {
			$userPassword = md5($_POST["user-password"]);
		}
		
	// insert query
	$query = "INSERT INTO admin(user_name, user_email, user_password)VALUES('$userName','$userEmail','$userPassword')";
		
		
			if(!empty($userName) && !empty($userEmail) && !empty($userPassword)) {
				if(mysqli_query ($conn, $query)) {
					if(mysqli_affected_rows($conn) == 1) {
						$msg = true;
				} else {
					$msg = false;
				}
				} else {
					echo "Error: " . $query . "<br>" . mysqli_error($conn);
				}
			} else {
				return;
			}
	}

 //edit Student

		if(isset($_POST["editAdmin"])){
		
		if(empty($_POST["user-name"])) {
			$userNameErr = "User Name is required.";
		} else {
			$userName = validate_data($_POST["user-name"]);
		}
		
		if(empty($_POST["user-email"])){
			$userEmailErr = "User Email is required.";
		} else {
			$userEmail = validate_data($_POST["user-email"]);
		}
		
		if(empty($_POST["user-password"])){
			$userPasswordErr = "User Password is required.";
		} else {
			$userPassword = md5($_POST["user-password"]);
		}
		
		
		
		
		
		//update query
		$id=$_REQUEST['id'];
		
		$uQuery="UPDATE admin SET user_name = '$userName', user_email = '$userEmail', user_password = '$userPassword' WHERE id = '$id'";
		
		
		if(!empty($userName) && !empty($userEmail) && !empty($userPassword)) {
				if(mysqli_query ($conn, $uQuery)) {
					if(mysqli_affected_rows($conn) == 1) {
						$msg = true;
				} else {
					$msg = false;
				}
				} else {
					echo "Error: " . $uQuery . "<br>" . mysqli_error($conn);
				}
			} else {
				return;
			}
		} 
?>
	
	
	
<!-- validation of student -->


<!--- Name Error Variables ---->
<?php
	$titleErr = $nameErr =  $designationErr = "";
 ?>
<!--- Variable Name ---->
 <?php
	$msg = $title = $name =  $designation = "";
 ?>
<!--- Validation Condition ---->		
<?php			
	if(isset($_POST["submit"])) {
		if(empty($_POST["name"])) {
			$nameErr = "Name is required.";
		} else {
			$name = ($_POST["name"]);
		}
	
		if(empty($_POST["email"])){
			$emailErr = "Email Name is required.";
		} else {
			$email = ($_POST["email"]);
		}
		
		if(empty($_POST["subject"])){
			$subjectErr = "Subject Name is required.";
		} else {
			$subject = ($_POST["subject"]);
		}
		
		if(empty($_POST["message"])){
			$messageErr = "Message Name is required.";
		} else {
			$message = ($_POST["message"]);
		}
		
		
		
		
		
		
		
		
		
	// insert query
	$query = "INSERT INTO contact(name, email, subject, message)VALUES('$name','$email','$subject', '$message')";
	
		
			if(!empty($name) && !empty($email) && !empty($subject)  && !empty($message) ) {
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

		
?>
	

	
	
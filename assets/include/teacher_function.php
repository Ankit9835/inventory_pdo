<!-- validation of student -->


<!--- Name Error Variables ---->
<?php
	$nameErr =   "";
 ?>
<!--- Variable Name ---->
 <?php
	$msg = $name = "";
 ?>
<!--- Validation Condition ---->		
<?php			
	if(isset($_POST["addTeacher"])) {
		if(empty($_POST["name"])) {
			$nameErr = "Name is required.";
		} else {
			$name = ($_POST["name"]);
		}
	
		
		
		
		
		
		
		
		  
	// insert query
	$query = "INSERT INTO teacher(name)VALUES('$name')";
	
		
			if(!empty($name) ) {
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

	if(isset($_POST["editTeacher"])) {
		if(empty($_POST["name"])) {
			$nameErr = "Name is required.";
		} else {
			$name = ($_POST["name"]);
		}

		$id=$_REQUEST['id'];
		
		$uQuery="UPDATE teacher SET name = '$name' WHERE id = '$id'";
		
		
		if(!empty($name)) {
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
	

	
	
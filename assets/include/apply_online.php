<!-- validation of student -->


<!--- Name Error Variables ---->
<?php
	$nameErr = $courseErr =  $fatherErr = $motherErr = $dobErr =  $mobileErr = $adharErr = $annualErr =  "";
 ?>
<!--- Variable Name ---->
 <?php
	$name = $course =  $father = $mother = $dob =  $mobile = $adhar = $annual =  "";
 ?>
<!--- Validation Condition ---->		
<?php			
	if(isset($_POST["submit"])) {
		if(empty($_POST["name"])) {
			$nameErr = "Name is required.";
		} else {
			$name = ($_POST["name"]);
		}
	
		if(empty($_POST["course"])){
			$courseErr = "Course Name is required.";
		} else {
			$course = ($_POST["course"]);
		}
		
		if(empty($_POST["f-name"])){
			$fatherErr = "Father Name is required.";
		} else {
			$father = ($_POST["f-name"]);
		}
		
		if(empty($_POST["m-name"])){
			$motherErr = "Message Name is required.";
		} else {
			$mother = ($_POST["m-name"]);
		}

		if(empty($_POST["dob"])){
			$dobErr = "Dob is required.";
		} else {
			$dob = ($_POST["dob"]);
		}

		if(empty($_POST["phone"])){
			$mobileErr = "Dob is required.";
		} else {
			$mobile = ($_POST["phone"]);
		}

		if(empty($_POST["adhar"])){
			$adharErr = "Dob is required.";
		} else {
			$adhar = ($_POST["adhar"]);
		}

		if(empty($_POST["annual"])){
			$annualErr = "Annual Field is required.";
		} else {
			$annual = ($_POST["annual"]);
		}
		
		
		
		
		
		
		
		
		
	// insert query
	$query = "INSERT INTO online_apply(name, course, f_name, m_name, dob, phone, adhar, annual)VALUES('$name','$course','$father', '$mother', '$dob', '$mobile', '$adhar', '$annual')";
	
		
			if(!empty($name) && !empty($course) && !empty($father)  && !empty($mother) && !empty($dob) && !empty($mobile) && !empty($adhar) && !empty($annual)  ) {
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
	

	
	
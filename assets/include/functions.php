<?php
// data variable
$msg = "";

// validate data
function validate_data($data) {
	if(!empty($data)) {
		$data = trim($data);
		$data = stripslashes($data);
		$data = htmlspecialchars($data);
		return $data;
	} else {
		return false;
	}
}

// validate phone number
function validate_phone($data) {
	if(strlen($data) == 10) {
		return $data;
	}
}

// generate admission id
function addmission_id($conn) {
	// characters
	$char = "ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
	$charLength = strlen($char);
	$token = "";
	for($i = 0; $i < 6; $i ++) {
		// generate randomly within given character/digits
		$token .= $char[rand(0, $charLength - 1)];
	}    
	$adm_id = date('Y').'/'.$token;
	$qry = "SELECT * FROM `student` WHERE `admission_id` = '$adm_id'";
	$result = mysqli_query($conn, $qry);
	if(mysqli_num_rows($result) == 0) {
		return $adm_id;
	} else {
		//return addmission_id();
	}
}
function is_unique($conn, $tblName, $colName, $name) {
	$qry = "SELECT * FROM {$tblName} WHERE {$colName} = '$name'";
	$result = mysqli_query($conn, $qry);
	if(mysqli_num_rows($result) == 0) {
		return true;
	} else {
		return false;
	}
}
?>

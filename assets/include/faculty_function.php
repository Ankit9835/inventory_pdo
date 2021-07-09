<!-- validation of student -->


<!--- Name Error Variables ---->
<?php
	$teacherErr = $nameErr = $designationErr =  $descriptionErr =   "";
 ?>
<!--- Variable Name ---->
 <?php
	$msg = $teacher = $name = $designation =  $description =   "";
 ?>
<!--- Validation Condition ---->		
<?php			
	if(isset($_POST["addFaculty"])) {
		if(empty($_POST["name"])) {
			$teacherErr = "Name is required.";
		} else {
			$teacher = ($_POST["name"]);
		}
	
		if(empty($_POST["designation"])){
			$designationErr = "Designation is required.";
		} else {
			$designation = ($_POST["designation"]);
		}
		
		if(empty($_POST["description"])){
			$descriptionErr = "Description is required.";
		} else {
			$description = addslashes($_POST["description"]);
		}
		
		
		
		
		
		
		  if (! file_exists($_FILES["photo"]["tmp_name"])) {
        $nameErr = "Choose image file to upload";
            
    }
		
		 	 $goodExtensions = array(

                                 '.doc',
                                '.docx',
                                '.jpg',
								'.jpeg',
                                 '.pdf',
                                  '.png',

                        ); 

        $error='';

 //set the current directory where you wanna upload the doc/docx files

 $uploaddir = 'teacherimage/ ';

 $name = $_FILES['photo']['name'];//get the name of the file that will be uploaded
 $file_size =$_FILES['photo']['size'];
$file_tmp =$_FILES['photo']['tmp_name'];
$file_type=$_FILES['photo']['type'];

$stem=substr($name,0,strpos($name,'.'));

//take the file extension

$extension = substr($name, strpos($name,'.'), strlen($name)-1);

//verify if the file extension is doc or docx

if(!in_array($extension,$goodExtensions))

$error.='Extension not allowed<br>';

echo "<span> </span>"; //verify if the file size of the file being uploaded is greater then 1


if ($error=='')

{

//upload the file to

if (move_uploaded_file($file_tmp,"teacherimage/".$name)) {



}

}
		
		
		
		
		
		
		  
	// insert query
	$query = "INSERT INTO faculty(name, designation, description, document)VALUES('$teacher','$designation','$description','$name')";
	
		
			if(!empty($teacher) && !empty($designation) && !empty($description) && !empty($name)) {
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
	if(isset($_POST["editFaculty"])) {
		
		$id=$_REQUEST['id'];
		
		if(empty($_POST["name"])) {
			$teacherErr = "Name is required.";
		} else {
			$teacher = ($_POST["name"]);
		}
	
		if(empty($_POST["designation"])){
			$designationErr = "Designation is required.";
		} else {
			$designation = addslashes($_POST["designation"]);
		}
		
		if(empty($_POST["description"])){
			$descriptionErr = "Description is required.";
		} else {
			$description = addslashes($_POST["description"]);
		}
		
		
		
		
		
		
		
		
		 	 $goodExtensions = array(

                                 '.doc',
                                '.docx',
                                '.jpg',
								'.jpeg',
                                 '.pdf',
                                  '.png',

                        ); 

        $error='';

 //set the current directory where you wanna upload the doc/docx files

 $uploaddir = 'teacherimage/ ';

 $name = $_FILES['photo']['name'];//get the name of the file that will be uploaded
 $file_size =$_FILES['photo']['size'];
$file_tmp =$_FILES['photo']['tmp_name'];
$file_type=$_FILES['photo']['type'];

$stem=substr($name,0,strpos($name,'.'));

//take the file extension

$extension = substr($name, strpos($name,'.'), strlen($name)-1);

//verify if the file extension is doc or docx

if(!in_array($extension,$goodExtensions))

$error.='Extension not allowed<br>';

echo "<span> </span>"; //verify if the file size of the file being uploaded is greater then 1


if ($error=='')

{

//upload the file to

if (move_uploaded_file($file_tmp,"teacherimage/".$name)) {



}

}
		
		
		
		
		
		if ($_FILES['photo']['name']) /* If there Is  file Selected*/ {
			
		$uQuery="UPDATE faculty SET name = '$teacher', designation = '$designation', description = '$description', document = '$name' WHERE id = '$id'";
		} else /* If file is  Selected*/ {
			
		$uQuery="UPDATE faculty SET name = '$teacher', designation = '$designation', description = '$description' WHERE id = '$id'";

		}
		
		
				if(mysqli_query ($conn, $uQuery)) {
					if(mysqli_affected_rows($conn) == 1) {
						$msg = true;
				} else {
					$msg = false;
				}
				} else {
					echo "Error: " . $uQuery . "<br>" . mysqli_error($conn);
				}
			
		} 
		
?>
	

	
	
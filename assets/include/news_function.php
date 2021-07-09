<!-- validation of student -->


<!--- Name Error Variables ---->
<?php
	$titleErr = $nameErr =  $descriptionErr = "";
 ?>
<!--- Variable Name ---->
 <?php
	$msg = $title = $name =  $description = "";
 ?>
<!--- Validation Condition ---->		
<?php			
	if(isset($_POST["addNews"])) {
		if(empty($_POST["title"])) {
			$titleErr = "Title is required.";
		} else {
			$title = ($_POST["title"]);
		}
	
		if(empty($_POST["description"])){
			$descriptionErr = "Description Name is required.";
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

 $uploaddir = 'newsimage/ ';

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

if (move_uploaded_file($file_tmp,"newsimage/".$name)) {



}

}
		
	// insert query
	$query = "INSERT INTO news(title, description, document)VALUES('$title','$description','$name')";
	
		
			if(!empty($title) && !empty($description) && !empty($name)) {
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

		if(isset($_POST["editNews"])){
			
			$id=$_REQUEST['id'];
		
		if(empty($_POST["title"])) {
			$titleErr = "Title is required.";
		} else {
			$title = ($_POST["title"]);
		}
	
		if(empty($_POST["description"])){
			$descriptionErr = "Description Name is required.";
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

 $uploaddir = 'newsimage/ ';

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

if (move_uploaded_file($file_tmp,"newsimage/".$name)) {



}

}
		
		
		
		//update query
		
		
		
		
		
			
		if ($_FILES['photo']['name']) /* If there Is  file Selected*/ {
			$uQuery="UPDATE news SET title = '$title', description = '$description', document = '$name' WHERE id = '$id'";
    } else /* If file is  Selected*/ {
       $uQuery="UPDATE news SET title = '$title', description = '$description' WHERE id = '$id'";

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
	

	
	
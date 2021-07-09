<?php 
  include_once('connectdb.php');

  $id = $_POST['pidd'];



  $sql = $pdo->prepare("delete from tbl_product where pid=".$id);

  if($sql->execute()){

  } else {
  	echo "Error";
  }

?>
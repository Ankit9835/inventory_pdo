<?php

try{
	$pdo = new PDO('mysql:host=localhost;dbname=pos_db','root','');
	//echo "Connected Successfully";
} catch(PDOException $f){
	echo $f->getmessage();
}


?>
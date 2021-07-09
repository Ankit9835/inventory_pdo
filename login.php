<?php
session_start(); // Starting Session
$error=''; // Variable To Store Error Message
if (isset($_POST['submit'])) {
if (empty($_POST['user-name']) || empty($_POST['user-password'])) {
  echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-info"></i> Error!</h4> Login Failed, Try Again!.</div>';
}
else
{
// Define $username and $password
$useremail=$_POST['user-name'];
$password=$_POST['user-password'];
$password= md5($password);
// Establishing Connection with Server by passing server_name, user_id and password as a parameter

// To protect MySQL injection for Security purpose

// Selecting Database

// SQL query to fetch information of registerd users and finds user match.
$query = mysqli_query($conn,"SELECT user_name, user_password FROM admin WHERE user_name = '$useremail' AND user_password ='$password'" )or die(mysqli_error($conn));
$rows = mysqli_num_rows($query);
if ($rows == 1) {
$_SESSION['login_user']=$useremail; // Initializing Session
header("location: profile.php"); // Redirecting To Other Page
} else {
    echo '<div class="alert alert-success alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><h4><i class="icon fa fa-info"></i> Error!</h4> Login Failed, Try Again!.</div>';
}
mysqli_close($conn); // Closing Connection
}
}
?>
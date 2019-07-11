<?php 
session_start();

$userID="";
$password="";
$fullname="";
$society="";
$president="";
$errors = array(); 

if (isset($_POST['userID'])){
	$userID=mysqli_real_escape_string($conn, $_POST['userID']);
	$fullname=mysqli_real_escape_string($conn, $_POST['fullname']);
	$password_1=mysqli_real_escape_string($conn, $_POST['password_1']);
	$password_2=mysqli_real_escape_string($conn, $_POST['password_2']);
	$society=mysqli_real_escape_string($conn, $_POST['society']);

	$president=$_POST['president'];
	if($president==1){
		if(empty($society)){
			array_push($errors, "Society/Club name required");
		}
	}
	else if($president==0){
		$society="-";
	}

$sql_u = "SELECT * FROM ams WHERE userID='$userID'";
$res_u = mysqli_query($conn, $sql_u);

if(mysqli_num_rows($res_u) > 0){
		array_push($errors, "Username '".$userID."' already exist!");
}
if($userID=="Guest"||$userID=="guest"||$userID=="Admin"||$userID=="admin"){
		array_push($errors, "Username '".$userID."' are not allowed!");
}
if (empty($userID)) { 
		array_push($errors, "Username is required"); }
if (empty($fullname)) { 
		array_push($errors, "Full name is required"); }
if (empty($password_1)) { 
		array_push($errors, "Password is required"); }
if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
}
else if($password_1 == $password_2){
	if (count($errors) > 0){
		array_push($errors, "Register failed! Please try again with correct information.");
}
     else{
     	$password =md5($password_1);
		$sql="INSERT into ams(userID,password,fullname,society,president) VALUES ('$userID','$password','$fullname','$society','$president')";
		$result = $conn->query($sql);
		echo "<script>alert('$fullname register had successfull.');</script>";
	    echo "<script>window.location.assign('login.php');</script>";
     }
}
}
?>
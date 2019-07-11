<?php
session_start();

include('config.php');

$wid=$_SESSION['caid'];

$password1=mysqli_real_escape_string($conn, $_POST['password1']);
$password2=mysqli_real_escape_string($conn, $_POST['password2']);
$fullname=mysqli_real_escape_string($conn, $_POST['fullname']);
$website=mysqli_real_escape_string($conn, $_POST['website']);
$blog=mysqli_real_escape_string($conn, $_POST['blog']);
$phone=mysqli_real_escape_string($conn, $_POST['phone']);
$society=mysqli_real_escape_string($conn, $_POST['society']);

$sql1 = "SELECT president FROM ams WHERE userID='$wid'";
$res1 = $conn->query($sql1);
if ($res1->num_rows > 0) {
  while ($row = $res1->fetch_assoc()) {
    $presidentcheck=$row['president'];
  }
}

if ($presidentcheck==4) {
	$president=2;
}
else{
	$president=$presidentcheck;
}


$passwordcheck=0;
$cpassword=0;
$error=0;
$uploadpic=0;

$target_dir = "userimg/";
$target_file = $target_dir . $wid.".jpg";
$imagefile = basename($_FILES["fileToUpload"]["name"]);
$imageFileType = strtolower(pathinfo($imagefile,PATHINFO_EXTENSION));

if ($_FILES["fileToUpload"]["size"]==0) {
	$uploadOk = 2;
}
else if($_FILES["fileToUpload"]["size"] > 0){
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
        echo "<script>alert('Sorry, only JPG, JPEG & PNG files are allowed. Please try again with JPG, JPEG & PNG files.');</script>";
        echo "<script>window.history.back();</script>";
        $uploadOk = 0;
    }
    else if ($_FILES["fileToUpload"]["size"] > 50000000) {
        echo "<script>alert('Image files is too large! Please try again with maximum 50MB files.');</script>";
        echo "<script>window.history.back();</script>";
        $uploadOk = 0;
    }
    else{
    	$uploadpic = 1;
    	$uploadOk = 2;
    }
}

if($password2!=null){
	if($password1==null){
		echo "<script>alert('Current passowrd required!');</script>";
  		echo "<script>window.history.back();</script>";
  		$error=1;
	}
}

if($password1!=null && $error==0){
	$passwordcheck=1;
	if($password2!=null){
		$sql="select password from ams where userID='$wid' and password = '".md5($password1)."'";
		$result=$conn->query($sql);
		if($result->num_rows>0){
			while($row=$result->fetch_assoc()){
				$password=md5($password2);
				$passwordcheck=0;
				$cpassword=1;
			}
		}
		else{
			echo "<script>alert('Current password is wrong, please enter the correct password!');</script>";
			echo "<script>window.history.back();</script>";
		}
	}
	else{
		echo "<script>alert('New passowrd required!');</script>";
  		echo "<script>window.history.back();</script>";
	}
}

if ($uploadOk == 2 && $passwordcheck==0 && $error==0) {
	$sql2="update ams set fullname='$fullname',society='$society',president='$president',website='$website',blog='$blog',phone='$phone' where userID='$wid'";
	$result2 = $conn->query($sql2);
	if($cpassword==1){
		$sql1="update ams set password='$password' where userID='$wid'";
		$result1 = $conn->query($sql1);
	}
	if($uploadpic==1){
		move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
	}

	echo "<script>alert('Edit complete.');</script>";
	echo "<script>window.location.assign('userprofile.php?id=".$wid."');</script>";

}

?>
<?php
session_start();

include('config.php');

date_default_timezone_set("Asia/Kuala_Lumpur");

$fbid="";

$sql_a = "SELECT fbid FROM fb ORDER BY fbid DESC LIMIT 1";
$res_a = $conn->query($sql_a);

if ($res_a->num_rows > 0) {
while($row = $res_a->fetch_assoc()){
	$fbid = str_pad($row['fbid']+1, 3, "0", STR_PAD_LEFT);
}
}
else{
	$fbid = "001";
}

$fbuser="";
if(isset($_SESSION['caid'])){
	$fbuser=$_SESSION['caid'];
}
else{
	$fbuser="user";
}

$fbcomment=mysqli_real_escape_string($conn, $_POST['fb-comment']);
$fbtime = date("Y.m.d "."h:i:sa");

$sql_b = "INSERT INTO fb(fbid,fbuser,fbcomment,fbtime) VALUES ('$fbid','$fbuser','$fbcomment','$fbtime')";
$res_b = $conn->query($sql_b);

echo "<script>alert('Feedback success send to admin. Thanks for your feedback, We will review our system!');</script>";
echo "<script>window.location.assign('index.php');</script>";
?>
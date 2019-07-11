<?php 
session_start();

include('config.php');

date_default_timezone_set("Asia/Kuala_Lumpur");

$caid="";

$sql_a = "SELECT caid FROM event ORDER BY caid DESC LIMIT 1";
$res_a = $conn->query($sql_a);

if ($res_a->num_rows > 0) {
while($row = $res_a->fetch_assoc()){
	$caid = str_pad($row['caid']+1, 3, "0", STR_PAD_LEFT);
}
}
else{
	$caid = "001";
}

$causer = $_SESSION['caid'];

$sql_p = "SELECT president FROM ams WHERE userID='$causer'";
$res_p = $conn->query($sql_p);

if($res_p->num_rows > 0){
    while ($row = $res_p->fetch_assoc()) {
        $president=$row['president'];
    }
}

$caname = mysqli_real_escape_string($conn, $_POST['a-name']);
$cadate = mysqli_real_escape_string($conn, $_POST['a-date']);
$cadate2 = mysqli_real_escape_string($conn, $_POST['a-date2']);
$atime = mysqli_real_escape_string($conn, $_POST['a-time']);
$atime2 = mysqli_real_escape_string($conn, $_POST['a-time2']);
$cavenue = mysqli_real_escape_string($conn, $_POST['a-venue']);
$cadescription = mysqli_real_escape_string($conn, $_POST['a-description']);
$cacommittee = mysqli_real_escape_string($conn, $_POST['a-committee']);
$catime = date("Y.m.d "."h:i:sa");
$caquantity = mysqli_real_escape_string($conn, $_POST['a-tQuantity']);
$price = mysqli_real_escape_string($conn, $_POST['a-tPrice']);
$price2 = number_format($price, 2, '.', '');
$caprice = "RM".$price2;

$status = "";
$rs = "";
$st = "true";

if($president==2){
    $rs = "1";
    $status = "true";
    $reply = $caname." had successfull created!";
}
else{
    $rs = "0";
    $status = "false";
    $reply = $caname." had successfull created! Please wait for admin to prove this activity.";
}

if(isset($_POST['a-category'])){
    $cacategory = $_POST['a-category'];
}
else{
    echo "<script>alert('Please select one type of category.');</script>";
    echo "<script>window.history.back();</script>";
    $st = "false";
}

if(isset($_POST['create'])){

$target_dir = "caimg/";
$target_file = $target_dir . $caid.".jpg";
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
    	$uploadOk = 1;
    }
}

if ($uploadOk == 1 && $st == "true") {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $uploadOk = 2;
    } 
}
else if($uploadOk == 0){
	
}

}

if ($uploadOk == 2 && $st == "true") {
	$sql = "INSERT into event(caid,causer,caname,cadate,cadate2,atime,atime2,cavenue,cacategory,cadescription,cacommittee,catime,status,caquantity,caprice,ticket) VALUES ('$caid','$causer','$caname','$cadate','$cadate2','$atime','$atime2','$cavenue','$cacategory','$cadescription','$cacommittee','$catime','$status','$caquantity','$caprice','$caquantity')";
    $sql_b = "INSERT into request(rid,ruser,rname,rdate,rdate2,ratime,ratime2,rvenue,rcategory,rtime,rstatus,rquantity,rprice) VALUES ('$caid','$causer','$caname','$cadate','$cadate2','$atime','$atime2','$cavenue','$cacategory','$catime','$rs','$caquantity','$caprice')";
    $result = $conn->query($sql);
    $res_b = $conn->query($sql_b);

     echo "<script>alert('$reply');</script>";
     echo "<script>window.location.assign('index.php');</script>";
}

?>
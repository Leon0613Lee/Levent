<?php 
session_start();

include('config.php');

$u=mysqli_real_escape_string($conn, $_POST['userID']);
$p=mysqli_real_escape_string($conn, $_POST['password']);
$sql="select * from ams where userID='$u' and password = '".md5($p)."'";
$result=$conn->query($sql);

if($result->num_rows>0){
	while($row=$result->fetch_assoc()){	
		if ($u!="Admin") {
			$fullname=$row['fullname'];
			$_SESSION["caid"]=$u;
			if ($u=='admin') {
				$_SESSION["user"]=$fullname.' (Administrator)';
				echo "<script>alert('Welcome back! Administrator $fullname.');</script>";
		    	echo "<script>window.location.assign('admin.php');</script>";
			}
			else{
				if ($row['president']==4) {
            		echo "<script>alert('You been promote to Society/Club president by admin. Please go to edit user page to add Society/Club name.');</script>";
				}
				$_SESSION["user"]=$fullname;
        		echo "<script>alert('Welcome back! $fullname.');</script>";
	    		echo "<script>window.location.assign('index.php');</script>";
			}	
		}
		else{
			echo "<script>alert('Invalid Username or Password');</script>";
			echo "<script>window.history.back();</script>";
		}
	}
}
else{
	echo "<script>alert('Invalid Username or Password');</script>";
	echo "<script>window.history.back();</script>";
}

?>
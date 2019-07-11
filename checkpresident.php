<?php 

if(isset($_SESSION['caid'])){
	$presidentcheckid=$_SESSION['caid'];
	$navfullname=$_SESSION['user'];
}
else{
	$presidentcheckid='Guest';
	$navfullname='Guest';
}

$sql="select society,president from ams where userID='$presidentcheckid'";
$result=$conn->query($sql);
if($result->num_rows>0){
	while($row=$result->fetch_assoc()){
		$societyname=$row['society'];
		$presidentcheck=$row['president'];
	}
}
else{
	$presidentcheck='0';
}

$navname='';

if($presidentcheck==2){
	$navname=$societyname;
}
else{
	$navname=$navfullname;
}

?>
<?php
session_start();

include("config.php");

if(isset($_GET['id'])){
	$tactivity = $_GET['id'];
}else{
	echo "<script>window.history.back();</script>";
}

$sql_a = "SELECT tid FROM ticket ORDER BY tid DESC LIMIT 1";
$res_a = $conn->query($sql_a);

if ($res_a->num_rows > 0) {
while($row = $res_a->fetch_assoc()){
	$id = str_pad($row['tid']+1, 3, "0", STR_PAD_LEFT);
}
}
else{
	$id = "001";
}

$tuser = $_POST['tuser'];
$torganizer = $_POST['torganizer'];
$ttime = $_POST['ttime'];
$tstatus = $_POST['tstatus'];
$remain = $_POST['remain'];
$ticket = $_POST['ticket'];


for ($i=0; $i < $ticket; $i++) { 
	$tid = $id + $i;
	$sql_b = "INSERT into ticket(tid,tuser,tactivity,torganizer,ttime,tstatus) VALUES ('$tid','$tuser','$tactivity','$torganizer','$ttime','$tstatus')";
	$res_b = $conn->query($sql_b);
}

$caticket = $remain - $ticket;
$sql_c="update event set ticket='$caticket' where caid='$tactivity'";
$res_c = $conn->query($sql_c);

echo "<script>alert('Ticket purchase success.');</script>";
echo "<script>window.location.assign('index.php');</script>";


?>
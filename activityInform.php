<?php
session_start();

if (isset($_GET['logout'])){
  unset($_SESSION['user']);
  unset($_SESSION['caid']);
  echo "<script>alert('Logout success!');</script>";
  echo "<script>window.location.assign('index.php');</script>";
}

if (isset($_GET['id'])) {
  $aid=$_GET['id'];
  //echo $acid;
}else{
  echo "<script>window.location.assign('index.php');</script>";
}

include('config.php');
include('checkpresident.php');

$sql = "SELECT caid,causer,caname,cadate,cadate2,atime,atime2,cavenue,cacategory,cadescription,cacommittee,catime,status FROM event WHERE caid='$aid'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()){
  $caid=$row['caid'];
  $causer=$row['causer'];
  $caname=$row['caname'];
  $cadate=$row['cadate'];
  $cadate2=$row['cadate2'];
  $atime=$row['atime'];
  $atime2=$row['atime2'];
  $cavenue=$row['cavenue'];
  $cacategory=$row['cacategory'];
  $cadescription=$row['cadescription'];
  $cacommittee=$row['cacommittee'];
  $catime=$row['catime'];
}}

if($_SESSION['caid']==$causer){

}else{
	echo "<script>window.history.back();</script>";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Levent - <?php echo $caname;?></title>
	<link rel="icon" href="img/icon.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="leon.css">
    <link rel="stylesheet" type="text/css" href="aa.css">    
</head>
<body>

<nav>
    <div class="nav-wrapper #ffc107 amber">
      <a href="cr8activity.php" id="<?php if (isset($_SESSION['user'])) { ?>llogvisible2<?php } else  { ?>lloginvi<?php } ?>"><i class="fa fa-plus"></i></a>
      <a href="index.php" class="brand-logo "><img src="img/icon.png" style="height: 10vh;"></a>
      <a href="index.php" class="brand-logo center">LEVENT</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="aboutus.php">About us</a></li>
        <li><a href="feedback.php">Feedback</a></li>
        <li><a href="login.php" id="<?php if (isset($_SESSION['user'])) { ?>lloginvi<?php } else  { ?>llogvisible<?php } ?>"><b>Sign in</b></a></li>
        <li><a href="userprofile.php?id=<?php echo $_SESSION['caid']; ?>" id="<?php if (isset($_SESSION['user'])) { ?>llogvisible<?php } else  { ?>lloginvi<?php } ?>"><?php echo $navname; ?></a></li>
        <li><a href="?logout" id="<?php if (isset($_SESSION['user'])) { ?>llogvisible<?php } else  { ?>lloginvi<?php } ?>"><b>Sign out</b></a></li>
      </ul>
    </div>
  </nav>

<div style="margin-bottom: 6%;margin-top: 0%;">
  <div class="header1">
    <input type="button" value="Back" class="btn" style="margin-top: 0.5%;margin-left: -85%;background-color:#ffb300;font-family: "Times New Roman", Times, serif;" onclick="back()">
    <h2><?php echo $caname; ?></h2>
  </div>
  <form class="form1">
  <div>
  <table>
    <tr>
      <th style="background-color:  gray;color: white;">No</th>
      <th style="background-color:  gray;color: white;">Fullname</th>
      <th style="background-color:  gray;color: white;">Phone Number</th>
      <th style="background-color:  gray;color: white;">Blog</th>
      <th style="background-color:  gray;color: white;">Website</th>
    </tr>

<?php

$sql = "SELECT * FROM ticket as a left join ams as b on a.tuser = b.userID left join event as c on a.tactivity = c.caid WHERE c.caid = '$aid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    	if (empty($row["website"])) {
        $website="-";
      }
      else{
        $website=$row["website"];
      }

      if (empty($row["blog"])) {
        $blog="-";
      }
      else{
        $blog=$row["blog"];
      }

      if (empty($row["phone"])) {
        $phone="-";
      }
      else{
        $phone=$row["phone"];
      }

        echo "<tr><td>" . $row['tid']. "</td><td>".$row['fullname']."</td><td>".$phone."</td><td>".$blog."</td><td>".$website."</td></tr>";
    }
}
else{
  echo "<tr><td colspan='5' style='text-align: center;'>No Member.</td></tr>";
}

?>

  </table>
</div>
</form>
<div>

<script>
	function back(){
		window.history.back();
	}
</script>


<footer class="page-footer #ffc107 amber">
    <div class="container">
        <div class="row">
            <div class="col l6 s12">
                <h5 class="black-text">LEVENT</h5>
                <p class="black-text text-lighten-4">
                <a href="https://www.google.com/maps/dir/''/roispoon/@1.4826521,103.5897804,12z/data=!3m1!4b1!4m8!4m7!1m0!1m5!1m1!1s0x31da73360736fbf5:0x78455ff10e5b520c!2m2!1d103.659821!2d1.4826532" style="color: #424242;">
                Southern University College
                PTD 64888, Jalan Selatan Utama KM15, Off, Jalan Bertingkat Skudai, 81300 Skudai, Johor
                </a></p>
                <h5 class="black-text">Contact</h5>
                <p class="black-text text-lighten-4">To make a reservation, please call our system manager<br>018-9553792 Carl</p>
                <h5 class="black-text">Email</h5>
                <p class="black-text text-lighten-4">levent@gmail.com</p>              
            </div>
        <div class="col l4 offset-l2 s12">
                <h5 class="black-text">You can also follow us in this way</h5>
                <ul>
                  <li><a class="grey-text text-lighten-3" href="#!">Twitter</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Instagram</a></li>
                  <li><a class="grey-text text-lighten-3" href="#!">Wechat</a></li>
                </ul>
        </div>
        </div>
    </div>
        <div class="footer-copyright">
            <div class="container">
            © 2018 Copyright LEVENT.All rights reserved.Website  design by <span style="color: black;">LEVENT TEAM</span>
            </div>
        </div>
</footer>

</html>
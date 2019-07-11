<?php
session_start();

if (isset($_GET['logout'])){
  unset($_SESSION['user']);
  unset($_SESSION['caid']);
  echo "<script>alert('Logout success!');</script>";
  echo "<script>window.location.assign('index.php');</script>";
}

if (isset($_GET['id'])) {
  $wid=$_GET['id'];
  //echo $acid;
}else{
  echo "<script>window.location.assign('index.php');</script>";
}

$sameuser=0;

if (isset($_SESSION['user'])) {
    $fn=$_SESSION['user'];
    $uid=$_SESSION['caid'];

    if($_SESSION['caid']==$wid){
      $sameuser=1;
    }
}
else{
  $uid='Guest';
  $fn='Guest';
}

if($wid=='admin'){
  if($uid=='admin'){
    echo "<script>window.location.assign('admin.php');</script>";
  }
  else{
    echo "<script>alert('You do not have permission to access this page!');</script>";
    echo "<script>window.location.assign('index.php');</script>";
  }
}

include('config.php');
include('checkpresident.php');

$sql1 = "SELECT userID,fullname,society,president,website,blog,phone FROM ams WHERE userID='$wid'";
$res1 = $conn->query($sql1);
if ($res1->num_rows > 0) {
  while ($row = $res1->fetch_assoc()) {
    $fullname=$row['fullname'];

    if ($row['society']==null) {
      $society='-';
    }else{
      $society=$row['society'];
    }

    $president=$row['president'];

    if ($row['website']==null) {
      $website='-';
    }else{
      $website=$row['website'];
    }

    if ($row['blog']==null) {
      $blog='-';
    }else{
      $blog=$row['blog'];
    }

    if ($row['phone']==null) {
      $phone='-';
    }
    else{
      $phone=$row['phone'];
    }

  }
}
else{
  echo "<script>window.location.assign('index.php');</script>";
}

if ($president==2||$president==4) {
  $socie = "visible";
}
else{
  $socie = "hidden";
}


/*
card
*/
$sql = "SELECT caid,causer,caname,cadate,cadate2,atime,atime2,cavenue,cacategory,cadescription,cacommittee,catime,status FROM event WHERE causer='$wid'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()){
  $event=1; /* Had create event in our website before */
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
}
}
else{
  $event=0; /*Haven't create event in our website before*/
}

$filename = "userimg/".$wid.".jpg";
    if (file_exists($filename)) {
        $img = $filename;
    } else {
        $img = "img/user.jpg";
    }

if ($sameuser==1) {
  $recordddd = "llogvisible";
}else{
  $recordddd = "lloginvi";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Levent - <?php echo $fn; ?></title>
	<link rel="icon" href="img/icon.png">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" type="text/css" href="leon.css">
    <link rel="stylesheet" type="text/css" href="aa.css">  
    <link rel="stylesheet" type="text/css" href="index.css"> 
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
    <a href="index.php"><input type="button" value="Home" class="btn" style="margin-top: 0.5%;margin-left: -85%;background-color:#ffb300 "></a>
    <h2>Accout Information</h2>
  </div>
  <form class="form1">
  <div>
    <table>
      <tr>
        <td>
          <strong>Fullname </strong><br>
          <?php echo $fullname; ?>
        </td>
        <td rowspan="5">
           <img src="<?php echo $img; ?>" style="height: 70vh;max-width: 55vh;object-fit: cover;float: right;">
        </td>
      </tr>
      <tr>
        <td>
          <strong>Website</strong><br>
          <?php echo $website; ?>
        </td>
      </tr>
      <tr>
        <td>
          <strong>Phone Number</strong><br>
          <?php echo $phone; ?>
        </td>
      </tr>
      <tr>
        <td style="visibility: <strong><?php echo $socie ?>;"><?php echo "Society/Club: ".$society; ?>
          
        </td>
      </tr>
  </table>
  </div>
    <div class="input-group">
      <a style="background-color:#ffb300; text-align: center;font-size: 100%;font-family: monospace;'" onclick="window.location.href='edituser.php?id=<?php echo $wid; ?>'" class="btn" id="<?php if ($sameuser==1) { ?>llogvisible<?php } else  { ?>lloginvi<?php } ?>" " >Edit</a>
    </div>
    <br>
<div id="<?php echo $recordddd; ?>">
  <h3 style="text-align: center;">Ticket Record</h3>
  <table>
    <tr>
      <th style="background-color: #262626; color: white;">No</th>
      <th style="background-color:  #262626;color: white;">Activity Name</th>
      <th style="background-color:  #262626; color: white;">Activity Category</th>
      <th style="background-color:  #262626;color: white;">Activity Venue</th>
      <th style="background-color:  #262626;color: white;">Create By</th>
      <th style="background-color:  #262626; color: white;">Ticket Status</th>
      <th style="background-color:  #262626;color: white;">From</th>
      <th style="background-color:  #262626;color: white;">To</th>
    </tr>

<?php

$sql = "SELECT * FROM ticket as a left join event as b on a.tactivity = b.caid left join ams as c on a.torganizer = c.userID WHERE a.tuser = '$wid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
      if($row['tstatus']==0){
        $ttstatus="Ready";
      }else{
        $ttstatus="Not Ready";
      }
        echo "<tr><td>" . $row['tid']. "</td><td>".$row['caname']."</td><td>".$row['cacategory']."</td><td>".$row['cavenue']."</td><td>".$row['fullname']."</td><td>".$ttstatus."</td><td>".$row['cadate'].' '.$row['atime']."</td><td>".$row['cadate2'].' '.$row['atime2']."</td></tr>";
    }
}
else{
  echo "<tr><td colspan='7' style='text-align: center;'>No Record.</td></tr>";
}

?>

  </table>
</div>

<div>
  <h3 style="text-align: center;">Activity</h3>
  <table>
    <tr>
      <th style="background-color: gray; color: white;">No</th>
      <th style="background-color:  gray;color: white;">Activity Name</th>
      <th style="background-color:  gray;color: white;">Venue</th>
      <th style="background-color:  gray;color: white;">Category</th>
      <th style="background-color:  gray;color: white;">From</th>
      <th colspan="2" style="background-color:  gray;color: white;">To</th>
    </tr>

<?php
$sql = "SELECT * FROM event WHERE causer = '$wid'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr><td>" . $row['caid']. "</td><td>".$row['caname']."</td><td>".$row['cavenue']."</td><td>".$row['cacategory']."</td><td>".$row['cadate'].' '.$row['atime']."</td><td>".$row['cadate2'].' '.$row['atime2']."</td><td id='".$recordddd."'><a href='activityinform.php?id=".$row['caid']."'>-></a></td></tr>";
    }
}
else{
  echo "<tr><td colspan='7' style='text-align: center;'>No Member.</td></tr>";
}

?>

  </table>
</div>

  </form>
</div>







</body>


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
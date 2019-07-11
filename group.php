<?php
session_start();

if (isset($_GET['logout'])){
  unset($_SESSION['user']);
  unset($_SESSION['caid']);
  echo "<script>alert('Logout success!');</script>";
  echo "<script>window.location.assign('index.php');</script>";
}

if (isset($_SESSION['user'])) {
    if($_SESSION['caid']!='admin'){
      echo "<script>alert('You do not have permission to browse this page!');</script>";
      echo "<script>window.location.assign('index.php');</script>";
    }
}
else{
  echo "<script>alert('You do not have permission to browse this page!');</script>";
  echo "<script>window.location.assign('index.php');</script>";
}

include('config.php');

?>

<!DOCTYPE html>
<html>
<head>
  <title>Levent - <?php echo $_SESSION['user']; ?></title>
  <link rel="icon" href="img/icon.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="leon.css">
</head>
<body style="background-color: #111111;">

<nav>
    <div class="nav-wrapper #424242 grey darken-4">
      <a href="cr8activity.php" id="<?php if (isset($_SESSION['user'])) { ?>llogvisible2<?php } else  { ?>lloginvi<?php } ?>"><i class="fa fa-plus"></i></a>
      <a href="index.php" class="brand-logo "><img src="img/icon.png" style="height: 10vh;"></a>
      <a href="index.php" class="brand-logo center">LEVENT</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="aboutus.php">About us</a></li>
        <li><a href="feedback.php">Feedback</a></li>
        <li><a href="login.php" id="<?php if (isset($_SESSION['user'])) { ?>lloginvi<?php } else  { ?>llogvisible<?php } ?>"><b>Sign in</b></a></li>
        <li><a href="userprofile.php?id=<?php echo $_SESSION['caid']; ?>" id="<?php if (isset($_SESSION['user'])) { ?>llogvisible<?php } else  { ?>lloginvi<?php } ?>"><?php echo $_SESSION['user'] ?></a></li>
        <li><a href="?logout" id="<?php if (isset($_SESSION['user'])) { ?>llogvisible<?php } else  { ?>lloginvi<?php } ?>"><b>Sign out</b></a></li>
      </ul>
    </div>
  </nav>

<a href="admin.php"><input type="button" value="Activity list" class="btn" style="background-color: #323232;margin-top: 1.5%;margin-left: 1%; "></a>

<p style="font-size: 200%;font-weight: 450;text-align: center;color: white;">President request List</p>


<table style="color: white;">
  <tr>
    <th style="background-color:  #232323;">Society Name</th>
    <th>Username</th>
    <th style="background-color:  #232323;">Name</th>
    <th>Website</th>
    <th style="background-color:  #232323;">Blog</th>
    <th>Phone number</th>
    <th colspan='2' style="background-color:  #232323;">Privilege/no Privilege</th>
  </tr>

<?php
if(isset($_GET['privilege'])){
  $pid=$_GET['privilege'];
  $pp = '2';
  $sql1="update ams set president='$pp' where userID='$pid'";
  $result1 = $conn->query($sql1);
}

if(isset($_GET['unprivilege'])){
  $pid=$_GET['unprivilege'];
  $up='0';
  $us = '-';
  $sql1="update ams set president='$up',society='$us' where userID='$pid'";
  $result1 = $conn->query($sql1);
}


$president='1';
$sql = "SELECT userID,fullname,society,website,blog,phone FROM ams WHERE president='$president'";
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

        echo "<tr><td style='background-color:  #232323;'>" . $row["society"]."</td><td>". $row["userID"]."</td><td style='background-color:  #232323;'>". $row["fullname"]."</td><td>".$website."</td><td style='background-color:  #232323;'>".$blog."</td><td>".$phone."</td><td style='background-color:  #232323;'><a href='group.php?privilege=".$row["userID"]."'>Accept</a>"."</td><td style='background-color:  #232323;'><a href='group.php?unprivilege=".$row["userID"]."'>Reject</a>"."</td></tr>";
    }
}
else{
  echo "<tr><td colspan='8' style='text-align: center;'>No president request in list.</td></tr>";
}

?>

</table>

<p style="font-size: 200%;font-weight: 450;text-align: center;color: white;">President List</p>


<table style="color: white;">
  <tr>
    <th style="background-color:  #232323;">Society Name</th>
    <th>Username</th>
    <th style="background-color:  #232323;">Name</th>
    <th>Website</th>
    <th style="background-color:  #232323;">Blog</th>
    <th>Phone number</th>
    <th style='background-color:  #232323;'>&nbsp</th>
  </tr>

<?php
if(isset($_GET['demote'])){
  $did=$_GET['demote'];
  $pdemote=0;
  $sdemote="-";
  $sql="UPDATE ams SET president='$pdemote',society='$sdemote' where userID='$did'";
  $result = $conn->query($sql);
}


$president='2';
$sql = "SELECT userID,fullname,society,website,blog,phone FROM ams WHERE president='$president'";
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

        echo "<tr><td style='background-color:  #232323;'>" . $row["society"]."</td><td>". $row["userID"]."</td><td style='background-color:  #232323;'>". $row["fullname"]."</td><td>".$website."</td><td style='background-color:  #232323;'>".$blog."</td><td>".$phone."</td><td style='background-color:  #232323;'><a href='group.php?demote=".$row["userID"]."'>Demote</a>"."</td></tr>";
    }
}
else{
  echo "<tr><td colspan='7' style='text-align: center;'>No president in list.</td></tr>";
}


?>

</table>

<p style="font-size: 200%;font-weight: 450;text-align: center;color: white;">Member List</p>


<table style="color: white;">
  <tr>
    <th style="background-color:  #232323;">Username</th>
    <th>Name</th>
    <th style="background-color:  #232323;">Website</th>
    <th>Blog</th>
    <th style="background-color:  #232323;">Phone number</th>
    <th>&nbsp</th>
  </tr>

<?php
if(isset($_GET['promote'])){
  $pid=$_GET['promote'];
  $ppromote=4;
  $sql="UPDATE ams SET president='$ppromote' where userID='$pid'";
  $result = $conn->query($sql);
}

$president='0';
$president2='4';
$sql = "SELECT userID,fullname,website,blog,phone FROM ams WHERE president='$president' OR president='$president2'";
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

        echo "<tr><td style='background-color:  #232323;'>". $row["userID"]."</td><td>". $row["fullname"]."</td><td style='background-color:  #232323;'>".$website."</td><td>".$blog."</td><td style='background-color:  #232323;'>".$phone."</td><td><a href='group.php?promote=".$row["userID"]."'>Promote</a>"."</td></tr>";
      
    }
}
else{
  echo "<tr><td colspan='6' style='text-align: center;'>No member in list.</td></tr>";
}


?>

</table>
<br><br><br>
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
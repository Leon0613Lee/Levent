<?php
session_start();

if (isset($_GET['logout'])){
  unset($_SESSION['user']);
  unset($_SESSION['caid']);
  echo "<script>alert('Logout success!');</script>";
  echo "<script>window.location.assign('index.php');</script>";
}

include('config.php');
include('checkpresident.php');

date_default_timezone_set("Asia/Kuala_Lumpur");
$time1 = date("Y");
$time2 = date("m");
$time3 = date("d");
?>

<!DOCTYPE html>
<html>
<head>
	<title>Levent - Volunteers</title>
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

<p style="font-size: 200%;font-weight: 450;text-align: center;">Voluntteers</p>
<hr>


<div>
<div class="row">

<form name="search" action="search.php" method="POST">
    <input type="text" name="search" id="search" placeholder="Search for event..." style="max-width: 80%;margin-left: 10%;background-color: white;border: solid;border-width: thin;">
    <button type="submit" name="searchbtn" style="width: 3%;height: 7vh;background-color: #ffc107;"><i class="fa fa-search"></i></button>
</form>

<?php
$record=0;
$astatus='true';
$peanut='Volunteers';
$sql = "SELECT caid,causer,caname,cadate,cadate2,atime,atime2,cavenue,cacategory,cadescription,cacommittee,catime,status FROM event WHERE cacategory='$peanut' AND status='$astatus' ORDER BY caid DESC";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()){
    $filename = "caimg/".$row["caid"].".jpg";
    if (file_exists($filename)) {
        $banana = $filename;
    } else {
        $banana = "img/defaultImg.png";
    }

    $donut1 = substr($row['cadate'],0,4);
    $donut2 = substr($row['cadate'],5,2);
    $donut3 = substr($row['cadate'],8,2);
    
    $carddd="lloginvi";

    if ($donut1>=$time1) {
      if($donut1>$time1){
        $carddd="llogvisible";
        $record=1;
      }
      else if($donut1=$time1){
        if($donut2>=$time2){
          if($donut2>$time2){
            $carddd="llogvisible";
            $record=1;
          }
          else if($donut2=$time2){
            if($donut3>=$time3){
              $carddd="llogvisible";
              $record=1;
            }
          }
        }
      }
    }

    echo '<div id="'.$carddd.'" class="col s12 m3"><div class="card medium"><div class="card-image"><img src="'.$banana.'" style="max-height: 170px;width: 100%;object-fit: cover; filter: brightness(0.4);"><span class="card-title">'.$row["caname"].'</span></div><div class="card-content"><p><b>Category:</b> '.$row["cacategory"].'</p><p><b>Venue:</b> '.$row["cavenue"].'</p><p><b>Date & Time:</b></p><p><b>From</b> '.$row["cadate"]." ".$row["atime"].' <b>to</b> '.$row["cadate2"]." ".$row["atime2"].'</p><p><b>Desciption:</b></p><p>'.substr($row["cadescription"],0,30).'</p><p>'.substr($row["cadescription"],31,28).'...</p></div><div class="card-action"><a href="activity.php?id='.$row["caid"].'">View more</a></div></div></div>';
  }
}
else if(!$result->num_rows > 0){
  echo "<p>No ".$peanut." found.</p>";
  $record=1;
}
if($record==0){
  echo "<p>No ".$peanut." found.</p>";
}
?>

</div>
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
<?php
session_start();
if (isset($_GET['logout'])){
  unset($_SESSION['user']);
  unset($_SESSION['caid']);
  echo "<script>alert('Logout success!');</script>";
  echo "<script>window.location.assign('index.php');</script>";
}

if (!isset($_SESSION['user'])) {
    echo "<script>alert('Login required before create activity!');</script>";
    echo "<script>window.location.assign('login.php');</script>";
}
if($_SESSION['caid']=='admin'){
    echo "<script>alert('Admin are not allowed to create activity!');</script>";
    echo "<script>window.location.assign('index.php');</script>";
}

include('config.php');
include('checkpresident.php');

$img = "img/defaultImg.png";
?>


<!DOCTYPE html>
<html>
<head>
	<title>Levent - Create</title>
	<link rel="icon" href="img/icon.png">
  	<link rel="stylesheet" type="text/css" href="aa.css">
  	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
  	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  	<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <link rel="stylesheet" type="text/css" href="leon.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <link rel="stylesheet" href="dist/timepicker.min.css"

</head>
<body>

<nav>
    <div class="nav-wrapper #ffc107 amber">
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
  <div class="header" style="width: 50%;">
    <a href="index.php"><input type="button" value="Home" class="btn" style="margin-top: 0.5%;margin-left: -85%;background-color:#ffb300 "></a>
  	<h2>Create Activity</h2>
  </div>
  <form method="POST" action="caserver.php" enctype="multipart/form-data" style="width: 50%;">
  	<div class="input-group">
  		<label>Activity Name</label>
  		<input type="text" name="a-name" required placeholder="Freshman Camp">
  	</div>
  	<div class="input-group">
  		<label>Activity Date</label>
      <div style="color: #ffd700  ;">From</div>
  		<input type="Date" name="a-date" required>
      <div style="color: #ffd700  ;">to</div>
      <input type="Date" name="a-date2" required>
  	</div>
    <div class="input-group">
      <label>Activity Time</label>
      <div style="color: #ffd700  ;">From</div>
      <input type="time" name="a-time" step="900" value="09:00" required>
      <div style="color: #ffd700  ;">to</div>
      <input type="time" name="a-time2" step="900" value="17:00" required>
    </div>
  	<div class="input-group">
  		<label>Activity Venue</label>
  		<input type="Text" name="a-venue" required placeholder="Southern University College">
  	</div>
    <div class="input-group">
      <label>Activity Category</label>
      <select class="browser-default" name="a-category" required>
        <option value="" disabled selected>Select type of category</option>
        <option value="Sport">Sport</option>
        <option value="Concert">Concert</option>
        <option value="Volunteers">Volunteers</option>
        <option value="Food">Food</option>
        <option value="Classes">Classes</option>
      </select>
    </div>
    <div class="input-group">
      <label>Ticket Quantity</label>
      <input type="number" name="a-tQuantity" required placeholder="50" min="1" max="500">
    </div>
    <div class="input-group">
      <label>Ticket Price</label>
      <input type="number" name="a-tPrice" required placeholder="RM" min="0" step="0.05">
      <label style="color: red;">*If free of charge,please place 0</label>
    </div>
  	<div class="input-group">
  		<label>Activity Description</label>
  		<textarea cols="50" rows="4" name="a-description" style="resize: none;"></textarea>
  	</div>
  	<div class="input-group">
  		<label>Activity Committee</label>
  		<textarea cols="50" rows="4" name="a-committee" placeholder="1.Foong Chin Wei" style="resize: none;"></textarea>
  	</div>
  	<div class="input-group">
  		<label>Image upload</label>
  		<input type="file" name="fileToUpload" id="fileToUpload">
  	</div>
    <img id="preview_img" src="<?php echo $img; ?>" style="max-height: 170px;object-fit: cover;">
  	<div class="input-group">
  		<button type="submit" class="btn" name="create" style="background-color:#ffb300;">Create</button>
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

<script type="text/javascript">
$(document).ready(function(){
    //Image file input change event
    $("#fileToUpload").change(function(){
        readImageData(this);//Call image read and render function
    });
});
 
function readImageData(imgData){
  if (imgData.files && imgData.files[0]) {
        var readerObj = new FileReader();
        
        readerObj.onload = function (element) {
            $('#preview_img').attr('src', element.target.result);
        }
        
        readerObj.readAsDataURL(imgData.files[0]);
    }
}
</script>
</html>
<?php
session_start();

if (isset($_SESSION['user'])) {
    echo "<script>alert('Alreay login!');</script>";
    echo "<script>window.location.assign('index.php');</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Levent - Login</title>
  <link rel="icon" href="img/icon.png">
  <link rel="stylesheet" type="text/css" href="aa.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>

</head>
<body>


    <nav>
    <div class="nav-wrapper #ffc107 amber">
      <a href="index.php" class="brand-logo "><img src="img/icon.png" style="height: 10vh;"></a>
      <a href="index.php" class="brand-logo center">LEVENT</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="aboutus.php">About us</a></li>
        <li><a href="feedback.php">Feedback</a></li>
      </ul>
    </div>
  </nav>



<div style="margin-bottom: 6%;margin-top: 0%;">
  <div class="header">
    <a href="index.php"><input type="button" value="Home" class="btn" style="margin-top: 0.5%;margin-left: -85%;background-color:#ffb300 "></a>
  	<h2>Login</h2>
  </div>
  <form method="post" action="loginserver.php">
  	<div class="input-group">
  		<label>Username</label>
  		<input type="text" name="userID" required placeholder="chinwei99">
  	</div>
  	<div class="input-group">
  		<label>Password</label>
  		<input type="password" name="password" required placeholder="password">
  	</div>
  	<div class="input-group">
  		<button type="submit" class="btn" name="login" style="background-color:#ffb300;">Login</button>
  	</div>
  	<p>
  		Not yet a member? <a href="Register.php">Sign up</a>
  	</p>
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
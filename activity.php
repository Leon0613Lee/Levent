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

if (isset($_GET['id'])) {
  $acid=$_GET['id'];
  //echo $acid;
}
else{
  echo "<script>window.location.assign('index.php');</script>";
}

$sql = "SELECT caid,causer,caname,cadate,cadate2,atime,atime2,cavenue,cacategory,cadescription,cacommittee,catime,status,caquantity,caprice,ticket FROM event WHERE caid=$acid";
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
  $caquantity=$row['caquantity'];
  $caprice=$row['caprice'];
  $ticket=$row['ticket'];
}
}

$aafn="";
$sql_a = "SELECT fullname FROM ams WHERE userID='$causer'";
$res_a = $conn->query($sql_a);
if ($res_a->num_rows > 0) {
while($row = $res_a->fetch_assoc()){
  $aafn=$row['fullname'];
}
}

$filename = "caimg/".$caid.".jpg";
    if (file_exists($filename)) {
        $caimg = $filename;
    } else {
        $caimg = "img/defaultImg.png";
    }

$pri = str_replace("RM","",$caprice);

if ($pri=="0") {
  $payment="free";
}else{
  $payment="check";
}

?>

<!DOCTYPE html>
<html>
<head>
	<title>Levent - <?php echo $caname; ?></title>
  <link rel="icon" href="img/icon.png">
  <link rel="stylesheet" type="text/css" href="aa.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/css/materialize.min.css">
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0-beta/js/materialize.min.js"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="leon.css">
    <link rel="stylesheet" type="text/css" href="ticket.css">
</head>
<body onload='hideTotal()'>

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

<div style="margin-bottom: 2%;">
  <div class="header1">
    <a href="index.php"><input type="button" value="Home" class="btn" style="margin-top: 0.5%;margin-left: -85%;background-color:#ffb300 "></a>
    <h2 style="font-family: sans-serif;"><?php echo $caname; ?></h2>
    
  </div>
<div id="light" class="content">
<div class="ticket" style="">
<p style="font-size: 30px; font-weight: bold; font-family: sans-serif;color: white; text-align: center;">Ticket</p>
<a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='none';document.getElementById('fade').style.display='none'"><i class="small material-icons" style="color: #FED155;position: absolute;top:5px;left: 95%;">close</i></a>
</div>
<br>
<form method="POST" action="<?php echo $payment; ?>.php?id=<?php echo $caid; ?>" id="form">
<div class="second_ticket" style="font-family: sans-serif;">
    <p style="font-size: 20; tex">Activity Name : <?php echo $caname; ?></p>
    <p style="font-size: 20;">Date : <?php echo $cadate."  to ".$cadate2 ; ?></p>
    <p style="font-size: 20;">Time : <?php echo $atime . " to " . $atime2 ;?></p>
    <p style="font-size: 20;">Price per ticket : <?php echo $caprice; ?></p>
    <select id="quan" name="ticket" class="browser-default" style="margin-left: 730px; margin-top:-90px;  padding: 10px; border-radius: 15px; border-color: orange;width: 8%;" onchange="calculateTotal()">
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
        <option value="6">6</option>
        <option value="7">7</option>
        <option value="8">8</option>
        <option value="9">9</option>
        <option value="10">10</option>
    </select>
</div>
<div class="ticket2">
    <p">Total price : <div id="total"></div></p>
    <p style="font-size: 18px; text-align: left; position: absolute;top:50px;"  >Remaining Ticket : <?php echo $ticket."/".$caquantity; ?></p>
    <button  type="submit" class="btn" style="background-color:#ffb300;  position: absolute;top:50px;left: 90%;">Check</button>
</div>
</form>

<script>

  var filling_prices= new Array();
 filling_prices["1"]=1;
 filling_prices["2"]=2;
 filling_prices["3"]=3;
 filling_prices["4"]=4;
 filling_prices["5"]=5;
 filling_prices["6"]=6;
 filling_prices["7"]=7;
 filling_prices["8"]=8;
 filling_prices["9"]=9;
 filling_prices["10"]=10;
 
     
     

function getFillingPrice()
{
    var FillingPrice=0;
    var price=0;
    var theForm = document.forms["form"];
     var selectedFilling = theForm.elements["quan"];
    price = filling_prices[selectedFilling.value];
    FillingPrice = price*<?php echo $pri; ?>;
    return FillingPrice;
}



        
function calculateTotal()
{

    var Price = getFillingPrice();
    
    var divobj = document.getElementById('total');
    divobj.style.display='block';
    divobj.innerHTML = "RM "+Price;

}

  function hideTotal()
{
    var divobj = document.getElementById('total');
    divobj.style.display='block';
    divobj.innerHTML = "<?php echo $caprice; ?>";
}
</script>

<div></div>
</div>
<div id="fade" class="black_overlay">
  <h2 style="font-family: sans-serif;"><?php echo $caname; ?></h2>
</div>
  <form class="form1">
    <div>
    <h4><img src="<?php echo $caimg; ?>" style="max-height: 70vh;margin-left: 28%;max-width: 70vh;object-fit: cover;border-radius: 3vh;"></h4>
    </div>

    <div style="width:70%;font-family: sans-serif;font-size: 10;">
    <table style="width:120%;margin-left: 15%;" >
  <tr>
    <td rowspan="3" style="max-width: 100%;">Description
      <br>
      <?php echo $cadescription; ?>
    </td>
    <td>Orgaize by 
      <br>
      <a href="userprofile.php?id=<?php echo $causer;?>"><?php echo $aafn; ?></td>
  </tr>
  <tr>
    <td>Venue
      <br>
      <?php echo $cavenue; ?>
    </td>
  </tr>
  <tr>
    <td>Date and time
      <br>
      <?php echo $cadate . " to " . $cadate2; ?> 
      <br>
      <?php echo $atime . " to " . $atime2; ?>
    </td>
  </tr>
  <tr>
    <td>Categories
      <br>
      <?php echo $cacategory; ?>
    </td>
    <td>Commitee
      <br>
      <?php echo $cacommittee; ?>
    </td> 
  </tr>
  <tr>
    <td colspan="2">
      <table>
        <tr>
          <td>
            <?php echo "Price per ticket : ".$caprice; ?>
          </td>
          <td>
            <?php echo "Ticket left : ".$ticket."/".$caquantity; ?>
          </td>
          <td>
            <a href = "javascript:void(0)" onclick = "document.getElementById('light').style.display='block';document.getElementById('fade').style.display='block'" id="<?php if (isset($_SESSION['user'])) { ?>llogvisible<?php } else  { ?>lloginvi<?php } ?>"><input type="button" value="Buy Ticket" class="btn" style="background-color:#ffb300 "></a> 
          </td>
        </tr>
      </table>
    </td>
  </tr>
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

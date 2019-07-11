<?php
session_start();

if (isset($_GET['logout'])){
  unset($_SESSION['user']);
  unset($_SESSION['caid']);
  echo "<script>alert('Logout success!');</script>";
  echo "<script>window.location.assign('index.php');</script>";
}

$sameuser=0;

if (isset($_GET['id'])) {
  $wid=$_GET['id'];
  //echo $acid;
  if (isset($_SESSION['user'])) {
    $fn=$_SESSION['user'];
    $uid=$_SESSION['caid'];

    if($_SESSION['caid']==$wid){
      $sameuser=1;
      if($wid=='admin'){
        $sameuser=0;
      }
    }
  }
}

if($sameuser==0){ 
  echo "<script>window.location.assign('index.php');</script>";
}


include('config.php');
include('checkpresident.php');

$sql1 = "SELECT userID,fullname,society,president,website,blog,phone FROM ams WHERE userID='$wid'";
$res1 = $conn->query($sql1);
if ($res1->num_rows > 0) {
  while ($row = $res1->fetch_assoc()) {
    $fullname=$row['fullname'];
    $society=$row['society'];
    $president=$row['president'];
    $website=$row['website'];
    $blog=$row['blog'];
    $phone=$row['phone'];
  }
}
else{
  echo "<script>window.location.assign('index.php');</script>";
}

$filename = "userimg/".$wid.".jpg";
    if (file_exists($filename)) {
        $img = $filename;
    } else {
        $img = "img/user.jpg";
    }

if ($president==2||$president==4) {
  $socie = "visible";
}
else{
  $socie = "hidden";
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
    <link rel="stylesheet" type="text/css" href="index.css">
    <link rel="stylesheet" type="text/css" href="leon.css">
    <link rel="stylesheet" type="text/css" href="aa.css">
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
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
    <h2>Edit Information</h2>
  </div>
  <form method="post" action="edituserserver.php" enctype="multipart/form-data" class="form1">
  <img id="preview_img" src="<?php echo $img; ?>" style="max-height: 170px;object-fit: cover;margin-left: 32%;">  
  <h5 style="text-align: center;">Contact Information</h5>
  <div>
    <table>
      <tr>
        <td>
          <strong>Username </strong><br>
          <?php echo $wid; ?>
        </td>
        <td>
          
        </td>
      </tr>
      <tr>
        <td>
          <strong>Current password</strong><br>
          <input type="password" name="password1" style="border-bottom-style: solid;width: 50%;" >
        </td>
        <td>
          <strong>New password</strong><br>
          <input type="password" name="password2" style="border-bottom-style: solid;width: 50%;" >
        </td>
      </tr>
      <tr>
        <td>
          <strong>Full Name</strong><br>
          <input type="text" name="fullname" style="border-bottom-style: solid;width: 50%;" value="<?php echo $fullname ?>" required>
        </td>
        <td>
          <strong>Website</strong><br>
          <input type="text" name="website" style="border-bottom-style: solid;width: 50%;" value="<?php echo $website ?>">
        </td>
      </tr>
      <tr>
        <td>
          <strong>Blog</strong><br>
          <input type="text" name="blog" style="border-bottom-style: solid;width: 50%;" value="<?php echo $blog ?>">
        </td>
        <td>
          <strong>Phone Number</strong><br>
          <input type="text" name="phone" style="border-bottom-style: solid;width: 50%;" value="<?php echo $phone ?>">
        </td>
      </tr>
      <tr>
        <td style="visibility: <strong><?php echo $socie ?>;"><?php echo "Society/Club: ".$society; ?>
        <input type="text" name="society" style="border-bottom-style: solid;width: 70%; visibility: <?php echo $socie; ?>;" value="<?php echo $society ?>">
        </td>
      </tr>
      <tr>
        <td>
        <label style="color: black;">Image upload</label>
        <input type="file" name="fileToUpload" id="fileToUpload">
        </td>
      </tr>
  </table>
  <div>
      <button type="submit" name="edit" style="background-color:#ffb300;width: 7%;height: 5vh;border-radius: 1vh;font-family: sans-serif;cursor: pointer;margin-left: 40%;">Edit</button>
      <a href="userprofile.php?id=<?php echo $wid; ?>"><input type="button" value="Cancel"  style="background-color:#ffb300;width: 7%;height: 5vh;border-radius: 1vh;font-family: sans-serif;cursor: pointer;margin-left: 10%;"></a>
    </div>
  </div>


</body>



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
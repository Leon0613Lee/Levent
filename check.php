<?php
session_start();

include("config.php");

if(isset($_GET['id'])){
	$tactivity = $_GET['id'];
}else{
	echo "<script>window.history.back();</script>";
}

$sql = "SELECT * FROM event WHERE caid = $tactivity";
$result = $conn->query($sql);
if($result->num_rows > 0){
	while ($row = $result->fetch_assoc()) {
		$torganizer = $row['causer'];
		$tcategory = $row['cacategory'];
		$tname = $row['caname'];
		$date = $row['cadate'];
  		$date2 = $row['cadate2'];
  		$time = $row['atime'];
  		$time2 = $row['atime2'];
  		$price = $row['caprice'];
		$remain = $row['ticket'];
	}
}

$tprice = str_replace("RM","",$price);

date_default_timezone_set("Asia/Kuala_Lumpur");

$tuser = $_SESSION['caid'];
$ticket = $_POST['ticket'];
$ttime = date("Y.m.d "."h:i:sa");
$tstatus = 0;
$ttotal = $tprice * $ticket;

if($remain < $ticket){
	echo "<script>alert('The remain ticket is not enough, please select purchase ".$remain." ticket or less.');</script>";
	echo "<script>window.history.back();</script>";
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Payment</title>
  <link rel="icon" href="img/icon.png">
	<script src="https://www.paypalobjects.com/api/checkout.js"></script>
  <style>
    .box{
      border: solid;
      position: relative;
      margin-left: 34%;
      padding-top: 290px;
      padding-bottom: 230px;
      padding-right: 100px;
      padding-left: 100px;
      width: 30%;
      border-color: white;
      background-color: white;
    }
    .position{
        margin-top: 10px;
    }
    .label{
        border-style: none;
        font-size: 17px;
        font-weight: bold;
        position:relative;
        text-align: left;
    }
    .font{
      font-size: 18px;
    }
  </style>
</head>
<body style="background-color: orange;">
<div class="box">
	<form method="POST" action="ticket.php?id=<?php echo $tactivity; ?>" id="form">
  <div class="position">
		<label class="font">Activity Name : </label>
		<input type="text" class="label" value="<?php echo $tname; ?>" readonly><br>
  </div>
  <div class="position">
		<label class="font">Date : </label>
		<input type="text" class="label" value="From <?php echo $date; ?> <?php echo $time; ?>" readonly>
		<input type="text" class="label" value="to <?php echo $date2; ?> <?php echo $time2; ?>" readonly><br>
  </div>
  <div class="position">
		<label class="font">Price per ticket : RM</label>
		<input type="text" class="label" value="<?php echo $tprice; ?>" readonly><br>
  </div>
  <div class="position">
		<label class="font">Quantity : </label>
		<input type="text" class="label" value="<?php echo $ticket; ?>" name="ticket" readonly><br>
  </div>
  <div class="position">
		<label class="font">Total price : RM</label>
		<input type="text" class="label" value="<?php echo $ttotal; ?>" readonly><br>
  </div>
		<input type="text" value="<?php echo $tuser; ?>" name="tuser" style="visibility: hidden;" readonly>
		<input type="text" value="<?php echo $torganizer; ?>" name="torganizer" style="visibility: hidden;" readonly>
		<input type="text" value="<?php echo $ttime; ?>" name="ttime" style="visibility: hidden;" readonly>
		<input type="text" value="<?php echo $tstatus; ?>" name="tstatus" style="visibility: hidden;" readonly>
		<input type="text" value="<?php echo $remain; ?>" name="remain" style="visibility: hidden;" readonly>
		<a href="activity.php?id=<?php echo $tactivity; ?>"  ><input type="button" value="Cancel" class="btn" style="background-color:#ffb300; position: absolute;right: 35%;"></a>
		<div id="paypal-button" style="position: absolute;top:66%"></div>
	</form>
</div>
	<script>
		paypal.Button.render({
  		env: 'sandbox',
  		client: {
    		sandbox: 'ATO5_QPWZNBUipwEb3glRbrpO8yh_mV-hj-a0i5R74C8c7IKdPUfNxC18DUVVx4gk8_36EsJC6NQipqJ'
  		},
  		style: {
    		color: 'gold',   // 'gold, 'blue', 'silver', 'black'
    		size:  'medium', // 'medium', 'small', 'large', 'responsive'
    		shape: 'rect'    // 'rect', 'pill'
  		},
  		payment: function (data, actions) {

    		return actions.payment.create({
      		transactions: [{
        		amount: {
          		total: '<?php echo $ttotal; ?>',
          		currency: 'MYR',
          		details: {
          		subtotal: '<?php echo $ttotal; ?>',
        		}
        		},
        		description: 'The payment transaction description.',
      		custom: '90048630024435',
      		//invoice_number: '12345', Insert a unique invoice number
      		payment_options: {
        		allowed_payment_method: 'INSTANT_FUNDING_SOURCE'
      		},
        		soft_descriptor: '<?php echo $tactivity; ?>',
      		item_list: {
        		items: [
        		{
          		name: '<?php echo $tname; ?>',
          		description: '<?php echo $tcategory; ?>.',
          		quantity: '<?php echo $ticket; ?>',
          		price: '<?php echo $tprice; ?>',
          		currency: 'MYR'
        		}]
      		}
      		}]
    		});
  		},
  		onAuthorize: function (data, actions) {
    		return actions.payment.execute()
      		.then(function () {
        		window.alert('Thank you for your purchase!');
        		document.getElementById("form").submit();
      		});
  		}
		}, '#paypal-button');
	</script>
</body>
</html>
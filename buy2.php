<?php
$count_success = 0;
include('function.php');
if (!isset($_SESSION['email']) || $_SESSION['email']==""){
echo "<script>window.open('index.php','_self')</script>";
}else{
	global $db;
$getuser = mysqli_query($db, "select * from bit_members where email='".$_SESSION['email']."'");
$getem = mysqli_fetch_array($getuser);
$name = $getem['name'];
$_SESSION['user'] = $name;
$verified = $getem['verified'];
if ($verified != "YES"){
echo "<script>alert('Verify your mail first')</script>";
echo "<script>window.open('verify.php','_self')</script>";
}
$email = $_SESSION['email'];
$t = "buy";
$t2 = "sell";
$run = mysqli_query($db, "select * from bit_trans where user='$email' and type='$t'");
$run2 = mysqli_query($db, "select * from bit_trans where user='$email' and type='$t2'");
$suc = "success";
$run_tran = mysqli_query($db, "select * from bit_trans where user='$email' AND status='$suc'");


$count_buys = mysqli_num_rows($run);
$count_sell = mysqli_num_rows($run2);

$count_success = mysqli_num_rows($run_tran);


$run = mysqli_query($db, "select * from settings");
$row = mysqli_fetch_array($run);
$buyPM = $row['buyPM'];
$sellPM = $row['sellPM'];
$buyBC = $row['buyBC'];
$sellBC = $row['sellBC'];
$wallet = $row['wallet'];
$bank = $row['bank'];
$adminmail = $row['adminmail'];
$mail = $row['mail'];

if (!isset($_SESSION['trackid']) || $_SESSION['trackid']==""){
echo "<script>window.open('buy.php','_self')</script>";
}
$trackid = $_SESSION['trackid'];
$run2 = mysqli_query($db, "select * from bit_trans where trackid='$trackid'");
$row2 = mysqli_fetch_array($run2);
$pricepay = $row2['price'];
$amount = $row2['amount'];

$block = mysqli_query($db, "select * from bit_block where user='$email'");
$countblock = mysqli_num_rows($block);
if ($countblock > 0 ){
$rowblock = mysqli_fetch_array($block);
$reason = $rowblock['reason'];
echo "<div>
<h2>You have been blocked from making transactions for the following reasons<br>
$reason<br>
Please contact Admin via email to rectify your account.
</h2>
</div>
<a href='main.php'>Go Back</a>
"
;
exit;
	
}

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php seo();?>
    <title><?php webname(); ?> : Buy</title>
	<link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
    <div id="wrapper">
        <nav class="navbar navbar-default navbar-cls-top " role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php" style="background-color:#006"><?php webname(); ?></a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"> <a href="ref.php">Referal Bonus: <?php refamount(); ?></a> || <?php echo $_SESSION['user']; ?> &nbsp; <a href="logout.php" class="btn square-btn-adjust" style="background-color:#006">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
					<li class="text-center">
                    <img src="2.png" class="user-image img-responsive"/>
					</li>
				
					
                    <li>
                        <a href="main.php"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                    </li>
                    <li>
                        <a style="background-color:#006" href="buy.php"><i class="fa fa-bar-chart-o fa-3x"></i>Buy</a>
                    </li>	
                     <li>
                        <a  href="sell.php"><i class="fa fa-laptop fa-3x"></i>Sell</a>
                    </li>	
					<li>
                        <a  href="trans.php"><i class="fa fa-table fa-3x"></i>Transactions</a>
                    </li>
                    <li>
                        <a  href="settings.php"><i class="fa fa-edit fa-3x"></i> Settings</a>
                    </li>				
				</ul>
               
            </div>
            
        </nav>  
<!-- /. NAV SIDE  -->
<div id="page-wrapper" >
<div id="page-inner">
<div class="row">
<div class="col-md-12">
              	<h3 class="page-header">Please pay &#8358;<?php echo $pricepay; ?> to the details below</h3>
            <form method="post" name="converter" enctype="multipart/form-data">
                <div class="col-lg-12">
                <div class="col-lg-5">
                <textarea class="form-control" disabled><?php echo $bank; ?></textarea>
      			</div>
                </div>
                <br><br>
                <div class="col-lg-6">
            	Choose Evidence Option
                
                <div class="form-group">
                Originating Bank Account<input type="radio" name="ev" value="track">
                Image<input type="radio" name="ev" value="image">
                </div>
                <div class="form-group">
                Upload Payment Evidence
                <input class="form-control" type="file" name="evidence">
                </div>
                
                <div class="form-group">
                Originating Bank Account
                <input class="form-control" type="text" name="track">
                </div>
                
                <div class="form-group">
                Upload Wallet Details
                <textarea class="form-control" name="wallet" required></textarea>
                </div>
                <input type="hidden" name="amount" value="<?php echo $amount; ?>">
                <input type="hidden" name="price" value="<?php echo $pricepay; ?>">
               
                <div class="form-group">
                <input class="btn btn-success" type="submit" name="tran2" value="Submit">
                </div>
                </div>
      </form>
</div>
</div>              
</div>
</div>
<!-- /. WRAPPER  -->
    <script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
 <?php } ?>
 
<?php
if (isset($_POST['tran2'])){

	$trackid = $_SESSION['trackid'];
	$user = $_SESSION['email'];
	$wallet = $_POST['wallet'];
	$amount = $_POST['amount'];
	$price = $_POST['price'];
	$ev = $_POST['ev'];
	
	$tra = "";
		$type="buy";
		$stat = "pending";
	if ($ev == "image"){
		$temp1 = explode(".", $_FILES['evidence']['name']);
        $newfilename1 = "$user".round(microtime(true)).".".end($temp1);
        move_uploaded_file($_FILES['evidence']['tmp_name'],"evidence_images/".$newfilename1);
		$tra = "update bit_trans set status='$stat', evidence='$newfilename1', details='$wallet', ev='$ev' where user='$user' and trackid='$trackid' and type='$type'";
	}else{
		$track = $_POST['track'];
	$tra = "update bit_trans set status='$stat', evidence='$track', details='$wallet', ev='$ev' where user='$user' and trackid='$trackid' and type='$type'";
	}
		
	$track2 = mysqli_query($db, $tra);
$trackid = $_SESSION['trackid'];
$run2 = mysqli_query($db, "select * from bit_trans where trackid='$trackid'");
$row2 = mysqli_fetch_array($run2);
$pricepay = $row2['price'];
$amount = $row2['amount'];
$wallet = $row2['details'];

	if ($track2){
	echo "<script>alert('Successful')</script>";
	$_SESSION['trackid'] = NULL;
	//======================= mail admin
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: Bit2Naira <$adminmail>" . "\r\n";
	$subject = "New Order";
	$to = "$mail";
	$message = "
    <html>
    <p>You have a new order. TrackID is $trackid,<br>
     Customer Email is ".$_SESSION['email'].".<br>
	 Customer Name is ".$_SESSION['user'].".<br>
     The customer wants to <b>$type</b> $amount worth of bitcoin.<br>
	 Currently this amount costs $price in Naira<br>
	 Please <a href='bit2naira.com/bit_admin'>login</a> to view the other details.
    </html>
    ";
	$send_mail = mail($to, $subject, $message, $headers);
	
	//======================= mail customer
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: Admin at Bit2Naira <$adminmail>" . "\r\n";
	$subject = "Order Recieved";
	$to = "$user";
	$message = "
    <html>
    <p>Your order with TrackID $trackid has been recieved<br>
	$amount BTC will be transferred to your bitcoin wallet address $wallet within the next 24 hours<br>
	 Thank You For Using Bit2Naira<br>
     <br>
	 Please <a href='bit2naira.com/login.php'>login</a> to view the transaction details.
    	 <hr>
	 For more information,inquries or complains, please fill our form on our <a href='bit2naira.com'>site</a>

	</html>
    ";
	$send_mail = mail($to, $subject, $message, $headers);
	
	echo "<script>window.open('trans.php','_self')</script>";	
		}else{
	echo "<script>alert('Error, Try Again')</script>";	
	}
	
} 
?>
﻿<?php
$count_success = 0;
include('../function.php');
if (!isset($_SESSION['name']) || $_SESSION['name']==""){
echo "<script>window.open('index.php','_self')</script>";
}else{
	global $db;
$name = $_SESSION['name'];
$t = "buy";
$t2 = "sell";
$run = mysqli_query($db, "select * from bit_trans where type='$t'");
$run2 = mysqli_query($db, "select * from bit_trans where type='$t2'");
$suc = "success";
$run_tran = mysqli_query($db, "select * from bit_trans where status='$suc'");


$count_buys = mysqli_num_rows($run);
$count_sell = mysqli_num_rows($run2);

$count_success = mysqli_num_rows($run_tran);

$run3 = mysqli_query($db, "select * from bit_members");
$count_members = mysqli_num_rows($run3);


$run = mysqli_query($db, "select * from settings");
$row = mysqli_fetch_array($run);
$buyPM = $row['buyPM'];
$sellPM = $row['sellPM'];
$buyBC = $row['buyBC'];
$sellBC = $row['sellBC'];
$wallet = $row['wallet'];
$bank = $row['bank'];
$ratesellBC = $row['ratesellBC'];
$ratesellPM = $row['ratesellPM'];
$ratebuyBC = $row['ratebuyBC'];
$ratebuyPM = $row['ratebuyPM'];
$webname = $row['webname'];
$refrate = $row['refrate'];
$reflimit = $row['reflimit'];
$adminmail = $row['adminmail'];
$mail = $row['mail'];
$info = $row['information'];

$json  = file_get_contents("https://blockchain.info/ticker");
$json  =  json_decode($json ,true);
//echo "<br>";
//print_r($json);
$buy = $json["USD"]["buy"];
$sell = $json["USD"]["sell"];


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php webname(); ?> : Settings</title>
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
                <a class="navbar-brand" style="background-color:#006" href="index.php"><?php webname(); ?></a> 
            </div>
  <div style="color: white;
padding: 15px 50px 5px 50px;
float: right;
font-size: 16px;"><?php echo $_SESSION['name']; ?> &nbsp; <a href="logout.php" style="background-color:#006" class="btn square-btn-adjust">Logout</a> </div>
        </nav>   
           <!-- /. NAV TOP  -->
                <nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
					<li class="text-center">
                    <img src="2.png" class="user-image img-responsive"/>
					</li>
				
					
                    <li>
                        <a  href="main.php"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                    </li>
                    <li>
                        <a href="trans.php"><i class="fa fa-table fa-3x"></i>Transactions</a>
                    </li>
                       <li>
                        <a  href="stock.php"><i class="fa fa-bitcoin fa-3x"></i>Finances</a>
                    </li>	
				  
                     <li>
                        <a  href="members.php"><i class="fa fa-users fa-3x"></i>Members</a>
                    </li>	
				    <li>
                        <a style="background-color:#006" href="settings.php"><i class="fa fa-edit fa-3x"></i> Settings</a>
                    </li>				
				</ul>
               
            </div>
            
        </nav>  
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
            <div id="page-inner">
                <div class="row">
                                  	<h3 class="page-header">View Your Settings Here</h3>
                                 <?php
                                 if (isset($_SESSION['main']) == true){
                                 ?>
                                    <br><a href="user.php" class="btn btn-success">Add Admin</a>
                                    <br><a href="changepassword.php" class="btn btn-success">Change Password</a>
                                 <?php } ?>
                                    <form method="post">
                                    
                                    <div class="form-group">
                                    <div class="col-lg-6">
                                    Dollar to Naira Rate (Buy BC):
                                    <input class="form-control" type="text" name="RBuyBC" value="<?php echo $ratebuyBC ?>"required>
                                    </div>
                                    </div>
                                    
                                    <div class="form-group">
                                    <div class="col-lg-6">
                                    Dollar to Naira Rate (Sell BC):
                                    <input class="form-control" type="text" name="RSellBC" value="<?php echo $ratesellBC ?>"required>
                                    </div>
                                    </div>
                                  <!--  
                                    <div class="form-group">
                                    <div class="col-lg-6">
                                    Dollar to Naira Rate (Buy PM):
                                    <input class="form-control" type="text" name="RBuyPM" value="<?php //echo $ratebuyPM ?>"required>
                                    </div>
                                    </div>
                                    
                                    <div class="form-group">
                                    <div class="col-lg-6">
                                    Dollar to Naira Rate (Sell PM):
                                    <input class="form-control" type="text" name="RSellPM" value="<?php //echo $ratesellPM ?>"required>
                                    </div>
                                    </div>
                                    -->
                                    
                                    <div class="form-group">
                                    <div class="col-lg-6">
                                    Wallet Address:
                                    <textarea class="form-control" name="wallet" required><?php echo $wallet; ?></textarea>
                                    </div>
                                    </div>
                                    
                                    <div class="form-group">
                                    <div class="col-lg-6">
                                    Bank Account:
                                    <textarea class="form-control" name="bank" required><?php echo $bank; ?></textarea>
                                    </div>
                                    </div>
                                   
                                    <div class="form-group">
                                    <div class="col-lg-6">
                                    Referal Bonus (%):
                                    <input class="form-control" type="text" name="refrate" value="<?php echo $refrate ?>"required>
                                    </div>
                                    </div>
                                    
                                    <div class="form-group">
                                    <div class="col-lg-6">
                                    Referal Bonus Withdrawal Limit:
                                    <input class="form-control" type="text" name="reflimit" value="<?php echo $reflimit ?>"required>
                                    </div>
                                    </div>
                                    
                                    <div class="form-group">
                                    <div class="col-lg-6">
                                    Enter Admin Send To Mail:
                                    <input class="form-control" type="email" name="adminmail" value="<?php echo $adminmail; ?>" required>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                    <div class="col-lg-6">
                                    Enter Admin Recieve Mail:
                                    <input class="form-control" type="email" name="mail" value="<?php echo $mail; ?>" required>
                                    </div>
                                    </div>
                                    
                                            
                                    <div class="form-group">
                                    <div class="col-lg-6">
                                    Information:
                                    <textarea class="form-control" name="info"><?php echo $info; ?></textarea>
                                    </div>
                                    </div>
                                   
                            
                                    <div class="form-group">
                                    <div class="col-lg-6">
                                    Enter Website Name:
                                    <input class="form-control" type="text" name="webname" value="<?php echo $webname; ?>" required>
                                    </div>
                                    </div>
                                    
                                    
                                    <div class="form-group">
                                    <div class="col-lg-6">
                                    Enter Admin Code:
                                    <input class="form-control" type="password" name="code" required>
                                    </div>
                                    </div>
                                    <br>
                                    <br>
                                    <div class="form-group">
                                    <div class="col-lg-6">
                					<input class="btn btn-primary" type="submit" name="update" value="Update Settings">                    				</div>
                                    </div>
                                    </form>
                    
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
if (isset($_POST['update'])){
//$buyBC = $_POST['BuyBC'];
//$buyPM = $_POST['BuyPM'];
//$sellBC = $_POST['BuyBC'];
//$sellPM = $_POST['BuyPM'];
$wallet = $_POST['wallet'];
$bank = $_POST['bank'];
$code = $_POST['code'];
$adminmail = $_POST['adminmail'];
$mail = $_POST['mail'];
$webname = $_POST['webname'];
$RbuyBC = $_POST['RBuyBC'];
//$RbuyPM = $_POST['RBuyPM'];
$RsellBC = $_POST['RSellBC'];
//$RsellPM = $_POST['RSellPM'];
$info = $_POST['info'];
$refrate = $_POST['refrate'];
$reflimit = $_POST['reflimit'];

if ($code == 12345){
	
	$up = mysqli_query($db, "update settings set wallet='$wallet', bank='$bank', adminmail='$adminmail', mail='$mail', ratebuyBC='$RbuyBC', ratebuyPM='$RbuyPM', ratesellPM='$RsellPM', ratesellBC='$RsellBC', refrate='$refrate',reflimit='$reflimit',information='$info'");
	if($up){
		echo "<script>alert('Updated!')</script>";
		echo "<script>window.open('settings.php','_self')</script>";
		}else{
		echo "<script>alert('Error, Try Again!')</script>";
		}
	
	
	
	
	
	
	
	}else{
		echo "<script>alert('Error, Invalid Code')</script>";
		
		}
	
	
	
	
}

?>
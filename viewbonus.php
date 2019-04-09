<?php
$count_success = 0;
include('function.php');
if (!isset($_SESSION['user']) || $_SESSION['user']==""){
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

if (!isset($_GET['id'])){
	echo "<script>window.open('trans.php','_self')</script>";
	}
$id = $_GET['id'];	
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <?php seo();?>
    <title><?php webname(); ?> : Transactions</title>
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
font-size: 16px;"><a href="ref.php">Referal Bonus: <?php refamount(); ?></a> || <?php echo $_SESSION['user']; ?> &nbsp; <a href="logout.php" class="btn square-btn-adjust" style="background-color:#006">Logout</a> </div>
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
                        <a href="buy.php"><i class="fa fa-bar-chart-o fa-3x"></i>Buy</a>
                    </li>	
                     <li>
                        <a  href="sell.php"><i class="fa fa-laptop fa-3x"></i>Sell</a>
                    </li>	
					<li>
                        <a style="background-color:#006" href="trans.php"><i class="fa fa-table fa-3x"></i>Transactions</a>
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
                                  	<h3 class="page-header">View Your Transactions</h3>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Transaction Details
                        </div>
                        <div class="panel-body">
                                    <?php 
                                    $da = mysqli_query($db, "select * from refbonus where id='$id'");									
									$tr = "";
									$i = 1;
                                    while($row = mysqli_fetch_array($da)){
										$member = $row['user'];
                                        $amount = $row['naira'];
                                        $price = $row['bc'];
                                        $date = $row['datesent'];
                                        $status = $row['status'];
                                        $id = $row['id'];
										$details = $row['details'];
										
										
									?>
                                                <form method="post" name="converter" enctype="multipart/form-data">
            	<table class="table-condensed">
                <tr>
                <th>User</th>
                <td><?php echo $member; ?></td>
                </tr>
                <tr>
                <th>Amount in Naira</th>
                <td><?php echo $amount; ?></td>
                </tr>
                
                <tr>
                <th>Price in BTC</th>
                <td><?php echo $price; ?></td>
                </tr>
                
                <tr>
                <th>Date Sent</th>
                <td><?php echo $date; ?></td>
                </tr>
                
                <tr>
                <th>Status</th>
                <td><?php echo $status; ?></td>
                </tr>
                
                <tr>
                <th>Transaction Type</th>
                <td>Referal Bonus</td>
                </tr>
                
                </table>
                <div class="form-group">
                <h3> Bank/Wallet Details</h3>
                <div class="col-lg-6">
                <textarea class="form-control" name="wallet" disabled><?php echo $details; ?></textarea>
                </div>
                </div>
              </form>
	
			<?php }?>						
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
if (isset($_GET['cancel'])){

$id = $_GET['cancel'];

global $db;
$sta = "cancelled";
$query = mysqli_query($db, "update refbonus set status='$sta' where id='$id'");

if ($query){
    echo "<script>alert('Transaction Cancelled!')</script>";
    echo "<script>window.open('trans.php','_self')</script>";
}else{
    echo "<script>alert('Try again')</script>";
}

}


if (isset($_GET['success'])){

$id = $_GET['success'];

global $db;
$sta = "success";
$query2 = mysqli_query($db, "update refbonus set status='$sta' where id='$id'");

if ($query2){
    echo "<script>alert('Transaction Completed!')</script>";
    echo "<script>window.open('trans.php','_self')</script>";
}else{
    echo "<script>alert('Try again')</script>";
}

}

?>
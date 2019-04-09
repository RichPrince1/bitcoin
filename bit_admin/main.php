<?php
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
//$buyBC = $row['buyBC'];
//$sellBC = $row['sellBC'];
$ratesellBC = $row['ratesellBC'];
$ratesellPM = $row['ratesellPM'];
$ratebuyBC = $row['ratebuyBC'];
$ratebuyPM = $row['ratebuyPM'];

/*
$json  = file_get_contents("https://blockchain.info/ticker");
$json  =  json_decode($json ,true);

$buyBC = $json["USD"]["buy"];
$sellBC = $json["USD"]["sell"];
*/

$buyBC = 400;
$sellBC = 450;


?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php webname(); ?> : MainPage</title>
	<link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <style>
    .table-borderless tbody tr td,
.table-borderless tbody tr th,
.table-borderless thead tr th,
.table-borderless thead tr td,
.table-borderless tfoot tr th,
.table-borderless tfoot tr td {
    border: none;
}
   </style>

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
                        <a style="background-color:#006" href="main.php"><i class="fa fa-dashboard fa-3x"></i> Dashboard</a>
                    </li>
                    <li>
                        <a  href="trans.php"><i class="fa fa-table fa-3x"></i>Transactions</a>
                    </li>
                     <li>
                        <a  href="stock.php"><i class="fa fa-bitcoin fa-3x"></i>Finances</a>
                    </li>	
				   
                     <li>
                        <a  href="members.php"><i class="fa fa-users fa-3x"></i>Members</a>
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
                    <div class="modal-content col-md-12">
                     <h2>Welcome <?php echo $name?> to your Bit2Naira Admin Dashboard</h2>   
                    <hr>
                    <div class="col-lg-6">
           <h3 class="text-center">Rates</h3>
           <table class="table table-borderless">
           <tr>
           <th></th>
           <td>Buy</td>
           <td>Sell</td>
           </tr>
           <tr>
            <td>Blockchain rate</td>
            <td> $<?php echo $buyBC; ?> </td>
            <td> $<?php echo $sellBC; ?> </td>

            </tr>
         
           <tr>
           <td>BTC</td>
           <td>&#8358;<?php echo $ratebuyBC; ?></td>
           <td>&#8358;<?php echo $ratesellBC; ?></td>
           </tr>
         <!--  
           <tr>
           <td>PM</td>
           <td>&#8358;<?php //echo $ratebuyPM; ?></td>
           <td>&#8358;<?php //echo $ratesellPM; ?></td>
           </tr>
        --> 
           </table> 
                    </div>
                </div>              
                 <!-- /. ROW  -->
                  <hr />
                <div class="row">
                <div class="col-md-3 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                <a href="trans.php"><span class="icon-box bg-color-green set-icon">
                    <i class="fa fa-bank"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text"><?php echo $count_sell; ?></p>
                    <p class="text-muted">Sales</p>
                </div>
                </a>
             </div>
		     </div>
            <div class="col-md-3 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                <a href="trans.php"><span class="icon-box bg-color-red set-icon">
                    <i class="fa fa-bars"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text"><?php echo $count_buys; ?></p>
                    <p class="text-muted">Buys</p>
                </div>
                </a>
             </div>
		     </div>
			
            <div class="col-md-3 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                <a href="trans.php"><span class="icon-box bg-color-red set-icon">
                    <i class="fa fa-upload"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text"><?php echo $count_success; ?></p>
                    <p class="text-muted">Successful</p>
                </div>
                </a>
             </div>
		     </div>
			
            <div class="col-md-3 col-sm-6 col-xs-6">           
			<div class="panel panel-back noti-box">
                <a href="members.php"><span class="icon-box bg-color-red set-icon">
                    <i class="fa fa-users"></i>
                </span>
                <div class="text-box" >
                    <p class="main-text"><?php echo $count_members; ?></p>
                    <p class="text-muted">Members</p>
                </div>
                </a>
             </div>
		     </div>
			
                       
            </div>
                 <!-- /. ROW  -->
                <hr />                
            
            
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
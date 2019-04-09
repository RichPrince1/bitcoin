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
$buyBC = $row['buyBC'];
$sellBC = $row['sellBC'];
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php webname(); ?> : Members</title>
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
                        <a  href="trans.php"><i class="fa fa-table fa-3x"></i>Transactions</a>
                    </li>
                       <li>
                        <a style="background-color:#006" href="stock.php"><i class="fa fa-bitcoin fa-3x"></i>Finances</a>
                    </li>	
				  
                     <li>
                        <a href="members.php"><i class="fa fa-users fa-3x"></i>Members</a>
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
                                  	<h3 class="page-header">View Your Stock Report </h3>
                    <div class="panel panel-default col-lg-6">
                        <div class="panel-heading">
                       Completed Sales
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                        	<th></th>
                                            <th>Date</th>
                                            <th>BTC</th>
                                            <th>Value</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
									$type= "buy";
									$sta = "success";
                                    $da = mysqli_query($db, "select * from bit_trans where type='$type' and status='$sta' order by id desc");									
									$i = 1;
									$totalamount = 0;
									$totalprice = 0;
                                    while($row = mysqli_fetch_array($da)){
										$date = $row['datesent'];
                                        $amount = $row['amount'];
                                        $price = $row['price'];
                                    	$id = $row['id'];
									$totalamount += $amount;
									$totalprice += $price; 
									echo" 
                                          
										  <tr>
										  	<td><a class='btn btn-default' href='view.php?id=$id'>$i</a></td>
											<td>$date</td>
											<td>$amount</td>
                                            <td>$price</td>
                                        </tr></a>
                                     ";

                                    
                                    $i++;
                                    }
                                    ?>
                                    <tr>
                                    <th colspan="2">Total</th>
                                    <th><?php echo $totalamount; ?></th>
                                    <th><?php echo $totalprice; ?></th>
                                    
                                    </tr>
                                        </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

<div class="panel panel-default col-lg-6">
                        <div class="panel-heading">
                       Completed Buys
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                        	<th></th>
                                            <th>Date</th>
                                            <th>BTC</th>
                                            <th>Value</th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
									$type= "sell";
									$sta = "success";
                                    $da = mysqli_query($db, "select * from bit_trans where type='$type' and status='$sta' order by id desc");									
								$i = 1;
									$totalamount = 0;
									$totalprice = 0;
                                    while($row = mysqli_fetch_array($da)){
										$date = $row['datesent'];
                                        $amount = $row['amount'];
                                        $price = $row['price'];
                                    	$id = $row['id'];
									$totalamount += $amount;
									$totalprice += $price; 
									echo" 
                                          
										  <tr>
										  	<td><a class='btn btn-default' href='view.php?id=$id'>$i</a></td>
											<td>$date</td>
											<td>$amount</td>
                                            <td>$price</td>
                                        </tr>
                                     ";

                                    
                                    $i++;
                                    }
                                    ?>
                                    <tr>
                                    <th colspan="2">Total</th>
                                    <th><?php echo $totalamount; ?></th>
                                    <th><?php echo $totalprice; ?></th>
                                    
                                    </tr>
                                        </tbody>
                                </table>
                            </div>
                        </div>
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

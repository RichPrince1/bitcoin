<?php
$count_success = 0;
include('function.php');
if (!isset($_SESSION['user']) || $_SESSION['user']==""){
echo "<script>window.open('index.php','_self')</script>";
}else{
	global $db;


$run = mysqli_query($db, "select * from settings");
$row = mysqli_fetch_array($run);
$buyPM = $row['buyPM'];
$sellPM = $row['sellPM'];
$buyBC = $row['buyBC'];
$sellBC = $row['sellBC'];
$adminmail = $row['adminmail'];
$mail = $row['mail'];
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
font-size: 16px;"><a href="ref.php">Referal Bonus: <?php refamount(); ?></a> || <?php echo $_SESSION['user']; ?> &nbsp; <a href="logout.php" style="background-color:#006" class="btn square-btn-adjust">Logout</a> </div>
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
                                  	<h3 class="page-header">View Referal Transactions</h3>
                                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Transaction Details
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                        	<th></th>
                                            <th>User</th>
                                            <th>Naira</th>
                                            <th>BTC</th>
                                            <th>Date</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $da = mysqli_query($db, "select * from refbonus where user='".$_SESSION['email']."' order by id desc");									
									$tr = "";
									$i = 1;
                                    while($row = mysqli_fetch_array($da)){
										$member = $row['user'];
                                        $amount = $row['naira'];
                                        $price = $row['bc'];
                                        $date = $row['datesent'];
                                        $details = $row['details'];
                                        $status = $row['status'];
										$id = $row['id'];
										
										echo" 
                                          <tr class='$tr'>
										  	<td>$i</td>
											<td>$member</td>
                                            <td>$amount</td>
                                            <td>$price</td>
                                            <td>$date</td>
											<td>$status</td>
                               	<td class='center'><a href='viewbonus.php?id=$id' class='btn btn-primary'>View</a></td>
    								<td><a href='?cancel=$id' class='btn btn-danger'>X</a></td>                                                                                
                                        </tr>
                                     ";

                                    
                                    $i++;
                                    }
                                    ?>
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
 
 
 <?php
if (isset($_GET['cancel'])){

$id = $_GET['cancel'];

global $db;
$sta = "cancelled";
$query = mysqli_query($db, "update refbonus set status='$sta' where id='$id'");

if ($query){
$query3 = mysqli_query($db, "select * from refbonus where id='$id'");
$row = mysqli_fetch_array($query3);
$user = $row['user'];
//======================= mail customer
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: Admin at Bit2Naira <$adminmail>" . "\r\n";
	$subject = "Order Cancelled";
	$to = "$user";
	$message = "
    <html>
    <p>Your order with TrackID $trackid has been cancelled by the admin<br>
     Thank You For Using Bit2Naira<br>
	 <br>
	 Please <a href='bit2naira.com/login.php'>login</a> to view the transaction details.
	 <hr>
	 For more information,inquries or complains, please fill our form on our <a href='bit2naira.com'>site</a>
    </html>
    ";
	$send_mail = mail($to, $subject, $message, $headers);

    echo "<script>alert('Transaction Cancelled!')</script>";
    echo "<script>window.open('trans.php','_self')</script>";
}else{
    echo "<script>alert('Try again')</script>";
}

}


if (isset($_POST['track'])){
$trackid = $_POST['trackid'];
$query = mysqli_query($db, "select * from bit_trans where trackid='$trackid'");
$count = mysqli_num_rows($query);
if ($count == 1){
$row = mysqli_fetch_array($query);
$id = $row['id'];
echo "<script>window.open('view.php?id=".$id."','_self')</script>";	
}else{
echo "<script>alert('Invalid Transaction Id, Please check and try again')</script>";	
}

	
}
?>
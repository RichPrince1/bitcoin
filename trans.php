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
<div class="col-md-12">
              	<h3 class="page-header">View Your Transactions</h3><br>
                <a class="btn btn-success" href="refbonus.php">View Referal Transactions</a>
                
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
                                            <th>Amount</th>
                                            <th>Price</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $da = mysqli_query($db, "select * from bit_trans where user='".$_SESSION['email']."' order by id desc");									
									$tr = "";
									$i = 1;
                                    while($row = mysqli_fetch_array($da)){
                                        $amount = $row['amount'];
                                        $price = $row['price'];
                                        $date = $row['datesent'];
                                        $status = $row['status'];
                                        $type = $row['type'];
                                        $id = $row['id'];
										
										if ($status=="success"){
											$tr="success";
										}else if ($status=="pending"){
											$tr="";
										}else if ($status=="incomplete"){
											$tr="info";
										}else{
											$tr="danger";
										}
                                    echo" 
                                          <tr class='$tr'>
										  	<td>$i</td>
                                            <td>$amount</td>
                                            <td>$price</td>
                                            <td>$date</td>
                                            <td class='center'>$status</td>
                                            <td class='center'>$type</td>
                                            <td class='center'><a href='edit.php?id=$id' class='btn btn-default'>Edit</a></td>
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
$query = mysqli_query($db, "update bit_trans set status='$sta' where id='$id' and user='".$_SESSION['email']."'");
$user = $_SESSION['email'];
if ($query){
  //======================= mail customer
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: Admin at Bit2Naira <$adminmail>" . "\r\n";
	$subject = "Order Cancelled";
	$to = "$user";
	$message = "
    <html>
    <p>Your order with TrackID $trackid has been cancelled<br>
     Thank You For Using Bit2Naira<br>
	 Please confirm the transaction<br>
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

?>
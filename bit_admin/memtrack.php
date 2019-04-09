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

if (!isset($_POST['memtrack'])){
echo "<script>window.open('members.php','_self')</script>";	
}else{
$e = $_POST['email'];
}
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
                        <a  href="trans.php"><i class="fa fa-table fa-3x"></i>Transactions</a>
                    </li>
                       <li>
                        <a  href="stock.php"><i class="fa fa-bitcoin fa-3x"></i>Finances</a>
                    </li>	
				  
                     <li>
                        <a style="background-color:#006" href="members.php"><i class="fa fa-users fa-3x"></i>Members</a>
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
                  	<h3 class="page-header">View Your Members </h3>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                             Members Details
                        </div>
                        
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                        	<th></th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Transactions</th>
                                            <th>Joined</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php 
                                    $da = mysqli_query($db, "select * from bit_members where email like '%$e%'");									
									$tr = "";
									$i = 1;
                                    $block = "Block";
									while($row = mysqli_fetch_array($da)){
										$name = $row['name'];
                                        $email = $row['email'];
                                        $gsm = $row['gsm'];
                                        $date = $row['datereg'];
										$id = $row['id'];
									$daa = mysqli_query($db, "select * from bit_trans where user='$email'");									
									$trans = mysqli_num_rows($daa);	
									$b = mysqli_query($db, "select * from bit_block where user='$email'");
									$bcount = mysqli_num_rows($b);
									if ($bcount > 0){
										$block = "Unblock";
										}
									
									
									echo" 
                                          <tr class=''>
										  	<td>$i</td>
											<td>$name</td>
                                            <td>$email</td>
                                            <td>$gsm</td>
											<td><a href='memtrans.php?id=$email&name=$name' class='btn btn-success'>$trans</a></td>
                                            <td>$date</td>
                                            <td><a href='?delete=$id' class='btn btn-danger'>Delete</a></td>                                            <td><a href='?$block=$id' class='btn btn-default'>$block</a></td>                                
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
if (isset($_GET['delete'])){

$id = $_GET['delete'];

global $db;
$get = mysqli_query($db, "select * bit_members where id='$id'");
$row = mysqli_fetch_array($get);
$user = $row['email']; 
$query = mysqli_query($db, "delete from bit_members where id='$id'");

$query2 = mysqli_query($db, "delete from bit_trans where user='$user'");
if ($query && $query2){
    echo "<script>alert('Member Deleted with Transactions!')</script>";
    echo "<script>window.open('members.php','_self')</script>";
}else{
    echo "<script>alert('Try again')</script>";
}

}

if (isset($_GET['Unblock'])){
	global $db;
	$id = $_GET['Unblock'];
	
$o = mysqli_query($db, "select * from bit_members where id='$id'");
$roww = mysqli_fetch_array($o);
$email = $roww['email'];

	
	$get = mysqli_query($db, "delete from bit_block where user='$email'");
if ($get){
    echo "<script>alert('Member Unblocked!')</script>";
    echo "<script>window.open('members.php','_self')</script>";
}else{
    echo "<script>alert('Try again')</script>";
}
}

if(isset($_GET['Block'])){
	$user = $_GET['Block'];
echo "<script>window.open('reason.php?id=".$user."','_self')</script>";	
}
?>
<?php
include('../function.php');
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
      <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?php webname(); ?> : AdminMainPage</title>
	<link href="assets/css/bootstrap.css" rel="stylesheet" />
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <link href="assets/css/custom.css" rel="stylesheet" />
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
</head>
<body>
     
    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Login to your admin panel</h3>
                            		<p>Enter your email and password to log on:</p>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="" method="post" class="login-form">
			                    	  <div class="form-group">
			                    		<label class="sr-only" for="form-name">Username</label>
			                        	<input type="text" name="name" placeholder="Username..." class="form-name form-control" id="form-name" required>
			                        </div>
                                    <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password" required>
			                        </div><input type="submit" name="submitdetails" class="btn btn-success" value="Sign in!">
			                    </form>
                            </div>
                        </div>
                    </div>
 
     
	<script src="assets/js/jquery-1.10.2.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/jquery.metisMenu.js"></script>
    <script src="assets/js/morris/raphael-2.1.0.min.js"></script>
    <script src="assets/js/morris/morris.js"></script>
    <script src="assets/js/custom.js"></script>
    
   
</body>
</html>
<?php
if (isset($_POST['submitdetails'])){

$_SESSION['name'] = $_POST['name'];
$_SESSION['password'] = md5($_POST['password']);
if ($_SESSION['name'] && $_SESSION['password']){
	
global $db;	
	$query = mysqli_query($db, "SELECT * FROM bit_admin WHERE username='".$_SESSION['name']."'");
	$numrows = mysqli_num_rows($query);
	
	if ($numrows != 0){
		
		while ($row = mysqli_fetch_assoc($query)){
			$dbname = $row['username'];
			$dbpassword = $row['password'];
			}
		if ($_SESSION['name']==$dbname){
			if ($_SESSION['password']==$dbpassword){
				if ($dbname == "admin")
				{
					$_SESSION['main'] = true;
				}
			echo "<script>window.open('main.php','_self')</script>";
	    		}else{
		   		echo "<script>alert('Error, Try Again')</script>";
		}
			}else{
			echo "<script>alert('Error, Try Again')</script>";
					}
		}else{
			echo "<script>alert('Error, Try Again')</script>";
				}
	}
}
	?>
 
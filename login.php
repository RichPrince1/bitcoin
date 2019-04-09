<?php
include ("function.php");
global $db;
?>
<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php seo();?>
        <title>Login Form</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="login_assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="login_assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="login_assets/css/form-elements.css">
        <link rel="stylesheet" href="login_assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->

     </head>

    <body>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-8 col-sm-offset-2 text">
                            <h1><strong><?php webname(); ?></strong> Login Form</h1>
                            <div class="description">
                            	<p>
	                            	This is the Customer's Login Form.<br>
									Please fill all information to continue!
                            	</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-sm-offset-3 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Login to our site</h3>
                            		<p>Enter your username and password to log on:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-lock"></i>
                        		</div>
                            </div>
                            <div class="form-bottom">
			                    <form role="form" action="" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Email</label>
			                        	<input type="email" name="email" placeholder="Email..." class="form-username form-control" id="form-username">
			                        </div>
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
			                        </div>
			                	<input type="submit" name="submitdetails" class="btn btn-success" value="Sign in!">
                                </form>
                              Not a member? <a href="register.php">Sign Up</a>!<br>
                              Forgot Password? <a href="recover.php">Click here</a>
		                    </div>
                        </div>
                    </div>
                     </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="login_assets/js/jquery-1.11.1.min.js"></script>
        <script src="login_assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="login_assets/js/jquery.backstretch.min.js"></script>
        <script src="login_assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>
<?php
if (isset($_POST['submitdetails'])){

$_SESSION['email'] = $_POST['email'];
$_SESSION['password'] = md5($_POST['password']);
if ($_SESSION['email'] && $_SESSION['password']){
	
global $db;	
	$query = mysqli_query($db, "SELECT * FROM bit_members WHERE email='".$_SESSION['email']."'");
	$numrows = mysqli_num_rows($query);
	
	if ($numrows != 0){
		
		while ($row = mysqli_fetch_assoc($query)){
			$dbname = $row['email'];
			$dbpassword = $row['password'];
			$user = $row['name'];
			}
		if ($_SESSION['email']==$dbname){
			if ($_SESSION['password']==$dbpassword){
				$_SESSION['user'] = $user; 
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

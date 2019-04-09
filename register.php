<?php
include ("function.php");
global $db;

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


$check = "";
$ref = "";
if (isset($_GET['ref'])){
$check = "checked";
$ref = 	$_GET['ref'];
}

?>

<!DOCTYPE html>
<html lang="en">

    <head>

        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <?php seo();?>
        <title>Registration Form</title>

        <!-- CSS -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Roboto:400,100,300,500">
        <link rel="stylesheet" href="reg_assets/bootstrap/css/bootstrap.min.css">
        <link rel="stylesheet" href="reg_assets/font-awesome/css/font-awesome.min.css">
		<link rel="stylesheet" href="reg_assets/css/form-elements.css">
        <link rel="stylesheet" href="reg_assets/css/style.css">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>

    <body>

		<!-- Top menu -->
		<nav class="navbar navbar-inverse navbar-no-bg" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
				<!--	<a class="navbar-brand" href="index.html"><?php webname(); ?> Registration Form</a> -->
				</div>
			</div>
		</nav>

        <!-- Top content -->
        <div class="top-content">
        	
            <div class="inner-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-sm-7 text">
                            <h1><strong><?php webname(); ?></strong> Registration Form</h1>
                            <div class="description">
                            	<p>
	                            	Please fill in all the information
                            	</p>
                            </div>
                        </div>
                        <div class="col-sm-5 form-box">
                        	<div class="form-top">
                        		<div class="form-top-left">
                        			<h3>Sign up now</h3>
                            		<p>Fill in the form below to get instant access:</p>
                        		</div>
                        		<div class="form-top-right">
                        			<i class="fa fa-pencil"></i>
                        		</div>
                        		<div class="form-top-divider"></div>
                            </div>
                            <div class="form-bottom">
			                <form role="form" action="" method="post" class="login-form">
			                    	<div class="form-group">
			                    		<label class="sr-only" for="form-username">Name</label>
			                        	<input type="text" name="name" placeholder="Name..." class="form-username form-control" id="form-username" required>
			                        </div>
                                    <div class="form-group">
			                    		<label class="sr-only" for="form-email">Email</label>
			                        	<input type="email" name="email" placeholder="Email..." class="form-email form-control" id="form-email" required>
			                        </div>
                                    <div class="form-group">
			                    		<label class="sr-only" for="gsm">Phone Number</label>
			                        	<input type="text" name="gsm" placeholder="Phone Number..." class="gsm form-control" id="gsm" required>
			                        </div>
                                    
                                    
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-password">Password</label>
			                        	<input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password" required>
			                        </div>
                                    
			                        <div class="form-group">
			                        	<label class="sr-only" for="form-conpassword">Confirm Password</label>
			                        	<input type="password" name="conpassword" placeholder="Comfirm Password..." class="form-conpassword form-control" id="form-conpassword" required>
			                        </div>
                                    <div class="form-group">
			                        	<label class="sr-only" for="ref">Referal Code? (Optional)</label>
			                        	Referal Code? (Optional) <input type="checkbox" name="ref" <?php echo $check; ?>>
			                        </div>
                                    
                                    <div class="form-group">
			                        	<label class="sr-only" for="refcode">Enter Referal Code</label>
			                        	<input type="text" name="refcode" placeholder="Enter Referal Code (Optional)" class="refcode form-control" id="refcode" value="<?php echo $ref; ?>">
			                        </div>
                                    
			                        <input type="submit" class="btn btn-primary" name="register" value="Sign Up!">
			                    </form>
                                Already a member? <a href="login.php">Sign In</a>!
		                        </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>


        <!-- Javascript -->
        <script src="reg_assets/js/jquery-1.11.1.min.js"></script>
        <script src="reg_assets/bootstrap/js/bootstrap.min.js"></script>
        <script src="reg_assets/js/jquery.backstretch.min.js"></script>
        <script src="reg_assets/js/retina-1.1.0.min.js"></script>
        <script src="reg_assets/js/scripts.js"></script>
        
        <!--[if lt IE 10]>
            <script src="assets/js/placeholder.js"></script>
        <![endif]-->

    </body>

</html>

<?php
if (isset($_POST['register'])){
	global $db;
	$name = $_POST['name'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$conpassword = $_POST['conpassword'];
	$gsm = $_POST['gsm'];
    
	
	
	
	if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
		echo 'invalid email';
		exit();
		}	
	
	$checkemail = "SELECT * FROM bit_members where email = '$email'"; 
	$checkemail = mysqli_query($db, $checkemail);
	$count = mysqli_num_rows($checkemail);
	
		
	if ($count != 0){
		echo "<script>alert('The email already exist')</script>";
		exit();
				}
	if (strlen($password)<3){
		echo "<script>alert('The password lenght is short')</script>";
		exit();
				}
	if ($conpassword != $password){
		echo "<script>alert('The passwords don\'t match')</script>";
		exit();
			}
		
		
	if (!is_numeric($gsm)){
		echo "<script>alert('Enter a valid phone Number')</script>";
		exit();
	}
        $passwordmb5 = md5($password);
		$code = mt_rand(0, 100000);
   		$refc = mt_rand(0, 10000);
		$refcodep = substr($email,0,3).$refc;     
		
		
		if (($_POST['ref']) == 'on'){
		$refcode = $_POST['refcode'];
		$postref = mysqli_query($db, "insert into refs (user,ref) values ('$email','$refcode')");
		}
		$submit = "insert into bit_members (name, email, password, gsm, datereg, code, refcode) values ('$name','$email','$passwordmb5','$gsm' ,NOW(), '$code','$refcodep')";
		$submit = mysqli_query($db, $submit);
	
	if ($submit){
   	//======================= mail admin
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: Bit2Naira <$adminmail>" . "\r\n";
	$subject = "Welcome Mail";
	$to = "$email";
    $body = "<html>
    <h3>Sent by Admin.</h3><br>
    <hr>
    <div align='center' style='padding: 40px 0 30px 0; font-size: 28px; font-weight: bold; font-family: Arial, sans-serif;'>
    </div>
            <h1>
               Bit2naira            </h1>
        <hr>
        <br />
                <h3>Dear $email,</h3>
                <p>Welcome to the Bit2naira!</p>
                <p>
                    Someone registered the name <b>$name</b> at <a href='http://bit2naira.com'>Bit2naira</a> using this email.
                </p>
                <p>If this was you, please finish the registration process by enering your confirmation code below.</p>
                <p>Code: $code</p>
                <br>
                <br>
                <p>If you did not register for our website, please ignore this email.</p>
    </body>To login to your account, Click <a href='http://bit2naira.com/login.php'>Here</a>.
    
   <br>
    <hr>
    
    For Help and more info contact us at  <br>
    Mail us at <a href='mailto:mail@bit2naira.com'>mail@bit2naira.com</a>
    </html>";
    $send_mail = mail($to, $subject, $body, $headers);
    echo "<script>alert('Succesful')</script>";
    $_SESSION['user'] = $name;
	$_SESSION['email'] = $email;
            echo "<script>window.open('verify.php','_self')</script>";
	}else{
		echo "<script>alert('unsuccessful')</script>";
	}
	}?>

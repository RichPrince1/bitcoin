<?php
include('function.php');
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php seo();?>
    <title>Recover Password</title>
	<link rel="stylesheet" href="login_assets/bootstrap/css/bootstrap.min.css">
        </head>
 <body>
    <div class='container'>
   	<form method="post">
    
    <div class="col-lg-6">
    <div class="form-group">
    Enter your mail:
    <input type="email" class="form-control" name="email">
    </div>
    <input type="submit" class="btn btn-primary" name="submit" value="Submit">
    </div>
    </form>
     </div>
    
    
       </div>
    </body>
</html>
<?php
if (isset($_POST['submit'])){
global $db;	
$email = $_POST['email'];

	$query = mysqli_query($db, "SELECT * FROM bit_members WHERE email='$email'");
	$numrows = mysqli_num_rows($query);
	
	if ($numrows != 0){
	$code = mt_rand(0, 100000);
	$md5pass = md5($code);
	
	   	//======================= mail user
	$headers = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	$headers .= "From: Bit2Naira <$adminmail>" . "\r\n";
	$subject = "Recovery Mail";
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
                <p>Your Bit2Naira Password has been changed successfully!</p>
                <p>Please use this code to login and remember to change it.</p>
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

	
			    $update = mysqli_query($db, "update bit_members set password='$md5pass' where email='$email'");
                echo "<script>alert('Check your mail for you new password')</script>";
				echo "<script>window.open('login.php','_self')</script>";
            }else{
            echo"<script>alert('Incorrect Mail')</script>";
        
        }
		}
		
        ?>
  
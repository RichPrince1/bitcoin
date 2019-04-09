<?php
include('function.php');
if (!isset($_SESSION['user'])){
    echo"<script>window.open('login.php','_self')</script>";
}
if(!isset($_SESSION['code'])){
       echo"<script>window.open('login.php','_self')</script>";
   }

?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php seo();?>
    <title>Verify Account</title>
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
</head>
 <body>
    <div class='container'>
   <div class='col-lg-7'>
      <form class='form-signin' method='post' action =''>
        <h2 class='form-signin-heading'>Verify Account</h2>
        <label for='code' class='sr-only'>Enter Verification Code</label>
        <input type='text' id='code' class='form-control' placeholder='Enter Verification Code' name='code' required>
        <input class='btn btn-lg btn-primary btn-block' type='submit' name='submit' value='Verify Account'>
       </form>
     </div>
    
    
     <?php
if (isset($_POST['submit'])){

$_SESSION['code'] = $_POST['code'];

global $db;	
	$query = mysqli_query($db, "SELECT * FROM bit_members WHERE email='".$_SESSION['email']."' and code='".$_SESSION['code']."'");
	$numrows = mysqli_num_rows($query);
	if ($numrows != 0){
			while ($row = mysqli_fetch_assoc($query)){
			$dbcode = $row['code'];
			}
			if ($_SESSION['code']==$dbcode){
                $yes ="YES";
			    $update = mysqli_query($db, "update bit_members set verified='$yes' where email='".$_SESSION['email']."'");
                echo "<script>window.open('main.php','_self')</script>";
            }
        }else{
            echo"<scipt>alert('incorrect code')</script>";
            $_SESSION['code'] = NULL;
        
}}  
        ?>
    </div>
    </body>
</html>

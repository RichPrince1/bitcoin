<?php
$db = mysqli_connect("localhost","root","","bitcoin");
session_start();

function webname(){
global $db;
$run = mysqli_query($db, "select * from settings");
$row = mysqli_fetch_array($run);
$webname = $row['webname'];
	
echo $webname;	
}
function refamount(){
global $db;
$run = mysqli_query($db, "select * from bit_members where email='".$_SESSION['email']."'");
$row = mysqli_fetch_array($run);
$refamount = $row['refamount'];	

echo $refamount;
}

function info(){
global $db;
$run = mysqli_query($db, "select * from settings");
$row = mysqli_fetch_array($run);
$info = $row['information'];
	
echo $info;	
}
function seo(){
echo '
<meta name="description" content="Welcome to Bit2Naira -  Buy & Sell Bitcoin Online">
<meta name="keywords" content="Bit2Naira Nigeria, Buy, Sell, Nigeria, Ecommerce, Naira etc">
 
<meta name="Language" content="en-us" />
<meta name="Robots" content="All" /> 
<meta name="Author" content="Bit2Naira" /> 
<meta name="copyright" content="2017, Bit2Naira"/>

<link rel="alternate" href="http://bit2naira.com" hreflang="en-ng" />

<meta property="og:url" content="http://www.bit2naira.com" />
<meta property="og:title" content="Bit2Naira" /> 
<meta property="og:description" content="Welcome to Bit2Naira -  Buy & Sell Bitcoin Online" /> 
<meta property="og:type" content="Website" /> 
<meta property="og:image" content="http://www.bit2naira.com/favicon.png" />
<meta property="og:site_name" content="Bit2Naira" />    
<link rel="icon" href="favicon.png">
';	
}
?>


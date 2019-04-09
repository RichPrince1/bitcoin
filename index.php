<?php
include ("function.php");
global $db;
$run = mysqli_query($db, "select * from settings");
$row = mysqli_fetch_array($run);
$buyPM = $row['buyPM'];
$sellPM = $row['sellPM'];
//$buyBC = $row['buyBC'];
//$sellBC = $row['sellBC'];

//echo "<br>";
//print_r($json);


/*
$json  = file_get_contents("https://blockchain.info/ticker");
$json  =  json_decode($json ,true);

$buyBC = $json["USD"]["buy"];
$sellBC = $json["USD"]["sell"];
*/
$buyBC = 400;
$sellBC = 450;
$ratesellBC = $row['ratesellBC'];
$ratesellPM = $row['ratesellPM'];
$ratebuyBC = $row['ratebuyBC'];
$ratebuyPM = $row['ratebuyPM'];
?>

<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php seo(); ?>
    <title><?php webname(); ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href='https://fonts.googleapis.com/css?family=Kaushan+Script' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>

    <!-- Theme CSS -->
    <link href="css/agency.min.css" rel="stylesheet">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
    .table-borderless tbody tr td,
.table-borderless tbody tr th,
.table-borderless thead tr th,
.table-borderless thead tr td,
.table-borderless tfoot tr th,
.table-borderless tfoot tr td {
    border: none;
}
   </style>
<script language="javascript">
function BCconverter(){
var ty = document.converter.ty.value;
var money = document.converter.money.value;
if (ty == 1 && money == 1) {
document.converter.ng.value= document.converter.bc.value * <?php echo $buyBC;?> * <?php echo $ratebuyBC; ?>;
}
if (ty == 1 && money == 2) {
document.converter.ng.value= document.converter.bc.value * <?php echo $buyPM;?> * <?php echo $ratebuyPM; ?>;
}
if (ty == 2 && money == 1) {
document.converter.ng.value= document.converter.bc.value * <?php echo $sellBC;?> * <?php echo $ratesellBC; ?>; 
}
if (ty == 2 && money == 2) {
document.converter.ng.value= document.converter.bc.value * <?php echo $sellPM;?> * <?php echo $ratesellPM; ?>;
}

}


function ngconverter(){
var ty = document.converter.ty.value;
var money = document.converter.money.value;
if (ty == 1 && money == 1) {
document.converter.bc.value= document.converter.ng.value / (<?php echo $buyBC;?> * <?php echo $ratebuyBC; ?>);
}
if (ty == 1 && money == 2) {
document.converter.bc.value= document.converter.ng.value / (<?php echo $buyPM;?> * <?php echo $ratebuyPM; ?>);
}
if (ty == 2 && money == 1) {
document.converter.bc.value= document.converter.ng.value / (<?php echo $sellBC;?> * <?php echo $ratesellBC; ?>);
}
if (ty == 2 && money == 2) {
document.converter.bc.value= document.converter.ng.value / (<?php echo $sellPM;?> * <?php echo $ratesellPM; ?>);
}
	
}



function tychange(){
BCconverter();	
}
function moneychange(){
BCconverter();	
}


</script>

</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-custom navbar-fixed-top">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand page-scroll" href="#page-top"><?php webname(); ?></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li>
                        <a href="login.php">Login</a>
                    </li>
                    <li>
                        <a href="register.php">Register</a>
                    </li>
                    </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header>
        <div class="container">
  <div class="col-lg-12"><br><br><br><br><br><br></div>
  
  <marquee behavior="scroll" direction="left"><span class="h4" style="color:white"><?php info(); ?></span></marquee>
  
            <div class="intro-text">
  
          <div class="container">
            <div class="row">
            <div class="col-lg-4 col-md-3 col-xs-3 pull-left">
            <h2 class="section-heading">Rates</h2>
           <table class="table table-borderless">
           <tr>
           <th></th>
           <td><span style="color:white">Buy</span></td>
           <td><span style="color:white">Sell</span></td>
           </tr>

           <tr>
            <td><span style="color:white">Blockchain rate</span></td>
            <td><span style="color:white">$<?php echo $buyBC;?></span></td>
            <td><span style="color:white">$<?php echo $sellBC;?></span></td>

            </tr>
          
           <tr>
           <td><span style="color:white">BTC</span></td>
           <td><span style="color:white">&#8358;<?php echo $ratebuyBC; ?></span></td>
           <td><span style="color:white">&#8358;<?php echo $ratesellBC; ?></span></td>
           </tr>
           

<!--
           <tr>
           <td><span style="color:white">PM</span></td>
           <td><span style="color:white">&#8358;<?php //echo $ratebuyPM; ?></span></td>
           <td><span style="color:white">&#8358;<?php //echo $ratesellPM; ?></span></td>
           </tr>
-->          
           </table> 
         
           </div>
            
                <div class="col-lg-3 col-md-6 col-xs-5 pull-right">
                  
            <div class="row">
              <h4>BitCoin Calculator</h4>
            
            <form name="converter">
            <div class="form-group">
            <br>
            <select class="form-control" id="ty" onChange="tychange()">
            <option value=1>Buy</option>
            <option value=2>Sell</option>
            </select>
            </div>
            
            
            <div class="form-group">
            <br>
            <select class="form-control" id="money" onChange="moneychange()">
            <option>--Select--</option>
          
            <option value=1>BTC</option>
            <!--<option value=2>PM</option>-->
            </select>
            </div>
            
            <div class="form-group">
            BTC
            <input type="number" class="form-control" name="bc" id="bc" onKeyUp="BCconverter()">
            </div>
            
            <div class="form-group">
            NGN
            <input type="number" class="form-control" name="ng" id="ng" onKeyUp="ngconverter()">
                       
            </div>
            <input type="submit" value="Calculate!" class="hidden">
            </form>
            </div>
    
            </div>
        </div>
    </header>
	
   <!-- Services Section -->
    <section id="services">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Services</h2>
                    <h3 class="section-subheading text-muted">At <?php webname(); ?> We offer the following services.</h3>
                </div>
            </div>
            <div class="row text-center">
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-shopping-cart fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">E-Commerce</h4>
                    <p class="text-muted">We offer a fast medium to buy and sell bitcoin online.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-laptop fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Quick Response</h4>
                    <p class="text-muted">We are avalaible to listen to any suggestions or complain.</p>
                </div>
                <div class="col-md-4">
                    <span class="fa-stack fa-4x">
                        <i class="fa fa-circle fa-stack-2x text-primary"></i>
                        <i class="fa fa-lock fa-stack-1x fa-inverse"></i>
                    </span>
                    <h4 class="service-heading">Web Security</h4>
                    <p class="text-muted">Every transaction made on this site is fully secured and encrypted.</p>
                </div>
            </div>
        </div>
    </section>

   
    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2 class="section-heading">Contact Us</h2>
                    <h3 class="section-subheading text-muted">You could send us a message with the form below.</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <form name="sentMessage" id="contactForm" novalidate>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" placeholder="Your Name *" id="name" required data-validation-required-message="Please enter your name.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control" placeholder="Your Email *" id="email" required data-validation-required-message="Please enter your email address.">
                                    <p class="help-block text-danger"></p>
                                </div>
                                <div class="form-group">
                                    <input type="tel" class="form-control" placeholder="Your Phone *" id="phone" required data-validation-required-message="Please enter your phone number.">
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="Your Message *" id="message" required data-validation-required-message="Please enter a message."></textarea>
                                    <p class="help-block text-danger"></p>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-lg-12 text-center">
                                <div id="success"></div>
                                <button type="submit" class="btn btn-xl">Send Message</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <span class="copyright">Copyright &copy; <?php webname(); ?> 2017</span>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline social-buttons">
                        <li><a href="#"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li><a href="#"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <ul class="list-inline quicklinks">
                        <li><a href="#">Disclaimer</a>
                        </li>
                        <li><a href="#">Terms of Use</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </footer>

    
    <script src="vendor/jquery/jquery.min.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
	<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>
	<script src="js/jqBootstrapValidation.js"></script>
    <script src="js/contact_me.js"></script>
	<script src="js/agency.min.js"></script>
</body>
</html>

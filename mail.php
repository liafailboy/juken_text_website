<?php

// basic settings section
$sendto = 'contact.jukentext@gmail.com';
$subject = 'New Email Subscriber';
$iserrormessage = 'There was a problem with sending e-mail to us, please check:';
$thanks = "<div style='font-family:arial; padding: 10px; width:500px;height:200px; background:#000; margin:0 auto; margin-top: 50px; color: #fff; text-align:center;'><h1 style='padding-top:30px;'>Thank's for your signing up for our email list!</h1> <p>You will recieve our monthly newsletter.</p></div>";


$emptyemail = 'Did you enter your e-mail address?';

$alertemail = 'Please enter your e-maill address in format: name@domain.com';

$alert = '';
$iserror = 0;

// cleaning the post variables
function clean_var($variable) {$variable = strip_tags(stripslashes(trim(rtrim($variable))));return $variable;}

// validation of filled form



if ( empty($_REQUEST['email']) ) {
	$iserror = 1;
	$alert .= "<li>" . $emptyemail . "</li>";
} elseif ( !eregi("^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$", $_REQUEST['email']) ) {
	$iserror = 1;
	$alert .= "<li>" . $alertemail . "</li>";
}



// if there was error, print alert message
if ( $iserror==1 ) {

echo "<script type='text/javascript'>$(\".message\").hide(\"slow\").fadeIn(\"slow\").delay(5000).fadeOut(\"slow\"); </script>";
echo "<strong>" . $iserrormessage . "</strong>";
echo "<ul>";
echo $alert;
echo "</ul>";

} else {
// if everything went fine, send e-mail

$msg = "From: " . clean_var($_REQUEST['name']) . "\n";
$msg .= "Email: " . clean_var($_REQUEST['email']) . "\n";
$header = 'From:'. clean_var($_REQUEST['email']);

mail($sendto, $subject, $msg, $header);

echo "<script type='text/javascript'>$(\".message\").fadeOut(\"slow\").fadeIn(\"slow\").animate({opacity: 1.0}, 5000).fadeOut(\"slow\");</script>";
echo $thanks;

die();
}
?>
<?php
include("db_connect.php");

if($_POST["email"] == "") die('Parameter "email" is missing.');
$email = mysqli_real_escape_string($con, $_POST["email"]);

if($_POST["username"] == "") die('Parameter "username" is missing.');
$username = mysqli_real_escape_string($con, $_POST["username"]);

$password = randomPassword(8);
$md5_password = md5($password);



$cost = 10;
$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
$salt = sprintf("$2a$%02d$", $cost) . $salt;
$hash = crypt($md5_password, $salt);

$res = mysqli_query($con, "SELECT id FROM mbd_users WHERE email='".$email."'");
if($res != false && mysqli_num_rows($res)>0){
	mysqli_close($con);
	die("E-Mail is already in use");
}
$res = mysqli_query($con, "SELECT id FROM mbd_users WHERE username='".$username."'");
if($res != false && mysqli_num_rows($res)>0){
	mysqli_close($con);
	die("Username is already in use");
}

$sql = "INSERT INTO mbd_users (username, hash, email) VALUES ('".$username."', '".$hash."', '".$email."')";
$check = mysqli_query($con, $sql);
if($check == FALSE){
	$err = mysqli_error($con);
	mysqli_close($con);
	die("Error writing Data into Database:<br/>\n".$err);
}

$msg = "Welcome ".$username.",\n";
$msg .= "Thank you for registering to myBodyData!\n";
$msg .= "Your temporary Password is:\n\n";
$msg .= $password;
$msg .= "\n\nYou should Change it on your first Login.\n\n";
$msg .= "Have Fun!\n";
$msg .= $AUTHOR;

$header = 'From: '.$MAIL . "\r\n" .
		'Reply-To:'.$MAIL . "\r\n" .
		'X-Mailer: PHP/' . phpversion();

$check = mail($email,$TITLE,$msg, $header);
if($check != TRUE){
	die("Error sending E-Mail.");
}

echo "0";

//Genereate a Random passwort
function randomPassword($length) {
	$alphabet = "abcdefghijklmnopqrstuwxyzABCDEFGHIJKLMNOPQRSTUWXYZ0123456789?#+-_!$&";
	$pass = array(); //remember to declare $pass as an array
	$alphaLength = strlen($alphabet) - 1; //put the length -1 in cache
	for ($i = 0; $i < $length; $i++) {
		$n = rand(0, $alphaLength);
		$pass[] = $alphabet[$n];
	}
	return implode($pass); //turn the array into a string
}
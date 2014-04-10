<?php


if($_GET["email"] == "") die('Parameter "email" is missing.');
$email = mysql_real_escape_string($_GET["email"]);

if($_GET["username"] == "") die('Parameter "username" is missing.');
$username = mysql_real_escape_string($_GET["username"]);

$password = randomPassword(8);
$md5_password = md5($password);

include("db_connect.php");

$cost = 10;
$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
$salt = sprintf("$2a$%02d$", $cost) . $salt;
$hash = crypt($md5_password, $salt);

if(mysqli_num_rows(mysqli_query($con, "SELECT id FROM mdb_users WHERE email='"+$email+"'"))>0){
	mysqli_close($con);
	die("E-Mail is already in use");
}
if(mysqli_num_rows(mysqli_query($con, "SELECT id FROM mdb_users WHERE username='"+$username+"'"))>0){
	mysqli_close($con);
	die("Username is already in use");
}

$sql = "INSERT INTO mdb_users (username, hash, email) VALUES ('"+$username+"', '"+$hash+"', '"+$email+"')";
$check = mysqli_query($con, $sql);
mysqli_close($con);
if($check != TRUE){
	die("Error writing Data into Database.");
}

$msg = "Welcome "+$username+",\n";
$msg .= "Thank you for registering to myBodyData!\n";
$msg .= "Your temporary Password is:\n\n";
$msg .= $password;
$msg .= "\n\nYou should Change it on your first Login.\n\n";
$msg .= "Have Fun!\n";
$msg .= $AUTHOR;

$check = mail($email,$TITLE,$msg);
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
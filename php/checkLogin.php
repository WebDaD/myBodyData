<?php
//check login
include("db_connect.php");

if($_POST["user"] == "") die('Error: Parameter "user" is missing.');
$user = strtolower(mysqli_real_escape_string($con, $_POST["user"]));

if($_POST["password"] == "") die('Error: Parameter "password" is missing.');
$password = mysqli_real_escape_string($con, $_POST["password"]);

$sql = "SELECT id, hash FROM mbd_users WHERE username='".$user."'";
$res = mysqli_query($con,$sql);
if($res != false && mysqli_num_rows($res)>0){
	$row = mysqli_fetch_object($res);
	mysqli_close($con);
	if ( crypt($password, $row->hash) === $row->hash ) {
		echo $row->id;
	} else {
		echo "Error: User/Pwd-Combination incorrect";
	}
} else {
	$err = mysqli_error($con);
	mysqli_close($con);
	echo "Error:\n".$err."\n".$sql;
}
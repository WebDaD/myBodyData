<?php
//check login
include("db_connect.php");

if($_POST["user"] == "") die('Parameter "user" is missing.');
$user = mysql_real_escape_string($_GET["user"]);

if($_POST["password"] == "") die('Parameter "password" is missing.');
$password = mysql_real_escape_string($_GET["password"]);

$sql = "SELECT id, hash FROM mdb_users WHERE username='"+$user+"'";
$res = mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0){
	$row = mysqli_fetch_object($res);
	mysqli_close($con);
	if ( crypt($password, $row["hash"]) === $row["hash"] ) {
		echo $row["id"];
	} else {
		echo "0";
	}
} else {
	mysqli_close($con);
	echo "0";
}
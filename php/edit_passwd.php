<?php
include("db_connect.php");

if($_POST["user_id"] == "") die('Parameter "user_id" is missing.');
$user_id = mysql_real_escape_string($_POST["user_id"]);

if($_POST["old_pwd"] == "") die('Parameter "old_pwd" is missing.');
$old_pwd = mysql_real_escape_string($_POST["old_pwd"]);

if($_POST["new_pwd"] == "") die('Parameter "new_pwd" is missing.');
$new_pwd = mysql_real_escape_string($_POST["new_pwd"]);

//check if old pwd is correct:
$sql = "SELECT id, hash FROM mdb_users WHERE id='"+$user_id+"'";
$res = mysqli_query($con,$sql);
if(mysqli_num_rows($result)>0){
	$row = mysqli_fetch_object($res);
	if ( crypt($password, $row["hash"]) === $row["hash"] ) {
		//pwd correct
		$cost = 10;
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		$salt = sprintf("$2a$%02d$", $cost) . $salt;
		$hash = crypt($new_pwd, $salt);
		
		$sql_ins = "UPDATE mdb_users SET hash='"+$hash+"' WHERE id="+$user_id;
		$check = mysqli_query($con, $sql_ins);
		mysqli_close($con);
		if($check != TRUE){
			echo "1";
		} else{
			echo "0";
		}
	} else {
		mysqli_close($con);
		echo "1";
	}
} else {
	mysqli_close($con);
	echo "1";
}
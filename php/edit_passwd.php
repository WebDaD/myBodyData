<?php
include("db_connect.php");


if($_POST["user_id"] == "") die('Parameter "user_id" is missing.');
$user_id = mysqli_real_escape_string($con, $_POST["user_id"]);

if($_POST["old_pwd"] == "") die('Parameter "old_pwd" is missing.');
$old_pwd = mysqli_real_escape_string($con, $_POST["old_pwd"]);

if($_POST["new_pwd"] == "") die('Parameter "new_pwd" is missing.');
$new_pwd = mysqli_real_escape_string($con, $_POST["new_pwd"]);

//check if old pwd is correct:
$sql = "SELECT id, hash FROM mbd_users WHERE id='".$user_id."'";
$res = mysqli_query($con,$sql);
if($res != false && mysqli_num_rows($res)>0){
	$row = mysqli_fetch_object($res);
	if ( crypt($password, $row->hash) === $row->hash ) {
		//pwd correct
		$cost = 10;
		$salt = strtr(base64_encode(mcrypt_create_iv(16, MCRYPT_DEV_URANDOM)), '+', '.');
		$salt = sprintf("$2a$%02d$", $cost) . $salt;
		$hash = crypt($new_pwd, $salt);
		
		$sql_ins = "UPDATE mbd_users SET hash='".$hash."' WHERE id=".$user_id;
		$check = mysqli_query($con, $sql_ins);
		$err = mysqli_error($con);
		mysqli_close($con);
		if($check != TRUE){
			echo $err;
		} else{
			echo "0";
		}
	} else {
		$err = mysqli_error($con);
		mysqli_close($con);
		echo $err;
	}
} else {
	$err = mysqli_error($con);
	mysqli_close($con);
	echo $sql."\n".$err;
}
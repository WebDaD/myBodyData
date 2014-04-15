<?php
include("db_connect.php");

if($_POST["weight"] == "") die('Parameter "weight" is missing.');
$weight = mysqli_real_escape_string($con, $_POST["weight"]);

if($_POST["size"] == "") die('Parameter "size" is missing.');
$size = mysqli_real_escape_string($con, $_POST["size"]);

if($_POST["user_id"] == "") die('Parameter "user_id" is missing.');
$user_id = mysqli_real_escape_string($con, $_POST["user_id"]);


$sql_ins = "INSERT INTO mbd_data (user_id, weight, size, datum) VALUES (".$user_id.", '".$weight."', '".$size."', DATE(NOW()))
		ON DUPLICATE KEY UPDATE weight='".$weight."', size='".$size."'";

$check = mysqli_query($con, $sql_ins);
if($check != TRUE){
	$err = mysqli_error($con);
	mysqli_close($con);
	echo "Error:\n".$err."\n".$sql_ins;
} else {
	$sql_get = "SELECT weight, size FROM mbd_data WHERE user_id=".$user_id." ORDER BY datum DESC LIMIT 1,1";
	$res = mysqli_query($con,$sql_get);
	if($res != false && mysqli_num_rows($res)>0){ 
		$row = mysqli_fetch_object($res);
		mysqli_close($con);
		$w_diff = floatval($row->weight) - floatval($weight);
		$s_diff = floatval($row->size) - floatval($size);
		$msg = "Difference to yesterday:<br/>";
		$msg .= "Weight: ";
		if($w_diff>0){
			$msg .= "<span class=\"good\">- ".abs($w_diff)."</span>";
		} else {
			$msg .= "<span class=\"bad\">+ ".abs($w_diff)."</span>";
		}
		$msg.="<br/>";
		$msg .= "Size: ";
		if($s_diff>0){
			$msg .= "<span class=\"good\">+ ".$s_diff."</span>";
		} else {
			$msg .= "<span class=\"bad\">- ".$s_diff."</span>";
		}
		echo $msg;
	} else {
		mysqli_close($con);
		echo "Thank you for your first entry!";
	}
}
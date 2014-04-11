<?php
include("db_connect.php");

if($_POST["weight"] == "") die('Parameter "weight" is missing.');
$weight = mysql_real_escape_string($_POST["weight"]);

if($_POST["size"] == "") die('Parameter "size" is missing.');
$size = mysql_real_escape_string($_POST["size"]);

if($_POST["user_id"] == "") die('Parameter "user_id" is missing.');
$user_id = mysql_real_escape_string($_POST["user_id"]);


$sql_ins = "INSERT INTO mdb_data (user_id, weight, size, datum) VALUES ("+$user_id+", '"+$weight+"', '"+$size+"', DATE(NOW()))
		ON DUPLICATE KEY UPDATE weight='"+$weight+"', size='"+$size+"'";

$check = mysqli_query($con, $sql_ins);

if($check != TRUE){
	mysqli_close($con);
	echo "1";
} else {
	$sql_get = "SELECT weight, size FROM mdb_data WHERE user_id= ORDER BY datum DESC LIMIT 1,1";
	$res = mysqli_query($con,$sql_get);
	if(mysqli_num_rows($result)>0){
		$row = mysqli_fetch_object($res);
		mysqli_close($con);
		$w_diff = $weight - $row["weight"];
		$s_diff = $size - $row["size"];
		$msg = "Difference to yesterday:<br/>";
		$msg .= "Weight: ";
		if($w_diff>0){
			$msg .= "<span class=\"good\">".$w_diff."</span>";
		} else {
			$msg .= "<span class=\"bad\">".$w_diff."</span>";
		}
		$msg.="<br/>";
		$msg .= "Size: ";
		if($s_diff>0){
			$msg .= "<span class=\"good\">".$s_diff."</span>";
		} else {
			$msg .= "<span class=\"bad\">".$s_diff."</span>";
		}
	} else {
		mysqli_close($con);
		echo "Thank you for your first entry!";
	}
}
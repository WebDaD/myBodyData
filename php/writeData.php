<?php
include("db_connect.php");

if($_GET["weight"] == "") die('Parameter "weight" is missing.');
$weight = mysql_real_escape_string($_GET["weight"]);

if($_GET["size"] == "") die('Parameter "size" is missing.');
$size = mysql_real_escape_string($_GET["size"]);

if($_GET["user_id"] == "") die('Parameter "user_id" is missing.');
$user_id = mysql_real_escape_string($_GET["user_id"]);


$sql = "";
//date now (SQL)



mysql_close();
<?php
include("db_connect.php");

if($_GET["weight"] == "") die('Parameter "weight" is missing.');
$weight = mysql_real_escape_string($_GET["weight"]);

if($_GET["size"] == "") die('Parameter "size" is missing.');
$size = mysql_real_escape_string($_GET["size"]);

//date now

//user_id form session

mysql_close();
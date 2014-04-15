<?php
/**
 * Opens the Database Connection
 *
 * Attention: perform mysql_close() after use!
 *
 * @return open Connection
 * @version 1.0
 * @since 0.1
 * @author Dominik Sigmund
 *
 */
include("../config.php");

$con = mysqli_connect($DB["server"], $DB["user"], $DB["password"],$DB["database"]) or die("Unable to reach Database!");

mysqli_query($con, "SET NAMES utf8");
?>
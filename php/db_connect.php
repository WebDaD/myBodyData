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

mysql_connect($DB["server"], $DB["user"], $DB["password"]) or die("Unable to reach Database, check User");
mysql_select_db($DB["database"]) or die("Unable to reach specific Database, check Database");

mysql_query("SET NAMES utf8");
?>
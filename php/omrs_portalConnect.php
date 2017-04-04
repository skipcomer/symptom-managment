<?php

	$dbhost = '<dbhost>';
	$dbuser = '<dbuser>';
	$dbpwd  = '<dbpwd>';
	$dbname = '<dbname>';
	
	$conn = mysql_connect($dbhost, $dbuser, $dbpwd);
	$db   = mysql_select_db($dbname, $conn);
?>
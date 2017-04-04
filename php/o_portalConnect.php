<?php

	$dbhost = '<dbhost>';
	$dbuser = '<dbuser>';
	$dbpwd  = '<dbpwd>';
	$dbname = '<dbname>';
	
	$link = mysqli_connect($dbhost, $dbuser, $dbpwd, $dbname);

	if (!$link) {
		die('Connect Error (' . mysqli_connect_errno() . ') '
				. mysqli_connect_error());
	}
?>
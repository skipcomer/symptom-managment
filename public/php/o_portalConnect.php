<?php

    /*
    $dir = "../notpublic/auth/";

    // Open a directory, and read its contents
    if (is_dir($dir)){
      if ($dh = opendir($dir)){
        while (($file = readdir($dh)) !== false){
          echo "filename:" . $file . "<br>";
        }
        closedir($dh);
      }
    }
    */
    require_once(dirname(__FILE__) . "/../../notpublic/auth/mysql_auth.php");  // __FILE__ returns file path of current file (e.g., /public/php/o_portalConnect.php)

	$dbhost = MYSQL_DATABASE_HOST;
	$dbuser = MYSQL_USERNAME;
	$dbpwd  = MYSQL_PASSWORD;
	$dbname = MYSQL_DATABASE;
	
	$link = mysqli_connect($dbhost, $dbuser, $dbpwd, $dbname);

	if (!$link) {
		die('Connect Error (' . mysqli_connect_errno() . ') '
				. mysqli_connect_error());
	}
?>
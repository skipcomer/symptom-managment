<?php

$s_query = "SELECT * FROM screenlist 
			WHERE seq = '".$seq."'";
$s_result = mysqli_query($link, $s_query);

$screen_info_array = array();

$s_row =  mysqli_fetch_array($s_result, MYSQLI_ASSOC);
$screen_info_array[] = $s_row;

?>
<?php

$seq_array = explode('_',$seq);
$top_level = '_'.$seq_array[1];

$s_query = "SELECT * FROM screenlist 
			WHERE seq LIKE '".$top_level."____'
			AND seq > '_000'
			AND s_type = 'screen'";
$s_result = mysqli_query($link, $s_query);

$submenu_array = array();

while($s_row =  mysqli_fetch_array($s_result, MYSQLI_ASSOC)){
	$submenu_array[$s_row["seq"]] = $s_row;
}

?>
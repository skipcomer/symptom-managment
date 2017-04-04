<?php

$s_query = "SELECT * FROM screenlist 
			WHERE seq LIKE '____'
			AND seq > '_000'";
$s_result = mysqli_query($link, $s_query);

$screen_array = array();

while($s_row =  mysqli_fetch_array($s_result, MYSQLI_ASSOC)){
	$screen_array[$s_row["seq"]] = $s_row;
	$sub_query = "SELECT * FROM screenlist 
					WHERE seq LIKE '".$s_row["seq"]."____'";
	$sub_result = mysqli_query($link, $sub_query);
	while($sub_row = mysqli_fetch_array($sub_result, MYSQLI_ASSOC)){
		$screen_array[$s_row["seq"]]["submenu"][$sub_row["seq"]] = $sub_row;
	}
}

?>
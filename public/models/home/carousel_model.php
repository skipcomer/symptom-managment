<?php

$c_query = "SELECT * FROM carousel";
$c_result = mysqli_query($link, $c_query);

$carousel_array = array();

while($c_row =  mysqli_fetch_array($c_result, MYSQLI_ASSOC)){
	$carousel_array[] = $c_row;
}

?>
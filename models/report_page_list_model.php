<?php

//report_page_list_model
//gets list of symptom report screens

$s_query = "SELECT * from screenlist 
						WHERE seq LIKE '_003_002____'
						AND s_type = 'screen'";
$s_result = mysqli_query($link, $s_query);	

$report_page_array = array();

while($s_row = mysqli_fetch_array($s_result, MYSQLI_BOTH)){
	$report_page_array[] = $s_row;
}

?>
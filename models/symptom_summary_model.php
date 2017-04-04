<?php
	//get the quiz id
	$seq_array = explode("_",$seq);
	$count = count($seq_array);
	
	$quiz_id = "1";
	for($i=1;$i<3;$i++){
		$quiz_id .= $seq_array[$i];
	}
	$quiz_id .= "05";
	
	$count = count($seq_array);
	$q_id = "_";
	for($i=1;$i<$count;$i++){
		$q_id .= $seq_array[$i];
	}
	
	$sc_query = "SELECT id, seq, s_name, displaylist_id FROM screenlist
			WHERE seq LIKE '_003_002_0__'
			AND s_type = 'screen'";
	$sc_result = mysqli_query($link, $sc_query);
	
	$symptom_summary_array = array();
	
	$counter = 0;
	while($sc_row = mysqli_fetch_array($sc_result, MYSQLI_BOTH)){
		$summary_record = array();
		$summary_record["seq"] = $sc_row["seq"];
		$summary_record["s_name"] = $sc_row["s_name"];
		
		$oddeven = $counter%2;
		$summary_record["tr_class"] = "even_row";
		switch ($oddeven){
			case 0:$summary_record["tr_class"] = "even_row";break;
			case 1:$summary_record["tr_class"] = "odd_row";break;
		}
		
		$r_query = "SELECT response from response_data WHERE 
				user_id = '".$_SESSION["user_id"]."'
				AND session_id = '".$_SESSION["mysql_sid"]."'
				AND quiz_id = '".$quiz_id."'
				AND question_id = '".$sc_row["displaylist_id"]."'";
		$response_result = 	mysqli_query($link, $r_query);
		
		$response = NULL;
		$summary_record["response"] = 0;
		if (mysqli_num_rows($response_result) > 0){
			$r_row = mysqli_fetch_array($response_result, MYSQLI_BOTH);
			$summary_record["response"] = $r_row["response"];
		}
		$symptom_summary_array[] = $summary_record;
		$counter ++;
	}
	
?>
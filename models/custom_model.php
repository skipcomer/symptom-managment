<?php

//custom_model
//compiles custom guide data

$custom_array = array();

//get the last user session
$session_query = "SELECT session_id FROM response_data 
					WHERE user_id = '".$_SESSION["user_id"]."'
					AND quiz_id = '100300205'
					ORDER BY session_id DESC LIMIT 1";
$session_result = mysqli_query($link, $session_query);	

if(mysqli_num_rows($session_result) > 0)	{
	$session_row = mysqli_fetch_array($session_result, MYSQLI_BOTH);
	$last_session = $session_row["session_id"];	
	
	$r_query =  "SELECT response, question_id from response_data WHERE 
					user_id = '".$_SESSION["user_id"]."'
					AND session_id = '".$last_session."'
					AND quiz_id = '100300205'
					ORDER BY response DESC";
	$r_result = mysqli_query($link, $r_query);
	
	$counter = 0;
	while($r_row = mysqli_fetch_array($r_result, MYSQLI_BOTH)){
		$custom_record = array();
		if($r_row["response"] > 0){
			$s_query = "SELECT seq, s_name, displaylist_id FROM screenlist
					WHERE displaylist_id = '".$r_row["question_id"]."'
					AND s_type = 'screen'";
			$s_result = mysqli_query($link, $s_query);
			$s_row = mysqli_fetch_array($s_result, MYSQLI_BOTH);
			
			$seq_array = explode("_",$s_row["seq"]);
			$this_seq = "_".$seq_array[1]."_003_".$seq_array[3];
			$custom_record["link"] = $this_seq;
			$custom_record["s_name"] = $s_row["s_name"];
			
			switch (true){
				case ($r_row["response"] < 4): $custom_record["level"] = "Mild";break;
				case ($r_row["response"] > 6): $custom_record["level"] = "Severe";break;
				default:$custom_record["level"] = "Moderate";break;
			}
			$custom_array[] = $custom_record;
		} // end  if($r_row["response"] > 0){
		$counter++;
	}// end while($r_row = mysqli_fetch_array($r_result, MYSQLI_BOTH))

}  // end if(mysqli_num_rows($session_result) > 0)

?>
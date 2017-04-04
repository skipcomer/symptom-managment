<?php

	$dbconnect = "o_portalConnect.php";
	include($dbconnect);  // make a mysqli connection


	
	if((isset($_REQUEST['user_id']))&&(isset($_REQUEST['session']))&&(isset($_REQUEST['quiz_id']))&&(isset($_REQUEST['q_id']))&&(isset($_REQUEST['report']))&&(isset($_REQUEST['q_text']))&&(isset($_REQUEST['mdata_type']))){
		// data sent from form 
		$user_id = $_REQUEST['user_id']; 
		$mysql_session = $_REQUEST['session']; 
		$quiz_id =  $_REQUEST['quiz_id']; 
		$question_id =  $_REQUEST['q_id']; 
		$answer_id = html_entity_decode($_REQUEST['report']); 
		$q_text = html_entity_decode($_REQUEST['q_text']); 
		//$q_text = addslashes($q_text);
		$mdata_type = $_REQUEST['mdata_type']; 
		
		// To protect MySQL injection 
		$user_id = stripslashes($user_id);
		$mysql_session = stripslashes($mysql_session);
		$quiz_id = stripslashes($quiz_id);
		$question_id = stripslashes($question_id);
		$answer_id = stripslashes($answer_id);
		$q_text = stripslashes($q_text);
		$mdata_type = stripslashes($mdata_type);
		
		$user_id = mysqli_real_escape_string($link, $user_id);
		$mysql_session = mysqli_real_escape_string($link, $mysql_session);
		$quiz_id = mysqli_real_escape_string($link, $quiz_id);
		$question_id = mysqli_real_escape_string($link, $question_id);
		$answer_id = mysqli_real_escape_string($link, $answer_id);
		$q_text = mysqli_real_escape_string($link, $q_text);
		$mdata_type = mysqli_real_escape_string($link, $mdata_type);
		
		$query = "SELECT * FROM response_data
			WHERE session_id = '".$mysql_session."'
			AND user_id = '".$user_id."'
			AND quiz_id = '".$quiz_id."' 
			AND question_id = '".$question_id."'";
	 	$result = mysqli_query($link, $query);
		
		if (mysqli_num_rows($result) > 0){
			
			$row = mysqli_fetch_assoc($result);
	 
		  	$query = "UPDATE `response_data` SET 
				`response` = '".$answer_id."',
				`response_link` = '".$q_text."',
				`mdata_type` = '".$mdata_type."',
				`metadata` = '".$row["metadata"]."',
				`timestamp` = NOW()
				WHERE  session_id = '".$mysql_session."'
				AND quiz_id = '".$quiz_id."'
				AND question_id = '".$question_id."'";
		  	$result = mysqli_query($link, $query);
		 }else{
			 $metadata = "mdata";	 
			 $query = "INSERT INTO `response_data`  VALUES
				(NULL, '".$user_id."','".$mysql_session."', '".$quiz_id."', '".$question_id."', '".$answer_id."', '".$q_text."',
				'".$mdata_type."', '".$metadata."', NULL)";
			 $result = mysqli_query($link, $query);
		 
		 } //end if mysql_num_rows
		 
	}//end if isset
	
	//mysqli_close();
	
//	if(isset($_REQUEST['seq'])){
//		header("location:../index.php?seq=".$_REQUEST['seq']);
//	}
	
?>
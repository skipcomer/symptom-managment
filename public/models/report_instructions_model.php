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
//find the question -- and related quiz info -- and the answer list ID
$dt_query = "SELECT quiz.id as quiz_id, quiz.quiz_name, question.id as q_id, question.q_text, question.a_list_id, question.metadata, question.mdata_type 
				FROM quiz, quiz_list, question
				WHERE question.id LIKE '".$q_id."'
				LIMIT 1";
$dt_result = mysqli_query($link, $dt_query);
$dt_row = mysqli_fetch_array($dt_result, MYSQLI_BOTH);

$this_quiz = $dt_row["quiz_id"];
$this_question = $dt_row["q_id"];
$this_a_list = $dt_row["a_list_id"];
$question_text = $dt_row["q_text"];
$this_mdatatype = $dt_row["mdata_type"];

//get the answer_texts (the toxicity criteria statements)
$a_query = "SELECT a_text FROM answer, answer_list 
			WHERE answer_list.q_id = '".$this_a_list."'
			AND answer.id = answer_list.a_id
			AND answer.option_id < 4";
$a_result = mysqli_query($link, $a_query);

//put the instruction strings in an array
$report_instructions_array = array();
while ($a_row = mysqli_fetch_array($a_result, MYSQLI_BOTH)){
	$report_instructions_array[] = $a_row["a_text"];
}

// get ALL responses, ordered in sequence, find the last session
$dtr_query = "SELECT response from response_data WHERE 
			user_id = '".$_SESSION["user_id"]."'
			AND quiz_id = '".$this_quiz."'
			AND question_id = '".$this_question."'
			AND session_id < '".$_SESSION["mysql_sid"]."'
			ORDER BY id DESC
			LIMIT 1";
$dtresponse_result = mysqli_query($link, $dtr_query);

$dtresponse = 0;
$most_recent_response = 0;
if (mysqli_num_rows($dtresponse_result) > 0){
	$dtr_row = mysqli_fetch_array($dtresponse_result, MYSQLI_BOTH);
	$dtresponse = $dtr_row["response"];
	$most_recent_response = $dtresponse;
}
//echo "saved_response:".$dtresponse."---";
// get ALL responses, ordered in sequence, find the most recent
$most_recent_query = "SELECT response from response_data WHERE 
			user_id = '".$_SESSION["user_id"]."'
			AND quiz_id = '".$this_quiz."'
			AND question_id = '".$this_question."'
			AND session_id = '".$_SESSION["mysql_sid"]."'
			ORDER BY session_id DESC
			LIMIT 1";
			
$most_recent_result = mysqli_query($link, $most_recent_query);

if (mysqli_num_rows($most_recent_result) > 0){
	$most_recent_row = mysqli_fetch_array($most_recent_result, MYSQLI_BOTH);
	$most_recent_response = $most_recent_row["response"];
}
	
?>
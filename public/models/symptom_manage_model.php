<?php
//symptom_talk_model
//gets content to display on symptom talk/resources screens

$symptom_manage_array = array();

$seq_array = explode("_",$seq);
$count = count($seq_array);

$quiz_id = "100300205";
$topic_seq = "";
for($i=1;$i<$count-1;$i++){
	$topic_seq .= "_".$seq_array[$i];
}

$seq_id = '1______';
$question_id = $seq_id.$seq_array[$count-2];
$response_q_id = '1003002'.$seq_array[$count-2];
$seq_id .= $seq_array[$count-2].$seq_array[$count-1];

$t_query = "SELECT s_name, displaylist_id from screenlist WHERE seq = '".$seq."'";
$t_result = mysqli_query($link, $t_query);
$t_row = mysqli_fetch_array($t_result, MYSQLI_BOTH );
$this_title = $t_row["s_name"];

$h_query = "SELECT html_id, html from texthtml WHERE html_id LIKE '".$seq_id."___' LIMIT 1";
$h_result = mysqli_query($link, $h_query);
$h_row = mysqli_fetch_array($h_result, MYSQLI_BOTH);
$heading_level = substr($h_row["html_id"],-3);
$symptom_manage_array["heading"] = $h_row["html"];

$tc_query = "SELECT html_id, html from texthtml WHERE html_id LIKE '".$h_row["html_id"]."___'";
$tc_result = mysqli_query($link, $tc_query );

$tc_array = array();
while($tc_row = mysqli_fetch_array($tc_result, MYSQLI_BOTH)){
	$tc_array[] = $tc_row["html"];
}
$symptom_manage_array["tc"] = $tc_array;

$symptom_manage_array["response"] = 0;
$sym_query = "SELECT response, question_id, session_id from response_data WHERE 
				user_id = '".$_SESSION["user_id"]."'
				AND question_id LIKE '".$question_id."'
				AND quiz_id = '100300205'
				ORDER BY session_id DESC
				LIMIT 1";
$sym_result = mysqli_query($link, $sym_query);
$sym_row = mysqli_fetch_array($sym_result, MYSQLI_BOTH);
$symptom_manage_array["response"] = $sym_row["response"];

$txt_query = "SELECT html_id, html from texthtml WHERE html_id LIKE '".$seq_id."001___'";
$txt_result = mysqli_query($link, $txt_query);
$text_record = array();
while($txt_row = mysqli_fetch_array($txt_result, MYSQLI_BOTH )){
	$text_record[] = $txt_row;
}
$symptom_manage_array["text"] = $text_record;
//var_dump($symptom_manage_array["text"]);

$symptom_manage_submenu_array = array();
$ui_query = "SELECT * from screenlist WHERE seq LIKE '".$topic_seq."%'";
$ui_result = mysqli_query($link, $ui_query);
while($ui_row = mysqli_fetch_array($ui_result, MYSQLI_BOTH)){
	if($ui_row["seq"] != $seq){
		$symptom_manage_submenu_array[] = $ui_row;
	}
}
 
?>
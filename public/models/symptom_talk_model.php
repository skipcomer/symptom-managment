<?php

//symptom_talk_model
//gets content to display on symptom talk/resources screens

$symptom_talk_array = array();

$seq_array = explode("_",$seq);
$count = count($seq_array);
$topic_seq = "";
for($i=1;$i<$count-1;$i++){
	$topic_seq .= "_".$seq_array[$i];
}
$seq_id = '1______';
$seq_id .= $seq_array[$count-2].$seq_array[$count-1];

$txt_query = "SELECT html_id, html from texthtml WHERE html_id LIKE '".$seq_id."___'";
$txt_result = mysqli_query($link, $txt_query);

$info_record = array();
while($txt_row = mysqli_fetch_array($txt_result, MYSQLI_BOTH)){
	$info_record[] = $txt_row["html"];
} //end while($txt_row = mysql_fetch_array($txt_result )){

$symptom_talk_array["paragraphs"] = $info_record;

$symptom_talk_submenu_array = array();
$ui_query = "SELECT * from screenlist WHERE seq LIKE '".$topic_seq."%'";
$ui_result = mysqli_query($link, $ui_query);
while($ui_row = mysqli_fetch_array($ui_result, MYSQLI_BOTH)){
	if($ui_row["seq"] != $seq){
		$symptom_talk_submenu_array[] = $ui_row;
	}
}
 
?>
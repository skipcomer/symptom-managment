<?php

//symptom_info_model
//gets content to display on symptom info screens

$symptom_info_array = array();

$seq_array = explode("_",$seq);
$count = count($seq_array);

$seq_id = '1______';
$seq_id .= $seq_array[$count-1];

$h_query = "SELECT html_id, html from texthtml WHERE html_id LIKE '".$seq_id."___' LIMIT 1";
$h_result = mysqli_query($link, $h_query);
$h_row = mysqli_fetch_array($h_result, MYSQLI_BOTH);
//strip any formatting taags
$symptom_info_array["heading"] = strip_tags($h_row["html"]);

	
$txt_query = "SELECT html_id, html from texthtml WHERE html_id LIKE '".$h_row["html_id"]."___'";
$txt_result = mysqli_query($link, $txt_query);

$info_record = array();
while($txt_row = mysqli_fetch_array($txt_result, MYSQLI_BOTH)){
	$info_record[] = $txt_row["html"];
} //end while($txt_row = mysql_fetch_array($txt_result )){

$symptom_info_array["paragraphs"] = $info_record;

$s_query = "SELECT * FROM screenlist 
			WHERE seq LIKE '".$seq."____'
			AND seq > '_000'";
$s_result = mysqli_query($link, $s_query);

$symptom_info_submenu_array = array();

while($s_row =  mysqli_fetch_array($s_result, MYSQLI_ASSOC)){
	$symptom_info_submenu_array[] = $s_row;
}
 
?>
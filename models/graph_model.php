<?php

//graph_model
//gets data to display graph screens
/*	global $seq;
	global $t_id;
	global $s_name;
	global $user_id;
	global $graph_array;
	
	global $from_search;
	global $st;*/
	
	$history_array = array();
	//get screen info
	$history_array["screen"] = array(
									seq=>$seq,
									s_name=>$s_name,
									track_id=>$t_id,
									from_search=>$from_search,
									search_term=>$st);
									
	
	//get the quiz number-------------------------------
	$seq_array = explode('_',$seq);
	$this_quiz = "100300205";
	
	//get time range
	$d_query = "SELECT MIN(timestamp) as min_time, MAX(timestamp) as max_time
			FROM response_data 
			WHERE user_id = '".$_SESSION["user_id"]."'";
	$date_result = 	mysqli_query($link, $d_query);
	$d_row = mysqli_fetch_array($date_result, MYSQLI_BOTH);
	//start the first day of the first data month
	$date1_array = explode(' ', $d_row["min_time"]);
	$start_data_date = $date1_array[0];
	$date1Y_M_D = explode('-',$date1_array[0]);
	$start_year = $date1Y_M_D[0];
	$start_month = $date1Y_M_D[1];
	$start_offset_days = $date1Y_M_D[2]-1;
	$start_time = $start_year.'-'.$start_month.'-01';
	
	$date2_array = explode(' ', $d_row["max_time"]);
	//calculate the start of the next day
	$date2Y_M_D = explode('-',$date2_array[0]);
	$end_year = $date2Y_M_D[0];
	$end_month = $date2Y_M_D[1];
	$end_day = $date2Y_M_D[2];
	
	$end_day ++;
	//calculate month, year changes with day increment
	$feb_days = 28;
	if($end_year%4 == 0){
		$feb_days = 29;
	}
	$month_lengths = array(31,$feb_days,31,30,31,30,31,31,30,31,30,31);
	$end_month_length = $month_lengths[$end_month-1];
	if($end_day > $end_month_length){
		$end_day = 1;
		$end_month ++;
	}
	if($end_month > 12){
		$end_month = 1;
		$end_year ++;
	}
	//pad the number with 0
	if(strlen($end_month) < 2){
		$end_month = "0".$end_month;
	}
	if(strlen($end_day) < 2){
		$end_day = "0".$end_day;
	}
	//rebuild the date string
	$end_time = $end_year.'-'.$end_month.'-'.$end_day;
	// get the number of days
	$ts1 = strtotime($start_time);
	$ts2 = strtotime($end_time);
	$seconds_diff = $ts2 - $ts1;

	$interval =  floor($seconds_diff/3600/24);
	if($interval < $start_offset_days){
		$interval = $start_offset_days+1;
	}
	
	//get the time span from present
	$now_query = "SELECT NOW() as now_date";
	$now_result = mysqli_query($link, $now_query);
	$now_row = mysqli_fetch_array($now_result, MYSQLI_BOTH);
	
	$ts1 = strtotime($d_row["min_time"]);
	$ts2 = strtotime($now_row["now_date"]);
	$seconds_diff = $ts2 - $ts1;
	$time_span = floor($seconds_diff/3600/24);
	$history_array["calendar"] = array(
										month_lengths => "[31,".$feb_days.",31,30,31,30,31,31,30,31,30,31]",
										start_offset_days => $start_offset_days,
										start_time => $start_time,
										start_month => $start_month,
										interval => $interval,
										time_span => $time_span
										);
	?>
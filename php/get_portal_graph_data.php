<?php
	session_start();
	// make a mysqli connection
	include("o_portalConnect.php");

	$user_id = $_SESSION["user_id"];
	
	$this_quiz = "100300205";
	
	$r_query = "SELECT question_id, response, response_link, timestamp
			FROM response_data 
			WHERE user_id = '".$user_id."'
			AND quiz_id = '".$this_quiz."'
			ORDER BY response_link, timestamp";
	$response_result = 	mysqli_query($link, $r_query);
	$response = NULL;
	
	//get time range
	$d_query = "SELECT MIN(timestamp) as min_time
			FROM response_data 
			WHERE user_id = '".$user_id."'";
	$date_result = mysqli_query($link, $d_query);
	$d_row = mysqli_fetch_array($date_result, MYSQLI_BOTH);
	//start the first day of the first data month
	$date1_array = explode(' ', $d_row["min_time"]);
	$date1Y_M_D = explode('-',$date1_array[0]);
	$start_year = $date1Y_M_D[0];
	$start_month = $date1Y_M_D[1];
	$start_time = $start_year.'-'.$start_month.'-01';
	
	//get the time span from present
	$now_query = "SELECT NOW() as now_date";
	$now_result = mysqli_query($link, $now_query);
	$now_row = mysqli_fetch_array($now_result, MYSQLI_BOTH);
	
	$graph_array = array();
	//add a way to accumulate timestamp sessions
	$session_array = array();
	//
	while($r_row = mysqli_fetch_array($response_result, MYSQLI_BOTH)){
		//get the symptom number from the last 3 chars of the question_id, add it to the symptom page id prefix
		$q_num = "1003001".substr($r_row["question_id"],-3);
		//echo $q_num.'<br/>';//test to see what is there
		//get the screen name for the symptom
		$s_name_query = "SELECT s_name FROM screenlist WHERE id = '".$q_num."'";
		$s_name_result = mysqli_query($link, $s_name_query);
		$s_name_row = mysqli_fetch_array($s_name_result, MYSQLI_BOTH);
		
		// build the data structure, using the symptom name as the top level key
		if($graph_array[$s_name_row["s_name"]] == NULL){
			$graph_array[$s_name_row["s_name"]] = array(
															g_name => $s_name_row["s_name"],
															q_id => $r_row["question_id"],
															data_point => array(array(
																						response =>$r_row["response"],
																						timestamp =>$r_row["timestamp"])));
		}else{
			$graph_array[$s_name_row["s_name"]]["data_point"][] = array(
																			response => $r_row["response"],
																			timestamp => $r_row["timestamp"]);
		}
		$sesh_array = explode(' ',$r_row["timestamp"]);
		$sesh_date = $sesh_array[0];
		if($session_array["s_".$sesh_date] == NULL){
			$session_array["s_".$sesh_date] = $sesh_date;
		}
	}
	ksort($session_array);
	//add in zero response datapoints for each session date for which there is no response data
	foreach($session_array as $session){
		foreach($graph_array as $graph){
			$found = false;
			foreach($graph["data_point"] as $data){
				$tstamp_array = explode(' ',$data["timestamp"]);
				$tstamp = $tstamp_array[0];
				if($tstamp == $session){
					$found = true;
				}
			}
			if(! $found){
				$graph_array[$graph["g_name"]]["data_point"][] = array(
												response => NULL,
												timestamp => $session." 12:00:00");
			}
		}
	}
	//sort the data by timestamp
	foreach($graph_array as $graph){
		// Sort the multidimensional array
		usort($graph_array[$graph["g_name"]]["data_point"], "timestamp_sort");
	}
	
	// Define the custom sort function
    function timestamp_sort($a,$b) {
          return $a['timestamp']>$b['timestamp'];
    }	

	//create data objects-------------------
	
	$jgraph_array = array();//holds list of graphs to draw
	$jg_name_array = array();//holds list of graph names
	$j_gkey_date_obj = array();//temp list to build object of structured graph data
	$jdate_obj = array();//holds object of structured graph data
	$jfeedback_array = array();//holds list of feedback div names for user feedback
	$latest_session = 0;
	foreach($graph_array as $graph){
		$this_graph = 'g_'.$graph["q_id"];
		$this_g_name = $graph["g_name"];
		$this_feedback = 'g_feedback_'.$graph["q_id"];
		$jgraph_array[]=$this_graph;
		$jg_name_array[] = $this_g_name;
		$jfeedback_array[]=$this_feedback;
		
		$jtemp_array = array();
		foreach($graph["data_point"] as $datapoint){
						
			$time_array = explode(' ',$datapoint["timestamp"]);
			$this_time = $time_array[0];
			$ts1 = strtotime($start_time);
			$ts2 = strtotime($this_time);
			$seconds_diff = $ts2 - $ts1;
			$day_number = floor($seconds_diff/3600/24);
			$data_value = $datapoint["response"];

			$jdobj = (object)array('day'=>$day_number,'value'=>$data_value);  //inner date obj
			$jtemp_array[] = $jdobj;//list of inner data objects
		}
		//find way to add to the array with this_graph as prop name
		$j_gkey_date_array[$this_graph] = $jtemp_array; //array used to build the outer date object
		
		//get the last session time
		$last_session_time = $this_time;
		$ts1 = strtotime($last_session_time);
		$ts2 = strtotime($now_row["now_date"]);
		$seconds_diff = $ts2 - $ts1;
		$latest_session = floor($seconds_diff/3600/24);
		if($latest_session == NULL){
			$latest_session = 0;
		}
	}
	
	$date_obj = (object)$j_gkey_date_array;//cast the outer date array as an object

	///////////////////////////////////////////////////send out to PHP for graph list//////////////////////
	////reformat all this to JSON notation - send it back as JSON and have the callback function set the JS vars, then call the graph functions...
	//send back JSON

	//$obj = (object)array('foo' => 'bar');
	$jobj = (object)array('graph_data'=>$jgraph_array,'g_name'=>$jg_name_array, 'date_obj'=>$date_obj, 'feedback'=>$jfeedback_array, 'latest_session'=>$latest_session);
	$json = json_encode($jobj);

	//END create data objects-------------------

	echo $json;
?>
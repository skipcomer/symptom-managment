<!-- BEGIN include symptom_manage_view.php -->
<script type="text/javascript">
	function set_symptom_tab(this_tab,this_content){
		$("#tab_item_mild").css("display","none");
		$("#mild_tab").css("z-index","0");
		$("#tab_item_moderate").css("display","none");
		$("#moderate_tab").css("z-index","0");
		$("#tab_item_severe").css("display","none");
		$("#severe_tab").css("z-index","0");
		$("#"+this_content).css("display","block");
		$("#"+this_tab).css("z-index","100");
	}
	
	function show_quick_report(){
		$("#quick_report").css("display","block");
	}

	function report(index,q_text){
		//put code for reporting the quick report here...
		$.post("php/portal_report_answer.php",{user_id:'<?php echo $_SESSION["user_id"]; ?>',session:'<?php echo $_SESSION["mysql_sid"]; ?>',quiz_id:'<?php echo $quiz_id; ?>',q_id:'<?php echo $response_q_id; ?>', report:index, q_text:q_text, mdata_type:"quick_report"});
	}
</script>	

<br/>
<div class="container">        	
		<div class="row">
			<div id="symptom-heading" class="col-xs-12">
                <h3><?php echo $screen_info_array[0]["s_name"]; ?></h3>
			</div>  <!-- /#symptom_heading  -->
        </div> <!--/.row -->  
<!-- *************** START DOCUMENT CONTENT HERE *************** -->
		<div class="row">
		<div id="symptomtext"><?php	

	if($_SESSION["user_id"] == 0){
		echo '
			'.$symptom_manage_array["heading"].'
			<div id="quick_report">';
		foreach($symptom_manage_array["tc"] as $tc){
			echo '
				'.$tc;
		}
		echo '
			</div>';
			
	}else{  //if($_SESSION["user_id"] == 0){
	
		switch($symptom_manage_array["response"]){
			case 1:
			case 2:
			case 3:$display_symptom = "001";echo '
			<p>Your most recent Symptom Report records indicate that you are experiencing mild symptoms.</p>';
				break;
			case 4:
			case 5:
			case 6:$display_symptom = "002";echo '
			<p>Your most recent Symptom Report records indicate that you are experiencing moderate symptoms.</p>';
				break;
			case 7:
			case 8:
			case 9:
			case 10:$display_symptom = "003";echo '
			<p>Your most recent Symptom Report records indicate that you are experiencing severe symptoms.</p>';
				break;
			default:$display_symptom = "001";echo '
			<p>There are no Symptom Report records to show any problems with this symptom.  Using the tabs below, choose from Mild, Moderate, or Severe to read about symptom management for this symptom. Use the Symptom Report tool to document your symptom severity over time.</p>';
				break;
		} //end switch($sym_row["response"]){
			
	echo '
			<p><span id="quick_report_link" onclick="javascript:show_quick_report()">Click here to do a <b>Quick Report Update</b>.</span></p>
			<div id="quick_report" style="display:none">
				'.$symptom_manage_array["heading"];
	foreach($symptom_manage_array["tc"] as $tc){
		echo '
					'.$tc;
	}
	echo '
			</div>';
}//end else if($_SESSION["user_id"] == 0){
?>		

		<div class="tab_container">
			<div id="mild_tab" onclick="javascript:set_symptom_tab('mild_tab','tab_item_mild');">Mild</div>
			<div id="moderate_tab" onclick="javascript:set_symptom_tab('moderate_tab','tab_item_moderate');">Moderate</div>
			<div id="severe_tab" onclick="javascript:set_symptom_tab('severe_tab','tab_item_severe');">Severe</div><?php
			
	foreach($symptom_manage_array["text"] as $text){
			$symptom_level = substr($text["html_id"],-3);
			switch ($symptom_level){
				case "001":echo '
				<div id="tab_item_mild" ';break;
				case "002":echo '
				<div id="tab_item_moderate" ';break;
				case "003":echo '
				<div id="tab_item_severe" ';break;
			}
			if($symptom_level == $display_symptom){
				echo ' style="display:block;">';
			}else{
				echo ' style="display:none;">';
			}
			echo  '
					<div id="tab_display" >';
			echo '
						'.$text["html"].'
					</div>';
		
			echo '
				</div>
			<script type="text/javascript">';
			switch ($display_symptom){
				case "001":echo '
				set_symptom_tab(\'mild_tab\',\'tab_item_mild\');';break;
				case "002":echo '
				set_symptom_tab(\'moderate_tab\',\'tab_item_moderate\');';break;
				case "003":echo '
				set_symptom_tab(\'severe_tab\',\'tab_item_severe\');';break;
			}	
			echo '
			</script>';	
		} //end while($txt_row = mysql_fetch_array($txt_result )){
?>

	      	     </div>
                 <br/>
                 <div class="row">
				 <div id="symptom_ui" class="wrapper text-center">
                 <div class="btn-group" role="group" aria-label="symptom_info_buttons" ><?php				 
	foreach($symptom_manage_submenu_array as $ui){
					 echo '				
					 <button type="button" class="btn btn-default symptom-info-btn-bar" style="float:none;" onclick="javascript:get_page(\''.$ui["seq"].'\')">'.$ui["s_name"].'</button>';
	}
?>
			 
				</div>  <!-- /.btn-group  -->
                </div>  <!-- /#symptom_ui -->
				</div>  <!-- /.row -->
                <br/>
			</div>
	 	</div>
	</div>	
		
	<br/>
	</div> <!--/.row -->  
</div> <!-- /.container -->    
<!-- END include symptom_manage_view.php -->


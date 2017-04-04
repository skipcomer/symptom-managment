
<!-- start page content  -->


<br/>
     <div class="container">
		</div>  <!-- /.row -->
		<div class="row">
			<div id="symptom-heading" class="col-xs-12">
            	<h3>Report <?php echo $screen_info_array[0]["s_name"]; ?></h3>
				<p>Please indicate, on a scale of 0 - 10, the severity of your <?php echo strtolower($screen_info_array[0]["s_name"]); ?> symptoms during the past week.</p>
			 </div>  <!-- /#symptom-heading -->
		</div>  <!-- /.row -->
	</div>  <!-- /#main_page.container --> 
       
       
        
        <div id="report-outer-div" onmouseout="javascript:show_saved_value();" onmouseover="show_saved_value();position_report_index();">
        	<div id="no-problem-outer-div" onmouseout="javascript:show_saved_value(current_value);">&nbsp;&nbsp;
				<div id="no-problem-inner-div">
                	<?php echo $report_instructions_array[0]; ?>
                    
                </div>  <!-- id="no-problem-inner-div" -->
			</div>  <!-- id="no-problem-outer-div" -->
            <div id="mild-outer-div" onmouseout="javascript:show_saved_value(current_value);">
            	Mild
				<div id="mild-inner-div">
                	<?php echo $report_instructions_array[1]; ?>
                    
                </div>  <!-- id="mild-inner-div" -->
			</div>  <!-- id="mild-outer-div" -->
            <div id="moderate-outer-div" onmouseout="javascript:show_saved_value(current_value);">
            	Moderate
				<div id="moderate-inner-div">
                	<?php echo $report_instructions_array[2]; ?>
                    
                </div>  <!-- id="moderate-inner-div" -->
			</div>  <!-- id="moderate-outer-div" -->
            <div id="severe-outer-div" onmouseout="javascript:show_saved_value(current_value);">
            	Severe
				<div id="severe-inner-div">
                	<?php echo $report_instructions_array[3]; ?>
                    
                </div>  <!-- id="severe-inner-div" -->
			</div>  <!-- id="severe-outer-div" -->

                <div id="report-bar-div">
				<div id="last-report-outer-div">
					<div id="last-report-inner-div">
                    	LAST REPORT<br/>▼
                    </div>  <!-- id="last-report-inner-div"  -->
				</div>  <!--  id="last-report-outer-div"  -->
				<div id="number-outer-div"><?php
	//draw the number divs
	for ($i=0;$i<11;$i++){
		if($i == $most_recent_response){
			echo '
					<div id="this_'.$i.'" class="number-inner-class select_'.$i.' choice" onmouseover="mOver(\''.$i.'\');" onclick="select(\''.$i.'\');" onmouseout="mOut();">'.$i.'</div>';
		}else{
			if($i < $most_recent_response){
				echo '
					<div id="this_'.$i.'" class="number-inner-class select select_'.$i.'" onmouseover="mOver(\''.$i.'\');" onclick="select(\''.$i.'\');" onmouseout="mOut();">'.$i.'</div>';
			}else{
				echo '
					<div id="this_'.$i.'" class="number-inner-class unselect unselect_'.$i.'" onmouseover="mOver(\''.$i.'\');" onclick="select(\''.$i.'\');" onmouseout="mOut();">'.$i.'</div>';
			}
		}
	}
?>

				</div>	<!-- id="number-outer-div" -->
				<div id="index-outer-div"><?php 
	//draw the index divs               
	for ($i=0;$i<11;$i++){
		if($i == $most_recent_response){
			echo '
					<div id="index_'.$i.'" class="index-inner-class">▲</div>';
		}else{
			echo '
					<div id="index_'.$i.'" class="index-inner-class"> </div>';
		}
	}
?>
	
				</div>	<!-- id="index-outer-div"  -->
			</div>  <!-- id="report-bar-div"  -->
			<script type="text/javascript">
				set_report_info('<?php echo $_SESSION["user_id"]; ?>','<?php echo $_SESSION["mysql_sid"]; ?>','<?php echo $this_quiz; ?>','<?php echo $this_question; ?>','<?php echo $question_text; ?>','<?php echo $this_mdatatype; ?>');
				set_saved_value(<?php echo $dtresponse; ?>);
                position_report_index();
                show_saved_value();
            </script>
		</div>   <!-- id="report-outer-div" -->   
    
    
<!-- end page content  -->

<!--  previous/next  -->
	<div class = "container">
		<div class = "row">
			<nav class = "col-xs-12">
  				<ul class="pager"><?php 
	if ($seq > "_003_002_006"){
  		echo'
    				<li class="previous"><a href="index.php?nav=prev&seq='.$seq.'"><span aria-hidden="true">&larr;</span> Previous Symptom</a></li>';
	}
?>
	
    				<li class="next"><a href="index.php?nav=next&seq=<?php echo $seq; ?>">Next Symptom <span aria-hidden="true">&rarr;</span></a></li>
  				</ul>
			</nav>
		</div>  <!-- /.row  -->
		<div class="row">
			<div id="symptom-heading" class="col-xs-12">
				<nav>
					<ul class="pagination pagination-sm"><?php
  $counter = 1;
  foreach($report_page_array as $page){
	  switch (true){
	  	case ($page["seq"] == $seq):
		  	echo '
						<li class="active"><span>'.$counter.'<span class="sr-only">(current)</span></span></li>';break;
		case ($page["seq"] == "_003_002_900"):
			echo '
						<li><a href="index.php?seq=_003_002_900">Symptom Report Summary</a></li>';break;
	  	default:
  			echo '
    					<li><a href="index.php?seq='.$page["seq"].'">'.$counter.'</a></li>';break;
	  }
	$counter ++;  
  }?>
  					</ul>  <!-- /.pagination -->
				</nav>
			</div>  <!-- /#symptom-heading  -->
		</div>  <!-- /.row  -->
	</div>  <!-- /.container  -->


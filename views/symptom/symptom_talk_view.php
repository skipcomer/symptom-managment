	
<!-- BEGIN include symptom_talk_view.php -->
<!-- *************** START DOCUMENT CONTENT HERE *************** -->
    <br/>    
    <div class="container">    
		<div class="row">
			<div id="symptom-heading" class="col-xs-12">
                <h3><?php echo $screen_info_array[0]["s_name"]; ?></h3>
			</div>  <!-- /#symptom_heading  -->
        </div> <!--/.row -->    
        
<!-- *************** START DOCUMENT CONTENT HERE *************** -->
	
<div id="symptomtext"><?php
foreach($symptom_talk_array["paragraphs"] as $paragraph){
	echo '
			<div class="row">
				<div class= "col-md-2"></div>
					<div class="item_container col-md-8">
					'	.$paragraph.'
					</div>
				<div class= "col-md-2"></div>
			</div> <!--/.row -->';
}

?>	

	      	     </div>
                 <br/>
                 <div class="row">
				 <div id="symptom_ui" class="wrapper text-center">
                 <div class="btn-group" role="group" aria-label="symptom_info_buttons" ><?php				 
	foreach($symptom_talk_submenu_array as $ui){
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
    

</div> <!-- /.container -->	
	
<!-- END include symptom_talk_view.php -->

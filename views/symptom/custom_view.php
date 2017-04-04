
<!-- BEGIN include symptom/custom_view.php -->
<style>
.center {
     float: none;
     margin-left: auto;
     margin-right: auto;
}

.center-text{  text-align:center;  }
.custom_panel { width:290px;}
</style>

<!-- *************** START DOCUMENT CONTENT HERE *************** -->  
<div class="container">
	<div class="row">
    	<div id="page-content" class="col-md-12">
<?php
	if($_SESSION["user_id"] < 1){
		echo '
			<div id="log-in-request"><p>You must Log-In before you can use the<br/>Custom Symptom Management Guide.<br/>Creating an account is free and easy.<br/></p>
	<button style="margin-bottom:1em;cursor:hand;cursor:pointer" onclick="javascript:do_login()">Log In or Create an Account</button><br/></div>';
	}else{
		echo '
			<p>Selected topics from the Symptom Management Guide have been prioritized for you, based on the symptom severity reports you have submitted in your Symptom Report.  This Custom Symptom Management Guide will continue to be available to you until you submit a new Symptom Report.  The Custom Guide will refresh with the latest priorities indicated by your most recent Symptom Report.</p>

<p>The following topics are contained in the current Custom Symptom Management Guide.  Click on the topic title.<br/><br/>';
	}
	
	if (count($custom_array) > 0){
		echo '
					<div class="center custom_panel">
						<div class="row">
							<div class="col-xs-6"><h4>Symptom Topic</h4></div>
							<div class="col-xs-6 center-text"><h4>Severity</h4></div>
						</div>  <!-- /.row -->';

		foreach($custom_array as $custom){
			echo '
						<div class="row">
							<div class="col-xs-6"><a href="index.php?seq='.$custom["link"].'">'.$custom["s_name"].'</a></div>';
			switch ($custom["level"]){
				case "Mild":echo '<div class="col-xs-6 center-text label label-success"><a href="index.php?seq='.$custom["link"].'" style="color:#FFFFFF;">Mild</a></div>';
					break;
				case "Severe":echo '<div class="col-xs-6 center-text label label-danger"><a href="index.php?seq='.$custom["link"].'" style="color:#FFFFFF;">Severe</a></div>';
					break;
				default:echo '<div class="col-xs-6 center-text label label-warning"><a href="index.php?seq='.$custom["link"].'" style="color:#FFFFFF;">Moderate</a></div>';
					break;
			}
			echo '				
						</div>  <!-- /.row -->';
		}
		echo '		
				</div>  <!-- /.center -->';

}else{ //if (count($custom_array)
	echo '
		<div class="row">
			<div class="col-md-3"></div>
			<div id="custom_guide_no_records_message" class="col-md-6 alert alert-warning"><p>No Symptom Reporting records were found for your account.<br/><br/>Check to be sure you are using the correct account.<br/><br/>Use the Symptom Reporting tool to enter symptom severity levels before using the Custom Symptom Management Guide.</p></div>
			<div class="col-md-3"></div>
		</div>  <!-- /.row -->';
}
?>

			



        </div> <!--/#page-content /.col-md-12 -->
	</div> <!--/.row -->
</div> <!-- /.container -->	
<br/><br/>
<!-- END include symptom/custom_view.php -->

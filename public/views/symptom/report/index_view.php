
<!-- BEGIN include symptom/report_view.php -->

<!-- *************** START DOCUMENT CONTENT HERE *************** -->

<br/>
<div class="container">
	<div class="row">
    	<div id="page-content" class="col-md-12">
<?php
	if($_SESSION["user_id"] < 1){
		echo '
			<div id="log-in-request">
				<p>You must Log-In before you can report symptoms.<br/>Creating an account is free and easy.<br/></p>
				<button style="margin-bottom:1em;cursor:hand;cursor:pointer" onclick="javascript:do_login()">Log In or Create an Account</button><br/>
			</div>';
	}else{
		echo '
			<div id="report_symptoms_link" >
				<input class="btn btn-primary center-block" id="report_button" type="button" value="Start Reporting Now" onclick="javascript:get_page(\'_003_002_006\');" /><br/>
			</div>';
	}
?>

			<p>Users of this site are encouraged to report chemotherapy-related symptoms they experience using the Symptom Reporting Tool. Symptom Reporting is designed to be quick and easy to do.  <?php
	if($_SESSION["user_id"] < 1){ echo'You will need to log in, so create an account (Click the "Log-in" link).  It\'s free, and you will not be asked to provide any personally identifiable information.  We respect your privacy, and all your information will remain confidential.';} ?></p><br/>
            
			<h4>Here's how it works:</h4>
			<p>You will be asked to rate the severity of 13 symptoms that chemotherapy patients often experience.  Rank your symptom severity on a scale of 0 to 10, with 10 being the worst possible symptom severity.  If you are not experiencing the symptom at all, rate it as zero.  Mild symptoms should fall in the 1-3 range, while moderate symptom severity should be ranked between 4 and 6.  Use the descriptive statements to help find your symptom severity.  Once you have worked through the set of symptoms, you will be shown a summary of your current report.  If it looks good, approve it, and you will then see a Custom Symptom Mangagement Guide.  It is recommended that you report your symptoms about once a week.</p><br/>
            
			<h4>Custom Symptom Management Guide</h4>
			<p>The Custom Symptom Management Guide is a collection of symptom management information, prioritized for the symptoms you report.  For example, if your biggest problem is fatigue, you will see the Fatigue section first.</p><br/>

			<h4>Trends Over Time</h4>
			<p>Your account access will allow you to see how you have been doing over time.  If you report your symptoms on a regular basis, you can see a history graph that shows what is getting better and what is trending worse.  This will help you know which symptom management techniques are helping you, and which problems you should focus on with your health care provider and caregiving partners.</p><br/>

<?php 
	if($_SESSION["user_id"] > 0){
		echo '
			<div id="report_symptoms_link"><input class="btn btn-primary center-block" id="report_button" type="button" value="Start Reporting Now" onclick="javascript:get_page(\'_003_002_006\');" />
			</div>';
	}
?>

<!-- END include inc/portal_symptom_reporting.php -->

			<br/>
        </div> <!--/#page-content /.col-md-12 -->
	</div> <!--/.row -->
</div> <!-- /.container -->	
<!-- END include symptom/report_view.php -->

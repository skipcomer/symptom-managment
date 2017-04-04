	
<!-- BEGIN include graph_view.php -->
<!-- *************** START DOCUMENT CONTENT HERE *************** -->
<div class="container">
	<div class="row">
			<div id="symptom-heading" class="col-xs-12">
                <h3><?php echo $screen_info_array[0]["s_name"]; ?></h3>
			</div>  <!-- /#symptom_heading  -->
        </div> <!--/.row -->  
        <div class="row">  
        	<div id="symptomtext"><?php
if($_SESSION["user_id"] < 1){
	echo '<div id="log-in-request"><p>You must Log-In before you can use My Symptom History.<br/>Creating an account is free and easy.<br/></p>
	<button style="margin-bottom:1em;cursor:hand;cursor:pointer" onclick="javascript:do_login()">Log In or Create an Account</button><br/></div>';
}else{
	echo '
		<div id="history">
			<div id="login_window"><p style="text-align:center;font-size:1.3em;font-style:bold;">Retrieving your symptom history information.<br/><br/><br/>Please wait while the symptom history graphs are being prepared...<br/></p></div>
		</div>';

}
?>
		</div> <!--/.row -->
	</div> <!-- /.container -->
	
<!-- END include graph_view.php -->


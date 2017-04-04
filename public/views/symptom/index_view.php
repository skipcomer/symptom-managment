

<!-- BEGIN include symptom/index_view.php -->

<!-- *************** START DOCUMENT CONTENT HERE *************** -->
<div class="container">
	<div class="row">
    	<div id="page-content" class="col-md-9">

			<p>People with cancer experience symptoms that can make them feel sick.  The good news is that there are things that people can do to feel better.  The most common symptoms of chemotherapy that people experience are listed below.  Click a link to learn more about dealing with a specific symptom.</p>

<?php
if($_SESSION["user_id"] < 1){
	echo '
			<p>Consider creating an account and using the Symptom Reporting tool.  The Symptom Reporting tool will store your symptom severity data over time, allowing you to see your trends.  It also allows you to use the Custom Symptom Management Guide, which will prioritize the Symptom Management topics, based on which symptoms are causing the most trouble for you.</p>';
}


//the code block below (commented out) provides a menu list of the next level content items

	
		echo '
			<ul id="menu_list">';
		foreach($symptom_array as $symptom){
			echo '
				<li><a href="index.php?seq='.$symptom["seq"].'">'.$symptom["s_name"].'</a></li>';
		}
		echo '
			</ul>
			';		
?>
			<p>Information about the symptoms was originally developed by Drs. Barbara and Charles W. Given at Michigan State University, based on many years of research with cancer patients.</p>

        </div> <!--/#page-content /.col-md-9 -->
    
        <div id="rightcolumn" class="col-md-3">
            <div id="resources" class="well well-lg">
        
            <h3>More Information</h3>
            <ul style="padding-left:1em;"> 
                <li><a href="http://www.chemocare.com/MANAGING/index.asp" onclick="popblank(\'\');" target="blank">Managing Chemotherapy Side Effects</a><br />(Chemocare.com)</li>
                <li><a href="http://www.cancer.net/patient/Diagnosis+and+Treatment/Treating+Cancer/Managing+Side+Effects" onclick="popblank(\'\');" target="blank">Understanding and Managing Chemotherapy Side Effects</a> (Cancer.Net)</li>
                <li><a href="http://www.cancercare.org/publications/24-understanding_and_managing_chemotherapy_side_effects" onclick="popblank(\'\');" target="blank">Managing Treatment and Side Effects</a><br />(Cancer Care Online)</li>
                <li><a href="http://www.oncolink.upenn.edu/coping/coping.cfm?c=5" onclick="popblank(\'\');" target="blank">Side Effects</a> (OncoLink&#174;)</li>
            </ul>
            </div>  <!-- /#resources /.well well-lg -->
        </div>  <!--  /#rightcolumn  /.col-md-3 -->
	</div> <!--/.row -->
</div> <!-- /.container -->	
<!-- END include symptom/index_view.php -->

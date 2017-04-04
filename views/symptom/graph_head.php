<!DOCTYPE html>
<html lang="en">
<!-- BEGIN include graph_head.php -->
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta><meta name="description" content="This web portal offers information, resources, and tools for people dealing with cancer. Visit it to learn about the prevention, detection, treatment, and symptom management of cancer. Many great tools are also available for you to create custom symptom management guide, view your symptom history, and write journals and notes." />
	<meta name="keywords" content="Burdette Cancer Portal, IUPUI cancer portal, cancer symptom management, cancer symptom management guide" />
	<meta name="author" content="Indiana University School of Nursing" />
    
     <title>The Portal::IU School of Nursing Burdette Cancer Portal</title>

<!-- Bootstrap core CSS -->
    <link href="bs/css/bootstrap.min.css" rel="stylesheet">
	
    
    <!-- jQuery CSS Includes -->
    <link type="text/css" href="css/themes/smoothness/jquery-ui.min.css" rel="stylesheet" />
    <link type="text/css" href="css/themes/smoothness/jquery.ui.theme.css" rel="stylesheet" /> 
    
    <link rel="stylesheet" href="css/portal_main.css"> 

    <!--[if (lte IE 8) & (!IEMobile)]>
         <script type="text/javascript">
            window.location.replace("http://portal.nursing.iupui.edu/not_supported.html");
        </script>
    <![endif]-->
    <!--[if IE 7]>
        <script type="text/javascript">
            window.location.replace("http://portal.nursing.iupui.edu/not_supported.html");
        </script>
    <![endif]--> 
    <!--[if IE 6]>
        <script type="text/javascript">
            window.location.replace("http://portal.nursing.iupui.edu/not_supported.html");
        </script>
    <![endif]-->
    <script src="js/jquery-1.11.3.min.js"></script>
    <script src="js/modernizr_2_6_2_dev.js"></script>
    <!--
    <script src="js/jquery-ui-1.10.2.custom.min.js"></script>
    <script src="js/jquery.stringify.js"></script> -->
<script type="text/javascript" src="js/swfobject.js"></script>
<script type="text/javascript" src="js/history_graphs.js"></script>


<script type="text/javascript">
	var user_id = <?php echo $_SESSION["user_id"]; ?>;
	var current_seq = "<?php echo $history_array["screen"]["seq"]; ?>";
	var page_title = "<?php echo $history_array["screen"]["s_name"]; ?>";
	var current_t_id = "<?php echo $history_array["screen"]["track_id"]; ?>";
	var from_search = '<?php echo $history_array["screen"]["from_search"]; ?>';
    var search_term = '<?php echo $history_array["screen"]["search_term"]; ?>';
	
	var canvas_support = "no";
	var canvas_width = 2000;
	var flash_window_width = 530;
	
	var month_lengths = <?php echo $history_array["calendar"]["month_lengths"]; ?>;//leap year and feb_days calculated above...
	var start_offset_days = <?php echo $history_array["calendar"]["start_offset_days"]; ?>;
	var start_time = "<?php echo $history_array["calendar"]["start_time"]; ?>";
    var start_month = "<?php echo $history_array["calendar"]["start_month"]; ?>";
	if (start_month < "01"){start_month = "01";}//ensure the month is at least Jan
	var start_day = "01";
	var interval = <?php echo $history_array["calendar"]["interval"];?>;
	var record_days = <?php echo $history_array["calendar"]["time_span"]; ?>;
	var record_weeks = Math.round(record_days/7);
	var record_months = Math.round(record_days/30);
	var alert_count = 0;
	
	
    
    function get_next(){
		var thisURL = location.protocol + "//" + location.host + location.pathname;
		window.location.href = thisURL+"?nav=next&seq="+current_seq+"&t="+current_t_id+"&cv="+canvas_support;	
		
	}
    
    function get_page(page){
		window.location.href = "./index.php?&seq="+page+"&t="+current_t_id+"&cv="+canvas_support;	
	}
    
   function get_back(){
		var thisURL = location.protocol + "//" + location.host + location.pathname;
		if(from_search == ''){
			window.location.href = thisURL+"?nav=back&seq="+current_seq+"&t="+current_t_id+"&cv="+canvas_support;
		}else{
			window.location.href = thisURL+"?nav=back&seq="+current_seq+"&t="+current_t_id+"&from_search="+from_search+"&st="+search_term+"&cv="+canvas_support;
		}
	}
	
	var graph_list = [];
	var name_list = [];
	var data_obj = {};
	var feedback_list = [];
	function get_portal_graph_data(){
		$.post("php/get_portal_graph_data.php",
				{user_id:user_id}, 
				function(data){
						
						update_page_text(data.latest_session);
						graph_list = data.graph_data;
						name_list = data.g_name;
						data_obj = data.date_obj;
						feedback_list = data.feedback;
						set_up_history_page();
						if (Modernizr.canvas) {
							set_up_canvas();
							jdraw_graphs();
							canvas_support = "yes";
						} else {
							set_up_flash();
							draw_flash();
						}
					},
				"json");
	}
	
	$(document).ready(function(){
		get_portal_graph_data();		
	});
		
</script>	
</head>
	
<!-- END include inc/HFCC_graph_page_head.php -->

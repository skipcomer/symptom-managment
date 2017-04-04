<?php
	global $seq;
	global $t_id;
	global $s_name;
	
	global $from_search;
	global $st;
	
	$user_id = $_SESSION["user_id"];
	
	
$html .= '
	
<!-- BEGIN include inc/portal_page_head.php -->

';	
	$html .= '<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"></meta>';

if (isset($_SERVER['HTTP_USER_AGENT']))
{
    $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
    if (strpos($ua, 'ipad') !== false || strpos($ua, 'ipod') !== false ||strpos($ua, 'iphone') !== false)
    {
        $html .= '<meta name="viewport" content="width=device-width, initial-scale=1.0" />';
    }
}



$html .= '<meta name="description" content="This web portal offers information, resources, and tools for people dealing with cancer. Visit it to learn about the prevention, detection, treatment, and symptom management of cancer. Many great tools are also available for you to create custom symptom management guide, view your symptom history, and write journals and notes." />
<meta name="keywords" content="Burdette Cancer Portal, IUPUI cancer portal, cancer symptom management, cancer symptom management guide" />
<meta name="author" content="Indiana University School of Nursing" />

 <!-- BEGIN INDIANA UNIVERSITY BRANDING BAR AND FOOTER <HEAD> ELEMENTS -->
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link href="dev/draft/_iu-brand/css/base.css" rel="stylesheet" type="text/css" />
        <link href="dev/draft/_iu-brand/css/wide.css" media="(min-width: 48.000em)" rel="stylesheet" type="text/css" />
        <!-- Remove both script tags below if Google Custom Search form is removed. -->
        <script src="dev/draft/_iu-brand/js/scripts.js" type="text/javascript"></script>
        <script type="text/javascript">
			var googleSearchToggleOptions = {
				searchResultsUrl: \'search.html\',
				searchId: \'cse-search-form\',
				searchResultsId: \'cse-search-results-form\'
			};
		</script>
        <!--[if (lte IE 8) & (!IEMobile)]>
            <link href="dev/draft/_iu-brand/css/fixed.css" media="screen" rel="stylesheet" type="text/css" />
        <![endif]-->
        <!--[if IE 7]>
            <link href="dev/draft/_iu-brand/css/ie7.css" rel="stylesheet" type="text/css" />
        <![endif]--> 
        <!--[if IE 6]>
            <link href="dev/draft/_iu-brand/css/ie6.css" rel="stylesheet" type="text/css" />
        <![endif]-->
        <!-- END INDIANA UNIVERSITY BRANDING BAR AND FOOTER <HEAD> ELEMENTS -->
		
<link rel="stylesheet" href="css/portal_main.css">
<!-- jQuery CSS Includes -->
<link type="text/css" href="css/themes/smoothness/jquery-ui.min.css" rel="stylesheet" />
<link type="text/css" href="css/themes/smoothness/jquery.ui.theme.css" rel="stylesheet" />

<title>IU School of Nursing Burdette Cancer Portal :: '.$s_name.'</title>

<script src="js/jquery-1.7.min.js"></script>
<script src="js/modernizr_2_6_2_dev.js"></script>
<script src="js/jquery-ui-1.10.2.custom.min.js"></script>
<script src="js/jquery.stringify.js"></script>

<script type="text/javascript">
	var current_seq = "'.$seq.'";
	function get_next(){
		var thisURL = location.protocol + "//" + location.host + location.pathname;
		
		window.location.href = thisURL+"?nav=next&seq='.$seq.'";
		
	}
	
	function get_back(){
		var thisURL = location.protocol + "//" + location.host + location.pathname;
		
		window.location.href = thisURL+"?nav=back&seq='.$seq.'";
		
	}
	
	function get_page(page){
		//var thisURL = location.protocol + "//" + location.host + location.pathname;
		
		//window.location.href = thisURL+"?seq="+page;
		window.location.href = "./index.php?seq="+page;
		
	}
	
	function close_note_window(){
		$("#note_panel").remove();
	}';
	
	if($user_id < 1){
		$html .= '
		function show_login_notice(){
			$("#note_panel").remove();
			$("body").append("<div id=\"note_panel\" style=\"position:absolute;top:25%;left:30%;width:40%\"><div id=\"close_btn\" style=\"clear:both;float:right;margin-right:0.5em;margin-top:0.5em;font-weight:bold\"><button onclick=\"javascript:close_note_window();\">X</button></div><h4>Log-In Required</h4><br/><p style=\"text-align:center;\">You must log in to use this feature.<br/>Creating an account is free and easy.<br/><br/><button style=\"margin-bottom:1em;cursor:hand;cursor:pointer;\" onclick=\"javascript:close_note_window();do_login();\">Log In or Create an Account</button><br/></p></div>");
		}
		function make_notation(){
			show_login_notice();
		}
		function make_bookmark(){
			show_login_notice();
		}
		function make_recommend(){
			show_login_notice();
		}
		';
		
	}else{  //if($user_id < 1)
	
	$html .= '	function make_notation(){
		$("#note_panel").remove();
		$("body").append("<div id=\"note_panel\" style=\"position:absolute;top:25%;left:-40%;width:40%\"><div id=\"close_btn\" style=\"clear:both;float:right;margin-right:0.5em;margin-top:0.5em;font-weight:bold\"><button onclick=\"javascript:close_note_window();\">X</button></div><h4>Notations</h4><p>Type or paste your notes into the space below:</p><form id=\"note_form\" name=\"note_form\" method=\"post\" action=\"php/portal_note.php\"><div id=\"note_panel_bg\"><label>Topic: </label><input name=\"topic\" type=\"text\" placeholder=\"Topic\" value=\"'.$s_name.'\" style=\"width:85%;\" /><br/><textarea id=\"note\" name=\"note\" rows=\"10\" cols=\"20\" style=\"width:98%;\"></textarea><br/><input style=\"margin-left:90%;margin-right:1em;\" type=\"submit\" value=\"Save\" /></div></form></div>");
		$("#note_panel").animate({left:"5%"},800,"swing");
	}
	
	function make_bookmark(){
		$("#note_panel").remove();
		$("body").append("<div id=\"note_panel\" style=\"position:absolute;top:25%;left:-20%;width:20%\"><div id=\"close_btn\" style=\"clear:both;float:right;margin-right:0.5em;margin-top:0.5em;font-weight:bold\"><button onclick=\"javascript:close_note_window();\">X</button></div><h4>Bookmark</h4><br/><p style=\"text-align:center;\">'.$s_name.'<br/></p><div id=\"note_panel_bg\" style=\"text-align:center;margin-bottom:1em;\"><button onclick=\"javascript:save_bookmark();\" style=\"margin-bottom:1em;\">Bookmark This Page</button></div></div>");
		$("#note_panel").animate({left:"5%"},800,"swing");
	}
	
	function save_bookmark(){
		this_seq = \''.$seq.'\';
		this_user = \''.$user_id.'\';
		$.post("php/portal_set_bookmark.php",{seq:this_seq,user_id:this_user},function(data){$("#note_panel").remove();},"text");
	}
	
	function make_recommend(){
		this_seq = \''.$seq.'\';
		this_user = \''.$user_id.'\';
		$("#note_panel").remove();
		$.post("php/portal_get_recommend.php",{seq:this_seq,user_id:this_user},function(data){$("body").append(data);$("#note_panel").animate({left:"5%"},800,"swing");},"text");
	}
	
	function set_rating( this_seq, this_rating ){
		this_seq = \''.$seq.'\';
		this_user = \''.$user_id.'\';
		$.post("php/portal_set_recommend.php",{seq:this_seq,user_id:this_user,rating:this_rating},function(data){$("#note_panel").remove();},"text");
	}
	
	
	
	
	
	';
	}//end -- else if($user_id < 1)
	
	$html .= '	
	function test_sifter(){
		$.post("http:portal.nursing.iupui.edu:8080/PortalSifter/GetFeed", {},function(data) {
					$("#sifter_test").html(data);
					$("#sifter_test").append(" -- sifter test function");
		});
		//$("#sifter_test").append(" -- sifter test function");
	}
	var login_status = true;';
	
	if(isset($_REQUEST["login_status"])){
		if ($_REQUEST["login_status"] < 0){
			$html .= 'login_status = false;';
		}
	};

	if($seq == "_001"){
		$html .= '
			var front_page_slider_width = 800;
			var current_slider_pane = 0;
			var num_sliders = 1;
			var slider_timer;
			
			function start_slider(){
				slider_timer = setInterval(function(){run_slider()},8000);
			}
			
			function run_slider(){
				$.post("php/get_front_page_sliders.php",{this_slider:Number(current_slider_pane)+1},
					function(data){$("#front_page").append(data);
						$("#front_page_slider_2").css("width",($("#front_page").width())+"px");
						//$("#front_page_slider_2").css("left",($("#front_page").width()+50)+"px");
						$("#front_page_slider_2").css("left","-20px");
						$("#front_page_slider_2").css("opacity","0");
						$("#front_page_slider_2").animate({opacity:"1"}, 1000,"swing",function(){$("#more_link").css("right","0");});
						$("#front_page_slider_1").animate({opacity:"0"}, 1000,"swing",function(){$("#front_page_slider_1").remove();$("#front_page_slider_2").attr("id","front_page_slider_1")});
						//$("#front_page_slider_2").animate({left:"-20px"}, 1000,"swing",function(){$("#more_link").css("right","0");});
						//$("#front_page_slider_1").animate({left:"-="+front_page_slider_width}, 1000,"swing",function(){$("#front_page_slider_1").remove();$("#front_page_slider_2").attr("id","front_page_slider_1")});
						update_slider_ui();
					},"text"
				);
			}
			
			function update_slider_ui(){
				for(i=0;i<num_sliders;i++){
					$("#dot_"+i).attr("src","images/dot_0.png");
					if(i == (current_slider_pane-1)){
						$("#dot_"+i).attr("src","images/dot_1.png");
					}
				}
			}
			
			function set_slider(this_slider){
				clearInterval(slider_timer);
				update_slider_ui();
				$.post("php/get_front_page_sliders.php",{this_slider:(Number(this_slider)+1)},
					function(data){
						$("#front_page_slider_1").remove();
						$("#front_page_slider_2").remove();
						$("#front_page").append(data);
						$("#front_page_slider_2").css("width",($("#front_page").width())+"px");
						//$("#front_page_slider_2").css("opacity","1");
						$("#front_page_slider_2").attr("id","front_page_slider_1");
						start_slider();
						update_slider_ui();
					},"text"
				);
			}
			';
	}else{
		//create empty functions
		$html .= '	function start_slider(){}
	function run_slider(){}';
	}
	
	$html .='
	$(document).ready(function(){
		//if(! login_status){alert("Log In was not successful.");}
		//test_sifter(); 
		front_page_slider_width = $("#front_page").width();
		run_slider();
		start_slider();
	});

</script>	
</head>';
$html .= '
	
<!-- END include inc/portal_page_head.php -->

';		
?>
// JavaScript Document


	
var current_value = 0;
var temp_pointer = "<sup>△</sup>";
var user_id = 0;
var mysid = 0;
var quiz_id = 0;
var question_id = 0;
var question_text = "";
var mdata_type = "";

function set_report_info(id,sid,qz_id,q_id,q_text,m_data){
	user_id = id;
	mysid = sid;
	quiz_id = qz_id;
	question_id = q_id;
	question_text = q_text;
	mdata_type = m_data;
}

function select(index){
//	for (i=0;i<11;i++){
//		$("#this"+i).html("");
//	}
//	$("#this"+current_value).css("color","#990000");
	current_value = index;
//	$("#this"+index).html("▲");
//	$("#this"+index).css("color","#990000");
//	$("#this"+index).css("font-size","1.2em");
	$.post("php/portal_report_answer.php",{user_id:user_id,session:mysid,quiz_id:quiz_id,q_id:question_id,report:index,q_text:'Please indicate, on a scale of 0 - 10, the severity of your lack of appetite symptoms during the past week.',mdata_type:mdata_type});
}

function drawTheGraph(index){
	for (i=0;i<11;i++){
		jQuery("#index_"+i).empty();
		jQuery("#this_"+i).removeClass();
		if(i == index){
			jQuery("#this_"+i).addClass("number-inner-class select_"+i+" choice");
		}else{
			if(i < index){
				jQuery("#this_"+i).addClass("number-inner-class select select_"+i);
			}else{
				jQuery("#this_"+i).addClass("number-inner-class unselect unselect_"+i);
			}
		}
	}
		//this last line forces a redraw...
		jQuery("#this_"+index).hide().show(0);
}
        
function mOver(index){
	drawTheGraph(index);
	jQuery("#index_"+current_value).html("▲");
	if (index != current_value){
		jQuery("#index_"+current_value).css("color","#CCAAAA");
	}else{
		jQuery("#index_"+current_value).css("color","#cc0000");
	}
	jQuery("#index_"+index).html("▲");
	jQuery("#index_"+index).css("color","#cc0000");
}


function mOut(){
	drawTheGraph(current_value);
	jQuery("#index_"+current_value).html("▲");
	jQuery("#index_"+current_value).css("color","#cc0000");
}

//position the report graphic
function position_report_index(){
//	jQuery("#no-problem-outer-div").css("height", "auto");
//	jQuery("#mild-outer-div").css("height", "auto");
//	jQuery("#moderate-outer-div").css("height", "auto");
//	jQuery("#severe-outer-div").css("height", "auto");
	jQuery("#no-problem-outer-div").css("height", "270px");
	jQuery("#mild-outer-div").css("height", "270px");
	jQuery("#moderate-outer-div").css("height", "270px");
	jQuery("#severe-outer-div").css("height", "270px");
//	var s_container_height = 0;
//	s_container_height = Math.max(s_container_height, jQuery("#no-problem-outer-div").height());
//	s_container_height = Math.max(s_container_height, jQuery("#mild-outer-div").height());
//	s_container_height = Math.max(s_container_height, jQuery("#moderate-outer-div").height());
//	s_container_height = Math.max(s_container_height, jQuery("#severe-outer-div").height());
//	s_container_height+=10;
//	jQuery("#report-bar-div").css("top",s_container_height+"px");
//	var outer_container_height = s_container_height+$("#report-bar-div").height() + 20;
//	jQuery("#report-outer-div").css("height", outer_container_height+"px");
//	jQuery("#no-problem-outer-div").css("height", "90%");
//	jQuery("#no-problem-outer-div").css("padding-bottom", "0.5em");
//	jQuery("#mild-outer-div").css("height","90%");
//	jQuery("#mild-outer-div").css("padding-bottom", "0.5em");
//	jQuery("#moderate-outer-div").css("height", "90%");
//	jQuery("#moderate-outer-div").css("padding-bottom", "0.5em");
//	jQuery("#severe-outer-div").css("height", "90%");
//	jQuery("#severe-outer-div").css("padding-bottom", "0.5em");
	
	jQuery("#report-bar-div").css("top","170px");
}

//position the "LAST REPORT" marker
var last_session_response = 0;
function set_saved_value(saved_value){
	last_session_response = saved_value;
}

function show_saved_value(){
	var report_container_width = $("#report-outer-div").width();
	//var report_item_width = report_container_width*0.08666666667;
	var report_item_width = report_container_width*0.09;
	//var last_session_margin = (report_container_width*0.045)+(report_item_width*(last_session_response+0.5))-(jQuery("#last-report-inner-div").width()*0.5);
	var last_session_margin = (report_item_width*(last_session_response+0.5))-(jQuery("#last-report-inner-div").width()*0.5);
	jQuery("#last-report-inner-div").css("margin-left", last_session_margin+"px");
}

//window.onload = function(){show_saved_value(); drawTheGraph(0);};

jQuery(document).ready(function(){
	position_report_index();
    show_saved_value();
});



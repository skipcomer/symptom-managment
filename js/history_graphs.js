// JavaScript Document

function jdraw_graphs(){
		var pix_per_day = 10;
		var days_per_graph = canvas_width/pix_per_day;
		var month_labels = ["JANUARY","FEBRUARY","MARCH","APRIL","MAY","JUNE","JULY","AUGUST","SEPTEMBER","OCTOBER","NOVEMBER","DECEMBER"];
		for(var i=0;i<graph_list.length;i++){
			var this_month = 0;
			var current_month = start_month;//month counter
			var this_month_length = month_lengths[current_month-1];//number of days/month from array
			var this_day = start_day;
			var canvas = document.getElementById(graph_list[i]);
			var context = canvas.getContext("2d");
			
			//draw each day
			for(var j=0;j<start_offset_days;j++){
				context.fillStyle = "rgb(245,245,245)";
				context.fillRect((j*pix_per_day),0,7,100);
				context.font = "7pt Arial";
				//draw index labels
				if(j==0){
					for (var ndx=0;ndx<6;ndx++){
						context.fillStyle = "#888888";
						var ndx_value = (5-ndx)*2;
						var ndx_y = Math.min(Math.max((ndx*20)+5,7),99);
						if(ndx > 0){
							this_x = (j*pix_per_day);
						}else{
							this_x = (j*pix_per_day)-2;
						}
						context.fillText(ndx_value.toString(),this_x,ndx_y);
					}
				}else{
					//draw index lines
					for (var ndx=1;ndx<5;ndx++){
						context.beginPath();
						context.moveTo((j*pix_per_day),(ndx*20));
						context.lineTo((j*pix_per_day)+7,(ndx*20));
						context.closePath();
						context.lineWidth = 0.5;
						context.strokeStyle = "#e0e0e0";
						context.stroke();
					}
					//prevent overwriting of last stroke
					context.beginPath();
					context.moveTo(0,0);
					context.lineTo(0,0);
					context.closePath();
					//
				}
				if(this_month != current_month){
					this_month = current_month;
					var label_margin = 0;
					context.fillStyle = "rgb(0,0,0)";
					context.fillText(month_labels[this_month-1],((j*pix_per_day)+label_margin),115);
					context.fillText("10",((j+9)*pix_per_day),115);
					context.fillText("15",((j+14)*pix_per_day),115);
					context.fillText("20",((j+19)*pix_per_day),115);
					context.fillText("25",((j+24)*pix_per_day),115);
					this_month_length = month_lengths[this_month-1];
				}
				this_day++;
				if(this_day > this_month_length){
					this_day = 1;
					current_month ++;
				}
				if (current_month > 12){
						current_month = 1;
				}
			}
			//draw each day
			for(j=start_offset_days;j<interval;j++){
//				context.fillStyle = "rgb(228,228,228)";
//				context.fillRect((j*pix_per_day),0,7,100);

				context.fillStyle = "rgba(239,187,187,0.4)";
				context.fillRect((j*pix_per_day),0,7,30);
				context.fillStyle = "rgba(222,205,85,0.4)";
				context.fillRect((j*pix_per_day),30,7,40);
				context.fillStyle = "rgba(153,222,187,0.4)";
				context.fillRect((j*pix_per_day),70,7,30);
				
				
				//draw index labels
				if(this_day == 1){
					for (var ndx=0;ndx<6;ndx++){
						context.fillStyle = "#888888";
						var ndx_value = (5-ndx)*2;
						var ndx_y = Math.min(Math.max((ndx*20)+5,7),99);
						if(ndx > 0){
							this_x = (j*pix_per_day);
						}else{
							this_x = (j*pix_per_day)-2;
						}
						context.fillText(ndx_value.toString(),this_x,ndx_y);
					}
				}else{
					//draw index lines
					for (var ndx=1;ndx<5;ndx++){
						context.beginPath();
						context.moveTo((j*pix_per_day),(ndx*20));
						context.lineTo((j*pix_per_day)+7,(ndx*20));
						context.closePath();
						context.lineWidth = 0.5;
						context.strokeStyle = "#f8f8f8";
						context.stroke();
					}
					//prevent overwriting of last stroke
					context.beginPath();
					context.moveTo(0,0);
					context.lineTo(0,0);
					context.closePath();
					//
				}
				
				if(this_month != current_month){
					this_month = current_month;
					label_margin = 7;
					context.strokeStyle = "rgb(0,0,0)";
					context.lineWidth = 1;
					context.moveTo((j*pix_per_day),100);
					context.lineTo((j*pix_per_day),120);
					context.stroke();
					context.fillStyle = "rgb(0,0,0)";
					context.fillText(month_labels[this_month-1],((j*pix_per_day)+label_margin),115);
					context.fillText("10",((j+9)*pix_per_day),115);
					context.fillText("15",((j+14)*pix_per_day),115);
					context.fillText("20",((j+19)*pix_per_day),115);
					context.fillText("25",((j+24)*pix_per_day),115);
					this_month_length = month_lengths[this_month-1];
				}
				this_day++;
				if(this_day > this_month_length){
					this_day = 1;
					current_month ++;
				}
				if (current_month > 12){
						current_month = 1;
				}
			}
			//draw each day
			for(j=interval;j<days_per_graph;j++){
				context.fillStyle = "rgb(245,245,245)";
				context.fillRect((j*pix_per_day),0,7,100);
				
				//draw index labels
				if(this_day == 1){
					for (var ndx=0;ndx<6;ndx++){
						context.fillStyle = "#888888";
						var ndx_value = (5-ndx)*2;
						var ndx_y = Math.min(Math.max((ndx*20)+5,7),99);
						if(ndx > 0){
							this_x = (j*pix_per_day);
						}else{
							this_x = (j*pix_per_day)-2;
						}
						context.fillText(ndx_value.toString(),this_x,ndx_y);
					}
				}else{
					//draw index lines
					for (var ndx=1;ndx<5;ndx++){
						context.beginPath();
						context.moveTo((j*pix_per_day),(ndx*20));
						context.lineTo((j*pix_per_day)+7,(ndx*20));
						context.closePath();
						context.lineWidth = 0.5;
						context.strokeStyle = "#e0e0e0";
						context.stroke();
					}
					//prevent overwriting of last stroke
					context.beginPath();
					context.moveTo(0,0);
					context.lineTo(0,0);
					context.closePath();
					//
				}
				
				if(this_month != current_month){
					this_month = current_month;
					label_margin = 7;
					context.strokeStyle = "rgb(0,0,0)";
					context.lineWidth = 0.5;
					context.beginPath();
					context.moveTo((j*pix_per_day),100);
					context.lineTo((j*pix_per_day),120);
					context.closePath();
					context.stroke();
					context.fillStyle = "rgb(0,0,0)";
					context.fillText(month_labels[this_month-1],((j*pix_per_day)+label_margin),115);
					context.fillText("10",((j+9)*pix_per_day),115);
					context.fillText("15",((j+14)*pix_per_day),115);
					context.fillText("20",((j+19)*pix_per_day),115);
					context.fillText("25",((j+24)*pix_per_day),115);
					this_month_length = month_lengths[this_month-1];
				}
				this_day++;
				if(this_day > this_month_length){
					this_day = 1;
					current_month ++;
				}
				if (current_month > 12){
						current_month = 1;
				}
			}
			
			context.strokeStyle = "rgb(0,0,0)";
			context.lineWidth = 1;
			context.beginPath();
			context.moveTo(0,100);
			context.closePath();
			context.lineTo(canvas_width,100);
			context.stroke();
			
			var day_space;
		
			
			//draw graph line
			
			context.strokeStyle = "rgb(180,0,0)";
			context.lineWidth=5;
			context.beginPath();
			point_counter = 0;//count the number of points drawn
			for(var k=0;k<data_obj[graph_list[i]].length;k++){
				
				day_space =  (data_obj[graph_list[i]][k].day) * pix_per_day;
				//var data_space = 20*(data_obj[graph_list[i]][k].value);//0-5 index
				var data_space = 10*(data_obj[graph_list[i]][k].value);//0-10 index
				if(data_obj[graph_list[i]][k].value != null){
					if(point_counter==0){
						context.moveTo(day_space+3.5, 100-data_space);
					}else{
						context.lineTo(day_space+3.5, 100-data_space);
						context.stroke();
					}//if(point_counter==0
					point_counter ++ ;
				}//(data_obj[graph_list[i]][k].value != null
				
			}
		
			
			//draw data point circles
			for(var k=0;k<data_obj[graph_list[i]].length;k++){
				day_space = (data_obj[graph_list[i]][k].day) * pix_per_day;
				//var data_space = Math.max((20*(data_obj[graph_list[i]][k].value)),3);
				var data_space = Math.max((10*(data_obj[graph_list[i]][k].value)),0);
				if(data_obj[graph_list[i]][k].value != null){
					context.fillStyle = "#FFFFFF";//circle color
					//context.fillRect(day_space,(100-data_space),7,data_space);
					context.strokeStyle = "rgb(0,0,0)";
					context.lineWidth=2;
					context.beginPath();
					context.arc(day_space+3.5,(100-data_space),5,0,2*Math.PI);
					context.fill();
					context.stroke();
				} //if(data_obj[graph_list[i]][k].value != null){
			}

			//---------------------------------
			
			var x_scroll = day_space;
			//scroll window to last data item...
			var g_window = $("#"+graph_list[i]).parent().parent();
			var g_width = g_window.width();
			g_window.scrollLeft((x_scroll-g_width)+50);
			
			//draw any alerts
			alert_count = 0;
			var feedback_msg = "";
			for(var k=0;k<data_obj[graph_list[i]].length;k++){
				day_space = (data_obj[graph_list[i]][k].day) * pix_per_day;
				var data_value = data_obj[graph_list[i]][k].value;
				//var data_space = Math.max((20*(data_value)),3);
				var data_space = Math.max((10*(data_value)),3);
				if (data_value > 6){
					//draw alert
					alert_count ++;
					context.beginPath();
					context.moveTo((day_space-18),16);
					context.lineTo((day_space-18)+9,1);
					context.lineTo((day_space-18)+18,16);
					context.closePath();
					context.lineWidth = 2;
					context.strokeStyle = "#000000";
					context.stroke();
					context.fillStyle = "#ffff00";
					context.fill();
					context.fillStyle = "rgb(0,0,0)";
					context.font = "11pt Trebuchet MS";
					context.fillText("!",((day_space-18)+6),15);	
					context.font = "7pt Arial";	
				}
			}
			get_the_trends(data_obj[graph_list[i]], i, alert_count);
		}
	}
		var alert_image = "<!--[if !IE ]><!--><img src = \"images/alert.png\" id=\"alert_img\"/><!--<![endif]--><!--[if gte IE 9]><img src = \"images/alert.png\" id=\"alert_img\"/><![endif]--><!--[if lte IE 8]><img src = \"images/alert_8.png\" id=\"alert_img\"/><![endif]-->";
		
		var alert_feedback0 = "<p id=\"feedback_text\">This has been a troublesome issue for you, but you seem to be making progress.  Congratulations, and keep up the good work!";
	
	var alert_feedback1 = "<p id=\"feedback_text\">This is a high-priority issue for you.  Be sure to read any advice about this issue in the Symptom Management Guide.  Also, make it a priority to seek useful resources and strategies to reduce your stress and improve your well-being.";

	var alert_feedback2 = "<p id=\"feedback_text\">This continues to be a high-priority issue for you.  You may benefit from discussing this issue with your health care provider in order to manage this symptom.";
	
	
	function get_the_trends(datalist,graph_number,num_alerts){
		var thisfeedback = "";
		
		if(datalist[datalist.length-1].value > "6"){
			if (num_alerts > 1){
				thisfeedback = alert_image+alert_feedback2;
			}else{
				thisfeedback = alert_image+alert_feedback1;
			}
		}else{
			switch (datalist.length){
				case 0:
				case 1:break;
				default:
					if(datalist[datalist.length-2].value > datalist[datalist.length-1].value ){
						if(num_alerts > 0){
							thisfeedback = alert_feedback0;
						}else{
							thisfeedback = "<p id=\"feedback_text\">It looks like this issue is improving. Stay on top of it, and keep using the strategies that are working for you.";
						}
					}
					if(datalist[datalist.length-2].value  < datalist[datalist.length-1].value ){
						if(num_alerts > 0){
							thisfeedback = "<p id=\"feedback_text\">This issue has been a problem for you in the past, and the latest update shows that you are having difficulty with this issue again.  Try to find resources and strategies that will help you to manage this symptom.";
						}else{
							thisfeedback = "<p id=\"feedback_text\">Your latest update indicates that you are seeing more trouble with this issue.  Try to find resources and strategies that will help you with this symptom.";
						}
					}
					if(datalist[datalist.length-2].value  == datalist[datalist.length-1].value ){
						if(num_alerts > 0){
							switch(datalist[datalist.length-1].value ){
								case 0:
								case 1:
								case 2: thisfeedback = "<p id=\"feedback_text\">This issue has been a problem in the past, but you seem to be doing well for now. Stay on top of it, and keep using the strategies that are working for you.";break;
								case 3: thisfeedback = "<p id=\"feedback_text\">This issue has been a problem in the past, so you should pay attention so that it does not cause more trouble for you.  Be proactive and try to stay ahead of the problems with good planning.";break;
								case 4: thisfeedback = alert_image+"<p id=\"feedback_text\">This issue has been a problem  in the past, and continues to cause high levels of stress.  Make it a priority to get it under control.  Try to find useful resources and strategies that will help reduce your stress and improve your well-being.";break;
							}
						}else{
							switch(datalist[datalist.length-1].value ){
								case 0:
								case 1:
								case 2: thisfeedback = "<p id=\"feedback_text\">You seem to be doing well with this issue. Stay on top of it, and keep using the strategies that are working for you.";break;
								case 3: thisfeedback = "<p id=\"feedback_text\">Pay attention to this issue so that it does not cause more trouble for you.  Be proactive and try to stay ahead of the problems with good planning.";break;
								case 4: thisfeedback = alert_image+"<p id=\"feedback_text\">Focus on this concern to get it under control, if possible.  Make it a priority to seek useful resources and strategies to reduce your stress and improve your well-being.";break;
							}
						}
					}
					break;
			}
		}
		
		var this_link = "_003_001";
		this_link +="_"+graph_list[graph_number].substring(9,12);
		
		var link_msg = "<p>To review the Symptom Management Guide information for this topic, <a href=\"index.php?seq="+this_link+"\">click here.</a></p>"
		
		$("#"+feedback_list[graph_number]).html(thisfeedback+link_msg);
	}
	
	function draw_flash(){
	var flash_width = $("#graph_container").width();
	var pix_per_day = 10;
	for (i=0;i<graph_list.length;i++){
		dplist="";		
		dtlist="";	
		alert_count = 0;
		last_data_point = 0;
		for (j=0;j<data_obj[graph_list[i]].length;j++){
			datapoint = data_obj[graph_list[i]][j].value;
			dplist += "_"+ datapoint;
			this_date = data_obj[graph_list[i]][j].day;
			dtlist += "_"+ this_date;
			last_data_point = data_obj[graph_list[i]][j].value;
			if(last_data_point > 6){alert_count++;}
		}
		swfobject.embedSWF("swf/portal_graph.swf", graph_list[i], flash_width, "140", "9", "expressInstall.swf",{ st_time:start_time, st_offset:start_offset_days, interval:interval, dplist:dplist, dtlist:dtlist });
		get_the_trends(data_obj[graph_list[i]],i,alert_count);
		
	}
}
	
	

	function set_up_history_page(){
		$("#history").empty();
		for (var i=0;i<graph_list.length;i++){
			$("#history").append("<div id=\"topic\"><h4>"+name_list[i]+"</h4><div id=\"graph_container\"><div id=\"d"+graph_list[i]+"\">Loading Symptom Reports for "+name_list[i]+"</div></div><div class=\"graph_feedback\" id=\""+feedback_list[i]+"\"></div></div><br/>");
		}
		$("#history").append("<br/><br/>");
	}
		
	function set_up_canvas(){
		for (var i=0;i<graph_list.length;i++){
			var this_div = "#d"+graph_list[i];
			var this_html = '<canvas width="'+canvas_width+'" height="120" id="'+graph_list[i]+'"></canvas>';
			$(this_div).html(this_html);		
		}
	}
		
	function set_up_flash(){
		for (var i=0;i<graph_list.length;i++){
			var this_div = "#d"+graph_list[i];
			$(this_div).addClass("flash_container");
			var this_html = '<div id="'+graph_list[i]+'" style="width:'+string(flash_window_width + 4)+'px"><h4>Flash Player problem</h4><p style="text-transform:none">You should be seeing a graph displaying your My Profile data in this space.  If you are seeing this message, you need to get or update the Flash Player.<a href="http://www.adobe.com/go/getflashplayer"><img src="http://www.adobe.com/images/shared/download_buttons/get_flash_player.gif" alt="Get Adobe Flash player" /></a></p></div>';
			$(this_div).html(this_html);		
		}
	}

	//----------------------------------------------------update page text

	function update_page_text(latest_session){
		
		var latest_days = Math.round(latest_session);
		var latest_weeks = Math.round(latest_session/7);
		var latest_months = Math.round(latest_session/30);
		var time_span = "";
		if(record_months > 1){
			time_span = record_months.toString()+" months";
		}else{
			if (record_weeks > 1){
				time_span = record_weeks.toString()+" weeks";
			}else{
				if(record_days == 1){
					time_span = record_days.toString()+" day";
				}else{
					time_span = record_days.toString()+" days";
				}
			}
		}
		
		var latest_session = "";
		if(latest_months > 1){
			latest_session = latest_months.toString()+" months";
		}else{
			if (latest_weeks > 1){
				latest_session = latest_weeks.toString()+" weeks";
			}else{
				if(latest_days == 1){
					latest_session = latest_days.toString()+" day";
				}else{
					latest_session = latest_days.toString()+" days";
				}
			}
		}
		var record_info = "";
		var update_plural = "";
		if(graph_list.length > 0){
			if (data_obj[graph_list[0]].length > 0){
				var num_sessions = (data_obj[graph_list[0]].length).toString();
				if(num_sessions > 1){update_plural = "s";}
			}
		}
	}
	
	
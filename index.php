<?php

global $seq;
$omrs_id = 31;

////-----------------------------SESSION/PASSWORD CONTROL
//
session_start();
////set the sessions to last for 3 hours
//if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > (3*60*60))){
//	// last request was more than 3 hours ago
//	session_unset();     // unset $_SESSION variable for the run-time 
//	session_destroy();   // destroy session data in storage
//	$_SESSION['LAST_ACTIVITY'] = time(); // update last activity time stamp
//}
//// change the session ID after 3 hours to avoid session fixation attacks
//if (!isset($_SESSION['CREATED'])) {
//    $_SESSION['CREATED'] = time();
//} else if (time() - $_SESSION['CREATED'] > (3*60*60)) {
//    // session started more than 3 hours ago
//   	session_regenerate_id(true);    // change session ID for the current session an invalidate old session ID
//  	$_SESSION['CREATED'] = time();  // update creation time
//}
	
// make a mysqli connection
include("php/o_portalConnect.php");
	
	
	
$user_id = 0;
if(isset($_SESSION["user_id"])){
	$user_id = $_SESSION["user_id"];
}
	
$start_page = '_003';
	
////search variables
//$search_term = '';
//$from_search = '';
//$st = 0;
//$display_max = 20;
//$fin = $st + $display_max;
//	
//$tracking_seq = '_003';
//if (isset($_REQUEST["seq"])){
//	$tracking_seq = $_REQUEST["seq"];
//}
//	
//	
if(!isset($_SESSION["mysql_sid"])){
	$query = "INSERT INTO  `sessions` (`session_id` ,`user_id` ,`timestamp`)
				VALUES (NULL ,  '".$user_id."', NOW( ))";
	$result = mysqli_query($link, $query);
	$_SESSION["mysql_sid"] = mysqli_insert_id($link);
	$_SESSION["user_id"] = $user_id;
			
	$query = "INSERT INTO  `nav_tracking` (`id` ,`session_id` ,`user_id` ,`pointer` ,`seq` ,`timestamp`)
				VALUES (NULL, '".$_SESSION["mysql_sid"]."',  '".$user_id."',  'current',  '".$tracking_seq."', NOW())";
	$result = mysqli_query($link, $query);
			
}
$session_id = $_SESSION["mysql_sid"];
//	
	/* Sanitize function*/
function sanitize($item){
	global $link;
	$item = html_entity_decode($item);
	$item = trim($item);
	$item = stripslashes($item);
	$item = mysqli_real_escape_string($link, $item);
	return($item);
}
	
	//
if((isset($_REQUEST['username']))&&(isset($_REQUEST['password']))){
	// username and password sent from form 
	$myusername = sanitize($_REQUEST['username']); 
	$mypassword = sanitize($_REQUEST['password']); 
		
	$mypassword = SHA1($mypassword);
		
	$query = "SELECT * FROM users WHERE username='".$myusername."' and password='".$mypassword."'";
	$result = mysqli_query($link, $query);
		
	// Mysql_num_row is counting table row
	$count = mysqli_num_rows($result);
		
	// If result matched $myusername and $mypassword, table row must be 1 row
	if($count==1){
		$row = mysqli_fetch_array($result, MYSQLI_BOTH);
		if ($row["id"] == $omrs_id){
			$message .= " --got31-- ";
			if(isset($_REQUEST["omrs_user"])){
				$o_user = sanitize($_REQUEST["omrs_user"]);
				$o_query = "SELECT * FROM users WHERE username = '".$o_user."'";
				$o_result = mysqli_query($link, $o_query);
						
				if(mysqli_num_rows($o_result) < 1){
					//----------create OMRS user account-------------------
	
					$message .= "haven't seen this OMRS user before... creating account.<br/>";
					$mypassword = SHA1("OMRS*user-12");
			
					$i_query = "INSERT INTO `users` (`id`, `username`, `password`) 
								VALUES (NULL, '".$o_user."', '".$mypassword."')"; 
					$i_result = mysqli_query($link, $i_query);	
					$o_user_id = mysqli_insert_id($link);
					$message .= "Success creating account: user ID ".$o_user_id."<br/>";
						
					$_SESSION["user_id"] = $o_user_id;
					$user_id = $_SESSION["user_id"];
							
					if(isset($_SESSION["mysql_sid"])){
						$s_query = "UPDATE `sessions` set user_id ='".$o_user_id."' WHERE session_id = '".$_SESSION["mysql_sid"]."'";
						$s_result = mysqli_query($link,$s_query);
					}else{ //  -  if(isset($_SESSION["mysql_sid"]))
						$s_query = "INSERT INTO  `sessions` (`session_id` ,`user_id` ,`timestamp`)
									VALUES (NULL ,  '".$o_user_id."', NOW( ))";
						$s_result = mysqli_query($link, $s_query);
						$_SESSION["mysql_sid"] = mysqli_insert_id($link);
					}// end -- else if(isset($_SESSION["mysql_sid"]))
					$message .= "The session has been set for a new user:  Session ID ".$_SESSION["mysql_sid"];
							
					//draw_portal_page($seq);
					$login = true;
				}else{ //if(mysql_num_rows($o_result) < 1)
					if(mysqli_num_rows($o_result) == 1){
								
							//--------existing OMRS user---------------
								
						$o_row = mysqli_fetch_array($o_result, MYSQLI_BOTH);
						$_SESSION["user_id"] = $o_row["id"];
						$user_id = $_SESSION["user_id"];
						if(isset($_SESSION["mysql_sid"])){
							$s_query = "UPDATE `sessions` set user_id ='".$o_row["id"]."' 
										WHERE session_id = '".$_SESSION["mysql_sid"]."'";
							$s_result = mysqli_query($link,$s_query);
							$message .= "The session has been resumed for an existing user:  Session ID ".$_SESSION["mysql_sid"];
						}else{// -- if(isset($_SESSION["mysql_sid"])){
							$s_query = "INSERT INTO  `sessions` (`session_id` ,`user_id` ,`timestamp`)
										VALUES (NULL ,  '".$o_row["id"]."', NOW( ))";
							$s_result = mysqli_query($link,$s_query);
							$_SESSION["mysql_sid"] = mysqli_insert_id($link);
							$message .= "A new session has been set for an existing user:  Session ID ".$_SESSION["mysql_sid"];
								//draw_portal_page($seq);
							$login = true;
						}//end -- if(isset($_SESSION["mysql_sid"])){
					}else{// --else  if(mysql_num_rows($o_result) ==1)
						$message .= "There are multiple records in the database for this user name. Login has failed.";
					}//end else if(mysql_num_rows($o_result) ==1)
				} //end -- else if(mysql_num_rows($o_result) < 1)
			}//end  -- if(isset($_REQUEST["omrs_user"])){
		}// end if ($row["id"] == $omrs_id){
	}//  end  if($count==1)			
}//  end  if((isset($_REQUEST['username']))&&(isset($_REQUEST['password']))){
			

	
//	//search-------------------------------------------------------
//	
//	if(isset($_REQUEST['search'])){
//		$start_page = "_000_994";
//		$search_term = sanitize($_REQUEST['search']);
//
//		if(isset($_REQUEST['st'])){
//			$st = $_REQUEST['st'];
//			$fin = $st + $display_max;
//		}
//		unset($_REQUEST['search']);
//		unset($_REQUEST['st']);
//	}
//	if(isset($_REQUEST['from_search'])){
//		$search_term = sanitize($_REQUEST['from_search']);
//		
//		$from_search = $search_term;
//		if(isset($_REQUEST['st'])){
//			$st = $_REQUEST['st'];
//			$fin = $st + $display_max;
//		}
//		unset($_REQUEST['from_search']);
//		unset($_REQUEST['st']);
//	}
////-----------------------------------------------user tracking
//	$last_id = -1;
//	if(isset($_REQUEST['t'])){
//		$last_id = $_REQUEST['t'];
//	}
//	$t_id = $last_id;
//	if($last_id != "-1"){
//			$query = "UPDATE user_tracking 
//				SET leave_time = NOW(),
//				elapsed_time = TIMESTAMPDIFF(SECOND,load_time,NOW())
//				WHERE id = '".$last_id."'";
//			$result = mysqli_query($link, $query);
//	}
//	
////------------------------------------------------nav tracking
//	$v_id = 0;	
////-----------------------------------------------NAVIGATION CONTROL
	$nav_direction = "menu";
	if(isset($_REQUEST["nav"])){
		$nav_direction = sanitize($_REQUEST["nav"]);
	}
	
	$current_seq = sanitize($_REQUEST["seq"]);
	
	if($current_seq == NULL){
		$seq = $start_page;
	}else{
		$seq = $current_seq;
	}

	
	if($nav_direction == "next"){
		$navquery = "SELECT seq
					FROM screenlist 
					WHERE `seq` > '".$seq."' 
					AND `s_type` = 'screen' 
					ORDER BY `seq` ASC LIMIT 1";
		$navresult = mysqli_query($link, $navquery);
		$navrow = mysqli_fetch_array($navresult, MYSQLI_BOTH);
		if($navrow["seq"] != NULL){
			$seq = 	$navrow["seq"];	
		}
	}
	
	if($nav_direction == "prev"){
		$navquery = "SELECT seq
					FROM screenlist 
					WHERE `seq` < '".$seq."' 
					AND `s_type` = 'screen' 
					ORDER BY `seq` DESC LIMIT 1";
		$navresult = mysqli_query($link, $navquery);
		$navrow = mysqli_fetch_array($navresult, MYSQLI_BOTH);
		if($navrow["seq"] != NULL){
			$seq = 	$navrow["seq"];	
		}
	}
	
	if($nav_direction == "back"){

		$navquery = "SELECT seq
					FROM nav_tracking 
					WHERE `pointer` = 'back' 
					AND session_id = '".$session_id."'
					ORDER BY `id` DESC LIMIT 1";
		$navresult = mysqli_query($link, $navquery);
		$navrow = mysqli_fetch_array($navresult, MYSQLI_BOTH);
		if($navrow["seq"] != NULL){
			$seq = 	$navrow["seq"];		
		}	
	}
	
	header("Content-Type: text/html");
    header("Cache-Control: no-store");
    header("Pragma: no-cache");
	
	$html = '';
	if ($_REQUEST["test"] == "1")	{$html = 'test';}
	
	
	//user tracking----------------------
	$query = "INSERT into user_tracking VALUES(
					NULL,
					'".$user_id."',
					'".$session_id."',
					'".$seq."',
					'".$s_name."',
					'".$deeplink."',
					NOW(),
					NULL,
					NULL)";
	$result = mysqli_query($link, $query);
	$t_id = mysqli_insert_id($link);
	
	//nav tracking--------------------------
	switch ($nav_direction){
		case "CGback":
		case "back":
			$query = "UPDATE `nav_tracking` set pointer = 'next' 
					WHERE pointer = 'current'
					AND session_id = '".$session_id."'";
			$result = mysqli_query($link, $query);
			$query = "UPDATE `nav_tracking` set pointer = 'current' 
					WHERE seq = '".$seq."'
					AND session_id = '".$session_id."'";
			$result = mysqli_query($link, $query);
			break;
			
		case "CGnext":
		case "next":
			$query = "UPDATE `nav_tracking` set pointer = 'back' 
					WHERE pointer = 'current'
					AND session_id = '".$session_id."'";
			$result = mysqli_query($link, $query);
			$query = "SELECT * from `nav_tracking`
					WHERE pointer = 'next'
					AND session_id = '".$session_id."'
					ORDER BY id ASC
					LIMIT 1";
			$result = mysqli_query($link, $query);
			if(mysqli_num_rows($result) > 0){
				$rows = mysqli_fetch_array($result, MYSQLI_BOTH);
				$query = "UPDATE `nav_tracking` set pointer = 'current' 
					WHERE seq = '".$seq."'
					AND id = '".$rows["id"]."'
					AND session_id = '".$session_id."'";
				$result = mysqli_query($link, $query);
			}else{
				$query = "INSERT INTO `nav_tracking` (`id` ,`session_id` ,`user_id` ,`pointer` ,`seq` ,`timestamp`)
							VALUES (NULL, '".$session_id."',  '".$user_id."',  'current',  '".$seq."', NOW())";
				$result = mysqli_query($link, $query);
			}
			break;
				
		case "menu":
		case "prev":
		default:
			$query = "UPDATE `nav_tracking` set pointer = 'back' 
					WHERE pointer = 'current'
					AND session_id = '".$session_id."'";
			$result = mysqli_query($link, $query);
			$query = "UPDATE  `nav_tracking` set pointer = 'branch' 
					WHERE pointer = 'next'
					AND session_id = '".$session_id."'";
			$result = mysqli_query($link, $query);
			$query = "INSERT INTO  `nav_tracking` (`id` ,`session_id` ,`user_id` ,`pointer` ,`seq` ,`timestamp`)
							VALUES (NULL, '".$session_id."',  '".$user_id."',  'current',  '".$seq."', NOW())";
			$result = mysqli_query($link, $query);
			break;		
	}
//	
//	echo $seq." user:".$_SESSION["user_id"]." Msg:".$message;

////////////////////////////////do main query here---------------------

	$query = "SELECT s_name, obj_type, content, displayobj.id as dobj_id FROM screenlist, displaylist, displayobj
				WHERE seq = '".$seq."'
				AND screenlist.displaylist_id = displaylist.displaylist_id
				AND displayobj.id = displaylist.displayobj_id";		
$result = mysqli_query($link, $query);
while($row = mysqli_fetch_array($result, MYSQLI_BOTH)){
	$this_dobj_id = $row["dobj_id"];
	switch($row["obj_type"]){
		case "head":
		case "title":
		case "html":$html .= $row["content"];
				break;
		case "include":	include($row["content"]);
				break;	
	}
}
	
	echo $html;
	
	session_write_close();
	

	//echo $num_rows;

?>
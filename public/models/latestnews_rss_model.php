<?php
	global $seq;
	$latestnews = array();
	switch($seq){
		case "_001":
		case "_001_001": $item_limit = 10; break;
		default: $item_limit = 50; break;
	}
	
	$counter = 0;
	
		 $feeds[0] = "http://feeds.reuters.com/reuters/healthNews?format=xml";
		 $feeds[1] = "http://www.nlm.nih.gov/medlineplus/feeds/news_en.xml";
		 //$feeds[2] = "http://www.cancer.org/docroot/NWS/Rss20.xml";
		 $feeds[2] = "http://newsrss.bbc.co.uk/rss/newsonline_world_edition/health/rss.xml";
		 
		 
		 
		 foreach ($feeds as $feed){
			 
	     	$xmlfile = $feed;
			$xml = simplexml_load_file($xmlfile);
			
			$source = $xml->channel->title;
			
			foreach ($xml->channel->item as $item){
				$foundKey = false;
				$keyword = "CANCER";
				//$keyword = "EPIDEMIC";
				
				//process description////////////////
				@$d = $item->description;
				//get rid of the advertisements, images with the explode string function
				$txtArray = explode('<span class="advertisement">',$d);
				@$d = $txtArray[0];
				$txtArray = explode('<div class="feedflare">',$d);
				@$d = $txtArray[0];
				$txtArray = explode('&lt;div class="feedflare"&gt;',$d);
				@$d = $txtArray[0];
				//end description////////////
				//check for keywords
				
				$checkTxt = strtoupper($item->title);
				
				if (strpos($checkTxt, $keyword) !== false){
					$foundKey = true;
				}
			
				$checkTxt = strtoupper($d);
				if (strpos($checkTxt, $keyword) !== false){
					$foundKey = true;
				}
			
				//process date///////////////
				$pubDate = $item->pubDate;
				$dateArray = explode(" ",$pubDate);
				$day_of_week = $dateArray[0];
				$day = $dateArray[1];
				$mo = $dateArray[2];
				$yr = $dateArray[3];
				$displayDate = $mo." ".$day.", ".$yr;
				//end process date///////////
				
				
				if ($foundKey){
					if($counter < $item_limit){
						//full listing:
						//$article = "<li><a href=\"".$item->link."\" target=\"_blank\">".$item->title."</a> | ".$d." | <i>".$source."</i> | ".$displayDate."<br></li>";
						//brief listing:
						//$article = "<li><a href=\"".$item->link."\" target=\"_blank\">".$item->title."</a><br /><i>".$source."</i> | ".$displayDate."<br></li>";
						//$html .= $article;
						$item_array = array(); 
						$item_array["source"] = $source;
						$item_array["display_date"] = $displayDate;
						$item_array["link"] = $item->link;
						$item_array["title"] = $item->title;
						$item_array["description"] = $item->description;
						$latestnews[] = $item_array;
						$counter ++;
					}  // if($counter < $item_limit)
				}//  if ($foundKey)
			}//  foreach ($xml->channel->item as $item)
		} //  foreach ($feeds as $feed)
?>
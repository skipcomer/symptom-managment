		<div id="latestnews" class="container">
        	<div id="latestnews_row" class="row">
                <div class="col-xs-12">        
                    <div id="news_window" class="well well-lg">
                        <h4>Latest News About Cancer</h4>
                        <ul>
<?php  
	foreach($latestnews as $newsitem){
		echo '
							<li>
								<span id="news_title"><a href="'.$newsitem["link"].'" target="_blank" >'.$newsitem["title"].'</a></span>
								<span id="news_source"><i>'.$newsitem["source"].'</i> | '.$newsitem["display_date"].'</span>
							</li>';
	}
?>                      

                        </ul>
                        <div id="news_more"><a href="index.php?seq=_001_003">More...</a><br/></div>
                  	</div>  <!--/#news_window .well  -->
               	</div> <!-- /.col-xs-12 -->
			</div>  <!-- /.row -->
		</div>  <!-- /.container -->	
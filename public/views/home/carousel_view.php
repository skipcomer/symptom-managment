<!-- Carousel ================================================== -->
    <div id="slider" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
      <?php
	  	$counter = 0;
		$active = "";
	  	foreach($carousel_array as $carousel){
			$active = "";
			if($counter == 0){
				$active = ' class="active"';
			}
			echo '
		<li data-target="#slider" data-slide-to="'.$counter.'"'.$active.'></li>';
		$counter++;
		}

		?>
      </ol>
      <div class="carousel-inner" role="listbox">
      <?php
		  	$counter = 0;
			$active = '"item"';
			foreach($carousel_array as $carousel){
				$active = '"item"';
				if($counter == 0){
					$active = '"item active"';
				}
				echo '
		<div class='.$active.'>
			<div class="container">
				<div class="row">
					<div class="col-xs-1"></div>
						<div id="slider_content" class="col-xs-10" onclick="javascript:get_page(\''.$carousel["link"].'\');">
							<div class="row">
								<div class="col-xs-6"><img src="'.$carousel["graphic"].'" border="0" /></div>
								<div id="welcome_text" class="col-xs-6">
									'.$carousel["text"].'
									<div id="more_link">...more ></div>  <!-- /#more_link  -->
								</div>  <!-- /#welcome_text  -->
                            </div>  <!--/ inner .row-->
                		</div>  <!-- /#welcome_slider  -->
                	<div class="col-xs-1"></div>
            	</div>  <!-- /.row -->
        	</div>  <!-- /.container  -->   
        </div>  <!-- /.item active -->
							';
			$counter++;
			}
      ?>
      
      </div>  <!--/.carousel-inner -->
      <a class="left carousel-control" href="#slider" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#slider" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
      </a>
    </div><!-- /.carousel -->
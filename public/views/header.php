<body>

<!-- Scripts in body tag REMOVED -->

<!-- bootstrap header  -->
<nav class="navbar navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="#">Burdette Portal</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav pull-right">
          <?php
		  	global $seq;
			$seq_array = explode("_", $seq);
			$this_screen = "_".$seq_array[1];
          	foreach ($screen_array as $screen){
				if($screen["seq"] == $this_screen){
					echo '
			<li class="dropdown active">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'.$screen["s_name"].'<span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">';
				}else{
					echo '
			<li class="dropdown">
				<a href="index.php?seq='.$screen["seq"].'" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">'.$screen["s_name"].'<span class="caret"></span></a>
				<ul class="dropdown-menu" role="menu">';
				}
				
				foreach($screen["submenu"] as $submenu){
					echo '
					<li><a href="index.php?seq='.$submenu["seq"].'">'.$submenu["s_name"].'</a></li>';
				}
					
			echo '
				</ul>
			</li>';	
			}
          ?>
 
       		<li>
                <form id="search_wrapper" class="navbar-form navbar-right" method="post" action="index.php" style="clear:both;"><input id="search" name="search" class="form-control" type="search" placeholder="Search"></form>
             </li>
          </ul>
        </div><!--/.nav-collapse -->
      </div> <!--/.container -->
    </nav>
<!-- /bootstrap header  -->
<!-- Portal Header
<header>
	<div id="header-line2">
	<span id="burdette" onClick="javascript:get_page('_001');" style="cursor:pointer;cursor:hand;" );">The Portal</span>
	<span id="header_text">Information, Resources, and Tools for People Dealing with Cancer</span>
	</div>
</header>    -->
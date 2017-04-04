<div class="container">
	<div class="row">
		<div id="headline" class="col-md-12"><h1>Symptom Management</h1></div>
        
        <ul class="nav nav-pills">
<?php 	//calculations with seq to create correct tab UI
	$seq_array = explode('_',$seq);
	$this_section = "";
	$counter = 0;
	foreach($seq_array as $s){
		if(($counter > 0)&&($counter < 3)){
			$this_section .= "_".$s;
		}
		$counter ++;
	}

 	foreach($submenu_array as $tab){ 
		if((($seq=="_003")&&($this_section=="_003_001"))||($this_section == $tab["seq"])){     
          	echo '
		  		<li role="presentation" class="active"';
		}else{
			echo '
		  		<li role="presentation"';
		}
		
		switch($tab["seq"]){
			case "_003_001":
				//general symptom info pages
				if(count($symptom_array)>0){
					echo 'class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="index.php?seq='.$tab["seq"].'" role="button" aria-haspopup="true" aria-expanded="false">'.$tab["s_name"].'<span class="caret"></span></a>';
					echo '
					<ul class="dropdown-menu">
						<li><a href="index.php?seq=_003_001">Symptom Topics</a></li>
						<li role="separator" class="divider"></li>';
					foreach($symptom_array as $symptom){
						echo '
						<li><a href="index.php?seq='.$symptom["seq"].'">'.$symptom["s_name"].'</a></li>';
					}
					echo '
					</ul></li>'; 
				}else{
					echo '><a href="index.php?seq='.$tab["seq"].'">'.$tab["s_name"].'</a></li>';
				}
				break;
			case "_003_002":
				//report symptom pages
				if(count($report_page_array)>0){
					echo 'class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="index.php?seq='.$tab["seq"].'" role="button" aria-haspopup="true" aria-expanded="false">'.$tab["s_name"].'<span class="caret"></span></a>';
					echo '
					<ul class="dropdown-menu">
						<li><a href="index.php?seq=_003_002">Symptom Reporting</a></li>
						<li role="separator" class="divider"></li>';
					foreach($report_page_array as $symptom){
						echo '
						<li><a href="index.php?seq='.$symptom["seq"].'">'.$symptom["s_name"].'</a></li>';
					}
					echo '
					</ul></li>'; 
				}else{
					echo '><a href="index.php?seq='.$tab["seq"].'">'.$tab["s_name"].'</a></li>';
				}
				break;	
			case "_003_003":
				//custom guide pages
				if (count($custom_array) > 0){
					echo 'class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="index.php?seq='.$tab["seq"].'" role="button" aria-haspopup="true" aria-expanded="false">'.$tab["s_name"].'<span class="caret"></span></a>';
					echo '
					<ul class="dropdown-menu">
						<li><a href="index.php?seq=_003_003">Custom Symptom Management Guide</a></li>
						<li role="separator" class="divider"></li>';
					foreach($custom_array as $symptom){
						echo '
						<li><a href="index.php?seq='.$symptom["link"].'">'.$symptom["s_name"].'</a></li>';
					}
					echo '
					</ul></li>'; 
				}else{
					echo '><a href="index.php?seq='.$tab["seq"].'">'.$tab["s_name"].'</a></li>';
				}
				break;	
			default:  echo '><a href="index.php?seq='.$tab["seq"].'">'.$tab["s_name"].'</a></li>'; break;
		}
	}
?>  
		</ul>
        <br/>
    </div>  <!-- /.row  -->    
</div>  <!-- class="container" -->
<?php

//models
include("models/screen_info_model.php");
include("models/submenu_model.php");

if($seq > "_003_003"){
	include("models/custom_model.php");
}else{
	include("models/symptom_list_model.php");
}

include("models/symptom_manage_model.php");

//views
include("views/symptom/symptom_head.php");
include("views/symptom/header.php");
include("views/sub_nav.php");
include("views/symptom/symptom_manage_view.php");

include("views/footer.php");

?>
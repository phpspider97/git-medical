<?php
    include("../root.php");
    include(SITE_ROOT_ADMIN	.	"/classes/Location.php");
    $location_obj = NEW Location();

    if(isset($_POST)){
        $country_id =   $_POST['country_id'];
        $all_state = $location_obj->getLocationData(DATABASE_TABLE_PREFIX.'state'," WHERE country_id='$country_id'");

        if(!empty($all_state)){
            foreach($all_state as $state){
                $state_id 	    = 	$state['id'];
                $state_name 	= 	$state['name'];
        ?>
            <option value='<?= $state_id; ?>' ><?= $state_name; ?></option>
        <?php 
        } } 
    }
?>
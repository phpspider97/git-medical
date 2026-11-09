<?php
    include("../root.php");
    include(SITE_ROOT_ADMIN	.	"/classes/Location.php");
    $location_obj = NEW Location();

    if(isset($_POST)){
        $state_id =   $_POST['state_id'];
        $all_city = $location_obj->getLocationData(DATABASE_TABLE_PREFIX.'city'," WHERE state_id='$state_id'");

        if(!empty($all_city)){
            foreach($all_city as $city){
                $city_id 	= 	$city['id'];
                $city_name 	= 	$city['name'];
        ?>
            <option value='<?= $city_id; ?>' ><?= $city_name; ?></option>
        <?php 
        } } 
    }
?>
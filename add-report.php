<?php
    include("root.php"); 
    
    include(SITE_ROOT	.	"/includes/top.php");
    include(SITE_ROOT	.   "/classes/Encryption.php"); 
    include(SITE_ROOT	.   "/classes/Report.php"); 
    include(SITE_ROOT_ADMIN	.	"/classes/Location.php");
 
    $encryption_obj = NEW Encryption();
    $report_obj = NEW Report();
    $location_obj = NEW Location();

    include(SITE_ROOT	.	"/includes/test_result_data.php");

    $report_id = 0; 
    $patient_id = 0;
    $report_name = ''; 
    $report_description = ''; 
    $meta_title = '';  
    $meta_description = ''; 
    $permalink = ''; 
    $is_active = 1;
    $image_path = ''; 
    $button_text = 'Add';
    $patient_name       =   ''; 
    $patient_mobile     =   ''; 
    $patient_email      =   '';
    $patient_dob        =   date('Y-m-d'); 
    $patient_address    =   ''; 
    $patient_note       =   '';
    $patient_country    =   101;
    $patient_state      =   '';
    $patient_city       =   ''; 
    $patient_age        =   ''; 
    $patient_sex        =   ''; 
    $ref_dr             =   ''; 

    $added_date = date('Y-m-d'); 
    $all_country = $location_obj->getLocationData(DATABASE_TABLE_PREFIX.'country','');
	$all_state = $location_obj->getLocationData(DATABASE_TABLE_PREFIX.'state',' WHERE country_id=101');
	$all_city = $location_obj->getLocationData(DATABASE_TABLE_PREFIX.'city',' WHERE state_id=4015');
 
    $get_heamatology_report_data =  [];
    $get_serology_report_data    =   [];
    $get_biochemistry_report_data    =   [];
    $get_renalfunctiontest_report_data    =   [];
    $get_lipidprofile_report_data    =   [];
    $get_liverfunctiontest_report_data    =   [];
    $get_widaltest_report_data    =   [];
    $get_electrolyte_report_data    =    [];
    $get_gtt_report_data    =    [];
    $get_urine_report_data    =    [];
    $get_stool_report_data    =   [];
    $get_semen_report_data    =   [];
    $get_thyroid_report_data    =  [];
         
    if(isset($_GET['patient_data'])){ 
        $patient_id  = $encryption_obj->decode($_GET['patient_data']); 
        $button_text = 'Update';
        $page_data = $report_obj->getPatientData($_SESSION['admin_id'],$patient_id);
       // pr($page_data);
        if(!empty($page_data)){ 
            $patient_name       =   $page_data['patient_name'];
            $patient_mobile     =   $page_data['patient_mobile'];
            $patient_email      =   $page_data['patient_email'];
            $patient_dob        =   $page_data['patient_dob'];
            $patient_country    =   $page_data['patient_country'];
            $patient_state      =   $page_data['patient_state'];
            $patient_city       =   $page_data['patient_city'];
            $patient_address    =   $page_data['patient_address'];
            $patient_note       =   $page_data['patient_note']; 
            $patient_age        =   $page_data['patient_age'];
            $patient_sex        =   $page_data['patient_sex'];
            $ref_dr             =   $page_data['ref_dr'];
            $added_date         =   $page_data['added_date'];
            $a_get_report_data  =   $page_data['get_report_data'];

            if(empty($patient_country)){
                $patient_country = 101;
            }
            $all_state = $location_obj->getLocationData(DATABASE_TABLE_PREFIX.'state'," WHERE country_id=$patient_country");
			  
            $get_heamatology_report_data        =       @$a_get_report_data[1];
            $get_serology_report_data           =       @$a_get_report_data[2];
            $get_biochemistry_report_data       =       @$a_get_report_data[3];
            $get_renalfunctiontest_report_data  =       @$a_get_report_data[4];
            $get_lipidprofile_report_data       =       @$a_get_report_data[5];
            $get_liverfunctiontest_report_data  =       @$a_get_report_data[6];
            $get_widaltest_report_data          =       @$a_get_report_data[7];
            $get_electrolyte_report_data        =       @$a_get_report_data[8];
            $get_gtt_report_data                =       @$a_get_report_data[9];
            $get_urine_report_data              =       @$a_get_report_data[10];
            $get_stool_report_data              =       @$a_get_report_data[11];
            $get_semen_report_data              =       @$a_get_report_data[12];
            $get_thyroid_report_data            =       @$a_get_report_data[13];
           
        }
    }
    //echo "<pre>"; print_r($get_Heamatology_report_data); die;
    if(isset($_POST['add_edit_test'])){ 
        unset($_POST['add_edit_test']);
        //echo "<pre>"; print_r($_POST); die;
        $encrypted_member_id = $encryption_obj->encode($_SESSION['admin_id']);
        $is_updated = $report_obj->addUpdateReport($_POST,'company_report',$_FILES,$encrypted_member_id);
        if(!empty($is_updated)){
            $_SESSION['notify_message'] = "Report $is_updated successful.";
            $_SESSION['notify_type'] = "success";
            ob_clean();				
            header("Location: ".SITE_URL."/manage-report.php");
            exit();
        }else{
            $_SESSION['notify_message'] = "Some server error.";
            $_SESSION['notify_type'] = "danger";
            ob_clean();				
            header("Location: ".SITE_URL."/add-report.php");
            exit();
        }
    }
    if(isset($_SESSION['notify_message'])){
        $notify_message = $_SESSION['notify_message'];
        $notify_type = $_SESSION['notify_type'];
        include("notify_me.php");
        unset($_SESSION['notify_message']);
        unset($_SESSION['notify_type']);
    }
?>
<style>
    div.scrollmenu { 
        overflow: auto;
        white-space: nowrap; 
    }
    .scrollmenu::-webkit-scrollbar {
        display: none;
    }
</style>
<script>
  $( document ).ready(function() {
    $("input").change(function(e) {
        var file = e.originalEvent.srcElement.files[0];
        const image_name =  file.name;   
        $('#image_name').text(image_name);
    });
  });
    function changeState(country_id){ 
        $('#submit-spin').show();
        let send_data	=	{
            country_id : country_id
        }
        $.ajax({
            type:'POST',
            url:'ajax/change-state.php',
            data:send_data,
            success:function(response){  
                $('.state_data').html(response)
                $('#submit-spin').hide();
            }
        });
    }
    function changeCity(state_id){ 
        $('#submit-spin').show();
        let send_data	=	{
            state_id : state_id
        }
        $.ajax({
            type:'POST',
            url:'ajax/change-city.php',
            data:send_data,
            success:function(response){  
                $('.city_data').html(response)
                $('#submit-spin').hide();
            }
        });
    } 
    function getAge(date_value){
        console.log(date_value)
        var dob = new Date(date_value);   
        var month_diff = Date.now() - dob.getTime();   
        var age_dt = new Date(month_diff);   
        var year = age_dt.getUTCFullYear();   
        var age = Math.abs(year - 1970); 
        $('#patient_age').val(age)
    }
</script>
<div class="content-wrapper"> 
    <div class="container-fluid">
    <div class="edit-profile">
        <div class="row">
            <?php if(isset($_SESSION['notify_message'])){ ?>
                <div class="notification-div alert alert-success p-2 mt-4">
                    <?= $_SESSION['notify_message']; ?>
                </div>
            <?php unset($_SESSION['notify_message']); }?>
            <div class="col-xl-12">
                <form class="card" method="POST" action="" enctype="multipart/form-data" id="field_form">
                    <div class="card-header">
                        <div class="card-title mb-0">ADD REPORT
                            <lable class="pull-right" style="font-size:10px;"><b>(*) mendatory fields</b></lable>
                        </div> 
                    </div>

                    <div class="card-body add-post">
                        <div class="row"> 
                            <div class="col-md-4 mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Created Date*</label>
                                <input class="form-control" id="exampleInputEmail1" name="added_date" type="date" aria-describedby="emailHelp" value="<?= $added_date; ?>" required/>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Patient name*</label>
                                <input class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" placeholder="Patient Name" name="patient_name"  value="<?= $patient_name; ?>" required/>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Patient E-mail</label>
                                <input class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" placeholder="Email Address" name="patient_email" value="<?= $patient_email; ?>"/>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Patient Mobile* </label>
                                <input class="form-control" id="exampleInputEmail1" type="number" aria-describedby="emailHelp" placeholder="Mobile Number" name="patient_mobile" value="<?= $patient_mobile; ?>" required/>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Patient DOB</label>
                                <input class="form-control" id="exampleInputEmail1" type="date" aria-describedby="emailHelp" placeholder="Lab number" name="patient_dob" value="<?= $patient_dob; ?>" onChange="getAge(this.value)"/>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Patient Age*</label>
                                <input class="form-control" id="patient_age" type="number" aria-describedby="emailHelp" placeholder="35" name="patient_age" value="<?= $patient_age; ?>" required/>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Patient Sex*</label>
                                <select class="form-control" name="patient_sex" required>
                                    <option value=''>Select</option> 
                                    <option value='male' <?= ($patient_sex=="male")?'selected':''; ?> >Male</option> 
                                    <option value='female' <?= ($patient_sex=="female")?'selected':''; ?> >Female</option> 
                                    <option value='other' <?= ($patient_sex=="other")?'selected':''; ?> >Other</option> 
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Ref Doctor*</label>
                                <input class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" placeholder="Self / Doctor Name" name="ref_dr" value="<?= $ref_dr; ?>" required/>
                            </div>  
                            <div class="col-md-4 mb-3">
                                &nbsp;
                            </div> 
                            <div class="col-md-12 mb-3"> 
                                <hr />
                            </div> 
                            <div class="col-md-4 mb-3">  
                                <label class="c col-form-label pt-0">PATIENT Country</label> 
                                <select class="form-control patient_country" name="patient_country" onChange="changeState(this.value)">
                                    <option value=''>Select</option>
                                    <?php if(!empty($all_country)){
                                        foreach($all_country as $country){
                                            $country_id 	= 	$country['id'];
                                            $country_name 	= 	$country['name'];
                                    ?>
                                        <option value='<?= $country_id; ?>' <?= ($country_id==$patient_country)?'selected':''; ?> ><?= $country_name; ?></option>
                                    <?php } } ?> 
                                </select>
                            </div>  
                            <div class="col-md-4 mb-3">
                                <label class="col-form-label pt-0">PATIENT State</label> 
                                <select class="form-control state_data patient_state" name="patient_state" onChange="changeCity(this.value)">
                                    <option value='0'>Select</option> 
                                    <?php
                                    if(!empty($all_state)){
                                        foreach($all_state as $state){
                                            $state_id 	    = 	$state['id'];
                                            $state_name 	= 	$state['name'];
                                    ?>
                                        <option value='<?= $state_id; ?>' <?= ($state_id==$patient_state)?'selected':''; ?>>
                                            <?= $state_name; ?>
                                        </option>
                                    <?php  } }  ?>
                                </select> 
                            </div>  
                            <div class="col-md-4 mb-3">
                                <label class="col-form-label pt-0">PATIENT City</label> 
                                <input class="form-control" type="text" name="patient_city" value="<?= $patient_city; ?>" placeholder="City Name">  
                            </div>   
 
                            <div class="col-md-12 mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Patient Address</label>
                                <textarea class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" placeholder="Patient Address" name="patient_address"><?= $patient_address; ?></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="col-form-label pt-0" for="exampleInputEmail1">Patient Note</label>
                                <textarea class="form-control" id="exampleInputEmail1" type="text" aria-describedby="emailHelp" placeholder="Patient Note ( Any type of instruction given to patient )" name="patient_note"><?= $patient_note; ?></textarea>
                            </div>
                            <div class="col-sm-12 col-lg-12">
                                <hr class="text-white mt-2" style="border-top:1px dotted yellow;"/>
                            </div>
                            <div class="col-sm-12 col-lg-12 default-according" id="accordionclose">
                                <div class="scrollmenu"> 
                                    <?php 
                                        foreach($a_report_type as $report_type_key=>$report_type_value){
                                    ?> 
                                        <button type="button" class="btn btn-pill btn-outline-warning btn-air-warning btn-sm text-uppercase" data-toggle="collapse" data-target="#collapse<?= $report_type_key; ?>" aria-expanded="true" aria-controls="heading<?= $report_type_key; ?>" style="border-radius:20px;color:white !important;border-color:white;"><?= $report_type_key; ?>. <?= $report_type_value; ?><span></span></button> 
                                    <?php } ?> 
                                </div>
                                  
                                <div class="default-according" id="accordionclose">
                                    <div class="collapse show" id="collapse1" aria-labelledby="heading1" data-parent="#accordionclose">
                                        <div class="row mt-3">
                                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered checkbox-td-width">
                                                        <thead>
                                                        <tr>
                                                            <td>INVESTIGATION</td>
                                                            <td>RESULT</td>
                                                            <td>NORMAL&nbsp;VALUE</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                        //print_r($get_heamatology_report_data); die;
                                                            foreach($a_report_data['heamatology'] as $heamatology_key=>$heamatology_value){
                                                                $a_heamatology_value = explode(',',$heamatology_value);
                                                                $investigation = $a_heamatology_value[0];
                                                                $a_result = $a_heamatology_value[1];
                                                                $result = explode('_',$a_result)[0];
                                                                $result_unit = explode('_',$a_result)[1];
                                                                $normal_value = $a_heamatology_value[2];

                                                                $heamatology_value = @$get_heamatology_report_data[$heamatology_key];

                                                                if(empty($heamatology_value)){
                                                                    $add_status = 'insert';
                                                                }else{
                                                                    $add_status = 'update';
                                                                }
                                                        ?>
                                                        <tr>
                                                            <td><?= $investigation; ?></td>
                                                            <td>
                                                            <?php if(strtoupper($result)=="TRUE"){ ?>
                                                                <div class="input-group">
                                                                <input class="form-control input-primary" type="text" name="heamatology[<?= $heamatology_key;?>|<?= $add_status;?>]" placeholder="Result Data" value="<?= $heamatology_value; ?>" style="width:200px;">
                                                                <span class="input-group-text bg-warning-custom" style="font-size:13px;width:100px">
                                                                    <?= $result_unit;?>
                                                                </span>
                                                                </div>
                                                            <?php }else{ ?>
                                                                -
                                                            <?php } ?>
                                                            </td>
                                                            <td><span style="font-size:13px;"><?= $normal_value; ?></span></td>
                                                        </tr> 
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                                <div class="default-according" id="accordionclose">
                                    <div class="collapse" id="collapse2" aria-labelledby="heading2" data-parent="#accordionclose">
                                        <div class="row mt-3">
                                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered checkbox-td-width">
                                                        <thead> 
                                                        </thead>
                                                        <tbody>
                                                        <?php  
                                                        $radio_count = 0; 
                                                            foreach($a_report_data['serology'] as $serology_key=>$serology_value){ 
                                                                $radio_count++;
                                                                $a_serology_value = explode(',',$serology_value);
                                                                $serology_field_key = $a_serology_value[0]; 
                                                                $serology_field_result_one = explode('/',$a_serology_value[1])[0]; 
                                                                $serology_field_result_two = explode('/',$a_serology_value[1])[1];
                                                                $serology_field_result_three = explode('/',$a_serology_value[1])[2];
                                                                  
                                                                $a_serology_value = @$get_serology_report_data[$serology_key];
                                                               // print_r($a_serology_value);  
                                                                $serology_data_value = @explode('/',$a_serology_value)[0];
                                                                $serology_value = @explode('/',$a_serology_value)[1]; 
                                                                if(empty($serology_value)){
                                                                    $add_status = 'insert';
                                                                }else{
                                                                    $add_status = 'update';
                                                                }
                                                        ?>
                                                        <tr>
                                                            <td class="w-25"><?= $serology_field_key; ?></td>
                                                            <td class="w-25">
                                                                <input class="form-control input-primary w-100" type="text" name="serology_value[<?= $serology_key;?>|<?= $add_status;?>]" placeholder="Result Data" value="<?= $serology_data_value; ?>" style="width:200px;">
                                                            </td>
                                                            <td class="w-50"> 
                                                                <select class="form-control form-control-primary-fill btn-square" name="serology[<?= $serology_key;?>|<?= $add_status;?>]">
                                                                    <option value="0" >Select <?= $serology_value;?></option>
                                                                    <option value="<?= $serology_field_result_one;?>" <?= ($serology_value == $serology_field_result_one)?'selected':'';?>><?= $serology_field_result_one;?></option>
                                                                    <option value="<?= $serology_field_result_two;?>" <?= ($serology_value == $serology_field_result_two)?'selected':'';?>><?= $serology_field_result_two;?></option>
                                                                    <option value="<?= $serology_field_result_three;?>" <?= ($serology_value == $serology_field_result_three)?'selected':'';?>><?= $serology_field_result_three;?></option>
                                                                </select>
                                                            </td> 
                                                        </tr> 
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                                <div class="default-according" id="accordionclose">
                                    <div class="collapse" id="collapse3" aria-labelledby="heading3" data-parent="#accordionclose">
                                        <div class="row mt-3">
                                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered checkbox-td-width">
                                                        <thead>
                                                        <tr>
                                                            <td>INVESTIGATION</td>
                                                            <td>RESULT</td>
                                                            <td>NORMAL&nbsp;VALUE</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                            foreach($a_report_data['biochemistry'] as $biochemistry_key=>$biochemistry_value){
                                                                $a_biochemistry_value = explode(',',$biochemistry_value);
                                                                $investigation = $a_biochemistry_value[0];
                                                                $a_result = $a_biochemistry_value[1];
                                                                $result = explode('_',$a_result)[0];
                                                                $result_unit = explode('_',$a_result)[1];
                                                                $normal_value = $a_biochemistry_value[2];

                                                                $biochemistry_value = @$get_biochemistry_report_data[$biochemistry_key];

                                                                if(empty($biochemistry_value)){
                                                                    $add_status = 'insert';
                                                                }else{
                                                                    $add_status = 'update';
                                                                }
                                                        ?>
                                                        <tr>
                                                            <td><?= $investigation; ?></td>
                                                            <td class="w-50">
                                                            <?php if(strtoupper($result)=="TRUE"){ ?>
                                                                <div class="input-group">
                                                                <input style="width:200px;" class="form-control input-primary" type="text" name="biochemistry[<?= $biochemistry_key;?>|<?= $add_status;?>]" placeholder="Result Data" value="<?= $biochemistry_value; ?>">
                                                                <span class="input-group-text bg-warning-custom" style="font-size:13px;width:100px">
                                                                    <?= $result_unit;?>
                                                                </span>
                                                                </div>
                                                            <?php }else{ ?>
                                                                -
                                                            <?php } ?>
                                                            </td>
                                                            <td><span style="font-size:13px;"><?= $normal_value; ?></span></td>
                                                        </tr> 
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                                <div class="default-according" id="accordionclose">
                                    <div class="collapse" id="collapse4" aria-labelledby="heading4" data-parent="#accordionclose">
                                        <div class="row mt-3">
                                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered checkbox-td-width">
                                                        <thead>
                                                        <tr>
                                                            <td>INVESTIGATION</td>
                                                            <td>RESULT</td>
                                                            <td>NORMAL&nbsp;VALUE</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                            foreach($a_report_data['renalfunctiontest'] as $renalfunctiontest_key=>$renalfunctiontest_value){
                                                                $a_renalfunctiontest_value = explode(',',$renalfunctiontest_value);
                                                                $investigation = $a_renalfunctiontest_value[0];
                                                                $a_result = $a_renalfunctiontest_value[1];
                                                                $result = explode('_',$a_result)[0];
                                                                $result_unit = explode('_',$a_result)[1];
                                                                $normal_value = $a_renalfunctiontest_value[2];

                                                                $renalfunctiontest_value = @$get_renalfunctiontest_report_data[$renalfunctiontest_key];

                                                                if(empty($renalfunctiontest_value)){
                                                                    $add_status = 'insert';
                                                                }else{
                                                                    $add_status = 'update';
                                                                }
                                                        ?>
                                                        <tr>
                                                            <td><?= $investigation; ?></td>
                                                            <td class="w-50">
                                                            <?php if(strtoupper($result)=="TRUE"){ ?>
                                                                <div class="input-group">
                                                                <input style="width:200px;" class="form-control input-primary" type="text" name="renalfunctiontest[<?= $renalfunctiontest_key;?>|<?= $add_status;?>]" placeholder="Result Data" value="<?= $renalfunctiontest_value; ?>">
                                                                <span class="input-group-text bg-warning-custom" style="font-size:13px;width:100px">
                                                                    <?= $result_unit;?>
                                                                </span>
                                                                </div>
                                                            <?php }else{ ?>
                                                                -
                                                            <?php } ?>
                                                            </td>
                                                            <td><span style="font-size:13px;"><?= $normal_value; ?></span></td>
                                                        </tr> 
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                                <div class="default-according" id="accordionclose">
                                    <div class="collapse" id="collapse5" aria-labelledby="heading5" data-parent="#accordionclose">
                                        <div class="row mt-3">
                                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered checkbox-td-width">
                                                        <thead>
                                                        <tr>
                                                            <td>INVESTIGATION</td>
                                                            <td>RESULT</td>
                                                            <td>NORMAL VALUE</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                            foreach($a_report_data['lipidprofile'] as $lipidprofile_key=>$lipidprofile_value){
                                                                $a_lipidprofile_value = explode(',',$lipidprofile_value);
                                                                $investigation = $a_lipidprofile_value[0];
                                                                $a_result = $a_lipidprofile_value[1];
                                                                $result = explode('_',$a_result)[0];
                                                                $result_unit = explode('_',$a_result)[1];
                                                                $normal_value = $a_lipidprofile_value[2];

                                                                $lipidprofile_value = @$get_lipidprofile_report_data[$lipidprofile_key];

                                                                if(empty($lipidprofile_value)){
                                                                    $add_status = 'insert';
                                                                }else{
                                                                    $add_status = 'update';
                                                                }
                                                        ?>
                                                        <tr>
                                                            <td><?= $investigation; ?></td>
                                                            <td class="w-50">
                                                            <?php if(strtoupper($result)=="TRUE"){ ?>
                                                                <div class="input-group">
                                                                <input style="width:200px;" class="form-control input-primary" type="text" name="lipidprofile[<?= $lipidprofile_key;?>|<?= $add_status;?>]" placeholder="Result Data" value="<?= $lipidprofile_value; ?>">
                                                                <span class="input-group-text bg-warning-custom" style="font-size:13px;width:100px">
                                                                    <?= $result_unit;?>
                                                                </span>
                                                                </div>
                                                            <?php }else{ ?>
                                                                -
                                                            <?php } ?>
                                                            </td>
                                                            <td><span style="font-size:13px;"><?= $normal_value; ?></span></td>
                                                        </tr> 
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                                <div class="default-according" id="accordionclose">
                                    <div class="collapse" id="collapse6" aria-labelledby="heading6" data-parent="#accordionclose">
                                        <div class="row mt-3">
                                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered checkbox-td-width">
                                                        <thead>
                                                        <tr>
                                                            <td>INVESTIGATION</td>
                                                            <td>RESULT</td>
                                                            <td>NORMAL&nbsp;VALUE</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                            foreach($a_report_data['liverfunctiontest'] as $liverfunctiontest_key=>$liverfunctiontest_value){
                                                                $a_liverfunctiontest_value = explode(',',$liverfunctiontest_value);
                                                                $investigation = $a_liverfunctiontest_value[0];
                                                                $a_result = $a_liverfunctiontest_value[1];
                                                                $result = explode('_',$a_result)[0];
                                                                $result_unit = explode('_',$a_result)[1];
                                                                $normal_value = $a_liverfunctiontest_value[2];

                                                                $liverfunctiontest_value = @$get_liverfunctiontest_report_data[$liverfunctiontest_key];

                                                                if(empty($liverfunctiontest_value)){
                                                                    $add_status = 'insert';
                                                                }else{
                                                                    $add_status = 'update';
                                                                }
                                                        ?>
                                                        <tr>
                                                            <td><?= $investigation; ?></td>
                                                            <td class="w-50">
                                                            <?php if(strtoupper($result)=="TRUE"){ ?>
                                                                <div class="input-group">
                                                                <input style="width:200px;" class="form-control input-primary" type="text" name="liverfunctiontest[<?= $liverfunctiontest_key;?>|<?= $add_status;?>]" placeholder="Result Data" value="<?= $liverfunctiontest_value; ?>">
                                                                <span class="input-group-text bg-warning-custom" style="font-size:13px;width:100px">
                                                                    <?= $result_unit;?>
                                                                </span>
                                                                </div>
                                                            <?php }else{ ?>
                                                                -
                                                            <?php } ?>
                                                            </td>
                                                            <td><span style="font-size:13px;"><?= $normal_value; ?></span></td>
                                                        </tr> 
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                                <div class="default-according" id="accordionclose">
                                    <div class="collapse" id="collapse7" aria-labelledby="heading7" data-parent="#accordionclose">
                                        <div class="row mt-3">
                                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered checkbox-td-width">
                                                        <thead>
                                                        <tr>
                                                            <td style="width:20%">&nbsp;&nbsp;-&nbsp;&nbsp;</td>
                                                            <td style="width:16%">1:20</td>
                                                            <td style="width:16%">1:40</td>
                                                            <td style="width:16%">1:80</td>
                                                            <td style="width:16%">1:160</td>
                                                            <td style="width:16%">1:320</td> 
                                                            <td style="width:16%">1:640</td> 
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                        //echo "<pre>"; print_r($get_widaltest_report_data); die;
                                                            foreach($a_report_data['widaltest'] as $widaltest_key=>$widaltest_value){
                                                                $a_widaltest_value = explode(',',$widaltest_value);
                                                                $investigation = $a_widaltest_value[0];
                                                                $a_result = $a_widaltest_value[1];
                                                                $result = explode('_',$a_result)[0];
                                                                $result_unit = explode('_',$a_result)[1];
                                                                $normal_value = $a_widaltest_value[2];

                                                                $widaltest_value = @$get_widaltest_report_data[$widaltest_key];

                                                                $widaltest_value_one = '';
                                                                $widaltest_value_two = '';
                                                                $widaltest_value_three = '';
                                                                $widaltest_value_four = '';
                                                                $widaltest_value_five = '';
                                                                $widaltest_value_six = '';
                                                                
                                                                if($widaltest_value == ',,,,' || $widaltest_value==''){
                                                                    $add_status = 'insert';
                                                                }else{
                                                                    $add_status = 'update';

                                                                    $widaltest_value_one = explode(',',$widaltest_value)[0];
                                                                    $widaltest_value_two = explode(',',$widaltest_value)[1];
                                                                    $widaltest_value_three = explode(',',$widaltest_value)[2];
                                                                    $widaltest_value_four = explode(',',$widaltest_value)[3];
                                                                    $widaltest_value_five = explode(',',$widaltest_value)[4];
                                                                    $widaltest_value_six = explode(',',$widaltest_value)[5];
                                                                }
                                                        ?>
                                                        <tr>
                                                            <td><?= $investigation; ?></td>
                                             
                                                            <td>  
                                                                    <input style="width:150px;" class="form-control input-primary" type="text" name="widaltest[<?= $widaltest_key;?>][1|<?= $add_status;?>]" placeholder="Result Data" value="<?= $widaltest_value_one; ?>"> 
                                                            </td> 
                                                            <td>  
                                                                    <input style="width:150px;" class="form-control input-primary" type="text" name="widaltest[<?= $widaltest_key;?>][2|<?= $add_status;?>]" placeholder="Result Data" value="<?= $widaltest_value_two; ?>"> 
                                                            </td> 
                                                            <td>  
                                                                    <input style="width:150px;" class="form-control input-primary" type="text" name="widaltest[<?= $widaltest_key;?>][3|<?= $add_status;?>]" placeholder="Result Data" value="<?= $widaltest_value_three; ?>"> 
                                                            </td> 
                                                            <td>  
                                                                    <input style="width:150px;" class="form-control input-primary" type="text" name="widaltest[<?= $widaltest_key;?>][4|<?= $add_status;?>]" placeholder="Result Data" value="<?= $widaltest_value_four; ?>"> 
                                                            </td> 
                                                            <td class="w-50">  
                                                                    <input style="width:150px;" class="form-control input-primary" type="text" name="widaltest[<?= $widaltest_key;?>][5|<?= $add_status;?>]" placeholder="Result Data" value="<?= $widaltest_value_five; ?>"> 
                                                            </td> 
                                                             <td>  
                                                                    <input style="width:150px;" class="form-control input-primary" type="text" name="widaltest[<?= $widaltest_key;?>][6|<?= $add_status;?>]" placeholder="Result Data" value="<?= $widaltest_value_six; ?>"> 
                                                            </td>
                                                        </tr> 
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                                <div class="default-according" id="accordionclose">
                                    <div class="collapse" id="collapse8" aria-labelledby="heading6" data-parent="#accordionclose">
                                        <div class="row mt-3">
                                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered checkbox-td-width">
                                                        <thead>
                                                        <tr>
                                                            <td>INVESTIGATION</td>
                                                            <td>RESULT</td>
                                                            <td>NORMAL&nbsp;VALUE</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                            foreach($a_report_data['electrolyte'] as $electrolyte_key=>$electrolyte_value){
                                                                $a_electrolyte_value = explode(',',$electrolyte_value);
                                                                $investigation = $a_electrolyte_value[0];
                                                                $a_result = $a_electrolyte_value[1];
                                                                $result = explode('_',$a_result)[0];
                                                                $result_unit = explode('_',$a_result)[1];
                                                                $normal_value = $a_electrolyte_value[2];
                                
                                                                $electrolyte_value = @$get_electrolyte_report_data[$electrolyte_key];
                                
                                                                if(empty($electrolyte_value)){
                                                                    $add_status = 'insert';
                                                                }else{
                                                                    $add_status = 'update';
                                                                }
                                                        ?>
                                                        <tr>
                                                            <td><?= $investigation; ?></td>
                                                            <td class="w-50">
                                                            <?php if(strtoupper($result)=="TRUE"){ ?>
                                                                <div class="input-group">
                                                                <input style="width:200px;" class="form-control input-primary" type="text" name="electrolyte[<?= $electrolyte_key;?>|<?= $add_status;?>]" placeholder="Result Data" value="<?= $electrolyte_value; ?>">
                                                                <span class="input-group-text bg-warning-custom" style="font-size:13px;width:100px">
                                                                    <?= $result_unit;?>
                                                                </span>
                                                                </div>
                                                            <?php }else{ ?>
                                                                -
                                                            <?php } ?>
                                                            </td>
                                                            <td><span style="font-size:13px;"><?= $normal_value; ?></span></td>
                                                        </tr> 
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                </div>    
                                <div class="default-according" id="accordionclose">
                                    <div class="collapse" id="collapse9" aria-labelledby="heading6" data-parent="#accordionclose">
                                        <div class="row mt-3">
                                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered checkbox-td-width">
                                                        <thead>
                                                        <tr>
                                                            <td>INVESTIGATION</td>
                                                            <td>RESULT</td>
                                                            <td>NORMAL&nbsp;VALUE</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                       //echo "<pre>"; print_r($a_report_data['gtt']);
                                                            foreach($a_report_data['gtt'] as $gtt_key=>$gtt_value){
                                                                $a_gtt_value = explode(',',$gtt_value);
                                                                $investigation = $a_gtt_value[0];
                                                                $a_result = $a_gtt_value[1];
                                                                $result = explode('_',$a_result)[0];
                                                                $result_unit = explode('_',$a_result)[1];
                                                                $normal_value = $a_gtt_value[2];
                                
                                                                $gtt_value = @$get_gtt_report_data[$gtt_key];
                                
                                                                if(empty($gtt_value)){
                                                                    $add_status = 'insert';
                                                                }else{
                                                                    $add_status = 'update';
                                                                }
                                                        ?>
                                                        <tr>
                                                            <td><?= $investigation; ?></td>
                                                            <td class="w-50">
                                                            <?php if(strtoupper($result)=="TRUE"){ ?>
                                                                <div class="input-group">
                                                                <input style="width:200px;" class="form-control input-primary" type="text" name="gtt[<?= $gtt_key;?>|<?= $add_status;?>]" placeholder="Result Data" value="<?= $gtt_value; ?>">
                                                                <span class="input-group-text bg-warning-custom" style="font-size:13px;width:100px">
                                                                    <?= $result_unit;?>
                                                                </span>
                                                                </div>
                                                            <?php }else{ ?>
                                                                -
                                                            <?php } ?>
                                                            </td>
                                                            <td><span style="font-size:13px;"><?= $normal_value; ?></span></td>
                                                        </tr> 
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                                <div class="default-according" id="accordionclose">
                                    <div class="collapse" id="collapse10" aria-labelledby="heading6" data-parent="#accordionclose">
                                        <div class="row mt-3">
                                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered checkbox-td-width">
                                                        <thead>
                                                        <tr>
                                                            <td>INVESTIGATION</td>
                                                            <td>RESULT</td>
                                                            <td>NORMAL&nbsp;VALUE</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                            foreach($a_report_data['urine'] as $urine_key=>$urine_value){
                                                                $a_urine_value = explode(',',$urine_value);
                                                                $investigation = $a_urine_value[0];
                                                                $a_result = $a_urine_value[1];
                                                                $result = explode('_',$a_result)[0];
                                                                $result_unit = explode('_',$a_result)[1];
                                                                $normal_value = $a_urine_value[2];
                                
                                                                $urine_value = @$get_urine_report_data[$urine_key];
                                
                                                                if(empty($urine_value)){
                                                                    $add_status = 'insert';
                                                                }else{
                                                                    $add_status = 'update';
                                                                }
                                                        ?>
                                                        <tr>
                                                            <td><?= $investigation; ?></td>
                                                            <td class="w-50">
                                                            <?php if(strtoupper($result)=="TRUE"){ ?>
                                                                <div class="input-group">
                                                                <input style="width:200px;" class="form-control input-primary" type="text" name="urine[<?= $urine_key;?>|<?= $add_status;?>]" placeholder="Result Data" value="<?= $urine_value; ?>">
                                                                <span class="input-group-text bg-warning-custom" style="font-size:13px;width:100px">
                                                                    <?= $result_unit;?>
                                                                </span>
                                                                </div>
                                                            <?php }else{ ?>
                                                                -
                                                            <?php } ?>
                                                            </td>
                                                            <td><span style="font-size:13px;"><?= $normal_value; ?></span></td>
                                                        </tr> 
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                                
                                <div class="default-according" id="accordionclose">
                                    <div class="collapse" id="collapse11" aria-labelledby="heading6" data-parent="#accordionclose">
                                        <div class="row mt-3">
                                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered checkbox-td-width">
                                                        <thead>
                                                        <tr>
                                                            <td>INVESTIGATION</td>
                                                            <td>RESULT</td>
                                                            <td>NORMAL&nbsp;VALUE</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                            foreach($a_report_data['stool'] as $stool_key=>$stool_value){
                                                                $a_stool_value = explode(',',$stool_value);
                                                                $investigation = $a_stool_value[0];
                                                                $a_result = $a_stool_value[1];
                                                                $result = explode('_',$a_result)[0];
                                                                $result_unit = explode('_',$a_result)[1];
                                                                $normal_value = $a_stool_value[2];
                                
                                                                $stool_value = @$get_stool_report_data[$stool_key];
                                
                                                                if(empty($stool_value)){
                                                                    $add_status = 'insert';
                                                                }else{
                                                                    $add_status = 'update';
                                                                }
                                                        ?>
                                                        <tr>
                                                            <td><?= $investigation; ?></td>
                                                            <td class="w-50">
                                                            <?php if(strtoupper($result)=="TRUE"){ ?>
                                                                <div class="input-group">
                                                                <input style="width:200px;" class="form-control input-primary" type="text" name="stool[<?= $stool_key;?>|<?= $add_status;?>]" placeholder="Result Data" value="<?= $stool_value; ?>">
                                                                <span class="input-group-text bg-warning-custom" style="font-size:13px;width:100px">
                                                                    <?= $result_unit;?>
                                                                </span>
                                                                </div>
                                                            <?php }else{ ?>
                                                                -
                                                            <?php } ?>
                                                            </td>
                                                            <td><span style="font-size:13px;"><?= $normal_value; ?></span></td>
                                                        </tr> 
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                                
                                <div class="default-according" id="accordionclose">
                                    <div class="collapse" id="collapse12" aria-labelledby="heading6" data-parent="#accordionclose">
                                        <div class="row mt-3">
                                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered checkbox-td-width">
                                                        <thead>
                                                        <tr>
                                                            <td>INVESTIGATION</td>
                                                            <td>RESULT</td>
                                                            <td>NORMAL&nbsp;VALUE</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                            foreach($a_report_data['semen'] as $semen_key=>$semen_value){
                                                                $a_semen_value = explode(',',$semen_value);
                                                                $investigation = $a_semen_value[0];
                                                                $a_result = $a_semen_value[1];
                                                                $result = explode('_',$a_result)[0];
                                                                $result_unit = explode('_',$a_result)[1];
                                                                $normal_value = $a_semen_value[2];
                                
                                                                $semen_value = @$get_semen_report_data[$semen_key];
                                
                                                                if(empty($semen_value)){
                                                                    $add_status = 'insert';
                                                                }else{
                                                                    $add_status = 'update';
                                                                }
                                                        ?>
                                                        <tr>
                                                            <td><?= $investigation; ?></td>
                                                            <td class="w-50">
                                                            <?php if(strtoupper($result)=="TRUE"){ ?>
                                                                <div class="input-group">
                                                                <input style="width:200px;" class="form-control input-primary" type="text" name="semen[<?= $semen_key;?>|<?= $add_status;?>]" placeholder="Result Data" value="<?= $semen_value; ?>">
                                                                <span class="input-group-text bg-warning-custom" style="font-size:13px;width:100px">
                                                                    <?= $result_unit;?>
                                                                </span>
                                                                </div>
                                                            <?php }else{ ?>
                                                                -
                                                            <?php } ?>
                                                            </td>
                                                            <td><span style="font-size:13px;"><?= $normal_value; ?></span></td>
                                                        </tr> 
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                                
                                <div class="default-according" id="accordionclose">
                                    <div class="collapse" id="collapse13" aria-labelledby="heading6" data-parent="#accordionclose">
                                        <div class="row mt-3">
                                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered checkbox-td-width">
                                                        <thead>
                                                        <tr>
                                                            <td>INVESTIGATION</td>
                                                            <td>RESULT</td>
                                                            <td>NORMAL&nbsp;VALUE</td>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php 
                                                            foreach($a_report_data['thyroid'] as $thyroid_key=>$thyroid_value){
                                                                $a_thyroid_value = explode(',',$thyroid_value);
                                                                $investigation = $a_thyroid_value[0];
                                                                $a_result = $a_thyroid_value[1];
                                                                $result = explode('_',$a_result)[0];
                                                                $result_unit = explode('_',$a_result)[1];
                                                                $normal_value = $a_thyroid_value[2];
                                
                                                                $thyroid_value = @$get_thyroid_report_data[$thyroid_key];
                                
                                                                if(empty($thyroid_value)){
                                                                    $add_status = 'insert';
                                                                }else{
                                                                    $add_status = 'update';
                                                                }
                                                        ?>
                                                        <tr>
                                                            <td><?= $investigation; ?></td>
                                                            <td class="w-50">
                                                            <?php if(strtoupper($result)=="TRUE"){ ?>
                                                                <div class="input-group">
                                                                <input style="width:200px;" class="form-control input-primary" type="text" name="thyroid[<?= $thyroid_key;?>|<?= $add_status;?>]" placeholder="Result Data" value="<?= $thyroid_value; ?>">
                                                                <span class="input-group-text bg-warning-custom" style="font-size:13px;width:100px">
                                                                    <?= $result_unit;?>
                                                                </span>
                                                                </div>
                                                            <?php }else{ ?>
                                                                -
                                                            <?php } ?>
                                                            </td>
                                                            <td><span style="font-size:13px;"><?= $normal_value; ?></span></td>
                                                        </tr> 
                                                        <?php } ?>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                </div>


                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-end">
                        <button name="add_edit_test" class="btn btn-warning w-100 bg-warning-custom" type="submit" style="border:1px solid black;font-size:16px;">
                            <?= $button_text;?> test detail
                        </button>
                        <input type="hidden" name="added_by" value="<?= $_SESSION['admin_id']; ?>">
                        <input type="hidden" name="patient_id" value="<?= $patient_id;?>">
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<style>
    .image-upload>input {
        display: none;
    }
</style>
<?php
  include(SITE_ROOT	.	"/includes/bottom.php");
?>  
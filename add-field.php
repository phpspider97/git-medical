<?php
    include("root.php"); 
    
    include(SITE_ROOT	.	"/includes/top.php"); 
    include(SITE_ROOT	.   "/classes/Encryption.php"); 
    include(SITE_ROOT	.   "/classes/Report.php"); 
 
    $encryption_obj = NEW Encryption();
    $report_obj = NEW Report();
    
    include(SITE_ROOT	.	"/includes/test_result_data.php"); 

    $report_id = 0; 
    $report_name = ''; 
    $report_description = ''; 
    $meta_title = '';  
    $meta_description = ''; 
    $permalink = ''; 
    $is_active = 1;
    $image_path = ''; 
    $button_text = 'Add';
    $read_only = '';
 
    
    $a_field_data = $report_obj->getFieldData($_SESSION['admin_id']);
    if(!empty($a_field_data)){   
        $get_heamatology_report_data        =   @$a_field_data[1];
        $get_serology_report_data           =   @$a_field_data[2];
        $get_biochemistry_report_data       =   @$a_field_data[3];
        $get_renalfunctiontest_report_data  =   @$a_field_data[4];
        $get_lipidprofile_report_data       =   @$a_field_data[5];
        $get_liverfunctiontest_report_data  =   @$a_field_data[6];
        //$get_widaltest_report_data        =   $a_get_report_data[7];
        $get_electrolyte_report_data        =   @$a_field_data[8];
        $get_gtt_report_data                =   @$a_field_data[9];
        $get_urine_report_data              =   @$a_field_data[10];
        $get_stool_report_data              =   @$a_field_data[11];
        $get_semen_report_data              =   @$a_field_data[12];
        $get_thyroid_report_data            =   @$a_field_data[13];
    }
    
    //echo "<pre>"; print_r($get_Heamatology_report_data); die;
    if(isset($_POST['add_edit_test'])){
        unset($_POST['add_edit_test']);
        //echo "<pre>"; print_r($_POST); die;
        $encrypted_member_id = $encryption_obj->encode($_SESSION['admin_id']);
        $is_updated = $report_obj->addUpdateField($_POST,'lab_field',$_FILES,$encrypted_member_id);
        if(!empty($is_updated)){
            $_SESSION['notify_message'] = "Field $is_updated successful.";
            $_SESSION['notify_type'] = "success";
            ob_clean();				
            header("Location: ".SITE_URL."/add-field.php");
            exit();
        }else{
            $_SESSION['notify_message'] = "Some server error.";
            $_SESSION['notify_type'] = "danger";
            ob_clean();				
            header("Location: ".SITE_URL."/add-field.php");
            exit();
        }
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
     let counter = -1;
    $("input").change(function(e) {
        var file = e.originalEvent.srcElement.files[0];
        const image_name =  file.name;   
        $('#image_name').text(image_name);
    });
    
    $(".go_to_top").click(function() {
      $("html, body").animate({ scrollTop: $(document).height() }, "slow");
    });

    $("a.deleteData").click(function(e) {  
        var id = $(this).attr('id');  
        var result = confirm("Are you sure you want to delete this field?");
        if(result){
          $.ajax({
              url: "ajax/delete-field.php",
              type: "POST",
              data:  { deleteData : id },
              success: function (response) { 
                  console.log(response);
                  $('#submit-spin').hide();
                  $(`#row_${id}`).css("background-color", "#f8d7da").slideUp(500);
              },
                  error: function(jqXHR, textStatus, errorThrown) {
                  console.log(textStatus, errorThrown);
              }
          }); 
        }
    });
    
    $('.add_heamatology').on('click',function(){  
        counter++
        let html = `<tr>
                        <td><input type="text" <?= $read_only; ?> name="heamatology_investigation[0|${counter}|insert]" value="" class="form-control" placeholder="Investigation value"></td>
                        <td> 
                            <div class="input-group">
                            <input class="form-control input-primary" type="text" <?= $read_only; ?> name="heamatology_result[0|${counter}|insert]" placeholder="Result Data" value="" style="width:200px;"> 
                            <input type="text" <?= $read_only; ?> name="heamatology_unit[0|${counter}|insert]" value="" class="form-control bg-warning-custom" placeholder="Unit"> 
                            </div> 
                        </td>
                        <td>
                            <input type="text" <?= $read_only; ?> name="heamatology_value[0|${counter}|insert]" value="" placeholder="Normal value" class="form-control">
                            <a onClick="$(this).closest('tr').css('background-color', '#f8d7da').slideUp(500)">
                                <img src='https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png' style="width:20px;height:20px;right:10px;position:absolute;margin-top:-25px;cursor:pointer;">
                            </a>
                        </td>
                    </tr>`;
        $('.add_heamatology_field').append(html);   
    })
    $('.add_serology').on('click',function(){ 
        counter++
        let html = `<tr>
                        <td><input type="text" <?= $read_only; ?> name="serology_result[0|${counter}|insert]" value="" class="form-control" placeholder="Serology field"></td> 
                        <td colspan="2">
                            <input type="text" <?= $read_only; ?> name="serology_value[0|${counter}|insert]" value="" placeholder="Serology select value eg Reative|Non-reactive" class="form-control">
                            <a onClick="$(this).closest('tr').css('background-color', '#f8d7da').slideUp(500)">
                                <img src='https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png' style="width:20px;height:20px;right:10px;position:absolute;margin-top:-25px;cursor:pointer;">
                            </a>
                        </td>
                    </tr>`;
        $('.add_serology_field').append(html); 
    })
    $('.add_biochemistry').on('click',function(){  
        counter++
        let html = `<tr>
                        <td><input type="text" <?= $read_only; ?> name="biochemistry_investigation[0|${counter}|insert]" value="" class="form-control" placeholder="Investigation value"></td>
                        <td> 
                            <div class="input-group">
                            <input class="form-control input-primary" type="text" <?= $read_only; ?> name="biochemistry_result[0|${counter}|insert]" placeholder="Result Data" value="" style="width:200px;">
                            
                                <input type="text" <?= $read_only; ?> name="biochemistry_unit[0|${counter}|insert]" value="" class="form-control bg-warning-custom" placeholder="Unit"> 
                            </div> 
                        </td>
                        <td>
                            <input type="text" <?= $read_only; ?> name="biochemistry_value[0|${counter}|insert]" value="" placeholder="Normal value" class="form-control">
                            <a onClick="$(this).closest('tr').css('background-color', '#f8d7da').slideUp(500)">
                                <img src='https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png' style="width:20px;height:20px;right:10px;position:absolute;margin-top:-25px;cursor:pointer;">
                            </a>
                        </td>
                    </tr>`;
        $('.add_biochemistry_field').append(html);   
    })
    $('.add_renalfunctiontest').on('click',function(){  
        counter++
        let html = `<tr>
                        <td><input type="text" <?= $read_only; ?> name="renalfunctiontest_investigation[0|${counter}|insert]" value="" class="form-control" placeholder="Investigation value"></td>
                        <td> 
                            <div class="input-group">
                            <input class="form-control input-primary" type="text" <?= $read_only; ?> name="renalfunctiontest_result[0|${counter}|insert]" placeholder="Result Data" value="" style="width:200px;">
                            
                                <input type="text" <?= $read_only; ?> name="renalfunctiontest_unit[0|${counter}|insert]" value="" class="form-control bg-warning-custom" placeholder="Unit">
                            </div> 
                        </td>
                        <td>
                            <input type="text" <?= $read_only; ?> name="renalfunctiontest_value[0|${counter}|insert]" value="" placeholder="Normal value" class="form-control">
                            <a onClick="$(this).closest('tr').css('background-color', '#f8d7da').slideUp(500)">
                                <img src='https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png' style="width:20px;height:20px;right:10px;position:absolute;margin-top:-25px;cursor:pointer;">
                            </a>
                        </td>
                    </tr>`;
        $('.add_renalfunctiontest_field').append(html);   
    })
    $('.add_lipidprofile').on('click',function(){  
        counter++
        let html = `<tr>
                        <td><input type="text" <?= $read_only; ?> name="lipidprofile_investigation[0|${counter}|insert]" value="" class="form-control" placeholder="Investigation value"></td>
                        <td> 
                            <div class="input-group">
                            <input class="form-control input-primary" type="text" <?= $read_only; ?> name="lipidprofile_result[0|${counter}|insert]" placeholder="Result Data" value="" style="width:200px;">
                            
                                <input type="text" <?= $read_only; ?> name="lipidprofile_unit[0|${counter}|insert]" value="" class="form-control bg-warning-custom" placeholder="Unit">
                            </div> 
                        </td>
                        <td>
                            <input type="text" <?= $read_only; ?> name="lipidprofile_value[0|${counter}|insert]" value="" placeholder="Normal value" class="form-control">
                            <a onClick="$(this).closest('tr').css('background-color', '#f8d7da').slideUp(500)">
                                <img src='https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png' style="width:20px;height:20px;right:10px;position:absolute;margin-top:-25px;cursor:pointer;">
                            </a>    
                        </td>
                    </tr>`;
        $('.add_lipidprofile_field').append(html);   
    })
    $('.add_liverfunctiontest').on('click',function(){  
        counter++
        let html = `<tr>
                        <td><input type="text" <?= $read_only; ?> name="liverfunctiontest_investigation[0|${counter}|insert]" value="" class="form-control" placeholder="Investigation value"></td>
                        <td> 
                            <div class="input-group">
                            <input class="form-control input-primary" type="text" <?= $read_only; ?> name="liverfunctiontest_result[0|${counter}|insert]" placeholder="Result Data" value="" style="width:200px;">
                            
                                <input type="text" <?= $read_only; ?> name="liverfunctiontest_unit[0|${counter}|insert]" value="" class="form-control bg-warning-custom" placeholder="Unit">
                            </div> 
                        </td> 
                        <td>
                            <input type="text" <?= $read_only; ?> name="liverfunctiontest_value[0|${counter}|insert]" value="" placeholder="Normal value" class="form-control">
                            <a onClick="$(this).closest('tr').css('background-color', '#f8d7da').slideUp(500)">
                                <img src='https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png' style="width:20px;height:20px;right:10px;position:absolute;margin-top:-25px;cursor:pointer;">
                            </a>
                        </td>
                    </tr>`;
        $('.add_liverfunctiontest_field').append(html);   
    })
    $('.add_electrolyte').on('click',function(){  
        counter++
        let html = `<tr>
                        <td><input type="text" <?= $read_only; ?> name="electrolyte_investigation[0|${counter}|insert]" value="" class="form-control" placeholder="Investigation value"></td>
                        <td> 
                            <div class="input-group">
                            <input class="form-control input-primary" type="text" <?= $read_only; ?> name="electrolyte_result[0|${counter}|insert]" placeholder="Result Data" value="" style="width:200px;">
                            
                                <input type="text" <?= $read_only; ?> name="electrolyte_unit[0|${counter}|insert]" value="" class="form-control bg-warning-custom" placeholder="Unit">
                            </div> 
                        </td>
                        <td>
                            <input type="text" <?= $read_only; ?> name="electrolyte_value[0|${counter}|insert]" value="" placeholder="Normal value" class="form-control">
                            <a onClick="$(this).closest('tr').css('background-color', '#f8d7da').slideUp(500)">
                                <img src='https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png' style="width:20px;height:20px;right:10px;position:absolute;margin-top:-25px;cursor:pointer;">
                            </a>
                        </td>
                    </tr>`;
        $('.add_electrolyte_field').append(html);   
    })
    $('.add_gtt').on('click',function(){  
        counter++
        let html = `<tr>
                        <td><input type="text" <?= $read_only; ?> name="gtt_investigation[0|${counter}|insert]" value="" class="form-control" placeholder="Investigation value"></td>
                        <td> 
                            <div class="input-group">
                            <input class="form-control input-primary" type="text" <?= $read_only; ?> name="gtt_result[0|${counter}|insert]" placeholder="Result Data" value="" style="width:200px;">
                            
                                <input type="text" <?= $read_only; ?> name="gtt_unit[0|${counter}|insert]" value="" class="form-control bg-warning-custom" placeholder="Unit">
                            </div> 
                        </td>
                        <td>
                            <input type="text" <?= $read_only; ?> name="gtt_value[0|${counter}|insert]" value="" placeholder="Normal value" class="form-control">
                            <a onClick="$(this).closest('tr').css('background-color', '#f8d7da').slideUp(500)">
                                <img src='https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png' style="width:20px;height:20px;right:10px;position:absolute;margin-top:-25px;cursor:pointer;">
                            </a>
                        </td>
                    </tr>`;
        $('.add_gtt_field').append(html);   
    })
    $('.add_urine').on('click',function(){  
        counter++
        let html = `<tr>
                        <td><input type="text" <?= $read_only; ?> name="urine_investigation[0|${counter}|insert]" value="" class="form-control" placeholder="Investigation value"></td>
                        <td> 
                            <div class="input-group">
                            <input class="form-control input-primary" type="text" <?= $read_only; ?> name="urine_result[0|${counter}|insert]" placeholder="Result Data" value="" style="width:200px;">
                            
                                <input type="text" <?= $read_only; ?> name="urine_unit[0|${counter}|insert]" value="" class="form-control bg-warning-custom" placeholder="Unit">
                            </div> 
                        </td>
                        <td>
                            <input type="text" <?= $read_only; ?> name="urine_value[0|${counter}|insert]" value="" placeholder="Normal value" class="form-control">
                            <a onClick="$(this).closest('tr').css('background-color', '#f8d7da').slideUp(500)">
                                <img src='https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png' style="width:20px;height:20px;right:10px;position:absolute;margin-top:-25px;cursor:pointer;margin-top:-25px;">
                            </a>
                        </td>
                    </tr>`;
        $('.add_urine_field').append(html);   
    })
    
    $('.add_stool').on('click',function(){  
        counter++
        let html = `<tr>
                        <td><input type="text" <?= $read_only; ?> name="stool_investigation[0|${counter}|insert]" value="" class="form-control" placeholder="Investigation value"></td>
                        <td> 
                            <div class="input-group">
                            <input class="form-control input-primary" type="text" <?= $read_only; ?> name="stool_result[0|${counter}|insert]" placeholder="Result Data" value="" style="width:200px;">
                            
                                <input type="text" <?= $read_only; ?> name="stool_unit[0|${counter}|insert]" value="" class="form-control bg-warning-custom" placeholder="Unit">
                            </div> 
                        </td>
                        <td>
                            <input type="text" <?= $read_only; ?> name="stool_value[0|${counter}|insert]" value="" placeholder="Normal value" class="form-control">
                            <a onClick="$(this).closest('tr').css('background-color', '#f8d7da').slideUp(500)">
                                <img src='https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png' style="width:20px;height:20px;right:10px;position:absolute;margin-top:-25px;cursor:pointer;margin-top:-25px;">
                            </a>
                        </td>
                    </tr>`;
        $('.add_stool_field').append(html);   
    })
    
    $('.add_semen').on('click',function(){  
        counter++
        let html = `<tr>
                        <td><input type="text" <?= $read_only; ?> name="semen_investigation[0|${counter}|insert]" value="" class="form-control" placeholder="Investigation value"></td>
                        <td> 
                            <div class="input-group">
                            <input class="form-control input-primary" type="text" <?= $read_only; ?> name="semen_result[0|${counter}|insert]" placeholder="Result Data" value="" style="width:200px;">
                            
                                <input type="text" <?= $read_only; ?> name="semen_unit[0|${counter}|insert]" value="" class="form-control bg-warning-custom" placeholder="Unit">
                            </div> 
                        </td>
                        <td>
                            <input type="text" <?= $read_only; ?> name="semen_value[0|${counter}|insert]" value="" placeholder="Normal value" class="form-control">
                            <a onClick="$(this).closest('tr').css('background-color', '#f8d7da').slideUp(500)">
                                <img src='https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png' style="width:20px;height:20px;right:10px;position:absolute;margin-top:-25px;cursor:pointer;margin-top:-25px;">
                            </a>
                        </td>
                    </tr>`;
        $('.add_semen_field').append(html);   
    })
    
    $('.add_thyroid').on('click',function(){  
        counter++
        let html = `<tr>
                        <td><input type="text" <?= $read_only; ?> name="thyroid_investigation[0|${counter}|insert]" value="" class="form-control" placeholder="Investigation value"></td>
                        <td> 
                            <div class="input-group">
                            <input class="form-control input-primary" type="text" <?= $read_only; ?> name="thyroid_result[0|${counter}|insert]" placeholder="Result Data" value="" style="width:200px;">
                            
                                <input type="text" <?= $read_only; ?> name="thyroid_unit[0|${counter}|insert]" value="" class="form-control bg-warning-custom" placeholder="Unit">
                            </div> 
                        </td>
                        <td>
                            <input type="text" <?= $read_only; ?> name="thyroid_value[0|${counter}|insert]" value="" placeholder="Normal value" class="form-control">
                            <a onClick="$(this).closest('tr').css('background-color', '#f8d7da').slideUp(500)">
                                <img src='https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png' style="width:20px;height:20px;right:10px;position:absolute;margin-top:-25px;cursor:pointer;margin-top:-25px;">
                            </a>
                        </td>
                    </tr>`;
        $('.add_thyroid_field').append(html);   
    })
    
  });
</script> 

<div class="content-wrapper"> 
    <div class="container-fluid">
    <div class="edit-profile">
        <div class="row mt-3">
            <div class="col-xl-12">
                <form class="card" method="POST" action="" enctype="multipart/form-data" id="field_form">
                    <div class="card-header pb-0">
                        <h4 class="card-title mb-0">ADD FIELD</h4>
                        <div class="card-options"><a class="card-options-collapse" href="#" data-bs-toggle="card-collapse"><i class="fe fe-chevron-up"></i></a><a class="card-options-remove" href="#" data-bs-toggle="card-remove"><i class="fe fe-x"></i></a></div>
                    </div>
                   
                    <div class="card-body add-post">
                        <div class="row"> 
                            <div class="col-sm-12 col-lg-12 default-according" id="accordionclose">
                                <div class="scrollmenu"> 
                                    <?php 
                                    $field_count = 0;
                                        foreach($a_report_field_type as $report_type_key=>$report_type_value){
                                            $field_count++; 
                                    ?> 
                                        <button type="button" class="btn btn-pill btn-outline-warning btn-air-warning btn-sm text-uppercase text-white" data-toggle="collapse" data-target="#collapse<?= $report_type_key; ?>" aria-expanded="true" aria-controls="heading<?= $report_type_key; ?>" style="border-radius:20px;color:white !important;border-color:white;">
                                            <?= $field_count; ?>. <?= $report_type_value; ?>
                                        </button> 
                                    <?php } ?> 
                                </div>
                                <?php if(isset($_SESSION['notify_message'])){ ?>
                                    <div class="notification-div alert alert-success p-2 mt-4">
                                        <?= $_SESSION['notify_message']; ?>
                                    </div>
                                <?php unset($_SESSION['notify_message']); }?>
                                <div class="default-according" id="accordionclose">
                                    <div class="collapse show" id="collapse1" aria-labelledby="heading1" data-parent="#accordionclose">
                                        <div class="row mt-3"> 
                                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                                <div class="table-responsive all-data-font-size">
                                                    <table class="table  table-striped checkbox-td-width">
                                                        <thead>
                                                        <tr> 
                                                            <td colspan="2" class="text-uppercase">
                                                                <h4 class="text-title-custom">Heamatology Fields</h4>
                                                            </td>
                                                            <td colspan="1">
                                                                <button type="button" class="btn btn-success pull-right add_heamatology go_to_top bg-warning-custom">Add Field</button>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>INVESTIGATION</td>
                                                            <td>RESULT / UNIT</td>
                                                            <td>NORMAL&nbsp;VALUE</td>
                                                        </tr>
                                                        </thead>
                                                        <?php 
                                                            if(!empty($get_heamatology_report_data)){
                                                            $count = -1;
                                                            foreach($get_heamatology_report_data as $k=>$heamatology_value){  
                                                                $count++;
                                                                    $id = $heamatology_value['id'];
                                                                    $investigation = $heamatology_value['investigation'];
                                                                    $result = $heamatology_value['result'];
                                                                    $unit = $heamatology_value['unit'];
                                                                    $value = $heamatology_value['value'];
                                                                    
                                                                    $is_enable_disble = $heamatology_value['added_by'];
                                                                    $read_only = "";
                                                                    $is_image_show = "style='display:inline'";
                                                                    if(empty($is_enable_disble)){
                                                                        $read_only = "readonly='true'";
                                                                        $is_image_show = "style='display:none'";
                                                                    }
                                                        ?>
                                                            <tr id="row_<?= $id; ?>">
                                                                <td><input type="text" <?= $read_only; ?> name="heamatology_investigation[<?= $id;?>|<?= $count; ?>|update]" value="<?= $investigation;?>" class="form-control" placeholder="Investigation value"></td>
                                                                <td> 
                                                                    <div class="input-group">
                                                                    <input class="form-control input-primary" type="text" <?= $read_only; ?> name="heamatology_result[<?= $id;?>|<?= $count; ?>|update]" placeholder="Result Data" value="<?= $result; ?>" style="width:200px;"> 
                                                                    <input type="text" <?= $read_only; ?> name="heamatology_unit[<?= $id;?>|<?= $count; ?>|update]" value="<?= $unit; ?>" class="form-control bg-warning-custom" placeholder="Unit"> 
                                                                    </div> 
                                                                </td>
                                                                <td>
                                                                    <input type="text" <?= $read_only; ?> name="heamatology_value[<?= $id;?>|<?= $count; ?>|update]" value="<?= $value; ?>" placeholder="Normal value" class="form-control">
                                                                    <a class="deleteData" id="<?= $id; ?>" <?= $is_image_show;?> >
                                                                        <img src='https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png' style="width:20px;height:20px;right:10px;position:absolute;margin-top:-25px;cursor:pointer;">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php } } ?>
                                                        <tbody class="add_heamatology_field"></tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div> 
                                    </div> 
                                </div>
                                <div class="default-according" id="accordionclose">
                                    <div class="collapse" id="collapse2" aria-labelledby="heading2" data-parent="#accordionclose" >
                                        <div class="row mt-3">
                                            <div class="col-sm-12 col-lg-12 col-xl-12">
                                                <div class="table-responsive">
                                                    <table class="table  table-striped checkbox-td-width">
                                                        <thead>
                                                        <tr> 
                                                            <td colspan="2" class="text-uppercase">
                                                                <h4 class="text-title-custom">serology Fields</h4>
                                                            </td>
                                                            <td colspan="1"><button type="button" class="btn btn-success pull-right add_serology go_to_top bg-warning-custom">Add Field</button></td>
                                                        </tr>
                                                        <tr>
                                                            <td>SEROLOGY</td> 
                                                            <td>SELECT&nbsp;VALUE</td>
                                                        </tr>
                                                        </thead>
                                                        <?php 
                                                            if(!empty($get_serology_report_data)){
                                                            $count = -1;
                                                            foreach($get_serology_report_data as $k=>$serology_value){  
                                                                $count++;
                                                                    $id = $serology_value['id']; 
                                                                    $result = $serology_value['result']; 
                                                                    $value = $serology_value['value']; 
                                                                    
                                                                    $is_enable_disble = $serology_value['added_by'];
                                                                    $read_only = "";
                                                                    $is_image_show = "style='display:inline'";
                                                                    if(empty($is_enable_disble)){
                                                                        $read_only = "readonly='true'";
                                                                        $is_image_show = "style='display:none'";
                                                                    }
                                                        ?>
                                                            <tr id="row_<?= $id; ?>">
                                                                <td><input type="text" <?= $read_only; ?> name="serology_result[<?=$id;?>|<?= $count;?>|update]" value="<?= $result;?>" class="form-control" placeholder="Serology field"></td> 
                                                                <td colspan="2">
                                                                    <input type="text" <?= $read_only; ?> name="serology_value[<?=$id;?>|<?= $count;?>|update]" value="<?= $value;?>" placeholder="Serology select value eg Reative|Non-reactive" class="form-control">
                                                                    <a class="deleteData" id="<?= $id; ?>" <?= $is_image_show;?>>
                                                                        <img src='https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png' style="width:20px;height:20px;right:10px;position:absolute;margin-top:-25px;cursor:pointer;">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php } } ?>
                                                        <tbody class="add_serology_field"></tbody>
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
                                                    <table class="table  table-striped checkbox-td-width">
                                                        <thead>
                                                        <tr> 
                                                            <td colspan="2" class="text-uppercase">
                                                                <h4 class="text-title-custom">biochemistry Fields</h4>
                                                            </td>
                                                            <td colspan="1"><button type="button" class="btn btn-success pull-right add_biochemistry go_to_top bg-warning-custom">Add Field</button></td>
                                                        </tr>
                                                        <tr>
                                                            <td>INVESTIGATION</td>
                                                            <td>RESULT</td>
                                                            <td>NORMAL&nbsp;VALUE</td>
                                                        </tr>
                                                        </thead>
                                                        <?php 
                                                            if(!empty($get_biochemistry_report_data)){
                                                            $count = -1;
                                                            foreach($get_biochemistry_report_data as $k=>$biochemistry_value){  
                                                                $count++;
                                                                    $id = $biochemistry_value['id'];
                                                                    $investigation = $biochemistry_value['investigation'];
                                                                    $result = $biochemistry_value['result'];
                                                                    $unit = $biochemistry_value['unit'];
                                                                    $value = $biochemistry_value['value'];
                                                                    
                                                                    $is_enable_disble = $biochemistry_value['added_by'];
                                                                    $read_only = "";
                                                                    $is_image_show = "style='display:inline'";
                                                                    if(empty($is_enable_disble)){
                                                                        $read_only = "readonly='true'";
                                                                        $is_image_show = "style='display:none'";
                                                                    }
                                                        ?>
                                                            <tr id="row_<?= $id; ?>">
                                                                <td><input type="text" <?= $read_only; ?> name="biochemistry_investigation[<?= $id;?>|<?= $count; ?>|update]" value="<?= $investigation;?>" class="form-control" placeholder="Investigation value"></td>
                                                                <td> 
                                                                    <div class="input-group">
                                                                    <input class="form-control input-primary" type="text" <?= $read_only; ?> name="biochemistry_result[<?= $id;?>|<?= $count; ?>|update]" placeholder="Result Data" value="<?= $result; ?>" style="width:200px;">
                                                                    
                                                                        <input type="text" <?= $read_only; ?> name="biochemistry_unit[<?= $id;?>|<?= $count; ?>|update]" value="<?= $unit; ?>" class="form-control bg-warning-custom" placeholder="Unit">
                                                                    </div> 
                                                                </td>
                                                                <td>
                                                                    <input type="text" <?= $read_only; ?> name="biochemistry_value[<?= $id;?>|<?= $count; ?>|update]" value="<?= $value; ?>" placeholder="Normal value" class="form-control">
                                                                    <a class="deleteData" id="<?= $id; ?>" <?= $is_image_show;?>>
                                                                        <img src='https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png' style="width:20px;height:20px;right:10px;position:absolute;margin-top:-25px;cursor:pointer;">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php } } ?>
                                                        <tbody class="add_biochemistry_field"></tbody>
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
                                                    <table class="table  table-striped checkbox-td-width">
                                                        <thead>
                                                        <tr> 
                                                            <td colspan="2" class="text-uppercase">
                                                                <h4 class="text-title-custom">renal function Fields</h4>
                                                            </td>
                                                            <td colspan="1"><button type="button" class="btn btn-success pull-right add_renalfunctiontest go_to_top bg-warning-custom">Add Field</button></td>
                                                        </tr>
                                                        <tr>
                                                            <td>INVESTIGATION</td>
                                                            <td>RESULT</td>
                                                            <td>NORMAL&nbsp;VALUE</td>
                                                        </tr>
                                                        </thead>
                                                        <?php 
                                                            if(!empty($get_renalfunctiontest_report_data)){
                                                            $count = -1;
                                                            foreach($get_renalfunctiontest_report_data as $k=>$renalfunctiontest_value){  
                                                                $count++;
                                                                    $id = $renalfunctiontest_value['id'];
                                                                    $investigation = $renalfunctiontest_value['investigation'];
                                                                    $result = $renalfunctiontest_value['result'];
                                                                    $unit = $renalfunctiontest_value['unit'];
                                                                    $value = $renalfunctiontest_value['value']; 
                                                                    
                                                                    $is_enable_disble = $renalfunctiontest_value['added_by'];
                                                                    $read_only = "";
                                                                    $is_image_show = "style='display:inline'";
                                                                    if(empty($is_enable_disble)){
                                                                        $read_only = "readonly='true'";
                                                                        $is_image_show = "style='display:none'";
                                                                    }
                                                        ?>
                                                            <tr id="row_<?= $id; ?>">
                                                                <td><input type="text" <?= $read_only; ?> name="renalfunctiontest_investigation[<?= $id;?>|<?= $count; ?>|update]" value="<?= $investigation;?>" class="form-control" placeholder="Investigation value"></td>
                                                                <td> 
                                                                    <div class="input-group">
                                                                    <input class="form-control input-primary" type="text" <?= $read_only; ?> name="renalfunctiontest_result[<?= $id;?>|<?= $count; ?>|update]" placeholder="Result Data" value="<?= $result; ?>" style="width:200px;">
                                                                    
                                                                        <input type="text" <?= $read_only; ?> name="renalfunctiontest_unit[<?= $id;?>|<?= $count; ?>|update]" value="<?= $unit; ?>" class="form-control bg-warning-custom" placeholder="Unit">
                                                                    </div> 
                                                                </td>
                                                                <td>
                                                                    <input type="text" <?= $read_only; ?> name="renalfunctiontest_value[<?= $id;?>|<?= $count; ?>|update]" value="<?= $value; ?>" placeholder="Normal value" class="form-control">
                                                                    <a class="deleteData" id="<?= $id; ?>" <?= $is_image_show;?>>
                                                                        <img src='https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png' style="width:20px;height:20px;right:10px;position:absolute;margin-top:-25px;cursor:pointer;">
                                                                    </a>    
                                                                </td>
                                                            </tr>
                                                        <?php } } ?>
                                                        <tbody class="add_renalfunctiontest_field"></tbody>
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
                                                    <table class="table  table-striped checkbox-td-width">
                                                        <thead>
                                                        <tr> 
                                                            <td colspan="2" class="text-uppercase">
                                                                <h4 class="text-title-custom">lipid profile Fields</h4>
                                                            </td>
                                                            <td colspan="1"><button type="button" class="btn btn-success pull-right add_lipidprofile go_to_top bg-warning-custom">Add Field</button></td>
                                                        </tr>
                                                        <tr>
                                                            <td>INVESTIGATION</td>
                                                            <td>RESULT</td>
                                                            <td>NORMAL&nbsp;VALUE</td>
                                                        </tr>
                                                        </thead>
                                                        <?php 
                                                            if(!empty($get_lipidprofile_report_data)){
                                                            $count = -1;
                                                            foreach($get_lipidprofile_report_data as $k=>$lipidprofile_value){  
                                                                $count++;
                                                                    $id = $lipidprofile_value['id'];
                                                                    $investigation = $lipidprofile_value['investigation'];
                                                                    $result = $lipidprofile_value['result'];
                                                                    $unit = $lipidprofile_value['unit'];
                                                                    $value = $lipidprofile_value['value']; 
                                                                    
                                                                    $is_enable_disble = $lipidprofile_value['added_by'];
                                                                    $read_only = "";
                                                                    $is_image_show = "style='display:inline'";
                                                                    if(empty($is_enable_disble)){
                                                                        $read_only = "readonly='true'";
                                                                        $is_image_show = "style='display:none'";
                                                                    }
                                                        ?>
                                                            <tr id="row_<?= $id; ?>">
                                                                <td><input type="text" <?= $read_only; ?> name="lipidprofile_investigation[<?= $id;?>|<?= $count; ?>|update]" value="<?= $investigation;?>" class="form-control" placeholder="Investigation value"></td>
                                                                <td> 
                                                                    <div class="input-group">
                                                                    <input class="form-control input-primary" type="text" <?= $read_only; ?> name="lipidprofile_result[<?= $id;?>|<?= $count; ?>|update]" placeholder="Result Data" value="<?= $result; ?>" style="width:200px;">
                                                                    
                                                                        <input type="text" <?= $read_only; ?> name="lipidprofile_unit[<?= $id;?>|<?= $count; ?>|update]" value="<?= $unit; ?>" class="form-control bg-warning-custom" placeholder="Unit">
                                                                    </div> 
                                                                </td>
                                                                <td>
                                                                    <input type="text" <?= $read_only; ?> name="lipidprofile_value[<?= $id;?>|<?= $count; ?>|update]" value="<?= $value; ?>" placeholder="Normal value" class="form-control">
                                                                    <a class="deleteData" id="<?= $id; ?>" <?= $is_image_show;?>>
                                                                        <img src='https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png' style="width:20px;height:20px;right:10px;position:absolute;margin-top:-25px;cursor:pointer;">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php } } ?>
                                                        <tbody class="add_lipidprofile_field"></tbody>
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
                                                    <table class="table  table-striped checkbox-td-width">
                                                        <thead>
                                                        <tr> 
                                                            <td colspan="2" class="text-uppercase">
                                                                <h4 class="text-title-custom">liver function Fields</h4>
                                                            </td>        
                                                            <td colspan="1"><button type="button" class="btn btn-success pull-right add_liverfunctiontest go_to_top bg-warning-custom">Add Field</button></td>
                                                        </tr>
                                                        <tr>
                                                            <td>INVESTIGATION</td>
                                                            <td>RESULT</td>
                                                            <td>NORMAL&nbsp;VALUE</td>
                                                        </tr>
                                                        </thead>
                                                        <?php 
                                                            if(!empty($get_liverfunctiontest_report_data)){
                                                            $count = -1;
                                                            foreach($get_liverfunctiontest_report_data as $k=>$liverfunctiontest_value){  
                                                                $count++;
                                                                    $id = $liverfunctiontest_value['id'];
                                                                    $investigation = $liverfunctiontest_value['investigation'];
                                                                    $result = $liverfunctiontest_value['result'];
                                                                    $unit = $liverfunctiontest_value['unit'];
                                                                    $value = $liverfunctiontest_value['value']; 
                                                                    
                                                                    $is_enable_disble = $liverfunctiontest_value['added_by'];
                                                                    $read_only = "";
                                                                    $is_image_show = "style='display:inline'";
                                                                    if(empty($is_enable_disble)){
                                                                        $read_only = "readonly='true'";
                                                                        $is_image_show = "style='display:none'";
                                                                    }
                                                        ?>
                                                            <tr id="row_<?= $id; ?>">
                                                                <td><input type="text" <?= $read_only; ?> name="liverfunctiontest_investigation[<?= $id;?>|<?= $count; ?>|update]" value="<?= $investigation;?>" class="form-control" placeholder="Investigation value"></td>
                                                                <td> 
                                                                    <div class="input-group">
                                                                    <input class="form-control input-primary" type="text" <?= $read_only; ?> name="liverfunctiontest_result[<?= $id;?>|<?= $count; ?>|update]" placeholder="Result Data" value="<?= $result; ?>" style="width:200px;">
                                                                    
                                                                        <input type="text" <?= $read_only; ?> name="liverfunctiontest_unit[<?= $id;?>|<?= $count; ?>|update]" value="<?= $unit; ?>" class="form-control bg-warning-custom" placeholder="Unit">
                                                                    </div> 
                                                                </td>
                                                                <td>
                                                                    <input type="text" <?= $read_only; ?> name="liverfunctiontest_value[<?= $id;?>|<?= $count; ?>|update]" value="<?= $value; ?>" placeholder="Normal value" class="form-control">
                                                                    <a class="deleteData" id="<?= $id; ?>" <?= $is_image_show;?>>
                                                                        <img src='https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png' style="width:20px;height:20px;right:10px;position:absolute;margin-top:-25px;cursor:pointer;">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php } } ?>
                                                        <tbody class="add_liverfunctiontest_field"></tbody>
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
                                                    <table class="table  table-striped checkbox-td-width">
                                                        <thead>
                                                        <tr>
                                                            <td style="width:20%">&nbsp;&nbsp;-&nbsp;&nbsp;</td>
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

                                                                $widaltest_value = $get_widaltest_report_data[$widaltest_key];

                                                                $widaltest_value_one = '';
                                                                $widaltest_value_two = '';
                                                                $widaltest_value_three = '';
                                                                $widaltest_value_four = '';
                                                                $widaltest_value_five = '';
                                                                
                                                                if($widaltest_value == ',,,,' || $widaltest_value==''){
                                                                    $add_status = 'insert';
                                                                }else{
                                                                    $add_status = 'update';

                                                                    $widaltest_value_one = explode(',',$widaltest_value)[0];
                                                                    $widaltest_value_two = explode(',',$widaltest_value)[1];
                                                                    $widaltest_value_three = explode(',',$widaltest_value)[2];
                                                                    $widaltest_value_four = explode(',',$widaltest_value)[3];
                                                                    $widaltest_value_five = explode(',',$widaltest_value)[4];
                                                                }
                                                                
                                                                $is_enable_disble = $a_widaltest_value['added_by'];
                                                                $read_only = "";
                                                                $is_image_show = "style='display:inline'";
                                                                if(empty($is_enable_disble)){
                                                                    $read_only = "readonly='true'";
                                                                    $is_image_show = "style='display:none'";
                                                                }
                                                        ?>
                                                        <tr>
                                                            <td><?= $investigation; ?></td>
                                                            <td>  
                                                                    <input style="width:150px;" class="form-control input-primary" type="text" <?= $read_only; ?> name="widaltest[<?= $widaltest_key;?>][1|<?= $add_status;?>]" placeholder="Result Data" value="<?= $widaltest_value_one; ?>"> 
                                                            </td> 
                                                            <td>  
                                                                    <input style="width:150px;" class="form-control input-primary" type="text" <?= $read_only; ?> name="widaltest[<?= $widaltest_key;?>][2|<?= $add_status;?>]" placeholder="Result Data" value="<?= $widaltest_value_two; ?>"> 
                                                            </td> 
                                                            <td>  
                                                                    <input style="width:150px;" class="form-control input-primary" type="text" <?= $read_only; ?> name="widaltest[<?= $widaltest_key;?>][3|<?= $add_status;?>]" placeholder="Result Data" value="<?= $widaltest_value_three; ?>"> 
                                                            </td> 
                                                            <td>  
                                                                    <input style="width:150px;" class="form-control input-primary" type="text" <?= $read_only; ?> name="widaltest[<?= $widaltest_key;?>][4|<?= $add_status;?>]" placeholder="Result Data" value="<?= $widaltest_value_four; ?>"> 
                                                            </td> 
                                                            <td class="w-50">  
                                                                    <input style="width:150px;" class="form-control input-primary" type="text" <?= $read_only; ?> name="widaltest[<?= $widaltest_key;?>][5|<?= $add_status;?>]" placeholder="Result Data" value="<?= $widaltest_value_five; ?>"> 
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
                                                    <table class="table  table-striped checkbox-td-width">
                                                        <thead>
                                                        <tr> 
                                                            <td colspan="2" class="text-uppercase">
                                                                <h4 class="text-title-custom">electrolyte Fields</h4>
                                                            </td> 
                                                            <td colspan="1"><button type="button" class="btn btn-success pull-right add_electrolyte go_to_top bg-warning-custom">Add Field</button></td>
                                                        </tr>
                                                        <tr>
                                                            <td>INVESTIGATION</td>
                                                            <td>RESULT</td>
                                                            <td>NORMAL&nbsp;VALUE</td>
                                                        </tr>
                                                        </thead>
                                                        <?php 
                                                            if(!empty($get_electrolyte_report_data)){
                                                            $count = -1;
                                                            foreach($get_electrolyte_report_data as $k=>$electrolyte_value){  
                                                                $count++;
                                                                    $id = $electrolyte_value['id'];
                                                                    $investigation = $electrolyte_value['investigation'];
                                                                    $result = $electrolyte_value['result'];
                                                                    $unit = $electrolyte_value['unit'];
                                                                    $value = $electrolyte_value['value']; 
                                                                    
                                                                    $is_enable_disble = $electrolyte_value['added_by'];
                                                                    $read_only = "";
                                                                    $is_image_show = "style='display:inline'";
                                                                    if(empty($is_enable_disble)){
                                                                        $read_only = "readonly='true'";
                                                                        $is_image_show = "style='display:none'";
                                                                    }
                                                        ?>
                                                            <tr id="row_<?= $id; ?>">
                                                                <td><input type="text" <?= $read_only; ?> name="electrolyte_investigation[<?= $id;?>|<?= $count; ?>|update]" value="<?= $investigation;?>" class="form-control" placeholder="Investigation value"></td>
                                                                <td> 
                                                                    <div class="input-group">
                                                                    <input class="form-control input-primary" type="text" <?= $read_only; ?> name="electrolyte_result[<?= $id;?>|<?= $count; ?>|update]" placeholder="Result Data" value="<?= $result; ?>" style="width:200px;">
                                                                    
                                                                        <input type="text" <?= $read_only; ?> name="electrolyte_unit[<?= $id;?>|<?= $count; ?>|update]" value="<?= $unit; ?>" class="form-control bg-warning-custom" placeholder="Unit">
                                                                    </div> 
                                                                </td>
                                                                <td>
                                                                    <input type="text" <?= $read_only; ?> name="electrolyte_value[<?= $id;?>|<?= $count; ?>|update]" value="<?= $value; ?>" placeholder="Normal value" class="form-control">
                                                                    <a class="deleteData" id="<?= $id; ?>" <?= $is_image_show;?>>
                                                                        <img src='https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png' style="width:20px;height:20px;right:10px;position:absolute;margin-top:-25px;cursor:pointer;">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php } } ?>
                                                        <tbody class="add_electrolyte_field"></tbody>
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
                                                    <table class="table  table-striped checkbox-td-width">
                                                        <thead>
                                                        <tr> 
                                                            <td colspan="2" class="text-uppercase">
                                                                <h4 class="text-title-custom">gtt Fields</h4>
                                                            </td> 
                                                            <td colspan="1"><button type="button" class="btn btn-success pull-right add_gtt go_to_top bg-warning-custom">Add Field</button></td>
                                                        </tr>
                                                        <tr>
                                                            <td>INVESTIGATION</td>
                                                            <td>RESULT</td>
                                                            <td>NORMAL&nbsp;VALUE</td>
                                                        </tr>
                                                        </thead>
                                                        <?php 
                                                            if(!empty($get_gtt_report_data)){
                                                            $count = -1;
                                                            foreach($get_gtt_report_data as $k=>$gtt_value){  
                                                                $count++;
                                                                    $id = $gtt_value['id'];
                                                                    $investigation = $gtt_value['investigation'];
                                                                    $result = $gtt_value['result'];
                                                                    $unit = $gtt_value['unit'];
                                                                    $value = $gtt_value['value']; 
                                                                    
                                                                    $is_enable_disble = $gtt_value['added_by'];
                                                                    $read_only = "";
                                                                    $is_image_show = "style='display:inline'";
                                                                    if(empty($is_enable_disble)){
                                                                        $read_only = "readonly='true'";
                                                                        $is_image_show = "style='display:none'";
                                                                    }
                                                        ?>
                                                            <tr id="row_<?= $id; ?>">
                                                                <td><input type="text" <?= $read_only; ?> name="gtt_investigation[<?= $id;?>|<?= $count; ?>|update]" value="<?= $investigation;?>" class="form-control" placeholder="Investigation value"></td>
                                                                <td> 
                                                                    <div class="input-group">
                                                                    <input class="form-control input-primary" type="text" <?= $read_only; ?> name="gtt_result[<?= $id;?>|<?= $count; ?>|update]" placeholder="Result Data" value="<?= $result; ?>" style="width:200px;">
                                                                    
                                                                        <input type="text" <?= $read_only; ?> name="gtt_unit[<?= $id;?>|<?= $count; ?>|update]" value="<?= $unit; ?>" class="form-control bg-warning-custom" placeholder="Unit">
                                                                    </div> 
                                                                </td>
                                                                <td>
                                                                    <input type="text" <?= $read_only; ?> name="gtt_value[<?= $id;?>|<?= $count; ?>|update]" value="<?= $value; ?>" placeholder="Normal value" class="form-control">
                                                                    <a class="deleteData" id="<?= $id; ?>" <?= $is_image_show;?>>
                                                                        <img src='https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png' style="width:20px;height:20px;right:10px;position:absolute;margin-top:-25px;cursor:pointer;">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php } } ?>
                                                        <tbody class="add_gtt_field"></tbody>
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
                                                    <table class="table  table-striped checkbox-td-width">
                                                        <thead>
                                                        <tr> 
                                                            <td colspan="2" class="text-uppercase">
                                                                <h4 class="text-title-custom">urine Fields</h4>
                                                            </td>         
                                                            <td colspan="3"><button type="button" class="btn btn-success pull-right add_urine go_to_top bg-warning-custom">Add Field</button></td>
                                                        </tr>
                                                        <tr>
                                                            <td>INVESTIGATION</td>
                                                            <td>RESULT</td>
                                                            <td>NORMAL&nbsp;VALUE</td>
                                                        </tr>
                                                        </thead>
                                                        <?php 
                                                            if(!empty($get_urine_report_data)){
                                                            $count = -1;
                                                            foreach($get_urine_report_data as $k=>$urine_value){  
                                                                $count++;
                                                                    $id = $urine_value['id'];
                                                                    $investigation = $urine_value['investigation'];
                                                                    $result = $urine_value['result'];
                                                                    $unit = $urine_value['unit'];
                                                                    $value = $urine_value['value']; 
                                                                    
                                                                    $is_enable_disble = $urine_value['added_by'];
                                                                    $read_only = "";
                                                                    $is_image_show = "style='display:inline'";
                                                                    if(empty($is_enable_disble)){
                                                                        $read_only = "readonly='true'";
                                                                        $is_image_show = "style='display:none'";
                                                                    }
                                                        ?>
                                                            <tr id="row_<?= $id; ?>">
                                                                <td><input type="text" <?= $read_only; ?> name="urine_investigation[<?= $id;?>|<?= $count; ?>|update]" value="<?= $investigation;?>" class="form-control" placeholder="Investigation value"></td>
                                                                <td> 
                                                                    <div class="input-group">
                                                                    <input class="form-control input-primary" type="text" <?= $read_only; ?> name="urine_result[<?= $id;?>|<?= $count; ?>|update]" placeholder="Result Data" value="<?= $result; ?>" style="width:200px;">
                                                                    
                                                                        <input type="text" <?= $read_only; ?> name="urine_unit[<?= $id;?>|<?= $count; ?>|update]" value="<?= $unit; ?>" class="form-control bg-warning-custom" placeholder="Unit">
                                                                    </div> 
                                                                </td>
                                                                <td>
                                                                    <input type="text" <?= $read_only; ?> name="urine_value[<?= $id;?>|<?= $count; ?>|update]" value="<?= $value; ?>" placeholder="Normal value" class="form-control">
                                                                    <a class="deleteData" id="<?= $id; ?>" <?= $is_image_show;?>>
                                                                        <img src='https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png' style="width:20px;height:20px;right:10px;position:absolute;margin-top:-25px;cursor:pointer;">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php } } ?>
                                                        <tbody class="add_urine_field"></tbody>
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
                                                    <table class="table  table-striped checkbox-td-width">
                                                        <thead>
                                                        <tr> 
                                                            <td colspan="2" class="text-uppercase">
                                                                <h4 class="text-title-custom">stool Fields</h4>
                                                            </td>
                                                            <td colspan="1"><button type="button" class="btn btn-success pull-right add_stool go_to_top bg-warning-custom">Add Field</button></td>
                                                        </tr>
                                                        <tr>
                                                            <td>INVESTIGATION</td>
                                                            <td>RESULT</td>
                                                            <td>NORMAL&nbsp;VALUE</td>
                                                        </tr>
                                                        </thead>
                                                        <?php 
                                                            if(!empty($get_stool_report_data)){
                                                            $count = -1;
                                                            foreach($get_stool_report_data as $k=>$stool_value){  
                                                                $count++;
                                                                    $id = $stool_value['id'];
                                                                    $investigation = $stool_value['investigation'];
                                                                    $result = $stool_value['result'];
                                                                    $unit = $stool_value['unit'];
                                                                    $value = $stool_value['value']; 
                                                                    
                                                                    $is_enable_disble = $stool_value['added_by'];
                                                                    $read_only = "";
                                                                    $is_image_show = "style='display:inline'";
                                                                    if(empty($is_enable_disble)){
                                                                        $read_only = "readonly='true'";
                                                                        $is_image_show = "style='display:none'";
                                                                    }
                                                        ?>
                                                            <tr id="row_<?= $id; ?>">
                                                                <td><input type="text" <?= $read_only; ?> name="stool_investigation[<?= $id;?>|<?= $count; ?>|update]" value="<?= $investigation;?>" class="form-control" placeholder="Investigation value"></td>
                                                                <td> 
                                                                    <div class="input-group">
                                                                    <input class="form-control input-primary" type="text" <?= $read_only; ?> name="stool_result[<?= $id;?>|<?= $count; ?>|update]" placeholder="Result Data" value="<?= $result; ?>" style="width:200px;">
                                                                    
                                                                        <input type="text" <?= $read_only; ?> name="stool_unit[<?= $id;?>|<?= $count; ?>|update]" value="<?= $unit; ?>" class="form-control bg-warning-custom" placeholder="Unit">
                                                                    </div> 
                                                                </td>
                                                                <td>
                                                                    <input type="text" <?= $read_only; ?> name="stool_value[<?= $id;?>|<?= $count; ?>|update]" value="<?= $value; ?>" placeholder="Normal value" class="form-control">
                                                                    <a class="deleteData" id="<?= $id; ?>" <?= $is_image_show;?>>
                                                                        <img src='https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png' style="width:20px;height:20px;right:10px;position:absolute;margin-top:-25px;cursor:pointer;">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php } } ?>
                                                        <tbody class="add_stool_field"></tbody>
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
                                                    <table class="table  table-striped checkbox-td-width">
                                                        <thead>
                                                        <tr> 
                                                            <td colspan="2" class="text-uppercase">
                                                                <h4 class="text-title-custom">semen Fields</h4>
                                                            </td>
                                                            <td colspan="1"><button type="button" class="btn btn-success pull-right add_semen go_to_top bg-warning-custom">Add Field</button></td>
                                                        </tr>
                                                        <tr>
                                                            <td>INVESTIGATION</td>
                                                            <td>RESULT</td>
                                                            <td>NORMAL&nbsp;VALUE</td>
                                                        </tr>
                                                        </thead>
                                                        <?php 
                                                            if(!empty($get_semen_report_data)){
                                                            $count = -1;
                                                            foreach($get_semen_report_data as $k=>$semen_value){  
                                                                $count++;
                                                                    $id = $semen_value['id'];
                                                                    $investigation = $semen_value['investigation'];
                                                                    $result = $semen_value['result'];
                                                                    $unit = $semen_value['unit'];
                                                                    $value = $semen_value['value']; 
                                                                    
                                                                    $is_enable_disble = $semen_value['added_by'];
                                                                    $read_only = "";
                                                                    $is_image_show = "style='display:inline'";
                                                                    if(empty($is_enable_disble)){
                                                                        $read_only = "readonly='true'";
                                                                        $is_image_show = "style='display:none'";
                                                                    }
                                                        ?>
                                                            <tr id="row_<?= $id; ?>">
                                                                <td><input type="text" <?= $read_only; ?> name="semen_investigation[<?= $id;?>|<?= $count; ?>|update]" value="<?= $investigation;?>" class="form-control" placeholder="Investigation value"></td>
                                                                <td> 
                                                                    <div class="input-group">
                                                                    <input class="form-control input-primary" type="text" <?= $read_only; ?> name="semen_result[<?= $id;?>|<?= $count; ?>|update]" placeholder="Result Data" value="<?= $result; ?>" style="width:200px;">
                                                                    
                                                                        <input type="text" <?= $read_only; ?> name="semen_unit[<?= $id;?>|<?= $count; ?>|update]" value="<?= $unit; ?>" class="form-control bg-warning-custom" placeholder="Unit">
                                                                    </div> 
                                                                </td>
                                                                <td>
                                                                    <input type="text" <?= $read_only; ?> name="semen_value[<?= $id;?>|<?= $count; ?>|update]" value="<?= $value; ?>" placeholder="Normal value" class="form-control">
                                                                    <a class="deleteData" id="<?= $id; ?>" <?= $is_image_show;?>>
                                                                        <img src='https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png' style="width:20px;height:20px;right:10px;position:absolute;margin-top:-25px;cursor:pointer;">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php } } ?>
                                                        <tbody class="add_semen_field"></tbody>
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
                                                    <table class="table  table-striped checkbox-td-width">
                                                        <thead>
                                                        <tr> 
                                                            <td colspan="2" class="text-uppercase">
                                                                <h4 class="text-title-custom">thyroid Fields</h4>
                                                            </td>
                                                            <td colspan="1"><button type="button" class="btn btn-success pull-right add_thyroid go_to_top bg-warning-custom">Add Field</button></td>
                                                        </tr>
                                                        <tr>
                                                            <td>INVESTIGATION</td>
                                                            <td>RESULT</td>
                                                            <td>NORMAL&nbsp;VALUE</td>
                                                        </tr>
                                                        </thead>
                                                        <?php 
                                                            if(!empty($get_thyroid_report_data)){
                                                            $count = -1;
                                                            foreach($get_thyroid_report_data as $k=>$thyroid_value){  
                                                                $count++;
                                                                    $id = $thyroid_value['id'];
                                                                    $investigation = $thyroid_value['investigation'];
                                                                    $result = $thyroid_value['result'];
                                                                    $unit = $thyroid_value['unit'];
                                                                    $value = $thyroid_value['value']; 
                                                                    
                                                                    $is_enable_disble = $thyroid_value['added_by'];
                                                                    $read_only = "";
                                                                    $is_image_show = "style='display:inline'";
                                                                    if(empty($is_enable_disble)){
                                                                        $read_only = "readonly='true'";
                                                                        $is_image_show = "style='display:none'";
                                                                    }
                                                        ?>
                                                            <tr id="row_<?= $id; ?>">
                                                                <td><input type="text" <?= $read_only; ?> name="thyroid_investigation[<?= $id;?>|<?= $count; ?>|update]" value="<?= $investigation;?>" class="form-control" placeholder="Investigation value"></td>
                                                                <td> 
                                                                    <div class="input-group">
                                                                    <input class="form-control input-primary" type="text" <?= $read_only; ?> name="thyroid_result[<?= $id;?>|<?= $count; ?>|update]" placeholder="Result Data" value="<?= $result; ?>" style="width:200px;">
                                                                    
                                                                        <input type="text" <?= $read_only; ?> name="thyroid_unit[<?= $id;?>|<?= $count; ?>|update]" value="<?= $unit; ?>" class="form-control bg-warning-custom" placeholder="Unit">
                                                                    </div> 
                                                                </td>
                                                                <td>
                                                                    <input type="text" <?= $read_only; ?> name="thyroid_value[<?= $id;?>|<?= $count; ?>|update]" value="<?= $value; ?>" placeholder="Normal value" class="form-control">
                                                                    <a class="deleteData" id="<?= $id; ?>" <?= $is_image_show;?>>
                                                                        <img src='https://cdn.pixabay.com/photo/2014/03/25/15/19/cross-296507_960_720.png' style="width:20px;height:20px;right:10px;position:absolute;margin-top:-25px;cursor:pointer;">
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        <?php } } ?>
                                                        <tbody class="add_thyroid_field"></tbody>
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
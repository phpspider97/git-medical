<?php
    //include("root.php");
    //echo SITE_ROOT	.   "/classes/Report.php"; die;
    // include(SITE_ROOT	.   "/classes/Report.php"); 
  
    // $report_obj = NEW Report();
    
    $a_field_data = $report_obj->getFieldData($_SESSION['member_id']);
    //print_r($a_field_data); die;
    if(!empty($a_field_data)){   
        $get_heamatology_report_data =   $a_field_data[1];
        $get_serology_report_data    =   $a_field_data[2];
        $get_biochemistry_report_data    =   $a_field_data[3];
        $get_renalfunctiontest_report_data    =   $a_field_data[4];
        $get_lipidprofile_report_data    =   $a_field_data[5];
        $get_liverfunctiontest_report_data    =   $a_field_data[6];
        // $get_widaltest_report_data    =   $a_get_report_data[7];
        $get_electrolyte_report_data    =   $a_field_data[8];
        $get_gtt_report_data    =   $a_field_data[9];
        $get_urine_report_data    =   $a_field_data[10];
        $get_stool_report_data    =   $a_field_data[11];
        $get_semen_report_data    =   $a_field_data[12];
        $get_thyroid_report_data    =   $a_field_data[13];
    }
    
$a_report_field_type = [
  1=>'Heamatology',
  'Serology',
  'Bio-chemistry',
  'Renal function test',
  'lipid profile',
  'liver function test' ,
  8=>'ELECTROLYTES',
  'G.T.T',
  'URINE EXAMINATION',
  'STOOL EXAMINATION',
  'SEMEN EXAMINATION',
  'THYROID FUNCTION TESTS'
  
];
$a_report_type = [
  1=>'Heamatology',
  'Serology',
  'Bio-chemistry',
  'Renal function test',
  'Lipid profile',
  'Liver function test',
  'Widal test',
  'ELECTROLYTES',
  'G.T.T',
  'URINE EXAMINATION',
  'STOOL EXAMINATION',
  'SEMEN EXAMINATION',
  'THYROID FUNCTION TESTS'
  
];
$a_heamatology = [];
if(!empty($get_heamatology_report_data)){
    foreach($get_heamatology_report_data as $k=>$heamatology_value){  
        $id = $heamatology_value['id'];
        $investigation = $heamatology_value['investigation'];
        $result = (strtoupper($heamatology_value['result']) === 'TRUE')?'TRUE':'FASLE';
        $unit = $heamatology_value['unit'];
        $value = $heamatology_value['value'];
        $a_heamatology[] = "$investigation,".$result."_"."$unit,$value";
    }
}
$a_heamatology = [];
if(!empty($get_heamatology_report_data)){
    foreach($get_heamatology_report_data as $k=>$heamatology_value){  
        $id = $heamatology_value['id'];
        $investigation = $heamatology_value['investigation'];
        $result = (strtoupper($heamatology_value['result']) === 'TRUE')?'TRUE':'FASLE';
        $unit = $heamatology_value['unit'];
        $value = $heamatology_value['value'];
        $a_heamatology[] = "$investigation,".$result."_"."$unit,$value";
    }
}
$a_serology = [];
if(!empty($get_serology_report_data)){
    foreach($get_serology_report_data as $k=>$serology_value){  
        $id = $serology_value['id'];
        $investigation = $serology_value['investigation'];
        $result = $serology_value['result'];
        $unit = $serology_value['unit'];
        $value = $serology_value['value'];
        $a_serology[] = "$result,$value";
    }
}

$a_biochemistry = [];
if(!empty($get_biochemistry_report_data)){
    foreach($get_biochemistry_report_data as $k=>$biochemistry_value){  
        $id = $biochemistry_value['id'];
        $investigation = $biochemistry_value['investigation'];
        $result = (strtoupper($biochemistry_value['result']) === 'TRUE')?'TRUE':'FASLE';
        $unit = $biochemistry_value['unit'];
        $value = $biochemistry_value['value'];
        $a_biochemistry[] = "$investigation,".$result."_"."$unit,$value";
    }
}

$a_renalfunctiontest = [];
if(!empty($get_renalfunctiontest_report_data)){
    foreach($get_renalfunctiontest_report_data as $k=>$renalfunctiontest_value){  
        $id = $renalfunctiontest_value['id'];
        $investigation = $renalfunctiontest_value['investigation'];
        $result = (strtoupper($renalfunctiontest_value['result']) === 'TRUE')?'TRUE':'FASLE';
        $unit = $renalfunctiontest_value['unit'];
        $value = $renalfunctiontest_value['value'];
        $a_renalfunctiontest[] = "$investigation,".$result."_"."$unit,$value";
    }
}

$a_lipidprofile = [];
if(!empty($get_lipidprofile_report_data)){
    foreach($get_lipidprofile_report_data as $k=>$lipidprofile_value){  
        $id = $lipidprofile_value['id'];
        $investigation = $lipidprofile_value['investigation'];
        $result = (strtoupper($lipidprofile_value['result']) === 'TRUE')?'TRUE':'FASLE';
        $unit = $lipidprofile_value['unit'];
        $value = $lipidprofile_value['value'];
        $a_lipidprofile[] = "$investigation,".$result."_"."$unit,$value";
    }
}

$a_liverfunctiontest = [];
if(!empty($get_liverfunctiontest_report_data)){
    foreach($get_liverfunctiontest_report_data as $k=>$liverfunctiontest_value){  
        $id = $liverfunctiontest_value['id'];
        $investigation = $liverfunctiontest_value['investigation'];
        $result = (strtoupper($liverfunctiontest_value['result']) === 'TRUE')?'TRUE':'FASLE';
        $unit = $liverfunctiontest_value['unit'];
        $value = $liverfunctiontest_value['value'];
        $a_liverfunctiontest[] = "$investigation,".$result."_"."$unit,$value";
    }
}

$a_electrolyte = [];
if(!empty($get_electrolyte_report_data)){
    foreach($get_electrolyte_report_data as $k=>$electrolyte_value){  
        $id = $electrolyte_value['id'];
        $investigation = $electrolyte_value['investigation'];
        $result = (strtoupper($electrolyte_value['result']) === 'TRUE')?'TRUE':'FASLE';
        $unit = $electrolyte_value['unit'];
        $value = $electrolyte_value['value'];
        $a_electrolyte[] = "$investigation,".$result."_"."$unit,$value";
    }
}

$a_gtt = [];
if(!empty($get_gtt_report_data)){
    //echo "<pre>";print_r($get_gtt_report_data); die;
    foreach($get_gtt_report_data as $k=>$gtt_value){  
        $id = $gtt_value['id'];
        $investigation = $gtt_value['investigation']; 
        $result = (strtoupper($gtt_value['result']) === 'TRUE')?'TRUE':'FASLE';
        $unit = $gtt_value['unit'];
        $value = $gtt_value['value'];
        $a_gtt[] = "$investigation,".$result."_"."$unit,$value";
    }
}

$a_urine = [];
if(!empty($get_urine_report_data)){
    foreach($get_urine_report_data as $k=>$urine_value){  
        $id = $urine_value['id'];
        $investigation = $urine_value['investigation'];
        $result = (strtoupper($urine_value['result']) === 'TRUE')?'TRUE':'FASLE';
        $unit = $urine_value['unit'];
        $value = $urine_value['value'];
        $a_urine[] = "$investigation,".$result."_"."$unit,$value";
    }
}

$a_stool = [];
if(!empty($get_stool_report_data)){
    foreach($get_stool_report_data as $k=>$stool_value){  
        $id = $stool_value['id'];
        $investigation = $stool_value['investigation'];
        $result = (strtoupper($stool_value['result']) === 'TRUE')?'TRUE':'FASLE';
        $unit = $stool_value['unit'];
        $value = $stool_value['value'];
        $a_stool[] = "$investigation,".$result."_"."$unit,$value";
    }
}
$a_semen = [];
if(!empty($get_semen_report_data)){
    foreach($get_semen_report_data as $k=>$semen_value){  
        $id = $semen_value['id'];
        $investigation = $semen_value['investigation'];
        $result = (strtoupper($semen_value['result']) === 'TRUE')?'TRUE':'FASLE';
        $unit = $semen_value['unit'];
        $value = $semen_value['value'];
        $a_semen[] = "$investigation,".$result."_"."$unit,$value";
    }
}
$a_thyroid = [];
if(!empty($get_thyroid_report_data)){
    foreach($get_thyroid_report_data as $k=>$thyroid_value){  
        $id = $thyroid_value['id'];
        $investigation = $thyroid_value['investigation'];
        $result = (strtoupper($thyroid_value['result']) === 'TRUE')?'TRUE':'FASLE';
        $unit = $thyroid_value['unit'];
        $value = $thyroid_value['value'];
        $a_thyroid[] = "$investigation,".$result."_"."$unit,$value";
    }
} 
        
$a_report_data = [
    'heamatology'=>$a_heamatology,
    'heamatology1'=>[ 
      'Heamoglobin,TRUE_gm%,M=12-16 gm% F=10-14 gm %',
      'E.S.R,TRUE_mm,(O-20mm/1hr) (Wintrobe Method)',
      'T.L.C.,TRUE_/Cmm,(4000-11000/Cmm)',
      'D.L.C :-,FALSE,(40-75%)',
      ' &nbsp; - Neutrophils,TRUE_%,(20-45%)',
      '&nbsp; -Lymphocytes,TRUE_%,(2-10%)',
      '&nbsp; -Monocytes,TRUE_%,(1-5%)',
      '&nbsp; -Eosinophils,TRUE_%,(0-1%)',
      '&nbsp; -Basophils,TRUE_%,(1.5 - 4.5 lacs)',
      'Platelet Count,TRUE_Lacs,(32-45%)',
      'P.C.V,TRUE_%,3.5-6.5 m/cumm',
      'RBC,TRUE_millions,80-96 ft',
      'MCV,TRUE_fl,27.32 pg',
      'MCH,TRUE_PG%,30-36%',
      'MCHC,TRUE_%,30-36%',
      'A.Eosionophils Count,TRUE_/Cmm,(40-440/Cmm)',
      'Bleeding Time,TRUE,(1-6 min)',
      'Cloating Time,TRUE,(2-10 min)',
      'M.P. Slide Test,FALSE,Seen / Not Seen',
      'M.P. Card Test,FALSE,Pf/ Pv Reactive / Non Reactive',
  ],
  'serology'=>$a_serology,
  'serology1'=>[
    'Blood Group,Positive/Negative',
    'HBsAg,Reactive/Non-Reactive',
    'VDRL,Reactive/Non-Reactive',
    'R.A Factor,Reactive/Non-Reactive',
    'Sputum For AFB,Reactive/Non-Reactive',
    'MX Test,Seen/Not Seen',
    'CRP Test,Reactive/Non-Reactive',
    'ASO Titer,Reactive/Non-Reactive',
    'Dengue NS 1 Ag,Reactive/Non-Reactive',
    'Dengue IGM/IGG Test,Reactive/Non-Reactive',
    'Trop-T Test,Reactive/Non-Reactive',
    'HIV (TRI-DOT) I & II,Reactive/Non-Reactive',
    'Chikangunia IGM Test,Reactive/Non-Reactive',
    'Pregnancy Test,Reactive/Non-Reactive',
  ],
  'biochemistry'=>$a_biochemistry,
  'biochemistry1'=>[ 
    'B. Sugar Fasting,TRUE_mg%,70-110 mg%',
    'B. Sugar (PP),TRUE_mg%,100-180 mg%',
    'B. Sugar (Random),TRUE_mg%,upto 160 mg%',
    'Urine Sugar,FALSE,NIL',
  ],
  'renalfunctiontest'=>$a_renalfunctiontest,
  'renalfunctiontest1'=>[ 
    'B. Urea,TRUE_mg%,10-45 mg %',
    'S.Creatinine,TRUE_mg%,0.5-1.5 mg %',
    'S Uric Acid,TRUE_mg%,F= 2.0-5.7, M=2.5-7.0 mg%', 
  ],
  'lipidprofile'=>$a_lipidprofile,
  'lipidprofile1'=>[ 
    'Serum Cholesterol,TRUE_mg%,< 200 mg%',
    'HDL Cholesterol,TRUE_mg%,35-55 mg%',
    'LDL Cholesterol,TRUE_mg%,50-150 mg%',
    'VLDL Cholesterol,TRUE_mg%,15-40 mg%',
    'Triglycerides,TRUE_mg%,< 150 mg%',
    'Total Lipid,TRUE_mg%,400-700 mg%',
    'CPK-MB,TRUE_mg%,Upto 24 U/L',
  ],
  'liverfunctiontest'=>$a_liverfunctiontest,
  'liverfunctiontest1'=>[ 
    'S.Bilirubin,TRUE_mg%,0.3-1.2 mg%',
    'Direct,TRUE_mg%,mg%',
    'Indirect,TRUE_mg%,mg%',
    'Total Protien,TRUE_gm/dl,6.0-8.0 gm/dl',
    'Albumin,TRUE_gm/dl,3.5- 5.0 gm/dl',
    'Globulin,TRUE_gm/dl,2.3- 3.5 gm/dl',
    'SGOT,TRUE_IU/L,5-40 IU/L',
    'SGPT,TRUE_IU/L,5-35 IU/L',
    'AIk Po4,TRUE_IU/L,100-250 IU/L',
    '-,FALSE_IU/L,Children 3-15 Years 250-770 IU/ L',
    'S.AMYLASE,TRUE_IU/L,22-88 IU/L',
  ],
  'widaltest'=>[ 
    '"Typhy" O,TRUE_mg%,0.2-1.0 mg%',
    '"Typhy" H,TRUE_mg%,mg%',
    '"Para Typhy" AH,TRUE_mg%,mg%',
    '"Para Typhy" BH,TRUE_mg%,mg%',  
  ],
  'electrolyte'=>$a_electrolyte,
  'gtt'=>$a_gtt,
  'urine'=>$a_urine,
  'stool'=>$a_stool,
  'semen'=>$a_semen,
  'thyroid'=>$a_thyroid

]; 
//echo "<pre>";print_r($a_report_data); die;
?>
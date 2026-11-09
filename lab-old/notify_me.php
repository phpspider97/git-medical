<script>
   $.notify({
      //title:'Email: Erica Fisher',
      message:"<?= $notify_message ?>"
   },
   {
      type:'<?= $notify_type; ?>',
      allow_dismiss:true,
      newest_on_top:false ,
      mouse_over:true,
      showProgressbar:true,
      spacing:10,
      timer:2000,
      placement:{
        from:'top',
        align:'right'
      },
      offset:{
        x:30,
        y:30
      },
      delay:1000 ,
      z_index:10000,
      animate:{
        enter:'animated bounce',
        exit:'animated flash'
    }
  });
 </script>
<?php
	include("root.php");
	include(SITE_ROOT_ADMIN	.	"/includes/top.php");
	include(SITE_ROOT_ADMIN	.   "/classes/Encryption.php");
    include(SITE_ROOT_ADMIN	.	"/classes/Newsletter.php");
    include_once(SITE_ROOT_ADMIN	.   "/classes/Contact.php"); 
       
    $contact_obj = NEW Contact(); 
    $encryption_obj = NEW Encryption();
    $newsletter_obj = NEW Newsletter();
     
    $a_all_data = $newsletter_obj->getAllData(DATABASE_TABLE_PREFIX.'newsletter');
    $contact_obj->updateAllNoReadData(" WHERE admin_id=".$_SESSION['admin_id'],DATABASE_TABLE_PREFIX.'newsletter');
      
?>
<div class="content-wrapper">
    <div class="container-fluid"> 
        <div class="row"> 
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">LIST OF NEWSLETTER</h5>
                        <?php if(isset($_SESSION['notify_message'])){ ?>
                        <div class="notification-div alert alert-success p-2">
                            <?= $_SESSION['notify_message']; ?>
                        </div>
                        <?php unset($_SESSION['notify_message']); }?>
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th> 
                                        <th scope="col">Customer Email</th> 
                                        <th scope="col">Inserted Date</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php      
                                        if(!empty($a_all_data)){
                                            $count = 0;
                                            foreach($a_all_data as $data_key=>$data_value){ 
                                                $count++;
                                                $newsletter_email = $data_value['newsletter_email'];
                                                $created_at = $data_value['created_at']; 
                                        ?>  
                                        <th scope="row"><?= $count; ?></th> 
                                        <td><?= $newsletter_email; ?></td> 
                                        <td><?= $created_at; ?></td> 
                                    </tr>
                                    <?php } }else{ ?>
                                    <tr class="text-center">
                                        <th scope="row" colspan='5'>No Newsletter.</th> 
                                    </tr>
                                    <?php } ?> 
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <div class="overlay toggle-menu"></div> 
    </div> 
</div>  
<a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
<?php
	include(SITE_ROOT_ADMIN	.	"/includes/bottom.php");
?>
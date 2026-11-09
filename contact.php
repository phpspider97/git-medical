<?php
	include("root.php");
	include(SITE_ROOT_ADMIN	.	"/includes/top.php");
	include(SITE_ROOT_ADMIN	.   "/classes/Encryption.php"); 
	include_once(SITE_ROOT_ADMIN	.   "/classes/Contact.php"); 
      
    $encryption_obj = NEW Encryption(); 
    $contact_obj = NEW Contact(); 
     
    $admin_id = $_SESSION['admin_id'];
    $a_all_data = $contact_obj->getAllData(DATABASE_TABLE_PREFIX.'contact');
    $contact_obj->updateAllNoReadData(" WHERE admin_id=".$_SESSION['admin_id'],DATABASE_TABLE_PREFIX.'contact');
      
?>
<div class="content-wrapper">
    <div class="container-fluid"> 
        <div class="row"> 
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">LIST OF CONTACT MESSAGE</h5>
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
                                        <th scope="col">Customer Name</th>
                                        <th scope="col">Customer Email</th>
                                        <th scope="col">Customer Mobile</th>
                                        <th scope="col">Customer Message</th> 
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <?php      
                                        if(!empty($a_all_data)){
                                            $count = 0;
                                            foreach($a_all_data as $data_key=>$data_value){ 
                                                $count++;
                                                $contact_email = $data_value['contact_email'];
                                                $contact_mobile = $data_value['contact_mobile'];
                                                $contact_name = $data_value['contact_name'];
                                                $contact_message = $data_value['contact_message'];
                                        ?>  
                                        <th scope="row"><?= $count; ?></th>
                                        <td><?= $contact_name; ?></td>
                                        <td><?= $contact_email; ?></td>
                                        <td><?= $contact_mobile; ?></td>
                                        <td><?= $contact_message; ?></td> 
                                    </tr>
                                    <?php } }else{ ?>
                                    <tr class="text-center">
                                        <th scope="row" colspan='5'>No Contact Message.</th> 
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
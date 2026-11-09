<?php
	include("root.php");
	include(SITE_ROOT_ADMIN	.	"/includes/top.php");
	include(SITE_ROOT_ADMIN	.	"/classes/Product.php");
    include(SITE_ROOT_ADMIN	.   "/classes/Encryption.php");
	include(SITE_ROOT_ADMIN	.	"/classes/Category.php");
	include(SITE_ROOT_ADMIN	.	"/classes/Brand.php");
 
    $product_obj = NEW Product();
    $encryption_obj = NEW encryption(); 
	$category_obj = NEW Category();
    $brand_obj = NEW Brand();
 
	$product_id = 0;
	$category_id = 0; 
	$brand_id = 0; 
    $product_name = '';
    $data_image = '';
    $product_description = ''; 
    $is_active = '';
	$product_price = '';
	$category_name = '';
	$brand_name = '';
	$admin_id = $_SESSION['admin_id'];
	$encrypted_admin_id	= $encryption_obj->encode($admin_id);
	$display_brand_div = 'none';
	$display_category_div = 'none';
    
	$all_active_category = $category_obj->getAllActiveData($admin_id,DATABASE_TABLE_PREFIX.'category'); 
	$all_active_brand = $brand_obj->getAllActiveData($admin_id,DATABASE_TABLE_PREFIX.'brand');
     
	
	$get_category_name = [];
	if(!empty($all_active_category)){
		foreach($all_active_category as $cat_val){
			$get_category_name[] = $cat_val['category_name'].'-'.$cat_val['category_id'];
		}
		$get_category_name = implode("','",$get_category_name);
	}

	$get_brand_name = [];
	if(!empty($all_active_brand)){
		foreach($all_active_brand as $cat_val){
			$get_brand_name[] = $cat_val['brand_name'].'-'.$cat_val['brand_id'];
		}
		$get_brand_name = implode("','",$get_brand_name);
	}
	
 
    
	if(isset($_GET['data_id'])){
		$encrypted_id = $_GET['data_id'];
		$data_id = $encryption_obj->decode($encrypted_id);
		$a_get_data = $product_obj->getData($data_id);
		if(!empty($a_get_data)){
			$product_id = $a_get_data['product_id']; 
			$category_id = $a_get_data['category_id']; 
			$brand_id = $a_get_data['brand_id']; 
			$category_name = $a_get_data['category_name']; 
			$brand_name = $a_get_data['brand_name']; 
			$product_name = $a_get_data['product_name']; 
			$product_price = $a_get_data['product_price']; 
			$data_image = $a_get_data['data_image']; 
			$product_description = $a_get_data['product_description']; 
			$is_active = $a_get_data['is_active']; 
		}
	}

    if(isset($_POST['data_submit'])){ 
        unset($_POST['data_submit']); 
		$_POST['admin_id']  =   $admin_id; 
		$is_active  =   $_POST['is_active']; 

		// Add Brand and Category //
		if(!empty($_POST['brand_name']) && empty($_POST['brand_id'])){ 
			$_POST['brand_id'] = 0;
			$_POST['is_active'] = 1;
			$_POST['brand_id'] = $brand_obj->addUpdateData($_POST,DATABASE_TABLE_PREFIX.'brand','')['return_id'];
		}
		if(!empty($_POST['category_name']) && empty($_POST['category_id'])){
			$_POST['category_id'] = 0;
			$_POST['is_active'] = 1;
			$_POST['category_id'] = $category_obj->addUpdateData($_POST,DATABASE_TABLE_PREFIX.'category','')['return_id'];
		}
		// Add Brand and Category //

		$_POST['is_active'] = $is_active;
        $is_updated = $product_obj->addUpdateData($_POST,DATABASE_TABLE_PREFIX.'product',$_FILES);

		if($is_updated['status'] == 200){
            $_SESSION['notify_message'] = "Data ".$is_updated['msg']." successful.";
            $_SESSION['notify_type'] = "success";
            ob_clean();				
            header("Location: ".SITE_URL_ADMIN."/manage-product.php");
            exit();
        }else{
            $_SESSION['notify_message'] = $is_updated['msg'];
            $_SESSION['notify_type'] = "danger";
            $product_name = $_POST['product_name']; 
			$product_price = $_POST['product_price'];  
			$product_description = $_POST['product_description']; 
        } 
    }
?>
<script src="//cdn.ckeditor.com/4.14.1/standard/ckeditor.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script> 
<script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" />


<script>
    $(document).ready(function() {
		$('.add_category').on('click',function(e){  
			$('.add_category_div').toggle(200);  
		});
		$('.add_brand').on('click',function(e){  
			$('.add_brand_div').toggle(200); 
		});
	});
</script>
<style>  
	/*the container must be positioned relative:*/
	.autocomplete {
		position: relative;
		display: inline-block;
	}
 
	.autocomplete-items {
		position: absolute;
		border: 1px solid #d4d4d4;
		border-bottom: none;
		border-top: none;
		z-index: 99;
		/*position the autocomplete items to be the same width as the container:*/
		/* top: 100%; */
		left: 11;
		right: 12; 
		height:200px;
		background-color: #34495e; 
		overflow-y: scroll;
		z-index: 1000;
		border-right:2px solid white;
		border-left:2px solid white;
		border-bottom:2px solid white;
		border-top:1px solid white;
	}

	.autocomplete-items div {
		padding: 10px;
		cursor: pointer;
		background-color: #34495e; 
		border-bottom: 1px dotted #d4d4d4; 
	}

	/*when hovering an item:*/
	.autocomplete-items div:hover {
		background-color: #e9e9e9; 
		color: #34495e;
	}

	/*when navigating through the items using the arrow keys:*/
	.autocomplete-active {
		background-color: DodgerBlue !important; 
		color: #ffffff; 
	}
</style>

<div class="content-wrapper">
	<div class="container-fluid"> 
		<div class="row mt-3">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<div class="card-title">
							ADD PRODUCT
							<lable class="pull-right" style="font-size:10px;"><b>(*) mendatory fields</b></lable>
						</div>
						<hr> 
						<?php if(isset($_SESSION['notify_message'])){ ?>
							<div class="notification-div alert alert-danger p-2"><?= $_SESSION['notify_message']; ?></div>
						<?php unset($_SESSION['notify_message']); }?>
						<form method="POST" action="" enctype="multipart/form-data">
							<div class="row mt-5 d-none"> 
								<div class="form-group col-md-6">
									<label for="input-1">Select Brand</label>
									<select class="form-control get_brand_id" name="brand_id">
										<option value='0'>Select</option>
										<?php if(!empty($all_active_brand)){
											foreach($all_active_brand as $brand_data){
												$get_brand_id 		= 	$brand_data['brand_id'];
												$get_select_brand_name 	= 	$brand_data['brand_name'];
												$brand_name_class 	= 	strtolower(str_replace(' ','-',$brand_data['brand_name']));
										?>
											<option value='<?= $get_brand_id; ?>' <?= ($get_brand_id==$brand_id)?'selected':''; ?> class="<?= $brand_name_class;?>"><?= $get_select_brand_name; ?></option>
										<?php } } ?> 
									</select>
									<span style="font-size:12px;">
										<lable class="pull-left mt-2 badge badge-success border border-dark border border-dark">
											<a href="#" class="text-dark add_brand hide-loader">
												<i class="fa-sharp fa-solid fa-plus"></i> ADD BRAND
											</a>
										</lable>
										<lable class="pull-right mt-2 badge badge-info border border-dark">
											<a href="<?= SITE_URL_ADMIN;?>/manage-brand.php" class="text-dark">
												<i class="fa-solid fa-list"></i> MANAGE BRAND
											</a>
										</lable>
									</span>
								</div> 
								<div class="form-group col-md-6">
									<label for="input-1">Select Category</label>
									<select class="form-control get_category_id_validation get_category_id" name="category_id" onChange="changeSubCategory(this.value)">
										<option value='0'>Select</option>
										<?php if(!empty($all_active_category)){
											foreach($all_active_category as $category_data){
												$get_category_id 	= 	$category_data['category_id'];
												$get_select_category_name 	= 	$category_data['category_name'];
										?>
											<option value='<?= $get_category_id; ?>' <?= ($get_category_id==$category_id)?'selected':''; ?> ><?= $get_select_category_name; ?></option>
										<?php } } ?> 
									</select>
									<span style="font-size:12px;">
										<lable class="pull-left mt-2 badge badge-success border border-dark">
											<a href="#" class="text-dark add_category hide-loader">
												<i class="fa-sharp fa-solid fa-plus"></i> ADD CATEGORY
											</a>
										</lable>
										<lable class="pull-right mt-2 badge badge-info border border-dark">
											<a href="<?= SITE_URL_ADMIN;?>/manage-category.php" class="text-dark">
												<i class="fa-solid fa-list"></i> MANAGE CATEGORY
											</a>
										</lable>
									</span>
								</div> 
							</div>
							<div class="row">  
								<div class="form-group add_category_div autocomplete col-md-6">
									<label for="input-1">category Name</label>
									<input type="text" class="form-control category_input" id="myInputCat" placeholder="Enter Category Name" name="category_name" value="<?= $category_name; ?>" autocomplete="OFF"/>
									<span style="font-size:12px;"> 
										<lable class="pull-right mt-2 badge badge-info border border-dark">
											<a href="<?= SITE_URL_ADMIN;?>/manage-category.php" class="text-dark">
												<i class="fa-solid fa-list"></i> MANAGE CATEGORY
											</a>
										</lable>
									</span>
								</div>
								<div class="form-group add_brand_div autocomplete col-md-6">
									<label for="input-1">Brand Name</label>
									<input type="text" class="form-control brand_input" id="myInput" placeholder="Enter Brand Name" name="brand_name" value="<?= $brand_name; ?>" autocomplete="OFF"/>
									<span style="font-size:12px;"> 
										<lable class="pull-right mt-2 badge badge-info border border-dark">
											<a href="<?= SITE_URL_ADMIN;?>/manage-brand.php" class="text-dark">
												<i class="fa-solid fa-list"></i> MANAGE BRAND
											</a>
										</lable>
									</span>
								</div> 
							</div>
							<div class="form-group">
								<label for="input-1">product Name *</label>
								<input type="text" class="form-control" id="input-1" placeholder="Enter Name" name="product_name" value="<?= $product_name; ?>" required />
							</div>
							<div class="form-group">
								<label for="input-1">product price *</label>
								<input type="number" class="form-control" id="input-1" placeholder="Enter Price" name="product_price" value="<?= $product_price; ?>" required />
							</div>
							<div class="form-group">
								<label for="input-1">product Description</label> 
								<textarea type="text" class="form-control" id="editor"  name="product_description"><?= $product_description; ?></textarea>
							</div>
							<div class="form-group">
								<label for="input-1">product Image</label> <br />
								<input type="file" name="data_image" class="form-control mb-1" onChange="filevalidation(1200,1200)" id="file-upload-size">
								<span style="font-size:10px;">Preferred image size (1200 X 1200) px</span><br />
								<?php if(!empty($data_image)){ ?> 
									<img src="<?= $data_image; ?>" class="mt-2 ml-3" style="width:60px;height:60px;"/>
								<?php } ?>
							</div>  
							<div class="form-group py-2">
								<div class="icheck-material-white">
									<input type="checkbox" id="user-checkbox1" name="is_active" value="1" <?= ($is_active)?'checked':''; ?>/>
								<label for="user-checkbox1">Is Active</label>
								</div>
							</div>
							<div class="form-group">
								<button type="submit" name="data_submit" class="btn btn-light"><i class="icon-lock"></i> Submit</button>
								<a href="<?= SITE_URL_ADMIN;?>/manage-product.php" class="btn btn-light">
									Manage product <i class="fa-solid fa-arrow-right"></i>
								</a> 
								<input type="hidden" name="product_id" value="<?= $product_id; ?>">
								<input type="hidden" name="encrypted_admin_id" value="<?= $encrypted_admin_id; ?>">
								<input type="hidden" class="category_id_val" name="category_id" value="<?= $category_id; ?>">
								<input type="hidden" class="brand_id_val" name="brand_id" value="<?= $brand_id; ?>">
							</div>
						</form>
					</div>
				</div>
			</div> 
		</div> 
		<div class="overlay toggle-menu"></div>  
	</div> 
</div> 
<a href="javaScript:void();" class="back-to-top hide-loader"><i class="fa fa-angle-double-up"></i> </a> 

<script>
	CKEDITOR.replace( 'editor' ); 
	CKEDITOR.on('instanceReady', function(e) { 
		e.editor.document.getBody().setStyle('background', '#202938');
		e.editor.document.getBody().setStyle('color', 'white');
	
	}); 
    CKEDITOR.config.removePlugins = ['pastetext','pastetools','pastefromgdocs','pastefromword','undo','about','removeformat','strike']; 
 

	function autocomplete(inp, arr, mode) {  
		var currentFocus; 
		inp.addEventListener("input", function(e) {
			var a, b, i, val = this.value; 
			closeAllLists();
			if (!val) { return false;}
			currentFocus = -1; 
			a = document.createElement("DIV");
			a.setAttribute("id", this.id + "autocomplete-list");
			a.setAttribute("class", "autocomplete-items"); 
			this.parentNode.appendChild(a); 
			for (i = 0; i < arr.length; i++) { 
				if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) { 
					b = document.createElement("DIV"); 
					b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
					b.innerHTML += arr[i].substr(val.length).split('-')[0]; 
					b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>"; 
					b.addEventListener("click", function(e) { 
						inp.value = this.getElementsByTagName("input")[0].value.split('-')[0]; 
						id = this.getElementsByTagName("input")[0].value.split('-')[1]; 
						
						if(mode == 'category'){
							$('.get_category_id').val(id);
							$('.category_id_val').val(id);
						}else{
							$('.get_brand_id').val(id);
							$('.brand_id_val').val(id);
						}
						closeAllLists();
					});
					a.appendChild(b);
				}else{
					if(mode == 'category'){
						$('.get_category_id').val(0);
						$('#myInputCatautocomplete-list').hide(); 
						$('.category_id_val').val(0);
					}else{
						$('.get_brand_id').val(0);
						$('#myInputautocomplete-list').hide(); 
						$('.brand_id_val').val(0);
					}
				}
			}
		}); 
		inp.addEventListener("keydown", function(e) {
			
			var x = document.getElementById(this.id + "autocomplete-list");
			if (x) x = x.getElementsByTagName("div");
			
			if (e.keyCode == 40) { 
				currentFocus++; 
				addActive(x);
			} else if (e.keyCode == 38) { 
				currentFocus--; 
				addActive(x);
			} else if (e.keyCode == 13) {  
				e.preventDefault();
				if (currentFocus > -1) { 
					if (x) x[currentFocus].click();
				}
			}
		});
		function addActive(x) { 
			if (!x) return false; 
			removeActive(x);
			if (currentFocus >= x.length) currentFocus = 0;
			if (currentFocus < 0) currentFocus = (x.length - 1); 
			x[currentFocus].classList.add("autocomplete-active");
		}
		function removeActive(x) { 
			for (var i = 0; i < x.length; i++) {
				x[i].classList.remove("autocomplete-active");
			}
		}
		function closeAllLists(elmnt) { 
			var x = document.getElementsByClassName("autocomplete-items");
			for (var i = 0; i < x.length; i++) {
			if (elmnt != x[i] && elmnt != inp) {
				x[i].parentNode.removeChild(x[i]);
			}
			}
		} 
		document.addEventListener("click", function (e) { 
			closeAllLists(e.target);
		});
	} 
	var get_data_brand = ['<?= $get_brand_name; ?>'];
	autocomplete(document.getElementById("myInput"), get_data_brand, 'brand');
	var get_data_category = ['<?= $get_category_name; ?>'];
	autocomplete(document.getElementById("myInputCat"), get_data_category, 'category');
</script>
<?php
	include(SITE_ROOT_ADMIN	.	"/includes/bottom.php");
?>
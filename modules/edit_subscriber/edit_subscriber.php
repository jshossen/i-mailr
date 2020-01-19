<?php
if(logged_in()){
	form_processor();
	$subs_id = $_REQUEST['id'];
	$subs_info = get_details_from_db_table('subscriber',$subs_id);
	if ($subs_info) {
		$subs_first_name = $subs_info['first_name'];
		$subs_last_name = $subs_info['last_name'];
		$subs_email = $subs_info['email'];
		$subs_phone = $subs_info['phone'];
		$custom_var = $subs_info['custom_variable'];
		if ($custom_var == NULL) {
			$custom_var = "{}";
		}
		$custom_var = json_decode($custom_var);

    include "files/dashboard/phpsection/header.php";
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"><?php echo $subs_first_name." ".$subs_last_name;?> </h1>
                    <h5><b>Email: </b><?php echo $subs_email;?> </h5>
                </div>
            </div>
            <div class="row">
            	<div class="col-sm-12">
            		<div class="panel panel-info">
                        <div class="panel-heading">
                            Update subscriber profile
                        </div>
                        <div class="panel-body">
                        	<img src="<?php echo $image_src = get_user_image_from_email($subs_email); ?>">
                        	<div class="edit_subs">
						        <form method="post" action="<?php echo BASE?>/edit_subscriber/?process=update_subscriber"> 
						        	<div class="form-group">
							            <label>First name</label>
							            <input class="form-control" placeholder="First name" name="input_first_name" value="<?php echo $subs_first_name;?>" required >
							            <label>Last name</label>
							            <input class="form-control" placeholder="Last name" name="input_last_name" value="<?php echo $subs_last_name;?>" required >
							            <label>Phone</label>
							            <input class="form-control" placeholder="phone" name="input_phone" value="<?php echo $subs_phone;?>" required>
							        </div>
							        <input type="hidden" id="subscriber_id" name="id" value="<?php echo $subs_id;?>">
							        <div class="">
								        <a type="button" href="<?php echo BASE;?>/subscribers" class="btn btn-secondary" >Cancel</a>
								        <button type="submit" class="btn btn-primary">Update</button>
								    </div>
						        </form>
						    </div>
                        </div>
                        <div class="panel-footer">
                            Panel Footer
                        </div>
                    </div>
            	</div>
            </div>
            <div class="row">
            	<div class="col-sm-12">
            		<div class="panel panel-info">
                        <div class="panel-heading">
                            Custom variable
                        </div>
                        <div class="panel-body">
                        	<div class="edit_subs">
						        <form class="form-inline">
						        	<fieldset disabled>
						        	  <div>	
									  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
									    <div class="input-group-addon">{{</div>
									    <input type="text" class="form-control" id="inlineFormInputGroup" value ="first_name">
									    <div class="input-group-addon">}}</div>
									  </div>
									  <span>=></span>
									  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="inlineFormInput" value="<?php echo $subs_first_name;?>">
									  </div>
									  <div>
									  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
									    <div class="input-group-addon">{{</div>
									    <input type="text" class="form-control" id="inlineFormInputGroup" value ="last_name">
									    <div class="input-group-addon">}}</div>
									  </div>
									  <span>=></span>
									  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="inlineFormInput" value="<?php echo $subs_last_name;?>">
									  </div>
									  <div>
									  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
									    <div class="input-group-addon">{{</div>
									    <input type="text" class="form-control" id="inlineFormInputGroup" value ="phone">
									    <div class="input-group-addon">}}</div>
									  </div>
									  <span>=></span>
									  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="inlineFormInput" value="<?php echo $subs_phone;?>">
									  </div>
									</fieldset>
									
									<div id="save_custom_variable">
									<?php 
										foreach ($custom_var as $key => $value) {
											
									?>
										<div>
										  <div class="input-group mb-2 mr-sm-2 mb-sm-0">
										    <div class="input-group-addon">{{</div>
										    <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="any_thing" value="<?php echo $key;?>">
										    <div class="input-group-addon">}}</div>
										  </div>
										  <span>=></span>
										  <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="inlineFormInput" placeholder="Some thing" value="<?php echo $value;?>">
										  <button type="button" class="btn btn-danger btn-circle" onclick="$(this).parent().remove();" title="Delete custom field"><i class="fa fa-times"></i>
	                            		  </button>
	                            		</div>
	                            	<?php 
	                            		}
	                            	?>
									</div>
								</form>
								<button type="btn" onclick="add_custom_variable_field()" class="btn btn-primary">Add new</button>
								<button type="btn" onclick="save_custom_variables()" class="btn btn-primary">Submit</button>
						    </div>
                        </div>
                        <div class="panel-footer">
                            Panel Footer
                        </div>
                    </div>
            	</div>
            </div>
		</div>
	
        <!-- /#page-wrapper -->
<?php
    include "files/dashboard/phpsection/footer.php";
	} else { please_go("error_404"); }
}else{
	please_go("sign_in");
}

function process_update_subscriber() {
	global $mysqli;
	$user_id = $_SESSION['user_id'];
	$id = $mysqli->real_escape_string($_REQUEST['id']);
	$first_name = $mysqli->real_escape_string($_REQUEST['input_first_name']);
	$last_name = $mysqli->real_escape_string($_REQUEST['input_last_name']);
	$phone = $mysqli->real_escape_string($_REQUEST['input_phone']);
	$sql = "UPDATE subscriber SET first_name = '$first_name', last_name = '$last_name', phone = '$phone', updated = '".date("Y-m-d H:i:s")."' WHERE user_id = $user_id AND id = $id";
	$pres = $mysqli->query($sql);
	
	header("Location: ".BASE."/edit_subscriber/?id=".$id);
}

function process_save_custom_variables(){
	global $mysqli;
	$user_id = $_SESSION['user_id'];
	$id = $mysqli->real_escape_string($_REQUEST['id']);
	$custom_arr = $mysqli->real_escape_string($_REQUEST['custom_arr']);

	$sql = "UPDATE subscriber SET custom_variable = '$custom_arr' WHERE user_id = $user_id AND id = $id";

	if($mysqli->query($sql)) {
		echo 1;
	} else {
		echo 0;
	}
}
?>
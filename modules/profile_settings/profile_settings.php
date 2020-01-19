<?php
if(logged_in()){
    form_processor();
    include "files/dashboard/phpsection/header.php";
    $user_id = $_SESSION['user_id'];
    global $mysqli;
    $user_meta = get_user_meta($user_id, 'profile_settings');
    $user_meta = json_decode($user_meta);

    $timezone = get_user_meta($user_id, 'user_timezone');

    $res = $mysqli->query("SELECT * FROM users WHERE id='$user_id'");
    if( $res->num_rows > 0 ) {
        $arr = $res->fetch_array( MYSQLI_ASSOC );
		$user_details = json_decode($arr['user_details']);

    } else echo "Sorry can't fetch database.";
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Profile Settings</h1>
                </div>
            </div>

           <form method="POST" action="<?php echo BASE?>/profile_settings/?process=update_profile_settings" onsubmit="return check_profile_settings();" >
                <div class="col-sm-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                        Change your settings 
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-12" style="padding: 15px;">
                            	<div class="form-group">
						            <label>Email</label>
						            <input class="form-control" name="email" disabled value="<?php echo $arr['email'];?>" >
						            <br>

						            <label>Name</label>
						            <input class="form-control" placeholder="Full name" id="input_full_name" name="input_full_name" value="<?php echo $user_details->name;?>" required > <label style="color: red;" id="name_msg"></label>
						            <br>

						            <label>Phone</label>
						            <input class="form-control" placeholder="phone" name="input_phone" value="<?php echo $user_meta->phone;?>">
						            <br>

						            <label>Company name</label>
						            <input class="form-control" placeholder="Company name" name="company_name" value="<?php echo $user_meta->company_name;?>">
						            <br>

						            <label>Company description</label>
						            <textarea class="form-control" placeholder="Company description" name="company_description" ><?php echo (trim($user_meta->company_description) != "" ? $user_meta->company_description : ""); ?></textarea>
						            <br>
						            <label>Your timezone</label>
						            <select name="timezone" class="form-control">
						            	<option selected value="0">[UTC] Western European Time, Greenwich Mean Time</option>
						            	<option <?php if ($timezone == -12) {
						            		echo "selected = 'selected'";
						            	} ?> value="-12">[UTC - 12] Baker Island Time</option>
										<option <?php if ($timezone == -11) {
						            		echo "selected = 'selected'";
						            	} ?> value="-11">[UTC - 11] Niue Time, Samoa Standard Time</option>
										<option <?php if ($timezone == -10) {
						            		echo "selected = 'selected'";
						            	} ?> value="-10">[UTC - 10] Hawaii-Aleutian Standard Time, Cook Island Time</option>
										<option <?php if ($timezone == -9.5) {
						            		echo "selected = 'selected'";
						            	} ?> value="-9.5">[UTC - 9:30] Marquesas Islands Time</option>
										<option <?php if ($timezone == -9) {
						            		echo "selected = 'selected'";
						            	} ?> value="-9">[UTC - 9] Alaska Standard Time, Gambier Island Time</option>
										<option <?php if ($timezone == -8) {
						            		echo "selected = 'selected'";
						            	} ?> value="-8">[UTC - 8] Pacific Standard Time</option>
										<option <?php if ($timezone == -7) {
						            		echo "selected = 'selected'";
						            	} ?> value="-7">[UTC - 7] Mountain Standard Time</option>
										<option <?php if ($timezone == -6) {
						            		echo "selected = 'selected'";
						            	} ?> value="-6">[UTC - 6] Central Standard Time</option>
										<option <?php if ($timezone == -5) {
						            		echo "selected = 'selected'";
						            	} ?> value="-5">[UTC - 5] Eastern Standard Time</option>
										<option <?php if ($timezone == -4.5) {
						            		echo "selected = 'selected'";
						            	} ?> value="-4.5">[UTC - 4:30] Venezuelan Standard Time</option>
										<option <?php if ($timezone == -4) {
						            		echo "selected = 'selected'";
						            	} ?> value="-4">[UTC - 4] Atlantic Standard Time</option>
										<option <?php if ($timezone == -3.5) {
						            		echo "selected = 'selected'";
						            	} ?> value="-3.5">[UTC - 3:30] Newfoundland Standard Time</option>
										<option <?php if ($timezone == -3) {
						            		echo "selected = 'selected'";
						            	} ?> value="-3">[UTC - 3] Amazon Standard Time, Central Greenland Time</option>
										<option <?php if ($timezone == -2) {
						            		echo "selected = 'selected'";
						            	} ?> value="-2">[UTC - 2] Fernando de Noronha Time, South Georgia &amp; the South Sandwich Islands Time</option>
										<option <?php if ($timezone == -1) {
						            		echo "selected = 'selected'";
						            	} ?> value="-1">[UTC - 1] Azores Standard Time, Cape Verde Time, Eastern Greenland Time</option>
										<option <?php if ($timezone == 0) {
						            		echo "selected = 'selected'";
						            	} ?> value="0">[UTC] Western European Time, Greenwich Mean Time</option>
										<option <?php if ($timezone == 1) {
						            		echo "selected = 'selected'";
						            	} ?> value="1">[UTC + 1] Central European Time, West African Time</option>
										<option <?php if ($timezone == 2) {
						            		echo "selected = 'selected'";
						            	} ?> value="2">[UTC + 2] Eastern European Time, Central African Time</option>
										<option <?php if ($timezone == 3) {
						            		echo "selected = 'selected'";
						            	} ?> value="3">[UTC + 3] Moscow Standard Time, Eastern African Time</option>
										<option <?php if ($timezone == 3.5) {
						            		echo "selected = 'selected'";
						            	} ?> value="3.5">[UTC + 3:30] Iran Standard Time</option>
										<option <?php if ($timezone == 4) {
						            		echo "selected = 'selected'";
						            	} ?> value="4">[UTC + 4] Gulf Standard Time, Samara Standard Time</option>
										<option <?php if ($timezone == 4.5) {
						            		echo "selected = 'selected'";
						            	} ?> value="4.5">[UTC + 4:30] Afghanistan Time</option>
										<option <?php if ($timezone == 5) {
						            		echo "selected = 'selected'";
						            	} ?> value="5">[UTC + 5] Pakistan Standard Time, Yekaterinburg Standard Time</option>
										<option <?php if ($timezone == 5.5) {
						            		echo "selected = 'selected'";
						            	} ?> value="5.5">[UTC + 5:30] Indian Standard Time, Sri Lanka Time</option>
										<option <?php if ($timezone == 5.75) {
						            		echo "selected = 'selected'";
						            	} ?> value="5.75">[UTC + 5:45] Nepal Time</option>
										<option <?php if ($timezone == 6) {
						            		echo "selected = 'selected'";
						            	} ?> value="6">[UTC + 6] Bangladesh Time, Bhutan Time, Novosibirsk Standard Time</option>
										<option <?php if ($timezone == 6.5) {
						            		echo "selected = 'selected'";
						            	} ?> value="6.5">[UTC + 6:30] Cocos Islands Time, Myanmar Time</option>
										<option <?php if ($timezone == 7) {
						            		echo "selected = 'selected'";
						            	} ?> value="7">[UTC + 7] Indochina Time, Krasnoyarsk Standard Time</option>
										<option <?php if ($timezone == 8) {
						            		echo "selected = 'selected'";
						            	} ?> value="8">[UTC + 8] Chinese Standard Time, Australian Western Standard Time, Irkutsk Standard Time</option>
										<option <?php if ($timezone == 8.75) {
						            		echo "selected = 'selected'";
						            	} ?> value="8.75">[UTC + 8:45] Southeastern Western Australia Standard Time</option>
										<option <?php if ($timezone == 9) {
						            		echo "selected = 'selected'";
						            	} ?> value="9">[UTC + 9] Japan Standard Time, Korea Standard Time, Chita Standard Time</option>
										<option <?php if ($timezone == 9.5) {
						            		echo "selected = 'selected'";
						            	} ?> value="9.5">[UTC + 9:30] Australian Central Standard Time</option>
										<option <?php if ($timezone == 10) {
						            		echo "selected = 'selected'";
						            	} ?> value="10">[UTC + 10] Australian Eastern Standard Time, Vladivostok Standard Time</option>
										<option <?php if ($timezone == 10.5) {
						            		echo "selected = 'selected'";
						            	} ?> value="10.5">[UTC + 10:30] Lord Howe Standard Time</option>
										<option <?php if ($timezone == 11) {
						            		echo "selected = 'selected'";
						            	} ?> value="11">[UTC + 11] Solomon Island Time, Magadan Standard Time</option>
										<option <?php if ($timezone == 11.30) {
						            		echo "selected = 'selected'";
						            	} ?> value="11.5">[UTC + 11:30] Norfolk Island Time</option>
										<option <?php if ($timezone == 12) {
						            		echo "selected = 'selected'";
						            	} ?> value="12">[UTC + 12] New Zealand Time, Fiji Time, Kamchatka Standard Time</option>
										<option <?php if ($timezone == 12.75) {
						            		echo "selected = 'selected'";
						            	} ?> value="12.75">[UTC + 12:45] Chatham Islands Time</option>
										<option <?php if ($timezone == 13) {
						            		echo "selected = 'selected'";
						            	} ?> value="13">[UTC + 13] Tonga Time, Phoenix Islands Time</option>
										<option <?php if ($timezone == 14) {
						            		echo "selected = 'selected'";
						            	} ?> value="14">[UTC + 14] Line Island Time</option>

						            </select>
						            <br>
						            <label>New password</label>
						            <input class="form-control" placeholder="New password" id="new_password" name="new_password" value="" type="password">
						            <label style="color: red;" id="pass_msg"></label>
						            <br> 

						            <label>Confirm password</label>
						            <input class="form-control" placeholder="Confirm password" name="confirm_password" id="confirm_password" value="" type="password">

						            
							    </div>

								<div class="form-group">
									<button class="btn btn-primary " name="submit" type="submit">Update</button>
								</div>
                            </div>
                        </div>

                        <div class="panel-footer">
                            Panel Footer
                        </div>
                    </div>
                </div>

           </form>

        </div>
   	<script type="text/javascript">
   		function check_profile_settings() {
		    
		    document.getElementById("name_msg").innerHTML = "";
		    document.getElementById("pass_msg").innerHTML = "";
		    var name = $('#input_full_name').val();
		    name = name.trim();
		    name = name.replace(/\s\s+/g, ' ');
		    if (name == "") {
		        document.getElementById("name_msg").innerHTML = "Please enter valid name.";
		        return false;
		    }
		    
		    var password = $('#new_password').val();
		    var password_confirm = $('#confirm_password').val();

		    if (password != password_confirm) {
		        document.getElementById("pass_msg").innerHTML = "Password is not match.";
		        return false;
		    }
		    return true;
		}
   	</script>
<?php
    include "files/dashboard/phpsection/footer.php";
}else{
    please_go("sign_in");
}

	function process_update_profile_settings() {
		$user_id = $_SESSION['user_id'];
		if($_SESSION['user_info']['status'] != -1){
			global $mysqli;
			$name = $mysqli->real_escape_string($_REQUEST['input_full_name']);
		    $user_details = array("name"=>$name);
		    $user_details = json_encode($user_details);
		    $phone = $mysqli->real_escape_string($_REQUEST['input_phone']);
		    $company_name = $mysqli->real_escape_string($_REQUEST['company_name']);
		    $company_description = $mysqli->real_escape_string($_REQUEST['company_description']);
		    $timezone = $mysqli->real_escape_string($_REQUEST['timezone']);
		    $psw = $mysqli->real_escape_string($_REQUEST['new_password']);
		    $psw_repeat = $mysqli->real_escape_string($_REQUEST['confirm_password']);

		    if($psw == ""){
		        $sql = "SELECT id FROM users WHERE id = '$user_id' LIMIT 1";
		        $pres = $mysqli->query($sql);
		        if($pres->num_rows > 0){
		            $sql = "UPDATE users SET user_details = '$user_details' WHERE id = '$user_id'";
		            $pres = $mysqli->query($sql);
		        } 
		    } 

		    if($psw != "") {
		    	$sql = "SELECT password FROM users WHERE id = '$user_id' LIMIT 1";
		        $pres = $mysqli->query($sql);
		        if($pres->num_rows > 0) {
		            $sql = "UPDATE users SET password = '". md5($psw)."' WHERE id = '$user_id'";
		            $pres = $mysqli->query($sql);
		        } 
		    }

		    if($phone != "" || $company_name != "" || $company_description != "") {
		    	$profile_settings = array("phone"=>$phone, "company_name"=>$company_name, "company_description"=>$company_description);
		        $profile_settings = json_encode($profile_settings);
		        add_user_meta($user_id, 'profile_settings', $profile_settings);
		    }

		    if ($timezone != "") {
		    	add_user_meta($user_id, 'user_timezone', $timezone);
		    }
		    set_default_value($user_id);
		}
		
	    please_go('profile_settings');
	}

?>

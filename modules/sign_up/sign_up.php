<?php
form_processor();
if(!logged_in()) {
	
    include "files/home/phpsection/header.php";
?>
<div class="container">
    <div class="jumbotron box_shadow">
        <form id="sign_up_form" class="form-horizontal" role="form" method="POST" action="<?php echo BASE?>/sign_up/?process=add_new_user_email" onsubmit="return check_sign_up();">
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h2>Register New User</h2>
                    <p>Please register It's free and always will be.</p>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 field-label-responsive">
                    <label for="name">Name</label>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <input type="text" name="name" class="form-control" id="name"
                                   placeholder="Jon Snow" required autofocus>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-control-feedback">
                            <span class="text-danger align-middle" id="name_msg">
                                <!-- Put name validation error messages here -->
                            </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 field-label-responsive">
                    <label for="email">E-Mail Address</label>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <input type="email" name="email" class="form-control" id="email"
                                   placeholder="you@example.com" required autofocus >
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-control-feedback">
                            <span class="text-danger align-middle" id="email_msg">
                                <?php
                                    if(isset($_REQUEST['error'])){
                                        if($_REQUEST['error'] == 'email'){
                                            echo "Email already exist!!!";
                                        }
                                    }
                                ?>
                            </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 field-label-responsive">
                    <label for="password">Password</label>
                </div>
                <div class="col-md-6">
                    <div class="form-group has-danger">
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <input type="password" name="password" class="form-control" id="password"
                                   placeholder="Password" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 field-label-responsive">
                    <label for="password">Confirm Password</label>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                            <input type="password" name="password-confirmation" class="form-control"
                                   id="password_confirm" placeholder="Password" required>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-control-feedback">
                            <span class="text-danger align-middle" id="pass_msg">
                                <!-- Put e-mail validation error messages here -->
                            </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <button type="submit" class="btn btn-success"><i class="fa fa-user-plus"></i> Register</button>
                </div>
            </div>
        </form>
        <?php include "files/home/phpsection/social_login.php"; ?>
    </div>
</div>
<?php
    include "files/home/phpsection/footer.php";
}
else {
    please_go("dashboard");
}
function process_add_new_user_email(){
    global $mysqli;
    $name = $_REQUEST['name'];
    $email = $_REQUEST['email'];
    $psw = $_REQUEST['password'];
    $psw_repeat = $_REQUEST['password-confirmation'];
    $user_details = array("name"=>$name);
    
    if($psw == $psw_repeat){
        $sql = "SELECT id FROM users WHERE email = '$email' LIMIT 1";
        $pres = $mysqli->query($sql);
        if($pres->num_rows > 0){
            header('Location:'.BASE."/sign_up/?error=email");
        }else{
            $sql = "INSERT INTO users ( joining_date, email, password ,user_details, status ) VALUES ('" . date("Y-m-d") . "', '" . $email . "', '" . md5($psw) . "', '" . json_encode($user_details) . "', '" . 1 . "')";
            $pres = $mysqli->query($sql);
            if($pres){
                please_go('sign_in');
            }
        }
    }
}

function process_add_facebook_user() {
    global $mysqli;
    $user_email = $_REQUEST['email'];
    $fb_id = $_REQUEST['id'];
    $user_details = $_REQUEST['user_details'];
    $user_details = $mysqli->real_escape_string($user_details);
    $sql = "SELECT facebook FROM users WHERE facebook = '$fb_id'";
    $pres = $mysqli->query($sql);
    $flag = false;
    if ($pres) {
        if ($pres->num_rows > 0) {
            $sql = "UPDATE users SET email = '$user_email',user_details = '$user_details' WHERE facebook = '$fb_id'";
            $flag = true; 
        }
    }
    if (!$flag) {
        $email_sql = "SELECT email FROM users WHERE email='$user_email'";
        $pres = $mysqli->query($email_sql);
        if ($pres) {
            if ($pres->num_rows > 0) {
                $sql = "UPDATE users SET facebook = '$fb_id' WHERE email = '$user_email'";
            }else {
                $sql = "INSERT INTO users(email, user_details, joining_date, facebook, status) VALUES('$user_email', '$user_details', '".date("Y-m-d H:i:s")."', '$fb_id', 1)";
            }
        }
        
    }

    $pres = $mysqli->query($sql);
    if ($pres) {
        $sql = "SELECT id FROM users WHERE facebook = '$fb_id'";
        $res = $mysqli->query($sql);
        $arr = $res->fetch_array( MYSQLI_ASSOC );
        set_default_value($arr['id']);
        echo "true";
    }else {
        echo "false";
    }
}

?>
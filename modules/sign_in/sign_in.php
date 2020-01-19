<?php
if(!logged_in()){
    form_processor();
    include "files/home/phpsection/header.php";
    if(!isset($_REQUEST['forgot'])){
?>
        <div class="container">
            <div class="jumbotron box_shadow">
                <form class="form-horizontal" role="form" method="POST" action="<?php echo BASE?>/sign_in/?process=login_this_email">
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <h2>Log in</h2>
                            <p>Welcome, please log in.</p>
                            <hr>
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
                                    <span class="text-danger align-middle">
                                        <!-- Put e-mail validation error messages here -->
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
                    <?php 
                        if (isset($_REQUEST['status'])) {
                            if ($_REQUEST['status'] == "error") {
                     ?>
                     <div class="row">
                        <div class="col-md-3 field-label-responsive">
                            
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-control-feedback">
                                    <span class="text-danger align-middle" id="psw_msg">
                                        <p>Email or password incorrect!!</p>
                                    </span>
                            </div>
                        </div>
                    </div>   

                    <?php }} ?>
                    <div class="row">
                        <div class="col-md-3"></div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-success"><i class="fa fa-user-plus"></i> Login</button>
                            <a href="<?php echo BASE; ?>/sign_in/?forgot=yes" class="btn btn-link" style="color: blue;"> forgot password?</a>
                        </div>
                    </div>
                </form>
                <?php include "files/home/phpsection/social_login.php"; ?>
            </div>
        </div>
<?php
    }else{
?>
        <div class="container" style="padding-top: 80px;">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                      <div class="panel-body" style="max-width: 500px; margin: 0 auto; float: none; ">
                        <div class="text-center" style="background-image: url('<?php echo BASE; ?>/files/images/Password-Recovery.jpg'); background-position: center center; background-repeat: no-repeat; background-size: auto; opacity: 0.6;">
                          <h3><i class="fa fa-lock fa-4x"></i></h3>
                          <h2 class="text-center">Forgot Password?</h2>
                          <p>You can reset your password here.</p>
                          <div class="panel-body">
            
                            <form role="form" autocomplete="off" class="form" method="post" onsubmit="return get_valid_email_for_reset_pass()">
            
                              <div class="form-group">
                                <div class="input-group">
                                  <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                                  <input id="email" name="email" placeholder="email address" class="form-control"  type="email">
                                </div>
                              </div>
                              <div class="form-group">
                                <input name="recover-submit" class="btn btn-lg btn-primary btn-block" type="submit">
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
            </div>
        </div>
        <script type="text/javascript">
            function get_valid_email_for_reset_pass(){
                var email = $("#email")[0].value;

                if(!validateEmail(email)){
                    alert("Email incorrect!!!");
                    return false;
                }else{
                    var data='email='+email;
                    http_post_request( base + '/sign_in/?process=check_email_availability',data,'check_email_availability_done');
                }

                return false;
            }

            function check_email_availability_done(res){
                console.log(res);
                if (res == '1') {
                    alert("Email success");
                }else{
                    alert("Email incorrect!!!");
                    return false;
                }
            }
        </script>
<?php
    }
    include "files/home/phpsection/footer.php";
}else {
    please_go("dashboard");
}

function process_login_this_email(){
    global $mysqli;
    $email = $_REQUEST['email'];
    $psw = $_REQUEST['password'];
    $res = $mysqli->query("SELECT id,password FROM users WHERE email = '$email'");
    $arr = $res->fetch_array( MYSQLI_ASSOC );

    if($arr["password"] == md5($psw)){
        set_default_value($arr['id']);
        header("location:".BASE."/dashboard");
    }else{
        header("location:".BASE."/sign_in/?status=error");
    }
}

function process_check_email_availability(){
    global $mysqli;
    $email = $_REQUEST['email'];
    $pres = $mysqli->query("SELECT id,user_details FROM users WHERE email = '$email'");
    if($pres->num_rows == 1){
        $arr = $pres->fetch_array( MYSQLI_ASSOC );
        $user_id = $arr['id'];
        $token = bin2hex(uniqid());
        add_user_meta($user_id,"password_reset_token", $token);
        send_password_request_email($email,$token);
    }else{
        echo "0";
    }
}

function send_password_request_email($email,$token){
    $to = $email;
    $subject = "I-Mailr - Password request";

    $header = "From:contact@i-mailr.com \r\n";
    $header .= "MIME-Version: 1.0\r\n";
    $header .= "Content-type: text/html\r\n";

    $new_password_req_url = BASE."/create_new_pass/?token=".$token."&email=".$email;
    $variable_arr = array("{{email}}"=>$email,"{{new_password_req_url}}"=>$new_password_req_url);

    $body_url = "https://i-mailr.com/preview/?page=729/password-request";
    $html_data = get_curl_data($body_url);
    foreach ($variable_arr as $key => $value) {
        $html_data = str_replace($key,$value,$html_data);
    }
    $retval = mail($to,$subject,$html_data,$header);

    if( $retval == true ) {
        echo "1";
        //header("Location: ".BASE."/contact/?success=true");
    }else {
        echo "Message could not be sent...";
    }       
}
?>
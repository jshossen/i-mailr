<?php
if(!logged_in()){
    form_processor();
    include "files/home/phpsection/header.php";
?>
    <div class="container" style="padding-top: 80px;">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                  <div class="panel-body" style="max-width: 500px; margin: 0 auto; float: none;">
                    <div class="text-center">
                      <h3><i class="fa fa-lock fa-4x"></i></h3>
                      <h2 class="text-center">Create new password</h2>
                      <p>You can reset your password here.</p>
                      <div class="panel-body">
        
                        <form role="form" autocomplete="off" class="form" method="post" action="<?php echo BASE?>/create_new_pass/?process=update_new_pass" onsubmit="//return check_sign_up();">
        
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                              <input id="email" name="email" placeholder="email address" value="<?php echo $_REQUEST['email']; ?>" class="form-control"  type="email">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                              <input id="password1" name="password1" placeholder="New password" class="form-control"  type="password">
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="input-group">
                              <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                              <input id="password2" name="password2" placeholder="Confirm password" class="form-control"  type="password">
                            </div>
                          </div>
                          <input type="hidden" name="token" value="<?php echo $_REQUEST['token']; ?>">
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
<?php
    include "files/home/phpsection/footer.php";
}else {
    please_go("dashboard");
}
function process_update_new_pass(){
    global $mysqli;
    $email = $_REQUEST['email'];
    $token = $_REQUEST['token'];
    $password1 = $_REQUEST['password1'];
    $password2 = $_REQUEST['password2'];
    if($password1 != $password2 && $password1 != ""){
        echo "Wrong password.";
        die();
    }else{
        $password = $password1;
        $pres = $mysqli->query("SELECT id FROM users WHERE email = '$email' LIMIT 1");
        if($pres->num_rows == 1){
            $arr = $pres->fetch_array( MYSQLI_ASSOC );
            $user_id = $arr['id'];
            if($token == get_user_meta($user_id,"password_reset_token") ){
                $sql = "UPDATE users SET password = '".md5($password)."' WHERE email = '$email'";
                $mysqli->query($sql);
                please_go("sign_in");
            }else{
                echo "wrong token";
                die();
            }
        }else{
            echo "wrong email";
            die();
        }
    }

}
?>
<?php
if(logged_in()){
    form_processor();
    include "files/dashboard/phpsection/header.php";
    $user_id = $_SESSION['user_id'];
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">OAuth Settings</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                        Mail settings
                        </div>
                        <div class="panel-body">
                            <div class="col-sm-12" style="padding: 15px; border-bottom: 2px solid #c7b7b736">
                                <img src="<?php echo BASE; ?>/files/images/Gmail_logo.png" style="height: 100px;">
                                <h4>Gmail - <?php echo get_user_meta($user_id, 'google_gmail_address'); ?></h4>
                                <?php
                                    $google_refresh_token = get_user_meta($user_id, 'google_refresh_token');
                                    if ($google_refresh_token != "") {
                                ?>
                                    <a class="btn btn-danger btn-social btn-google-plus" href="<?php echo BASE; ?>/includes/mail_auth/index.php?provider=Google"> 
                                        <i class="fa fa-google-plus"></i> Disconnect
                                    </a>
                                <?php
                                    }
                                    else {
                                ?>
                                    <a class="btn btn-info btn-social btn-google-plus" href="<?php echo BASE; ?>/includes/mail_auth/index.php?provider=Google"> 
                                        <i class="fa fa-google-plus"></i> Connect
                                    </a>
                                <?php
                                    }
                                ?>           
                            </div>

                            <div class="col-sm-12 hide" style="padding: 15px; border-bottom: 2px solid #c7b7b736">
                                <h4>Yahoo - <?php echo get_user_meta($user_id, 'yahoo_mail_address'); ?></h4>
                                <?php
                                    $yahoo_mail_token = get_user_meta($user_id, 'yahoo_mail_token');
                                    if ($yahoo_mail_token != "") {
                                ?>
                                    <a class="btn btn-danger btn-social btn-google-plus" href="<?php echo BASE; ?>/includes/mail_auth/index.php?provider=Yahoo"> 
                                        <i class="fa fa-yahoo"></i> Disconnect
                                    </a>
                                <?php
                                    }
                                    else {
                                ?>
                                    <a class="btn btn-info btn-social btn-google-plus" href="<?php echo BASE; ?>/includes/mail_auth/index.php?provider=Yahoo"> 
                                        <i class="fa fa-yahoo"></i> Connect
                                    </a>
                                <?php
                                    }
                                ?>           
                            </div>

                            <div class="col-sm-12 hide" style="padding: 15px; border-bottom: 2px solid #c7b7b736">
                                <h4>Microsoft - <?php echo get_user_meta($user_id, 'microsoft_mail_address'); ?></h4>
                                <?php
                                    $microsoft_mail_token = get_user_meta($user_id, 'microsoft_mail_token');
                                    if ($microsoft_mail_token != "") {
                                ?>
                                    <a class="btn btn-danger btn-social btn-google-plus" href="<?php echo BASE; ?>/includes/mail_auth/index.php?provider=Microsoft"> 
                                        <i class="fa fa-yahoo"></i> Disconnect
                                    </a>
                                <?php
                                    }
                                    else {
                                ?>
                                    <a class="btn btn-info btn-social btn-google-plus" href="<?php echo BASE; ?>/includes/mail_auth/index.php?provider=Microsoft"> 
                                        <i class="fa fa-yahoo"></i> Connect
                                    </a>
                                <?php
                                    }
                                ?>           
                            </div>
                            <div class="col-sm-12" style="padding: 15px;border-bottom: 2px solid #c7b7b736;">
                                <img src="<?php echo BASE; ?>/files/images/mailclient.png" style="height: 100px;">
                                <h4>Mail Client Manual Settings - <?php echo get_user_meta($user_id,"email_host_user_name"); ?></h4>
                                <form method="POST" action="<?php echo BASE?>/auth_settings/?process=add_custom_email_host_settings">
                                    <div class="form-group">
                                        <p>Give your email host name. <b>Example:</b> mail.i-mailr.com</p>
                                        <input class="form-control" name="email_host_name" id="email_host_name" placeholder="Your email host name" value="<?php echo get_user_meta($user_id,"email_host_name"); ?>">
                                    </div>
                                    <div class="form-group">
                                        <p>Give your name. <b>Example:</b> Jhon Doe</p>
                                        <input class="form-control" name="email_host_full_name" id="email_host_full_name" placeholder="Your name" value="<?php echo get_user_meta($user_id,"email_host_full_name"); ?>">
                                    </div>
                                    <div class="form-group">
                                        <p>Give your email. <b>Example:</b> contact@i-mailr.com</p>
                                        <input class="form-control" name="email_host_user_name" id="email_host_user_name" placeholder="Your email" value="<?php echo get_user_meta($user_id,"email_host_user_name"); ?>">
                                    </div>
                                    <div class="form-group">
                                        <p>Give your email password.</p>
                                        <input type="password" class="form-control" name="email_host_password" id="email_host_password" placeholder="Your email password" value="<?php echo get_user_meta($user_id,"email_host_password"); ?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>

                            <div class="col-sm-12" style="padding: 15px;border-bottom: 2px solid #c7b7b736;">
                                <img src="<?php echo BASE; ?>/files/images/mailgun.png" style="height: 100px;">

                                <h4>Mailgun: Transactional Email API Service</h4>

                                <form method="POST" action="<?php echo BASE?>/auth_settings/?process=add_mailgun_settings">
                                    <div class="form-group">
                                        <p>Give your email. <b>Example:</b> jshossen01@gmail.com</p>
                                        <input class="form-control" name="mailgun_email" id="mailgun_email" placeholder="Your email" value="<?php echo get_user_meta($user_id,"mailgun_email"); ?>">
                                    </div>
                                    <div class="form-group">
                                        <p>Give your name. <b>Example:</b> Jhon Doe</p>
                                        <input class="form-control" name="mailgun_full_name" id="mailgun_full_name" placeholder="Your name" value="<?php echo get_user_meta($user_id,"mailgun_full_name"); ?>">
                                    </div>
                                    <div class="form-group">
                                        <p>Give your mailgun domain name. <b>Example:</b> XXXXXXXXXXXXXXXXXX4b19b53f7db.mailgun.org</p>
                                        <input class="form-control" name="mailgun_domain" id="mailgun_domain" placeholder="Your mailgun domain name" value="<?php echo get_user_meta($user_id,"mailgun_domain"); ?>">
                                    </div>
                                    <div class="form-group">
                                        <p>Give your mailgun API Key. <b>Example:</b> key-46b849f93e7edc727bXXXXXXXXXXXX</p>
                                        <input class="form-control" name="mailgun_api_key" id="mailgun_api_key" placeholder="Your mailgun API key" value="<?php echo get_user_meta($user_id,"mailgun_api_key"); ?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
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
                        Webhook settings
                        </div>
                        <div class="panel-body">
                            <div class="col-md-6" style="padding: 15px;">
                                <img src="<?php echo BASE; ?>/files/images/api.png" style="height: 100px;">
                                <p><b>Your api_key:</b> <?php echo get_user_meta($user_id,"user_secret"); ?> <a class="btn" href="<?php echo BASE; ?>/auth_settings/?process=change_api_key">Change</a></p>
                                <b>Step 1:</b><br>
                                a. Go: <a type="button" href="<?php echo BASE; ?>/api" class="btn">Make i-mailr api file</a>
                                <br>
                                b. <a type="button" href="<?php echo BASE; ?>/auth_settings/?process=download_wh_file" class="btn btn-default">Download this file</a>   filename.php
                                <br>
                                <b>Step 2:</b>
                                <p>Upload those files to your same directory on server.</p>
                                <b>Step 3:</b><br>
                                <form method="POST" action="<?php echo BASE?>/auth_settings/?process=add_wh_file_location" onsubmit="return add_wh_file_location(this,event);">
                                    <div class="form-group">
                                        <p>Give your uploaded file location.</p>
                                        <p><b>Example:</b> https://www.yourdomain.com/mydir/filename.php</p>
                                        <input class="form-control" name="wh_file_location" id="wh_file_location" placeholder="Your file location here..." value="https://<?php echo get_user_meta($user_id,"wh_file_location"); ?>">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
                            </div>

                            <div class="col-md-6" style="padding: 15px;">
                                <h1>Embed our editor into your site</h1>
                                <br>
                                <b>Step 1:</b><br>
                                <form method="POST" action="<?php echo BASE?>/auth_settings/?process=add_domain" onsubmit="return add_wh_file_location(this,event);">
                                    <div class="form-group">
                                        <p>Give your domain name.</p>
                                        <p><b>Example:</b> yourdomain.com if localhost then put only localhost</p>
                                        <input class="form-control" name="embed_domain" placeholder="Your domain name" value="<?php echo get_user_meta($user_id,"embed_domain"); ?>">
                                    </div>
                                    
                                <b>Step 2:</b><br>
   
                                Copy lower code into your site.
<pre>
<textarea disabled="true" style="border: none; background-color: #f4f5f4; width: 100%; height: 300px;">

<style>.embed-container { position: relative; padding-bottom: 56.25%; height: 0; overflow: hidden; max-width: 100%; } .embed-container iframe, .embed-container object, .embed-container embed { position: absolute; top: 0; left: 0; width: 100%; height: 100%; }</style>
<div class="embed-container">
    <iframe src="<?php echo BASE; ?>/editor/?page={{YOUR_PAGE_ID}}&embed=true&api_key=<?php echo get_user_meta($user_id,"user_secret"); ?>&user_id=<?php echo $user_id; ?>" frameborder="0" allowfullscreen></iframe>
</div>
<script type="text/javascript">
    function instant_html_editor(res) {
    console.log(res);
}
</script>

</textarea>
</pre>

                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>



                            </div>
                        </div>
                        <div class="panel-footer">
                            Panel Footer
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function add_wh_file_location(me,e){
                $("#wh_file_location")[0].value = ($("#wh_file_location")[0].value).replace("https://", "");
                $("#wh_file_location")[0].value = ($("#wh_file_location")[0].value).replace("http://", "");
                return true;
            }
        </script>
<?php
    include "files/dashboard/phpsection/footer.php";
}else{
    please_go("sign_in");
}

function process_add_wh_file_location(){
    $user_id = $_SESSION['user_id'];
    add_user_meta($user_id,"wh_file_location",$_REQUEST['wh_file_location']);
    please_go("auth_settings");
}

function process_add_domain(){
    $user_id = $_SESSION['user_id'];
    add_user_meta($user_id,"embed_domain",$_REQUEST['embed_domain']);
    please_go("auth_settings");
}

function process_add_custom_email_host_settings(){
    $user_id = $_SESSION['user_id'];
    add_user_meta($user_id,"email_host_name",$_REQUEST['email_host_name']);
    add_user_meta($user_id,"email_host_full_name",$_REQUEST['email_host_full_name']);
    add_user_meta($user_id,"email_host_user_name",$_REQUEST['email_host_user_name']);
    add_user_meta($user_id,"email_host_password",$_REQUEST['email_host_password']);
    please_go("auth_settings");
}

function process_add_mailgun_settings(){
    $user_id = $_SESSION['user_id'];
    add_user_meta($user_id,"mailgun_email",$_REQUEST['mailgun_email']);
    add_user_meta($user_id,"mailgun_full_name",$_REQUEST['mailgun_full_name']);
    add_user_meta($user_id,"mailgun_domain",$_REQUEST['mailgun_domain']);
    add_user_meta($user_id,"mailgun_api_key",$_REQUEST['mailgun_api_key']);
    please_go("auth_settings");
}

function process_download_wh_file(){
    header('Content-disposition: attachment; filename=filename.php');
    header('Content-type: text/plain');
    $user_id = $_SESSION['user_id'];
    $user_secret = get_user_meta($user_id,"user_secret");

    if($user_secret == ""){
        $user_secret = implode('-', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
        add_user_meta($user_id,"user_secret",$user_secret);
    }
    echo '<?php
        $api_base_url = "'.BASE.'/wh";
        $user_id = '.$user_id.';
        $api_key = "'.$user_secret.'";
        $page_id = $_REQUEST["page"];
        include_once("instant_mailr.php");
        $im = new Instant_Mailr($user_id, $api_base_url, $api_key);

        $page = $im->call(\'GET\', \'page/\'.$page_id);
        echo $page[\'html\'];
    ?>';
}
function process_download_api_file(){
    $file = BASE.'/includes/instant_mailr.php';
    ob_end_clean();
    header("Content-Type: application/octet-stream; "); 
    header("Content-Transfer-Encoding: binary"); 
    header("Content-Length: ". filesize($file).";"); 
    header("Content-disposition: attachment; filename=" . $file);
    readfile($file);
    die();
}

function process_change_api_key(){
    $user_id = $_SESSION['user_id'];
    $user_secret = implode('-', str_split(substr(strtolower(md5(microtime().rand(1000, 9999))), 0, 30), 6));
    add_user_meta($user_id,"user_secret",$user_secret);
    please_go("auth_settings");
}
?>
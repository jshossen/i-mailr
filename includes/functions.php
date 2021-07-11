<?php
//Import PHPMailer classes into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\OAuth;
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\Exception;

// Alias the League Google OAuth2 provider class
use League\OAuth2\Client\Provider\Google;
function heading()
{    
    module_include("header");
}

function footing()
{
    module_include("footer");
}

function logged_in()
{
    // set_default_value(27);
    if(isset($_SESSION['auth_user']))
    {
        if($_SESSION['auth_user']){
            return 1;
        }else{
            return 0;
        }
    }
    else return 0;
}

function db_connect()
{
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    if ($mysqli->connect_errno) {
        echo "Failed to connect to MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
    }
    return $mysqli;
}

function module_include($module)
{
    if(file_exists("modules/".$module."/".$module.".php")) include("modules/".$module."/".$module.".php");
}

function form_processor()
{
    if(isset($_REQUEST['process']))
    {
        $func="process_".$_REQUEST['process'];
        $func();
        die();
    }
}

function please_go($module){
    header("Location:".BASE."/".$module);
}

function set_default_value($user_id){
    $_SESSION['auth_user'] = true;
    $_SESSION['user_id'] = $user_id;
    global $mysqli;
    $sql = "SELECT email,user_details,status FROM users WHERE id=$user_id";
    $res = $mysqli->query($sql);
    if( $res->num_rows > 0 ) {
        $arr = $res->fetch_array( MYSQLI_ASSOC );
        $_SESSION['user_info'] = $arr;
        $rule = array(array("status"=>-1,"page"=>2,"subscriber"=>2),array("status"=>0,"page"=>6,"subscriber"=>100),array("status"=>1,"page"=>10,"subscriber"=>400),array("status"=>2,"page"=>40,"subscriber"=>1000),array("status"=>3,"page"=>100,"subscriber"=>2000));
        foreach ($rule as $key => $value) {
            if($value['status'] == $arr['status']){
                $_SESSION['rule'] = $value;
            }
        }
        
    }else{
        $_SESSION['user_info'] = "{}";
    }
}




function add_page_meta( $page_id, $meta_name, $value ) {
    global $mysqli;
    $res = $mysqli->query("SELECT id FROM pages_meta WHERE meta_name='$meta_name' AND page_id='$page_id'");
    if( $res->num_rows > 0 ) {
        $arr = $res->fetch_array( MYSQLI_ASSOC );
        $mysqli->query("UPDATE pages_meta SET meta_value='" . $mysqli->real_escape_string( $value ) . "' WHERE id='" . $arr['id'] . "'");
    } else $mysqli->query("INSERT INTO pages_meta (page_id, meta_name, meta_value) VALUES ('" . $page_id . "', '" . $mysqli->real_escape_string( $meta_name ) . "', '" . $mysqli->real_escape_string( $value ) . "')");
    return true;
}

function add_user_meta( $user_id, $meta_name, $value ) {
    global $mysqli;

    $res = $mysqli->query("SELECT id FROM users_meta WHERE meta_name='$meta_name' AND user_id='$user_id'");
    if( $res->num_rows > 0 ) {
        $arr = $res->fetch_array( MYSQLI_ASSOC );
        $mysqli->query("UPDATE users_meta SET meta_value='" . $mysqli->real_escape_string( $value ) . "' WHERE id='" . $arr['id'] . "'");
    } else $mysqli->query("INSERT INTO users_meta (user_id, meta_name, meta_value) VALUES ('" . $user_id . "', '" . $mysqli->real_escape_string( $meta_name ) . "', '" . $mysqli->real_escape_string( $value ) . "')");
    return true;
}

function add_uploads_meta( $shop_id, $type, $url ) {
    global $mysqli;
   $mysqli->query("INSERT INTO uploads (shop_id, type, url, upload_date, status) VALUES ('" . $shop_id . "', '" . $mysqli->real_escape_string( $type ) . "', '" . $mysqli->real_escape_string( $url ) . "', '" . $mysqli->real_escape_string( date("Y-m-d H:i:s") ) . "', '0')");
    return true;
}

function delete_uploads_meta( $f_id ) {
    global $mysqli;
    $res = $mysqli->query("DELETE FROM uploads WHERE id='$f_id'");
    return true;
}
    
function delete_page_meta( $page_id, $meta_name ) {
    global $mysqli;
    $res = $mysqli->query("DELETE FROM pages_meta WHERE page_id='$page_id' AND meta_name='" . $mysqli->real_escape_string( $meta_name ) . "'");
    return true;
}
    
function get_page_meta( $page_id, $meta_name ) {
    global $mysqli;
    $res = $mysqli->query("SELECT meta_value FROM pages_meta WHERE meta_name='$meta_name' AND page_id='$page_id'");
    if( $res->num_rows > 0 ) {
        $arr = $res->fetch_array( MYSQLI_ASSOC );
        return $arr['meta_value'];
    } else return false;
}

function get_user_meta( $user_id, $meta_name ) {
    global $mysqli;
    $res = $mysqli->query("SELECT meta_value FROM users_meta WHERE meta_name='$meta_name' AND user_id='$user_id'");
    if( $res->num_rows > 0 ) {
        $arr = $res->fetch_array( MYSQLI_ASSOC );
        return $arr['meta_value'];
    } else return false;
}

function diff_with_current_time( $time ) {

    $current_time = date("Y-m-d H:i:s");
    return $diff = ( strtotime( $current_time ) - strtotime( $time ) );
}

function upload_the_image($index, $max_size, $prefix, $dir)
{
    $valid_exts = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    //$max_size = 200 * 1024; // max file size
    $path = $dir."/"; // upload directory

    //temp
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if( ! empty($_FILES[ $index ]) ) {
            // get uploaded file extension
            echo $ext = strtolower(pathinfo($_FILES[ $index ]['name'], PATHINFO_EXTENSION));

            // looking for format and size validity
            if (in_array($ext, $valid_exts) AND $_FILES[ $index ]['size'] < $max_size*50) {

                $path = $path . uniqid(). $prefix.rand(0,100).'.' .$ext;
                // move uploaded file from temp to uploads directory
                if (move_uploaded_file($_FILES[ $index ]['tmp_name'], $path)) {         
                    return BASE . '/' . $path;
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function upload_ajax_image($max_size, $prefix, $dir) {
    $_FILES['image']=$_FILES['photos'];
    $valid_exts = array('jpeg', 'jpg', 'png', 'gif'); // valid extensions
    $max_size = 200 * 1024; // max file size
    $path = $dir . "/"; // upload directory

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if( ! empty($_FILES['image']) ) {
            // get uploaded file extension
            $ext = strtolower(pathinfo($_FILES['image']['name'][0], PATHINFO_EXTENSION));
            // looking for format and size validity
            if (in_array($ext, $valid_exts) AND $_FILES['image']['size'][0] < $max_size*50) {
                $path = $path . uniqid(). $prefix.rand(0,100).'.' .$ext;
                // move uploaded file from temp to uploads directory
                if (move_uploaded_file($_FILES['image']['tmp_name'][0], $path)) {         
                    return BASE . '/' . $path;
                } else echo "Error";
            } else {
                return false;
            }
        } else {
            return false;
        }
    } else {
        return false;
    }
}

function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function get_user_image_from_email($email){
    /*$user_profile = file_get_contents('http://picasaweb.google.com/data/entry/api/user/'.$email.'?alt=json');
    $user_profile = str_replace("$","d",$user_profile);
    $user_profile = json_decode($user_profile);
    return $user_profile->entry->gphotodthumbnail->dt;*/
    return 'https://pikmail.herokuapp.com/'.$email.'?size=50';
}

function get_details_from_db_table($table_name,$id){
    global $mysqli;
    $user_id = $_SESSION['user_id'];

    $sql = "SELECT * FROM $table_name WHERE id=$id AND user_id=$user_id";
    if($table_name == "subscriber" || $table_name == "subscriber_groups"){
        $sql .= " AND status = 1";
    }
    $res = $mysqli->query($sql);
    if( $res->num_rows > 0 ) {
        $arr = $res->fetch_array( MYSQLI_ASSOC );
        return $arr;
    } else return false;
}

function send_mail_using_gmail($sender_mail, $receiver_mail, $sender_name, $receiver_name, $subject, $body_url, $variable_arr) {   
    $user_id = $_SESSION['user_id'];

    //SMTP needs accurate times, and the PHP time zone MUST be set
    //This should be done in your php.ini, but this is how to do it if you don't have access to that
    date_default_timezone_set('Etc/UTC');

    //Load dependencies from composer 
    //If this causes an error, run 'composer install'
    require 'mail_auth/vendor/autoload.php';

    //Create a new PHPMailer instance
    $mail = new PHPMailer;
    //Tell PHPMailer to use SMTP
    $mail->isSMTP();
    // var_dump($mail->isSMTP());
    //Enable SMTP debugging
    // 0 = off (for production use)
    // 1 = client messages
    // 2 = client and server messages
    $mail->SMTPDebug = 0;

    //Set the hostname of the mail server
    $mail->Host = 'smtp.gmail.com';

    //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
    $mail->Port = 587;

    //Set the encryption system to use - ssl (deprecated) or tls
    $mail->SMTPSecure = 'tls';

    //Whether to use SMTP authentication
    $mail->SMTPAuth = true;

    //Set AuthType to use XOAUTH2
    $mail->AuthType = 'XOAUTH2';

    //Fill in authentication details here
    //Either the gmail account owner, or the user that gave consent
    $email = $sender_mail;
    $clientId = GOOGLE_CLIENT_ID;
    $clientSecret = GOOGLE_CLIENT_SECRET;

    //Obtained by configuring and running get_oauth_token.php
    //after setting up an app in Google Developer Console.
    $refreshToken = get_user_meta($user_id, 'google_refresh_token');

    //Create a new OAuth2 provider instance
    $provider = new Google(
        [
            'clientId' => $clientId,
            'clientSecret' => $clientSecret,
        ]
    );

    //Pass the OAuth provider instance to PHPMailer
    $mail->setOAuth(
        new OAuth(
            [
                'provider' => $provider,
                'clientId' => $clientId,
                'clientSecret' => $clientSecret,
                'refreshToken' => $refreshToken,
                'userName' => $email,
            ]
        )
    );

    //Set who the message is to be sent from
    //For gmail, this generally needs to be the same as the user you logged in as
    $mail->setFrom($sender_mail, $sender_name);

    //Set who the message is to be sent to
    $mail->addAddress($receiver_mail, $receiver_name);

    //Set the subject line
    $mail->Subject = $subject;

    //Read an HTML message body from an external file, convert referenced images to embedded,
    //convert HTML into a basic plain-text alternative body
    $mail->CharSet = 'utf-8';
    //$html_data = file_get_contents($body_url);

    $html_data = get_curl_data($body_url);
    
    foreach ($variable_arr as $key => $value) {
        $html_data = str_replace($key,$value,$html_data);
    }
    $mail->msgHTML($html_data);

    //Replace the plain text body with one created manually
    $mail->AltBody = 'This is a plain-text message body';

    //Attach an image file
    // $mail->addAttachment('images/phpmailer_mini.png');

    //send the message, check for errors

    if (!$mail->send()) {
        return array('status'=>false,'code'=>$mail->ErrorInfo);
    } else {
        return array('status'=>true);
    }
}

function send_mail_using_custom_host($sender_mail, $receiver_mail, $sender_name, $receiver_name, $subject, $body_url, $variable_arr, $host,$host_email, $host_email_password ) {   
    $user_id = $_SESSION['user_id'];

    //SMTP needs accurate times, and the PHP time zone MUST be set
    //This should be done in your php.ini, but this is how to do it if you don't have access to that
    date_default_timezone_set('Etc/UTC');

    //Load dependencies from composer 
    //If this causes an error, run 'composer install'
    require 'mail_auth/vendor/autoload.php';

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions
    //Server settings
    $mail->SMTPDebug = 0;                                 // Enable verbose debug output
    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = $host;  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = $host_email;                 // SMTP username
    $mail->Password = $host_email_password;                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom($sender_mail, $sender_name);
    $mail->addAddress($receiver_mail, $receiver_name);

    $html_data = get_curl_data($body_url);
    foreach ($variable_arr as $key => $value) {
        $html_data = str_replace($key,$value,$html_data);
    }

    //Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = $subject;
    $mail->Body    = $html_data;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    if (!$mail->send()) {
        return array('status'=>false,'code'=>$mail->ErrorInfo);
    } else {
        return array('status'=>true);
    }
}

function send_mail_using_mailgun($to,$toname,$mailfromname,$mailfrom,$subject,$body_url,$variable_arr,$mailgun_url,$mailgun_key){
    $html_data = get_curl_data($body_url);
    foreach ($variable_arr as $key => $value) {
        $html_data = str_replace($key,$value,$html_data);
    }
    $array_data = array(
    'from'=> $mailfromname .'<'.$mailfrom.'>',
    'to'=>$toname.'<'.$to.'>',
    'subject'=>$subject,
    'html'=>$html_data,
    'o:tracking'=>'yes',
    'o:tracking-clicks'=>'yes',
    'o:tracking-opens'=>'yes'
    );
    $session = curl_init('https://api.mailgun.net/v3/'.$mailgun_url.'/messages');
    curl_setopt($session, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    curl_setopt($session, CURLOPT_USERPWD, 'api:'.$mailgun_key);
    curl_setopt($session, CURLOPT_POST, true);
    curl_setopt($session, CURLOPT_POSTFIELDS, $array_data);
    curl_setopt($session, CURLOPT_HEADER, false);
    curl_setopt($session, CURLOPT_ENCODING, 'UTF-8');
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($session);
    curl_close($session);
    $results = json_decode($response, true);
    return $results;
}

function get_curl_data($body_url){
    $curl_handle=curl_init();
    curl_setopt($curl_handle, CURLOPT_URL,$body_url);
    curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, 2);
    curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl_handle, CURLOPT_USERAGENT, 'Your application name');
    $html_data = curl_exec($curl_handle);
    curl_close($curl_handle);

    return $html_data;
}

function display404(){
    module_include(error_404);
}

function get_browser_info( $u_agent ) {
    $bname = 'Unknown';
    $platform = 'Unknown';
    $version= "";

    //First get the platform?
    if (preg_match('/linux/i', $u_agent)) {
        $platform = 'linux';
    }
    elseif (preg_match('/macintosh|mac os x/i', $u_agent)) {
        $platform = 'mac';
    }
    elseif (preg_match('/windows|win32/i', $u_agent)) {
        $platform = 'windows';
    }

    // Next get the name of the useragent yes seperately and for good reason
    if(preg_match('/MSIE/i',$u_agent) && !preg_match('/Opera/i',$u_agent)) 
    { 
        $bname = 'Internet Explorer'; 
        $ub = "MSIE"; 
    } 
    elseif(preg_match('/Firefox/i',$u_agent)) 
    { 
        $bname = 'Mozilla Firefox'; 
        $ub = "Firefox"; 
    }
    elseif(preg_match('/OPR/i',$u_agent)) 
    { 
        $bname = 'Opera'; 
        $ub = "Opera"; 
    } 
    elseif(preg_match('/Chrome/i',$u_agent)) 
    { 
        $bname = 'Google Chrome'; 
        $ub = "Chrome"; 
    } 
    elseif(preg_match('/Safari/i',$u_agent)) 
    { 
        $bname = 'Apple Safari'; 
        $ub = "Safari"; 
    } 
    elseif(preg_match('/Netscape/i',$u_agent)) 
    { 
        $bname = 'Netscape'; 
        $ub = "Netscape"; 
    } 

    // finally get the correct version number
    $known = array('Version', $ub, 'other');
    $pattern = '#(?<browser>' . join('|', $known) .
    ')[/ ]+(?<version>[0-9.|a-zA-Z.]*)#';
    if (!preg_match_all($pattern, $u_agent, $matches)) {
        // we have no matching number just continue
    }

    // see how many we have
    $i = count($matches['browser']);
    if ($i != 1) {
        //we will have two since we are not using 'other' argument yet
        //see if version is before or after the name
        if (strripos($u_agent,"Version") < strripos($u_agent,$ub)){
            $version= $matches['version'][0];
        }
        else {
            $version= $matches['version'][1];
        }
    }
    else {
        $version= $matches['version'][0];
    }

    // check if we have a number
    if ($version==null || $version=="") {$version="?";}

    return array(
        'name'      => $bname,
        'version'   => $version,
        'platform'  => $platform,
        'pattern'    => $pattern
    );
}

function get_current_page_token(){
    if(!isset($_COOKIE["user_token"])) {
        $token = openssl_random_pseudo_bytes(16);
        $token = bin2hex($token);
        setcookie("user_token", $token, time() + (86400 * 30), "/");
    } else {
        $token = $_COOKIE["user_token"];
    }

    return $token;
}

function get_user_timezone_date($user_id, $date_time) {
    $user_timezone = get_user_meta($user_id, 'user_timezone');
    if ($user_timezone != "") {
        $offset=$user_timezone*(60*60);
        $dateFormat="Y-m-d H:i:s";
        $new_time = strtotime($date_time)-$offset;
        $new_time = gmdate($dateFormat, $new_time);
        return $new_time;
    }
    return $date_time;
}

?>

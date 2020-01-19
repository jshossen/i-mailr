<?php
//header('Access-Control-Allow-Origin: *');
$from_embed = false;
if(isset($_REQUEST['embed'],$_REQUEST['api_key'],$_REQUEST['user_id'])){
    if($_REQUEST['embed'] == "true"){
        $parsed = parse_url($_SERVER['HTTP_REFERER']);
        $domain = $parsed['host'];
        $user_id = $_REQUEST['user_id'];


        if(get_user_meta($user_id,'embed_domain') == $domain && get_user_meta($user_id,'user_secret') == $_REQUEST['api_key']){//key and domain match
            $from_embed = true;
            set_default_value($user_id);//user id
        }
    }
}
if(logged_in()){
    form_processor();
    if(isset($_REQUEST['page'])){
        $page_id = $_REQUEST['page'];
    }else{
        $page_id = -1;
    }
    $user_id = $_SESSION['user_id'];
    $res = $mysqli->query("SELECT id, name, title, html, type FROM pages WHERE id='$page_id' AND user_id = '$user_id'");
    if( $res->num_rows > 0 ) {
    	$arr = $res->fetch_array( MYSQLI_ASSOC );
    	$html_data = $arr['html'];
        $page_type = $arr['type'];
        $page_name = $arr['name'];
        $page_title = $arr['title'];
        $page_handle = get_page_meta($page_id,"page_handle");
?>
<!DOCTYPE HTML>
<html lang="en" >
<head>
    <script> 
        var base = '<?php echo BASE; ?>'; 
        var awesome_data = '<?php echo str_replace("'",'&rsquo;' , $html_data); ?>'; 

        // preserve newlines, etc - use valid JSON
        awesome_data = awesome_data.replace(/\\n/g, "\\n")  
                       .replace(/\\'/g, "\\'")
                       .replace(/\\"/g, '\\"')
                       .replace(/\\&/g, "\\&")
                       .replace(/\\r/g, "\\r")
                       .replace(/\\t/g, "\\t")
                       .replace(/\\b/g, "\\b")
                       .replace(/\\f/g, "\\f");
        // remove non-printable and other non-valid JSON chars
        awesome_data = awesome_data.replace(/[\u0000-\u0019]+/g,"");
    </script>
    <link rel="apple-touch-icon" sizes="57x57" href="<?php echo BASE; ?>/files/images/fab/apple-icon-57x57.png">
<link rel="apple-touch-icon" sizes="60x60" href="<?php echo BASE; ?>/files/images/fab/apple-icon-60x60.png">
<link rel="apple-touch-icon" sizes="72x72" href="<?php echo BASE; ?>/files/images/fab/apple-icon-72x72.png">
<link rel="apple-touch-icon" sizes="76x76" href="<?php echo BASE; ?>/files/images/fab/apple-icon-76x76.png">
<link rel="apple-touch-icon" sizes="114x114" href="<?php echo BASE; ?>/files/images/fab/apple-icon-114x114.png">
<link rel="apple-touch-icon" sizes="120x120" href="<?php echo BASE; ?>/files/images/fab/apple-icon-120x120.png">
<link rel="apple-touch-icon" sizes="144x144" href="<?php echo BASE; ?>/files/images/fab/apple-icon-144x144.png">
<link rel="apple-touch-icon" sizes="152x152" href="<?php echo BASE; ?>/files/images/fab/apple-icon-152x152.png">
<link rel="apple-touch-icon" sizes="180x180" href="<?php echo BASE; ?>/files/images/fab/apple-icon-180x180.png">
<link rel="icon" type="image/png" sizes="192x192"  href="<?php echo BASE; ?>/files/images/fab/android-icon-192x192.png">
<link rel="icon" type="image/png" sizes="32x32" href="<?php echo BASE; ?>/files/images/fab/favicon-32x32.png">
<link rel="icon" type="image/png" sizes="96x96" href="<?php echo BASE; ?>/files/images/fab/favicon-96x96.png">
<link rel="icon" type="image/png" sizes="16x16" href="<?php echo BASE; ?>/files/images/fab/favicon-16x16.png">
<link rel="manifest" href="/manifest.json">
<meta name="msapplication-TileColor" content="#ffffff">
<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
<meta name="theme-color" content="#ffffff">

	<meta http-equiv="Content-Type" content=" charset=UTF-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Awesome editor</title>
    <link rel="icon" href="<?php echo BASE.'/files/dashboard/images/favicon.png'; ?>" type="image/gif" sizes="16x16">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="<?php echo BASE; ?>/files/editorscript/css/jquery.minicolors.css">
	<link rel="stylesheet" href="<?php echo BASE; ?>/files/editorscript/css/font-awesome.min.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo BASE; ?>/files/editorscript/css/editor/animate.css">
    <link rel="stylesheet" type="text/css" href="<?php echo BASE; ?>/files/dashboard/css/bootstrap-datepicker.css" />

    
    <link rel="stylesheet" href="<?php echo BASE; ?>/files/editorscript/css/style.css"> 
    <link rel="stylesheet" href="<?php echo BASE; ?>/files/editorscript/css/z-index.css"> 
    <link rel="stylesheet" href="<?php echo BASE; ?>/files/editorscript/css/top-navbar.css"> 
    <link rel="stylesheet" href="<?php echo BASE; ?>/files/editorscript/css/window_menu.css"> 
    <link rel="stylesheet" href="<?php echo BASE; ?>/files/editorscript/css/loading_style.css">
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="<?php echo BASE; ?>/files/editorscript/js/jquery.minicolors.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.4.0/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/1.7.1/clipboard.min.js"></script>
    <script src="<?php echo BASE; ?>/files/dashboard/js/bootstrap-datepicker.js"></script>

    <script src="<?php echo BASE; ?>/files/editorscript/js/global_val.js"></script>
    <script src="<?php echo BASE; ?>/files/editorscript/js/set_get_css.js"></script>
    <script src="<?php echo BASE; ?>/files/editorscript/js/element_menu.js"></script>
    <script src="<?php echo BASE; ?>/files/editorscript/js/javascript.js"></script>
    <script src="<?php echo BASE; ?>/files/editorscript/js/drag_and_drop.js"></script>
    <script src="<?php echo BASE; ?>/files/editorscript/js/json.js"></script>
    <script src="<?php echo BASE; ?>/files/editorscript/js/easyUndoRedo.js"></script>

    <script src="<?php echo BASE; ?>/files/editorscript/js/ckeditor/ckeditor.js"></script>
    <script src="<?php echo BASE; ?>/includes/functions.js"></script>
    <?php 
        echo get_page_meta($page_id,"custom_css"); 
        if($page_type == "page" || $page_type == "study"){
    ?>
    <link rel="stylesheet" href="<?php echo BASE; ?>/files/css/common_style.css">
    <?php
        }
    ?>
</head>
<body>
    <?php include "files/editorscript/phpsection/modals.php" ?>
    <?php include "files/editorscript/phpsection/all_element_array.php" ?>

    <?php include "files/editorscript/phpsection/top-navbar.php" ?>
    <?php include "files/editorscript/phpsection/all_elements_list.php" ?>
    <?php include "files/editorscript/phpsection/window_menu.php" ?>

    <!-- <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = 'https://connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.11&appId=296472054161027';
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script> -->

    <div style="margin-left: 40px; margin-top: 50px;">
        <div class="div_editorpreview" id="div_editorpreview" style="background-image: url('<?php echo BASE; ?>/files/editorscript/images/background6.jpg');"></div>
        <?php include "files/editorscript/phpsection/side_nav_settings.php" ?>
    </div>
    
	<textarea id="tags_css_attr" rows="4" cols="100" hidden><?php echo json_encode($tags_css_attr); ?></textarea>
	<textarea id="style_property" rows="4" cols="100" hidden><?php echo json_encode($style_property); ?></textarea>
	<textarea id="drag_and_drop_elements" rows="4" cols="100" hidden><?php echo json_encode($drag_and_drop_elements); ?></textarea>
	<textarea id="editor_preview_deleted_item" cols="100" rows="4" hidden></textarea>
	<!-- <textarea id="editor_preview_data" cols="100" rows="10" hidden><?php //echo $html_data; ?></textarea> -->
	<textarea id="edited_all_elements_id" cols="100" rows="10" hidden></textarea>
	<textarea id="template_dependent_css_link" cols="100" rows="10" hidden><?php echo get_page_meta( $page_id, 'css' ); ?></textarea>
	<input type="hidden" id="current_editable_element_id" value="">
	<input type="hidden" id="current_editable_element_image_src" value="">
    <input type="hidden" id="page_id" value="<?php echo $page_id; ?>">
    <input type="hidden" id="page_name" value="<?php echo $page_name; ?>">
    <input type="hidden" id="page_title" value="<?php echo $page_title; ?>">
    <input type="hidden" id="page_type" value="<?php echo $page_type; ?>">
    <input type="hidden" id="page_handle" value="<?php echo $page_handle; ?>">
    <input type="hidden" id="user_id" value="<?php echo $user_id; ?>">

    <input type="hidden" id="from_embed" value="<?php echo $from_embed; ?>">


    <div class="loader" hidden>
        
    </div>
    <span class="heart" id="place_element_here" style="color: rgba(27, 33, 31, 0.88); font-size: 30px; position: absolute; display: none;"><i class="fa fa-thumb-tack" aria-hidden="true"></i></span>
    <!-- <span id="place_element_pull_line" style="width: 1600px; min-height: 3px; background-color: rgba(0,0,0,1); position: absolute; display: none;"></span> -->
    <div id="editor_msg" style="color:#FFFFFF;padding:10px;text-align:center;width:300px;position:fixed;bottom:0;left:0;border-radius:4px 4px 0 0; font-size: 20px;  box-shadow: 10px 10px 5px #888888; box-shadow: -2px -1px 7px #888888; display: none;">
		Settings Saved Success
	</div>

    <div class="text-right" style="color: white; min-width: 100%; min-height: 10px; bottom: 0; position: fixed; background-color: rgba(0,0,0,1);">
      <span style="margin-right: 30px;"><?php echo BASE; ?></span>
    </div>
</body>
</html> 
<?php	
    }else{
        echo "No page found!";
    }
}else{
    please_go("sign_in");
}
function process_save_page_new_data(){
	global $mysqli;
    $user_id = $_SESSION['user_id'];
    $max_limit = $_SESSION['rule']['page'];


    $html_data = $_REQUEST['html_data'];
    $page_id = $_REQUEST['page_id'];
    $page_type = $_REQUEST['page_type'];
    $page_name = $_REQUEST['page_name'];
    $page_title = $_REQUEST['page_title'];
    $page_handle = $_REQUEST['page_handle'];
    $page_handle = $mysqli->real_escape_string( preg_replace('!\s+!', ' ',$page_handle ));
    $page_handle = str_replace( " " ,"-" , $page_handle );
    $save_type = $_REQUEST['save_type'];

    $html_data = $mysqli->real_escape_string($html_data);

    if($save_type == "clone"){
        $pres = $mysqli->query("SELECT id FROM pages WHERE user_id = $user_id AND status=1");
        if($pres->num_rows >= $max_limit ){
            echo 'fail';
            return;
        }
        $res = $mysqli->query("INSERT INTO pages ( date , last_updated, user_id ,type,name,title,html,status) VALUES ( '" . date("Y-m-d H:i:s") . "' , '" . date("Y-m-d H:i:s") . "' , '$user_id' , '$page_type' , '$page_name' , '$page_title' ,'$html_data','1' ) ");

        $pres = $mysqli->query("SELECT id FROM pages WHERE user_id = '$user_id' ORDER BY id DESC LIMIT 1");
        $arr = $pres->fetch_array( MYSQLI_ASSOC );
        $page_id = $arr['id'];

        add_page_meta($page_id,"page_handle",$page_handle);
        echo  $page_id;
    }else if($save_type == "save"){
        $last_updated = date("Y-m-d H:i:s");
        $sql = "UPDATE pages SET `html` = '" . $html_data . "', `last_updated` = '".$last_updated."', `name` = '".$page_name."', `title` = '".$page_title."' WHERE id = '$page_id' AND user_id = '$user_id'";
        if($mysqli->query($sql)){
            echo $page_id;
            add_page_meta($page_id,"page_handle",$page_handle);
        }else{
            echo "fail";
        }
    }
}

function process_upload_an_image_to_cloud(){
	$full_image_url= upload_an_image_to_own_server(5000000, 'uploaded_', array('png', 'jpg', 'gif','jpeg', 'bmp'));
	//$output = explode("/",$full_image_url);
	//$partial_image_url = $output[count($output)-3].'/'.$output[count($output)-2].'/'.$output[count($output)-1];
    //echo put_s3_file( AWS_FILE_BUCKET, $partial_image_url);
    echo BASE."/".$full_image_url;
	die();
}
	
function upload_an_image_to_own_server($max_size, $prefix, $valid_exts) {        
	   $path='files/uploads/';
	   if ($_SERVER['REQUEST_METHOD'] === 'POST') {
		   if( ! empty($_FILES['image']) ) {
			   // get uploaded file extension
			   $ext = strtolower(pathinfo($_FILES['image']['name'][0], PATHINFO_EXTENSION));
			   // looking for format and size validity
			   if (in_array($ext, $valid_exts) AND $_FILES['image']['size'][0] < $max_size*50) {
				   $path = $path . uniqid(). $prefix.rand(0,100).'.' .$ext;
				   // move uploaded file from temp to uploads directory
				   if (move_uploaded_file($_FILES['image']['tmp_name'][0], $path)) {  
					   return $path;
				   } //else echo $_FILES['image']['tmp_name'][0];
			   } else {
				   echo 'File not uploaded , we supports only .png, .jpg, .jpeg, .gif, .bmp and max-size 5mb.';
			   }
		   } else {
			   echo 'File not uploaded , we supports only .png, .jpg, .jpeg, .gif, .bmp and max-size 5mb.';
		   }
	   } else {
		   echo 'Bad request , please try later.';
	   }
}

function process_insert_custom_script(){
    $page_id = $_REQUEST['page_id'];
    $custom_script = $_REQUEST['custom_script'];
    add_page_meta( $page_id, 'custom_script', $custom_script );
    echo $custom_script;
}
function process_insert_custom_css(){
    $page_id = $_REQUEST['page_id'];
    $custom_css = $_REQUEST['custom_css'];
    add_page_meta( $page_id, 'custom_css', $custom_css );
    echo $custom_css;
}
function process_save_exit_popup_status(){
    $page_id = $_REQUEST['page_id'];
    $exit_popup = $_REQUEST['exit_popup'];
    add_page_meta( $page_id, 'exit_popup_status', $exit_popup );
    echo $exit_popup;
}  

function process_save_seo_settings_to_db() {
    global $mysqli;
    $page_id = $_REQUEST['page_id'];
    $title = $_REQUEST['title'];
    $description = $_REQUEST['description'];
    $image = $_REQUEST['image'];

    add_page_meta( $page_id, 'seo_page_title', $title );
    add_page_meta( $page_id, 'seo_page_description', $description);
    add_page_meta( $page_id, 'seo_page_image', $image);
}  

function process_upload_this_image(){
    add_uploads_meta( $_REQUEST['user_id'], "image", $_REQUEST['uploaded_url'] );
    echo "Image uploaded";
}
function process_delete_this_image(){
    $field_id = $_REQUEST['image_id'];
    delete_uploads_meta($field_id);
    echo "Image deleted";
}

function process_add_me_to_personal_lib(){
    global $mysqli;
    $user_id = $_SESSION['user_id'];
    $ele_name = $_REQUEST['ele_name'];
    $copied_element = $_REQUEST['copied_element'];
    $page_type = $_REQUEST['page_type'];

    $code["name"] = $ele_name;
    $code["element"] = json_decode($copied_element);

    $code = $mysqli->real_escape_string(json_encode($code));        
    $sql = "INSERT INTO my_library (user_id, library, type)VALUES ('$user_id', '$code', '$page_type')";     
    $pres = $mysqli->query($sql);

    $pres = $mysqli->query("SELECT id FROM my_library ORDER BY id DESC LIMIT 1");
    $arr = $pres->fetch_array( MYSQLI_ASSOC );
    $lib_id = $arr['id'];
    echo $lib_id;
}

function process_load_personal_lib(){
    global $mysqli;
    $user_id = $_SESSION['user_id'];
    $page_type = $_REQUEST['page_type'];
    $sql = "SELECT * from my_library WHERE user_id = $user_id AND type = '$page_type' ORDER BY id DESC";
    $pres = $mysqli->query($sql);
    while( $arr = $pres->fetch_array( MYSQLI_ASSOC ) ) {
        $lib = $arr['library'];
        $lib = json_decode($lib);
?>
     <div title="<?php echo $lib->name; ?>" style="max-height: 80px;min-height: 80px; margin-top:10px; background-color: #34495e; position: relative; border-radius: 5px;" class="main_image_div">
              <div>
                  <p style="color: #fff; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;"><?php echo $lib->name; ?></p>
                  <div style="display: table; width:100%; text-align: center; z-index: 99; position: absolute; top:18px; left: 0px;">
                    <i style="display: table-cell; vertical-align: middle; font-size: 42px; opacity: 0.6; color: #fff;" class="fa fa-braille" aria-hidden="true"></i>
                  </div>
                  <div style="position: absolute; bottom: 5px; right:8px; left: 8px; z-index: 9999;">
                    <button class="btn btn-info btn-sm" style="width: 45%; float: left; text-align: left;" id="<?php echo'personal_lib_'.$arr['id']; ?>" onclick="add_me_to_editor_preview(this);">Insert</button>
                    <button class="btn btn-danger btn-sm" style="width: 45%;float: right; text-align: right;"  onclick="remove_this_lib(this,'<?php echo $arr['id']; ?>');">Delete</button>
                  </div>
              </div>
          </div>
<?php
    }
}

function process_remove_this_lib(){
    global $mysqli;
    $user_id = $_SESSION['user_id'];
    $ele_id = $_REQUEST['ele_id'];
    $sql = "DELETE FROM my_library WHERE id=$ele_id AND user_id=$user_id";
    $pres = $mysqli->query($sql);
}

function process_send_mail_now(){
    global $mysqli;
    $user_id = $_SESSION['user_id'];
    $group_id = $_REQUEST['group_id'];
    $page_id = $_REQUEST['page_id'];
    $my_name = get_user_meta($user_id, 'google_sender_name');
    $email_subject = $mysqli->real_escape_string($_REQUEST['email_subject']);
    
    $group_detais = get_details_from_db_table('subscriber_groups',$group_id);
    $subscriber_ids = json_decode($group_detais['subscriber_ids']);
    if($subscriber_ids != NULL){
        $i = 1;
        foreach ($subscriber_ids as $key => $value) {
            

            $user = get_details_from_db_table('subscriber',$value);
            $email = $user['email'];
            $first_name = $user['first_name'];
            $last_name = $user['last_name'];
            $name = $last_name.' '.$first_name;

            $custom_variable = $user['custom_variable'];
            $custom_variable = json_decode($custom_variable);
            $variable_arr = array("{{first_name}}"=>$first_name,"{{last_name}}"=>$last_name,"{{email}}"=>$email);
            foreach ($custom_variable as $key => $value) {
                $variable_arr['{{'.$key.'}}'] = $value;
            }

            send_mail_using_gmail(get_user_meta($user_id, 'google_gmail_address'), $email , $my_name, $name, $email_subject, BASE.'/preview/?page='.$page_id , $variable_arr);
        }
    }
}

function process_embeded_html(){
    $html = get_curl_data(BASE.'/preview/?page='.$_REQUEST['page_id']);
    $result = array('page_id' => $_REQUEST['page_id'],'html'=>$html);
    echo json_encode($result);
}
?>
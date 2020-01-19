<?php
header('Access-Control-Allow-Origin: *');
form_processor();

function process_save_optin_form_data(){
	//var_dump($_REQUEST);
	include_once("includes/instant_mailr.php");
    $api_base_url = BASE."/wh";

    $params = [];

    foreach ($_REQUEST as $key => $value) {
    	if($key == 'process'){

    	}else if($key == 'user_id'){
    		$user_id = $value;
    		$api_key = get_user_meta($user_id,"user_secret");
    	}else{
    		$params[$key] = $value;
    	}
    }
    //var_dump($params);die();
    $im = new Instant_Mailr($user_id, $api_base_url, $api_key);
    $page = $im->call('POST', 'subscriber/add', $params);
    echo json_encode($page);
}
?>
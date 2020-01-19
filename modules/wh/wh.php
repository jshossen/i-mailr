<?php
header('Access-Control-Allow-Origin: *');

//Here are the header information that includes api token
$headers = getallheaders();

$user_id = $headers['X-Instant_Mailr-user'];
$user_secret = $headers['X-Instant_Mailr-api-key'];
$x_method_called = $headers['X-Instant_Mailr-Method-Called'];


//Let's read products of this shop and return
if( in_array( $x_method_called, array( 'POST', 'PUT' ) ) ) {
    //here is post content (PUT/POST)
    $postdata = file_get_contents("php://input");
    $data = json_decode( $postdata );
} elseif( in_array( $x_method_called, array( 'GET', 'DELETE' ) ) ) {
    //here is get content (GET/DELETE)
    $data = $_REQUEST;
}

//echo json_encode(array("result"=> "hlloe"));die();
global $break, $start;

if(get_user_meta($user_id,"user_secret") == $user_secret && get_user_meta($user_id,"user_secret") != ""){
	set_default_value($user_id);
   	if(in_array( $x_method_called,array('GET'))){
    	echo json_encode(array("result"=> get_call_handeler($user_id,$data,$break, $start)));
	}else if(in_array( $x_method_called,array('POST'))){
	    echo json_encode(array("result"=> post_call_handeler($user_id,$data,$break, $start)));
	}else if(in_array( $x_method_called,array('PUT'))){
	    echo json_encode(array("result"=> put_call_handeler($user_id,$data,$break, $start)));
	}else if(in_array( $x_method_called,array('DELETE'))){
	    echo json_encode(array("result"=> delete_call_handeler($user_id,$data,$break, $start)));
	}
}else{
    echo json_encode(array("result"=> "Invalid user id and api key!!!"));
}


function get_call_handeler($user_id,$fields_arr,$break, $start){
	$result = [];
	if($break[$start+1]=='page'){
		global $mysqli;
		$page_id = $break[$start+2];
		$res = $mysqli->query("SELECT * FROM pages WHERE id='$page_id' AND user_id=$user_id AND status=1");
		if($res->num_rows > 0){
			$result = $res->fetch_array( MYSQLI_ASSOC );
			$result['html'] = get_curl_data(BASE."/preview/?page=".$page_id);
		}else{
			$result = display404();
		}
		
	}else if($break[$start+1]=='subscriber'){
		global $mysqli;
		$subscriber_id = $break[$start+2];
		$fields = '*';
		if(isset($fields_arr['fields'])){
			$fields = $fields_arr['fields'];
		}
		$res = $mysqli->query("SELECT $fields FROM subscriber WHERE id='$subscriber_id' AND user_id=$user_id AND status=1");
		if($res->num_rows > 0){
			$result = $res->fetch_array( MYSQLI_ASSOC );
		}
		
	}else if($break[$start+1]=='subscribers'){
		global $mysqli;
		$fields = '*';
		if(isset($fields_arr['fields'])){
			$fields = $fields_arr['fields'];
		}
		$res = $mysqli->query("SELECT $fields FROM subscriber WHERE user_id=$user_id AND status=1");
		if($res->num_rows > 0){
			$result = $res->fetch_all( MYSQLI_ASSOC );
		}
	}else if($break[$start+1]=='subscriber_groups'){
		global $mysqli;
		$fields = '*';
		if(isset($fields_arr['fields'])){
			$fields = $fields_arr['fields'];
		}
		$res = $mysqli->query("SELECT $fields FROM subscriber_groups WHERE user_id=$user_id AND status=1");
		if($res->num_rows > 0){
			$result = $res->fetch_all( MYSQLI_ASSOC );
		}
	}else if($break[$start+1]=='subscriber_group'){
		global $mysqli;
		$subscriber_groups_id = $break[$start+2];
		$fields = '*';
		if(isset($fields_arr['fields'])){
			$fields = $fields_arr['fields'];
		}
		$res = $mysqli->query("SELECT $fields FROM subscriber_groups WHERE id='$subscriber_groups_id' AND user_id=$user_id AND status=1");
		if($res->num_rows > 0){
			$result = $res->fetch_array( MYSQLI_ASSOC );
		}
	}
	return $result;
}
function post_call_handeler($user_id,$fields_arr,$break, $start){
	//return $fields_arr;
	$result = [];
	if($break[$start+1]=='subscriber'){
		if($break[$start+2]=='add'){
			global $mysqli;
			$custom_variable = [];
			foreach ($fields_arr as $key => $value) {
				if($key == 'email'){
					$email = $value;
				}else if($key == 'first_name'){
					$first_name = $value;
				}else if($key == 'last_name'){
					$last_name = $value;
				}else if($key == 'phone'){
					$phone = $value;
				}else{
					if($key != 'user_token' && $key != 'PHPSESSID'){
						$custom_variable[$key] = $value;
					}
				}
			}

			$custom_variable = json_encode($custom_variable);
			$custom_variable = $mysqli->real_escape_string($custom_variable);

			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		      	$info = '[]';
		        $status = 1;
		        $max_limit = $_SESSION['rule']['subscriber'];
		        $pres = $mysqli->query("SELECT id FROM subscriber WHERE user_id = $user_id AND status=1");
		        if($pres->num_rows >= $max_limit ){
		            $result = 'Limit crossed..';
		        }else{
		            $sql = "SELECT id FROM subscriber WHERE user_id = '$user_id' AND email = '$email'";
		            $pres = $mysqli->query($sql);
		            if($pres->num_rows > 0){
		                $last_updated = date("Y-m-d H:i:s");
		                $sql = "UPDATE subscriber SET status = '1', custom_variable = '$custom_variable', first_name = '$first_name', last_name = '$last_name', phone = '$phone', updated = '$last_updated' WHERE user_id = '$user_id' AND email = '$email'";
		                $res = $mysqli->query($sql);
		            }else{
		                $sql = "INSERT INTO subscriber ( user_id, first_name , last_name, email, phone, custom_variable, date_of_birth, created, updated, info, status) VALUES ( '$user_id','$first_name','$last_name','$email','$phone','$custom_variable','" . date("Y-m-d H:i:s") . "' , '" . date("Y-m-d H:i:s") . "' , '" . date("Y-m-d H:i:s") . "' , '$info' ,'$status' ) ";
		                $res = $mysqli->query($sql);
		            }
		            $sql = "SELECT * FROM subscriber WHERE user_id = '$user_id' AND email = '$email'";
		            $res = $mysqli->query($sql);
					if($res->num_rows > 0){
						$result = $res->fetch_array( MYSQLI_ASSOC );
					}
		        }
		    }else{
		    	$result = "Invalid email format";
		    }
		}
	}else if($break[$start+1]=='subscriber_groups'){
		if($break[$start+2]=='new'){
			global $mysqli;
			$group_name = $fields_arr->title;
	        $info = array();
	        $info['name'] = $group_name;
	        $info = $mysqli->real_escape_string(json_encode($info));
	        $sql = "INSERT INTO subscriber_groups ( user_id, created, updated, info) VALUES ( '$user_id','" . date("Y-m-d H:i:s") . "' , '" . date("Y-m-d H:i:s") . "' ,'$info') ";
	        $result = $mysqli->query($sql);

		}
	}else if($break[$start+1]=='subscriber_group'){
		$group_id = $break[$start+2];
		if($break[$start+3]=='add'){
			global $mysqli;
	        $ids = $fields_arr->ids;

	        $sql = "SELECT subscriber_ids FROM subscriber_groups WHERE id=$group_id AND user_id=$user_id AND status = 1";
		    
		    $res = $mysqli->query($sql);
		    $group_detais = $res->fetch_array( MYSQLI_ASSOC );
	        if($group_detais['subscriber_ids'] != NULL && $group_detais['subscriber_ids'] != "null"){
	            $subscriber_ids = json_decode($group_detais['subscriber_ids']);
	        }else{
	            $subscriber_ids = [];
	        }
	        
	        $subscriber_ids = array_merge($subscriber_ids,$ids);

	        $subscriber_ids = array_unique($subscriber_ids);
	        // return $subscriber_ids;
	        $subscriber_ids = $mysqli->real_escape_string(json_encode(array_values($subscriber_ids)));

	        $last_updated = date("Y-m-d H:i:s");
	        $sql = "UPDATE subscriber_groups SET subscriber_ids = '$subscriber_ids', updated = '$last_updated' WHERE id = '$group_id' AND user_id = '$user_id'";
	        $res = $mysqli->query($sql);

	        $res = $mysqli->query("SELECT * FROM subscriber_groups WHERE id='$group_id' AND user_id=$user_id AND status=1");
			if($res->num_rows > 0){
				$result = $res->fetch_array( MYSQLI_ASSOC );
			}

		}
	}else if($break[$start+1]=='send_mail'){
		global $mysqli;
        $page_id = $fields_arr->page_id;
        $my_email = $fields_arr->source;
        $sending_time = $fields_arr->sending_time;
        $email_subject = $fields_arr->subject;
        $group_id = $fields_arr->subscriber_group;
        
        $email_subject = $mysqli->real_escape_string($email_subject);
        if($sending_time == ""){
            $last_updated = date("Y-m-d H:i:s");
            $sending_time = $last_updated;
        }else{
            $user_timezone = get_user_meta($user_id, 'user_timezone');
            if ($user_timezone != "") {
                $offset=$user_timezone*(60*60);
                $dateFormat="Y-m-d H:i:s";
                $sending_time = strtotime($sending_time)-$offset;
                $sending_time = gmdate($dateFormat, $sending_time);
            }
        }
        

        $email_method = null;
        $res = $mysqli->query("SELECT id, name, title, html, type FROM pages WHERE id='$page_id' AND user_id = '$user_id' LIMIT 1");
        if( $res->num_rows > 0 ) {
            if($my_email != "" && $group_id != "" && $email_subject != ""){
                $res = $mysqli->query("SELECT subscriber_ids FROM subscriber_groups WHERE id='$group_id' AND user_id=$user_id AND status=1");
				if($res->num_rows > 0){
					$group_detais = $res->fetch_array( MYSQLI_ASSOC );
					$subscriber_ids = json_decode($group_detais['subscriber_ids']);
	                if($subscriber_ids != NULL){
	                    $subscriber_ids = json_encode($subscriber_ids);

	                    $sql = "INSERT INTO email_queue ( user_id, email, subscriber_arr, subject, sending_time, page_id, info, status ) VALUES ( '$user_id', '$my_email', '$subscriber_ids', '$email_subject', '$sending_time', $page_id ,'$info', 2) ";
	                    $res = $mysqli->query($sql);
	                    $result = array('status'=>'success');
	                }else{
	                	$result = array('status'=>'fail1');
	                }
				}else{
					$result = array('status'=>'fail2','message'=>'Invalid subscriber_group id!!!');
				}
            }else{
                $result = array('status'=>'fail3','message'=>'source, subscriber id, subject required!!!');
            }
        }else{
            $result = array('status'=>'fail','message'=>'Invalid page_id!!!');
        }
	}
	return $result;
}
function put_call_handeler($user_id,$fields_arr,$break, $start){
	$result = [];
	if($break[$start+1]=='subscriber'){
		if($break[$start+2]=='add'){
			global $mysqli;
			$custom_variable = [];
			foreach ($fields_arr as $key => $value) {
				if($key == 'email'){
					$email = $value;
				}else if($key == 'first_name'){
					$first_name = $value;
				}else if($key == 'last_name'){
					$last_name = $value;
				}else if($key == 'phone'){
					$phone = $value;
				}else{
					if($key != 'user_token' && $key != 'PHPSESSID'){
						$custom_variable[$key] = $value;
					}
				}
			}

			$custom_variable = json_encode($custom_variable);
			$custom_variable = $mysqli->real_escape_string($custom_variable);

			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
		      	$info = '[]';
		        $status = 1;
		        $max_limit = $_SESSION['rule']['subscriber'];
		        $pres = $mysqli->query("SELECT id FROM subscriber WHERE user_id = $user_id AND status=1");
		        if($pres->num_rows >= $max_limit ){
		            $result = 'Limit crossed..';
		        }else{
		            $sql = "SELECT id FROM subscriber WHERE user_id = '$user_id' AND email = '$email'";
		            $pres = $mysqli->query($sql);
		            if($pres->num_rows > 0){
		                $last_updated = date("Y-m-d H:i:s");
		                $sql = "UPDATE subscriber SET status = '1', custom_variable = '$custom_variable', first_name = '$first_name', last_name = '$last_name', phone = '$phone', updated = '$last_updated' WHERE user_id = '$user_id' AND email = '$email'";
		                $res = $mysqli->query($sql);
		            }else{
		                $sql = "INSERT INTO subscriber ( user_id, first_name , last_name, email, phone, custom_variable, date_of_birth, created, updated, info, status) VALUES ( '$user_id','$first_name','$last_name','$email','$phone','$custom_variable','" . date("Y-m-d H:i:s") . "' , '" . date("Y-m-d H:i:s") . "' , '" . date("Y-m-d H:i:s") . "' , '$info' ,'$status' ) ";
		                $res = $mysqli->query($sql);
		            }
		            $sql = "SELECT * FROM subscriber WHERE user_id = '$user_id' AND email = '$email'";
		            $res = $mysqli->query($sql);
					if($res->num_rows > 0){
						$result = $res->fetch_array( MYSQLI_ASSOC );
					}
		        }
		    }else{
		    	$result = "Invalid email format";
		    }
		}
	}
	return $result;
}
function delete_call_handeler($user_id,$fields_arr,$break, $start){
	$result = [];
	if($break[$start+1]=='subscriber_group'){
		
		$group_id = $break[$start+2];
		if($break[$start+3]=='subscriber'){
			global $mysqli;
	        $ids = $fields_arr['ids'];
	       
	        $sql = "SELECT subscriber_ids FROM subscriber_groups WHERE id=$group_id AND user_id=$user_id AND status = 1";
		    $res = $mysqli->query($sql);
		    $group_detais = $res->fetch_array( MYSQLI_ASSOC );
	        if($group_detais['subscriber_ids'] != NULL){
	            $subscriber_ids = json_decode($group_detais['subscriber_ids']);
	        }else{
	            $subscriber_ids = [];
	        }
	        $subscriber_ids = array_diff($subscriber_ids, $ids);
	        $temp = [];
	        foreach ($subscriber_ids as $key => $value){
	            if ($value != $id) {
	                $temp[] = $value;
	            }
	        }
	        $subscriber_ids = $temp;

	        $subscriber_ids = $mysqli->real_escape_string(json_encode($subscriber_ids));
	        $last_updated = date("Y-m-d H:i:s");
	        $sql = "UPDATE subscriber_groups SET subscriber_ids = '$subscriber_ids', updated = '$last_updated' WHERE id = '$group_id' AND user_id = '$user_id'";
	        $res = $mysqli->query($sql);
	        $res = $mysqli->query("SELECT * FROM subscriber_groups WHERE id='$group_id' AND user_id=$user_id AND status=1");
			if($res->num_rows > 0){
				$result = $res->fetch_array( MYSQLI_ASSOC );
			}
		}else{
			global $mysqli;
	        $id = $group_id;
	        $last_updated = date("Y-m-d H:i:s");
	        $sql = "UPDATE subscriber_groups SET status = '2', updated = '$last_updated' WHERE id = '$id' AND user_id = '$user_id'";
	        $res = $mysqli->query($sql);
	        $result = array('status'=>'success');
		}
		

	}
	return $result;


}
?>
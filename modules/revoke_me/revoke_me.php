<?php
	if(isset($_REQUEST['provider'])){
		$user_id = $_SESSION['user_id'];
		if($_REQUEST['provider'] == "Google"){
			try {
			    file_get_contents('https://accounts.google.com/o/oauth2/revoke?token='.get_user_meta($user_id, 'google_access_token'));
				add_user_meta($user_id, 'google_refresh_token', "");
		        add_user_meta($user_id, 'google_gmail_address', "");
		        add_user_meta($user_id, 'google_access_token', "");
		        add_user_meta($user_id, 'google_sender_name', "");
		        header ('Location: '.BASE.'/auth_settings');
			} catch (Exception $e) {
			    header ('Location: '.BASE.'/includes/mail_auth/index.php?provider=Google');
			}
			
		}else if($_REQUEST['provider'] == "bulkmail"){
			$_SESSION['auth_user'] = false;
    		$_SESSION['user_id'] = "";
    		$_SESSION['user_info'] = "{}";
    		header ('Location: '.BASE.'/home');
		}
		
	}else{
		header ('Location: '.BASE.'/auth_settings');
	}

?>
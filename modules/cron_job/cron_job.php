<?php
    if(isset($_REQUEST['send_mail']) && $_REQUEST['send_mail'] == 'true'){
        global $mysqli;
        $current_time = date("Y-m-d H:i:s");
        $sql = "SELECT * FROM email_queue WHERE status=2 AND sending_time < '$current_time' LIMIT 1";
        $res = $mysqli->query($sql);
        if( $res->num_rows > 0 ) {
            $arr = $res->fetch_array( MYSQLI_ASSOC );
            $id = $arr['id'];
            $sql = "UPDATE email_queue SET status = '1' WHERE id = '$id'";
            $res = $mysqli->query($sql);

            $email_queue_id = $arr['id'];
            $user_id = $arr['user_id'];
            $_SESSION['user_id'] = $user_id;
            $page_id = $arr['page_id'];
            $my_email = $arr['email'];
            $subscriber_ids = $arr['subscriber_arr'];
            $subscriber_ids = json_decode($subscriber_ids);
            $sending_time = $arr['sending_time'];
            $email_subject = $arr['subject'];
            $email_subject = $mysqli->real_escape_string($email_subject);

            $email_method = null;

            $google_gmail_address = get_user_meta($user_id, 'google_gmail_address');
            $email_host_user_name = get_user_meta($user_id, 'email_host_user_name');
            $mailgun_domain = get_user_meta($user_id, 'mailgun_domain');

            if($google_gmail_address != "" && $google_gmail_address == $my_email){
                $email_method = "gmail";
            }else if($email_host_user_name != "" && $email_host_user_name == $my_email){
                $email_method = "host_mail";
            }else if($mailgun_domain != "" && $mailgun_domain == $my_email){
                $email_method = "mailgun";
            }

            $i = 1;
            foreach ($subscriber_ids as $key => $sub_id) {
                $user = get_details_from_db_table('subscriber',$sub_id);
                $email = $user['email'];
                $first_name = $user['first_name'];
                $last_name = $user['last_name'];
                $name = $last_name.' '.$first_name;

                
                $variable_arr = array("{{first_name}}"=>$first_name,"{{last_name}}"=>$last_name,"{{email}}"=>$email);

                $custom_variable = $user['custom_variable'];
                if($custom_variable != NULL){
                    $custom_variable = json_decode($custom_variable);
                    foreach ($custom_variable as $key => $value) {
                        $variable_arr['{{'.$key.'}}'] = $value;
                    }
                }

                if($email_method == "gmail"){
                    $my_name = get_user_meta($user_id, 'google_sender_name');
                    
                    $report = send_mail_using_gmail($my_email, $email , $my_name, $name, $email_subject, BASE.'/preview/?page='.$page_id , $variable_arr);
                    
                }else if($email_method == "host_mail"){
                    $my_name = get_user_meta($user_id, 'email_host_full_name');
                    $host = get_user_meta($user_id, 'email_host_name');
                    $host_email = get_user_meta($user_id, 'email_host_user_name');
                    $host_email_password = get_user_meta($user_id, 'email_host_password');
                    $report = send_mail_using_custom_host($my_email, $email, $my_name, $name, $email_subject, BASE.'/preview/?page='.$page_id, $variable_arr, $host,$host_email, $host_email_password );
                }else if($email_method == "mailgun"){
                    $mailgun_domain = get_user_meta($user_id, 'mailgun_domain');
                    $mailgun_api_key = get_user_meta($user_id, 'mailgun_api_key');
                    $mailfromname = get_user_meta($user_id, 'mailgun_full_name');
                    $mailfrom = get_user_meta($user_id, 'mailgun_email');

                    $to = $email;
                    $toname = $name;
                    
                    $subject = $email_subject;
                    $html = BASE.'/preview/?page='.$page_id;
                    $res = send_mail_using_mailgun($to,$toname,$mailfromname,$mailfrom,$subject,$html,$variable_arr,$mailgun_domain,$mailgun_api_key);
                    var_dump($res);

                    if(isset($res['id'])){
                        $report = array('status'=>true);
                    }

                }else{
                    $report = array('status'=>false,'code'=>'No email method found!!! Please connect your mail.');
                }

                var_dump($report);

                if($report['status']){
                    $status = 1;
                    $error_code = "";
                }else{
                    $status = 0;
                    $error_code = $report['code'];
                }
                $sql = "INSERT INTO email_stats ( user_id, subscriber_id, email_queue_id, html, sent_time, status, error_code ) VALUES ( '$user_id', '$sub_id', $email_queue_id ,'', '" . date("Y-m-d H:i:s") . "' , $status , '$error_code') ";
                $res = $mysqli->query($sql);
                
                echo '<br><b>'.$i.'. "'.$email.'" process success!!!</b><br>';
                $i++;
            }

            $sql = "UPDATE email_queue SET status = '0' WHERE id = '$email_queue_id'";
            $res = $mysqli->query($sql);

            echo '<br>+++++++++++++ Done ++++++++++++++++<br>';
        }
    }else{
        die('no request found!');
    }



?>
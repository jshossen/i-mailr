<?php
session_start();
include "../../config/connection.php";
include "../functions.php";
$mysqli=db_connect();

$user_id = $_SESSION['user_id'];
$status = $_SESSION['pakage'];
$data = $_REQUEST;

//var_dump($data);die();
if($_REQUEST['status'] == "VALID" && $_SESSION['SSLCOMMERZ_TRAN_ID'] != ""){
	$sql = "UPDATE users SET status = '$status' WHERE id = '$user_id'";
	if($mysqli->query($sql)){
		add_user_meta($user_id,"Payment_date",date("Y-m-d H:i:s"));
		add_user_meta($user_id,"Payment_data",json_encode($data));
		set_default_value($user_id);
		header("Location:".BASE."/dashboard");
	}else{
		echo "Something error happen! Please contact with us. (mysql)";
	}
}else{
	echo "Something error happen! Please contact with us. (invalid payment)";
}



?>
<?php

use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;

require 'start.php';

if(!isset($_GET['success'], $_GET['paymentId'], $_GET['PayerID'])){
	die();
}

if((bool)$_GET['success'] === false){
	die();
}

$paymentId = $_GET['paymentId'];
$payerId = $_GET['PayerID'];

$payment = Payment::get($paymentId, $paypal);

$execute = new PaymentExecution();
$execute->setPayerId($payerId);

try{
	$result = $payment->execute($execute,$paypal);
}catch(Exception $e){
	$data = json_decode($e->getData());
	var_dump($data->message);
	die($e);
}

$data['paymentId'] = $paymentId;
$data['payerId'] = $payerId;
$data['token'] = $_GET['token'];

$status = $_SESSION['pakage'];
$sql = "UPDATE users SET status = '$status' WHERE id = '$user_id'";
if($mysqli->query($sql)){
	add_user_meta($user_id,"Payment_date",date("Y-m-d H:i:s"));
	add_user_meta($user_id,"Payment_data",json_encode($data));
	set_default_value($user_id);
	header("Location:".BASE."/dashboard");
}else{
	echo "Something error happen! Please contact with us.";
}
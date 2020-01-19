<?php

	require 'vendor/autoload.php';

	session_start();
	$user_id = $_SESSION['user_id'];

	include "../../config/connection.php";
	include "../functions.php";
	$mysqli=db_connect();

	define('SITE_URL', BASE);
	$paypal = new \PayPal\Rest\ApiContext(
		new \PayPal\Auth\OAuthTokenCredential(
			PAY_PAL_CLIENTID,PAY_PAL_SECRET
		)
	);
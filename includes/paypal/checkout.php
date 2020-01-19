<?php
	
	use PayPal\Api\Payer;
	use PayPal\Api\Item;
	use PayPal\Api\ItemList;
	use PayPal\Api\Details;
	use PayPal\Api\Amount;
	use PayPal\Api\Transaction;
	use PayPal\Api\RedirectUrls;
	use PayPal\Api\Payment;


	require 'start.php';

	if(!isset($_POST['product'], $_POST['price'])){
		die();
	}

	$product = $_POST['product'];
	$price = $_POST['price'];
	$shipping = 0.00;
	$total = $price+$shipping;

	if($total == 4.99){
		if($_SESSION['user_info']['status'] != 2){
			$_SESSION['pakage'] = 2;
		}else{
			echo "You are not eligible for pro plan.";die();
		}
	}else if($total == 9.99){
		if($_SESSION['user_info']['status'] != 3){
			$_SESSION['pakage'] = 3;
		}else{
			echo "You are not eligible for premium plan.";die();
		}
	}else{	
		die();
	}

	$payer = new Payer();
	$payer->setPaymentMethod('paypal');

	$item = new Item();
	$item->setName($product)
		->setCurrency("USD")
		->setQuantity(1)
		->setPrice($price);

	$itemList = new ItemList();
	$itemList->setItems([$item]);

	$details = new Details();
	$details->setShipping($shipping)
		->setSubtotal($price);

	$amount = new Amount();
	$amount->setCurrency('USD')
		->setTotal($total)
		->setDetails($details);

	$transaction = new Transaction();
	$transaction->setAmount($amount)
		->setItemList($itemList)
		->setDescription('I-mailr payment')
		->setInvoiceNumber(uniqid());

	$redirectUrls = new RedirectUrls();
	$redirectUrls->setReturnUrl(SITE_URL . '/includes/paypal/pay.php?success=true')
		->setCancelUrl(SITE_URL . '/includes/paypal/pay.php?success=false');

	$payment = new Payment();
	$payment->setIntent('sale')
		->setPayer($payer)
		->setRedirectUrls($redirectUrls)
		->setTransactions([$transaction]);


	try {
		$payment->create($paypal);
	} catch (Exception $e) {
		echo "<pre>";
		die($e);
	}

	$approvalUrl = $payment->getApprovalLink();

	header("Location: {$approvalUrl}");






















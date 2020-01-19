<?php
	form_processor();
	include "files/home/phpsection/header.php";
	if(logged_in()){
?>
<div class="container" style="padding-top: 100px;">
	<div class="row">
	  <div class="col-md-6">
	    <ul class="price" style="background-color: white;">
	      <li class="header" style="background-color:#2c4869">Pro</li>
	      <li class="grey">$ 4.99 / month<br>TK 400 / month</li>
	      <li>Unlimited email</li>
	      <li>40 Pages</li>
	      <li>1000 Subscribers</li>
	      <li>API integration</li>
	      <li>Customer service</li>
	      <li class="grey"><input type="radio" name="optionsRadios" id="optionsRadios3" value="pro" checked="true" onchange="set_price(this)"> <img src="https://cdn.shopify.com/s/assets/checkout/offsite-gateway-logos/paypal@2x-2cabd13111981089fdf7f9faee0ef21550690cd2d380dede9fb7bc8c1253b3c6.png" style="height: 24px;"></li>
	      <li class="grey"><input type="radio" name="optionsRadios" id="optionsRadios3" value="pro_bd" onchange="set_price(this)"> <label>Payment from bangladesh</label></li>
	    </ul>
	  </div>

	  <div class="col-md-6">
	    <ul class="price" style="background-color: white;">
	      <li class="header" style="background-color:#2c4869">Premium</li>
	      <li class="grey">$ 9.99 / month <br>TK 800 / month</li>
	      <li>Unlimited email</li>
	      <li>100 Pages</li>
	      <li>2000 Subscribers</li>
	      <li>API integration</li>
	      <li>Customer service</li>
	      <li class="grey"><input type="radio" name="optionsRadios" id="optionsRadios3" value="premium" onchange="set_price(this)"> <img src="https://cdn.shopify.com/s/assets/checkout/offsite-gateway-logos/paypal@2x-2cabd13111981089fdf7f9faee0ef21550690cd2d380dede9fb7bc8c1253b3c6.png" style="height: 24px;"></li>
	      <li class="grey"><input type="radio" name="optionsRadios" id="optionsRadios3" value="premium_bd" onchange="set_price(this)"> <label>Payment from bangladesh</label></li>
	    </ul>
	  </div>
	  <div class="col-md-12 text-center">
	    <img src="https://d67lzadkyx0.cloudfront.net/files/uploads/596e79df82c01uploaded_56.png">
	    <form action="<?php echo BASE ?>/includes/paypal/checkout.php" method="post" id="payment_form">
	    	<input type="hidden" name="product" value="Instant Mailer Pro" id="product">
	    	<input type="hidden" name="price" value="4.99" id="price">
	    	<input type="hidden" name="bd_payment" value="false" id="bd_payment">
	    	<button type="submit" class="btn btn-primary btn-lg btn-block">Upgrade your plan now</button>
	    </form>
	  </div>
	</div>
</div>
<script type="text/javascript">
	function set_price(me){
		if($(me)[0].value == "pro"){
			$("#product")[0].value = "Instant Mailer Pro";
			$("#price")[0].value = 4.99;
			$("#bd_payment")[0].value = false;
			$('#payment_form').attr('action', base+"/includes/paypal/checkout.php");
		}else if($(me)[0].value == "premium"){
			$("#product")[0].value = "Instant Mailer Premium";
			$("#price")[0].value = 9.99;
			$("#bd_payment")[0].value = false;
			$('#payment_form').attr('action', base+"/includes/paypal/checkout.php");
		}else if($(me)[0].value == "pro_bd"){
			$("#product")[0].value = "Instant Mailer pro";
			$("#price")[0].value = 400;
			$("#bd_payment")[0].value = true;
			$('#payment_form').attr('action', base+"/includes/bd_payment/index.php");
		}else if($(me)[0].value == "premium_bd"){
			$("#product")[0].value = "Instant Mailer Premium";
			$("#price")[0].value = 800;
			$("#bd_payment")[0].value = true;
			$('#payment_form').attr('action', base+"/includes/bd_payment/index.php");
		}
	}
</script>
<?php
	}else{
?>
		<div class="container" style="padding-top: 100px;">
		  <div class="row">
		    <div class="col-md-4">
		      <ul class="price" style="background-color: white;">
		        <li class="header" style="background-color:#2c4869">Free</li>
		        <li class="grey">$ 0 / month <br>TK 0 / month</li>
		        <li>Unlimited email</li>
		        <li>10 Pages</li>
		        <li>400 Subscribers</li>
		        <li>API integration</li>
		        <li>Customer service</li>
		      </ul>
		    </div>

		    <div class="col-md-4">
		      <ul class="price" style="background-color: white;">
		        <li class="header" style="background-color:#2c4869">Pro</li>
		        <li class="grey">$ 4.99 / month <br>TK 400 / month</li>
		        <li>Unlimited email</li>
		        <li>40 Pages</li>
		        <li>1000 Subscribers</li>
		        <li>API integration</li>
		        <li>Customer service</li>
		      </ul>
		    </div>

		    <div class="col-md-4">
		      <ul class="price" style="background-color: white;">
		        <li class="header" style="background-color:#2c4869">Premium</li>
		        <li class="grey">$ 9.99 / month <br>TK 800 / month</li>
		        <li>Unlimited email</li>
		        <li>100 Pages</li>
		        <li>2000 Subscribers</li>
		        <li>API integration</li>
		        <li>Customer service</li>
		      </ul>
		    </div>
		  </div>
		</div>
<?php
	}
    include "files/home/phpsection/footer.php";
?>
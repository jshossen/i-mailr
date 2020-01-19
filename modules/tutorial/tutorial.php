<?php
    include "files/home/phpsection/header.php";
?>
<div class="container">
    <!-- Jumbotron -->
    <div class="jumbotron box_shadow">
		<div class="accordion" id="accordion" role="tablist" aria-multiselectable="true">
			<h1 class="panel-title" style="color: #2c4869;">Tutorial</h1>

			<hr>

			<!-- Create an account -->
	        <div class="panel">
	            <a class="panel-heading" style="text-align: left; background-color: #EDEDED;" role="tab" id="variant_msg_1" data-toggle="collapse" data-parent="#accordion" href="#create_account" aria-expanded="true" aria-controls="create_account">
	                <h4 class="panel-title">How to create an account?</h4>
	            </a>
	            <div id="create_account" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="variant_msg_1" aria-expanded="true" style="">
	                <div class="panel-body">
	                	<b>There are three ways to create an account.</b> <br>
	                	<b>1. I-mailr</b>
	                     <ul>
	                     	<li>Step 1: Click <b>"Sign up"</b> button in the navigation bar.</li>
	                     	<li>Step 2: Give your <b>"Name", "E-mail Address", "Password", "Confirm Password."</b>. then click <b>"Register button"</b>. (Please give your valid email address. Also keep your password and confirm password same). Here is an image to help you:<br>
	                     	<img width="600px" src="<?php echo BASE?>/files/home/img/tutorial_1.png"></li>
	                     	<li>Step 3: Then sign in your email-address to confirm your mail address.</li>
	                     	<li>Step 4: Click the link from our mail adress and you are done. TADA......</li>
	                     </ul>

	                     <b>2. Google sign in</b>
	                     <ul>
	                     	<li>Step 1: Click <b>"Sign up"</b> button in the navigation bar.</li>
	                     	<li>Step 2: Click to the <b>"Log in with google"</b> in the sign up or sign in page.
	                     	<li>Step 3: Then sign in your email-address. And you are done for. TADA.. :)
	                     </ul>

	                     <b>3. Facebook sign in</b>
	                     <ul>
	                     	<li>Step 1: Click <b>"Sign up"</b> button in the navigation bar.</li>
	                     	<li>Step 2: Click to the <b>"Log in with facebook"</b> in the sign up or sign in page.
	                     	<li>Step 3: Then log in your facebook. And you are done for. TADA.. :)
	                     </ul>
	                </div>
	            </div>
	        </div>

	        <!-- Sign in or log in -->
	        <div class="panel" id="sign_in">
	            <a class="panel-heading" style="text-align: left; background-color: #EDEDED;" role="tab" id="variant_msg_1" data-toggle="collapse" data-parent="#accordion" href="#sign_in_fb_google" aria-expanded="true" aria-controls="sign_in_fb_google">
	                <h4 class="panel-title">How to sign in or log in?</h4>
	            </a>
	            <div id="sign_in_fb_google" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="varcustom_variableiant_msg_1" aria-expanded="true" style="">
	                <div class="panel-body">
						<b>There are three ways to sing in an account.</b> <br>
	                	<b>1. I-mailr</b>
	                     <ul>
	                     	<li>Step 1: Click <b>"Sign in"</b> button in the navigation bar.</li>
	                     	<li>Step 2: Give your <b>"E-mail Address", "Password"</b>. then click <b>"Login"</b> button. (Please give email and password same when you sign up). Here is an image to help you:<br>
	                     	<img width="600px" src="<?php echo BASE?>/files/home/img/tutorial_3.png"></li>
	         				<b>That's it....</b>
	                     </ul>

	                     <b>2. Google sign in</b>
	                     <ul>
	                     	<li>Step 1: Click <b>"Sign up" or "Sign in"</b> button in the navigation bar.</li>
	                     	<li>Step 2: Click to the <b>"Log in with google"</b> in the sign up or sign in page.
	                     	<li>Step 3: Then sign in your email-address. And you are done for. TADA.. :)
	                     </ul>

	                     <b>2. Facebook sign in</b>
	                     <ul>
	                     	<li>Step 1: Click <b>"Sign up" or "Sign in"</b> button in the navigation bar.</li>
	                     	<li>Step 2: Click to the <b>"Log in with facebook"</b> in the sign up or sign in page.
	                     	<li>Step 3: Then log in your facebook. And you are done for. TADA.. :)
	                     </ul>
	                </div>
	            </div>
	        </div>

	        <!-- create pages or email pages -->
	        <div class="panel">
	            <a class="panel-heading" style="text-align: left; background-color: #EDEDED;" role="tab" id="variant_msg_1" data-toggle="collapse" data-parent="#accordion" href="#email_and_send" aria-expanded="true" aria-controls="email_and_send">
	                <h4 class="panel-title">How to create a pages or email pages?</h4>
	            </a>
	            <div id="email_and_send" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="variant_msg_1" aria-expanded="true" style="">
	                <div class="panel-body">
						<p>Here are some steps to create a pages or email pages</p> <br>
	                     <ul>
	                     	<li>Step 1: <b>"Sign in or Log in"</b> to your account. If you don't know how to "Sign in or Log in" then please check <b>How to sign in or log in?</b> </li>
	                     	<li>Step 2: Click on <b>"Dashboard".</b>  To create a page or email list click on <b>"+ New"</b> button on <b>"Dashboard"</b>. Here is a video to help you: <br> </li>
	                     	<div class="embed-responsive embed-responsive-16by9">
							  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/sJ_cfGtFgco" allowfullscreen></iframe>
							</div><br>
	         				<b>That's it....</b>
	                     </ul>
	                </div>
	            </div>
	        </div>

	        <!-- create subscriber lists -->
	        <div class="panel">
	            <a class="panel-heading" style="text-align: left; background-color: #EDEDED;" role="tab" id="variant_msg_1" data-toggle="collapse" data-parent="#accordion" href="#subscribers_list" aria-expanded="true" aria-controls="subscribers_list">
	                <h4 class="panel-title">How to make subscriber lists?</h4>
	            </a>
	            <div id="subscribers_list" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="varcustom_variableiant_msg_1" aria-expanded="true" style="">
	                <div class="panel-body">
						<p>Here are some steps to make a subscriber list:</p> <br>
	                     <ul>
	                     	<li>Step 1: <b>"Sign in or Log in"</b> to your account. If you don't know how to "Sign in or Log in" then please check <b>How to sign in or log in?</b> </li>
	                     	<li>Step 2: Click on <b>"Subscriber -> All subscriber".</b>  To make a subscribers list click on <b>"+ New"</b> button on Subscriber list. <br> </li>
	                     	<li>Step 3: Then select subscribers and add then to a list. Here is a video to help you:  </li>
	                     	<div class="embed-responsive embed-responsive-16by9">
							  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/xiBZkJfOkEM" allowfullscreen></iframe>
							</div><br>
	         				<b>That's it....</b>
	                     </ul>
	                </div>
	            </div>
	        </div>

	        <!-- create custom variables -->
	        <div class="panel">
	            <a class="panel-heading" style="text-align: left; background-color: #EDEDED;" role="tab" id="variant_msg_1" data-toggle="collapse" data-parent="#accordion" href="#custom_variable" aria-expanded="true" aria-controls="custom_variable">
	                <h4 class="panel-title">How to create custom variables and how to use them?</h4>
	            </a>
	            <div id="custom_variable" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="varcustom_variableiant_msg_1" aria-expanded="true" style="">
	                <div class="panel-body">
	                <p>Here are some steps to create custom variables and how to use them:</p> <br>
	                     <ul>
	                     	<li>Step 1: <b>"Sign in or Log in"</b> to your account. If you don't know how to "Sign in or Log in" then please check <b>How to sign in or log in?</b> </li>
	                     	<li>Step 2: Make one or more subscriber and also create a list of subscriber. If you don't know how to make a subscriber list, then please check <b>"How to make subscriber lists?"</b> <br> </li>
	                     	<li>Step 3: After you create a subscriber list you can add one or more "cuustom variable". And also you can use those variables to send email. Here is a video to help you:</li>
	                     	<div class="embed-responsive embed-responsive-16by9">
							  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/iUkP_amRpCc" allowfullscreen></iframe>
							</div><br>
	         				<b>That's it....</b>
	                     </ul>
	                </div>
	            </div>
	        </div>

	        <!-- connect with google and send email to subscribers -->
	        <div class="panel">
	            <a class="panel-heading" style="text-align: left; background-color: #EDEDED;" role="tab" id="variant_msg_1" data-toggle="collapse" data-parent="#accordion" href="#send_email" aria-expanded="true" aria-controls="send_email">
	                <h4 class="panel-title">How to connect with google and send email to subscriber?</h4>
	            </a>
	            <div id="send_email" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="varcustom_variableiant_msg_1" aria-expanded="true" style="">
	                <div class="panel-body">
						<p>Here are some steps to send email to subscribers:</p> <br>
	                     <ul>
	                     	<li>Step 1: <b>"Sign in or Log in"</b> to your account. If you don't know how to "Sign in or Log in" then please check <b>How to sign in or log in?</b> </li>
	                     	<li>Step 2: Click on <b>"Auth settings"</b> and click connect on google button. <br> </li>
	                     	<li>Step 3: After you auth in google, make "Email pages" and send that page to the subscribers. Here is a video to help you:  </li>
	                     	<div class="embed-responsive embed-responsive-16by9">
							  <iframe class="embed-responsive-item" src="https://www.youtube.com/embed/W4pcM0mrjYM" allowfullscreen></iframe>
							</div><br>
	         				<b>That's it....</b>
	                     </ul>
	                </div>
	            </div>
	        </div>

	        <!-- how to pay -->
	        <div class="panel" style="display: none;">
	            <a class="panel-heading" style="text-align: left; background-color: #EDEDED;" role="tab" id="variant_msg_1" data-toggle="collapse" data-parent="#accordion" href="#pay" aria-expanded="true" aria-controls="pay">
	                <h4 class="panel-title">How to pay?</h4>
	            </a>
	            <div id="pay" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="varcustom_variableiant_msg_1" aria-expanded="true" style="">
	                <div class="panel-body">

	                </div>
	            </div>
	        </div>

	        <!-- Contact with us -->
	        <div class="panel">
	            <a class="panel-heading" style="text-align: left; background-color: #EDEDED;" role="tab" id="variant_msg_1" data-toggle="collapse" data-parent="#accordion" href="#contact_us" aria-expanded="true" aria-controls="contact_us">
	                <h4 class="panel-title">How to contact with us?</h4>
	            </a>
	            <div id="contact_us" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="varcustom_variableiant_msg_1" aria-expanded="true" style="">
	                <div class="panel-body">
						<b>It's easy to contact with us. Just </b> <br>
						<ul>
	                     	<li>Step 1: Click <b>"Contact"</b> button in the navigation bar.</li>

	                     	<li>Step 2: Give your <b>"Name", "E-mail Address", "Subject", "Message"</b>. then click <b>"Submit"</b> button. Here is an example: <br>
	                     	<img width="600px" src="<?php echo BASE?>/files/home/img/tutorial_2.png"></li>

	                     	Then we will contact with you when we see your question.
	                     </ul>

	                </div>
	            </div>
	        </div>

	    </div>
	</div>
</div>
<?php
    include "files/home/phpsection/footer.php";
?>
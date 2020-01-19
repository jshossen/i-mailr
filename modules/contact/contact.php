<?php
	form_processor();
    include "files/home/phpsection/header.php";
?>
<div class="container">
	<div class="jumbotron box_shadow">
		<div class="row">
			<div class="col-md-12">
				<div style="max-width: 600px; float: none; margin: 0 auto;">
					<h2>Contact us</h2>
					<div class="note">
				      <p>We are here to answer any questions you may have about our i-mailr experiences. Reach out to us and we'll respond as soon as we can.</p>
				      <p>Even if there is something you have always wanted to experience and can't find it on i-mailr, let us know and we promise we'll do our best to find it for you and send you there.</p>
				    </div>
				    <hr>
				    <?php 
				    	if(isset($_REQUEST['success']) && $_REQUEST['success'] == "true"){
				    ?>
					    <div class="alert alert-success">
	                        Your message sent successfully.
	                    </div>
	                <?php
	                	}
	                ?>
					<form action="<?php echo BASE; ?>/contact/?process=send_contact_us_email" method="post">
						<div class="form-group"> <!-- Name field -->
							<label class="control-label " for="name">Name</label>
							<input class="form-control" id="name" name="name" type="text"/>
						</div>
						
						<div class="form-group"> <!-- Email field -->
							<label class="control-label requiredField" for="email">Email<span class="asteriskField">*</span></label>
							<input class="form-control" id="email" name="email" type="text"/>
						</div>
						
						<div class="form-group"> <!-- Subject field -->
							<label class="control-label " for="subject">Subject</label>
							<input class="form-control" id="subject" name="subject" type="text"/>
						</div>
						
						<div class="form-group"> <!-- Message field -->
							<label class="control-label " for="message">Message</label>
							<textarea class="form-control" cols="20" id="message" name="message" rows="3"></textarea>
						</div>
						
						<div class="form-group">
							<button class="btn btn-primary " name="submit" type="submit">Submit</button>
						</div>
					</form>		
				</div>
			</div>
		</div>	
	</div>					
</div>
<?php
    include "files/home/phpsection/footer.php";
    function process_send_contact_us_email(){
    	$to = CONTACT_EMAIL;
		$subject = $_REQUEST['subject'];
		$message = $_REQUEST['email'].': '.$_REQUEST['message'];
		//mail($to,$subject,$message);

		$header = "From:contact@i-mailr.com \r\n";
		$header .= "MIME-Version: 1.0\r\n";
		$header .= "Content-type: text/html\r\n";

		$retval = mail ($to,$subject,$message,$header);

		if( $retval == true ) {
			header("Location: ".BASE."/contact/?success=true");
		}else {
			echo "Message could not be sent...";
		}		
    }
?>

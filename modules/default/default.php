<?php
if(logged_in()){
	form_processor();
?>
<a href="<?php echo BASE; ?>/dashboard">Go to dashboard</a>
<?php
}else{
	please_go("sign_in");
}
?>
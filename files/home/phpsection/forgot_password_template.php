<?php
	if(isset($_REQUEST['token']) && isset($_REQUEST['email'])){
		include "../../../config/connection.php";
?>
		<a href="<?php echo BASE; ?>/reset_my_pass/?token=<?php echo $_REQUEST['token']; ?>&email=<?php echo $_REQUEST['email'] ?>">Reset now</a>
<?php
	}
?>
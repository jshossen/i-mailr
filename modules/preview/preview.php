<?php 
	header('Access-Control-Allow-Origin: *');
	form_processor();
	module_include("page_creator");
	if( isset( $_REQUEST['page'] ) ) {
		$page_id = $_REQUEST['page'];
		display_page( $page_id );
	}else{
		echo display404(BASE);
	}
?>

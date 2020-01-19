<?php
if(true)
{
	include_once("../../../config/connection.php");
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body data-affiliate-param="affiliate_id">
	<div class="body_container do_not_show_my_menu text-center">
		<div class="main_container" style="background-color: white;">
			<!-- <div class="container">
				<div class="row">
					<div class="col-sm-12"> -->
						<?php
							if(isset($_REQUEST['id']))
							{
								include 'template-'.$_REQUEST['id'].'.php';
							}
						?>
					<!-- </div>
				</div>
			</div> -->
		</div>
	</div>
</body></html>
<?php } ?>

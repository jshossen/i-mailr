<?php
if(logged_in()){
	form_processor();
    include "files/dashboard/phpsection/header.php";
?>
    <div id="page-wrapper">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Trash</h1>
            </div>
        </div>
        <div class="row">
        	<div class="col-sm-12">
        		<div class="panel panel-info">
                    <div class="panel-heading">
                        Deleted email and page list
                    </div>
                    <div class="panel-body">
                    	<div id="trash_email_and_page_list">
                        	<div class="text-center">
                        		<i class="fa fa-spinner fa-5x fa-spin" aria-hidden="true"></i>
                        	</div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        Panel Footer
                    </div>
                </div>
        	</div>
        </div>
	</div>
<?php
    include "files/dashboard/phpsection/footer.php";
}else{
	please_go("sign_in");
}
?>
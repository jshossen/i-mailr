<?php
if(logged_in()){
	form_processor();
    include "files/dashboard/phpsection/header.php";
?>
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Dashboard</h1>
                </div>
                <div class="col-lg-12" style="padding: 15px;">
                    <button class="btn btn-info pull-right" data-toggle="modal" data-target="#create_page"><i class="fa fa-plus" aria-hidden="true"></i> Create new page or email</button>
                    <?php include "files/dashboard/phpsection/create_page.php" ?>
                </div>
                <br>
                <!-- /.col-lg-12 -->
            </div>
            <div class="row">
            	<div class="col-sm-12">
            		<div class="panel panel-info">
                        <div class="panel-heading">
                            Page list
                        </div>
                        <div class="panel-body">
                            Manage your pages. Create, update and share with your social friends.
                        	<div id="page_list">
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
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Email list
                        </div>
                        <div class="panel-body">
                            Manage your emails templates.
                            <div id="email_list">
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
        <!-- /#page-wrapper -->
        <div id="share_page_modal" class="modal fade" role="dialog">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLongTitle">Preview</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div id="preview_screen">
                            <div class="embed-responsive embed-responsive-16by9">
                                <iframe id="page_preview_frame" class="embed-responsive-item" src=""></iframe>
                            </div>
                        </div>
                        <div id="share_screen" style="display: none;">
                            share screen
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" onclick="show_share_div();" id="next_button">Next <i class="fa fa-arrow-right"></i></button>
                        <button type="button" class="btn btn-primary" onclick="show_preview_div();" id="preview_button"><i class="fa fa fa-arrow-left"></i> Preview</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <script type="text/javascript">
            function show_share_div(){
                $("#preview_screen").hide();
                $("#preview_button").show();
                $("#next_button").hide();
                $("#share_screen").show();

            }
            function show_preview_div(){
                $("#preview_screen").show();
                $("#preview_button").hide();
                $("#next_button").show();
                $("#share_screen").hide();
            }
            function open_preview_modal(page_id, me){
                $("#page_preview_frame")[0].src = base+"/preview/?page="+page_id;
                var data = 'page_id=' +  page_id;
                http_post_request( base + '/processor/?process=get_page_share_div', data , 'open_preview_modal_done' );
                $("#preview_screen").show();
                $("#next_button").show();
                $("#share_screen").hide();
                $("#preview_button").hide();
            }
            function open_preview_modal_done(res){
                $("#share_screen")[0].innerHTML = res;
                gen_select_group_list();
                
                jQuery('#sending_time').datetimepicker({
                    format:'Y-m-d H:i:s',
                });
            }

            function check_send_email_info(me){
                console.log($(me));
                $('.error').hide();
                var email = $(me).find('#selected_email')[0];
                var selected_group_list = $(me).find('#selected_group_list')[0];
                var email_subject = $(me).find('#email_subject')[0];

                if(email.value == ""){
                    $('.email_error').show();
                    return false;
                }
                if(selected_group_list.value == ""){
                    $('.s_list_error').show();
                    return false;
                }
                if(email_subject.value == ""){
                    $('.subject_error').show();
                    return false;
                }


                return true;
            }
        </script>
<?php
    include "files/dashboard/phpsection/footer.php";
}else{
	please_go("sign_in");
}
?>
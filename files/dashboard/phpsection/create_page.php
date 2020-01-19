<!-- Modal -->
<div id="create_page" class="modal fade" role="dialog">
  	<div class="modal-dialog modal-lg">
    	<!-- Modal content-->
    	<div class="modal-content">
		    <div class="row form-group">
	            <div class="col-xs-12">
	                <ul class="nav nav-pills nav-justified thumbnail setup-panel">
	                    <li class="active"><a href="#step-1">
	                        <h4 class="list-group-item-heading">Step 1</h4>
	                        <p class="list-group-item-text">Set page type</p>
	                    </a></li>
	                    <li class="disabled"><a href="#step-2" id="page_name_and_title_li">
	                        <h4 class="list-group-item-heading">Step 2</h4>
	                        <p class="list-group-item-text">Set page name and title</p>
	                    </a></li>
	                    <li class="disabled"><a href="#step-3">
	                        <h4 class="list-group-item-heading">Step 3</h4>
	                        <p class="list-group-item-text">Set page template</p>
	                    </a></li>
	                    <li class="disabled"><a href="#step-4">
	                        <h4 class="list-group-item-heading">Step 4</h4>
	                        <p class="list-group-item-text">Final step</p>
	                    </a></li>    
	                </ul>
	            </div>
		    </div>
		    <div class="row setup-content" id="step-1">
		        <div class="col-xs-12">
		            <div class="col-md-12 well text-center">
		            	<h1>Select page type</h1>
		                <div class="row">
		                	<div class="col-sm-6">
			                    <div class="panel panel-primary border-5px" onclick="set_this_page_type('page',this);" style="width: 89%; margin: 13px auto; padding: 12px;">
			                        <div class="panel-heading">
			                            <div class="row">
			                                <div class="col-xs-12">
			                                    <i class="fa fa-file-text-o fa-5x"></i>
			                                </div>
			                            </div>
			                        </div>
			                        <a href="#" style="text-decoration: none;">
			                            <div class="panel-footer">
			                            	<div class="huge" style="text-align: center;"><span>Page</span></div>
			                                <div class="clearfix"></div>
			                            </div>
			                        </a>
			                    </div>
			                </div>
			                <div class="col-sm-6">
			                    <div class="panel panel-primary" onclick="set_this_page_type('email',this);" style="width: 89%; margin: 13px auto; padding: 12px;">
			                        <div class="panel-heading">
			                            <div class="row">
			                                <div class="col-xs-12">
			                                    <i class="fa fa-envelope-o fa-5x"></i>
			                                </div>
			                            </div>
			                        </div>
			                        <a href="#" style="text-decoration: none;">
			                            <div class="panel-footer">
			                            	<div class="huge" style="text-align: center;"><span>Email Template</span></div>
			                                <div class="clearfix"></div>
			                            </div>
			                        </a>
			                    </div>
			                </div>
			            </div>
		                
		                <button id="activate-step-2" class="btn btn-primary btn-md margin-top-15px">Set page name and title <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
		            </div>
		        </div>
		    </div>

		    <div class="row setup-content" id="step-2">
		        <div class="col-xs-12">
		            <div class="col-md-12 well text-center">
		                <div class="form-group">
		                    <label>Page name</label>
		                    <p class="error" id="page_name_error" style="display: none;">Please give a name</p>
		                    <input class="form-control" placeholder="Name" onchange="set_page_name_title('page_name',this);">
		                </div>

		                <div class="form-group">
		                    <label>Page title</label>
		                    <p class="error" id="page_title_error" style="display: none;">Please give a title</p>
		                    <input class="form-control" placeholder="Title" onchange="set_page_name_title('page_title',this);">
		                </div>

		                <div class="form-group">
		                    <label>Page handle</label>
		                    <p class="error" id="page_title_error" style="display: none;">Please give a handle</p>
		                    <input class="form-control" placeholder="Handle" onchange="set_page_name_title('page_handle',this);">
		                </div>
		<!--<form></form> --> 
		                
		                <button id="activate-step-3" class="btn btn-primary btn-md">Set a template <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
		            </div>
		        </div>
		    </div>

		    <div class="row setup-content" id="step-3">
		        <div class="col-xs-12">
		            <div class="col-md-12 well text-center">
		                <h1 class="text-center">Select a template</h1>
		                <div class="row" id="template_list_container">
		                	
		                </div>
		<!--<form></form> --> 
		                
		                <button id="activate-step-4" class="btn btn-primary btn-md">Next <i class="fa fa-arrow-right" aria-hidden="true"></i></button>
		            </div>
		        </div>
		    </div>
		    <div class="row setup-content" id="step-4">
		        <div class="col-xs-12">
		            <div class="col-md-12 well text-center">
		                <button class="btn btn-lg btn-success" onclick="create_new_page();" style="min-width: 300px;"><i class="fa fa-check fa-5x" aria-hidden="true"></i> Create</button>
		<!--<form></form> -->
		            </div>
		        </div>
		    </div>
		</div>
	</div>
</div>
<input type="hidden" id="page_type" value="page">
<input type="hidden" id="page_name" value="">
<input type="hidden" id="page_title" value="">
<input type="hidden" id="page_handle" value="">
<textarea id="page_template" hidden>[{"tag":"div","endtag":1,"attributes":{"class":"body_container do_not_show_my_menu text-center"},"content":"","nodes":[{"tag":"div","endtag":1,"attributes":{"class":"main_container"},"content":"","nodes":[{"tag":"div","endtag":1,"attributes":{"class":"container"},"content":"","nodes":[{"tag":"div","endtag":1,"attributes":{"class":"row"},"content":"","nodes":[{"tag":"div","endtag":1,"attributes":{"class":"col-sm-12"},"content":"","nodes":[{"tag":"div","endtag":1,"attributes":{"class":""},"content":"","nodes":[]}]}]}]}]}]}]</textarea>
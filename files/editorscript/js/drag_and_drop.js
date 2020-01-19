//~JSON TO HTML GENERATOR
function make_sortable(id_or_class){
	try {
	    $(id_or_class).sortable({
			start : function(event, ui){
				my_id = ui.helper[0].id;
				my_prev_parent_id = ui.helper[0].parentElement.id;
				drag_running = true;
			},
			receive: function(event, ui) {
				my_new_parent_id = ui.item[0].parentElement.id;
				if(ui.item[0].previousSibling != null && ui.item[0].previousSibling.length > 0){
					my_new_prev_id = ui.item[0].previousSibling.id;
					if(my_new_prev_id == 'empty_div_add_btn'){
						my_new_prev_id = null;
					}
				}else{
					my_new_prev_id = null;
				}
				var this_ui_item_array = drag_and_drop_elements(ui.item.attr("id"));
				if(this_ui_item_array != null){
					var deleted_element = JSON.stringify(this_ui_item_array['html']);
					var html_data = awesome_data;
					if( html_data != '' ) {
						html_data = JSON.parse( html_data );
					}
					document.getElementById('editor_preview_deleted_item').innerHTML = deleted_element;
					insert_element_to_json(JSON.parse(deleted_element), my_new_parent_id, my_new_prev_id, html_data);
				}
			},
			stop : function(event, ui){
				drag_running = false;
				my_new_parent_id = ui.item[0].parentElement.id;
				if(ui.item[0].previousSibling != null){
					my_new_prev_id = ui.item[0].previousSibling.id;
					if(my_new_prev_id == 'empty_div_add_btn'){
						my_new_prev_id = null;
					}
				}else{
					my_new_prev_id = null;
				}
				if(my_new_prev_id == ""){
					my_new_prev_id = null;
				}
				rearrange_json(my_id,my_prev_parent_id,my_new_parent_id,my_new_prev_id);
				overflow_control($('#div_editorpreview'));
				var sortedIDs = $(id_or_class).sortable( "toArray" );
			},
			helper: function (event, ui) {
				$(ui).removeClass("ui-sortable");
				$(ui).addClass("sortable_disabled");
				this.copyHelper = ui.clone().insertAfter(ui);
				return ui.clone();
			},
			placeholder: {
				element: function(currentItem) {
					return $('<div style="height: 5px; padding: 0; background-color: #F78828;" ></div>');
				},
				update: function(container, p) {
					remove_editor_hover_conf();
					$(container.element[0]).addClass("place_here_div");
					return;
				}
			},
			opacity: 0.6,
			revert: 'true',
			tolerance: "pointer",
			//cursor: 'url("images/grab_icon.png"), auto'
			cursor: 'move',
			//containment: "parent",
			delay: 150,
			dropOnEmpty: false,
			forcePlaceholderSize: true,
			cancel: ".sortable_disabled"
			//handle: ".move_me_please"
		});
		$( ".sortable_disabled" ).sortable({
		  disabled: true
		});
		$(id_or_class).sortable({
			connectWith: 'div,td'
		});

		$( "#move_me_please" ).draggable({
		  handle: "move_icon"
		});
	}
	catch(err) {
		$( id_or_class ).sortable( "cancel" );
	}
	//$("#page_preview").sortable( "disable" );
	/*$(".sortable_disabled").droppable({
	  	disabled: true,
	 	over: function( event, ui ){
        	$(this).parent().addClass("hide-placeholder")
		},
		out: function( event, ui ){
			$(this).parent().removeClass("hide-placeholder")
		}
	});*/
	
}

function sortable_state_change () {
	var open_popup = check_any_modal_open();
	if( open_popup != undefined){
		$("#"+open_popup[0].id).off("hidden.bs.modal");
		$("#"+open_popup[0].id).off("shown.bs.modal");
		$( ".body_container *" ).sortable({
		  disabled: true
		});

		$("#"+open_popup[0].id+" .modal-body *").sortable({
			disabled: false,
			connectWith: 'div'
		});
	 	$("#"+open_popup[0].id).on("shown.bs.modal", function () {
	      	setTimeout(function(){ sortable_state_change (); }, 500);
	    });
	    $("#"+open_popup[0].id).on("hidden.bs.modal", function () {
	        setTimeout(function(){ sortable_state_change (); }, 500);
	    });
	}else{
		//make_sortable(".body_container *");
		$( ".body_container *" ).sortable({
		  disabled: false
		});
		$( ".body_container .modal" ).sortable({
		  disabled: true
		});
		$( ".body_container .modal *" ).sortable({
		  disabled: true
		});
	}
}

function change_cursor(ui){
	//$('body').css('cursor','url(http://www.creativeadornments.com/nephco/doraemon/cursors/doraemon_5cursor.gif), auto');
	ui.item[0].style.cursor = "url('http://www.creativeadornments.com/nephco/doraemon/cursors/doraemon_5cursor.gif'), auto";
}

function this_is_me(e,eve){
	if(!$(e).hasClass( "do_not_show_my_menu") && !$(e).hasClass( "hover_disable") && !$(e).hasClass("modal_close_btn") && drag_running == false && $(e)[0].type != 'checkbox'){
		var me = e;
		eve.stopPropagation();
		remove_editor_hover_conf();//gloval_val.js
		$(e).addClass('hover_show_my_border');
		
		var add_new_btn ="";
		if($("#"+me.id)[0].className.indexOf("col-") == -1 && $("#"+me.id)[0].tagName != "TD"){
			add_new_btn = add_new_btn + '<div onclick="hover_add_new(\''+me.id+'\')" class="pulse animated infinite circle hover_my_settings add_new_btn text-center">';
			add_new_btn = add_new_btn + '<span class="fa fa-plus" aria-hidden="true"></span>';
			//add_new_btn = add_new_btn + '<span onclick="hover_add_new(\''+me.id+'\')" class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>';
			add_new_btn = add_new_btn + '</div>';
		} 
		
		if(!$(me).hasClass("main_container")){
			var settings_div_with_move ="";
			
			//if($(me)[0].outerHTML.endsWith('</'+$(me)[0].tagName.toLowerCase()+'>') && !$(me).hasClass("timer_wrapper") && $(me)[0].tagName != "VIDEO"){
			if(show_menu_inner_or_outer_decision(me)){
				settings_div_with_move += '<div  class="hover_my_settings move_me_please" id="move_me_please">';
				settings_div_with_move += '<i class="glyphicon glyphicon-move move_icon up_settings_menu_i" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Move" style="cursor: move;"></i>';
				settings_div_with_move += '</div>';
			}
			settings_div_with_move += '<div  class="hover_my_settings up_settings_menu">';
			if($(me).hasClass("timer_wrapper")){
				settings_div_with_move += '<i onclick="set_hidden_timer_id(\''+me.id+'\')" class="glyphicon glyphicon-time timer_sett up_settings_menu_i" aria-hidden="true" data-toggle="modal" data-target="#timerPopup" data-placement="top" title="Settings"></i>';
			}
			settings_div_with_move += '<i onclick="hover_me(\''+me.id+'\')" class="copy_id fa fa-hashtag handle up_settings_menu_i" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Copy my id" style="cursor: pointer;"></i>';
			settings_div_with_move += '<i onclick="$(\'#add_to_lib_id\')[0].value = \''+me.id+'\'; load_personal_lib();" class="save_to_lib fa fa-floppy-o handle up_settings_menu_i" aria-hidden="true" data-toggle="modal" data-target="#my_library_modal" data-placement="top" title="Add to library" style="cursor: pointer;"></i>';
			settings_div_with_move += '<i onclick="hover_show_settings_panel(\''+me.id+'\')" class="glyphicon glyphicon-cog up_settings_menu_i settings" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Settings"></i>';
			if(!$(me).hasClass("timer_wrapper") && $(me)[0].tagName != "IFRAME" && !$(me).hasClass("dont_clone")){
				settings_div_with_move += '<i onclick="hover_make_a_clone(\''+me.id+'\')" class="glyphicon glyphicon-duplicate up_settings_menu_i clone" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Clone"></i>';
			}
			
			settings_div_with_move += '</div>';
			settings_div_with_move += '<div  class="hover_my_settings remove_me_please">';
			settings_div_with_move += '<i onclick="hover_remove_me(\''+me.id+'\')" class="fa fa-times up_settings_menu_i remove" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Remove"></i>';
			settings_div_with_move += '</div>';
			
			if ( show_menu_inner_or_outer_decision(me) ) {
				var id_of_me = $(me).attr("id");
				$('#' + id_of_me ).append(settings_div_with_move);
				if(add_new_btn != ""){
					$("#div_editorpreview").append(add_new_btn);
				}
				var top = $('#'+me.id).offset().top;
				var left = $('#'+me.id).offset().left;
				var width = me.offsetWidth;
				var height = me.offsetHeight;
				if(add_new_btn != ""){
					$(".add_new_btn").css({top: top+height-11.5, left: (left+(width/2)-20)});
				}

				$(".up_settings_menu").fadeIn(500);
				$(".up_settings_menu").css("display","-webkit-box");

				//$(".body_container *").sortable({handle: '.move_me_please'});
			}else{
	        	$("#div_editorpreview").append(settings_div_with_move);
	        	if(add_new_btn != ""){
	        		$("#div_editorpreview").append(add_new_btn);
	        	}
	        	var top = $('#'+me.id).offset().top;
				var left = $('#'+me.id).offset().left;
				var width = me.offsetWidth;
				var height = me.offsetHeight;

				$(".up_settings_menu").fadeIn(500);
				$(".up_settings_menu").css("display","inline-table");

				var up_right = $(me).offset().left + width;
				var up_width = $(".up_settings_menu")[0].offsetWidth;
				$(".up_settings_menu").css({top: top-19.5, left: (up_right - up_width)-(width/3) });
				$(".remove_me_please").css({top: top-5, left: up_right - 26 });
	        	$(".add_new_btn").css({top: top+height-11.5, left: (left+(width/2)-20)});
	        	$(".body_container *").sortable({handle: me});

	        	$(me).addClass("show_my_cursor_as_move");
	        	//$(me)[0].style.cursor = 'move';show_my_cursor_as_move
	        	if($(".sortable_disabled").length > 0){
	        		for(var i=0;i<$(".sortable_disabled").length;i++){
	        			$(".sortable_disabled")[i].style.cursor = 'default';
	        		}
	        	}
			}
		}else{
			var settings_div_for_only_settings ="";
			settings_div_for_only_settings += '<div class="hover_my_settings up_settings_menu">';
			settings_div_for_only_settings += '<i onclick="hover_me(\''+me.id+'\')" class="copy_id fa fa-hashtag handle up_settings_menu_i" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Copy my id" style="cursor: pointer;"></i>';
			settings_div_for_only_settings += '<i onclick="hover_show_settings_panel(\''+me.id+'\')" class="glyphicon glyphicon-cog up_settings_menu_i settings" aria-hidden="true" data-toggle="tooltip" data-placement="top" title="Settings"></i>';
			settings_div_for_only_settings += '</div>';

			var id_of_me = $(me).attr("id");
			$('#' + id_of_me ).append(settings_div_for_only_settings);

			$(".up_settings_menu").fadeIn(500);
			$(".up_settings_menu").css("display","-webkit-box");
		}

		$(".add_new_btn").fadeIn(250);
		$(".add_new_btn").css("display","inline-table");

		var tag_name_div = '<div class="hover_my_settings tag_name remove_me_please" style="top: '+(top-5)+'px; left: '+(up_right - width+5)+'px; display: inline-table;">'+$(me)[0].tagName+'</div>';
		$("#div_editorpreview").append(tag_name_div);

		// if($("#"+me.id)[0].tagName == "TD"){
		// 	var resize_btn = '<div class="hover_my_settings resize_btn" style="top: '+(top+(height/2))+'px; left: '+(left + width - 50)+'px; display: inline-table;"><i class="fa fa-arrow-left"></i></div>';
		// 	$("#div_editorpreview").append(resize_btn);
		// }

		$(me).css("overflow","visible");

		if($(me).hasClass("row")){
			$(me).addClass("hover_show_my_border_row");
			$(".up_settings_menu").css("background-color","rgba(110, 52, 188,0)");
			$(".up_settings_menu_i").css("background-color","rgba(110, 52, 188,1)");
			$(".up_settings_menu_i").css("border","2px solid rgba(0, 125, 0,1)");
			$(".add_new_btn").addClass("circle_row");
		}else if($(me).hasClass("container") || $(me).hasClass("container-fluid")){
			$(me).addClass("hover_show_my_border_container");
			$(".up_settings_menu").css("background-color","rgba(255, 73, 0,0)");
			$(".up_settings_menu_i").css("background-color","rgba(255, 73, 0,1)");
			$(".up_settings_menu_i").css("border","2px solid rgba(187, 63, 34,1)");
			$(".add_new_btn").addClass("circle_container");
		}else if($(me).hasClass("main_container")){
			$(me).addClass("hover_show_my_border_main_container");
			$(".up_settings_menu").css("background-color","rgba(119, 230, 47,0)");
			$(".up_settings_menu_i").css("background-color","rgba(119, 230, 47,1)");
			$(".up_settings_menu_i").css("border","2px solid rgba(204, 114, 5,1)");
		}else if($(me)[0].tagName == "DIV"){
			$(me).addClass("hover_show_my_border_div");
			$(".up_settings_menu").css("background-color","rgba(0, 230, 0, 0)");
			$(".up_settings_menu_i").css("background-color","rgba(0, 230, 0, 1)");
			$(".up_settings_menu_i").css("border","2px solid rgba(77, 158, 60, 1)");
			$(".add_new_btn").addClass("circle_div");
		}else{
			$(me).addClass("hover_show_my_border_ele");
			$(".up_settings_menu").css("background-color","rgba(59, 55, 218, 0)");
			$(".up_settings_menu_i").css("background-color","rgba(229, 55, 218, 1)");
			$(".up_settings_menu_i").css("border","2px solid rgba(3, 82, 140, 1)");
			$(".add_new_btn").addClass("circle");
		}

		$('.hover_my_settings').mouseover(
			function(event){
				event.stopPropagation();
				//$(".div_editorpreview").find("*").removeClass('hover_show_my_border');
				$(me).addClass('hover_show_my_border');
			}
		);
		$('.hover_my_settings').mouseleave(
			function(){
				remove_editor_hover_conf();//gloval_val.js
			}
		);
	}
}

function show_menu_inner_or_outer_decision(me){
	if($(me)[0].outerHTML.endsWith('</'+$(me)[0].tagName.toLowerCase()+'>') && $(me)[0].tagName != "IMG" && $(me)[0].tagName != "VIDEO" && !$(me).hasClass("timer_wrapper") && !$(me).hasClass("time") && !$(me).hasClass("date") && $(me)[0].tagName != "TD" && $(me)[0].tagName != "TR" && $(me)[0].tagName != "TABLE" && $(me)[0].tagName != "TBODY" && $(me)[0].tagName != "THEAD" && $(me)[0].tagName != "TH" && $(me)[0].tagName != "TEXTAREA" && $(me)[0].tagName != "IFRAME" && $(me)[0].tagName != "BUTTON" && $(me)[0].tagName != "SELECT" && $(me)[0].tagName != "A" && $(me)[0].tagName != "LI"){
		return false;
	}else{
		return false;
	}
}

function hover_me(my_id){
	//$("#place_below").hide();

	var clipboard =new Clipboard('.copy_id', {
		text: function(trigger) {
			return my_id;
		}
	});
	clipboard.on('success', function(e) {
		show_editor_msg("Element id ("+my_id+") copied to clipboard" , 1);
	});
	
	clipboard.on('error', function(e) {
	});
}
function hover_show_settings_panel(my_id){
	remove_editor_hover_conf();

	select_this_element(my_id);

	changed_css_element_ids(my_id);
	show_my_panel_for_settings(my_id);
	//$("#place_below").hide();
	overflow_control($('#div_editorpreview'));
	show_settings();
}
function hover_make_a_clone(my_id){
	html_data = awesome_data;
	if( html_data != '' ) {
		html_data = JSON.parse( html_data );
		html_data = make_my_clone(my_id,html_data);
		awesome_data = JSON.stringify(html_data);
		show_all_updated_view(html_data);
	}
}
function hover_remove_me(my_id){
	$(".div_editorpreview").find(".hover_my_settings").remove();
	
	var html_data = awesome_data;
	if( html_data != '' ) {
		html_data = JSON.parse( html_data );
		if(my_id != ""){
			//find_timer(my_id);
		}
		html_data = delete_element_from_json(my_id,"","","",html_data);
		awesome_data = JSON.stringify(html_data);
		show_all_updated_view(html_data);
	}
	add_button_inside_empty_div();
}

function hover_add_new(my_id){
	my_new_parent_id = $('#'+my_id).parent().attr('id');
	my_new_prev_id = my_id;

	$("#current_editable_element_id").val(my_id);

	className = $('#'+my_id).attr('class');
    classNames = className.split(" ");
    var row_found = false;
    if($('#'+my_id).hasClass("container-fluid") || $('#'+my_id).hasClass("container") || $('#'+my_id).hasClass("row")){
    	show_elements_list('container_and_div');
    	row_found = true;
    }
    if(!row_found){
        show_elements_list('all_element');
    }
	select_this_element(my_id);

	var top = $('#'+my_id).offset().top;
	var left = $('#'+my_id).offset().left;
	var width = $('#'+my_id)[0].offsetWidth;
	var height = $('#'+my_id)[0].offsetHeight;
	remove_editor_hover_conf();
	$('#'+my_id).addClass("click_show_my_border_bottom");
	$("#place_element_here").show();
	$("#place_element_here").css("top",(top+height-30)+"px");
	$("#place_element_here").css("left",((width/2)+left-13)+"px");
}

function add_me_to_personal_lib(){
    var ele_id = $("#add_to_lib_id")[0].value;
    if(ele_id == ""){
    	alert("Please select an element");
    	return;
    }
    var ele_name = $("#library_title")[0].value;
    if(ele_name != ""){
      var html_data = awesome_data;
      if( html_data != '' ) {
        html_data = JSON.parse( html_data );
        get_element_from_json(ele_id,html_data);
        var copied_element = $("#editor_preview_deleted_item")[0].value;
        if(copied_element == ""){
        	alert("Please select an element");
        	return;
        }
        var data = 'ele_name='+ encodeURIComponent(ele_name);
        data += '&copied_element='+ encodeURIComponent(copied_element);
        data += '&page_type=' + encodeURIComponent( document.getElementById('page_type').value );
        http_post_request( base + '/editor/?process=add_me_to_personal_lib', data , 'add_me_to_personal_lib_done' );
      }
    }else{
      alert("Please give a name");
    }
  }
  function add_me_to_personal_lib_done(res){
  	var last_index_my_personal_element_lib = 'personal_lib_'+res;
  	load_personal_lib();
    //$("#my_personal_element_lib_div")[0].innerHTML = res;

    var drag_and_drop_elements = JSON.parse($("#drag_and_drop_elements")[0].value);
    var copied_element = $("#editor_preview_deleted_item")[0].value;
    var temp = {};
    temp['html'] = JSON.parse(copied_element);
    temp['id'] = last_index_my_personal_element_lib;
    drag_and_drop_elements.push(temp);
    $("#drag_and_drop_elements")[0].value = JSON.stringify(drag_and_drop_elements);
  }

  function remove_this_lib(me,id){
    ele_id = id
    var data = 'ele_id='+ encodeURIComponent(ele_id);
    http_post_request( base + '/editor/?process=remove_this_lib', data , 'remove_this_lib_done',me );
  }

  function remove_this_lib_done(res,me){
    $(me).parent().parent().parent().remove();
  }
  
function what_is_my_id(me,event){
	event.stopPropagation();
	console.log('My ID: '+me.id);
	console.log('My Parent ID: '+$("#"+me.id).parent().attr('id'));
	console.log('My Prev ID: '+$("#"+me.id).prev().attr('id'));
}
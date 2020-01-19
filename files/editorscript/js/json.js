function show_all_updated_view(html_data,is_undo_redo){
	var time_array = [250,300];
	var rand_time = time_array[Math.floor(Math.random() * time_array.length)];
	$(".loader").show();
	
	var all_modal = $('div.div_editorpreview').find('.modal');
	var modal_open = false;
	var modal = null;
	for(var i=0;i<all_modal.length;i++){
		if($(all_modal[i]).hasClass('in')){
			modal = $(all_modal[i]);
			modal_open = true;
		}
	}
	
	var edited_all_elements_id = $('#edited_all_elements_id').text();
	if(edited_all_elements_id != ""){
		edited_all_elements_id = JSON.parse(edited_all_elements_id);
		for(var k=0;k<edited_all_elements_id.length;k++){
			html_data = set_new_style_into_json(edited_all_elements_id[k],html_data);
		}
		awesome_data = JSON.stringify(html_data);
	}
	$('#edited_all_elements_id').text("");
	if(is_undo_redo != "undo_redo"){
		UndoRedo.save(JSON.stringify(html_data));
	}
	generate(html_data);
	
	if(modal_open){
		close_popup($(modal)[0].id);
		open_popup($(modal)[0].id);
	}
	
	make_elements_click_show_settings();
	add_image_preview();
	show_hide_control("show"); 
	overflow_control($('#div_editorpreview'));

	setTimeout(function(){ sortable_state_change (); }, 500);
	$("button[data-toggle='modal']").click(function(){
        setTimeout(function(){ sortable_state_change (); }, 500);
    });

    setTimeout(function(){ $(".loader").hide();}, rand_time);
}

function generate(html_data){
	pageeditor_regenerate_html_editor(html_data);
	make_sortable(".body_container *");
	add_button_inside_empty_div();
	close_all_option();
}

function pageeditor_regenerate_html() {
	var html = '';
	var html_data = awesome_data;
	if( html_data != '' ) {
		html_data = JSON.parse( html_data );
		html_data = make_json_for_editor_preview(html_data);
		UndoRedo = new easyUndoRedo({
            stackLength : 20, 
            initialValue : JSON.stringify(html_data) 
        });
		awesome_data = JSON.stringify(html_data);
		pageeditor_regenerate_html_editor(html_data);
		add_button_inside_empty_div();
	}
	add_image_preview();
	overflow_control($('#div_editorpreview'));
	show_hide_control("show");
	make_sortable(".body_container *");

	$( ".body_container .modal" ).sortable({
      disabled: true
    });
    $( ".body_container .modal *" ).sortable({
      disabled: true
    });
}

function pageeditor_regenerate_html_editor(html_data) {
	awesome_data = JSON.stringify(html_data);
	var html = '';
	html = make_json_to_html( html_data , 'editor');
	document.getElementById('div_editorpreview').innerHTML = html;
}
function make_json_to_html( nodes , page_or_editor ) {
	var html = '';
	for( var i = 0; i < nodes.length; i++ ) {
		var element = nodes[i];
		html += '<';
		html += element.tag;
		var attrs = array_keys( element.attributes );
		for( var j = 0; j < attrs.length; j++ ) {
			if( element.attributes[attrs[j]] != null ) { 
				var element_attr = element.attributes[attrs[j]].replace('("','(');
				element_attr = element_attr.replace('")',')');
				if(page_or_editor == 'page'){
					if(attrs[j] != 'onmouseover'){
						html += ' ' + attrs[j] + '="' + element_attr.replace("padding-10px","") + '"';
					}
				}else{
					html += ' ' + attrs[j] + '="' + element_attr + '"';
				}
			}
		}
		html += '>';
		
		if( element.endtag == 1 ) {
			if( element.nodes != undefined ) {
				if( element.nodes.length > 0 ) {
					html += make_json_to_html( element.nodes, page_or_editor );
				}
			} 
			if ( element.content != undefined ) {
				html += element.content;
			}
			html += '</' + element.tag + '>';
		}

	}
	return html;
}
function array_keys (input, searchValue, argStrict) {
  var search = typeof searchValue !== 'undefined'
  var tmpArr = []
  var strict = !!argStrict
  var include = true
  var key = ''
  for (key in input) {
	if (input.hasOwnProperty(key)) {
	  include = true
	  if (search) {
		if (strict && input[key] !== searchValue) {
		  include = false
		} else if (input[key] !== searchValue) {
		  include = false
		}
	  }
	  if (include) {
		tmpArr[tmpArr.length] = key
	  }
	}
  }
  return tmpArr
}

function make_json_for_editor_preview(nodes){
	//console.log(nodes);
	for( var i = 0; i < nodes.length; i++ ) {
		var element = nodes[i];
		element_id++;
		if(Object.keys(nodes[i].attributes).length > 0){
			nodes[i].attributes['onmouseover'] = 'this_is_me(this,event)';
			if(nodes[i].attributes['id'] == undefined || nodes[i].attributes['id'] == null || nodes[i].attributes['id'] == ""){
				nodes[i].attributes['id'] = get_valid_element_id(element.tag);
			}	

			if(nodes[i].endtag == 0){
				if(nodes[i].attributes['style'] == null){
					nodes[i].attributes['style'] = "max-width: 100%;";
				}else if(nodes[i].attributes['style'].indexOf("max-width") < 0){
					nodes[i].attributes['style'] += " max-width: 100%;";
				}
			}
		}else{
			var temp = {};
			temp['onmouseover'] = 'this_is_me(this,event)';
			temp['id'] = get_valid_element_id(element.tag);
			if(nodes[i].endtag == 0){
				temp['style'] = "max-width: 100%;";
			}
			//temp['class'] = "padding-10px";
			nodes[i].attributes = temp;
		}
		if( element.endtag == 1 ) {
			if( element.nodes != undefined ) {
				if( element.nodes.length > 0 ) {
					nodes[i].nodes = make_json_for_editor_preview(element.nodes);
				}
			}
		}
	}
	return nodes;
}

function make_json_for_page_preview(nodes){
	for( var i = 0; i < nodes.length; i++ ) {
		var element = nodes[i];
		element_id++;
		if(Object.keys(nodes[i].attributes).length > 0){
			for(var l=0;l<Object.keys(nodes[i].attributes).length; l++){
				if(Object.keys(nodes[i].attributes)[l] == 'onblur' || Object.keys(nodes[i].attributes)[l] == 'onmouseover' || Object.keys(nodes[i].attributes)[l] == 'ondblclick' ){
					delete nodes[i].attributes[Object.keys(nodes[i].attributes)[l]];
					l--;
			    }
			}
		}
		if( element.endtag == 1 ) {
			if( element.nodes != undefined ) {
				if( element.nodes.length > 0 ) {
					nodes[i].nodes = make_json_for_page_preview(element.nodes);
				}
			}
		}
	}
	return nodes;
}

function add_elements_id_and_functions(nodes){
	element_id++;
    if(nodes.attributes['id'] == undefined || nodes.attributes['id'] == null || nodes.attributes['id'] == ""){
        nodes.attributes['id'] = get_valid_element_id(nodes.tag);
    }else{
    	nodes.attributes['id'] = get_valid_element_id(nodes.tag);
    }
    if(nodes.tag != "form" & nodes.tag != "br" & nodes.tag != "link" & nodes.tag != "script"){
    	nodes.attributes['onmouseover'] = 'this_is_me(this,event)';
    }
    
    if(nodes.endtag == 0){
        if(nodes.attributes['style'] == null){
            nodes.attributes['style'] = "max-width: 100%;";
        }else if(nodes.attributes['style'].indexOf("max-width") < 0){
            nodes.attributes['style'] += " max-width: 100%;";
        }
    }
    if(nodes.nodes != undefined){
        for( var i = 0; i < nodes.nodes.length; i++ ) {
            var element = nodes.nodes[i];
            nodes.nodes[i] = add_elements_id_and_functions(element);
        }
    }
    return nodes;
}

function add_elements_id_and_functions_for_modal(nodes){
	element_id++;
	if(nodes.attributes['id'] == undefined || nodes.attributes['id'] == null || nodes.attributes['id'] == ""){
        nodes.attributes['id'] = get_valid_element_id(nodes.tag);
    }else{
    	nodes.attributes['id'] = get_valid_element_id(nodes.tag);
    }
	nodes.attributes['onmouseover'] = 'this_is_me(this,event)';
	if(nodes.attributes['data-target'] == "div_modal_id"){
		nodes.attributes['data-target'] = '#div_'+(element_id+1);
	}
	if(nodes.endtag == 0){
		if(nodes.attributes['style'] == null){
			nodes.attributes['style'] = "max-width: 100%;";
		}else if(nodes.attributes['style'].indexOf("max-width") < 0){
			nodes.attributes['style'] += " max-width: 100%;";
		}
	}
	
	if(nodes.nodes != undefined){
		for( var i = 0; i < nodes.nodes.length; i++ ) {
			var element = nodes.nodes[i];
			nodes.nodes[i] = add_elements_id_and_functions_for_modal(element);
		}
	}
	return nodes;
}

function set_json_content_value(my_id, nodes){
	for( var i = 0; i < nodes.length; i++ ) {
		var element = nodes[i];
		if(element.attributes.id == my_id){
			var innerhtml = set_editor_conf_for_element($("#"+my_id));//javascript.js
			nodes[i].content = innerhtml[0].innerHTML;
		}else{
			if( element.endtag == 1 ) {
				if( element.nodes != undefined ) {
					if( element.nodes.length > 0 ) {
						nodes[i].nodes = set_json_content_value(my_id,element.nodes);
					}
				}
			}
		}
	}
	return nodes;
}

function set_json_content_value_for_snippet(my_id,value, nodes){
	for( var i = 0; i < nodes.length; i++ ) {
		var element = nodes[i];
		if(element.attributes.id == my_id){
			nodes[i].content = value;
		}else{
			if( element.endtag == 1 ) {
				if( element.nodes != undefined ) {
					if( element.nodes.length > 0 ) {
						nodes[i].nodes = set_json_content_value_for_snippet(my_id,value,element.nodes);
					}
				}
			}
		}
	}
	return nodes;
}

function add_class_to_json(my_id,class_name,nodes){
	for( var i = 0; i < nodes.length; i++ ) {
		var element = nodes[i];
		if(element.attributes.id == my_id){
			if(element.attributes["class"] == null){
				nodes[i].attributes["class"] = class_name;
			}else{
				nodes[i].attributes["class"] += " "+class_name;
			}
		}else{
			if( element.endtag == 1 ) {
				if( element.nodes != undefined ) {
					if( element.nodes.length > 0 ) {
						add_class_to_json(my_id,class_name,element.nodes);
					}
				}
			}
		}
	}
	return nodes;
}

function remove_class_from_json(my_id,class_name,nodes){
	for( var i = 0; i < nodes.length; i++ ) {
		var element = nodes[i];
		if(element.attributes.id == my_id){
			if(element.attributes["class"] != null){
				nodes[i].attributes["class"] = nodes[i].attributes["class"].replace(" "+class_name, "");
				nodes[i].attributes["class"] = nodes[i].attributes["class"].replace(class_name+" ", "");
				nodes[i].attributes["class"] = nodes[i].attributes["class"].replace(class_name, "");
			}
		}else{
			if( element.endtag == 1 ) {
				if( element.nodes != undefined ) {
					if( element.nodes.length > 0 ) {
						remove_class_from_json(my_id,class_name,element.nodes);
					}
				}
			}
		}
	}
	return nodes;
}

function drag_and_drop_elements(tag_id) {
	var drag_and_drop_elements= document.getElementById("drag_and_drop_elements").value;
	drag_and_drop_elements =JSON.parse(drag_and_drop_elements);
	
	for ( i=0;i<drag_and_drop_elements.length;i++){
		if (drag_and_drop_elements[i] != null ) {
			if ( drag_and_drop_elements[i]['id'] == tag_id ){
				if(tag_id == 'static-modal-popup-sm'||tag_id == 'static-modal-popup-md'||tag_id == 'static-modal-popup-lg'){
					add_elements_id_and_functions_for_modal(drag_and_drop_elements[i].html);
				}else{
					drag_and_drop_elements[i].html = add_elements_id_and_functions(drag_and_drop_elements[i].html);
				}
				return drag_and_drop_elements[i];
			}
		}
	}
	return null;
}

function rearrange_json(my_id,my_prev_parent_id,my_new_parent_id,my_new_prev_id){
	
	var html_data = awesome_data;
	if( html_data != '' ) {
		html_data = JSON.parse( html_data );
		if(my_id != my_new_prev_id && my_new_parent_id != "" && my_new_prev_id != "" && my_id != my_new_parent_id && my_new_parent_id != 'div_editorpreview' ){
			if(modal_status()){
				html_data = delete_element_from_json(my_id,my_prev_parent_id,my_new_parent_id,my_new_prev_id, html_data);
				awesome_data = JSON.stringify(html_data);
				var deleted_element = JSON.parse(document.getElementById('editor_preview_deleted_item').value);
				html_data = insert_element_to_json(deleted_element, my_new_parent_id, my_new_prev_id, html_data);
			}else{
				if(!check_placement_on_modal(my_new_parent_id)){
					html_data = delete_element_from_json(my_id,my_prev_parent_id,my_new_parent_id,my_new_prev_id, html_data);
					awesome_data = JSON.stringify(html_data);
					var deleted_element = JSON.parse(document.getElementById('editor_preview_deleted_item').value);
					html_data = insert_element_to_json(deleted_element, my_new_parent_id, my_new_prev_id, html_data);
				}
			}
		}
		
	}

	awesome_data = JSON.stringify(html_data);
	show_all_updated_view(html_data);
}

function check_placement_on_modal(parent_ID){
	while($("#"+parent_ID)[0].id != "div_editorpreview"){
		parent_ID = $("#"+parent_ID).parent()[0].id;
		if($("#"+parent_ID).parent()[0].className != undefined){
			if($("#"+parent_ID).parent()[0].className.indexOf("modal") > -1){
				return true;
			}
		}
	}
	return false;
}

function delete_element_from_json(my_id,my_prev_parent_id,my_new_parent_id,my_new_prev_id,nodes){
	var deleted_element;
	for( var i = 0; i < nodes.length; i++ ) {
		var element = nodes[i];
		if(element.attributes.id == my_id){
			deleted_element = element;
			nodes.splice(i, 1);
			document.getElementById('editor_preview_deleted_item').innerHTML = JSON.stringify(deleted_element);
			break;
		}else{
			if( element.endtag == 1 ) {
				if( element.nodes != undefined ) {
					if( element.nodes.length > 0 ) {
						nodes[i].nodes = delete_element_from_json(my_id,my_prev_parent_id,my_new_parent_id,my_new_prev_id,element.nodes);
					}
				}
			}
		}
		
	}
	return nodes;
}

function get_element_from_json(my_id,nodes){
	var deleted_element;
	for( var i = 0; i < nodes.length; i++ ) {
		var element = nodes[i];
		if(element.attributes.id == my_id){
			deleted_element = element;
			document.getElementById('editor_preview_deleted_item').innerHTML = JSON.stringify(deleted_element);
		}else{
			if( element.endtag == 1 ) {
				if( element.nodes != undefined ) {
					if( element.nodes.length > 0 ) {
						nodes[i].nodes = get_element_from_json(my_id,element.nodes);
					}
				}
			}
		}
		
	}

	return nodes;
}


function insert_element_to_json(deleted_element, my_new_parent_id, my_new_prev_id, nodes){
	for( var i = 0; i < nodes.length; i++ ) {
		var element = nodes[i];
		if(element.attributes.id == my_new_parent_id){
			if(my_new_prev_id !=null){
				for( var j = 0; j < element.nodes.length; j++ ) {
					if(element.nodes[j].attributes.id == my_new_prev_id){
						nodes[i].nodes.splice(j+1,0,deleted_element);
					}
				}
			}else{
				if(nodes[i].nodes != undefined){
					nodes[i].nodes.splice(0,0,deleted_element);
				}
			}
			break;
		}else{
			if( element.endtag == 1 ) {
				if( element.nodes != undefined ) {
					if( element.nodes.length > 0 ) {
						insert_element_to_json(deleted_element, my_new_parent_id, my_new_prev_id, element.nodes);
					}
				}
			}
		}
		
	}
	return nodes;
}

function make_my_clone(my_id,nodes){
	for( var i = 0; i < nodes.length; i++ ) {
		var element = nodes[i];
		if(element.attributes.id == my_id){		
			var temp = JSON.parse(JSON.stringify(element));
			temp = change_inside_elements_id(temp);
			for(j=0;j<nodes.length;j++){
				if(nodes[j].attributes.id == my_id){
					nodes.splice(j+1,0,temp);
				}
			}
			break;
		}else{
			if( element.endtag == 1 ) {
				if( element.nodes != undefined ) {
					if( element.nodes.length > 0 ) {
						make_my_clone(my_id, element.nodes);
					}
				}
			}
		}
	}
	return nodes;
}

function change_inside_elements_id(nodes){
	element_id++;
	nodes.attributes.id = get_valid_element_id(nodes.tag);
	if(nodes.nodes != undefined){
		for( var i = 0; i < nodes.nodes.length; i++ ) {
			var element = nodes.nodes[i];
			nodes.nodes[i] = change_inside_elements_id(element);
		}
	}
	return nodes;
}

function add_button_inside_empty_div(){
	$(".div_editorpreview").find(".i_am_empty_div_btn").remove();
	var emptyDivs = $(".div_editorpreview").find("*").filter(function() {
	    return $.trim($(this).text()) === "" && $(this).children().length === 0;
	});
	for(i=0;i<emptyDivs.length;i++){
		var button = '<button type="button" class="btn btn-sm form-control i_am_empty_div_btn sortable_disabled" onclick="i_am_empty_div(\''+emptyDivs[i].id+'\')" style="background-color: #3b37da; color: white; margin-top: 0px;width: 200px;height: 35px;max-width: 100%;max-height: 100%;"><span class="glyphicon glyphicon-plus do_not_add_empty_button sortable_disabled"></span> Add</button>';
		if($(emptyDivs[i])[0].tagName != "SPAN" && $(emptyDivs[i])[0].tagName != "I" && !$(emptyDivs[i]).hasClass("do_not_add_empty_button") && !$(emptyDivs[i]).hasClass("fa") && !$(emptyDivs[i]).hasClass("glyphicon") && $(emptyDivs[i])[0].tagName != "TEXTAREA" && $(emptyDivs[i])[0].tagName != "TD"){
			emptyDivs[i].innerHTML = button;
		}
	}
}
function i_am_empty_div(my_id){
	if(my_id != ""){
		my_new_parent_id = my_id;
		$("#current_editable_element_id").val(my_id);
		my_new_prev_id = null;
		if($("#"+my_id).hasClass("container-fluid") || $("#"+my_id).hasClass("container") || $("#"+my_id).hasClass("main_container")){
			show_elements_list('container_and_div');
		}else{
			show_elements_list('all_element');
		}
		select_this_element(my_id);
		var top = $('#'+my_id).offset().top;
		var left = $('#'+my_id).offset().left;
		var width = $('#'+my_id)[0].offsetWidth;
		var height = $('#'+my_id)[0].offsetHeight;
		remove_editor_hover_conf();
		$("#"+my_id).addClass("click_show_my_border");
		$("#place_element_here").css({top: top+(height/2)-37, left: (left+(width/2)-6)});
		$("#place_element_here").show();
		$("#place_element_here").show("slide", { direction: "left" }, 500);

		// $("#place_element_pull_line").show("slide", { direction: "left" }, 500);
		// $("#place_element_pull_line").css({top: top+(height/2)-23, left: (left+(width/2)+5)});
		// $("#place_element_pull_line").show();
	}else{
		show_editor_msg("Sorry something error happened. Please start from beginning." , 0 );
		var html_data = awesome_data;
		if( html_data != '' ) {
			html_data = JSON.parse( html_data );
			html_data = make_json_for_editor_preview(html_data);
			show_all_updated_view(html_data);
		}
	}
}
function add_me_to_editor_preview(me){
	var this_ui_item_array = drag_and_drop_elements(me.id);
	if(this_ui_item_array != null){
		var deleted_element = JSON.stringify(this_ui_item_array['html']);
		var html_data = awesome_data;
		if( html_data != '' ) {
			html_data = JSON.parse( html_data );
		}
		document.getElementById('editor_preview_deleted_item').innerHTML = [];
		html_data = insert_element_to_json(JSON.parse(deleted_element), my_new_parent_id, my_new_prev_id, html_data);
		awesome_data = JSON.stringify(html_data);
		show_all_updated_view(html_data);
	}
}

function set_attributes_to_json(my_id, value , change_type, nodes){
    for( var i = 0; i < nodes.length; i++ ) {
        var element = nodes[i];
        if(element.attributes.id == my_id){   
        	if(change_type == "src" && value.indexOf('youtube') > -1){
        		value = value.replace("/watch?v=","/embed/");
        	} 
            nodes[i].attributes[change_type] = value;   
            break;
        }else{
            if( element.endtag == 1 ) {
                if( element.nodes != undefined ) {
                    if( element.nodes.length > 0 ) {
                        nodes[i].nodes = set_attributes_to_json(my_id, value , change_type, element.nodes);
                    }
                }
            }
        }
    }
    return nodes;
}

function html_to_json(myUrl){
	var myUrl_relative = myUrl.substring(0, myUrl.lastIndexOf('/') + 1);
 	var proxy = 'https://cors-anywhere.herokuapp.com/';
    var oReq = new XMLHttpRequest();
    oReq.addEventListener("load", function () {
    	var data = this.response;
        var doc = (new DOMParser()).parseFromString(data,"text/html");
        var head_part = doc.getElementsByTagName("head")[0].innerHTML;
        var body_part  = doc.getElementsByTagName("body")[0].innerHTML;

        var all_style_elements = doc.getElementsByTagName('link');
        var head_style_elements =doc.getElementsByTagName("head")[0].getElementsByTagName('style');
        var css= "";

        for (l=0 ; l<head_style_elements.length ; l++){
            css+= head_style_elements[l].innerHTML;
        }
        $('head').append('<style>'+css+'</style>');
        $('#template_dependent_css_link').val('<style>'+css+'</style>');

		var myurl=[];
        
        for (var i =0 ; i<all_style_elements.length;i++){
            if ( all_style_elements[i].href =="" ) {
                var user_css_link = all_style_elements[i].outerHTML;
                user_css_link= user_css_link.match(/href="(.*?)"/)[1];
                if (myUrl_relative.endsWith('/') == true ) myUrl_relative.substring(0, myUrl_relative.length - +(myUrl_relative.lastIndexOf('/')==myUrl_relative.length-1));
                if ( user_css_link.startsWith ('/') !=true ) user_css_link='/'+user_css_link;
                user_css_link = myUrl_relative +user_css_link;
                myurl.push(user_css_link);
            }
            else {
                myurl.push(all_style_elements[i].href);
            }
        }

        for ( var k=0 ; k<myurl.length;k++){
                if (myurl[k].indexOf('.css') > 0 ){
                     var proxy1 = 'https://cors-anywhere.herokuapp.com/';
                     var oReq1 = new XMLHttpRequest();
                     oReq1.addEventListener("load", function () {
                            $("#template_dependent_css_link").val($("#template_dependent_css_link").val()+'<style>'+this.response+'</style>');
                            $('head').append('<style>'+this.response+'</style>');
                        });
                    //oReq1.open("GET", proxy + myurl[k]);
                    oReq1.open("GET", myurl[k]);
                    oReq1.send();
                }        
        }
       	var iDiv = document.createElement('div');
    	iDiv.innerHTML = body_part;
    	var elements = iDiv.getElementsByTagName('script');
        while (elements[0]) elements[0].parentNode.removeChild(elements[0]);
        elements = iDiv.getElementsByTagName('noscript');
        while (elements[0]) elements[0].parentNode.removeChild(elements[0]);

    	var json_data = html_to_json_generator($(iDiv));
    	awesome_data = JSON.stringify(new Array(json_data));
		pageeditor_regenerate_html();
		make_sortable(".body_container *");
     });
     oReq.open("GET", myUrl);
     oReq.send();
}

function html_to_json_generator(ele){
	element_id++;
	var json_data_arr = {};
	json_data_arr["tag"] = ele[0].tagName.toLowerCase();
	if ($(ele)[0].outerHTML.endsWith('</'+$(ele)[0].tagName.toLowerCase()+'>')){json_data_arr["endtag"] = 1;}
	else{json_data_arr["endtag"] = 0;}
	var attr = ele[0].attributes;
	var tmp = {};
	var hasId = false;
	var hasClass = false;
	for(var l=0; l<Object.keys(attr).length; l++){
		if(attr[l].name == 'id'){hasId = true;}
	}
	//if(!hasId){
		tmp['id'] = get_valid_element_id(ele[0].tagName);
	//}
	for(var k=0; k<Object.keys(attr).length; k++){
		tmp[attr[k].name] = attr[k].nodeValue;
	}
	json_data_arr["attributes"]= tmp;	
	var content = $(ele[0]).clone().children().remove().end().text().trim();

	if($(ele).children().length == 0){
		json_data_arr["content"] = content;
		if(ele[0].tagName.toLowerCase() == 'div'){
			json_data_arr["nodes"] = new Array();
		}
	}
	if($(ele).children().length > 0){
		json_data_arr["content"] = content;
		json_data_arr["nodes"] = [new Array()];
		var ele_childs = $(ele).children();
		for(var i=0; i<ele_childs.length;i++){
			json_data_arr["nodes"][i] = html_to_json_generator($(ele_childs[i]));
		}
	}
	return json_data_arr;
}


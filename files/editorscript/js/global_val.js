var editor_class_list = ['main_container','span_but_h1_tag','span_but_h2_tag','span_but_h3_tag','span_but_h4_tag','span_but_h5_tag','span_but_h6_tag','span_but_p_tag','ui-sortable-handle','ui-sortable','hover_disable','click_show_my_border','image','padding-10px','dont_clone','dont_remove'];
var element_id = 0;
var my_id = "";
var mdid=0;
var my_prev_parent_id = "";
var my_new_parent_id = "";
var my_new_prev_id = null;
var editable_text_changed = "";
//~HOVER OVER  ELEMENT 
var rand = Math.floor(Math.random() * (500 - 300)) + 300;
var drag_running = false;
var show_hide = "hide";
var UndoRedo;
$( document ).ready(function() {
	$(".loader").show();
    $("#advanced").hide();
    $("#animation").hide();

    pageeditor_regenerate_html();

    $( ".drag_me_panel_to_editor" ).draggable({
        connectToSortable: ".body_container div",
        helper: "clone",
        revert: "invalid",
        start : function(event, ui){
        },
        stop : function(event, ui){
            drag_running = false;
        },
    });

    setInterval(function(){ setTime(); }, 1000);
    //get screen height
    var h = window.innerHeight;
    document.getElementsByTagName('body')[0].style.minHeight = h + 'px';
    $('#div_editorpreview')[0].style.minHeight = h + 'px';
    

    make_elements_click_show_settings();

    overflow_control($('#div_editorpreview'));
    document.onkeydown = KeyPress;
    $(document).mouseup(function (e)
    {
        var container = $(".sidenav_container");
        if (!container.is(e.target) // if the target of the click isn't the container...
            && container.has(e.target).length === 0) // ... nor a descendant of the container
        {
            close_all_option();
        }

        overflow_control($('#div_editorpreview'));
    });
    var ck2 = CKEDITOR.replace("input_text_text_editor",
    {
         height: 230
    });

    $("button[data-toggle='modal']").click(function(){
    	setTimeout(function(){ sortable_state_change(); }, 500);
    });

    if($("#selected_group_list").length > 0){
        gen_select_group_list();
    }
    setTimeout(function(){ $(".loader").hide();}, 2000);
});
function KeyPress(e) {
	var evtobj = window.event? event : e
	if (evtobj.keyCode == 90 && evtobj.ctrlKey){
		undo_json_change();
	}
	if(evtobj.keyCode == 89 && evtobj.ctrlKey){
		redo_json_change();
	}

	var key = undefined;
    var possible = [ e.key, e.keyIdentifier, e.keyCode, e.which ];

    while (key === undefined && possible.length > 0)
    {
        key = possible.pop();
    }
    if (key && (key == '115' || key == '83' ) && (e.ctrlKey || e.metaKey) && !(e.altKey))
    {
        e.preventDefault();
        save_my_settings();
        return false;
    }
}
function http_get_request( url, callback, params ) {
	
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			//callback with response
			window[callback](xmlhttp.responseText, params);
		}
	}
	xmlhttp.open("GET",url,true);
	xmlhttp.send();
}

function http_post_request( url, data, callback, params ) {
	
	if (window.XMLHttpRequest)
	{// code for IE7+, Firefox, Chrome, Opera, Safari
		xmlhttp=new XMLHttpRequest();
	}
	else
	{// code for IE6, IE5
		xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
	}
	xmlhttp.onreadystatechange=function()
	{
		if (xmlhttp.readyState==4 && xmlhttp.status==200)
		{
			//callback with response
			window[callback](xmlhttp.responseText, params);
		}
	}
	xmlhttp.open("POST",url,true);
	xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
	xmlhttp.send(data);
}


function save_as_html(){
	$('#div_editorpreview').hide();
	$('#page_preview').show();
	var body_attr = $('#page_preview')[0].style.cssText.replace('("','(');
	body_attr = body_attr.replace('")',')');
	var html_data = awesome_data;
	html_data = JSON.parse(html_data);
	html_data = make_json_to_html( html_data , 'page');
	var headconf = '<meta http-equiv="Content-Type" content=" charset=UTF-8" />';
	headconf+='<meta name="viewport" content="width=device-width, initial-scale=1">';
	headconf+='<link rel="stylesheet" href="'+base+'/files/editorscript/custom_templates/template-dependency/funnel-template.css">';
	headconf+='<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">';
	headconf+='<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">';
	headconf+='<link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">';
	headconf+='<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>';
	headconf+='<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>';
	headconf+='<script src="'+base+'/files/editorscript/custom_templates/template-dependency/funnel-template.js"></script>';
	
	headconf+='<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>';
	headconf+=$("#template_dependent_css_link").val();
	html_data = '<html><head>'+headconf+'</head><body style="'+body_attr+'">'+html_data+'</body></html>';
	make_downloadable_html_file(html_data,'awesome_page.html');
}

function make_downloadable_html_file(text, filename) {
	var element = document.createElement('a');
	element.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(text));
	element.setAttribute('download', filename);
	element.style.display = 'none';
	document.body.appendChild(element);
	element.click();
	document.body.removeChild(element);
}

function undo_json_change(){
	show_all_updated_view(JSON.parse(UndoRedo.undo()),"undo_redo");
}

function redo_json_change(){
	show_all_updated_view(JSON.parse(UndoRedo.redo()),"undo_redo");
}

function show_this_resolution(width,height){
    $("#page_preview").css("max-width",width+"px");
    $("#page_preview").css("max-height",height+"px");
    $("#page_preview").css("min-width",width+"px");
    $("#page_preview").css("min-height",height+"px");
    $("#page_preview").css("overflow-y","scroll");
    $("#page_preview").css("cursor","all-scroll");
    $("#page_preview").css("margin","auto");
    $("#page_preview").css("margin-top","70");
    $("#page_preview").css("padding","0");
    $('#div_editorpreview').hide();
    $('#page_preview').hide();
    
    height= (screen.height)-300;
    if ( $('#phone_preview_div') != null )  $('#phone_preview_div').remove();
    var phone_preview_div= document.createElement('div');
    phone_preview_div.id= "phone_preview_div";
    if ($('#page_preview').attr("style").indexOf ('background-color: rgb(2, 52, 88)') < 0 ) {
        phone_preview_div.style.cssText =  $('#page_preview').attr("style");
        phone_preview_div.style.cssText += ' max-width: '+width+'px ; max-height: '+height+'px; min-width:'+width+'px;min-height:'+height+'px;overflow-y:scroll;cursor:all-scroll;margin:0 auto;margin-top:70px;padding:0px;display: inline-block;border-style:solid;border-color:black;border-width:45px 9px ; border-radius:25px;-webkit-overflow-scrolling: touch; -4px -6px 1px 0px #383838 ;'
  	}else {
        phone_preview_div.style.cssText =  $('#page_preview').attr("style");
        phone_preview_div.style.cssText += 'background-color:white; max-width: '+width+'px ; max-height: '+height+'px; min-width:'+width+'px;min-height:'+height+'px;overflow-y:scroll;cursor:all-scroll;margin:0 auto;margin-top:70px;padding:0px;display: inline-block;border-style:solid;border-color:black;border-width:45px 9px ; border-radius:25px;-webkit-overflow-scrolling: touch; -4px -6px 1px 0px #383838 ;'
    }
    phone_preview_div.innerHTML = $('#page_preview')[0].innerHTML;
    $('#mobile_preview').append(phone_preview_div);
    $('#mobile_preview').css("display","flex");
}

function show_desktop_view(){
	$('#page_preview')[0].style.cssText = page_preview_style;
	$('#mobile_preview').hide();
}


function setTime() {
	var time = moment().format('hh:mm:ss');
	var date = moment().format('dddd, MMMM D');

	for(var i=0;i<$('.date').length;i++){
		$('.date')[i].innerHTML = date;
	}
	for(var i=0;i<$('.time').length;i++){
		$('.time')[i].innerHTML = time;
	}

}

function open_popup(id){
	var btn = '<button id="auto_pop_up_show_hide" data-target="#'+id+'" data-toggle="modal">click me</button>'
	$('body').append(btn);
	$("#auto_pop_up_show_hide").click();
	$("#auto_pop_up_show_hide").remove();
}
function close_popup(id){
	$("body").find(".modal-backdrop").remove();
}



function get_valid_element_id(tagName){
	var ele_existed = document.getElementById(tagName+"_"+element_id);
	if(ele_existed != null){
		element_id++;
		get_valid_element_id(tagName);
	}
	return tagName+"_"+element_id;
}

function get_original_classes(my_id){
	var prev_classes = $("#"+my_id)[0].className;
	var classes = "";
	for(var i=0;i<editor_class_list.length;i++){
		if(($("#"+my_id)[0].className).indexOf(editor_class_list[i]) > -1){
			var regex = new RegExp('\\b'+editor_class_list[i]+'\\b', "g");
			classes = prev_classes.replace(regex, "");
			prev_classes = classes;
		}
	}
	return classes;
}

function get_editor_classes(my_id){
	var prev_classes = $("#"+my_id)[0].className;
	var classes="";
	for(var i=0;i<editor_class_list.length;i++){
		if(new RegExp("\\b"+editor_class_list[i]+"\\b").test(prev_classes)){
			classes += " "+editor_class_list[i];
		}
	}
	return classes;
}


function remove_editor_hover_conf(){
	$(".div_editorpreview").find("*").removeClass('hover_show_my_border');
	$(".div_editorpreview").find("*").removeClass('click_show_my_border');
	$(".div_editorpreview").find("*").removeClass('hover_show_my_border_main_container');
	$(".div_editorpreview").find("*").removeClass('hover_show_my_border_container');
	$(".div_editorpreview").find("*").removeClass('hover_show_my_border_row');
	$(".div_editorpreview").find("*").removeClass('hover_show_my_border_div');
	$(".div_editorpreview").find("*").removeClass('hover_show_my_border_ele');
	$(".div_editorpreview").find("*").removeClass('circle_container');
	$(".div_editorpreview").find("*").removeClass('circle_row');
	$(".div_editorpreview").find("*").removeClass('circle_div');
	$(".div_editorpreview").find("*").removeClass('show_my_cursor_as_move');
	$(".div_editorpreview").find("*").removeClass('place_here_div');
	$(".div_editorpreview").find("*").removeClass('click_show_my_border_bottom');
	$(".div_editorpreview").find(".hover_my_settings").remove();
	$(".div_editorpreview").find(".hover_my_settings2").remove();
	$("#place_element_here").hide();
}

function select_this_element(my_id){
	$(".div_editorpreview *").addClass("hover_disable");
	$(".div_editorpreview").find("*").removeClass('click_show_my_border');
	$('#'+my_id).addClass('click_show_my_border');
}


function modal_status(){
	var all_modal = $('div.div_editorpreview').find('.modal');
	var modal_open = false;
	for(var i=0;i<all_modal.length;i++){
		if($(all_modal[i]).hasClass('in')){
			modal_open = true;
		}
	}
	return modal_open;
}

function make_elements_click_show_settings(){
	$("#div_editorpreview *").dblclick(function(e){
		if(!$(e.target).hasClass("move_icon")&&!$(e.target).hasClass("copy_id")&&!$(e.target).hasClass("add_new_btn")&&!$(e.target).hasClass("timer_sett")&&!$(e.target).hasClass("settings")&&!$(e.target).hasClass("clone")&&!$(e.target).hasClass("remove")&&!$(e.target).hasClass("hover_my_settings")&&!$(e.target).hasClass("i_am_empty_div_btn") && !$(e.target).hasClass("do_not_show_my_menu")){
			hover_show_settings_panel(e.target.id)
		}
	});
}

function show_hide_control(type){
	if(type == "show"){
		$("#div_editorpreview *:has(*)").addClass("padding-10px");
		add_button_inside_empty_div();
		$("iframe").removeClass("padding-10px");
		$("iframe").parent().removeClass("padding-10px");

		//$(".show_hide_control")[0].innerHTML = '<i class="fa fa-eye-slash" aria-hidden="true"></i><span class="dropdown-title">  Hide control</span>';
		$( ".show_hide_control" ).each(function() {
			this.innerHTML = '<i class="fa fa-eye-slash" aria-hidden="true"></i><span class="dropdown-title">  Hide control</span>';
		});

		$(".body_container .container").each(function(){
			$(this).addClass("container_box_shadow");
		});
		$(".body_container .container-fluid").each(function(){
			$(this).addClass("container_box_shadow");
		});
		$(".body_container .row").each(function(){
			$(this).addClass("row_box_shadow");
		});
		$(".body_container div:not(.row,.container,.container-fluid)").each(function(){
			$(this).addClass("div_box_shadow");
		});
	
	}else{
		if($(".padding-10px").length > 0){
			$(".div_editorpreview").find("*").removeClass('padding-10px');
			$(".div_editorpreview").find(".i_am_empty_div_btn").remove();
			$( ".show_hide_control" ).each(function() {
				this.innerHTML = '<i class="fa fa-eye" aria-hidden="true"></i><span class="dropdown-title">  Show control</span>';
			});

			$(".body_container .container").each(function(){
				$(this).removeClass("container_box_shadow");
			});
			$(".body_container .container-fluid").each(function(){
				$(this).removeClass("container_box_shadow");
			});
			$(".body_container .row").each(function(){
				$(this).removeClass("row_box_shadow");
			});
			$(".body_container div:not(.row,.container,.container-fluid)").each(function(){
				$(this).removeClass("div_box_shadow");
			});
			
		}else{
			$("#div_editorpreview *:has(*)").addClass("padding-10px");
			add_button_inside_empty_div();
			$("iframe").removeClass("padding-10px");
			$("iframe").parent().removeClass("padding-10px");
			$( ".show_hide_control" ).each(function() {
				this.innerHTML = '<i class="fa fa-eye-slash" aria-hidden="true"></i><span class="dropdown-title">  Hide control</span>';
			});

			$(".body_container .container").each(function(){
				$(this).addClass("container_box_shadow");
			});
			$(".body_container .container-fluid").each(function(){
				$(this).addClass("container_box_shadow");
			});
			$(".body_container .row").each(function(){
				$(this).addClass("row_box_shadow");
			});
			$(".body_container div:not(.row,.container,.container-fluid)").each(function(){
				$(this).addClass("div_box_shadow");
			});
			//$(".show_hide_control")[0].innerHTML = '<i class="fa fa-eye-slash" aria-hidden="true"></i><span class="dropdown-title">  Hide control</span>';
		}
	}
}

function add_image_preview(){
	for(var i=0;i<$(".fb-comments").length;i++){
		$(".fb-comments")[i].innerHTML = '<img width="100%" src="'+base+'/files/editorscript/images/snippets/fb-comments.png">';
	}
	for(var i=0;i<$(".shopify_cart_bump_div").length;i++){
		$(".shopify_cart_bump_div")[i].innerHTML = '<table style="border: none;" width="100%"> <tbody> <tr style="border: none"> <td style="padding: 8px; vertical-align: top;"> <input type="checkbox" class="cart_bump_checkbox_input" >  </td> <td style="padding: 8px; vertical-align: top;">Add 1 More "Rise & Grind" Tees & Tanks to Your Order! Just pay additional $36.99 . </td> </tr> <tr style="border: none"> <td style="padding: 8px; vertical-align: top;"> <input type="checkbox" class="cart_bump_checkbox_input">  </td> <td style="padding: 8px; vertical-align: top;">Add 2 More "Rise & Grind" Tees & Tanks to Your Order!  Just pay additional $73.98 . </td> </tr> <tr style="border: none"> <td style="padding: 8px; vertical-align: top;"> <input type="checkbox" class="cart_bump_checkbox_input" >  </td> <td style="padding: 8px; vertical-align: top;">Add 3 More "Rise & Grind" Tees & Tanks to Your Order! Just pay additional $110.97 . </td> </tr>  </tbody> </table>';
	}
}

function check_any_modal_open () {
	var all_modal = $('.body_container').find('.modal');
	var modal = null;
	for(var i=0;i<all_modal.length;i++){
		if($(all_modal[i]).hasClass('in')){
			modal = $(all_modal[i]);
			return modal;
		}
	}
}

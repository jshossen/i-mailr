function close_all_option(){
	$(".div_editorpreview").find("*").removeClass('hover_disable');
	$(".side_panel_settings_container").hide();
	$("#div_editorpreview").removeClass("div_editorpreview_float_left");
	$("#div_editorpreview").css("width","100%");
	$("#elements").hide();
}

function open_all_element_option() {
    $(".side_panel_settings_container").show();
    $("#div_editorpreview").addClass("div_editorpreview_float_left");
    var width = document.body.clientWidth;
   	$("#div_editorpreview").css("width",width-350+"px");

   	$("#settings_button").addClass("settings_head_active_color");
}

function show_settings(){
	// $("#advanced_button").css("opacity", ".8");
	// $("#settings_button").css("opacity", "1");
	$("#advanced_div").hide();
	$("#settings_div").show();
	$("#advanced_button").removeClass("settings_head_active_color");
	$("#settings_button").addClass("settings_head_active_color");
}
function show_advanced(){
	// $("#advanced_button").css("opacity", "1");
	// $("#settings_button").css("opacity", ".8");
	$("#settings_div").hide();
	$("#advanced_div").show();
	$("#settings_button").removeClass("settings_head_active_color");
	$("#advanced_button").addClass("settings_head_active_color");
}
function enable_colorpicker(myid){
	$('.demo').each( function() {
		$(this).minicolors({
			control: $(this).attr('data-control') || 'hue',
			defaultValue: $(this).attr('data-defaultValue') || '',
			format: $(this).attr('data-format') || 'hex',
			keywords: $(this).attr('data-keywords') || '',
			inline: $(this).attr('data-inline') === 'true',
			letterCase: $(this).attr('data-letterCase') || 'lowercase',
			opacity: $(this).attr('data-opacity'),
			position: $(this).attr('data-position') || 'bottom left',
			swatches: $(this).attr('data-swatches') ? $(this).attr('data-swatches').split('|') : [],
			change: function(value, opacity) {
				var tempID = this.id.split("_")[0];
				$("#"+myid).css(tempID, value);
				if( !value ) return;
				if( opacity ) value += ', ' + opacity;
			},
			theme: 'bootstrap'
		});

	});

}

function enable_slider(myid, slider_array){
 
    slider_array = JSON.parse(slider_array);

    for ( var i =0 ; i<slider_array.length;i++){
	    var id ="";
	    var min_value ="";
	    var max_value ="";
	    var suffix="";
	    var slider_array_splitted = slider_array[i].split(';');
		id = slider_array_splitted[0];
		var property = id.replace('_slider',"");
		min_value = parseInt(slider_array_splitted[1]);
		max_value= parseInt(slider_array_splitted[2]);
		suffix= parseInt(slider_array_splitted[3]);
		var min_max = get_slider_min_max_value(myid, property, [min_value,max_value,'px']);
		min_value = min_max[0];
		max_value= min_max[1];
		suffix= min_max[2];
		var value= slider_array_splitted[4];
		value = value.split("p");
		value=value[0];
		if (value=='') value=min_value;
	    $("#"+id+"_input").val(value);
	    if($("#"+myid)[0].tagName == "IMG"){
	    	var slider_function_body = [
                                    '$("#'+id+'").slider({'+
	                                    'orientation: 	"horizontal",'+
	                                    'range: 		"min",'+
	                                    'min: 			'+min_value+','+
	                                    'max: 			'+max_value+','+
	                                    'value:  		'+value+','+
	                                    'slide: 		function (event, ui) {'+
				                                         '$("#'+id+'_input").val(ui.value);'+
				                                         'var pro = $("#'+id+'_input").val();'+
				                                         'set_image_ratio("'+property+'","'+myid+'",pro);'+
				                                         '$("#'+myid+'").css("'+property+'", pro+"'+suffix+'");'+
	                                        			'}'+
                                    '});'];
	    }else{
	    	var slider_function_body = [
                                    '$("#'+id+'").slider({'+
	                                    'orientation: 	"horizontal",'+
	                                    'range: 		"min",'+
	                                    'min: 			'+min_value+','+
	                                    'max: 			'+max_value+','+
	                                    'value:  		'+value+','+
	                                    'slide: 		function (event, ui) {'+
				                                         '$("#'+id+'_input").val(ui.value);'+
				                                         'var pro = $("#'+id+'_input").val();'+
				                                         '$("#'+myid+'").css("'+property+'", pro+"'+suffix+'");'+
	                                        			'}'+
                                    '});'];
	    }
	    
	                                        

	    window['custom_slider_'+i]= new Function(slider_function_body);
	    window['custom_slider_'+i]();

    }

}

function set_image_ratio(property,my_id,pro){
	var height = $("#"+my_id)[0].offsetHeight;
	var width = $("#"+my_id)[0].offsetWidth;
	
	if($("#"+my_id)[0].tagName == 'IMG'){
		if(property == "height"){
			var ratio = width/height;
			height = pro;
			var value = height*ratio;
			$("#width_slider").slider({value: value});
			$("#width_slider_input")[0].value = value;
	        $("#"+my_id).css("width",value+"px");
	        $("#"+my_id).css("height","");
		}else if(property == "width"){
			var ratio = height/width;
			width = pro;
			var value = width*ratio;
			$("#height_slider").slider({value: value});
			$("#height_slider_input")[0].value = value;
			$("#"+my_id).css("width",width+"px");
	        $("#"+my_id).css("height","");
		}
	}
} 

function show_preview(){
    $('#top-navbar-page_preview')[0].style.cssText+=' margin-left: 100%;';
    $('#top-navbar')[0].style.cssText+=' margin-left: 0%;';
    
    $('#page_preview')[0].style.cssText = $('#div_editorpreview')[0].style.cssText.replace("background-color: rgb(2, 52, 88)","background-color: rgba(2, 52, 88, 0)");
    $('#page_preview').show();

    page_preview_style =  $('#page_preview')[0].style.cssText;

    $('#top-navbar').animate({ marginLeft: "-100%"} , 1000);
    $('#top-navbar-page_preview').animate({ marginLeft: "0%"} , 1000);
    $('#top-navbar-page_preview').show();

    //$('body').css('background-image', 'none');
    save_my_settings();

    var iDiv = document.createElement('div');
      iDiv.innerHTML =  $("#div_editorpreview")[0].innerHTML;
    div_editorpreview = iDiv;
    $("#div_editorpreview")[0].innerHTML = "";
    $("#div_editorpreview").hide();
    if ( $('#mobile_preview') != null)
        $('#mobile_preview').css("display","none");
}

function show_editor(){
    $('#top-navbar-page_preview')[0].style.cssText+=' margin-left: 0%;';
    $('#top-navbar')[0].style.cssText+=' margin-left: -100%;';
    
    $("#div_editorpreview").show();
    $('#page_preview').hide();
    
    $('#top-navbar').animate({ marginLeft: "0%"} , 1000);
    $('#top-navbar-page_preview').animate({ marginLeft: "100%"} , 1000);

    
    //$('body').css('background-image', 'url('+base+'/files/editorscript/images/background5.jpg)');
    $("#div_editorpreview")[0].innerHTML = $(div_editorpreview)[0].innerHTML;

    if ( $('#mobile_preview') != null)
        $('#mobile_preview').css("display","none");
}
		
function clear_previous_panel_settings(){
	if ( $('#settings').length > 0 ){
		$('#settings').remove();
		$('#advanced').remove();
	}
}
function show_my_panel_for_settings(myid){
	clear_previous_panel_settings();
	var attr_val = get_css_attributes_value(myid);
	var  html_element_type = $("#"+myid)[0].tagName.toLowerCase();

	$("#element_tag_name")[0].innerHTML = "<b>"+$("#"+myid)[0].tagName+"</b> settings";
	
	var tags_css_attr= document.getElementById("tags_css_attr").value;
	var style_property= document.getElementById("style_property").value;
	
	tags_css_attr=JSON.parse(tags_css_attr);
    style_property=JSON.parse(style_property);

    if(myid == "div_editorpreview"){
    	tags_css_attr['div']['settings'] = 'text-align,background-color,font-size,background-repeat,background-position,background-size,background-attachment,color';
	    var temp = {};
	    temp['styles'] = "inline_css";
	    temp['animation'] = "";
	    tags_css_attr['div']['advanced']= temp;
    }
    if($("#"+myid).hasClass("row") || $("#"+myid).hasClass("main_container") || $("#"+myid)[0].className.indexOf("col-") > -1 ){
    	tags_css_attr['div']['settings'] = tags_css_attr['div']['settings'].replace(",width,height","");
    }
    if($("#"+myid).hasClass("fb-comments")){
    	tags_css_attr['div']['settings'] = "fb_comments_width,fb_comments_num_comments";
    	tags_css_attr['div']['advanced']= null;
    }

	if ( tags_css_attr [html_element_type]['settings'] !=null) var settings = tags_css_attr [html_element_type]['settings'].split(',');
	if ( tags_css_attr[html_element_type]['advanced'] != null) {  
		var advanced_styles =  tags_css_attr [html_element_type]['advanced']['styles'].split(',');
		var advanced_animation=  tags_css_attr [html_element_type]['advanced']['animation'].split(',');
	}else{
		advanced_styles = [];
		advanced_animation = [];
	}

	
	var dynamic_div_settings = document.createElement('div');
	dynamic_div_settings.id = 'settings';
	dynamic_div_settings.style.cssText = 'padding:10px';
	
	var dynamic_div_advanced= document.createElement('div');
	dynamic_div_advanced.id = 'advanced';
	dynamic_div_advanced.style.cssText = 'padding:10px';
	
	var dynamic_div_advanced_styles= document.createElement('div');
	dynamic_div_advanced_styles.id = 'styles';

	var dynamic_div_advanced_animation= document.createElement('div');
	dynamic_div_advanced_animation.id = 'animation';

	var slider_id_array =new Array();
	var id = "";
	var min =  "";
	var max= "";
	var suffix="";
	var value = "";
	var counter = true;
	
	for ( var j=0 ; j<settings.length;j++){
		for (var k=0;k<Object.keys(style_property).length;k++){
			settings[j] = settings[j].replace(/\s/g,'');
			if (settings[j] == Object.keys(style_property[k]) ){
				var dynamic_div_child = document.createElement('div');
				dynamic_div_child.className="col-sm-12";
				dynamic_div_child.style.cssText="margin-top:10px;padding:0;";
			   
			    var dynamic_div="";
			    if ( style_property[k][settings[j]]['type']=='colorpicker' ){
					dynamic_div+='<label  style="margin-top:8px;" class="labeling_style col-sm-4">' +style_property[k][settings[j]]['label']+'</label>';
					dynamic_div+='<div style="padding-left:6.5%;padding-right:2%;" class=" pull-right col-sm-8" >';
						dynamic_div+='<div style="margin-bottom:0px;" class="form-group">';
							dynamic_div+='<input type="text" id="'+Object.keys(style_property[k])[0]+'_'+k+'" class="form-control demo" data-format="rgb" data-opacity="1" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)"  value="'+attr_val[Object.keys(style_property[k])]+'">';
						dynamic_div+='</div>';
					 dynamic_div+='</div>';
				}else if ( style_property[k][settings[j]]['type']=='slider' ){
					dynamic_div+= '<label  style="margin-top:8px;" class="labeling_style col-sm-4">' +style_property[k][settings[j]]['label']+'</label>';
					dynamic_div+= '<div style="padding-left:7.5%;padding-right:2%;" class="pull-right col-sm-8" >';
						dynamic_div+= '<div class="pull-left" style="width: 76%;margin-top:5%;">';
							dynamic_div+= '<div class="custom_slider" id="'+Object.keys(style_property[k])+'_slider">';
							dynamic_div+='</div>';
						dynamic_div+='</div>';
						dynamic_div+= '<div class="pull-right text-center" style="width: 20%;">';
							dynamic_div+='<input id="'+Object.keys(style_property[k])+'_slider_input" onkeyup="slider_input_change_property(this,\''+myid+'\')" onchange="slider_input_change_property(this,\''+myid+'\')" type="number" class="form-control input-sm" style="text-align: center;font-size:12px;padding:1px 1px;">';
						dynamic_div+='</div>';
					dynamic_div+= '</div>';
							
					id = Object.keys(style_property[k])+"_slider";
					min =  style_property[k][settings[j]]['min'];
					max= style_property[k][settings[j]]['max'];
					suffix=style_property[k][settings[j]]['suffix'];
					value = attr_val[Object.keys(style_property[k])];
					if (value=='') value=min;
					slider_id_array.push ( id+';'+min+';'+max+';'+suffix+';'+value);	
				}else if ( style_property[k][settings[j]]['type']=='dropdown' ){
					dynamic_div+= '<label  style="margin-top:8px;" class="labeling_style col-sm-4">' +style_property[k][settings[j]]['label']+'</label>';
					dynamic_div+= '<div style="padding-left:6.5%;padding-right:2%;" class="pull-right col-sm-8" >';
					dynamic_div+= '<select class="form-control" id="'+Object.keys(style_property[k])+'_'+k+'" onchange="dropdown_live_preview(this,\''+myid+'\')">';
					for ( i=0 ; i<Object.keys(style_property[k][settings[j]]['options']).length;i++){
						if( attr_val[Object.keys(style_property[k])].includes(style_property[k][settings[j]]['options'][Object.keys(style_property[k][settings[j]]['options'])[i]])){
							dynamic_div+= '<option value="'+style_property[k][settings[j]]['options'][Object.keys(style_property[k][settings[j]]['options'])[i]]+'" selected>'+Object.keys(style_property[k][settings[j]]['options'])[i]+'</option>';
						}else{
							dynamic_div+= '<option value="'+style_property[k][settings[j]]['options'][Object.keys(style_property[k][settings[j]]['options'])[i]]+'">'+Object.keys(style_property[k][settings[j]]['options'])[i]+'</option>';
						}
					}
					dynamic_div+= '</select>';
					dynamic_div+= '</div>';
				}else if ( style_property[k][settings[j]]['type']=='placeholder' ){
				  var placeholder = document.getElementById( myid).placeholder;
					dynamic_div+= '<div id="settings_option" class="col-sm-12" style="padding:0;">';
						dynamic_div+='<label  style="margin-top:8px;" class="labeling_style col-sm-4">' +style_property[k][settings[j]]['label']+'</label>';
						dynamic_div+='<div style="padding-left:6.5%;padding-right:2%;" class=" pull-right col-sm-8" >';
							dynamic_div+='<div style="margin-bottom:0px;" class="form-group">';
								dynamic_div+='<input onblur ="set_attributes(\''+myid+'\',this,\'placeholder\',1)" onkeyup ="set_attributes(\''+myid+'\',this,\'placeholder\',0)" type="text" id="'+Object.keys(style_property[k])[0]+'_'+k+'"  value="'+placeholder+'" class="form-control" >';
							dynamic_div+='</div>';
						 dynamic_div+='</div>';		
					dynamic_div+= '</div>';
				}else if ( style_property[k][settings[j]]['type']=='href' ){
                  var href = document.getElementById( myid).href;
                        dynamic_div+='<label  style="margin-top:8px;" class="labeling_style col-sm-4">' +style_property[k][settings[j]]['label']+'</label>';
                        dynamic_div+='<div style="padding-left:6.5%;padding-right:2%;" class=" pull-right col-sm-8" >';
                            dynamic_div+='<div style="margin-bottom:0px;" class="form-group">';
                                dynamic_div+='<input onblur ="set_attributes(\''+myid+'\',this,\'href\',1)" onkeyup ="set_attributes(\''+myid+'\',this,\'href\',0)" type="text" id="'+Object.keys(style_property[k])[0]+'_'+k+'"  value="'+href+'" class="form-control" >';
                            dynamic_div+='</div>';
                         dynamic_div+='</div>';
                }else if ( style_property[k][settings[j]]['type']=='text_input' ){
					var text_input = $("#"+myid)[0].innerHTML;
					dynamic_div+= '<div class="col-sm-12" style="padding:0;">';
					    dynamic_div+='<label  style="margin-top:8px;" class="labeling_style col-sm-4">' +style_property[k][settings[j]]['label']+'</label>';
					    dynamic_div+='<div style="padding-left:6.5%;padding-right:2%;" class=" pull-right col-sm-8" >';
					        dynamic_div+='<div style="margin-bottom:0px;" class="form-group">';
					            dynamic_div+='<textarea onblur="set_content(\''+myid+'\',this,1)" onkeyup="set_content(\''+myid+'\',this,0)" id="'+Object.keys(style_property[k])[0]+'_'+k+'" class="form-control" style="resize: vertical;">'+text_input+'</textarea>';
					            if($("#"+myid)[0].tagName != "LI"){
					            	dynamic_div+='<a class="pull-right" style="cursor: pointer; font-size: 14px;" data-toggle="modal" data-target="#editor_popup_to_change_text" onclick="open_editor_to_edit_text(\''+Object.keys(style_property[k])[0]+'_'+k+'\')">Edit with editor</a>'; 
					            }
					        dynamic_div+='</div>';
					     dynamic_div+='</div>';       
					dynamic_div+= '</div>';
                }else if ( style_property[k][settings[j]]['type']=='name' ){
                  var name = $("#"+myid)[0].name;
                        dynamic_div+='<label  style="margin-top:8px;" class="labeling_style col-sm-4">' +style_property[k][settings[j]]['label']+'</label>';
                        dynamic_div+='<div style="padding-left:6.5%;padding-right:2%;" class=" pull-right col-sm-8" >';
                            dynamic_div+='<div style="margin-bottom:0px;" class="form-group">';
                                dynamic_div+='<input onblur ="set_attributes(\''+myid+'\',this,\'name\',1)" onkeyup ="set_attributes(\''+myid+'\',this,\'name\',0)" type="text" id="'+Object.keys(style_property[k])[0]+'_'+k+'"  value="'+name+'" class="form-control" list="name_suggestions">';
                                dynamic_div+='<datalist id="name_suggestions"><option value="first_name"><option value="last_name"><option value="email"><option value="phone"></datalist>'
                            dynamic_div+='</div>';
                         dynamic_div+='</div>';
                }

                if ( (html_element_type =='img' || html_element_type == 'video' || html_element_type == 'iframe' || html_element_type == 'div') && counter && !$("#"+myid).hasClass("fb-comments")){
					var src ="";
					var label_img = "Src";
					if(html_element_type =='img'){src = $("#"+myid)[0].src; label_img="Image src";}
					if(html_element_type =='video'){src = $("#"+myid)[0].currentSrc; label_img="Video src";}
					if(html_element_type =='iframe'){src = $("#"+myid)[0].src; label_img="Embeded src";}
					console.log(html_element_type);
					if(html_element_type =='div' || html_element_type =='td'){
						src = ($("#"+myid)[0].style.backgroundImage.replace('url("','')).replace('")','');
						label_img="BG image";
					}

					dynamic_div+= '<div class="col-sm-12" style="padding:0; margin-top:10px;">';
						dynamic_div+= '<label  style="margin-top:8px;" class="labeling_style col-sm-4">'+label_img+'</label>';
						dynamic_div+= '<div style="padding-left:6.5%;padding-right:2%;" class="pull-right col-sm-8 input-group" >';
							dynamic_div+='<input type="text" class="form-control" id="image_src_input_'+k+'" onchange="set_attributes(\''+myid+'\',this,\'src\',1)" value="'+src+'"  placeholder="Paste your url here.">';
							if(html_element_type != 'iframe'){
								dynamic_div+='<span class="input-group-btn">';
									dynamic_div+='<button class="btn btn-secondary" type="button" style="padding: 6px 10px; margin-top:0; " onclick="document.getElementById(\'image_file_upload\').click();"><i class="fa fa-cloud-upload" aria-hidden="true"></i></button>';
								dynamic_div+='</span>';
								dynamic_div+='<span class="input-group-btn">';
									dynamic_div+='<button class="btn btn-secondary" type="button" onclick="$(\'#image_src_input_field_id\')[0].value = \'image_src_input_'+k+'\';" data-toggle="modal" data-target="#show_image_library_src" style="padding: 6px 10px; margin-top:0; border-left: 1px solid #b7b7b7;"><i class="fa fa-th-large" aria-hidden="true"></i></button>';
								dynamic_div+='</span>';
							}
						dynamic_div+= '</div>';
						dynamic_div+='<input style="display:none;" type="file"  id="image_file_upload" onchange="javascript:upload_image_raw(this,\'contestHeaderImagePreview\', \''+base+'/editor/?process=upload_an_image_to_cloud&preview_width=100&preview_height=100\', \''+base+'\', \'file_uploaded\');">';
						dynamic_div+='<span style="display:none;color:green;64px;width:100%;"  id="contestHeaderImagePreview"></span>';
						dynamic_div+='<input  style="display:none;"  id="last_changed_img_video_id" value="image_src_input_'+k+'">';
					dynamic_div+= '</div>';
					counter = false;
				}

				dynamic_div_child.innerHTML += dynamic_div;
				dynamic_div_settings.appendChild(dynamic_div_child);

			}
		}
	}
	document.getElementById("settings_div").appendChild( dynamic_div_settings ); 

	var buttons = "";
	if($("#"+myid).hasClass("main_container")){
		buttons +='<div id="settings_save"  onclick="save_my_settings();" style="width: 100%">Save</div>';
	}else if($("#"+myid)[0].tagName == "IFRAME" || $("#"+myid).hasClass("timer_wrapper") || $("#"+myid).hasClass("dont_clone")){
		buttons +='<div id="settings_save"  onclick="save_my_settings();" style="width: 50%">Save</div>';
		buttons +='<div id="settings_remove"  onclick="hover_remove_me(\''+myid+'\');" style="width: 50%">Remove</div>';
	}else{
		buttons +='<div id="settings_save"  onclick="save_my_settings();" style="width: 33.3%">Save</div>';
		buttons +='<div id="settings_clone"  onclick="hover_make_a_clone(\''+myid+'\');" style="width: 33.3%" >Clone</div>';
		buttons +='<div id="settings_remove"  onclick="hover_remove_me(\''+myid+'\');" style="width: 33.3%">Remove</div>';
	}

	document.getElementById("footer-buttons").innerHTML = buttons; 
	
	for ( var j=0 ; j<advanced_styles.length;j++){
		for (var k=0;k<Object.keys(style_property).length;k++){
			if (advanced_styles[j] == Object.keys(style_property[k]) ){
				var dynamic_div_child = document.createElement('div');
				dynamic_div_child.className="col-sm-12";
				dynamic_div_child.style.cssText="margin-top:10px;padding:0";
			    var dynamic_div="";
			    
				if ( style_property[k][advanced_styles[j]]['type']=='colorpicker' ){
					dynamic_div+='<label  style="margin-top:8px;" class="labeling_style col-sm-4">' +style_property[k][advanced_styles[j]]['label']+'</label>';
					dynamic_div+='<div style="padding-left:6.5%;padding-right:2%;" class=" pull-right col-sm-8" >';
						dynamic_div+='<div style="margin-bottom:0px;" class="form-group">';
							dynamic_div+='<input type="text" id="'+Object.keys(style_property[k])[0]+'_'+k+'" class="form-control demo" data-format="rgb" data-opacity="1" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)"  value="'+attr_val[Object.keys(style_property[k])]+'">';
						dynamic_div+='</div>';
					 dynamic_div+='</div>';		
					dynamic_div+= '</div>';	
				}
				
					if ( style_property[k][advanced_styles[j]]['type']=='slider' ){
						dynamic_div+= '<label  style="margin-top:8px;" class="labeling_style col-sm-4">' +style_property[k][advanced_styles[j]]['label']+'</label>';
						dynamic_div+= '<div style="padding-left:7.5%;padding-right:2%;" class="pull-right col-sm-8" >';
							dynamic_div+= '<div class="pull-left" style="width: 76%;margin-top:5%;">';
								dynamic_div+= '<div class="custom_slider" id="'+Object.keys(style_property[k])+'_slider">';
								dynamic_div+='</div>';
							dynamic_div+='</div>';
							dynamic_div+= '<div class="pull-right text-center" style="width: 20%;">';
								dynamic_div+='<input id="'+Object.keys(style_property[k])+'_slider_input" onkeyup="slider_input_change_property(this,\''+myid+'\')" onchange="slider_input_change_property(this,\''+myid+'\')" type="number" class="form-control input-sm" style="text-align: center;font-size:12px;padding:1px 1px;">';
							dynamic_div+='</div>';
						dynamic_div+= '</div>';
							
						id = Object.keys(style_property[k])+"_slider";
						min =  style_property[k][advanced_styles[j]]['min'];
						max= style_property[k][advanced_styles[j]]['max'];
						suffix=style_property[k][advanced_styles[j]]['suffix'];
						value = attr_val[Object.keys(style_property[k])];
						if (value=='') value=min;
						slider_id_array.push ( id+';'+min+';'+max+';'+suffix+';'+value);	
						
				}		
				if ( style_property[k][advanced_styles[j]]['type']=='dropdown' ){
					dynamic_div+= '<label  style="margin-top:8px;" class="labeling_style col-sm-4">' +style_property[k][advanced_styles[j]]['label']+'</label>';
					dynamic_div+= '<div style="padding-left:6.5%;padding-right:2%;" class="pull-right col-sm-8" >';
					dynamic_div+= '<select class="form-control" id="'+Object.keys(style_property[k])+'_'+k+'" onchange="dropdown_live_preview(this,\''+myid+'\')">';

					for ( i=0 ; i<Object.keys(style_property[k][advanced_styles[j]]['options']).length;i++){
						if( style_property[k][advanced_styles[j]]['options'][Object.keys(style_property[k][advanced_styles[j]]['options'])[i]] == attr_val[Object.keys(style_property[k])]){
							dynamic_div+= '<option value="'+style_property[k][advanced_styles[j]]['options'][Object.keys(style_property[k][advanced_styles[j]]['options'])[i]]+'" selected>'+Object.keys(style_property[k][advanced_styles[j]]['options'])[i]+'</option>';
						}else{
							dynamic_div+= '<option value="'+style_property[k][advanced_styles[j]]['options'][Object.keys(style_property[k][advanced_styles[j]]['options'])[i]]+'">'+Object.keys(style_property[k][advanced_styles[j]]['options'])[i]+'</option>';
						}
					 }
					 dynamic_div+= '</select>';
					dynamic_div+= '</div>';
				}	

				if ( style_property[k][advanced_styles[j]]['type']=='add_class' ){
                    var text_input = get_original_classes(myid);
                    text_input = text_input.trim();
                    dynamic_div+= '<div class="col-sm-12" style="padding:0;">';
                        dynamic_div+='<label  style="margin-top:8px;" class="labeling_style col-sm-4">' +style_property[k][advanced_styles[j]]['label']+'</label>';
                        dynamic_div+='<div style="padding-left:6.5%;padding-right:2%;" class=" pull-right col-sm-8" >';
                            dynamic_div+='<div style="margin-bottom:0px;" class="form-group">';
                                dynamic_div+='<textarea onblur="add_class_into_element(\''+myid+'\',this)" id="'+Object.keys(style_property[k])[0]+'_'+k+'" class="form-control" style="resize: vertical;">'+text_input+'</textarea>';
                            dynamic_div+='</div>';
                         dynamic_div+='</div>';       
                    dynamic_div+= '</div>';
                }

				if ( style_property[k][advanced_styles[j]]['type']=='inline_css' ){
                    var text_input = $("#"+myid)[0].style.cssText;
                    dynamic_div+= '<div class="col-sm-12" style="padding:0;">';
                        dynamic_div+='<label  style="margin-top:8px;" class="labeling_style col-sm-4">' +style_property[k][advanced_styles[j]]['label']+'</label>';
                        dynamic_div+='<div style="padding-left:6.5%;padding-right:2%;" class=" pull-right col-sm-8" >';
                            dynamic_div+='<div style="margin-bottom:0px;" class="form-group">';
                                dynamic_div+='<textarea onblur="set_inline_css(\''+myid+'\',this)" id="'+Object.keys(style_property[k])[0]+'_'+k+'" class="form-control" style="resize: vertical;">'+text_input+'</textarea>';
                            dynamic_div+='</div>';
                         dynamic_div+='</div>';       
                    dynamic_div+= '</div>';
                }
				
				dynamic_div_child.innerHTML+=dynamic_div;
				dynamic_div_advanced_styles.appendChild(dynamic_div_child);  
				
			}
		}
	}
	
	for ( var j=0 ; j<advanced_animation.length;j++){
		for (var k=0;k<Object.keys(style_property).length;k++){
			if (advanced_animation[j] == Object.keys(style_property[k]) ){
				var dynamic_div_child = document.createElement('div');
				dynamic_div_child.className="col-sm-12";
				dynamic_div_child.style.cssText="margin-top:10px;padding:0;";
			    var dynamic_div="";
				if ( style_property[k][advanced_animation[j]]['type']=='colorpicker' ){
					dynamic_div+='<label  style="margin-top:8px;" class="labeling_style col-sm-4">' +style_property[k][advanced_animation[j]]['label']+'</label>';
					dynamic_div+='<div style="padding-left:6.5%;padding-right:2%;" class=" pull-right col-sm-8" >';
						dynamic_div+='<div  style="margin-bottom:0px;" class="form-group">';
							dynamic_div+='<input type="text" id="'+Object.keys(style_property[k])[0]+'_'+k+'" class="form-control demo" data-format="rgb" data-opacity="1" data-swatches="#fff|#000|#f00|#0f0|#00f|#ff0|rgba(0,0,255,0.5)"  value="'+attr_val[Object.keys(style_property[k])]+'">';
						dynamic_div+='</div>';
					 dynamic_div+='</div>';
				}
			
				if ( style_property[k][advanced_animation[j]]['type']=='slider' ){
					dynamic_div+= '<label  style="margin-top:8px;" class="labeling_style col-sm-4">' +style_property[k][advanced_animation[j]]['label']+'</label>';
					dynamic_div+= '<div style="padding-left:7.5%;padding-right:2%;" class="pull-right col-sm-8" >';
						dynamic_div+= '<div class="pull-left" style="width: 76%;margin-top:5%;">';
							dynamic_div+= '<div class="custom_slider" id="'+Object.keys(style_property[k])+'_slider">';
							dynamic_div+='</div>';
						dynamic_div+='</div>';
						dynamic_div+= '<div class="pull-right text-center" style="width: 20%;">';
							dynamic_div+='<input id="'+Object.keys(style_property[k])+'_slider_input" onkeyup="slider_input_change_property(this,\''+myid+'\')" onchange="slider_input_change_property(this,\''+myid+'\')" type="number" class="form-control input-sm" style="text-align: center;font-size:12px;padding:1px 1px;">';
						dynamic_div+='</div>';
					dynamic_div+= '</div>';
					
				    id = Object.keys(style_property[k])+"_slider";
					min =  style_property[k][advanced_animation[j]]['min'];
					max= style_property[k][advanced_animation[j]]['max'];
					suffix=style_property[k][advanced_animation[j]]['suffix'];
					value = attr_val[Object.keys(style_property[k])];
					if (value=='') value=min;
					slider_id_array.push ( id+';'+min+';'+max+';'+suffix+';'+value);	
					
			}		
			if ( style_property[k][advanced_animation[j]]['type']=='dropdown' ){
				dynamic_div+= '<label  style="margin-top:8px;" class="labeling_style col-sm-4">' +style_property[k][advanced_animation[j]]['label']+'</label>';
				dynamic_div+= '<div style="padding-left:6.5%;padding-right:2%;" class="pull-right col-sm-8" >';
				dynamic_div+= '<select class="form-control" id="'+Object.keys(style_property[k])+'_'+k+'" onchange="dropdown_live_preview(this,\''+myid+'\')">';
				 for ( i=0 ; i<Object.keys(style_property[k][advanced_animation[j]]['options']).length;i++){
					if( style_property[k][advanced_animation[j]]['options'][Object.keys(style_property[k][advanced_animation[j]]['options'])[i]] == attr_val[Object.keys(style_property[k])]){
						dynamic_div+= '<option value="'+style_property[k][advanced_animation[j]]['options'][Object.keys(style_property[k][advanced_animation[j]]['options'])[i]]+'" selected>'+Object.keys(style_property[k][advanced_animation[j]]['options'])[i]+'</option>';
					}else{
						dynamic_div+= '<option value="'+style_property[k][advanced_animation[j]]['options'][Object.keys(style_property[k][advanced_animation[j]]['options'])[i]]+'">'+Object.keys(style_property[k][advanced_animation[j]]['options'])[i]+'</option>';
					}
				 }
				 dynamic_div+= '</select>';
				dynamic_div+= '</div>';
			}	
			dynamic_div_child.innerHTML+=dynamic_div;
			dynamic_div_advanced_styles.appendChild(dynamic_div_child);  
			}
		}
	}
	
	dynamic_div_advanced.appendChild(dynamic_div_advanced_styles);  
	dynamic_div_advanced.appendChild(dynamic_div_advanced_animation);  
	document.getElementById("advanced_div").appendChild( dynamic_div_advanced ); 
	
	enable_colorpicker(myid);
	enable_slider (myid , JSON.stringify(slider_id_array));
	open_all_element_option();

}

function add_class_into_element(my_id,me){
	var input_classes = $(me)[0].value;
	input_classes = input_classes.split(" ");
	var editor_classes = get_editor_classes(my_id);
	editor_classes = editor_classes.split(" ");
	$("#"+my_id)[0].className = "";
	for(var i=0;i<editor_classes.length;i++){
		$("#"+my_id).addClass(editor_classes[i]);
	}
	for(var i=0;i<input_classes.length;i++){
		$("#"+my_id).addClass(input_classes[i]);
	}
	$("#"+my_id).removeClass("click_show_my_border");
	$("#"+my_id).removeClass("hover_disable");
	$("#"+my_id).removeClass("ui-sortable");
	$("#"+my_id).removeClass("ui-sortable-handle");
	var value = $("#"+my_id)[0].className;
	var change_type = 'class';
    var html_data = awesome_data;
    html_data = JSON.parse(html_data);
    html_data = set_attributes_to_json(my_id , value , change_type  , html_data);
    awesome_data = JSON.stringify(html_data);
}

function set_inline_css(my_id,me){
	var value = $(me).val();
	$("#"+my_id)[0].style.cssText = value;
}

function set_content(my_id,me,fun){
	if(fun == 1){
		var html_data = awesome_data;
		if( html_data != '' ) {
			html_data = JSON.parse( html_data );
			html_data = set_json_content_value(my_id,html_data);
			awesome_data = JSON.stringify(html_data);
		}
	}
	$("#"+my_id)[0].innerHTML = $(me)[0].value;
}

function upload_image_raw(image, preview_div, uploadUrl, base, callback ,type) {
    if( preview_div != "" ) document.getElementById(preview_div).style.display = 'inline-block';
    if( preview_div != "" ) document.getElementById(preview_div).innerHTML = '<span><img src=" '+base+'/files/editorscript/images/scanningwoohoo.gif  "  width="10%" /><span style="display:inline-block;"><h5 style="color:#85c0e7 ;">Uploading...</h5></span></span>';
  // Get the selected files from the input.
   var files = image.files;
   // Create a new FormData object.
   var formData = new FormData();
   // Loop through each of the selected files.
   for (var i = 0; i < files.length; i++) {
     var file = files[i];
     // Check the file type.
     if (file.type.match('image.*')) {
        formData.append('image[]', file, file.name);
     }
      if (file.type.match('video.*')) {
        formData.append('image[]', file, file.name);
     }
     // Add the file to the request.
   }    
   // Set up the request.
   var xhr = new XMLHttpRequest();
   // Open the connection.
   xhr.open('POST', uploadUrl, true);
   // Set up a handler for when the request finishes.
   xhr.onload = function () {
     if (xhr.status === 200) {
       // File(s) uploaded.
       if( preview_div != "" ) document.getElementById(preview_div).style.display = 'inline-block';
        if( preview_div != "" ) document.getElementById(preview_div).innerHTML = '<span><img src=" '+base+'/files/editorscript/images/check.gif  "  width="10%" /><span style="display:inline-block;"><h5 style="color:#85c0e7 ;">File uploaded successfully.</h5></span></span>';
       setTimeout(function(){
              if( preview_div != "" ) document.getElementById(preview_div).style.display = 'none';
        },2000);
       var responseText = xhr.responseText;
       if(callback != '' ) {            
           window[callback](preview_div, responseText,type);
       }
     } else {
        if( preview_div != "" ) document.getElementById(preview_div).style.display = 'none';
        if( preview_div != "" ) document.getElementById(preview_div).style.display = 'inline-block';
        if( preview_div != "" ) document.getElementById(preview_div).innerHTML = '<span style="color:#FF5D5D ;"><i class="fa fa-times" aria-hidden="true"></i> '+xhr.responseText+'</span>';
        setTimeout(function(){
              if( preview_div != "" ) document.getElementById(preview_div).style.display = 'none';
        },3000);
     }
   };
   // Send the Data.
   xhr.send(formData);
   return false;
}

function file_uploaded( preview_div, response ,type ) {    

    if (type=="seo"){
        var element = document.getElementById('seo_page_image');
        element.value=response;
        var evt = document.createEvent("HTMLEvents");
        evt.initEvent("change", false, true);
        element.dispatchEvent(evt);
    }

    else {
        var last_changed_img_video_id = document.getElementById('last_changed_img_video_id').value;
        var element = document.getElementById(last_changed_img_video_id);
        element.value=response;
        var evt = document.createEvent("HTMLEvents");
        evt.initEvent("change", false, true);
        element.dispatchEvent(evt);
    } 
    var data = 'user_id='+ $("#user_id")[0].value;
    data += '&uploaded_url='+response;
    http_post_request( base + '/editor/?process=upload_this_image', data , 'nothing_to_do' );
    add_current_image_to_media(response);
}

function nothing_to_do(res){
	show_editor_msg(res , 1);
}

function add_current_image_to_media(url){
	var drag_and_drop_elements = JSON.parse($("#drag_and_drop_elements")[0].value);
    var img = '{"tag":"img","endtag":1,"attributes":{"style":"width: 500px; max-width:100%;text-align:center;","src":"'+url+'"}}';
    var temp = {};
    temp['html'] = JSON.parse(img);
    temp['id'] = "uploads_image_url_js_"+mdid;
    drag_and_drop_elements.push(temp);
    $("#drag_and_drop_elements")[0].value = JSON.stringify(drag_and_drop_elements);
    //media_img_sidepanel_lib,media_img_settings_lib


    var sil = "";
    sil += '<div style="max-height: 80px;min-height: 80px; margin-top:10px;" class="col-md-3 main_image_div" >';
    sil += '   <img class="media_image" style="max-height: 80px;min-height: 80px; border:2px solid rgba(80, 80, 255, 0.65)"  src="'+url+'" width="100%">';
    sil += '   <div class="col-sm-12 col-md-12">';
    sil += '      <div class="button">';
    sil += '         <button style="padding:2px;background: rgba(14, 65, 210, 0.41);border: 1px solid blue;border-radius: 0px; " class="btn btn-primary col-sm-6 col-md-6" onclick="add_this_url_to_input_field(\''+url+'\');" data-dismiss="modal"> Insert </button>';
    sil += '         <button style="padding:2px;background: rgba(255, 1, 1, 0.45);border:1px solid #b70d01;border-radius: 0px;" onclick="delete_this_image_form_db(null,this)" class="btn btn-primary col-sm-6 col-md-6"> Delete </button>';
    sil += '      </div>';
    sil += '   </div>';
    sil += '</div>';

    $("#media_img_settings_lib")[0].innerHTML += sil;
    var misl = "";
    misl += '<div style="max-height: 80px;min-height: 80px; margin-top:10px;" class="col-md-3 main_image_div" >';
    misl +=   '<img class="media_image" style="max-height: 80px;min-height: 80px; border:2px solid rgba(80, 80, 255, 0.65)"  src="'+url+'" width="100%">';
    misl +=   '<div class="col-sm-12 col-md-12">';
    misl +=     '<div class="button">';
    misl +=       '<button style="padding:2px;background: rgba(14, 65, 210, 0.41);border: 1px solid blue;border-radius: 0px; " class="btn btn-primary col-sm-6 col-md-6" id="uploads_image_url_js_'+mdid+'" onclick="add_me_to_editor_preview(this);" data-dismiss="modal"> Insert </button>';
    misl +=       '<button style="padding:2px;background: rgba(255, 1, 1, 0.45);border:1px solid #b70d01;border-radius: 0px;" onclick="delete_this_image_form_db(\'null\',this)" class="btn btn-primary col-sm-6 col-md-6"> Delete </button>';
    misl +=     '</div>';
    misl +=   '</div>';
    misl += '</div>';
    $("#media_img_sidepanel_lib")[0].innerHTML += misl;

    mdid++;
    for(var i=0; i<$(".no_image_error_msg").length;i++){
    	$($(".no_image_error_msg")[i]).hide();
    }
}

function dropdown_live_preview(me){
	my_id = $('#current_editable_element_id').val();
	var type = me.id.split("_")[0];
	var html_data = awesome_data;
    html_data = JSON.parse(html_data);
	if(type == 'href-target'){
        html_data = set_attributes_to_json(my_id , me.value , "target"  , html_data);
        awesome_data = JSON.stringify(html_data);
	}else if(type == 'position'){
		var tagname = document.getElementById(my_id).tagName;
		if(tagname == 'IFRAME'){
			if(me.value == "center"){
				var class_name = "iframeCenter";
				if(!$("#"+my_id).hasClass(class_name)){
					html_data = add_class_to_json(my_id,class_name,html_data);
					$("#"+my_id).addClass(class_name);
					var remove_this_class = 'iframeRight';
					html_data = remove_class_from_json(my_id,remove_this_class,html_data);
					$("#"+my_id).removeClass(remove_this_class);
				}
			}else if(me.value == "right"){
				var class_name = "iframeRight";
				if(!$("#"+my_id).hasClass(class_name)){
					html_data = add_class_to_json(my_id,class_name,html_data);
					$("#"+my_id).addClass(class_name);
					var remove_this_class = 'iframeCenter';
					html_data = remove_class_from_json(my_id,remove_this_class,html_data);
					$("#"+my_id).removeClass(remove_this_class);
				}
			}else if(me.value == "left"){
				if($("#"+my_id).hasClass('iframeCenter')){
					class_name = 'iframeCenter';
					html_data = remove_class_from_json(my_id,class_name,html_data);
					$("#"+my_id).removeClass(class_name);
				}else if($("#"+my_id).hasClass('iframeRight')){
					class_name = 'iframeRight';
					html_data = remove_class_from_json(my_id,class_name,html_data);
					$("#"+my_id).removeClass(class_name);
				}
			}
		}else{
			if(me.value == "center"){
				var class_name = "position-center";
				if(!$("#"+my_id).hasClass(class_name)){
					html_data = add_class_to_json(my_id,class_name,html_data);
					$("#"+my_id).addClass(class_name);
					var remove_this_class = 'position-right';
					html_data = remove_class_from_json(my_id,remove_this_class,html_data);
					$("#"+my_id).removeClass(remove_this_class);
				}
			}else if(me.value == "right"){
				var class_name = "position-right";
				if(!$("#"+my_id).hasClass(class_name)){
					html_data = add_class_to_json(my_id,class_name,html_data);
					$("#"+my_id).addClass(class_name);
					var remove_this_class = 'position-center';
					html_data = remove_class_from_json(my_id,remove_this_class,html_data);
					$("#"+my_id).removeClass(remove_this_class);
				}
			}else if(me.value == "left"){
				if($("#"+my_id).hasClass('position-center')){
					class_name = 'position-center';
					html_data = remove_class_from_json(my_id,class_name,html_data);
					$("#"+my_id).removeClass(class_name);
				}else if($("#"+my_id).hasClass('position-right')){
					class_name = 'position-right';
					html_data = remove_class_from_json(my_id,class_name,html_data);
					$("#"+my_id).removeClass(class_name);
				}
			}
		}
	}else if(type == 'hide-on-mobile'){
		var class_name = "hidden-xs";
		if(me.value == "yes"){
			if(!$("#"+my_id).hasClass(class_name)){
				html_data = add_class_to_json(my_id,class_name,html_data);
				$("#"+my_id).addClass(class_name);
			}
		}else if(me.value == "no"){
			if($("#"+my_id).hasClass(class_name)){
				html_data = remove_class_from_json(my_id,class_name,html_data);
				$("#"+my_id).removeClass(class_name);
			}
		}
	}else{
		$("#"+my_id).css(type, me.value);
	}

	awesome_data = JSON.stringify(html_data);
}

function changed_css_element_ids(my_id){
	$('#current_editable_element_id').val(my_id);
	var edited_all_elements_id = $('#edited_all_elements_id').text();
	if(edited_all_elements_id == ""){
		edited_all_elements_id = new Array();
	}else{
		edited_all_elements_id = JSON.parse(edited_all_elements_id);
	}
	edited_all_elements_id.push(my_id);
	$('#edited_all_elements_id').text(JSON.stringify(edited_all_elements_id));
}


function get_slider_min_max_value(my_id, property, default_min_max){
	var tag_name = my_id.split("_")[0].toLowerCase();
	if(tag_name == 'img'){
		if(property == 'width')return [10,2560,'px'];
		if(property == 'height')return [10,1440,'px'];
		else return default_min_max;
	}
	if(tag_name == 'video'){
		if(property == 'width')return [50,2560,'px'];
		if(property == 'height')return [50,1440,'px'];
		else return default_min_max;
	}	
	return default_min_max;
}

function set_attributes(my_id , option , change_type,set_type){
    //~var my_id = $("#current_editable_element_id").val();
    if ( change_type== 'placeholder' ) {
         document.getElementById(my_id).placeholder = $(option).val();
    }
    if(my_id.split("_")[0] == 'div' && !$("#"+my_id).hasClass("fb-comments")){
        var url= 'url('+$(option).val()+')';
        $("#"+my_id).css('background-image',url);
    }else{
    	if(set_type == 1){
	        var value = $(option).val();
	        var html_data = awesome_data;
	        html_data = JSON.parse(html_data);
	        html_data = set_attributes_to_json(my_id , value , change_type  , html_data);
	        awesome_data = JSON.stringify(html_data);
	        $("#"+my_id)[0][change_type] = value;
	        //show_all_updated_view(html_data);
	    }
    }
}

function upload_image_or_video(me){

}

function slider_input_change_property(me,my_id){
	var value= $('#'+me.id).val();
	var property = me.id.split('_')[0];
	$('#'+my_id).css(property,value+"px");

	var slider_id = me.id.split('_input')[0];
	$("#"+slider_id).slider({
        value:  value                               
    });
	//enable_slider(myid, slider_array)
}

function insert_custom_script(){
	var page_id = document.getElementById('page_id').value;
	var custom_script = document.getElementById('custom_script_textarea').value;
	var temp_div = document.createElement("DIV");
	$(temp_div).append(custom_script);
	custom_script = "";
	for(var i=0;i<$(temp_div)[0].childNodes.length;i++){
		if($($(temp_div)[0].childNodes[i])[0].nodeName == "#text" && $($(temp_div)[0].childNodes[i])[0].textContent.trim() != ""){
			custom_script += '<script>'+$($(temp_div)[0].childNodes[i])[0].textContent.trim()+"</script>\n";
		}else if($($(temp_div)[0].childNodes[i])[0].nodeName == "SCRIPT"){
			custom_script += $($(temp_div)[0].childNodes[i])[0].outerHTML+"\n";
		}
	}

	var data = '&custom_script='+encodeURIComponent(custom_script);
    http_post_request( base + '/editor/?process=insert_custom_script&page_id='+page_id, data , 'insert_custom_script_finished' );
}

function insert_custom_script_finished(res){
	document.getElementById('custom_script_textarea').value = res;
	show_editor_msg("Script saved" , 1);
}

function insert_custom_css(){
	var page_id = document.getElementById('page_id').value;
	var custom_css = document.getElementById('custom_css_textarea').value;
	var temp_div = document.createElement("DIV");
	$(temp_div).append(custom_css);
	custom_css = "";
	for(var i=0;i<$(temp_div)[0].childNodes.length;i++){
		if($($(temp_div)[0].childNodes[i])[0].nodeName == "#text" && $($(temp_div)[0].childNodes[i])[0].textContent.trim() != ""){
			custom_css += '<style>'+$($(temp_div)[0].childNodes[i])[0].textContent.trim()+"</style>\n";
		}else if($($(temp_div)[0].childNodes[i])[0].nodeName == "STYLE"){
			custom_css += $($(temp_div)[0].childNodes[i])[0].outerHTML+"\n";
		}else if($($(temp_div)[0].childNodes[i])[0].nodeName == "LINK"){
			custom_css += $($(temp_div)[0].childNodes[i])[0].outerHTML+"\n";
		}
	}
	var data = '&custom_css='+encodeURIComponent(custom_css);
    http_post_request( base + '/editor/?process=insert_custom_css&page_id='+page_id, data , 'insert_custom_css_finished' );
}

function insert_custom_css_finished(res){
	document.getElementById('custom_css_textarea').value = res;
	show_editor_msg("CSS saved" , 1);
	var url = base + '/editor/?page='+document.getElementById('page_id').value;
	save_my_settings();
    window.location = url;
}

function overflow_control(element){
	var Overflow_Items = [];
	Overflow_Items = get_overflow_elements(element, Overflow_Items);
	for(var i=0;i<Overflow_Items.length;i++){
		if(!$(Overflow_Items[i]).hasClass("row")){
			$(Overflow_Items[i]).css("max-height", "100%");
			$(Overflow_Items[i]).css("max-width", "100%");
		}
	}
}

function get_overflow_elements(element,Overflow_Items){
	for(var i=0; i<element.children().length; i++){
		if (element.children()[i].offsetTop + element.children()[i].offsetHeight > element[0].offsetTop + element[0].offsetHeight || element.children()[i].offsetLeft + element.children()[i].offsetWidth > element[0].offsetLeft + element[0].offsetWidth ){
			Overflow_Items.push(element.children()[i]);
		}
		get_overflow_elements($(element.children()[i]),Overflow_Items);
	}
	return Overflow_Items;
}



function get_all_bootstrap_modal(){
	var all_modal = $('div.div_editorpreview').find('.modal');
	//show_all_pop_up_list
	var pop_up = "";
	var k=1;
	for(var i=0;i<all_modal.length;i++){
		pop_up += '<tr>';
	    pop_up +='<td>'+k+'. Popup-'+k+'</td>'
	    pop_up +='<td><button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#'+all_modal[i].id+'" data-dismiss="modal" >View</button><button class="btn btn-sm btn-primary" style="margin-left: 10px; margin-right: 10px;" onclick="add_pop_up_button_to_json(\''+all_modal[i].id+'\')">Add pop up button</button><button class="btn btn-sm btn-danger" onclick="delete_this_popup(\''+all_modal[i].id+'\',this)">Delete</button></td>';
	    pop_up +='</tr>';
	    k++;
	}
    $("#show_all_pop_up_list")[0].innerHTML = pop_up;
    $("button[data-toggle='modal']").click(function(){
    	setTimeout(function(){ sortable_state_change(); }, 500);
    });
}

function add_pop_up_button_to_json(modal_id){

	var deleted_element = '{"tag":"button","endtag":1,"attributes":{"class":"btn btn-primary","id":"'+get_valid_element_id("BUTTON")+'","onmouseover":"this_is_me(this,event)","ondblclick":"medium_edit_text(this,event)","onblur":"disable_medium_edit_text(this,event)","type":"button","data-toggle":"modal","data-target":"#'+modal_id+'"},"content":"Click me"}';
	
	my_new_prev_id = $("#current_editable_element_id")[0].value;
	if(my_new_prev_id == ""){
		my_new_prev_id = null;
		my_new_parent_id = "body_container";
	}else{
		my_new_parent_id = $("#"+my_new_prev_id).parent()[0].id;
	}
	
	var html_data = awesome_data;
	if( html_data != '' ) {
		html_data = JSON.parse( html_data );
		html_data = insert_element_to_json(JSON.parse(deleted_element), my_new_parent_id, my_new_prev_id, html_data);
		awesome_data = JSON.stringify(html_data);
		show_all_updated_view(html_data);
	}
	
}

function delete_this_popup(my_id,me){
	$(me).parent().parent().remove();
	var html_data = awesome_data;
	if( html_data != '' ) {
		html_data = JSON.parse( html_data );
		html_data = delete_element_from_json(my_id,"","","",html_data);
		awesome_data = JSON.stringify(html_data);
	}
	add_button_inside_empty_div();
}


function save_seo_settings_data() {
	var all_seo_data =  'title=' + encodeURIComponent( document.getElementById('seo_page_title').value );
	all_seo_data +=  '&description=' + encodeURIComponent( document.getElementById('seo_page_description').value );
	all_seo_data +=  '&image=' + encodeURIComponent( document.getElementById('seo_page_image').value );
	all_seo_data +=  '&page_id=' + encodeURIComponent( document.getElementById('seo_page_id').value );
	http_post_request( base + '/editor/?process=save_seo_settings_to_db', all_seo_data , 'seo_settings_saved_to_db' );
}

function seo_settings_saved_to_db(res){
    $( "#seo_settings_popup_close_btn" ).click();
    show_editor_msg("SEO settings saved" , 1);
}

function add_this_custom_snippet(){
	var iDiv = document.createElement('div');
	var innerhtml = "";
	if($("#custom_snippet_textarea_text").is(":visible")){
		var text_html = $("#custom_snippet_textarea_text")[0].value;
    	iDiv.innerHTML = text_html;
		innerhtml = set_editor_conf_for_element($(iDiv));
		$("#custom_snippet_textarea_text")[0].value = "";
	}else{
		var text_html = $("#custom_snippet_textarea")[0].value;
    	iDiv.innerHTML = text_html;
		innerhtml = html_to_json_generator($(iDiv));
	}
	my_id = my_new_parent_id;

	var deleted_element = add_elements_id_and_functions(innerhtml);
	var html_data = awesome_data;
	if( html_data != '' ) {
		html_data = JSON.parse( html_data );
		html_data = insert_element_to_json(deleted_element, my_new_parent_id, my_new_prev_id, html_data);
		awesome_data = JSON.stringify(html_data);
		show_all_updated_view(html_data);
	}
}

function set_editor_conf_for_element(ele){
	for(var i=0;i<ele[0].children.length;i++){
		$(ele[0].children[i]).addClass("sortable_disabled");
		if($(ele[0].children[i])[0].children.length > 0){
			set_editor_conf_for_element($(ele[0].children[i]))
		}else{
			$(ele[0].children[i]).addClass("do_not_add_empty_button");
		}
	}
	return ele;
}

function load_personal_lib(){
	var data = 'page_type=' + encodeURIComponent( document.getElementById('page_type').value );
	http_post_request( base + '/editor/?process=load_personal_lib', data , 'load_personal_lib_done');
}
function load_personal_lib_done(res){
	$("#row_persornal_lib")[0].innerHTML = res;
}
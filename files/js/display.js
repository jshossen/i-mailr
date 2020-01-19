$(function() {
	remove_editor_hover_conf();
	var h = window.innerHeight;
	document.getElementsByTagName('body')[0].style.minHeight = h + 'px';
	$('.main_container')[0].style.minHeight = h + 'px';
	overflow_control($('.body_container'));

	var page_id = $("#page_id")[0].value;
	var user_id = $("#user_id")[0].value;
	$.getScript("https://l2.io/ip.js?var=myip", function(){
		$.ajax({
		  method: "POST",
		  url: base + "/page_view/?process=save_pageview",
		  data: { ip: myip, agent: navigator.userAgent, user_page_id: page_id }
		}).done(function( html ) {
		    console.log(html);
		  });
	});

	$('.i_mailr_optin_form').on('submit', function(e){
	    e.preventDefault();
	    var data = $(this).serialize();
	    var user_id = $("#user_id")[0].value;
	    data += '&user_id='+user_id;
	    console.log(data);
	    $.ajax({
			type: "POST",
			url: base+"/display/?process=save_optin_form_data",
			data: data,
			success: function(res) {
				var res = JSON.parse(res);
				if(typeof(res.id) !== 'undefined'){
					$('<div>Thank you for subscribing!</div>').insertBefore($('.i_mailr_optin_form').find("button"));
				}else{
					$('<div>'+res+'</div>').insertBefore($('.i_mailr_optin_form').find("button"));
				}

			}
	    });
	});

});

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

function show_loading_bar (me) {
    NProgress.start();
	NProgress.set(0.0); 
    var interval = setInterval(function() { NProgress.inc(.01); }, 100);  

    if( $(me)[0] != undefined ) {
	    var this_height = $(me)[0].offsetHeight;
		var this_width = $(me)[0].offsetWidth ;

		$(me).attr("data-loading-text","<i class='fa fa-circle-o-notch fa-spin'></i> Processing...");
		$(me).button('loading');

		$(me).css("min-height" , this_height );
		$(me).css("min-width" , this_width );
	}
}

function this_is_me() {
	return false;
}

function page_countdown( id, endtime ) {
    setInterval( function() {
        page_show_the_clock( id, endtime );
    }, 1000 );  
}

function page_show_the_clock(id, endtime) {
    var t = Date.parse(endtime) - Date.parse(new Date());
    if( t < 0 ) t = 0;
    var seconds = Math.floor((t / 1000) % 60);
    var minutes = Math.floor((t / 1000 / 60) % 60);
    var hours = Math.floor((t / (1000 * 60 * 60)) % 24);
    var days = Math.floor(t / (1000 * 60 * 60 * 24));

    if( document.getElementById( id + '_timer_days_segment' ) != null ) document.getElementById( id + '_timer_days_segment' ).innerHTML = two_digit_number_format( days );
    if( document.getElementById( id + '_timer_hours_segment' ) != null ) document.getElementById( id + '_timer_hours_segment' ).innerHTML = two_digit_number_format( hours );
    if( document.getElementById( id + '_timer_minutes_segment' ) != null ) document.getElementById( id + '_timer_minutes_segment' ).innerHTML = two_digit_number_format( minutes );
    if( document.getElementById( id + '_timer_seconds_segment' ) != null ) document.getElementById( id + '_timer_seconds_segment' ).innerHTML = two_digit_number_format( seconds );
}

function two_digit_number_format(n){
    return parseInt(n) > 9 ? "" + n: "0" + n;
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


function overflow_control(element){
	var Overflow_Items = [];
	Overflow_Items = get_overflow_elements(element, Overflow_Items);
	for(var i=0;i<Overflow_Items.length;i++){
		if(!$(Overflow_Items[i]).hasClass("row")){
			$(Overflow_Items[i]).css("max-height", "100%");
			$(Overflow_Items[i]).css("max-width", "100%");
			$(Overflow_Items[i]).css("white-space", "normal");
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
	$(".div_editorpreview").find(".hover_my_settings").remove();
	$(".div_editorpreview").find(".hover_my_settings2").remove();
}


function optin_form_submit(me,e){
	var form_id = $(me)[0].id;
	$("#"+form_id+" :input").each(function(){
		var input = $(this)[0];

		console.log(input.name);
		console.log(input.value);
	});


	var data = "type=email";
    //http_post_request( base + '/processor/?process=load_page_list' ,data, 'load_email_list_done' );
	return false;
}
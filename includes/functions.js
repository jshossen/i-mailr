var body_width = window.innerWidth;
var body_height = window.innerHeight;
$(function() {
    $('.disabled').click(function(e){
		e.preventDefault();
	});
});
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

//fire_this_event(document.getElementById("id"),"change");
function fire_this_event(element,eve_name){
    var event = document.createEvent('Event');
    event.initEvent(eve_name, true, true);
    element.dispatchEvent(event);
}

//email = sajib.remix@gmail.com
function validateEmail(email) {
  	var re = /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  	return re.test(email);
}

function gen_select_group_list(){
    var data = "";
    http_post_request( base + '/processor/?process=gen_select_group_list' ,data, 'gen_select_group_list_done' );
}

function gen_select_group_list_done(res){
    $(".select_group_list").each(function() {
        this.innerHTML = res;
    });
}

String.prototype.replaceAll = function(search, replacement) {
    var target = this;
    return target.split(search).join(replacement);
};
//just set a class name 'validate_input_special_character'
function validate_input_special_character(value, me){
	//var value = "[^a-zA-Z0-9\-_ \/]";
	var value1 = new RegExp(value);
	var value2 = new RegExp(value,"g");
    var TCode = $(me)[0].value;
    if (value1.test(TCode)) {
        $(me)[0].value = (TCode).replace(value2, '');
        // console.log("false");
    }    
}

$(document).ready(function() {
    $(".search").keyup(function () {
        var searchTerm = $(".search").val();
        var listItem = $('.results tbody').children('tr');
        var searchSplit = searchTerm.replace(/ /g, "'):containsi('")

        $.extend($.expr[':'], {'containsi': function(elem, i, match, array){
            return (elem.textContent || elem.innerText || '').toLowerCase().indexOf((match[3] || "").toLowerCase()) >= 0;
        }});

        $(".results tbody tr").not(":containsi('" + searchSplit + "')").each(function(e){
            $(this).hide();
        });

        $(".results tbody tr:containsi('" + searchSplit + "')").each(function(e){
            $(this).show();
        });

        var jobCount = $('.results tbody tr[visible="true"]').length;
        $('.counter').text(jobCount + ' item');
    });
});

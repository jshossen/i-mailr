var element_id = 0;
$(function() {
    if($("#page_list").length > 0){
        load_page_list();
        load_create_page_modal();
    }
    if($("#groups_list").length > 0){
        load_subscriber_groups_list();
    }
    if($("#subscriber_list").length > 0){
        if($("#group_id").length>0){
            load_groups_subscriber_list();
        }
    }
    if($("#dashboard_details").length > 0){
        load_dashboard_details();
    }
    if($("#trash_email_and_page_list").length > 0){
        load_trash_email_and_page_list();
    }
    if($("#sending_details").length > 0){
        load_email_sending_details();
        setInterval(function(){ load_email_sending_details(); }, 3000);
    }
});

function load_page_list(){
    var data = "type=page";
    http_post_request( base + '/processor/?process=load_page_list' ,data, 'load_page_list_done' );
}
function load_page_list_done(res){
    $("#page_list")[0].innerHTML = res;
    if($("#email_list").length > 0){
        load_email_list();
    }
}
function load_email_list(){
    var data = "type=email";
    http_post_request( base + '/processor/?process=load_page_list' ,data, 'load_email_list_done' );
}
function load_email_list_done(res){
    $("#email_list")[0].innerHTML = res;
    load_template_list();
}

function load_create_page_modal(){
    var navListItems = $('ul.setup-panel li a'),
    allWells = $('.setup-content');

    allWells.hide();

    navListItems.click(function(e)
    {
        e.preventDefault();
        var $target = $($(this).attr('href')),
            $item = $(this).closest('li');
        
        if (!$item.hasClass('disabled')) {
            navListItems.closest('li').removeClass('active');
            $item.addClass('active');
            allWells.hide();
            $target.show();
        }
    });
    
    $('ul.setup-panel li.active a').trigger('click');
    
    // DEMO ONLY //
    $('#activate-step-2').on('click', function(e) {
        $('ul.setup-panel li:eq(1)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-2"]').trigger('click');
        $(this).remove();
    })
    
    $('#activate-step-3').on('click', function(e) {
        if($("#page_name")[0].value != "" && $("#page_title")[0].value != ""){
            $('ul.setup-panel li:eq(2)').removeClass('disabled');
            $('ul.setup-panel li a[href="#step-3"]').trigger('click');
            $(this).remove();
        }

    })
    
    $('#activate-step-4').on('click', function(e) {
        $('ul.setup-panel li:eq(3)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-4"]').trigger('click');
        $(this).remove();
    })
    
    $('#activate-step-3').on('click', function(e) {
        $('ul.setup-panel li:eq(2)').removeClass('disabled');
        $('ul.setup-panel li a[href="#step-3"]').trigger('click');
        $(this).remove();
    })
}
function load_template_list(){
    var data = "page_type="+$("#page_type")[0].value;
    http_post_request( base + '/processor/?process=load_template_list' ,data, 'load_template_list_done' );
}
function load_template_list_done(res){
    $("#template_list_container")[0].innerHTML = res;
    fire_this_event(document.getElementById("template_id_0"),"click")
}

function set_this_page_type(type,me){
    $("#page_type")[0].value = type;
    $("#step-1").find('*').removeClass("border-5px");
    $(me).addClass('border-5px');
    load_template_list();
}
function set_page_name_title(input_id,me){
    $("#"+input_id)[0].value = $(me)[0].value;
}

function add_this_template(url,me){
    html_to_json(url);
    $("#step-3").find('*').removeClass("border-5px");
    $(me).addClass('border-5px');
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
        var body_style_elements =doc.getElementsByTagName("body")[0].getElementsByTagName('style');
        var css= "";

        for (l=0 ; l<head_style_elements.length ; l++){
            css+= head_style_elements[l].innerHTML;
        }
        for (l=0 ; l<body_style_elements.length ; l++){
            css+= body_style_elements[l].innerHTML;
        }
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
                    });
                oReq1.open("GET", myurl[k]);
                oReq1.send();
            }        
        }
        var iDiv = document.createElement('div');
        $(iDiv).addClass("do_not_show_my_menu");

        iDiv.innerHTML = body_part;
        var elements = iDiv.getElementsByTagName('script');
        while (elements[0]) elements[0].parentNode.removeChild(elements[0]);
        elements = iDiv.getElementsByTagName('noscript');
        while (elements[0]) elements[0].parentNode.removeChild(elements[0]);
        // elements = iDiv.getElementsByTagName('style');
        // while (elements[0]) elements[0].parentNode.removeChild(elements[0]);

        var json_data = html_to_json_generator($($(iDiv)[0].innerHTML));
        json_data = JSON.stringify(new Array(json_data));   
        $("#page_template")[0].value = json_data;
        //save_html_to_db(json_data);
     });
     oReq.open("GET", myUrl);
     oReq.send();
}

function html_to_json_generator(ele){
    var json_data_arr = {};
    json_data_arr["tag"] = ele[0].tagName.toLowerCase();
    if ($(ele)[0].outerHTML.endsWith('</'+$(ele)[0].tagName.toLowerCase()+'>')){json_data_arr["endtag"] = 1;}
    else{json_data_arr["endtag"] = 0;}
    var attr = ele[0].attributes;
    var tmp = {};
    var hasId = false;
    var hasClass = false;
    for(var l=0; l<Object.keys(attr).length; l++){
        if(attr[l].name == 'id'){
            hasId = true;
        }
    }
    if(!hasId){
        tmp['id'] = ele[0].tagName.toLowerCase()+'_'+(element_id++);
    }
    for(var k=0; k<Object.keys(attr).length; k++){
        tmp[attr[k].name] = attr[k].nodeValue;
    }
    json_data_arr["attributes"]= tmp;
    var content = $(ele[0]).clone().children().remove().end().text();

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

function create_new_page(){
    if($("#page_name").val() == "" || $("#page_title").val() == ""){
        if($("#page_name").val() == ""){
            $("#page_name_error").show();
        }
        if($("#page_title").val() == ""){
            $("#page_title_error").show();
        }
        
        fire_this_event(document.getElementById("page_name_and_title_li"),"click");
    }else{
        var data = 'html_data=' +  ($("#page_template")[0].value) ;
        data += '&page_name=' +  encodeURIComponent($("#page_name").val()) ;
        data += '&page_title=' +  encodeURIComponent($("#page_title").val()) ;
        data += '&page_type=' +  encodeURIComponent($("#page_type").val()) ;
        data += '&page_handle=' +  encodeURIComponent($("#page_handle").val().replaceAll(" ","-")) ;
        http_post_request( base + '/processor/?process=add_new_page_with_template', data , 'add_new_page_with_template_done' );
    }
}

function add_new_page_with_template_done(res){
    console.log(res);
    if(res == "fail"){
        alert("New page creation fail. Your max limit crossed. Please upgrade your plan. Or delete a page and create new.");
    }else{
        window.location.href = base+"/editor/?page="+res;
    }
}

function delete_this_page(id,me){
    var data = 'id=' +  id;
    http_post_request( base + '/processor/?process=delete_this_page', data , 'delete_this_page_done' );
}
function delete_this_page_done(res){
    if(res == "fail"){
        alert("New page creation fail. Your max limit crossed. Please upgrade your plan. Or delete a page and create new.");
    }else{
        load_page_list();
    }
}

function clone_this_page(id,me){
    var data = 'id=' +  id;
    http_post_request( base + '/processor/?process=clone_this_page', data , 'delete_this_page_done' );
}

function delete_selected_pages(type){
    if(type == "page"){
        var all = $("#page_list :checkbox");
    }else if(type == "email"){
        var all = $("#email_list :checkbox");
    }
    var selected_array = [];
    for(var i=0; i<all.length; i++){
        if($(all[i])[0].checked == true){
            selected_array.push($(all[i])[0].value);
        }
    }
    if(selected_array.length > 0){

        var data = 'ids=' +  encodeURIComponent(JSON.stringify(selected_array));
        http_post_request( base + '/processor/?process=delete_selected_pages', data , 'delete_this_page_done' );
    }
}

function select_all_checkbox(type){
    console.log(type);
    if(type == "page"){
        var all = $("#page_list :checkbox");
    }else if(type == "email"){
        var all = $("#email_list :checkbox");
    }else if(type == 'subscriber_list'){
        var all = $("#subscriber_list :checkbox");
    }else if(type == 'groups_subscriber_list'){
        var all = $("#subscriber_list :checkbox");
    }

    for(var i=0; i<all.length; i++){
        //$(element).is(":visible")
        if($(all[i]).parent().parent().is(":visible")){
            $(all[i])[0].checked = true;
        }
    }
}

function unselect_all_checkbox(type){
    if(type == "page"){
        var all = $("#page_list :checkbox");
    }else if(type == "email"){
        var all = $("#email_list :checkbox");
    }else if(type == 'subscriber_list'){
        var all = $("#subscriber_list :checkbox");
    }else if(type == 'groups_subscriber_list'){
        var all = $("#subscriber_list :checkbox");
    }
    for(var i=0; i<all.length; i++){
        $(all[i])[0].checked = false;
    }
}


//++++++++++++++++subscriber++++++++++++++++++++++
function add_this_subscriber(){
    var first_name = $("#input_first_name")[0].value;
    var last_name = $("#input_last_name")[0].value;
    var email = $("#input_email")[0].value;
    var phone = $("#input_phone")[0].value;
    if(last_name == ""){
        alert("Please give subscriber last name");
        return;
    }
    if(email == ""){
        alert("Please give subscriber email");
        return;
    }
    if(!validateEmail(email)){
        alert("Please give valid email");
        return;
    }
    var data = 'first_name=' +  encodeURIComponent(first_name);
    data += '&last_name=' +  encodeURIComponent(last_name);
    data += '&email=' +  encodeURIComponent(email);
    data += '&phone=' +  encodeURIComponent(phone);
    http_post_request( base + '/processor/?process=add_this_subscriber', data , 'add_this_subscriber_done' );
}
function add_this_subscriber_done(res){
    console.log(res);
    if(res == "fail"){
        alert("New subscriber creation fail. Your max limit crossed. Please upgrade your plan. Or delete a subscriber and create new.");
    }else if(res == "exists"){
        alert("Already exists");
    }
    load_subscriber_list();
    //$('#create_subscriber').modal('toggle');
    $("#create_subscriber .close").click();
}

function load_subscriber_list(){
    var data = "";
    http_post_request( base + '/processor/?process=load_subscriber_list' ,data, 'load_subscriber_list_done' );
}

function load_subscriber_list_done(res){
    $("#subscriber_list")[0].innerHTML = res;
}

function delete_this_subscriber(id,me){
    var data = 'id=' +  id;
    http_post_request( base + '/processor/?process=delete_this_subscriber', data , 'delete_this_subscriber_done' );
}
function delete_this_subscriber_done(res){
    load_subscriber_list();
}

function delete_this_subscriber_from_this_group(id,group_id,me){
    var data = 'id=' +  id;
    data += '&group_id=' +  group_id;
    http_post_request( base + '/processor/?process=delete_this_subscriber_from_this_group', data , 'delete_this_subscriber_from_this_group_done' );
}
function delete_this_subscriber_from_this_group_done(res){
    console.log(res);
    load_groups_subscriber_list();
}

function delete_selected_subscribers(type){
    var all = $("#subscriber_list :checkbox");
    var selected_array = [];
    for(var i=0; i<all.length; i++){
        if($(all[i])[0].checked == true){
            selected_array.push($(all[i])[0].value);
        }
    }
    if(selected_array.length > 0){
        var data = 'ids=' +  encodeURIComponent(JSON.stringify(selected_array));
        http_post_request( base + '/processor/?process=delete_selected_subscribers', data , 'delete_this_subscriber_done' );
    }
}
function delete_selected_subscribers_from_this_group(type,group_id){
    var all = $("#subscriber_list :checkbox");
    var selected_array = [];
    for(var i=0; i<all.length; i++){
        if($(all[i])[0].checked == true){
            selected_array.push($(all[i])[0].value);
        }
    }
    if(selected_array.length > 0){
        var data = 'ids=' +  encodeURIComponent(JSON.stringify(selected_array));
        data += '&group_id=' +  encodeURIComponent(group_id);
        http_post_request( base + '/processor/?process=delete_selected_subscribers_from_this_group', data , 'delete_this_subscriber_from_this_group_done' );
    }
}

function add_this_subscriber_group(){
    var group_name = $("#input_group_name")[0].value;
    if(group_name == ""){
        alert("Please give group name");
        return;
    }
    var data = 'group_name=' +  encodeURIComponent(group_name);
    http_post_request( base + '/processor/?process=add_this_subscriber_group', data , 'add_this_subscriber_group_done' );
}

function add_this_subscriber_group_done(res){
    load_subscriber_groups_list();
    
    $("#create_groups .close").click();
}

function delete_this_subscriber_group(){
    var id = $("#group_id")[0].value;
    var data = 'id=' +  encodeURIComponent(id);
    http_post_request( base + '/processor/?process=delete_this_subscriber_group', data , 'delete_this_subscriber_group_done' );
}

function delete_this_subscriber_group_done(res){
    window.location.href = base+"/subscribers";
}

function load_subscriber_groups_list(){
    var data = "";
    http_post_request( base + '/processor/?process=load_subscriber_groups_list' ,data, 'load_subscriber_groups_list_done' );
}

function load_subscriber_groups_list_done(res){
    $("#groups_list")[0].innerHTML = res;
    load_subscriber_list();
}
function show_group_list_modal_for_add_sibscriber(){
    var all = $("#subscriber_list :checkbox");
    var selected = false;
    for(var i=0; i<all.length; i++){
        if($(all[i])[0].checked == true){
             selected = true;
        }
    }
    if(selected == true){
        gen_select_group_list();
        $('#group_list_modal_for_add_sibscriber').modal('show'); 
    }else{
        alert("Please select a subsciber");
    }
    
}

function add_this_subscriber_to_a_group(){
    if($("#selected_group_list")[0].value == ""){
        alert("Please select a valid subscriber list");
        return;
    }
    var all = $("#subscriber_list :checkbox");
    var selected_array = [];
    for(var i=0; i<all.length; i++){
        if($(all[i])[0].checked == true){
            selected_array.push($(all[i])[0].value);
        }
    }
    if(selected_array.length > 0){
        var data = 'ids=' +  encodeURIComponent(JSON.stringify(selected_array));
        data += '&group_id=' +  encodeURIComponent($("#selected_group_list")[0].value);
        http_post_request( base + '/processor/?process=add_this_subscriber_to_a_group', data , 'add_this_subscriber_to_a_group_done' );
    }
}
function add_this_subscriber_to_a_group_done(res){
    if($("#group_id").length > 0){
        load_groups_subscriber_list();
    }

    if($("#groups_list").length > 0){
        load_subscriber_groups_list();
    }
}
function load_groups_subscriber_list(){
    var data = "group_id="+$("#group_id")[0].value;
    http_post_request( base + '/processor/?process=load_groups_subscriber_list' ,data, 'load_groups_subscriber_list_done' );
}

function load_groups_subscriber_list_done(res){
    $("#subscriber_list")[0].innerHTML = res;
}

function add_custom_variable_field() {
    var html = '<div><div class="input-group mb-2 mr-sm-2 mb-sm-0">';
    html += '<div class="input-group-addon">{{</div>';
    html += '<input type="text" class="form-control" id="inlineFormInputGroup" placeholder="any_thing">';
    html += '<div class="input-group-addon">}}</div>';
    html += '</div>';
    html += '<span> => </span>';
    html += '<input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0" id="inlineFormInput" placeholder="Some thing" >';
    html += '<button type="button" class="btn btn-danger btn-circle" onclick="$(this).parent().remove();" title="Delete custom field"><i class="fa fa-times"></i></button></div>';
    
    $("#save_custom_variable").append(html);

}

function save_custom_variables() {
    var input = $("#save_custom_variable :input[type=text]");
    var custom_arr = {};
    for(var i=0; i< input.length; i++){
        var value = input[i].value.trim();
        if( value == ""){
            alert("Please insert a value");
            return;
        }else{
            if(i%2 == 0){
                value = value.replaceAll(" ", "_");
                custom_arr[value] = "";
            }else{
                var prev_value = (input[i-1].value.trim()).replaceAll(" ", "_");
                custom_arr[prev_value] = value;
            }
        }
    }

    var data = 'id=' +  encodeURIComponent($("#subscriber_id")[0].value);
    data += '&custom_arr=' +  encodeURIComponent(JSON.stringify(custom_arr));
    http_post_request( base + '/edit_subscriber/?process=save_custom_variables', data , 'save_custom_variables_done' );
}

function save_custom_variables_done(res){
    console.log(res);
    if(res == 1){
        window.location.href = base+"/edit_subscriber/?id="+$("#subscriber_id")[0].value;
    }
}


//stats start
function load_dashboard_details(){
    var data = '';
    http_post_request( base + '/stats/?process=load_dashboard_details', data , 'load_dashboard_details_done' );
}

function load_dashboard_details_done(res){
    // console.log(res);
    $("#dashboard_details")[0].innerHTML = res;
    if($("#device_details").length > 0){
        var start_date = $('#start_date').val();
        var end_date = $('#end_date').val();
        var data = 'start_date='+encodeURIComponent(start_date);
        data += '&end_date='+encodeURIComponent(end_date);
        http_post_request( base + '/stats/?process=load_device_details', data , 'load_device_details_done' );
    }
}

function load_device_details_done(res){
    var data_arr = JSON.parse(res); 
    // console.log(data['country'].length); return;
    if (res == "null") {
        $("#device_details")[0].innerHTML = "0 device";
        $("#country_details")[0].innerHTML = "0 country";
        $("#browser_details")[0].innerHTML = "0 browser";
        return;
    }
    if(data_arr['device'].length > 0 ){
        var data = data_arr['device'];
        $("#device_details")[0].innerHTML = "";
        Morris.Donut({
            element: 'device_details',
            data: data,
            resize: true
        });
    } 
    if(data_arr['country'].length > 0 ){
        var data = data_arr['country'];
        $("#country_details")[0].innerHTML = "";
        Morris.Donut({
            element: 'country_details',
            data: data,
            resize: true
        });
    } 
    if(data_arr['browser'].length > 0 ){
        var data = data_arr['browser'];
        $("#browser_details")[0].innerHTML = "";
        Morris.Donut({
            element: 'browser_details',
            data: data,
            resize: true
        });
    }
}


//trash start
function load_trash_email_and_page_list(){
    var data = '';
    http_post_request( base + '/processor/?process=load_trash_email_and_page_list', data , 'load_trash_email_and_page_list_done' );
}
function load_trash_email_and_page_list_done(res){
    $("#trash_email_and_page_list")[0].innerHTML = res;
}
function delete_this_trash_page(id,me){
    var data = 'id=' +  id;
    http_post_request( base + '/processor/?process=delete_this_trash_page', data , 'delete_this_trash_page_done' );
}
function delete_this_trash_page_done(res){
    if(res == "fail"){
        alert("New page creation fail. Your max limit crossed. Please upgrade your plan. Or delete a page and create new.");
    }else{
        load_trash_email_and_page_list();
    }
}

//email sending stats
function load_email_sending_details(){
    var data = '';
    http_post_request( base + '/stats/?process=load_email_sending_details', data , 'load_email_sending_details_done' );
}
function load_email_sending_details_done(res){
    $("#sending_details")[0].innerHTML = res;
}
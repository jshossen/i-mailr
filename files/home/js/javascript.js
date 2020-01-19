$(document).ready(function() {
    $('.funny_text').funnyText({
        speed: 700,
        borderColor: 'black',
        activeColor: 'red',
        color: 'black',
        direction: 'both'
    });

    if($(".total_email_process").length > 0 ){
        load_total_email_process();
    }
});

function load_total_email_process(){
    var data = "";
    http_post_request( base + '/processor/?process=total_email_process' ,data, 'load_total_email_process_done' );
    
}

function load_total_email_process_done(res){
    $('.total_email_process').animateNumber(
      {
        number: res,
        color: 'green',
        easing: 'easeInQuad'
      },
      3500
    );
}

function check_sign_up() {
    document.getElementById("name_msg").innerHTML = "";
    document.getElementById("email_msg").innerHTML = "";
    document.getElementById("pass_msg").innerHTML = "";
    var name = $('#name').val();
    name = name.trim();
    name = name.replace(/\s\s+/g, ' ');
    if (name == "") {
        document.getElementById("name_msg").innerHTML = "Please enter valid name.";
        return false;
    }
    
    var email = $('#email').val();
    if(!validateEmail(email)) {
        document.getElementById("email_msg").innerHTML = "Enter a valid mail.";
        return false;
    }

    var password = $('#password').val();
    var password_confirm = $('#password_confirm').val();

    if (password != password_confirm) {
        document.getElementById("pass_msg").innerHTML = "Password is not match.";
        return false;
    }
    return true;
}

function getFbUserData(){
    FB.api('/me', {locale: 'en_US', fields: 'id,first_name,last_name,email,link,gender,locale,picture.width(500).height(500)'},
    function (response) {
        var email = response.email;

        var user_details = {};
        user_details["name"] = response.first_name +" "+response.last_name;
        user_details["image"] = response.picture.data.url;
        var data='id='+response.id;
        data+='&user_details='+encodeURIComponent(JSON.stringify(user_details));
        data+='&email='+encodeURIComponent(email);
        http_post_request( base + '/sign_up/?process=add_facebook_user',data,'add_facebook_user_success');
    });
}

function add_facebook_user_success(res) {
    if (res == "true") {
        window.location.href=base+'/dashboard';
    }else {
        window.location.href=base+'/sign_up/?error=email';
    }
}

function Login_with_facebook(){
    FB.login(function (response) {
        if (response.authResponse) {
            // Get and display the user profile data
            getFbUserData();
        } else {
            console.log('User cancelled login or did not fully authorize.');
        }
    }, {scope: 'email'});
}















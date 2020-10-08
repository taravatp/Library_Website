$(function() {

    $("#fname_error_message").hide();
    $("#lname_error_message").hide();
    $("#nationalID_error_message").hide();
    $("#phone_error_message").hide();
    $("#username_error_message").hide();
    $("#password_error_message").hide();
    $("#confirm_error_message").hide();
    $("#image_error_message").hide();

    var error_fname = false;
    var error_lname = false;
    var error_nationalID = false;
    var error_phone = false;
    var error_username = false;
    var error_password = false;
    var error_confirm = false;
    var error_image = false;

    $("#fname").focusout(function() {

        check_fname();

    });

    $("#lname").focusout(function() {

        check_lname();

    });

    $("#nationalID").focusout(function() {

        check_nationalID();

    });

    $("#phone").focusout(function() {

        check_phone();

    });

    $("#username").focusout(function() {

        check_username();

    });

    $("#password").focusout(function() {

        check_password();

    });

    $("#confirm").focusout(function() {

        check_confirm();

    });

    $("#image").focusout(function() {

        check_image();

    });


    function check_fname(){
        var fname_length = $("#fname").val().length;

        if(fname_length < 5 || fname_length > 20) {
            $("#fname_error_message").html("نام باید بین 5 تا 15 کاراکتر باشد.");
            $("#fname_error_message").show();
            error_fname = true;
        } else {
            $("#fname_error_message").hide();
        }

    }

    function check_lname() {
        var lname_length = $("#lname").val().length;

        if(lname_length < 5 || lname_length > 20) {
            $("#lname_error_message").html("نام خانوادگی باید بین 5 تا 15 کاراکتر باشد.");
            $("#lname_error_message").show();
            error_lname = true;
        } else {
            $("#lname_error_message").hide();
        }

    }

    function check_nationalID(){
        var nationalID_length = $("#nationalID").val().toString().length;
        if(nationalID_length != 10 ) {
            $("#nationalID_error_message").html("کد ملی باید 10 کاراکتر باشد.");
            $("#nationalID_error_message").show();
            error_nationalID = true;
        } else {
            $("#nationalID_error_message").hide();
        }
    }

    function check_phone() {
        var phone_length=$("#phone").val().toString().length;
        var phone_begin=$("#phone").val().toString().substr(0,2);

        if((phone_begin != "09" || phone_length!=11) && phone_length!=0){
            $("#phone_error_message").html("شماره همراه وارد شده نا معتبر است.")
            $("#phone_error_message").show();
        }

        if (phone_length==0)
        {
            $("#phone_error_message").html("شماره همراه را وارد کنید.")
            $("#phone_error_message").show();
        }

    }

    function check_username() {
        var username_length = $("#username").val().length;

        if(username_length < 5 || username_length > 20) {
            $("#username_error_message").html("نام کاربری باید بین 5 تا 15 کاراکتر باشد.");
            $("#username_error_message").show();
            error_username = true;
        } else {
            $("#username_error_message").hide();
        }

    }

    function check_password() {

        var password_length = $("#password").val().length;

        if(password_length < 8) {
            $("#password_error_message").html("پسورد باید حداقل 8 کاراکتر باشد.");
            $("#password_error_message").show();
            error_password = true;
        } else {
            $("#password_error_message").hide();
        }

    }

    function check_confirm() {

        var password = $("#password").val();
        var confirm = $("#confirm").val();
        if(password !=  confirm) {
            $("#confirm_error_message").html("پسورد وارد شده مطابقت ندارد.");
            $("#confirm_error_message").show();
            error_confirm = true;
        } else {
            $("#confirm_error_message").hide();
        }

    }


    function check_image(){

    }

    $("#registration_form").submit(function() {

        error_fname = false;
        error_lname = false;
        error_nationalID = false;
        error_phone = false;
        error_username = false;
        error_password = false;
        error_confirm = false;
        error_image = false;

        check_fname();
        check_lname();
        check_nationalID();
        check_phone();
        check_username();
        check_password()
        check_confirm();
        check_image();


        if(error_fname == false && error_lname == false && error_nationalID == false && error_phone == false
        && error_username == false && error_password == false && error_confirm == false && error_image == false) {
            return true;
        } else {
            return false;
        }

    });

    $("#form_edit").submit(function() {

        error_fname = false;
        error_lname = false;
        error_nationalID = false;
        error_phone = false;
        error_username = false;
        error_image = false;

        check_fname();
        check_lname();
        check_nationalID();
        check_phone();
        check_username();
        check_image();


        if(error_fname == false && error_lname == false && error_nationalID == false && error_phone == false
            && error_username == false && error_image == false) {
            return true;
        } else {
            return false;
        }

    });

});
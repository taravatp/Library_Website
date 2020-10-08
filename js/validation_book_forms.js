$(function() {

    $("#code_error_message").hide();
    $("#name_error_message").hide();
    $("#author_error_message").hide();
    $("#price_error_message").hide();
    $("#publisher_error_message").hide();
    $("#year_error_message").hide();
    $("#coverType_error_message").hide();
    $("#paperType_error_message").hide();
    $("#numberOfPages_error_message").hide();
    $("#textColor_error_message").hide();
    $("#image_error_message").hide();

    var error_code = false;
    var error_name = false;
    var error_author = false;
    var error_price = false;
    var error_publisher = false;
    var error_year = false;
    var error_coverType = false;
    var error_paperType = false;
    var error_numberOfPages = false;
    var error_textColor = false;
    var error_image = false;

    $("#code").focusout(function() {

        check_code();

    });

    $("#name").focusout(function() {

        check_name();

    });

    $("#author").focusout(function() {

        check_author();

    });

    $("#price").focusout(function() {

        check_price();

    });

    $("#publisher").focusout(function() {

        check_publisher();

    });

    $("#year").focusout(function() {

        check_year();

    });

    $("#coverType").focusout(function() {

        check_coverType();

    });

    $("#paperType").focusout(function() {

        check_paperType();

    });

    $("#numberOfPages").focusout(function() {

        check_numberOfPages();

    });

    $("#textColor").focusout(function() {

        check_textColor();

    });

    $("#image").focusout(function() {

        check_image();

    });

    function check_code(){
        var code_length = $("#code").val().toString().length;

        if(code_length == 0)
        {
            $("#code_error_message").html("کد  را وارد کنید.");
            $("#code_error_message").show();
            error_code = true;
        }
        else {
            $("#code_error_message").hide();
        }
    }

    function check_name(){
        var name_length = $("#name").val().length;

        if(name_length == 0)
        {
            $("#name_error_message").html("نام کتاب را وارد کنید.");
            $("#name_error_message").show();
            error_name = true;
        }
        else if(name_length>40) {
            $("#name_error_message").html("نام وارد شده طولانی است.");
            $("#name_error_message").show();
            error_name = true;
        } else {
            $("#name_error_message").hide();
        }
    }

    function check_author(){
        var author_length = $("#author").val().length;

        if(author_length == 0)
        {
            $("#author_error_message").html("نام نویسنده را وارد کنید.");
            $("#author_error_message").show();
            error_author = true;
        }
        else if(author_length>40) {
            $("#author_error_message").html("نام وارد شده طولانی است.");
            $("#author_error_message").show();
            error_author = true;
        } else {
            $("#author_error_message").hide();
        }
    }

    function  check_price() {
        var price_length = $("#price").val().toString().length;

        if(price_length == 0)
        {
            $("#price_error_message").html("قیمت را وارد کنید.");
            $("#price_error_message").show();
            error_price = true;
        }
        else {
            $("#price_error_message").hide();
        }
    }

    function check_publisher() {
        var publisher_length = $("#publisher").val().length;

        if(publisher_length == 0)
        {
            $("#publisher_error_message").html("نام انتشارات را وارد کنید.");
            $("#publisher_error_message").show();
            error_publisher = true;
        }
        else if(publisher_length>40) {
            $("#publisher_error_message").html("نام وارد شده طولانی است.");
            $("#publisher_error_message").show();
            error_publisher = true;
        } else {
            $("#publisher_error_message").hide();
        }
    }

    function check_year() {
        var year_length = $("#year").val().toString().length;

        if(year_length != 4)
        {
            $("#year_error_message").html("سال وارد شده نادرست است.");
            $("#year_error_message").show();
            error_year = true;
        }
        else {
            $("#year_error_message").hide();
        }
    }

    function check_numberOfPages(){
        var num_length = $("#numberOfPages").val().toString().length;
        if(num_length == 0)
        {
            $("#numberOfPages_error_message").html("تعداد صفحات را وارد کنید.");
            $("#numberOfPages_error_message").show();
            error_numberOfPages = true;
        }
        else {
            $("#numberOfPages_error_message").hide();
        }
    }

    function check_image(){

    }

    $("#form_book").submit(function() {

        error_code = false;
        error_name = false;
        error_author = false;
        error_price = false;
        error_publisher = false;
        error_year = false;
        error_coverType = false;
        error_paperType = false;
        error_numberOfPages = false;
        error_textColor = false;
        error_image = false;

        check_code();
        check_name();
        check_author();
        check_price();
        check_publisher();
        check_year();
        check_numberOfPages();
        check_image();

        if( error_code == false && error_name==false && error_author==false && error_price==false && error_publisher==false
        && error_year==false && error_coverType==false && error_paperType==false && error_numberOfPages==false && error_textColor==false
        && error_image==false){
            return true;
        }
        else{
            return false;
        }


    });


});
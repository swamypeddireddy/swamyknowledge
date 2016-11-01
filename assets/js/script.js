$(document).ready(function () {


    /*$(".button").click(function () {
     
     setTimeout(function () {
     
     alert('clicked');
     window.location = "user.html";
     }, 500);
     
     });*/

    // counter function starts

    $('.count').each(function () {
        $(this).prop('Counter', 0).animate({
            Counter: $(this).text()
        }, {
            duration: 4000,
            easing: 'swing',
            step: function (now) {
                $(this).text(Math.ceil(now));
            }
        });
    });

    // counter function ends

    $("option").click(function () {

        setTimeout(function () {
            if ('' !== $('#firstname').val() && '' !== $('#email').val() && '' !== $('#password').val()) {
                $('.info, .success, .warning, .error').css('display', 'none');
                $('.messages').css('display', 'none');
                $('.warning').css('display', 'none');
            } else {
                $('.info, .success, .warning, .error').css('display', 'none');
                $('.messages').css('display', 'block');
                $('.warning').css('display', 'block');
                document.getElementById('MSG_WARNING').innerHTML = "<b>Please Enter details for all Username, Email and Password</b>";
            }
            //window.location.href = "register/";
        }, 500);
    });

    $("#file").change(function () {
        alert('alert');
        $("#filename").value = $("#file").value;
    });

    $(".prf_select").hide();

    $(".ask_input_i").focus(function () {
        setTimeout(function () {

            $(".prf_select").show();
        }, 1500);

    });

    $(".prf_select_give").hide();

    $(".ask_input_give").focus(function () {
        setTimeout(function () {

            $(".prf_select_give").show();
        }, 1500);

    });


    $(".khub_search").click(function () {

        setTimeout(function () {

            window.location = "khub.html";
        }, 500);

    });


// Knowldge Hub page tabs s

    $(function () {
        $('ul.tabs li:first').addClass('active');
        $('.block article').hide();
        $('.block article:first').show();
        $('ul.tabs li').on('click', function () {
            $('ul.tabs li').removeClass('active');
            $(this).addClass('active');
            $('.block article').hide();
            var activeTab = $(this).find('a').attr('href');
            $(activeTab).show();
            return false;
        });
    });

// Knowldge Hub page tabs s

    $("#profile_ask").hide();

    $("#prf_input_ask").click(function () {

        $("#profile_ask").slideToggle();

    });


    $("#profile_give").hide();

    $("#prf_input_give").click(function () {

        $("#profile_give").slideToggle();

    });


    $(".up_option").hide();

    $(".a_up").click(function () {

        $(".up_option").slideToggle();

    });


    /* Mentor Popup Starts */

$(".mentor_popup_show").hover(function(){
  setTimeout(function(){
    $(".mentor_popup").show()}, 300);
});

$(".mentor_popup_close").click(function(){
  $(".mentor_popup").hide();
});

$("body").click(function(){
  $(".mentor_popup").hide();
});

/* Mentor Popup Ends */

/* User login start */
$(".user_login_li").mouseover(function(){
  $(".user_login_ul li ul").show();
});

$(".user_login_li").mouseleave(function(){
  $(".user_login_ul li ul").hide();
});


/* user login ends */

/* Responsive Menu Starts */
  if($(window).width() < 769){
   
    $('.nav_fade ul').hide();
    $('a.nav_btn').show();
  }
  else if($(window).width() > 768){
    $('.nav_fade ul').show();
    $('a.nav_btn').hide();
  } 



  $('.nav_btn').click(function(){

    $('.nav_fade ul').fadeToggle(500);
  });
  
  $(window).resize(function(){
    if($(window).width() < 769){
    $('.nav_fade ul').hide();
    $('a.nav_btn').show();
  }
  else if($(window).width() > 768){
    $('.nav_fade ul').show();
    $('a.nav_btn').hide();
  }
  });
/* Responsive Menu Ends */

});

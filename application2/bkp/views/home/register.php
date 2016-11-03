<section>
<div class="bg_section">
<div class="main">

    <?php if(isset($Error) && $Error != '') { ?>
        <div class="messagesphp">
            <!--<div class="infophp" id="INFO"></div>
            <div class="successphp" id="SUCCESS"><?php //echo $Success;?></div>-->
            <!--<div class="warningphp" id="WARNING"></div>-->
            <div class="errorphp" id="ERROR"><?php echo $Error;?></div>
        </div>
    <?php } ?>
        <div class="reg-home">
            <div class="reg-home-inner">

<div class="social_login">
<ul>
<li class="fb"><i class="fa fa-facebook" aria-hidden="true"></i></li>
<li class="tw"><i class="fa fa-twitter" aria-hidden="true"></i></li>
<li class="lin"><i class="fa fa-linkedin" aria-hidden="true"></i></li>
<li class="goog"><i class="fa fa-google-plus" aria-hidden="true"></i></li>
</ul>
</div>


<!-- <div class="social_login">
<span class="social_facebook"><i class="fa fa-facebook" aria-hidden="true"></i></span>
<span class="social_twitter"><i class="fa fa-twitter" aria-hidden="true"></i></span>
<span class="social_linkedin"><i class="fa fa-linkedin" aria-hidden="true"></i></span>
<span class="social_google"><i class="fa fa-google-plus" aria-hidden="true"></i></span>
</div> -->

                <form method="POST" enctype="multipart/form-data">
                    <div class="firstname"><input id="firstname" value="" type="text" name="firstname" placeholder="Enter your user name" required></div>
                    <div class="firstname"><input id="email" value="" type="email" name="email" placeholder="Enter your Email" required></div>
                    <div class="div_MSG_Email_ERROR"><br><div id="MSG_Email_ERROR"></div></div>
                    <div class="firstname"><input id="password" value="" type="password" name="password" placeholder="Enter your user password" required></div>
                    <div class="div_MSG_Password_ERROR"><br><div id="MSG_Password_ERROR"></div></div>
                    <div class="firstname"><input id="repassword" value="" type="password" name="password" placeholder="Re-enter your user password" required></div>
                    <div class="div_MSG_Passwordchk_ERROR"><br><div id="MSG_Passwordchk_ERROR"></div></div>
                    <div class="firstname">
                        <select>
                            <option>Choose as a ....</option>
                            <option>Member</option>
                            <option>Startups</option>
                            <option>Startups</option>
                        </select>
                    </div>
                    <div class="firstname"><input type="file" name="userfile" value="" required></div>
                    <div class="btn_login"><button type="submit" name="" value="" formaction="<?php echo base_url('index.php/User/register/'); ?>">Signup</button></div>
                    <div class="al_login">Already registred, please 
                        <a href="index.html">Login</a> here.
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

<style>
    #MSG_Passwordchk_ERROR #MSG_Email_ERROR #MSG_Password_ERROR {
        display:none;
    }
</Style>

<script>
    $(".submit").click(function () {

        setTimeout(function () {

            alert('clicked');
            window.location = "<?php echo base_url('User/register'); ?>";
        }, 500);

    });

    $("#email").focusout(function() {
        
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#email").val())) {
            
            document.getElementById('MSG_Email_ERROR').innerHTML = "";
            return (true);
        } else {
            $('.div_MSG_Email_ERROR').attr('class', 'firstname');
            $('#MSG_Email_ERROR').css('color', 'DarkRed');
            document.getElementById('MSG_Email_ERROR').innerHTML = "<b>You have entered an invalid email address!</b>";
        }
    });
    
    $("#password").focusout(function () {

        if (''  == $('#password').val()) {
            //$('.info, .success, .warning, .error').css('display', 'none');
            //$('.messages').css('display', 'block');
            //$('.error').css('display', 'block');
            $('.div_MSG_Password_ERROR').attr('class', 'firstname');
            $('#MSG_Password_ERROR').css('color', 'DarkYellow');
            document.getElementById('MSG_Password_ERROR').innerHTML = "<b>Password can not be Empty</b>";
        } else {
            $('#MSG_Password_ERROR').remove();
            //$('.div_MSG_Password_ERROR').remove();
            //$( "div" ).remove( ".div_MSG_Password_ERROR" );
        }
    });    

    $("#repassword").focusout(function () {

        if (''  == $('#password').val() && ''   ==  $('#repassword').val()) {
            //$('.info, .success, .warning, .error').css('display', 'none');
            //$('.messages').css('display', 'block');
            //$('.error').css('display', 'block');
            $('.div_MSG_Passwordchk_ERROR').attr('class', 'firstname');
            $('#MSG_Passwordchk_ERROR').css('color', 'DarkYellow');
            document.getElementById('MSG_Passwordchk_ERROR').innerHTML = "<b>Confirm Password can not be Empty</b>";
        } else if ($('#password').val() !== $('#repassword').val()) {
            //$('.info, .success, .warning, .error').css('display', 'none');
            //$('.messages').css('display', 'block');
            //$('.error').css('display', 'block');
            $('.div_MSG_Passwordchk_ERROR').attr('class', 'firstname');
            $('#MSG_Passwordchk_ERROR').css('color', 'DarkRed');
            document.getElementById('MSG_Passwordchk_ERROR').innerHTML = "<b>Password does not match</b>";
        } else {
            //$('.info, .success, .warning, .error').css('display', 'none');
            //$('.messages').css('display', 'block');
            //$('.success').css('display', 'block');
            $('.div_MSG_Passwordchk_ERROR').attr('class', 'firstname');
            $('#MSG_Passwordchk_ERROR').css('color', 'Green');
            document.getElementById('MSG_Passwordchk_ERROR').innerHTML = "<b>Password match Successful</b>";
        }
    });
</script>

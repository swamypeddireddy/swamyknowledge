    <?php if(isset($Success) && $Success != '') { ?>
        <div class="messagesphp">
            <!--<div class="infophp" id="INFO"></div>-->
            <div class="successphp" id="SUCCESS"><?php echo $Success;?></div>
            <!--<div class="warningphp" id="WARNING"></div>
            <div class="errorphp" id="ERROR"></div>-->
        </div>
    <?php } ?>

    <div class="bg_section">

        <div class="main container">
            <div class="login-home row">

                <div class="login_left">
                    <div class="social_login">
                        <ul>
<!--                            <li class="fb"><a href="<?php echo base_url();?>hauth/login/Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>-->
                            <li class="fb" onlogin="checkLoginState();"><i class="fa fa-facebook" aria-hidden="true"></i></li>
                            <li class="tw"><a href="<?php echo base_url();?>hauth/login/Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li> 
                            <li class="lin"><a href="<?php echo base_url();?>hauth/login/LinkedIn"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
<!--                            <li class="lin"><i class="fa fa-linkedin" aria-hidden="true"></i></li>-->
                            <li class="goog"><a href="<?php echo base_url();?>hauth/login/Google"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                            
<!--                            <a href="<?php //echo base_url();?>index.php/hauth/login/Twitter"><li class="tw"><i class="fa fa-twitter" aria-hidden="true"></i></li></a>
                            <a href="<?php //echo base_url();?>index.php/hauth/login/Facebook"><li class="fb"><i class="fa fa-facebook" aria-hidden="true"></i></li></a>
                            <a href="<?php //echo base_url();?>index.php/hauth/login/LinkedIn"><li class="lin"><i class="fa fa-linkedin" aria-hidden="true"></i></li></a>
                            <li class="goog"><i class="fa fa-google-plus" aria-hidden="true"></i></li>-->
                        </ul>
                    </div>

                    <form method="POST">

                        <div class="firstname"><input type="text" id="email" name="email_id" placeholder="Enter your email id" required></div>
                        <div class="div_MSG_Email_ERROR"><br><div id="MSG_Email_ERROR"></div></div>
                        
                        <div class="firstname"><input type="password" name="password" placeholder="Enter your user password" required></div>
                        <div class="btn_login"><button type="submit" name="" value="" formaction="<?php echo base_url('index.php/User/index');?>">Login</button></div>
                        
                        <div class="forgot"><a href="<?php echo base_url('index.php/User/forgotPassword');?>">Lost your Password?</a></div>
                        <div class="register"><a href="<?php echo base_url('index.php/User/register');?>">Signup Here</a></div>
                    </form>
                </div>

                <div class="home_counter col-lg-1">
                    <div class="head-count-center">
                        <div id="talkbubble"><span class="count">5000000</span> <span class="count_txt">Total Members</span></div>
                        <div id="talkbubble"><span class="count">100000</span> <span class="count_txt">Business Done USD</span></div>
                        <div id="talkbubble"><span class="count">1000000</span> <span class="count_txt">Opportunities Passed</span></div>
                    </div>
                </div>

            </div>
        </div>

    </div>
</section>

<script src="<?php echo base_url('/assets/'); ?>js/social_media_login.js"></script>
<script>
    $("#email").focusout(function () {
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#email").val())) {
            
            //check if email address already exists or not.
            $.ajax({

                method: "POST",
                dataType: "JSON",
                url: "<?php echo base_url('user/checkEmailAddressExists');?>",
                data: { email: $("#email").val()}
            }).done(function( msg ) {
                if(1    == msg) {

                    $('.div_MSG_Email_ERROR').attr('class', 'firstname');
                    $('#MSG_Email_ERROR').css('color', '#193300');
                    document.getElementById('MSG_Email_ERROR').innerHTML = "Congracts, User Exists!";
                    return (true);
                } else if(0    == msg) {

                    $('.div_MSG_Email_ERROR').attr('class', 'firstname');
                    $('#MSG_Email_ERROR').css('color', 'DarkRed');
                    document.getElementById('MSG_Email_ERROR').innerHTML = "Invalid User! email id does not exists.";
                    return (true);
                }
            });
        } else if('' == $("#email").val()) {
            
            $('.div_MSG_Email_ERROR').attr('class', 'firstname');
            $('#MSG_Email_ERROR').css('color', 'DarkRed');
            document.getElementById('MSG_Email_ERROR').innerHTML = "Email address can not be Empty!";
        } else {

            $('.div_MSG_Email_ERROR').attr('class', 'firstname');
            $('#MSG_Email_ERROR').css('color', 'DarkRed');
            document.getElementById('MSG_Email_ERROR').innerHTML = "You have entered an invalid email address!";
        }
    });
</script>

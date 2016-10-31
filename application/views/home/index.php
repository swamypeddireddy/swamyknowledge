<section>
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
                            <li class="fb" onlogin="checkLoginState();"><i class="fa fa-facebook" aria-hidden="true"></i></li>
                            <li class="tw"><i class="fa fa-twitter" aria-hidden="true"></i></li>
                            <li class="lin"><i class="fa fa-linkedin" aria-hidden="true"></i></li>
                            <li class="goog"><i class="fa fa-google-plus" aria-hidden="true"></i></li>
                            
<!--                            <a href="<?php echo base_url();?>index.php/hauth/login/Twitter"><li class="tw"><i class="fa fa-twitter" aria-hidden="true"></i></li></a>
                            <a href="<?php echo base_url();?>index.php/hauth/login/Facebook"><li class="fb"><i class="fa fa-facebook" aria-hidden="true"></i></li></a>
                            <a href="<?php echo base_url();?>index.php/hauth/login/LinkedIn"><li class="lin"><i class="fa fa-linkedin" aria-hidden="true"></i></li></a>
                            <li class="goog"><i class="fa fa-google-plus" aria-hidden="true"></i></li>-->
                        </ul>
                    </div>

                    <form method="POST">
                        
                        <div class="firstname"><input type="text" name="firstname" placeholder="Enter your user name" required></div>
                        <div class="firstname"><input type="password" name="password" placeholder="Enter your user password" required></div>
                        <div class="btn_login"><button type="submit" name="" value="" formaction="<?php echo base_url('index.php/User/index');?>">Login</button></div>
                        
                        <div class="forgot"><a href="javascript:void(0);">Lost your Password?</a></div>
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

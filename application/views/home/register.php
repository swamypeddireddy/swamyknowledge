<section>
    <div class="bg_section">
        <div class="main">

            <?php if (isset($Error) && $Error != '') { ?>
                <div class="messagesphp">
                    <!--<div class="infophp" id="INFO"></div>
                    <div class="successphp" id="SUCCESS"><?php //echo $Success;  ?></div>-->
                    <!--<div class="warningphp" id="WARNING"></div>-->
                    <div class="errorphp" id="ERROR"><?php echo $Error; ?></div>
                </div>
            <?php } ?>

            <div class="reg-home">
                <div class="reg-home-inner">

                    <div class="social_login">
                        <ul>
                            <li class="fb"><a href="<?php echo base_url();?>index.php/hauth/login/Facebook"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                            <li class="tw"><a href="<?php echo base_url();?>index.php/hauth/login/Twitter"><i class="fa fa-twitter" aria-hidden="true"></i></a></li> 
                            <li class="lin"><a href="<?php echo base_url();?>index.php/hauth/login/LinkedIn"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
<!--                            <li class="goog"><i class="fa fa-google-plus" aria-hidden="true"></i></li>-->
                        </ul>
                    </div>

                    <form method="POST" id="register" enctype="multipart/form-data">
                        <div class="firstname"><input id="firstname" value="" type="text" name="firstname" placeholder="Enter your user name" required></div>

                        <div class="firstname"><input id="email" value="" type="email" name="email" placeholder="Enter your Email" required></div>
                        <div class="div_MSG_Email_ERROR"><br><div id="MSG_Email_ERROR"></div></div>

                        <div class="firstname"><input id="password" value="" type="password" name="password" placeholder="Enter your user password" required></div>
                        <div class="div_MSG_Password_ERROR"><br><div id="MSG_Password_ERROR"></div></div>
                        <div class="div_MSG_Pass_ERROR"><br><div id="MSG_Pass_ERROR"></div></div>

                        <div class="firstname"><input id="repassword" value="" type="password" name="password" placeholder="Re-enter your user password" required></div>
                        <div class="div_MSG_Passwordchk_ERROR"><br><div id="MSG_Passwordchk_ERROR"></div></div>
                        
                        <div class="firstname">
                            <label class="white_label">Select Group</label>
                            <div class="div_MSG_GROUP_ERROR"><br><div id="MSG_GROUP_ERROR"></div></div>
                            <?php foreach($groups as $key => $group) {
                                if($key%2   == 0) {?>
                                    <div class="firstname_left" id="evenCategory">
                                        <span class="firstname_left_span"><input type="checkbox" value="<?php echo $group['id'];?>" class="check_box"/><?php echo $group['category_name'];?></span>                                            

                                <?php } else {?>
                                    <div class="firstname_left" id="oddCategory">
                                        <span class="firstname_left_span"><input type="checkbox" value="<?php echo $group['id'];?>" class="check_box"/><?php echo $group['category_name'];?></span>

                                <?php }?>
                                    </div>
                            <?php }?>
                            <input type="hidden" id="categories" name="categories" value=""/>
                        </div>

                        <!--                        <div class="firstname">
                            <label class="white_label">Select Group</label>
                            <div class="firstname_left">
                                <span class="firstname_left_span"><input type="checkbox" name="it_software" value="" class="check_box"/>IT Software</span>
                                <span class="firstname_left_span"><input type="checkbox" name="real_estate" value="" class="check_box"/>Real Estate</span>
                                <span class="firstname_left_span"><input type="checkbox" name="sales_and_marketing" value="" class="check_box"/>Sales & Marketing</span>
                                <span class="firstname_left_span"><input type="checkbox" name="electronics_and_electricals" value="" class="check_box"/>Electronics & Electricals</span>
                                <span class="firstname_left_span"><input type="checkbox" name="steel_constructions" value="" class="check_box"/>Steel Constructions</span>
                            </div>
                            <div class="firstname_left">
                                <span class="firstname_left_span"><input type="checkbox" name="construction_materials" value="" class="check_box"/>Manifacturing</span>
                                <span class="firstname_left_span"><input type="checkbox" name="tiles" value="" class="check_box"/>Tiles</span>
                                <span class="firstname_left_span"><input type="checkbox" name="web_developers" value="" class="check_box"/>Web Developers</span>
                                <span class="firstname_left_span"><input type="checkbox" name="clothing_business" value="" class="check_box"/>Clothing Business</span>
                                <span class="firstname_left_span"><input type="checkbox" name="steel_constructions" value="" class="check_box"/>Steel Constructions</span>
                            </div>
                        </div>-->

<!--                        <div class="firstname"><input type="file" name="userfile" value="" required></div>-->
                        <div class="btn_login"><button type="submit" name="submit" value="submit" onclick="submit();">Signup</button></div>
                        <div class="al_login">Already registred, please <a href="<?php echo base_url();?>">Login</a> here.</div>
                    </form>
                </div>
            </div>
        </div>
</section>

<style>
    #MSG_Passwordchk_ERROR #MSG_Email_ERROR #MSG_Password_ERROR #MSG_Pass_ERROR{
        display:none;
    }
</Style>

<script>
    $('#register').submit(function() {
        
        if(''   == $('#categories').val()) {

            $('.div_MSG_GROUP_ERROR').attr('class', 'firstname');
            $('#MSG_GROUP_ERROR').css('color', 'DarkRed');
            document.getElementById('MSG_GROUP_ERROR').innerHTML = "Groups can not be empty! Please check atleast one group.";
            return false;
        } else {
            formaction  = "<?php echo base_url('index.php/User/register/'); ?>"
        }
    });

    var list = [];
    $("#evenCategory .check_box, #oddCategory .check_box").each(function(index) {
        $(this).on("click", function() {

            if('-1' == $.inArray(this.value, list)) {
                list.push(this.value);
            } else {
                list.splice($.inArray(this.value, list), 1);
            }
            $('#categories').attr('value', list);
        });
    });

    $("#email").focusout(function () {
        if (/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test($("#email").val())) {

            //check if email address already exists or not.
            $.ajax({

                method: "POST",
                dataType: "JSON",
                url: "<?php echo base_url('user/checkEmailAddressExists');?>",
                data: { email: $("#email").val()}
            }).done(function( msg ) {
                if(0    == msg) {

                    $('.div_MSG_Email_ERROR').attr('class', 'firstname');
                    $('#MSG_Email_ERROR').css('color', '#193300');
                    document.getElementById('MSG_Email_ERROR').innerHTML = "Email Id Available!";
                    return (true);
                } else {

                    $('.div_MSG_Email_ERROR').attr('class', 'firstname');
                    $('#MSG_Email_ERROR').css('color', 'DarkRed');
                    document.getElementById('MSG_Email_ERROR').innerHTML = "Email Id Already Exists, Please choose another.";
                    return (true);
                }
            });
        } else {

            $('.div_MSG_Email_ERROR').attr('class', 'firstname');
            $('#MSG_Email_ERROR').css('color', 'DarkRed');
            document.getElementById('MSG_Email_ERROR').innerHTML = "You have entered an invalid email address!";
        }
    });

    $("#password").focusout(function () {

        if ('' == $('#password').val()) {
            
            $('.div_MSG_Password_ERROR').attr('class', 'firstname');
            $('#MSG_Password_ERROR').css('color', 'DarkRed');
            document.getElementById('MSG_Password_ERROR').innerHTML = "Password can not be Empty";
        } else if('5' >= $('#password').val().length || '16'  < $('#password').val().length) {
            
            $('.div_MSG_Pass_ERROR').attr('class', 'firstname');
            $('#MSG_Pass_ERROR').css('color', 'DarkRed');
            document.getElementById('MSG_Pass_ERROR').innerHTML = "Password length must be in between 6 to 16 characters.";
        } else {
            
            $('#MSG_Password_ERROR').remove();
            $('#MSG_Pass_ERROR').remove();
        }
    });

    $("#repassword").focusout(function () {

        if ('' == $('#password').val() && '' == $('#repassword').val()) {

            $('.div_MSG_Passwordchk_ERROR').attr('class', 'firstname');
            $('#MSG_Passwordchk_ERROR').css('color', 'DarkRed');
            document.getElementById('MSG_Passwordchk_ERROR').innerHTML = "Confirm Password can not be Empty";
        } else if ($('#password').val() !== $('#repassword').val()) {
            
            $('.div_MSG_Passwordchk_ERROR').attr('class', 'firstname');
            $('#MSG_Passwordchk_ERROR').css('color', 'DarkRed');
            document.getElementById('MSG_Passwordchk_ERROR').innerHTML = "Password does not match";
        } else {
            
            $('.div_MSG_Passwordchk_ERROR').attr('class', 'firstname');
            $('#MSG_Passwordchk_ERROR').css('color', '#193300');
            document.getElementById('MSG_Passwordchk_ERROR').innerHTML = "Password match Successful";
        }
    });
</script>

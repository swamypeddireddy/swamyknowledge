<section>

    <?php if (isset($Success) && $Success != '') { ?>
        <div class="messagesphp">
            <div class="successphp" id="SUCCESS"><?php echo $Success; ?></div>
        </div>
    <?php } ?>

    <?php if (isset($Info) && $Info != '') { ?>
        <div class="messagesphp">
            <div class="infophp" id="INFO"><?php echo $Info; ?></div>
            <!-- <div class="successphp" id="SUCCESS"><?php //echo $Success; ?></div>-->
            <!--<div class="warningphp" id="WARNING"></div>
            <div class="errorphp" id="ERROR"></div>-->
        </div>
    <?php } ?>

 

    <div class="user-information">
        <div class="main">


            <div class="user-search">
                <div class="mentor_search"><input type="search" name="" value="" placeholder="Mentor Search ..."/><i class="fa fa-search" aria-hidden="true"></i></div>
 
                <div class="mentor_prf">
<div class="mentor_information">
<div class="mentor_user"><span class="mentor_user_img green"><img src="images/user1.png" alt="Hemant" class="mentor_popup_show"/></span></a>
<div class="prf_sm_img">
<span class="prf_sm_img_inner"><img src="images/3.png" alt="smiely"/> <b class="num_prf">(25080)</b></span>
<span class="prf_sm_img_inner"><img src="images/1.png" alt="nutral"/> <b class="num_prf">(65822)</b></span>
<span class="prf_sm_img_inner"><img src="images/2.png" alt="sad"/> <b class="num_prf">(852369)</b></span>
</div>
<span class="mentor_txt"><a href="user-chat.html">Chat with Mentor</a></span></div>
</div>

<div class="mentor_information">
<div class="mentor_user"><a href="profile.html"><span class="mentor_user_img yellow"><img src="images/user3.jpeg" alt="Hemant" class="mentor_popup_show"/></span></a>
<div class="prf_sm_img">
<span class="prf_sm_img_inner"><img src="images/3.png" alt="smiely"/> <b class="num_prf">(25080)</b></span>
<span class="prf_sm_img_inner"><img src="images/1.png" alt="nutral"/> <b class="num_prf">(65822)</b></span>
<span class="prf_sm_img_inner"><img src="images/2.png" alt="sad"/> <b class="num_prf">(852369)</b></span>
</div>
<span class="mentor_txt"><a href="user-chat.html">Chat with Mentor</a></span></div>
</div>

<div class="mentor_information">
<div class="mentor_user"><a href="profile.html"><span class="mentor_user_img red"><img src="images/user2.jpg" alt="Hemant" class="mentor_popup_show"/></span></a>
<div class="prf_sm_img">
<span class="prf_sm_img_inner"><img src="images/3.png" alt="smiely"/> <b class="num_prf">(25080)</b></span>
<span class="prf_sm_img_inner"><img src="images/1.png" alt="nutral"/> <b class="num_prf">(65822)</b></span>
<span class="prf_sm_img_inner"><img src="images/2.png" alt="sad"/> <b class="num_prf">(852369)</b></span>
</div>
<span class="mentor_txt"><a href="user-chat.html">Chat with Mentor</a></span></div>
</div>

<div class="mentor_information">
<div class="mentor_user"><a href="profile.html"><span class="mentor_user_img black"><img src="images/org2.jpg" alt="Hemant" class="mentor_popup_show"/></span></a>
<div class="prf_sm_img">
<span class="prf_sm_img_inner"><img src="images/3.png" alt="smiely"/> <b class="num_prf">(25080)</b></span>
<span class="prf_sm_img_inner"><img src="images/1.png" alt="nutral"/> <b class="num_prf">(65822)</b></span>
<span class="prf_sm_img_inner"><img src="images/2.png" alt="sad"/> <b class="num_prf">(852369)</b></span>
</div>
<span class="mentor_txt"><a href="user-chat.html">Chat with Mentor</a></span></div>
</div>

<div class="mentor_information">
<div class="mentor_user"><a href="profile.html"><span class="mentor_user_img red"><img src="images/org4.jpg" alt="Hemant" class="mentor_popup_show"/></span></a>
<div class="prf_sm_img">
<span class="prf_sm_img_inner"><img src="images/3.png" alt="smiely"/> <b class="num_prf">(25080)</b></span>
<span class="prf_sm_img_inner"><img src="images/1.png" alt="nutral"/> <b class="num_prf">(65822)</b></span>
<span class="prf_sm_img_inner"><img src="images/2.png" alt="sad"/> <b class="num_prf">(852369)</b></span>
</div>
<span class="mentor_txt"><a href="user-chat.html">Chat with Mentor</a></span></div>
</div>

</div>
            </div>


            <div class="user-profile">
                <div class="user_prf">
                    <div class="user-profile_txt"><p><b class="font_size">Managing Director</b><br/>
                            <b style="font-size:13px; font-weight:normal;">Fiables Offshoring Services Pvt. Ltd.</b></p>
                        <p class="new_para">Global Senior Executive with 20+ years of International experience of working in Europe & America for GE, UBS, Computer science JNU Delhi, 1992 B.E, ...</div>
                    <div class="user-profile_right"><img src="images/hemant.jpg" alt="Hemant Sakarwal"/></div>
                </div>


                <div class="ask_give">

                    <div class="prf_ask">
                        <h2>Ask</h2>
                        <form method="post" action="<?php echo base_url(); ?>user/ask">
                        <div class="ask_input"><input class="ask_input_i" type="text" name="asktext" value="" placeholder="Enter your..."/></div>


                        <div class="prf_select">
                               <select id="busnasktype" name="busnasktype">
                                   <option value="0">-- Select --</option>
                                <option value="1">Public</option>
                                <option value="2">Private</option>
                                 
                            </select>
                            <select style="display:none;" id="askgroup" name="askgroup">
                                  <option value="0">-- Select --</option>
                              <?php foreach($groups as $groupsData){
                                  ?>
                                <option value="<?php echo $groupsData->id; ?>"><?php echo $groupsData->group_name; ?></option>
                           <?php   } ?>
                            </select>
             <input type="submit" class="prf_ask_btn" value="Post" name="ask" />  
                        </div>
                        <script>
                            $(function(){
                                $( "#busnasktype" ).change(function() {
  var busnasktype=$( "#busnasktype option:selected" ).val();
           if(busnasktype==0 || busnasktype==1){
               $("#askgroup").hide();
           }else{
                $("#askgroup").show();
           }
});
                            })
                        </script>
                         
                        </form>
                    </div>


                    <div class="prf_ask">
                        <h2>Give</h2>
  <form method="post" action="<?php echo base_url(); ?>user/give">
                        <div class="ask_input"><input class="ask_input_give" type="text" name="" value="givetext" placeholder="Enter your..."/></div>


                        <div class="prf_select_give">
                           <select id="busngivetype" name="busngivetype">
                                   <option value="0">-- Select --</option>
                                <option value="1">Public</option>
                                <option value="2">Private</option>
                                 
                            </select>
                            <select style="display:none;" id="givegroup" name="givegroup">
                                  <option value="0">-- Select --</option>
                              <?php foreach($groups as $groupsData){
                                  ?>
                                <option value="<?php echo $groupsData->id; ?>"><?php echo $groupsData->group_name; ?></option>
                           <?php   } ?>
                            </select>
  <input type="submit" class="prf_ask_btn" value="Post" name="give" />  
                        </div>
                           <script>
                            $(function(){
                                $( "#busngivetype" ).change(function() {
  var busngivetype=$( "#busngivetype option:selected" ).val();
           if(busngivetype==0 || busngivetype==1){
               $("#givegroup").hide();
           }else{
                $("#givegroup").show();
           }
});
                            })
                        </script>
  </form>
                    </div>

                </div>


                <div class="user_chat">
                <span class="chat_head">Chat<!-- <i class="fa fa-angle-down chat_dwn" aria-hidden="true"></i> <i class="fa fa-angle-up chat_up" aria-hidden="true"></i>--></span>
                    <div class="user_chat_inner">

                        <div class="chat_left">Senior Executive with 20+ years</div>
                        <div class="chat_right">Senior Executive with 20+ years</div>
                        <div class="chat_left">Senior Executive with 20+ years</div>
                        <div class="chat_right">Senior Executive with 20+ years</div>
                        <div class="chat_snd"><input type="text" name="" value="" placeholder="Enter your message here" title="Send"/> <span class="chat_arw"><i class="fa fa-paper-plane" aria-hidden="true"></i></span></div>
                    </div>
                </div>

            </div>




            <div class="user-discussion">
                <h2>Discussion Forum</h2>
                <div class="user_ul">
                    <ul><span></span>
                        <li><a href="javascript:void(0);">Popular</a></li>
                        <li><a href="javascript:void(0);">News</a></li>
                        <li><a href="javascript:void(0);">Top All Time</a></li>
                        <li><a href="javascript:void(0);">Active</a></li>
                    </ul>
                </div>

                <div class="discuss_user">
                    <div class="discuss_user_left">
                        <div class="discuss_user_img"><img src="<?php echo base_url('/assets/'); ?>images/user4.jpeg" alt="Hemant Sakarwal"/></div>
                        <div class="discuss_user_txt"><h3>100% of users ...</h3>
                            <p><span class="dis_num">123</span> <i class="fa fa-angle-down" aria-hidden="true" style="color:green; font-size:16px;"></i> <i class="fa fa-angle-up" aria-hidden="true" style="font-size:16px;"></i> 9 hours ago ...</p></div>
                    </div>
                    <div class="discuss_user_right"><i class="fa fa-comments" aria-hidden="true"></i> <span class="dis_cmt">239</span></div>
                </div>

                <div class="discuss_user">
                    <div class="discuss_user_left">
                        <div class="discuss_user_img"><img src="<?php echo base_url('/assets/'); ?>images/user5.jpg" alt="Hemant Sakarwal"/></div>
                        <div class="discuss_user_txt"><h3>100% of users ...</h3>
                            <p><span class="dis_num">123</span> <i class="fa fa-angle-down" aria-hidden="true"></i> <i class="fa fa-angle-up" aria-hidden="true"  style="color:green"></i> 9 hours ago ...</p></div>
                    </div>
                    <div class="discuss_user_right"><i class="fa fa-comments" aria-hidden="true"></i> <span class="dis_cmt">239</span></div>
                </div>

                <div class="discuss_user">
                    <div class="discuss_user_left">
                        <div class="discuss_user_img"><img src="<?php echo base_url('/assets/'); ?>images/user6.jpg" alt="Hemant Sakarwal"/></div>
                        <div class="discuss_user_txt"><h3>100% of users ...</h3>
                            <p><span class="dis_num">123</span> <i class="fa fa-angle-down" aria-hidden="true"></i> <i class="fa fa-angle-up" aria-hidden="true"  style="color:green"></i> 9 hours ago ...</p></div>
                    </div>
                    <div class="discuss_user_right"><i class="fa fa-comments" aria-hidden="true"></i> <span class="dis_cmt">239</span></div>
                </div>

                <div class="discuss_user">
                    <div class="discuss_user_left">
                        <div class="discuss_user_img"><img src="<?php echo base_url('/assets/'); ?>images/user7.jpg" alt="Hemant Sakarwal"/></div>
                        <div class="discuss_user_txt"><h3>100% of users ...</h3>
                            <p><span class="dis_num">123</span> <i class="fa fa-angle-down" aria-hidden="true"></i> <i class="fa fa-angle-up" aria-hidden="true"  style="color:green"></i> 9 hours ago ...</p></div>
                    </div>
                    <div class="discuss_user_right"><i class="fa fa-comments" aria-hidden="true"></i> <span class="dis_cmt">239</span></div>
                </div>

                <div class="discuss_user">
                    <div class="discuss_user_left">
                        <div class="discuss_user_img"><img src="<?php echo base_url('/assets/'); ?>images/user8.jpeg" alt="Hemant Sakarwal"/></div>
                        <div class="discuss_user_txt"><h3>100% of users ...</h3>
                            <p><span class="dis_num">123</span> <i class="fa fa-angle-down" aria-hidden="true"></i> <i class="fa fa-angle-up" aria-hidden="true"  style="color:green"></i> 9 hours ago ...</p></div>
                    </div>
                    <div class="discuss_user_right"><i class="fa fa-comments" aria-hidden="true"></i> <span class="dis_cmt">239</span></div>
                </div>

                <div class="discuss_user">
                    <div class="discuss_user_left">
                        <div class="discuss_user_img"><img src="<?php echo base_url('/assets/'); ?>images/user1.png" alt="Hemant Sakarwal"/></div>
                        <div class="discuss_user_txt"><h3>100% of users ...</h3>
                            <p><span class="dis_num">123</span> <i class="fa fa-angle-down" aria-hidden="true"></i> <i class="fa fa-angle-up" aria-hidden="true"  style="color:green"></i> 9 hours ago ...</p></div>
                    </div>
                    <div class="discuss_user_right"><i class="fa fa-comments" aria-hidden="true"></i> <span class="dis_cmt">239</span></div>
                </div>

                <div class="discuss_user">
                    <div class="discuss_user_left">
                        <div class="discuss_user_img"><img src="<?php echo base_url('/assets/'); ?>images/user2.jpg" alt="Hemant Sakarwal"/></div>
                        <div class="discuss_user_txt"><h3>100% of users ...</h3>
                            <p><span class="dis_num">123</span> <i class="fa fa-angle-down" aria-hidden="true"></i> <i class="fa fa-angle-up" aria-hidden="true"  style="color:green"></i> 9 hours ago ...</p></div>
                    </div>
                    <div class="discuss_user_right"><i class="fa fa-comments" aria-hidden="true"></i> <span class="dis_cmt">239</span></div>
                </div>

                <div class="discuss_user">
                    <div class="discuss_user_left">
                        <div class="discuss_user_img"><img src="<?php echo base_url('/assets/'); ?>images/user3.jpeg" alt="Hemant Sakarwal"/></div>
                        <div class="discuss_user_txt"><h3>100% of users ...</h3>
                            <p><span class="dis_num">123</span> <i class="fa fa-angle-down" aria-hidden="true"></i> <i class="fa fa-angle-up" aria-hidden="true"  style="color:green"></i> 9 hours ago ...</p></div>
                    </div>
                    <div class="discuss_user_right"><i class="fa fa-comments" aria-hidden="true"></i> <span class="dis_cmt">239</span></div>
                </div>

                <div class="discuss_user">
                    <div class="discuss_user_left">
                        <div class="discuss_user_img"><img src="<?php echo base_url('/assets/'); ?>images/user4.jpeg" alt="Hemant Sakarwal"/></div>
                        <div class="discuss_user_txt"><h3>100% of users ...</h3>
                            <p><span class="dis_num">123</span> <i class="fa fa-angle-down" aria-hidden="true"></i> <i class="fa fa-angle-up" aria-hidden="true"  style="color:green"></i> 9 hours ago ...</p></div>
                    </div>
                    <div class="discuss_user_right"><i class="fa fa-comments" aria-hidden="true"></i> <span class="dis_cmt">239</span></div>
                </div>

                <div class="discuss_user">
                    <div class="discuss_user_left">
                        <div class="discuss_user_img"><img src="<?php echo base_url('/assets/'); ?>images/user5.jpg" alt="Hemant Sakarwal"/></div>
                        <div class="discuss_user_txt"><h3>100% of users ...</h3>
                            <p><span class="dis_num">123</span> <i class="fa fa-angle-down" aria-hidden="true"></i> <i class="fa fa-angle-up" aria-hidden="true"  style="color:green"></i> 9 hours ago ...</p></div>
                    </div>
                    <div class="discuss_user_right"><i class="fa fa-comments" aria-hidden="true"></i> <span class="dis_cmt">239</span></div>
                </div>
            </div>

        </div>
    </div>

</section>

<script>
    if('' != "<?php echo $this->session->userdata('session_userId');?>" && "none"   == $('#Logout').css('display')) {
        
        $('#User_Register').css('display', 'none');
        $('#Logout').css('display', 'block');
    };
</script>
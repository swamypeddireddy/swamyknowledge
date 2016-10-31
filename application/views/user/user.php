<section>

    <?php if (isset($Success) && $Success != '') { ?>
        <div class="messagesphp">
            <div class="successphp" id="SUCCESS"><?php echo $Success; ?></div>
        </div>
    <?php } ?>

    <?php if (isset($Info) && $Info != '') { ?>
        <div class="messagesphp">
            <div class="infophp" id="INFO"><?php echo $Info; ?></div>
            <!-- <div class="successphp" id="SUCCESS"><?php //echo $Success;  ?></div>-->
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
                        <div class="mentor_user"><a href="profile.html"><span class="mentor_user_img green"><img src="<?php echo base_url('/assets/'); ?>images/user1.png" alt="Hemant"/></span></a>
                            <span class="prf_sm_img"><img src="<?php echo base_url('/assets/'); ?>images/3.png" alt="smiely"/> <img src="<?php echo base_url('/assets/'); ?>images/1.png" alt="nutral"/> <img src="<?php echo base_url('/assets/'); ?>images/2.png" alt="sad"/></span>
                             <!-- <span class="mentor_txt">Hemant Sakarwal</span>--></div>
                        <div class="mentor_org"><span class="mentor_org_img yellow"><img src="<?php echo base_url('/assets/'); ?>images/org1.jpg" alt="fiables"/></span>
                        <span class="prf_sm_img"><img src="<?php echo base_url('/assets/'); ?>images/3.png" alt="smiely"/> <img src="<?php echo base_url('/assets/'); ?>images/1.png" alt="nutral"/> <img src="<?php echo base_url('/assets/'); ?>images/2.png" alt="sad"/></span> <!-- <span class="mentor_txt">Fiables Offshoring Services Pvt. Ltd.</span>--></div>
                    </div>

                    <div class="mentor_information">
                        <div class="mentor_user"><a href="profile.html"><span class="mentor_user_img red"><img src="<?php echo base_url('/assets/'); ?>images/user2.jpg" alt="Hemant"/></span></a>
                        <span class="prf_sm_img"><img src="<?php echo base_url('/assets/'); ?>images/3.png" alt="smiely"/> <img src="<?php echo base_url('/assets/'); ?>images/1.png" alt="nutral"/> <img src="<?php echo base_url('/assets/'); ?>images/2.png" alt="sad"/></span> <!-- <span class="mentor_txt">Hemant Sakarwal</span>--></div>
                        <div class="mentor_org"><span class="mentor_org_img white"><img src="<?php echo base_url('/assets/'); ?>images/org2.jpg" alt="fiables"/></span>
                        <span class="prf_sm_img"><img src="<?php echo base_url('/assets/'); ?>images/3.png" alt="smiely"/> <img src="<?php echo base_url('/assets/'); ?>images/1.png" alt="nutral"/> <img src="<?php echo base_url('/assets/'); ?>images/2.png" alt="sad"/></span> <!-- <span class="mentor_txt">Fiables Offshoring Services Pvt. Ltd.</span>--></div>
                    </div>

                    <div class="mentor_information">
                        <div class="mentor_user"><a href="profile.html"><span class="mentor_user_img black"><img src="<?php echo base_url('/assets/'); ?>images/user3.jpeg" alt="Hemant"/></span></a>
                        <span class="prf_sm_img"><img src="<?php echo base_url('/assets/'); ?>images/3.png" alt="smiely"/> <img src="<?php echo base_url('/assets/'); ?>images/1.png" alt="nutral"/> <img src="<?php echo base_url('/assets/'); ?>images/2.png" alt="sad"/></span> <!-- <span class="mentor_txt">Hemant Sakarwal</span>--></div>
                        <div class="mentor_org"><span class="mentor_org_img yellow"><img src="<?php echo base_url('/assets/'); ?>images/org3.jpeg" alt="fiables"/></span>
                        <span class="prf_sm_img"><img src="<?php echo base_url('/assets/'); ?>images/3.png" alt="smiely"/> <img src="<?php echo base_url('/assets/'); ?>images/1.png" alt="nutral"/> <img src="<?php echo base_url('/assets/'); ?>images/2.png" alt="sad"/></span> <!-- <span class="mentor_txt">Fiables Offshoring Services Pvt. Ltd.</span>--></div>
                    </div>

                    <div class="mentor_information">
                        <div class="mentor_user"><a href="profile.html"><span class="mentor_user_img red"><img src="<?php echo base_url('/assets/'); ?>images/user4.jpeg" alt="Hemant"/></span></a>
                        <span class="prf_sm_img"><img src="<?php echo base_url('/assets/'); ?>images/3.png" alt="smiely"/> <img src="<?php echo base_url('/assets/'); ?>images/1.png" alt="nutral"/> <img src="<?php echo base_url('/assets/'); ?>images/2.png" alt="sad"/></span> <!-- <span class="mentor_txt">Hemant Sakarwal</span>--></div>
                        <div class="mentor_org"><span class="mentor_org_img green"><img src="<?php echo base_url('/assets/'); ?>images/org4.jpg" alt="fiables"/></span>
                        <span class="prf_sm_img"><img src="<?php echo base_url('/assets/'); ?>images/3.png" alt="smiely"/> <img src="<?php echo base_url('/assets/'); ?>images/1.png" alt="nutral"/> <img src="<?php echo base_url('/assets/'); ?>images/2.png" alt="sad"/></span> <!-- <span class="mentor_txt">Fiables Offshoring Services Pvt. Ltd.</span>--></div>
                    </div>

                </div>
            </div>


            <div class="user-profile">
                <div class="user_prf">
                    <div class="user-profile_txt"><p><b class="font_size">Managing Director</b><br/>
                            <b style="font-size:13px; font-weight:normal;">Fiables Offshoring Services Pvt. Ltd.</b></p>
                        <p class="new_para">Global Senior Executive with 20+ years of International experience of working in Europe & America for GE, UBS, Computer science JNU Delhi, 1992 B.E, ...</div>
                    <div class="user-profile_right"><img src="<?php echo base_url('/assets/') ?>images/hemant.jpg" alt="Hemant Sakarwal"/></div>
                </div>


                <div class="ask_give">

                    <div class="prf_ask">
                        <h2>Ask</h2>

                        <div class="ask_input"><input class="ask_input_i" type="text" name="" value="" placeholder="Enter your..."/></div>


                        <div class="prf_select">
                            <select>
                                <option>Group</option>
                                <option>Idle</option>
                                <option>Help</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                            </select>

                            <select>
                                <option>Public</option>
                                <option>Idle</option>
                                <option>Help</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                            </select>

                            <select>
                                <option>Mentor</option>
                                <option>Idle</option>
                                <option>Help</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                            </select>

                            <select>
                                <option>Vendor</option>
                                <option>Idle</option>
                                <option>Help</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                            </select>

                        </div>
                    </div>


                    <div class="prf_ask">
                        <h2>Give</h2>

                        <div class="ask_input"><input class="ask_input_give" type="text" name="" value="" placeholder="Enter your..."/></div>


                        <div class="prf_select_give">
                            <select>
                                <option>Group</option>
                                <option>Idle</option>
                                <option>Help</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                            </select>

                            <select>
                                <option>Public</option>
                                <option>Idle</option>
                                <option>Help</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                            </select>

                            <select>
                                <option>Mentor</option>
                                <option>Idle</option>
                                <option>Help</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                            </select>

                            <select>
                                <option>Vendor</option>
                                <option>Idle</option>
                                <option>Help</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                                <option>Ask a Question</option>
                            </select>

                        </div>
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
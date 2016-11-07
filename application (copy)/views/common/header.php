<!DOCTYPE html>
<html>
    <head>

        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>ConnectKarma</title>

        <link rel="stylesheet" href="<?php echo base_url('/assets/'); ?>css/styles.css">
        <link rel="stylesheet" href="<?php echo base_url('/assets/'); ?>css/animate.css">
        <link rel="stylesheet" href="<?php echo base_url('/assets/'); ?>css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo base_url('/assets/'); ?>css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url('/assets/'); ?>css/messages.css">
        <link rel="icon" href="<?php echo base_url('/assets/'); ?>images/favicon.ico" type="image/x-icon" />

        <script src="<?php echo base_url('/assets/'); ?>js/jquery.min.js"></script>
        <script src="<?php echo base_url('/assets/'); ?>js/script.js"></script>
        <script>
            var base_url = '<?php echo base_url(); ?>';
            // alert(base_url);
        </script>
    </head>

    <body>

        <header>
            <div class="main">
                <?php if (true == $this->session->userdata('session_userId') || true == $this->session->userdata('social_login_status')) { ?>

                    <div class="user_login">
                        <ul class="user_login_ul">
                            <li class="user_login_li"><b>Welcome</b> <img src="<?php echo base_url('/assets/'); ?>images/user7.jpg" alt="ProfilePic"/> 
                                <ul>
                                    <li><a href="edit-profile.html">Edit Profile</a></li>
                                    <li><a href="<?php echo base_url('index.php/User/Logout'); ?>">Logout</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                <?php } ?>

                <div class="logo"><a href="<?php echo base_url('index.php/User/index'); ?>"><img src="<?php echo base_url('/assets/'); ?>images/logo-1.png" alt="Logo"/></a></div>
                <a href="javascript:void(0);" class="nav_btn">&equiv;</a>

                <?php if (true == $this->session->userdata('session_userId') || true == $this->session->userdata('social_login_status')) { ?>
                    <div class="navigation">
                    <?php } else { ?>
                        <div class="navigation m_top_34">
                        <?php }; ?>

                        <nav class="nav_fade">
                            <ul>
                                <li><a href="<?php echo base_url('index.php/DataAnalytics/'); ?>">Data Analytic</a> <span>/</span></li>
                                <li><a href="<?php echo base_url('index.php/Event/'); ?>">Event</a> <span>/</span></li>
                                <li><a href="<?php echo base_url('index.php/About/'); ?>">About</a> <span>/</span></li>
                                <li><a href="<?php echo base_url('index.php/Blog/createPost'); ?>">Blog</a><span>/</span></li>
                                <!--<li><a href="<?php //echo base_url('index.php/News');           ?>">News</a></li>-->
                                <li><a href="<?php echo base_url('index.php/Contact/'); ?>">Contact</a><span></span></li>
                                <!--                            <li>
                                                                <a id="User_Register" href="<?php //echo base_url('index.php/User/register');    ?>">User Register</a>
                                                                <a id="Logout" href="<?php //echo base_url('index.php/User/Logout');    ?>">Logout</a>
                                                            </li>-->
                            </ul>
                        </nav>
                    </div>

                </div>
        </header>

        <section>
            <!--    Header messges-->
            <div class="messages">
                <div class="info" id="MSG_INFO"></div>       
                <div class="success" id="MSG_SUCCESS"></div>
                <div class="warning" id="MSG_WARNING"></div>            
                <div class="error" id="MSG_ERROR"></div>
            </div>

            <?php
            /* echo MSG_INFO;
              echo MSG_SUCCESS;
              echo MSG_WARNING;
              echo MSG_ERROR; */
            ?>

            <style>
                #Logout {
                    display: none
                }
            </style>

            <?php if (true == $this->session->userdata('session_userId') || true == $this->session->userdata('social_login_status')) { ?>
                <div class="referel-messages">
                    <div class="main">
                        <div class="referel">
                            <span class="referel_img"><img src="<?php echo base_url('/assets/'); ?>images/3.png" alt="smily" title="Referrel Received"/> <b class="ref_num">2500</b></span>
                            <span class="referel_img"><img src="<?php echo base_url('/assets/'); ?>images/1.png" alt="surprise" title="Referrel Given"/> <b class="ref_num">2500</b></span>
                            <span class="referel_img"><img src="<?php echo base_url('/assets/'); ?>images/2.png" alt="sad" title="Referrel not Given"/> <b class="ref_num">2500</b></span>
                        </div>
                        <div class="knw_hub"><input type="search" name="" value="" placeholder="Knowldge Hug Search ... "/><i class="fa fa-search khub_search" aria-hidden="true"></i></div>
                        <div class="message">
                            <span class="msg_img"><img src="<?php echo base_url('/assets/'); ?>images/business-done.png" alt="business-done"/> <b class="msg_num">1500</b></span>
                            <span class="msg_img"><a href="emails.html"><img src="<?php echo base_url('/assets/'); ?>images/referrelreceive.png" alt="referrelreceive"/> <b class="msg_num">1500</b></a></span>
                            <span class="msg_img"><a href="emails.html"><img src="<?php echo base_url('/assets/'); ?>images/referrelgiven.png" alt="referrelgiven"/> <b class="msg_num">1500</b></a></span>
                            <span class="msg_img"><a href="feedback.html"><i class="fa fa-file-text" aria-hidden="true"></i></a></span>
                        </div>
                    </div>
                </div>
            <?php }; ?>
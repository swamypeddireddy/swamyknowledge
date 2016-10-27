<!DOCTYPE html>
<html>

    <head>
        <title>ConnectKarma</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="<?php echo base_url('/assets/'); ?>css/styles.css">
        <link rel="stylesheet" href="<?php echo base_url('/assets/'); ?>css/animate.css">
        <link rel="stylesheet" href="<?php echo base_url('/assets/'); ?>css/font-awesome.css">
        <link rel="stylesheet" href="<?php echo base_url('/assets/'); ?>css/font-awesome.min.css">
        <link rel="stylesheet" href="<?php echo base_url('/assets/'); ?>css/messages.css">
        <link rel="icon" href="<?php echo base_url('/assets/'); ?>images/favicon.ico" type="image/x-icon" />
        
        <script src="<?php echo base_url('/assets/'); ?>js/jquery.min.js"></script>
        <script src="<?php echo base_url('/assets/'); ?>js/script.js"></script>
          <script>
              var base_url='<?php echo base_url(); ?>';
             // alert(base_url);
            </script>
    </head>

    <body>

        <header>
            <div class="main">
                <div class="logo">
                    <a href="<?php echo base_url('index.php/User/'); ?>"><img src="<?php echo base_url('/assets/'); ?>images/logo-1.png" alt="Logo"/></a>
                </div>
                <div class="navigation wow zoomIn">
                    <nav>
                        <ul>
                            <li><a href="<?php echo base_url('index.php/DataAnalytics/'); ?>">Data Analytic</a> <span>/</span></li>
                            <li><a href="<?php echo base_url('index.php/Event/'); ?>">Events</a> <span>/</span></li>
                            <li><a href="<?php echo base_url('index.php/About/'); ?>">About</a> <span>/</span></li>
                            <li><a href="<?php echo base_url('index.php/Blog/createPost'); ?>">Blog</a> <span>/</span></li>
                            <!--<li><a href="<?php //echo base_url('index.php/News');   ?>">News</a></li>-->
                            <li><a href="<?php echo base_url('index.php/Contact/'); ?>">Contact</a> <span>/</span></li>
                            <li>
                                <a id="User_Register" href="<?php echo base_url('index.php/User/register'); ?>">User Register</a>
                                <a id="Logout" href="<?php echo base_url('index.php/User/Logout'); ?>">Logout</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </header>

        <?php
        /* echo MSG_INFO;
          echo MSG_SUCCESS;
          echo MSG_WARNING;
          echo MSG_ERROR; */
        ?>

        <div class="messages">
            <div class="info" id="MSG_INFO"></div>       
            <div class="success" id="MSG_SUCCESS"></div>
            <div class="warning" id="MSG_WARNING"></div>            
            <div class="error" id="MSG_ERROR"></div>
        </div>

        <style>
            #Logout {
                display: none
            }
        </style>
          <div class="referel-messages">
        <div class="main">
            <div class="referel">
                <span class="referel_img"><img src="<?php echo base_url('/assets/'); ?>images/3.png" alt="smily" title="Referrel Received"/> <b class="ref_num">2500</b></span>
                <span class="referel_img"><img src="<?php echo base_url('/assets/'); ?>images/1.png" alt="surprise" title="Referrel Given"/> <b class="ref_num">2500</b></span>
                <span class="referel_img"><img src="<?php echo base_url('/assets/'); ?>images/2.png" alt="sad" title="Referrel not Given"/> <b class="ref_num">2500</b></span>
            </div>

            <div class="knw_hub">
                <form method="post" action="<?php echo base_url().'ckhub/'; ?>">
                <input type="search" name="title" value="<?php if(isset($chubsearch)){ echo $chubsearch; } ?>" placeholder="Knowldge Hug Search ... "/>
            
                
                <div class="submit-container">
					<input name="hubsearch" value="" class="searchsubmit" type="submit">
				</div>
             
                
               
                </form>
            </div>

            <div class="message">
                <?php        
                 $iduser=$this->session->userdata('session_userId');
       $askcountresult=array();
         $this->db->select('count(idbusinessask) as askcount');
        $this->db->from('ck_businessask');
         $this->db->where('status', 1);
            $this->db->where('createdby', $iduser);     
         $res = $this->db->get();
         if ($res && $res->num_rows() > 0) {
       $askcountresult=$res->row();
         }
         
          $givecountresult=array();
         $this->db->select('count(idbusinessgive) as givecount');
        $this->db->from('ck_businessgive');
         $this->db->where('status', 1);
            $this->db->where('createdby', $iduser);     
         $res = $this->db->get();
          if ($res && $res->num_rows() > 0) {
       $givecountresult=$res->row();
         }
                ?>
                <span class="msg_img"><img src="<?php echo base_url('/assets/'); ?>images/business-done.png" alt="business-done"/> <b class="msg_num">1500</b></span>
                <span class="msg_img"><a href="emails.html"><img src="<?php echo base_url('/assets/'); ?>images/referrelreceive.png" alt="referrelreceive"/> <b class="msg_num"><?php if(count($askcountresult)>0){ echo $askcountresult->askcount; } else{ echo 0; } ?></b></a></span>
                <span class="msg_img"><a href="emails.html"><img src="<?php echo base_url('/assets/'); ?>images/referrelgiven.png" alt="referrelgiven"/> <b class="msg_num"><?php if(count($givecountresult)>0){ echo $givecountresult->givecount; } else{ echo 0; } ?></b></a></span>
                <span class="msg_img"><a href="feedback.html"><i class="fa fa-file-text" aria-hidden="true"></i></a></span>
            </div>
        </div>
    </div>